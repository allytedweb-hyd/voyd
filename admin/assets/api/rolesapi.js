/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#empRole",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 50,
            },
            errors: {
                requiredError: "*Enter a role",
                // regexError: "*Name is invalid. It accepts only characters",
                // minLengthError: "*Name should be minimum 3 characters",
                // maxLengthError: "*Name should be maximum 50 characters",
            },
        },
    ];

    console.log("validationsss---------------------", validationRules);

    $("#add-role").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        console.log("validationsss---------------------", IsFormValid);

        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            $("#add-role").hide();
            $("#submit-role").show();
            $("#submit-role").trigger("click");
        }
    });
});
