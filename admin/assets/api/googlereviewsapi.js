/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#name",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 15,
            },
            errors: {
                requiredError: "*Select a name",
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
                requiredError: "*Provide image",
                maxSizeError: "*image should be less than 1mb",
                fileTypeError: "*image should be of type jpg, png or jpeg",
                resolutionError: "*Image should be 768 * 600px",
            },
        },

        {
            element: "#location",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Enter location",
                // regexError:
                //     "*location alt text is invaid.It accepts only characters",
                // minLengthError: "*location should be minimum 3 characters",
                // maxLengthError: "*location should be maximum 20 characters",
            },
        },
        {
            element: "#review_name",
            rules: {
                required: true,
                regex: regexPatterns.alphabetsregex,
            },
            errors: {
                requiredError: "*Enter reviewer name",
                regexError:
                    "*Reviewer Name is invaid.It accepts only characters",
            },
        },

        {
            element: "#reviewdesc",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter a description",
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
