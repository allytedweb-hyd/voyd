/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#category",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Category is required",
            },
        },

        {
            element: "#title",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 4,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Brand title is required",
                // regexError:
                //     "*Brand title is invalid.It accepts only characters",
                // minLengthError: "*Brand title should be minimum 4 characters",
                // maxLengthError: "*Brand title should be maximum 20 characters",
            },
        },

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
                requiredError: "*Brand Image is required",
                maxSizeError: "*Brand Image size should be less than 1mb",
                fileTypeError:
                    "*Brand Image should be of type jpg, jpeg or png",
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
                requiredError: "*Brand alt text is required",
                // regexError:
                //     "*Brand alt text is invalid.It accepts only characters",
                // minLengthError:
                //     "*Brand alt text should be minimum 3 characters",
                // maxLengthError:
                //     "*Brand alt text should be maximum 20 characters",
            },
        },
    ];

    $("#add-brands").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-brands").addClass("d-none");
            $("#add-brands").hide();
            $("#submit-brands").removeClass("d-none").addClass("d-block");
            $("#submit-brands").trigger("click");
        }
    });
});
