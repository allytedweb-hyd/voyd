/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#prevProjectTitle",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 4,
                // maxLength: 60,
            },
            errors: {
                requiredError: "*Title is required",
                // regexError: "*Title is invalid. It accepts only characters",
                // minLengthError: "*Title should be minimum 2 characters",
                // maxLengthError: "*Title should be maximum 60 characters",
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
                requiredError: "*Image is required",
                maxSizeError: "*Image should be less than 1mb",
                fileTypeError: "*Image should be type of jpg, png or jpeg",
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
                requiredError: "*Alt text is required",
                // regexError: "*Alt text is invalid. It accepts only characters",
                // minLengthError: "*Alt text should be minimum 3 characters",
                // maxLengthError: "*Alt text should be maximum 20 characters",
            },
        },

        {
            element: "#projectdesc",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Description is required",
            },
        },
    ];

    console.log("validationsss---------------------", validationRules);

    $("#add-project").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        console.log("validationsss---------------------", IsFormValid);

        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-project").addClass("d-none");
            $("#add-project").hide();
            $("#submit-project").removeClass("d-none").addClass("d-block");
            $("#submit-project").trigger("click");
        }
    });
});
