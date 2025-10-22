/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        // {
        //     element: "#maker_icon_default",
        //     rules: {
        //         required: true,
        //         maxSize: 1 * 1024 * 1024,
        //         fileTypes: ["image/jpg", "image/png", "image/jpeg"],
        //         resolutionWidth: 768,
        //         resolutionHeight: 600,
        //     },
        //     errors: {
        //         requiredError: "*Provide an maker icon",
        //         maxSizeError: "*Maker Icon size should be less than 1mb",
        //         fileTypeError: "*Maker Icon should be of type jpg, jpeg or png",
        //         resolutionError: "*Maker Icon should be 768 * 600px",
        //     },
        // },
        // {
        //     element: "#material_icon_default",
        //     rules: {
        //         required: true,
        //         maxSize: 1 * 1024 * 1024,

        //         fileTypes: ["image/jpg", "image/png", "image/jpeg"],
        //         resolutionWidth: 768,
        //         resolutionHeight: 600,
        //     },
        //     errors: {
        //         requiredError: "*Provide an material icon",
        //         maxSizeError: "*Material Icon size should be less than 1mb",
        //         fileTypeError:
        //             "*Material Icon should be of type jpg, jpeg or png",
        //         resolutionError: "*Material Icon should be 768 * 600px",
        //     },
        // },

        {
            element: "#material_classification",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select a material classification",
            },
        },

        {
            element: "#maker_classification",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select a maker classification",
            },
        },

        {
            element: "#maker_text",
            rules: {
                required: true,

                minLength: 3,
                maxLength: 100,
            },
            errors: {
                requiredError: "*Enter maker text",

                minLengthError: "*Maker text should be minimum 3 characters",
                maxLengthError: "*Maker text should be maximum 100 characters",
            },
        },

        {
            element: "#material_text",
            rules: {
                required: true,

                minLength: 3,
                maxLength: 100,
            },
            errors: {
                requiredError: "*Enter material text",

                minLengthError: "*Material Text should be minimum 3 characters",
                maxLengthError:
                    "*Material Text should be maximum 100 characters",
            },
        },
        {
            element: "#project_cost",
            rules: {
                required: true,

                // minLength: 3,
                // maxLength: 30,
            },
            errors: {
                requiredError: "*Project cost is missing ex.1.2 , 0.45 lacks",

                // minLengthError: "*Project Cost should be minimum 3 characters",
                // maxLengthError:
                //     "*Project Cost should be maximum 30 characters",
            },
        },
    ];

    $("#add-gallery").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-gallery").addClass("d-none");
            $("#add-gallery").hide();
            $("#submit-gallery").removeClass("d-none").addClass("d-block");
            $("#submit-gallery").trigger("click");
        }
    });
});
