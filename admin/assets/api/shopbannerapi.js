/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#Sbannerimage",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/jpg", "image/png", "image/jpeg"],
                resolutionWidth: 768,
                resolutionHeight: 600,
            },
            errors: {
                requiredError: "*Provide a banner",
                maxSizeError: "*Banner image should be less than 1mb",
                fileTypeError:
                    "*Banner image should be type of jpg, png or jpeg",
                resolutionError: "*Image should be 768 * 600px",
            },
        },

        {
            element: "#banneralttext",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Enter banner text",
                // regexError:
                //     "*Banner alt text is invalid. It accepts only characters",
                // minLengthError:
                //     "*Banner alt text should be minimum 3 characters",
                // maxLengthError:
                //     "*Banner alt text should be maximum 20 characters",
            },
        },
    ];

    $("#add-sbanner").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-sbanner").addClass("d-none");
            $("#add-sbanner").hide();
            $("#submit-sbanner").removeClass("d-none").addClass("d-block");
            $("#submit-sbanner").trigger("click");
        }
    });
});
