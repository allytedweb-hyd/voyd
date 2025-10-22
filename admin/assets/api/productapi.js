/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#category",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select a category",
            },
        },
        {
            element: "#productPriority",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Product Priority is required",
            },
        },
        {
            element: "#subcategory",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select a sub-category",
            },
        },

        {
            element: "#productbrand",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select a product brand",
            },
        },

        // {
        //   element: "#size",
        //   rules: {
        //     required: true,
        //   },
        //   errors: {
        //     requiredError: "*Size is required",
        //   },
        // },

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
            element: "#qantity",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter quantity",
            },
        },

        {
            element: "#material",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select material",
            },
        },

        {
            element: "#title",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 4,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Enter title",
                // regexError:
                //     "*Product title is invalid. It accepts only characters",
                // minLengthError: "*Product title should be minimum 4 characters",
                // maxLengthError:
                //     "*Product title should be maximum 20 characters",
            },
        },

        {
            element: "#image1",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/png", "image/jpg", "image/jpeg"],
                resolutionWidth: 768,
                resolutionHeight: 600,
            },
            errors: {
                requiredError: "*Provide an image",
                maxSizeError: "*Product image should be less than 1mb",
                fileTypeError:
                    "*Product image should be type of jpg, png or jpeg",
                resolutionError: "*Image should be 768 * 600px",
            },
        },

        {
            element: "#alttext1",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Enter image text",
                // regexError:
                //     "*Product alt text is invalid. It accepts only characters",
                // minLengthError:
                //     "*Product alt text should be minimum 3 characters",
                // maxLengthError:
                //     "*Product alt text should be maximum 20 characters",
            },
        },

        {
            element: "#image2",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/png", "image/jpg", "image/jpeg"],
                resolutionWidth: 768,
                resolutionHeight: 600,
            },
            errors: {
                requiredError: "*Provide an image",
                maxSizeError: "*Product image-2 should be less than 1mb",
                fileTypeError:
                    "*Product image-2 should be type of jpg, png or jpeg",
                resolutionError: "*Image should be 768 * 600px",
            },
        },

        {
            element: "#alt2",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Enter product text",
                // regexError:
                //     "*Product alt text-2 is invalid. It accepts only characters",
                // minLengthError:
                //     "*Product alt text-2 should be minimum 3 characters",
                // maxLengthError:
                //     "*Product alt text-2 should be maximum 20 characters",
            },
        },

        {
            element: "#image3",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/png", "image/jpg", "image/jpeg"],
                resolutionWidth: 768,
                resolutionHeight: 600,
            },
            errors: {
                requiredError: "*Provide an image",
                maxSizeError: "*Product image-3 should be less than 1mb",
                fileTypeError:
                    "*Product image-3 should be type of jpg, png or jpeg",
                resolutionError: "*Image should be 768 * 600px",
            },
        },

        {
            element: "#alt3",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Enter image text",
                // regexError:
                //     "*Product alt text-3 is invalid. It accepts only characters",
                // minLengthError:
                //     "*Product alt text-3 should be minimum 3 characters",
                // maxLengthError:
                //     "*Product alt text-3 should be maximum 20 characters",
            },
        },

        {
            element: "#image4",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/png", "image/jpg", "image/jpeg"],
                resolutionWidth: 768,
                resolutionHeight: 600,
            },
            errors: {
                requiredError: "*Provide an image",
                maxSizeError: "*Product image-4 should be less than 1mb",
                fileTypeError:
                    "*Product image-4 should be type of jpg, png or jpeg",
                resolutionError: "*Image should be 768 * 600px",
            },
        },

        {
            element: "#alt4",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Enter image text",
                // regexError:
                //     "*Product alt text-4 is invalid. It accepts only characters",
                // minLengthError:
                //     "*Product alt text-4 should be minimum 3 characters",
                // maxLengthError:
                //     "*Product alt text-4 should be maximum 20 characters",
            },
        },

        {
            element: "#image5",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/png", "image/jpg", "image/jpeg"],
                resolutionWidth: 768,
                resolutionHeight: 600,
            },
            errors: {
                requiredError: "*Provide an image",
                maxSizeError: "*Product image-4 should be less than 1mb",
                fileTypeError:
                    "*Product image-4 should be type of jpg, png or jpeg",
                resolutionError: "*Image should be 768 * 600px",
            },
        },

        {
            element: "#alt5",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Enter image text",
                // regexError:
                //     "*Product alt text-4 is invalid. It accepts only characters",
                // minLengthError:
                //     "*Product alt text-4 should be minimum 3 characters",
                // maxLengthError:
                //     "*Product alt text-4 should be maximum 20 characters",
            },
        },

        {
            element: "#mrp",
            rules: {
                required: true,
                // regex: regexPatterns.numbersregex,
                // minLength: 2,
                // maxLength: 10,
            },
            errors: {
                requiredError: "*Enter MRP",
                // regexError: "*Product mrp is invalid. It accepts only numbers",
                // minLengthError: "*Product mrp should be minimum 2 characters",
                // maxLengthError: "*Product mrp should be maximum 10 characters",
            },
        },

        {
            element: "#productOffer",
            rules: {
                required: true,
                regex: regexPatterns.numbersregex,
                // minLength: 2,
                // maxLength: 10,
            },
            errors: {
                requiredError: "*Enter offer price",
                regexError:
                    "*Product Offer is invalid. It accepts only numbers",
                // minLengthError: "*Product Offer should be minimum 2 characters",
                // maxLengthError:
                //     "*Product Offer should be maximum 10 characters",
            },
        },

        {
            element: "#productPriority",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select priority",
            },
        },
        {
            element: "#availability",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select availability",
            },
        },
        {
            element: "#sku",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter Stock Keeping Unit",
            },
        },
        {
            element: "#room",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select a room",
            },
        },

        {
            element: "#productTag",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select a tag",
            },
        },

        {
            element: "#productGst",
            rules: {
                required: true,
                // regex: regexPatterns.numbersregex,
                // minLength: 2,
                // maxLength: 10,
            },
            errors: {
                requiredError: "*Enter GST",
                // regexError: "*GST is invalid. It accepts only numbers",
                // minLengthError: "*GST should be minimum 2 characters",
                // maxLengthError: "*GST should be maximum 10 characters",
            },
        },

        {
            element: "#Other",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter tax",
            },
        },

        {
            element: "#shipping",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter Local Shipping",
            },
        },

        {
            element: "#ground_shipping",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter Ground Shipping",
            },
        },

        {
            element: "#global_export",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter Global Export",
            },
        },

        {
            element: "#courier",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter Courier",
            },
        },

        {
            element: "#productdesc",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter Description",
            },
        },
        {
            element: "#specification",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter Specification",
            },
        },
        {
            element: "#add_info",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter Additional Info",
            },
        },
    ];

    console.log("validationsss---------------------", validationRules);

    $("#add-product").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        console.log("validationsss---------------------", IsFormValid);

        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-product").addClass("d-none");
            $("#add-product").hide();
            $("#submit-product").removeClass("d-none").addClass("d-block");
            $("#submit-product").trigger("click");
        }
    });
});
