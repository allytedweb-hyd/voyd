/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#name",
            rules: {
                required: true,
                regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Enter name",
                regexError: "*Name is invalid. It accepts only characters",
                // minLengthError: "*Name should be minimum 3 characters",
                // maxLengthError: "*Name should be maximum 20 characters",
            },
        },

        {
            element: "#email",
            rules: {
                required: true,
                regex: regexPatterns.emailregex,
            },
            errors: {
                requiredError: "*Enter valid email",
                regexError: "*Email is invaild. plz enter valid email",
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
                requiredError: "*Enter contact number",
                regexError:
                    "*Contact number is invalid. It accepts only numbers",
                minLengthError:
                    "*Contact number should be minimum 10 characters",
                maxLengthError:
                    "*Contact number should be maximum 10 characters",
            },
        },

        {
            element: "#Phone1",
            rules: {
                required: true,
                regex: regexPatterns.numbersregex,
                minLength: 10,
                maxLength: 10,
            },
            errors: {
                requiredError: "*Enter contact number",
                regexError:
                    "*Contact number is invalid. It accepts only numbers",
                minLengthError:
                    "*Contact number should be minimum 10 characters",
                maxLengthError:
                    "*Contact number should be maximum 10 characters",
            },
        },

        {
            element: "#aadhar",
            rules: {
                required: true,
                regex: regexPatterns.numbersregex,
                minLength: 12,
                maxLength: 12,
            },
            errors: {
                requiredError: "*Enter aadhar number",
                regexError:
                    "*Aadhar number is invalid. It accepts only numbers",
                minLengthError:
                    "*Aadhar number should be minimum 12 characters",
                maxLengthError:
                    "*Aadhar number should be maximum 12 characters",
            },
        },

        {
            element: "#website",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
            },
            errors: {
                requiredError: "*Enter website url",
                // regexError:
                //     "*Website url is invalid. It accepts only characters",
            },
        },

        {
            element: "#location",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Enter location",
                // regexError: "*Location is invalid. It accepts only characters",
                // minLengthError: "*Location should be minimum 3 characters",
                // maxLengthError: "*Location should be maximum 50 characters",
            },
        },

        {
            element: "#gstnumber",
            rules: {
                required: true,
                // regex: regexPatterns.alphaNumeric,
                minLength: 15,
                maxLength: 15,
            },
            errors: {
                requiredError: "*Enter gst number",
                // regexError: 'gst number is invalid.',
                minLengthError: "gst number should be 15 characters",
                maxLengthError: "gst number should be 15 characters",
            },
        },

        {
            element: "#manuproducType",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select a product type",
            },
        },

        {
            element: "#class",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select a classification",
            },
        },

        {
            element: "#characteristics",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select a characteristics",
            },
        },

        {
            element: "#attributes",
            rules: {
                required: true,
                notDefault: true,
            },
            errors: {
                requiredError: "*Select a attribute",
                notDefaultError: "*You must choose a valid attribute",
            },
        },

        {
            element: "#manuvalue",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select a value",
            },
        },
        {
            element: "#editor",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter address",
            },
        },
    ];

    $("#add-manufacturer").click(function () {
        console.log("Selected Attribute:", $("#attributes").val());

        let IsFormValid = validateFormFields(validationRules);

        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-manufacturer").addClass("d-none");
            $("#add-manufacturer").hide();
            $("#submit-manufacturer").removeClass("d-none").addClass("d-block");
            $("#submit-manufacturer").trigger("click");
        }
    });
});
