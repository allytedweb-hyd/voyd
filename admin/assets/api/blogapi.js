/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#title",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 4,
                // maxLength: 80,
            },
            errors: {
                requiredError: "*Blog title is required",
                // regexError:
                //     "*Blog title is invalid. It accepts only characters",
                // minLengthError: "*Blog title should be minimum 4 characters",
                // maxLengthError: "*Blog title should be maximum 80 characters",
            },
        },

        {
            element: "#author",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 4,
                // maxLength: 80,
            },
            errors: {
                requiredError: "*Aurhor is required",
                // regexError: "*Aurhor is invalid. It accepts only characters",
                // minLengthError: "*Aurhor should be minimum 4 characters",
                // maxLengthError: "*Aurhor should be maximum 80 characters",
            },
        },

        {
            element: "#comments",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Comments  is required",
            },
        },
        {
            element: "#link",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Link  is required",
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
                requiredError: "*Blog image is required",
                maxSizeError: "*Blog image should be less than 1mb",
                fileTypeError: "*Blog image should be of type jpg, png or jpeg",
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
                requiredError: "*Blog alt text is required",
                // regexError:
                //     "*Blog alt text is invaid.It accepts only characters",
                // minLengthError: "*Blog alt text should be minimum 3 characters",
                // maxLengthError:
                //     "*Blog alt text should be maximum 20 characters",
            },
        },

        {
            element: "#blogdesc",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Description is required",
            },
        },
    ];

    console.log("validationsss---------------------", validationRules);

    $("#add-blog").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        console.log("validationsss---------------------", IsFormValid);

        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-blog").addClass("d-none");
            $("#add-blog").hide();
            $("#submit-blog").removeClass("d-none").addClass("d-block");
            $("#submit-blog").trigger("click");
        }
    });
});
