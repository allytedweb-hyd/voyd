/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#main_heading",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 15,
            },
            errors: {
                requiredError: "*Enter heading",
                // regexError: "*Name is invalid. It accepts only characters",
                // minLengthError: "*Name should be minimum 3 characters",
                // maxLengthError: "*Name should be maximum 15 characters",
            },
        },

        {
            element: "#image",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/jpg", "image/png", "image/jpeg"],
                resolutionWidth: 1000,
                resolutionHeight: 1020,
            },
            errors: {
                requiredError: "*Provide an image",
                maxSizeError: "*image should be less than 1mb",
                fileTypeError: "*image should be of type jpg, png or jpeg",
                resolutionError: "*Image should be 768 * 600px",
            },
        },

        {
            element: "#sub_heading",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Mention sub heading",
                // regexError:
                //     "*Sub Heading alt text is invaid.It accepts only characters",
                // minLengthError: "*Sub Heading should be minimum 3 characters",
                // maxLengthError: "*Sub Heading should be maximum 20 characters",
            },
        },
        {
            element: "#img_alt_text",
            rules: {
                required: true,
                regex: regexPatterns.alphabetsregex,
            },
            errors: {
                requiredError: "*Enter image text",
                regexError: "*Alt Text is invaid.It accepts only characters",
            },
        },

        {
            element: "#offer",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter offer",
            },
        },
        {
            element: "#promo",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select a code",
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
