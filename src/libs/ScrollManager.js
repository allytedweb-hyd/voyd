// import { useEffect } from "react";
// import { useLocation, useNavigationType } from "react-router-dom";

// const scrollPositions = new Map();

// const throttle = (fn, delay) => {
//     let lastCall = 0;
//     return (...args) => {
//         const now = Date.now();
//         if (now - lastCall >= delay) {
//             lastCall = now;
//             fn(...args);
//         }
//     };
// };

// const useScrollRestoration = () => {
//     const location = useLocation();
//     const navigationType = useNavigationType();
//     const pathname = location.pathname;

//     useEffect(() => {
//         console.log(" Navigation Type:", navigationType);
//         console.log(" Current Path:", pathname);

//         if (navigationType === "POP") {
//             const savedY = scrollPositions.get(pathname) || 0;
//             console.log(" Restoring scroll to:", savedY);

//             requestAnimationFrame(() => {
//                 setTimeout(() => {
//                     window.scrollTo(0, savedY);
//                 }, 100);
//             });
//         } else {
//             console.log(" New navigation, scroll to top");
//             window.scrollTo(0, 0);
//         }

//         const onScroll = throttle(() => {
//             const y = window.scrollY;
//             scrollPositions.set(pathname, y);
//             console.log(" Saving scrollY:", y, "for:", pathname);
//         }, 200);

//         window.addEventListener("scroll", onScroll);

//         return () => {
//             window.removeEventListener("scroll", onScroll);
//         };
//     }, [pathname, navigationType]);
// };

// export default useScrollRestoration;

// working code

// import { useEffect } from "react";
// import { useLocation, useNavigationType } from "react-router-dom";

// const scrollPositions = new Map();

// const throttle = (fn, delay) => {
//     let lastCall = 0;
//     return (...args) => {
//         const now = Date.now();
//         if (now - lastCall >= delay) {
//             lastCall = now;
//             fn(...args);
//         }
//     };
// };

// const useScrollRestoration = () => {
//     const location = useLocation();
//     const navigationType = useNavigationType();
//     const pathname = location.pathname;

//     useEffect(() => {
//         console.log(" Navigation Type:", navigationType);
//         console.log(" Current Path:", pathname);

//         if (navigationType === "POP") {
//             const savedY = scrollPositions.get(pathname) || 0;
//             console.log(" Restoring scroll to:", savedY);

//             requestAnimationFrame(() => {
//                 setTimeout(() => {
//                     window.scrollTo(0, savedY);
//                 }, 100);
//             });
//         } else {
//             if (pathname === "/") {
//                 const savedY = scrollPositions.get(pathname) || 0;
//                 console.log(
//                     " Home page new navigation, restoring scroll to:",
//                     savedY
//                 );
//                 window.scrollTo(0, savedY);
//             } else {
//                 console.log(" New navigation, scroll to top");
//                 window.scrollTo(0, 0);
//             }
//         }

//         const onScroll = throttle(() => {
//             const y = window.scrollY;
//             scrollPositions.set(pathname, y);
//             console.log(" Saving scrollY:", y, "for:", pathname);
//         }, 200);

//         window.addEventListener("scroll", onScroll);

//         return () => {
//             window.removeEventListener("scroll", onScroll);
//         };
//     }, [pathname, navigationType]);
// };

// export default useScrollRestoration;

// working code

import { useEffect } from "react";
import { useLocation, useNavigationType } from "react-router-dom";

const scrollPositions = new Map();

const throttle = (fn, delay) => {
    let lastCall = 0;
    return (...args) => {
        const now = Date.now();
        if (now - lastCall >= delay) {
            lastCall = now;
            fn(...args);
        }
    };
};

const useScrollRestoration = () => {
    const location = useLocation();
    const navigationType = useNavigationType();
    const pathname = location.pathname;

    useEffect(() => {
        if ("scrollRestoration" in window.history) {
            window.history.scrollRestoration = "manual";
        }
    }, []);

    useEffect(() => {
        const savedY = scrollPositions.get(pathname) || 0;

        if (navigationType === "POP") {
            console.log("POP navigation: restoring scroll to", savedY);
            requestAnimationFrame(() => {
                setTimeout(() => {
                    window.scrollTo(0, savedY);
                }, 100);
            });
        } else {
            if (pathname === "/") {
                console.log(
                    "New navigation to home: restoring scroll to",
                    savedY
                );
                requestAnimationFrame(() => {
                    setTimeout(() => {
                        window.scrollTo(0, savedY);
                    }, 100);
                });
            } else {
                console.log("New navigation to", pathname, ": scroll to top");
                window.scrollTo(0, 0);
            }
        }

        const onScroll = throttle(() => {
            const y = window.scrollY;
            scrollPositions.set(pathname, y);
        }, 200);

        window.addEventListener("scroll", onScroll);

        return () => {
            window.removeEventListener("scroll", onScroll);
        };
    }, [pathname, navigationType]);
};

export default useScrollRestoration;
