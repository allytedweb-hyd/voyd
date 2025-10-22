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
                //   regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 30,
            },
            errors: {
                requiredError: "*Enter a attribute",
                //   regexError: "Attribute is invalid. It accepts only characters",
                // minLengthError: "*Attribute should be minimum 3 characters",
                // maxLengthError: "*Attribute should be maximum 30 characters",
            },
        },
    ];

    $("#add-attributes").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-attributes").addClass("d-none");
            $("#add-attributes").hide();
            $("#submit-attributes").removeClass("d-none").addClass("d-block");
            $("#submit-attributes").trigger("click");
        }
    });
});
