/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#promo",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Enter a promo code",
                // regexError: "*Unit is invalid. It accepts only characters",
                // minLengthError: "*Unit should be minimum 3 characters",
                // maxLengthError: "*Unit should be maximum 20 characters",
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
