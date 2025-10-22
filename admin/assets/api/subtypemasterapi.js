/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#subtype",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Enter a sub type",
                // regexError: "*Sub Type is invalid. It accepts only characters",
                // minLengthError: "*Sub Type should be minimum 3 characters",
                // maxLengthError: "*Sub Type should be maximum 20 characters",
            },
        },
        {
            element: "#product",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select a product",
            },
        },
        {
            element: "#producttype",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select a product type",
            },
        },
        {
            element: "#recommend",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select a priority",
            },
        },
        // {
        //     element: "#strongly_recommend",
        //     rules: {
        //         required: true,
        //     },
        //     errors: {
        //         requiredError: "*Strongly Recommend is required",
        //     },
        // },
    ];

    $("#add-material").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-material").addClass("d-none");
            $("#add-material").hide();
            $("#submit-material").removeClass("d-none").addClass("d-block");
            $("#submit-material").trigger("click");
        }
    });
});
