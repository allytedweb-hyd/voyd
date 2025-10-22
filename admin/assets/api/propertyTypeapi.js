/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        // {
        //   element: "#property",
        //   rules: {
        //     required: true,
        //   },
        //   errors: {
        //     requiredError: "*Property is required",
        //   },
        // },

        {
            element: "#propertype",
            rules: {
                required: true,
                //   regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 30,
            },
            errors: {
                requiredError: "*Enter a property type",
                //   regexError: "*Property Type is invalid. It accepts only characters",
                // minLengthError: "*Property Type should be minimum 3 characters",
                // maxLengthError:
                //     "*Property Type should be maximum 30 characters",
            },
        },
    ];

    $("#add-propertyType").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-propertyType").addClass("d-none");
            $("#add-propertyType").hide();
            $("#submit-propertyType").removeClass("d-none").addClass("d-block");
            $("#submit-propertyType").trigger("click");
        }
    });
});
