/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#product",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select a product",
            },
        },
        {
            element: "#color",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select a color",
            },
        },
        {
            element: "#material",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select a material",
            },
        },
        {
            element: "#qantity",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter quantity",
            },
        },
        {
            element: "#size",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select a size",
            },
        },

        {
            element: "#image",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/jpg", "image/png", "image/jpeg"],
                resolutionWidth: 768,
                resolutionHeight: 600,
            },
            errors: {
                requiredError: "*Provide an image",
                maxSizeError: "*Category image size should be less than 1mb",
                fileTypeError:
                    "*Category image should be of type jpg, png or jpeg",
                resolutionError: "*Image should be 768 * 600px",
            },
        },
        {
            element: "#image2",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/jpg", "image/png", "image/jpeg"],
                resolutionWidth: 768,
                resolutionHeight: 600,
            },
            errors: {
                requiredError: "*Provide an image",
                maxSizeError: "*Category image size should be less than 1mb",
                fileTypeError:
                    "*Category image should be of type jpg, png or jpeg",
                resolutionError: "*Image should be 768 * 600px",
            },
        },
        {
            element: "#image3",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/jpg", "image/png", "image/jpeg"],
                resolutionWidth: 768,
                resolutionHeight: 600,
            },
            errors: {
                requiredError: "*Provide an image",
                maxSizeError: "*Category image size should be less than 1mb",
                fileTypeError:
                    "*Category image should be of type jpg, png or jpeg",
                resolutionError: "*Image should be 768 * 600px",
            },
        },
        {
            element: "#image4",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/jpg", "image/png", "image/jpeg"],
                resolutionWidth: 768,
                resolutionHeight: 600,
            },
            errors: {
                requiredError: "*Provide an image",
                maxSizeError: "*Category image size should be less than 1mb",
                fileTypeError:
                    "*Category image should be of type jpg, png or jpeg",
                resolutionError: "*Image should be 768 * 600px",
            },
        },
        {
            element: "#image5",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/jpg", "image/png", "image/jpeg"],
                resolutionWidth: 768,
                resolutionHeight: 600,
            },
            errors: {
                requiredError: "*Provide an image",
                maxSizeError: "*Category image size should be less than 1mb",
                fileTypeError:
                    "*Category image should be of type jpg, png or jpeg",
                resolutionError: "*Image should be 768 * 600px",
            },
        },

        {
            element: "#alttext",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter image text",
            },
        },
        {
            element: "#alttext2",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter image text",
            },
        },
        {
            element: "#alttext3",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter image text",
            },
        },
        {
            element: "#alttext4",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter image text",
            },
        },
        {
            element: "#alttext5",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter image text",
            },
        },
    ];

    $("#add-pcolor").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("add-pcategory").addClass("d-none");
            $("#add-pcolor").hide();
            $("#submit-pcolor").removeClass("d-none").addClass("d-block");
            $("#submit-pcolor").trigger("click");
        }
    });
});
