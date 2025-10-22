/* eslint-disable no-undef */

$(document).ready(function () {
    let validationRules = [
        {
            element: "#manageVendorName",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 30,
            },
            errors: {
                requiredError: "*Select a vendor name",
                // regexError: "*name is invalid. It accepts only characters",
                // minLengthError: "*name should be minimum 3 characters",
                // maxLengthError: "*name should be maximum 30 characters",
            },
        },
        {
            element: "#manageVendorImage",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/jpg", "image/png", "image/jpeg"],
            },
            errors: {
                requiredError: "*Provide an image",
                maxSizeError: "*Image size should be less than 1mb",
                fileTypeError: "*Image should` be of type jpg, jpeg or png",
            },

            beforeValidate: function () {
                let file =
                    document.getElementById("manageVendorImage").files[0];
                console.log("File type:", file.type);
                console.log("File size:", file.size);
            },
        },
        {
            element: "#projectImageOne",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/jpg", "image/png", "image/jpeg"],
            },
            errors: {
                requiredError: "*Provide an image",
                maxSizeError: "*Image size should be less than 1mb",
                fileTypeError: "*Image should be of type jpg, jpeg or png",
            },
        },
        {
            element: "#projectImageTwo",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/jpg", "image/png", "image/jpeg"],
            },
            errors: {
                requiredError: "*Provide an image",
                maxSizeError: "*Image size should be less than 1mb",
                fileTypeError: "*Image should be of type jpg, jpeg or png",
            },
        },

        {
            element: "#materialImageOne",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/jpg", "image/png", "image/jpeg"],
            },
            errors: {
                requiredError: "*Provide an image",
                maxSizeError: "*Image size should be less than 1mb",
                fileTypeError: "*Image should be of type jpg, jpeg or png",
            },
        },
        {
            element: "#materialImageTwo",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/jpg", "image/png", "image/jpeg"],
            },
            errors: {
                requiredError: "*Provide an image",
                maxSizeError: "*Image size should be less than 1mb",
                fileTypeError: "*Image should be of type jpg, jpeg or png",
            },
        },
        {
            element: "#materialImageThree",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/jpg", "image/png", "image/jpeg"],
            },
            errors: {
                requiredError: "*Provide an image",
                maxSizeError: "*Image size should be less than 1mb",
                fileTypeError: "*Image should be of type jpg, jpeg or png",
            },
        },
        {
            element: "#materialImageFour",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/jpg", "image/png", "image/jpeg"],
            },
            errors: {
                requiredError: "*Provide an image",
                maxSizeError: "*Image size should be less than 1mb",
                fileTypeError: "*Image should be of type jpg, jpeg or png",
            },
        },
        {
            element: "#materialImageFive",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/jpg", "image/png", "image/jpeg"],
            },
            errors: {
                requiredError: "*Provide an image",
                maxSizeError: "*Image size should be less than 1mb",
                fileTypeError: "*Image should be of type jpg, jpeg or png",
            },
        },
        {
            element: "#materialImageSix",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/jpg", "image/png", "image/jpeg"],
            },
            errors: {
                requiredError: "*Provide an image",
                maxSizeError: "*Image size should be less than 1mb",
                fileTypeError: "*Image should be of type jpg, jpeg or png",
            },
        },

        {
            element: "#summernote",
            rules: {
                required: true,
                minLength: 3,
                maxLength: 270,
            },
            errors: {
                requiredError: "*Enter description",
                minLengthError: "*Description should be minimum 3 characters",
                maxLengthError: "*Description should be maximum 270 characters",
            },
        },
        {
            element: "#projectsDone",
            rules: {
                required: true,
                regex: regexPatterns.numbersregex,
            },
            errors: {
                requiredError: "*Enter projects",
                regexError:
                    "*Projects Done is invalid. It accepts only numbers",
            },
        },
        {
            element: "#noOfClients",
            rules: {
                required: true,
                regex: regexPatterns.numbersregex,
            },
            errors: {
                requiredError: "*Enter no. of clients",
                regexError:
                    "*Projects Done is invalid. It accepts only numbers",
            },
        },
        {
            element: "#vendorPavilion",
            rules: {
                required: true,
                regex: regexPatterns.numbersregex,
            },
            errors: {
                requiredError: "*Enter vendor pavilion",
                regexError:
                    "*Projects Done is invalid. It accepts only numbers",
            },
        },
        {
            element: "#vendorAwards",
            rules: {
                required: true,
                regex: regexPatterns.numbersregex,
            },
            errors: {
                requiredError: "*Enter vendor awards",
                regexError:
                    "*Projects Done is invalid. It accepts only numbers",
            },
        },
        {
            element: "#noOfSpaces",
            rules: {
                required: true,
                regex: regexPatterns.numbersregex,
            },
            errors: {
                requiredError: "*Enter no. of spaces",
                regexError:
                    "*Projects Done is invalid. It accepts only numbers",
            },
        },
        {
            element: "#noOfWorkers",
            rules: {
                required: true,
                regex: regexPatterns.numbersregex,
            },
            errors: {
                requiredError: "*Enter no. of workers",
                regexError:
                    "*Projects Done is invalid. It accepts only numbers",
            },
        },
        {
            element: "#vendorExploreCity",
            rules: {
                required: true,
                regex: regexPatterns.alphabetsregex,
                minLength: 3,
                maxLength: 30,
            },
            errors: {
                requiredError: "*Enter city",
                regexError: "*city is invalid. It accepts only characters",
                minLengthError: "*city should be minimum 3 characters",
                maxLengthError: "*city should be maximum 30 characters",
            },
        },
        {
            element: "#vendorLocationTwo",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 30,
            },
            errors: {
                requiredError: "*Enter location",
                // regexError: "*name is invalid. It accepts only characters",
                // minLengthError: "*name should be minimum 3 characters",
                // maxLengthError: "*name should be maximum 30 characters",
            },
        },
        {
            element: "#vendorLocationThree",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 30,
            },
            errors: {
                requiredError: "*Enter location",
                // regexError: "*name is invalid. It accepts only characters",
                // minLengthError: "*name should be minimum 3 characters",
                // maxLengthError: "*name should be maximum 30 characters",
            },
        },
        {
            element: "#vendorLocationOne",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 30,
            },
            errors: {
                requiredError: "*Enter location",
                // regexError: "*name is invalid. It accepts only characters",
                // minLengthError: "*name should be minimum 3 characters",
                // maxLengthError: "*name should be maximum 30 characters",
            },
        },
        {
            element: "#materialNameOne",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 30,
            },
            errors: {
                requiredError: "*Enter project name",
                // regexError: "*name is invalid. It accepts only characters",
                // minLengthError: "*name should be minimum 3 characters",
                // maxLengthError: "*name should be maximum 30 characters",
            },
        },
        {
            element: "#materialNameTwo",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 30,
            },
            errors: {
                requiredError: "*Enter project name",
                // regexError: "*name is invalid. It accepts only characters",
                // minLengthError: "*name should be minimum 3 characters",
                // maxLengthError: "*name should be maximum 30 characters",
            },
        },
        {
            element: "#materialPriceTwo",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 30,
            },
            errors: {
                requiredError: "*Enter price",
                // regexError: "*name is invalid. It accepts only characters",
                // minLengthError: "*name should be minimum 3 characters",
                // maxLengthError: "*name should be maximum 30 characters",
            },
        },
        {
            element: "#materialNameThree",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 30,
            },
            errors: {
                requiredError: "*Enter project name",
                // regexError: "*name is invalid. It accepts only characters",
                // minLengthError: "*name should be minimum 3 characters",
                // maxLengthError: "*name should be maximum 30 characters",
            },
        },
        {
            element: "#materialNameFour",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 30,
            },
            errors: {
                requiredError: "*Enter project name",
                // regexError: "*name is invalid. It accepts only characters",
                // minLengthError: "*name should be minimum 3 characters",
                // maxLengthError: "*name should be maximum 30 characters",
            },
        },
        {
            element: "#materialNameFive",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 30,
            },
            errors: {
                requiredError: "*Enter project name",
                // regexError: "*name is invalid. It accepts only characters",
                // minLengthError: "*name should be minimum 3 characters",
                // maxLengthError: "*name should be maximum 30 characters",
            },
        },
        {
            element: "#materialNameSix",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 30,
            },
            errors: {
                requiredError: "*Enter project name",
                // regexError: "*name is invalid. It accepts only characters",
                // minLengthError: "*name should be minimum 3 characters",
                // maxLengthError: "*name should be maximum 30 characters",
            },
        },
        {
            element: "#materialPriceOne",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter price",
            },
        },
        {
            element: "#materialPriceTwo",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter price",
            },
        },
        {
            element: "#materialPriceThree",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter price",
            },
        },
        {
            element: "#materialPriceFour",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter price",
            },
        },
        {
            element: "#materialPriceFive",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter price",
            },
        },
        {
            element: "#materialPriceSix",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter price",
            },
        },
    ];
    console.log("validation rules====", validationRules);
    $("#add-manage-vendor").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        console.log("validation errors =====", IsFormValid);
        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("add-manage-vendor").addClass("d-none");
            $("#add-manage-vendor").hide();
            $("#submit-manage-vendor")
                .removeClass("d-none")
                .addClass("d-block");
            $("#submit-manage-vendor").trigger("click");
        }
    });
});
