/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#producType",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Product Type is required",
            },
        },

        {
            element: "#category",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Category is required",
            },
        },

        {
            element: "#subcategory",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 30,
            },
            errors: {
                requiredError: "*Subcategory is required",
                // regexError:
                //     "*Subcategory is invalid. It accepts only characters",
                // minLengthError: "*Subcategory should be minimum 3 characters",
                // maxLengthError: "*Subcategory should be maximum 30 characters",
            },
        },
    ];

    $("#add-subcategory").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-subcategory").addClass("d-none");
            $("#add-subcategory").hide();
            $("#submit-subcategory").removeClass("d-none").addClass("d-block");
            $("#submit-subcategory").trigger("click");
        }
    });
});
