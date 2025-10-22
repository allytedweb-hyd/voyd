/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#colorcode",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Enter a code",
                // regexError: "*Color is invalid. It accepts only characters",
                // minLengthError: "*Color should be minimum 3 characters",
                // maxLengthError: "*Color should be maximum 20 characters",
            },
        },
        {
            element: "#colorShade",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Enter a shade",
                // regexError: "*Color is invalid. It accepts only characters",
                // minLengthError: "*Color should be minimum 3 characters",
                // maxLengthError: "*Color should be maximum 20 characters",
            },
        },
    ];

    $("#add-color").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-color").addClass("d-none");
            $("#add-color").hide();
            $("#submit-color").removeClass("d-none").addClass("d-block");
            $("#submit-color").trigger("click");
        }
    });
});
