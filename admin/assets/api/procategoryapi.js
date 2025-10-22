$(document).ready(function () {
    let validationRules = [
        {
            element: "#procategory",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 4,
                // maxLength: 50,
            },
            errors: {
                requiredError: "*Enter category",
                // regexError: "*Category is invalid. It accepts only characters",
                // minLengthError: "*Category should be minimum 2 characters",
                // maxLengthError: "*Category should be maximum 30 characters",
            },
        },
        {
            element: "#offer",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Enter Offer",
            },
        },
        {
            element: "#pcategoryImage",
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
            element: "#categoryAlttext",
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
            element: "#bannerimage",
            rules: {
                required: true,
                maxSize: 1 * 1024 * 1024,
                fileTypes: ["image/jpg", "image/png", "image/jpeg"],
                resolutionWidth: 768,
                resolutionHeight: 600,
            },
            errors: {
                requiredError: "*Provide an banner",
                maxSizeError: "*Banner image size should be less than 1mb",
                fileTypeError:
                    "*Banner image should be of type jpg, png or jpeg",
                resolutionError: "*Image should be 768 * 600px",
            },
        },
        {
            element: "#bannerAlttext",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 3,
                // maxLength: 20,
            },
            errors: {
                requiredError: "*Enter banner image text",
                // regexError: "*Alt text is invalid. It accepts only characters",
                // minLengthError: "*Alt text should be minimum 3 characters",
                // maxLengthError: "*Alt text should be maximum 20 characters",
            },
        },
    ];
    $("#add-pcategory").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("add-pcategory").addClass("d-none");
            $("#add-pcategory").hide();
            $("#submit-pcategory").removeClass("d-none").addClass("d-block");
            $("#submit-pcategory").trigger("click");
        }
    });
});