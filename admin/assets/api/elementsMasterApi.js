/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#eleName",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 2,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Enter an element",
                // regexError: "*Element is Invalid. It accepts only characters",
                // minLengthError: "*Element should be minimum 2 characters",
                // maxLengthError: "*Element should be maximum 20 characters",
            },
        },
        {
            element: "#eleBlock",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select a property block",
            },
        },
    ];

    $("#addEleMaster").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#addEleMaster").addClass("d-none");
            $("#addEleMaster").hide();
            $("#submitEleMaster").removeClass("d-none").addClass("d-block");
            $("#submitEleMaster").trigger("click");
        }
    });
});
