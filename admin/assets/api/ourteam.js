/* eslint-disable no-unused-vars */
/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#name",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Enter name",
                // regexError: "*Name is Invalid. It accepts only characters",
                // minLengthError: "*Name should be minimum 3 characters",
                // maxLengthError: "*Name should be maximum 20 characters",
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
                requiredError: "*Provide image",
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
            element: "#designation",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Enter designation",
                // regexError:
                //     "*Designation is invalid.It accepts only characters",
                // minLengthError: "*Designation should be minimum 3 characters",
                // maxLengthError: "*Designation should be maximum 20 characters",
            },
        },

        // {
        //     element: "#mailLink",
        //     rules: {
        //         required: true,
        //     },
        //     errors: {
        //         requiredError: "*Enter mail link",
        //     },
        // },

        // {
        //     element: "#facebooklink",
        //     rules: {
        //         required: true,
        //     },
        //     errors: {
        //         requiredError: "*Enter facebook link",
        //     },
        // },

        // {
        //     element: "#twitterlink",
        //     rules: {
        //         required: true,
        //     },
        //     errors: {
        //         requiredError: "*Enter twitter link",
        //     },
        // },

        // {
        //     element: "#instagramlink",
        //     rules: {
        //         required: true,
        //     },
        //     errors: {
        //         requiredError: "*Enter instagram link",
        //     },
        // },

        {
            element: "#ourdescr",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter description",
            },
        },
    ];

    console.log("validationsss---------------------", validationRules);

    $("#add-team").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        console.log("validationsss---------------------", IsFormValid);

        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-team").addClass("d-none");
            $("#add-team").hide();
            $("#submit-team").removeClass("d-none").addClass("d-block");
            $("#submit-team").trigger("click");
        }
    });
});
