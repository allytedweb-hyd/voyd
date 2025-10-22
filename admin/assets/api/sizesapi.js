/* eslint-disable no-unused-vars */
/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#sizes",
            rules: {
                required: true,
                // regex: regexPatterns.alphaNumeric,
                // minLength: 2,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Dimensions is required",
                // regexError: "*Dimensions is invalid.",
                // minLengthError: "*Dimensions should be minimum 2 characters",
                // maxLengthError: "*Dimensions should be maximum 20 characters",
            },
        },
    ];

    $("#add-sizes").click(function (e) {
        let IsFormValid = validateFormFields(validationRules);
        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-sizes").addClass("d-none");
            $("#add-sizes").hide();
            $("#submit-sizes").removeClass("d-none").addClass("d-block");
            $("#submit-sizes").trigger("click");
        }
    });
});
