/* eslint-disable no-undef */

$(document).ready(function () {
    let validationRules = [
        {
            element: "#brand",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,

                // minLength: 3,
                // maxLength: 30,
            },
            errors: {
                requiredError: "*Enter a name",
                // regexError: "*Brand is invalid. It accepts only characters",
                // minLengthError: "*Brand should be minimum 3 characters",
                // maxLengthError: "*Brand should be maximum 30 characters",
            },
        },
    ];

    $("#add-brand").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-brand").addClass("d-none");
            $("#add-brand").hide();
            $("#submit-brand").removeClass("d-none").addClass("d-block");
            $("#submit-brand").trigger("click");
        }
    });
});
