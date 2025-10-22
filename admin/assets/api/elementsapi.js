/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#Name",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select a element",
            },
        },

        {
            element: "#unit",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select a unit",
            },
        },
        {
            element: "#squnits",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter Sq.units",
            },
        },

        {
            element: "#model",
            rules: {
                required: true,
                // regex: regexPatterns.alphaNumeric,
                // minLength: 2,
                // maxLength: 30,
            },
            errors: {
                requiredError: "*Enter a model",
                // regexError: "*Model is Invalid. It accepts only characters",
                // minLengthError: "*Model should be minimum 2 characters",
                // maxLengthError: "*Model should be maximum 30 characters",
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
                maxSizeError: "*Image size should be less than 1mb",
                fileTypeError: "*Image should be of type jpg, jpeg or png",
                resolutionError: "*Image should be 768 * 600px",
            },
        },

        {
            element: "#alttext",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Enter image text",
                // regexError: "*Alt text is invalid.It accepts only characters",
                // minLengthError: "*Alt text should be minimum 3 characters",
                // maxLengthError: "*Alt text should be maximum 20 characters",
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
                maxSizeError: "*Image-1 should be less than 1mb",
                fileTypeError: "*Image-1 should be type of jpg, png or jpeg",
                resolutionError: "*Image should be 768 * 600px",
            },
        },

        {
            element: "#alt1",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Enter image text",
                // regexError:
                //     "*Alt text-1 is invalid. It accepts only characters",
                // minLengthError: "*Alt text-1 should be minimum 3 characters",
                // maxLengthError: "*Alt text-1 should be maximum 20 characters",
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
                maxSizeError: "*Image-2 should be less than 1mb",
                fileTypeError: "*Image-2 should be type of jpg, png or jpeg",
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
                requiredError: "*Enter image text",
                // regexError:
                //     "*Alt text-2 is invalid. It accepts only characters",
                // minLengthError: "*Alt text-2 should be minimum 3 characters",
                // maxLengthError: "*Alt text-2 should be maximum 20 characters",
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
                maxSizeError: "*Image-3 should be less than 1mb",
                fileTypeError: "*Image-3 should be type of jpg, png or jpeg",
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
                //     "*Alt text-3 is invalid. It accepts only characters",
                // minLengthError: "*Alt text-3 should be minimum 3 characters",
                // maxLengthError: "*Alt text-3 should be maximum 20 characters",
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
                maxSizeError: "*Image-4 should be less than 1mb",
                fileTypeError: "*Image-4 should be type of jpg, png or jpeg",
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
                //     "*Alt text-4 is invalid. It accepts only characters",
                // minLengthError: "*Alt text-4 should be minimum 3 characters",
                // maxLengthError: "*Alt text-4 should be maximum 20 characters",
            },
        },

        {
            element: "#category",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "Select a category",
            },
        },
        {
            element: "#material_classification",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "Select a classification",
            },
        },

        {
            element: "#material",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "Select material",
            },
        },

        {
            element: "#productDesign",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select a design",
            },
        },
        {
            element: "#product_classification",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select a classification",
            },
        },

        {
            element: "#length",
            rules: {
                required: true,
                // regex: regexPatterns.alphaNumeric,
            },
            errors: {
                requiredError: "*Enter lenght",
                // regexError: "*Length is invalid.",
            },
        },

        {
            element: "#width",
            rules: {
                required: true,
                // regex: regexPatterns.alphaNumeric,
            },
            errors: {
                requiredError: "*Enter width",
                // regexError: "*Width is invalid.",
            },
        },

        {
            element: "#height",
            rules: {
                required: true,
                // regex: regexPatterns.alphaNumeric,
            },
            errors: {
                requiredError: "*Enter height",
                // regexError: "*Heigth is invalid.",
            },
        },

        {
            element: "#cost",
            rules: {
                required: true,
                // regex: regexPatterns.numbersregex,
                // minLength: 2,
                // maxLength: 10,
            },
            errors: {
                requiredError: "*Enter cost",
                // regexError: "*Cost is invalid.It accepts only numbers",
                // minLengthError: "*Cost should be minimum 2 characters",
                // maxLengthError: "*Cost should be maximum 10 characters",
            },
        },

        {
            element: "#min_price",
            rules: {
                required: true,
                // regex: regexPatterns.numbersregex,
                // minLength: 2,
                // maxLength: 10,
            },
            errors: {
                requiredError: "*Enter minimum price",
                // regexError: "*Minimum price is invalid.It accepts only numbers",
                // minLengthError: "*Minimum price should be minimum 2 characters",
                // maxLengthError:
                //     "*Minimum price should be maximum 10 characters",
            },
        },

        {
            element: "#max_price",
            rules: {
                required: true,
                // regex: regexPatterns.numbersregex,
                // minLength: 2,
                // maxLength: 10,
            },
            errors: {
                requiredError: "*Enter maximum price",
                // regexError: "*Maximum price is invalid.It accepts only numbers",
                // minLengthError: "*Maximum price should be minimum 2 characters",
                // maxLengthError:
                //     "*Maximum price should be maximum 10 characters",
            },
        },

        {
            element: "#elementDes",
            rules: {
                required: true,
                maxLength: 85,
            },
            errors: {
                requiredError: "*Enter description",
                maxLengthError: "*Description should be maximum 85 characters",
            },
        },
    ];

    // console.log("validationsss---------------------", validationRules);

    $("#add-element").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        console.log("validationsss---------------------", IsFormValid);

        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("#add-element").addClass("d-none");
            $("#add-element").hide();
            $("#submit-element").removeClass("d-none").addClass("d-block");
            $("#submit-element").trigger("click");
        }
    });
});
