/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#material",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Enter material name",
                // regexError: "*Material is invalid. It accepts only characters",
                // minLengthError: "*Material should be minimum 3 characters",
                // maxLengthError: "*Material should be maximum 20 characters",
            },
        },
    ];

    $("#add-material").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-material").addClass("d-none");
            $("#add-material").hide();
            $("#submit-material").removeClass("d-none").addClass("d-block");
            $("#submit-material").trigger("click");
        }
    });
});
