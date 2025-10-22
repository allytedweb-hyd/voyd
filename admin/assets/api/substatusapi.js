/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#projectStatus",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 50,
            },
            errors: {
                requiredError: "*Enter sub-status",
                // regexError: "*Invalid. It accepts only characters",
                // minLengthError: "*Field should be minimum 3 characters",
                // maxLengthError: "*Field should be maximum 50 characters",
            },
        },
        {
            element: "#statusMaster",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 50,
            },
            errors: {
                requiredError: "*Select a status",
                // regexError: "*Invalid. It accepts only characters",
                // minLengthError: "*Field should be minimum 3 characters",
                // maxLengthError: "*Field should be maximum 50 characters",
            },
        },
    ];

    console.log("validationsss---------------------", validationRules);

    $("#addSubStatus").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        console.log("validationsss---------------------", IsFormValid);

        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            $("#addSubStatus").hide();
            $("#submitSubStatus").show();
            $("#submitSubStatus").trigger("click");
        }
    });
});
