/* eslint-disable no-undef */

$(document).ready(function () {
    let validationRules = [
        {
            element: "#property",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 30,
            },
            errors: {
                requiredError: "*Enter a property",
                // regexError: "*Property is invalid. It accepts only characters",
                // minLengthError: "*Property should be minimum 3 characters",
                // maxLengthError: "*Property should be maximum 30 characters",
            },
        },
    ];

    $("#add-property").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-property").addClass("d-none");
            $("#add-property").hide();
            $("#submit-property").removeClass("d-none").addClass("d-block");
            $("#submit-property").trigger("click");
        }
    });
});
