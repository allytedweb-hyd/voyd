/* eslint-disable no-unused-vars */
import React, { useEffect, useContext, useRef } from 'react';
import { UNSAFE_NavigationContext, useLocation } from 'react-router-dom';
import Swal from 'sweetalert2';
import PropTypes from 'prop-types';

function RouteChangePrompt({ when }) {
    const { navigator } = useContext(UNSAFE_NavigationContext);
    const location = useLocation();
    const currentPathRef = useRef(location.pathname);
    const isNavigatingRef = useRef(false);

    useEffect(() => {
        if (!when || !navigator) return;

        const originalPush = navigator.push;
        const originalReplace = navigator.replace;


        navigator.push = async (path, state) => {
            if (when) {
                const confirmed = await confirmNavigation();
                if (!confirmed) return;
            }
            originalPush(path, state);
        };

        // Override replace
        navigator.replace = async (path, state) => {
            if (when) {
                const confirmed = await confirmNavigation();
                if (!confirmed) return;
            }
            originalReplace(path, state);
        };

        // Back/forward button
        const handlePopState = async () => {
            if (!when || isNavigatingRef.current) return;

            const confirmed = await confirmNavigation();
            if (!confirmed) {
                isNavigatingRef.current = true;
                navigator.push(currentPathRef.current);
                setTimeout(() => (isNavigatingRef.current = false), 100);
            } else {
                currentPathRef.current = window.location.pathname;
            }
        };



        const handleBeforeUnload = (e) => {
            if (when) {
                e.preventDefault();
                e.returnValue = '';
            }
        };

        window.addEventListener('popstate', handlePopState);
        window.addEventListener('beforeunload', handleBeforeUnload);

        return () => {
            navigator.push = originalPush;
            navigator.replace = originalReplace;
            window.removeEventListener('popstate', handlePopState);
            window.removeEventListener('beforeunload', handleBeforeUnload);
        };
    }, [when, navigator]);

    useEffect(() => {
        currentPathRef.current = location.pathname;
    }, [location]);

    const confirmNavigation = async () => {
        const result = await Swal.fire({
            title: 'Are you sure?',
            text: 'You have unsaved changes. Do you really want to leave?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, leave',
            cancelButtonText: 'No, stay',
            reverseButtons: true,
        });

        return result.isConfirmed;
    };

    return null;
}

RouteChangePrompt.propTypes = {
    when: PropTypes.bool.isRequired,
};

export default RouteChangePrompt;
