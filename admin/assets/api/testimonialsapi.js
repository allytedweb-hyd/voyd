/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#name",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Name is required",
                // regexError: "*Name is invalid. It accepts only characters",
                // minLengthError: "*Name should be minimum 3 characters",
                // maxLengthError: "*Name should be maximum 20 characters",
            },
        },

        {
            element: "#image",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/jpg", "image/png", "image/jpeg"],
                resolutionWidth: 768,
                resolutionHeight: 600,
            },
            errors: {
                requiredError: "*Image is required",
                maxSizeError: "*Image should be less than 1mb",
                fileTypeError: "*Image should be type of jpg, png or jpeg",
                resolutionError: "*Image should be 768 * 600px",
            },
        },

        {
            element: "#alttext",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Alt text is required",
                // regexError: "*Alt text is invalid. It accepts only characters",
                // minLengthError: "*Alt text should be minimum 3 characters",
                // maxLengthError: "*Alt text should be maximum 20 characters",
            },
        },

        {
            element: "#tdesig",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Rating is required",
                // regexError: "*Designation is invalid. It accepts only characters",
                // minLengthError: "*Designation should be minimum 3 characters",
                // maxLengthError: "*Designation should be maximum 20 characters",
            },
        },

        {
            element: "#testdesc",
            rules: {
                required: true,
                maxLength: 220,
            },
            errors: {
                requiredError: "*Description is required",
                maxLengthError: "*Description should be maximum 220 characters",
            },
        },
    ];

    console.log("validationsss---------------------", validationRules);

    $("#add-testimonial").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        console.log("validationsss---------------------", IsFormValid);

        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-testimonial").addClass("d-none");
            $("#add-testimonial").hide();
            $("#submit-testimonial").removeClass("d-none").addClass("d-block");
            $("#submit-testimonial").trigger("click");
        }
    });
});
