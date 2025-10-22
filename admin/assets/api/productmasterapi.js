/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#product",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Enter a product",
                // regexError: "*Product is invalid. It accepts only characters",
                // minLengthError: "*Product should be minimum 3 characters",
                // maxLengthError: "*Product should be maximum 20 characters",
            },
        },
        {
            element: "#alt_text",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Enter image text",
                // regexError: "*Alt Text is invalid. It accepts only characters",
                // minLengthError: "*Alt Text should be minimum 3 characters",
                // maxLengthError: "*Alt Text should be maximum 20 characters",
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
                requiredError: "*Provide an image",
                maxSizeError: "*Image should be less than 1mb",
                fileTypeError: "*Image should be type of jpg, png or jpeg",
                resolutionError: "*Image should be 768 * 600px",
            },
        },
    ];

    $("#add-material").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-material").addClass("d-none");
            $("#add-material").hide();
            $("#submit-material").removeClass("d-none").addClass("d-block");
            $("#submit-material").trigger("click");
        }
    });
});
