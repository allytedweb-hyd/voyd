$(document).ready(function () {
    let validationRules = [
        {
            element: "#ProductType",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 4,
                // maxLegth: 20,
            },
            errors: {
                requiredError: "*Enter a product type",
                // regexError:
                //     "*Product type is invalid. It accepts only characters",
                // minLengthError: "*Product type should be minimum 4 characters",
                // maxLengthError: "*Product type should be maximum 20 characters",
            },
        },
    ];

    $("#add-ProductType").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-ProductType").addClass("d-none");
            $("#add-ProductType").hide();
            $("#submit-ProductType").removeClass("d-none").addClass("d-block");
            $("#submit-ProductType").trigger("click");
        }
    });
});
