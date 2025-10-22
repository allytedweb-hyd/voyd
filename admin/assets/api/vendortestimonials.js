/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#name",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select name",
            },
        },
        {
            element: "#testimonial_name",
            rules: {
                required: true,
                regex: regexPatterns.alphabetsregex,
            },
            errors: {
                requiredError: "*Enter name",
                regexError: "*Alt text is invalid. It accepts only characters",
            },
        },

        {
            element: "#image",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/jpg", "image/png", "image/jpeg"],
                resolutionWidth: 1000,
                resolutionHeight: 1020,
            },
            errors: {
                requiredError: "*Provide an image",
                maxSizeError: "*image should be less than 1mb",
                fileTypeError: "*image should be of type jpg, png or jpeg",
                resolutionError: "*Image should be 768 * 600px",
            },
        },

        {
            element: "#reviewdesc",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter description",
            },
        },
    ];

    console.log("validationsss---------------------", validationRules);

    $("#add-blog").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        console.log("validationsss---------------------", IsFormValid);

        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-blog").addClass("d-none");
            $("#add-blog").hide();
            $("#submit-blog").removeClass("d-none").addClass("d-block");
            $("#submit-blog").trigger("click");
        }
    });
});
