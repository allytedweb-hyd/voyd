/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#TaskName",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 2,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Enter a task",
                // regexError: "*Task is invalid. It accepts only characters",
                // minLengthError: "*Task should be minimum 2 characters",
                // maxLengthError: "*Task should be maximum 20 characters",
            },
        },
    ];

    $("#add-task").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-task").addClass("d-none");
            $("#add-task").hide();
            $("#submit-task").removeClass("d-none").addClass("d-block");
            $("#submit-task").trigger("click");
        }
    });
});
