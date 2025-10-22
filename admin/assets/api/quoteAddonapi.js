/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#queId",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter Questionnaire Id",
            },
        },

        {
            element: "#custId",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter Customer Id",
            },
        },

        {
            element: "#projName",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter Project Name",
            },
        },

        {
            element: "#projClass",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter Project Class",
            },
        },

        {
            element: "#custName",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter Customer Name",
            },
        },

        {
            element: "#venName",
            rules: {
                required: true,
                regex: regexPatterns.alphabetsregex,
                minLength: 3,
                maxLength: 20,
            },
            errors: {
                requiredError: "*Enter Vendor name",
                regexError:
                    "*Vendor name is invalid. It accepts only characters",
                minLengthError: "*Vendor name should be minimum 3 characters",
                maxLengthError: "*Vendor name should be maximum 20 characters",
            },
        },
        {
            element: "#cost",
            rules: {
                required: true,
                regex: regexPatterns.numbersregex,
            },
            errors: {
                requiredError: "*Provide Cost",
                regexError: "*It accepts only numbers",
            },
        },

        {
            element: "#ItemName",
            rules: {
                required: true,
                regex: regexPatterns.alphabetsregex,
                minLength: 2,
                maxLength: 20,
            },
            errors: {
                requiredError: "*Provide Item name",
                regexError: "*Item name is invalid. It accepts only characters",
                minLengthError: "*Item name should be minimum 3 characters",
                maxLengthError: "*Item name should be maximum 20 characters",
            },
        },

        {
            element: "#ItemCode",
            rules: {
                required: true,
                // regex: regexPatterns.alphaNumeric,
                minLength: 2,
                maxLength: 10,
            },
            errors: {
                requiredError: "*Provide Item code",
                // regexError: "*Item code is invalid. It accepts only numbers",
                minLengthError: "*Item code should be minimum 2 characters",
                maxLengthError: "*Item code should be maximum 10 characters",
            },
        },

        {
            element: "#quant",
            rules: {
                required: true,
                regex: regexPatterns.numbersregex,
            },
            errors: {
                requiredError: "*Provide Quantity",
                regexError: "*Quantity is invalid.It accepts only numbers",
            },
        },
    ];

    console.log("validationsss---------------------", validationRules);

    $("#add-Addon").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        console.log("validationsss---------------------", IsFormValid);

        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-Addon").addClass("d-none");
            $("#add-Addon").hide();
            $("#submit-Addon").removeClass("d-none").addClass("d-block");
            $("#submit-Addon").trigger("click");
        }
    });
});
