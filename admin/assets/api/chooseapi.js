/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#chooseTitle",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 4,
                // maxLength: 50,
            },
            errors: {
                requiredError: "*Title should be required",
                // regexError: "*Title is invalid. It accepts only characters",
                // minLengthError: "*Title should be minimum 4 characters",
                // maxLengthError: "*Title should be maximum 50 characters",
            },
        },

        {
            element: "#chooseimage",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/jpg", "image/png", "image/jpeg"],
                resolutionWidth: 768,
                resolutionHeight: 600,
            },
            errors: {
                requiredError: "*Image should required",
                maxSizeError: "*Image size should be less than 1mb",
                fileTypeError: "*Image should be of type jpg, png or jpeg",
                resolutionError: "*Image should be 768 * 600px",
            },
        },

        {
            element: "#choosealt",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 2,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Alt text should be required",
                // regexError: "*Alt text is invalid. It accepts only characters",
                // minLengthError: "*Alt text should be minimum 2 characters",
                // maxLengthError: "*Alt text should be maximum 20 characters",
            },
        },

        {
            element: "#choosedesc",
            rules: {
                required: true,
                maxLength: 110,
            },
            errors: {
                requiredError: "*Description should be required",
                maxLengthError: "*Description should be maximum 110 characters",
            },
        },
    ];

    console.log("validationsss---------------------", validationRules);

    $("#add-chooseus").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        console.log("validationsss---------------------", IsFormValid);

        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            $("#add-chooseus").hide();
            $("#submit-chooseus").show();
            $("#submit-chooseus").trigger("click");
        }
    });
});
