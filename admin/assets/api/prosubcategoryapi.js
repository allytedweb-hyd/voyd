/* eslint-disable no-undef */
$(document).ready(function () {
    let validationRules = [
        {
            element: "#pcategory",
            rules: {
                required: true,
            },
            errors: {
                requiredError: "*Select a category",
            },
        },

        {
            element: "#psubcategory",
            rules: {
                required: true,
                // regex: regexPatterns.alphabetsregex,
                // minLength: 2,
                // maxLength: 50,
            },
            errors: {
                requiredError: "*Enter sub category",
                // regexError:
                //     "*SubCategory is invalid. It accepts only characters",
                // minLengthError: "*SubCategory should be minimum 2 characters",
                // maxLengthError: "*SubCategory should be maximum 30 characters",
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
            element: "#pcategoryAlttext",
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
    ];

    $("#add-psubcategory").click(function () {
        let IsFormValid = validateFormFields(validationRules);
        if (IsFormValid.length > 0) {
            swal.fire("Warning", "Enter Mandatory Fields", "warning");
            return;
        } else {
            // $("add-psubcategory").addClass("d-none");
            $("add-psubcategory").hide();
            $("#submit-psubcategory").removeClass("d-none").addClass("d-block");
            $("#submit-psubcategory").trigger("click");
        }
    });
});
