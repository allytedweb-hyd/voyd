/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
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
                maxSizeError: "*Image size should be less than 1mb",
                fileTypeError: "*Image should be of type jpg, jpeg or png",
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
                requiredError: "*Enter image text",
                // regexError: "*Alt text is invalid.It accepts only characters",
                // minLengthError: "*Alt text should be minimum 3 characters",
                // maxLengthError: "*Alt text should be maximum 20 characters",
            },
        },

        {
            element: "#category",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Enter a name",
                // regexError: "*Category is invalid.It accepts only characters",
                // minLengthError: "*Category should be minimum 3 characters",
                // maxLengthError: "*Category should be maximum 20 characters",
            },
        },
    ];

    $("#add-gallery").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-gallery").addClass("d-none");
            $("#add-gallery").hide();
            $("#submit-gallery").removeClass("d-none").addClass("d-block");
            $("#submit-gallery").trigger("click");
        }
    });
});
