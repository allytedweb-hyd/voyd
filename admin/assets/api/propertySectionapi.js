/* eslint-disable no-undef */

$(document).ready(function () {
    let validationRules = [
        // {
        //   element: "#property",
        //   rules: {
        //     required: true,
        //   },
        //   errors: {
        //     requiredError: "*Property is required",
        //   },
        // },

        {
            element: "#image",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/jpg", "image/png", "image/jpeg"],
            },
            errors: {
                requiredError: "*Provide a image",
                maxSizeError: "* image should be less than 1mb",
                fileTypeError: "* image should be type of jpg, png or jpeg",
            },
        },

        {
            element: "#alt_text",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter image text",
            },
        },

        {
            element: "#PropertySection",
            rules: {
                required: true,
                //   regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 30,
            },
            errors: {
                requiredError: "*Enter a property block",
                //   regexError: "*Property Section is invalid. It accepts only characters",
                // minLengthError:
                //     "*Property Section should be minimum 3 characters",
                // maxLengthError:
                //     "*Property Section should be maximum 30 characters",
            },
        },
    ];

    $("#add-propertySections").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-propertySections").addClass("d-none");
            $("#add-propertySections").hide();
            $("#submit-propertySections")
                .removeClass("d-none")
                .addClass("d-block");
            $("#submit-propertySections").trigger("click");
        }
    });
});
