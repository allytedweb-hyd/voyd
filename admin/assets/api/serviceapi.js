/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#title",
            rules: {
                required: true,
                regex: regexPatterns.alphabetsregex,
                minLength: 4,
                maxLength: 20,
            },
            errors: {
                requiredError: "*Service title is required",
                regexError:
                    "*Service title is invalid. It accepts only characters",
                minLengthError: "*Service title should be minimum 4 characters",
                maxLengthError:
                    "*Service title should be maximum 20 characters",
            },
        },

        {
            element: "#subtitle",
            rules: {
                required: true,
                regex: regexPatterns.alphabetsregex,
                minLength: 4,
                maxLength: 20,
            },
            errors: {
                requiredError: "*Service sub title is required",
                regexError:
                    "*Service sub title is invalid. It accepts only characters",
                minLengthError:
                    "*Service sub title should be minimum 4 characters",
                maxLengthError:
                    "*Service sub title should be maximum 20 characters",
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
                requiredError: "*Service image is required",
                maxSizeError: "*Service image should be less than 1mb",
                fileTypeError:
                    "*Service image should be type of jpg, png or jpeg",
                resolutionError: "*Image should be 768 * 600px",
            },
        },

        {
            element: "#alttext",
            rules: {
                required: true,
                regex: regexPatterns.alphabetsregex,
                minLength: 3,
                maxLength: 20,
            },
            errors: {
                requiredError: "*Service alt text is required",
                regexError:
                    "*Service alt text is invalid. It accepts only characters",
                minLengthError:
                    "*Service alt text should be minimum 3 characters",
                maxLengthError:
                    "*Service alt text should be maximum 20 characters",
            },
        },

        {
            element: "#servicedesc",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Description is required",
            },
        },
    ];

    console.log("validationsss---------------------", validationRules);

    $("#add-service").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        console.log("validationsss---------------------", IsFormValid);

        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-service").addClass("d-none");
            $("#add-service").hide();
            $("#submit-service").removeClass("d-none").addClass("d-block");
            $("#submit-service").trigger("click");
        }
    });
});
