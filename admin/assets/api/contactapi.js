/* eslint-disable no-unused-vars */
/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#address",
            rules: {
                required: true,
                // regex: regexPatterns.alphaNumeric,
                minLength: 3,
                maxLength: 200,
            },
            errors: {
                requiredError: "*Address is required",
                // regexError: '*address is invalid. It accepts only characters',
                minLengthError: "*Address should be minimum 3 characters",
                maxLengthError: "*Address should be maximum 200 characters",
            },
        },

        {
            element: "#number",
            rules: {
                required: true,
                regex: regexPatterns.mobileregex,
                minLength: 10,
                maxLength: 10,
            },
            errors: {
                requiredError: "*Mobile number is required",
                regexError:
                    "*Mobile number is invalid. It accepts only numbers",
                minLengthError:
                    "*Mobile number should be minimum 10 characters",
                maxLengthError:
                    "*Mobile number should be maximum 10 characters",
            },
        },

        {
            element: "#altnumber",
            rules: {
                required: true,
                regex: regexPatterns.mobileregex,
                minLength: 10,
                maxLength: 10,
            },
            errors: {
                requiredError: "*Alternate number is required",
                regexError:
                    "*Alternate number is invalid. It accepts only numbers",
                minLengthError:
                    "*Alternate number should be minimum 10 characters",
                maxLengthError:
                    "*Alternate number should be maximum 10 characters",
            },
        },

        // {
        //   element: "#timings",
        //   rules: {
        //     required: true,
        //        regex: regexPatterns.alphaNumeric,
        //     minLength: 3,
        //     maxLength: 40,
        //   },
        //   errors: {
        //     requiredError: "*Timings is required",
        //        regexError: '*timings is invalid.',
        //     minLengthError: "*Timings should be minimum 3 characters",
        //     maxLengthError: "*Timings should be maximum 40 characters",
        //   },
        // },
    ];

    $("#add-contact").click(function (e) {
        let IsFormValid = validateFormFields(validationRules);
        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-contact").addClass("d-none");
            $("#add-contact").hide();
            $("#submit-contact").removeClass("d-none").addClass("d-block");
            $("#submit-contact").trigger("click");
        }
    });
});
