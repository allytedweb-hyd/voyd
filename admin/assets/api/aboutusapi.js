/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#founder",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
            },
            errors: {
                requiredError: "*Enter name",
                // regexError: "*Name is invalid. It accepts only characters",
            },
        },

        {
            element: "#founder-image",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Provide image",
            },
        },
        {
            element: "#founder-image-alt",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter image text",
            },
        },
        {
            element: "#adesc",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter description",
            },
        },
    ];

    console.log("validationsss---------------------", validationRules);

    $("#add-aboutus").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        console.log("validationsss---------------------", IsFormValid);

        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-aboutus").addClass("d-none");
            $("#add-aboutus").hide();
            $("#submit-aboutus").removeClass("d-none").addClass("d-block");
            $("#submit-aboutus").trigger("click");
        }
    });
});
