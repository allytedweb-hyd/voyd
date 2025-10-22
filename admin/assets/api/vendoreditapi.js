/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#FirstName",
            rules: {
                required: true,
                regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 25,
            },
            errors: {
                requiredError: "*First name is required",
                regexError:
                    "*First name is invalid. It accepts only characters",
                // minLengthError: "*First name should be minimum 3 characters",
                // maxLengthError: "*First name should be maximum 25 characters",
            },
        },

        {
            element: "#LastName",
            rules: {
                required: true,
                regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Last name is required",
                regexError: "*Last name is invalid. It accepts only characters",
                // minLengthError: "*Last name should be minimum 3 characters",
                // maxLengthError: "*Last name should be maximum 20 characters",
            },
        },

        {
            element: "#email",
            rules: {
                required: true,
                regex: regexPatterns.emailregex,
            },
            errors: {
                requiredError: "*Email is required",
                regexError: "*Email is invaild. plz enter valid email",
            },
        },

        // {
        //     element: "#gstno",
        //     rules: {
        //         required: true,
        //         regex: regexPatterns.alphaNumeric,
        //     },
        //     errors: {
        //         requiredError: "*Gst number is required",
        //         regexError: "*Gst number is invaild. plz enter valid number",
        //     },
        // },

        {
            element: "#company",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Company type is required",
            },
        },

        {
            element: "#class",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Class is required",
            },
        },

        {
            element: "#Phone",
            rules: {
                required: true,
                regex: regexPatterns.numbersregex,
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

        // {
        //     element: "#aadhar",
        //     rules: {
        //         required: true,
        //         regex: regexPatterns.numbersregex,
        //         minLength: 12,
        //         maxLength: 12,
        //     },
        //     errors: {
        //         requiredError: "*Aadhar number is required",
        //         regexError:
        //             "*Aadhar number is invalid. It accepts only numbers",
        //         minLengthError:
        //             "*Aadhar number should be minimum 12 characters",
        //         maxLengthError:
        //             "*Aadhar number should be maximum 12 characters",
        //     },
        // },

        // {
        //     element: "#pancard",
        //     rules: {
        //         required: true,
        //     },
        //     errors: {
        //         requiredError: "*Pancard number is required",
        //     },
        // },

        {
            element: "#companyname",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Company Name is required",
            },
        },

        {
            element: "#stateId",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*State is required",
            },
        },

        {
            element: "#cityId",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*City is required",
            },
        },

        {
            element: "#locality",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Locality is required",
            },
        },

        {
            element: "#vendordesc",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Description is required",
            },
        },
    ];

    console.log("validationsss---------------------", validationRules);

    $("#add-vendor").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        console.log("validationsss---------------------", IsFormValid);

        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-vendor").addClass("d-none");
            $("#add-vendor").hide();
            $("#submit-vendor").removeClass("d-none").addClass("d-block");
            $("#submit-vendor").trigger("click");
        }
    });
});
