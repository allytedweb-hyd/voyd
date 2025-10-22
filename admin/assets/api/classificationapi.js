/* eslint-disable no-undef */

$(document).ready(function () {
    let validationRules = [
        {
            element: "#proclassification",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 2,
                // maxLength: 30,
            },
            errors: {
                requiredError: "*Enter a classification",
                // regexError: "*Classification is invalid.",
                // minLengthError:
                //     "*Classification should be minimum 2 characters",
                // maxLengthError:
                //     "*Classification should be maximum 30 characters",
            },
        },

        {
            element: "#icon",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/jpg", "image/png", "image/jpeg"],
                resolutionWidth: 1000,
                resolutionHeight: 1020,
            },
            errors: {
                requiredError: "*Provide a icon",
                maxSizeError: "*Icon should be less than 1mb",
                fileTypeError: "*Icon should be of type jpg, png or jpeg",
                resolutionError: "*Icon should be 768 * 600px",
            },
        },
    ];

    $("#add-classification").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-classification").addClass("d-none");
            $("#add-classification").hide();
            $("#submit-classification")
                .removeClass("d-none")
                .addClass("d-block");
            $("#submit-classification").trigger("click");
        }
    });
});
