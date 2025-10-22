/* eslint-disable no-undef */

$(document).ready(function () {
    let validationRules = [
        {
            element: "#productType",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select product type",
            },
        },

        {
            element: "#category",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 30,
            },
            errors: {
                requiredError: "*Enter a category",
                // regexError: "*Category is invalid. It accepts only characters",
                // minLengthError: "*Category should be minimum 3 characters",
                // maxLengthError: "*Category should be maximum 30 characters",
            },
        },
    ];

    $("#add-category").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-category").addClass("d-none");
            $("#add-category").hide();
            $("#submit-category").removeClass("d-none").addClass("d-block");
            $("#submit-category").trigger("click");
        }
    });
});
