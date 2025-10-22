/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#testimonialname",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select a name",
            },
        },
        {
            element: "#tab",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select a tab",
            },
        },

        {
            element: "#image1",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/jpg", "image/png", "image/jpeg"],
                // resolutionWidth: 768,
                // resolutionHeight: 600,
            },
            errors: {
                requiredError: "*Provide an image",
                maxSizeError: "*Image should be less than 1mb",
                fileTypeError: "*Image should be type of jpg, png or jpeg",
                // resolutionError: "*Image should be 768 * 600px",
            },
        },
        {
            element: "#image2",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/jpg", "image/png", "image/jpeg"],
                // resolutionWidth: 768,
                // resolutionHeight: 600,
            },
            errors: {
                requiredError: "*Provide an image",
                maxSizeError: "*Image should be less than 1mb",
                fileTypeError: "*Image should be type of jpg, png or jpeg",
                // resolutionError: "*Image should be 768 * 600px",
            },
        },
        {
            element: "#image3",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/jpg", "image/png", "image/jpeg"],
                // resolutionWidth: 768,
                // resolutionHeight: 600,
            },
            errors: {
                requiredError: "*Provide an image",
                maxSizeError: "*Image should be less than 1mb",
                fileTypeError: "*Image should be type of jpg, png or jpeg",
                // resolutionError: "*Image should be 768 * 600px",
            },
        },
        {
            element: "#icon",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/jpg", "image/png", "image/jpeg"],
                // resolutionWidth: 768,
                // resolutionHeight: 600,
            },
            errors: {
                requiredError: "*Provide an image",
                maxSizeError: "*Icon should be less than 1mb",
                fileTypeError: "*Icon should be type of jpg, png or jpeg",
                // resolutionError: "*Icon should be 768 * 600px",
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
                requiredError: "*Enter image text",
                // regexError: "*Alt text is invalid. It accepts only characters",
                // minLengthError: "*Alt text should be minimum 3 characters",
                // maxLengthError: "*Alt text should be maximum 20 characters",
            },
        },

        {
            element: "#testdesc",
            rules: {
                required: true,
                maxLength: 200,
            },
            errors: {
                requiredError: "*Enter description",
                maxLengthError: "*Description should be maximum 200 characters",
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
