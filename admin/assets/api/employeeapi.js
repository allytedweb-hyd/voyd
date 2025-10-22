/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#employeeName",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 4,
                // maxLength: 50,
            },
            errors: {
                requiredError: "*Enter a name",
                // regexError: "*Name is invalid. It accepts only characters",
                // minLengthError: "*Name should be minimum 4 characters",
                // maxLengthError: "*Name should be maximum 50 characters",
            },
        },
        // {
        //     element: "#employeepassword",
        //     rules: {
        //         required: true,
        //         regex: regexPatterns.alphabetsregex,
        //         minLength: 4,
        //         maxLength: 50,
        //     },
        //     errors: {
        //         requiredError: "*Password is required",
        //         regexError: "*Name is invalid. It accepts only characters",
        //         minLengthError: "*Name should be minimum 4 characters",
        //         maxLengthError: "*Name should be maximum 50 characters",
        //     },
        // },
        {
            element: "#inputChoosePassword",
            rules: {
                required: true,

                minLength: 4,
                maxLength: 50,
            },
            errors: {
                requiredError: "*Enter a password",

                minLengthError: "*Password should be minimum 4 characters",
                maxLengthError: "*Password should be maximum 50 characters",
            },
        },
        {
            element: "#employeeconpassword",
            rules: {
                required: true,

                minLength: 4,
                maxLength: 50,
            },
            errors: {
                requiredError: "*Re enter password",

                minLengthError: "*Password should be minimum 4 characters",
                maxLengthError: "*Password should be maximum 50 characters",
            },
        },

        {
            element: "#employeeImage",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/jpg", "image/png", "image/jpeg"],
                resolutionWidth: 768,
                resolutionHeight: 600,
            },
            errors: {
                requiredError: "Provide an image",
                maxSizeError: "*Image size should be less than 1mb",
                fileTypeError: "*Image should be of type jpg, png or jpeg",
                resolutionError: "*Image should be 768 * 600px",
            },
        },

        {
            element: "#imgtext",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Enter image text",
                // regexError: "*Alt text is invalid. It accepts only characters",
                // minLengthError: "*Alt text should be minimum 3 characters",
                // maxLengthError: "*Alt text should be maximum 20 characters",
            },
        },

        {
            element: "#employeemail",
            rules: {
                required: true,
                regex: regexPatterns.emailregex,
            },
            errors: {
                requiredError: "*Enter a valid email address",
                regexError: "*Email is invaild. plz enter valid email",
            },
        },

        {
            element: "#employeeno",
            rules: {
                required: true,
                regex: regexPatterns.numbersregex,
                minLength: 10,
                maxLength: 10,
            },
            errors: {
                requiredError: "*Enter a valid mobile number",
                regexError:
                    "*Mobile number is invalid. It accepts only numbers",
                minLengthError:
                    "*Mobile number should be minimum 10 characters",
                maxLengthError:
                    "*Mobile number should be maximum 10 characters",
            },
        },

        {
            element: "#Department",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select a role",
            },
        },
        {
            element: "#employeeAddress",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Provide address",
            },
        },
    ];

    console.log("validationsss---------------------", validationRules);

    $("#add-employee").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        console.log("validationsss---------------------", IsFormValid);

        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            $("#add-employee").hide();
            $("#submit-employee").show();
            $("#submit-employee").trigger("click");
        }
    });
});
