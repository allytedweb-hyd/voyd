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
                requiredError: "*Enter first name",
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
                requiredError: "*Enter last name",
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
                requiredError: "*Enter valid email",
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
                requiredError: "*Select company type",
            },
        },

        {
            element: "#class",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select class",
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
                requiredError: "*Enter mobile number",
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
                requiredError: "*Enter company name",
            },
        },

        {
            element: "#stateId",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter state",
            },
        },

        {
            element: "#cityId",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter state",
            },
        },

        {
            element: "#locality",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter locality",
            },
        },

        {
            element: "#vendordesc",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter description",
            },
        },
    ];

    console.log("validationsss---------------------", validationRules);

    //     $("#add-vendor").click(function () {
    //         let IsFormValid = validateFormFields(validationRules);
    //         console.log("validationsss---------------------", IsFormValid);

    //         if (IsFormValid.length > 0) {
    //             swal.fire("Warning", "Enter Mandatory Fields", "warning");
    //             return;
    //         } else {
    //             $("#add-vendor").addClass("d-none");
    //             $("#submit-vendor").removeClass("d-none").addClass("d-block");
    //             $("#submit-vendor").trigger("click");
    //         }
    //     });
    // });

    $("#add-vendor").click(function () {
        let isFormValid = validateFormFields(validationRules);

        const aadhar = $("#aadhar").val().trim();
        const pancard = $("#pancard").val().trim();
        const gstno = $("#gstno").val().trim();

        if (isFormValid.length > 0) {
            Swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        }

        if (!aadhar && !pancard && !gstno) {
            Swal.fire(
                "Warning",
                "Aadhar, PAN, and GST are required",
                "warning"
            );
            return;
        }

        // $("#add-vendor").addClass("d-none");
        $("#add-vendor").hide();
        $("#submit-vendor").removeClass("d-none").addClass("d-block");
        $("#submit-vendor").trigger("click");
    });
});
