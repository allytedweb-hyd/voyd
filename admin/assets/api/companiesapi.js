/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#image",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/jpg", "image/jpeg", "image/png"],
                resolutionWidth: 768,
                resolutionHeight: 600,
            },
            errors: {
                requiredError: "*Company Image is required",
                maxSizeError: "*Company Image size should be less than 1mb",
                fileTypeError:
                    "*Company Image should be of type jpg, jpeg or png",
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
                // regexError: "*Alt text is invalid.It accepts only characters",
                // minLengthError: "*Alt text should be minimum 3 characters",
                // maxLengthError: "*Alt text should be maximum 20 characters",
            },
        },
    ];

    $("#add-company").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-company").addClass("d-none");
            $("#add-company").hide();
            $("#submit-company").removeClass("d-none").addClass("d-block");
            $("#submit-company").trigger("click");
        }
    });
});
