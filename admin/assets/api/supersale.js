/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#offer",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter offer",
            },
        },
        {
            element: "#start_date",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter start date",
            },
        },
        {
            element: "#star_time",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter start time",
            },
        },
        {
            element: "#end_date",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter end date",
            },
        },
        {
            element: "#end_time",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter end time",
            },
        },
    ];

    $("#add-sale").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-material").addClass("d-none");
            $("#add-sale").hide();
            $("#submit-sale").removeClass("d-none").addClass("d-block");
            $("#submit-sale").trigger("click");
        }
    });
});
