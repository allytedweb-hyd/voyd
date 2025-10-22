/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#Bannertitle",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 4,
                // maxLength: 50,
            },
            errors: {
                requiredError: "*Banner title should be required",
                // regexError:
                //     "*Banner title is invalid. It accepts only characters",
                // minLengthError: "*Banner title should be minimum 4 characters",
                // maxLengthError: "*Banner title should be maximum 50 characters",
            },
        },

        {
            element: "#bannerimage",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/jpg", "image/png", "image/jpeg"],
                // resolutionWidth: 1519,
                // resolutionHeight: 720,
            },
            errors: {
                requiredError: "*Banner image should required",
                maxSizeError: "*Banner image size should be less than 1mb",
                fileTypeError:
                    "*Banner image should be of type jpg, png or jpeg",
                // resolutionError: "*Image should be 1519 * 720px",
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
                requiredError: "*Banner alt text should be required",
                // regexError:
                //     "*Banner alt text is invalid. It accepts only characters",
                // minLengthError:
                //     "*Banner alt text should be minimum 3 characters",
                // maxLengthError:
                //     "*Banner alt text should be maximum 20 characters",
            },
        },

        {
            element: "#bdesc",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Banner description should be required",
            },
        },

        {
            element: "#Odesc",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Offer description should be required",
            },
        },

        {
            element: "#offer",
            rules: {
                required: true,
                // regex: regexPatterns.alphaNumeric,
                // minLength: 2,
                // maxLength: 10,
            },
            errors: {
                requiredError: "*Offer price should be required",
                // regexError: "*Offer price is invalid. It accepts only numbers",
                // minLengthError: "*Offer price should be minimum 2 characters",
                // maxLengthError: "*Offer price should be maximum 10 characters",
            },
        },
    ];

    console.log("validationsss---------------------", validationRules);

    $("#add-banner").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        console.log("validationsss---------------------", IsFormValid);

        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            $("#add-banner").hide();
            $("#submit-banner").show();
            $("#submit-banner").trigger("click");
        }
    });
});
