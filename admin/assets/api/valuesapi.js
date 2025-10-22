/* eslint-disable no-undef */

$(document).ready(function () {
    let validationRules = [
        {
            element: "#producType",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select a product type",
            },
        },

        {
            element: "#category",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select a category",
            },
        },

        {
            element: "#subcategory",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select a sub category",
            },
        },

        {
            element: "#attribute",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select a attribute",
            },
        },

        {
            element: "#values",
            rules: {
                required: true,
                regex: regexPatterns.numbersregex,
                minLength: 2,
                maxLength: 30,
            },
            errors: {
                requiredError: "*Enter value",
                regexError: "*Value is invalid. It accepts only numbers",
                minLengthError: "*Value should be minimum 2 characters",
                maxLengthError: "*Value should be maximum 30 characters",
            },
        },
    ];

    $("#add-values").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-values").addClass("d-none");
            $("#add-values").hide();
            $("#submit-values").removeClass("d-none").addClass("d-block");
            $("#submit-values").trigger("click");
        }
    });
});
