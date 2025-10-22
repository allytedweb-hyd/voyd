/* eslint-disable no-undef */
/* eslint-disable no-unused-vars */
function validateFormFields(fields) {
    let ValidationErrors = [];

    fields.forEach((field) => {
        let element = $(field.element);
        let value = element.val();
        let rules = field.rules;
        let errorMessage = field.errors;
        console.log("elements are===", element.attr("type"));

        if (element.attr("type") === "file") {
            console.log("type images clicked");
            validateImages(element, errorMessage, ValidationErrors, rules);
        }
        // else if (element.is("textarea")) {
        //   handleCkEditor(element, rules, ValidationErrors, errorMessage);
        // }
        //  else if (rules.maxLength && val.length > rules.maxLength) {
        //   handleErrorMessages(
        //     element,
        //     errorMessage.maxLengthError,
        //     ValidationErrors
        //   );}
        else {
            if (rules.required && !value) {
                handleErrorMessages(
                    element,
                    errorMessage.requiredError,
                    ValidationErrors
                );
            } else if (rules.notDefault && value === "") {
                handleErrorMessages(
                    element,
                    errorMessage.notDefaultError,
                    ValidationErrors
                );
            } else if (rules.regex && !checkRegex(value, rules.regex)) {
                handleErrorMessages(
                    element,
                    errorMessage.regexError,
                    ValidationErrors
                );
            } else if (rules.minLength && value.length < rules.minLength) {
                handleErrorMessages(
                    element,
                    errorMessage.minLengthError,
                    ValidationErrors
                );
            } else if (rules.maxLength && value.length > rules.maxLength) {
                handleErrorMessages(
                    element,
                    errorMessage.maxLengthError,
                    ValidationErrors
                );
            } else {
                clearErrors(element);
            }
        }
    });

    return ValidationErrors;
}

// function validateImages(element, errorMessage, validationErrors, rules) {
//     let file = element[0].files[0];

//     const fileInput = document.getElementById(element[0].id);

//     if (fileInput.files.length > 0) {
//         const img = document.createElement("img");

//         const selectedImage = fileInput.files[0];

//         const objectURL = URL.createObjectURL(selectedImage);

//         img.onload = function handleLoad() {
//             console.log(`Width: ${img.width}, Height: ${img.height}`);

//             if (img.width > 768 || img.height > 600) {
//                 element.addClass("is-invalid");
//                 handleErrorMessages(
//                     element,
//                     errorMessage.resolutionError,
//                     validationErrors
//                 );
//             }

//             URL.revokeObjectURL(objectURL);
//         };

//         img.src = objectURL;

//         let validateImageTypes = ["image/jpg", "image/png", "image/jpeg"];

//         if (rules.required && !file) {
//             handleErrorMessages(
//                 element,
//                 errorMessage.requiredError,
//                 validationErrors
//             );
//             validationErrors.push(errorMessage.requiredError);
//         } else if (
//             file &&
//             rules.fileTypes &&
//             !validateImageTypes.includes(file["type"])
//         ) {
//             handleErrorMessages(
//                 element,
//                 errorMessage.fileTypeError,
//                 validationErrors
//             );
//         } else if (file && rules.maxSize && file.size > rules.maxSize) {
//             element.addClass("is-invalid");
//             handleErrorMessages(
//                 element,
//                 errorMessage.maxSizeError,
//                 validationErrors
//             );
//         } else {
//             clearErrors(element);
//         }
//     }
// }

// function validateImages(
//     element,
//     errorMessage,
//     validationErrors,
//     rules,
//     doneCallback
// ) {
//     const file = element[0].files[0];

//     const container = element.closest(".col-md-6");
//     const oldImage = container
//         .find('input[type="hidden"][name^="oldImage"]')
//         .val();

//     if (!file) {
//         if (rules.required && !oldImage) {
//             handleErrorMessages(
//                 element,
//                 errorMessage.requiredError,
//                 validationErrors
//             );
//         } else {
//             clearErrors(element);
//         }

//         if (doneCallback) doneCallback();
//         return;
//     }

//     clearErrors(element);
//     if (doneCallback) doneCallback();
// }

// function validateImages(
//     element,
//     errorMessage,
//     validationErrors,
//     rules,
//     doneCallback
// ) {
//     const file = element[0].files[0];

//     const form = element.closest("form");
//     const oldImage = form.find('input[name="oldImage"]').val();

//     if (!file) {
//         if (rules.required && !oldImage) {
//             handleErrorMessages(
//                 element,
//                 errorMessage.requiredError,
//                 validationErrors
//             );
//         } else {
//             clearErrors(element);
//         }

//         if (doneCallback) doneCallback();
//         return;
//     }

//     clearErrors(element);
//     if (doneCallback) doneCallback();
// }

// function validateImages(
//     element,
//     errorMessage,
//     validationErrors,
//     rules,
//     doneCallback
// ) {
//     const file = element[0].files[0];

//     const form = element.closest("form");

//     const oldImage =
//         form.find('input[name="oldImage"]').val() ||
//         form.find('input[id="image_old"]').val();

//     if (!file) {
//         if (rules.required && !oldImage) {
//             handleErrorMessages(
//                 element,
//                 errorMessage.requiredError,
//                 validationErrors
//             );
//         } else {
//             clearErrors(element);
//         }

//         if (doneCallback) doneCallback();
//         return;
//     }

//     clearErrors(element);
//     if (doneCallback) doneCallback();
// }

// function validateImages(
//     element,
//     errorMessage,
//     validationErrors,
//     rules,
//     doneCallback
// ) {
//     const file = element[0].files[0];
//     const form = element.closest("form");

//     const oldImage =
//         form.find('input[name="oldImage"]').val() ||
//         form.find('input[id="image_old"]').val();

//     if (!file) {
//         if (rules.required && !oldImage) {
//             handleErrorMessages(
//                 element,
//                 errorMessage.requiredError,
//                 validationErrors
//             );
//         } else {
//             clearErrors(element);
//         }

//         if (doneCallback) doneCallback();
//         return;
//     }

//     if (rules.fileTypes && !rules.fileTypes.includes(file.type)) {
//         handleErrorMessages(
//             element,
//             errorMessage.fileTypeError || "Invalid file type.",
//             validationErrors
//         );
//         if (doneCallback) doneCallback();
//         return;
//     }

//     if (rules.maxSize && file.size > rules.maxSize) {
//         handleErrorMessages(
//             element,
//             errorMessage.maxSizeError || "File too large.",
//             validationErrors
//         );
//         if (doneCallback) doneCallback();
//         return;
//     }

//     const reader = new FileReader();
//     reader.onload = function (e) {
//         const img = new Image();
//         img.onload = function () {
//             const width = img.width;
//             const height = img.height;

//             if (
//                 rules.resolutionWidth &&
//                 rules.resolutionHeight &&
//                 (width !== rules.resolutionWidth ||
//                     height !== rules.resolutionHeight)
//             ) {
//                 handleErrorMessages(
//                     element,
//                     errorMessage.resolutionError ||
//                         `Image must be ${rules.resolutionWidth}x${rules.resolutionHeight}px`,
//                     validationErrors
//                 );
//             } else {
//                 clearErrors(element);
//             }

//             if (doneCallback) doneCallback();
//         };

//         img.onerror = function () {
//             handleErrorMessages(
//                 element,
//                 "Could not load image for resolution check.",
//                 validationErrors
//             );
//             if (doneCallback) doneCallback();
//         };

//         img.src = e.target.result;
//     };

//     reader.readAsDataURL(file);
// }

// function validateImages(
//     element,
//     errorMessage,
//     validationErrors,
//     rules,
//     doneCallback
// ) {
//     const file = element[0].files[0];
//     const form = element.closest("form");

//     const oldImage =
//         form.find('input[name="oldImage"]').val() ||
//         form.find('input[id="image_old"]').val();

//     if (!file) {
//         if (rules.required && !oldImage) {
//             handleErrorMessages(
//                 element,
//                 errorMessage.requiredError,
//                 validationErrors
//             );
//         } else {
//             clearErrors(element);
//         }

//         if (doneCallback) doneCallback();
//         return;
//     }

//     if (rules.fileTypes && !rules.fileTypes.includes(file.type)) {
//         handleErrorMessages(
//             element,
//             errorMessage.fileTypeError || "Invalid file type.",
//             validationErrors
//         );
//         if (doneCallback) doneCallback();
//         return;
//     }

//     if (rules.maxSize && file.size > rules.maxSize) {
//         handleErrorMessages(
//             element,
//             errorMessage.maxSizeError || "File too large.",
//             validationErrors
//         );
//         if (doneCallback) doneCallback();
//         return;
//     }

//     const reader = new FileReader();
//     reader.onload = function (e) {
//         const img = new Image();
//         img.onload = function () {
//             clearErrors(element);
//             if (doneCallback) doneCallback();
//         };

//         img.onerror = function () {
//             handleErrorMessages(
//                 element,
//                 "Could not load image.",
//                 validationErrors
//             );
//             if (doneCallback) doneCallback();
//         };

//         img.src = e.target.result;
//     };

//     reader.readAsDataURL(file);
// }

// function validateImages(
//     element,
//     errorMessage,
//     validationErrors,
//     rules,
//     doneCallback
// ) {
//     const file = element[0].files[0];
//     const form = element.closest("form");

//     const oldImage =
//         form.find('input[name="oldImage"]').val() ||
//         form.find('input[id="image_old"]').val();

//     if (!file) {
//         if (rules.required && !oldImage) {
//             handleErrorMessages(
//                 element,
//                 errorMessage.requiredError,
//                 validationErrors
//             );
//         } else {
//             clearErrors(element);
//         }

//         if (doneCallback) doneCallback();
//         return;
//     }

//     if (rules.fileTypes && !rules.fileTypes.includes(file.type)) {
//         handleErrorMessages(
//             element,
//             errorMessage.fileTypeError || "Invalid file type.",
//             validationErrors
//         );
//         if (doneCallback) doneCallback();
//         return;
//     }

//     if (rules.maxSize && file.size > rules.maxSize) {
//         handleErrorMessages(
//             element,
//             errorMessage.maxSizeError || "File too large.",
//             validationErrors
//         );
//         if (doneCallback) doneCallback();
//         return;
//     }

//     if (file.type === "application/pdf") {
//         clearErrors(element);
//         if (doneCallback) doneCallback();
//         return;
//     }

//     const reader = new FileReader();
//     reader.onload = function (e) {
//         const img = new Image();
//         img.onload = function () {
//             clearErrors(element);
//             if (doneCallback) doneCallback();
//         };

//         img.onerror = function () {
//             handleErrorMessages(
//                 element,
//                 "Could not load image.",
//                 validationErrors
//             );
//             if (doneCallback) doneCallback();
//         };

//         img.src = e.target.result;
//     };

//     reader.readAsDataURL(file);
// }

function validateImages(
    element,
    errorMessage,
    validationErrors,
    rules,
    doneCallback
) {
    const file = element[0].files[0];

    const form = element.closest("form");

    const fieldName = element.attr("name");

    const oldImageFieldName =
        fieldName === "icon"
            ? "oldImage4"
            : "old" + fieldName.charAt(0).toUpperCase() + fieldName.slice(1);

    const oldImage = form.find(`input[name="${oldImageFieldName}"]`).val();

    if (!file) {
        if (rules.required && !oldImage) {
            handleErrorMessages(
                element,
                errorMessage.requiredError,
                validationErrors
            );
        } else {
            clearErrors(element);
        }

        if (doneCallback) doneCallback();
        return;
    }

    if (rules.fileTypes && !rules.fileTypes.includes(file.type)) {
        handleErrorMessages(
            element,
            errorMessage.fileTypeError || "Invalid file type.",
            validationErrors
        );
        if (doneCallback) doneCallback();
        return;
    }

    if (rules.maxSize && file.size > rules.maxSize) {
        handleErrorMessages(
            element,
            errorMessage.maxSizeError || "File too large.",
            validationErrors
        );
        if (doneCallback) doneCallback();
        return;
    }

    if (file.type === "application/pdf") {
        clearErrors(element);
        if (doneCallback) doneCallback();
        return;
    }

    const reader = new FileReader();
    reader.onload = function (e) {
        const img = new Image();
        img.onload = function () {
            clearErrors(element);
            if (doneCallback) doneCallback();
        };

        img.onerror = function () {
            handleErrorMessages(
                element,
                "Could not load image.",
                validationErrors
            );
            if (doneCallback) doneCallback();
        };

        img.src = e.target.result;
    };

    reader.readAsDataURL(file);
}

function handleCkEditor(element, rules, ValidationErrors, errorMessage) {
    console.log(`handle ck for ${element} is triggered`);
    let val = CKEDITOR.instances[`${element.attr("id")}`].getData();
    console.log("ck editor val is" + " " + val);
    console.log(val.length);
    if (rules.required && !val) {
        handleErrorMessages(
            element,
            errorMessage.requiredError,
            ValidationErrors
        );
    } else if (rules.maxLength && val.length > rules.maxLength) {
        handleErrorMessages(
            element,
            errorMessage.maxLengthError,
            ValidationErrors
        );
    } else {
        clearErrors(element);
    }
}

// select dropsown validation

// function validateImages(
//     element,
//     errorMessage,
//     validationErrors,
//     rules,
//     doneCallback
// ) {
//     const file = element[0].files[0];

//     if (!file) {
//         if (rules.required) {
//             handleErrorMessages(
//                 element,
//                 errorMessage.requiredError,
//                 validationErrors
//             );
//         }
//         if (doneCallback) doneCallback();
//         return;
//     }

//     const validateImageTypes = ["image/jpg", "image/jpeg", "image/png"];
//     const objectURL = URL.createObjectURL(file);
//     const img = new Image();

//     img.onload = function () {
//         if (
//             (rules.maxWidth && img.width > rules.maxWidth) ||
//             (rules.maxHeight && img.height > rules.maxHeight)
//         ) {
//             handleErrorMessages(
//                 element,
//                 errorMessage.resolutionError,
//                 validationErrors
//             );
//         } else if (rules.fileTypes && !validateImageTypes.includes(file.type)) {
//             handleErrorMessages(
//                 element,
//                 errorMessage.fileTypeError,
//                 validationErrors
//             );
//         }
//         // File size
//         else if (rules.maxSize && file.size > rules.maxSize) {
//             handleErrorMessages(
//                 element,
//                 errorMessage.maxSizeError,
//                 validationErrors
//             );
//         } else {
//             clearErrors(element);
//         }

//         URL.revokeObjectURL(objectURL);
//         if (doneCallback) doneCallback();
//     };

//     img.onerror = function () {
//         handleErrorMessages(element, "Invalid image file.", validationErrors);
//         if (doneCallback) doneCallback();
//     };

//     img.src = objectURL;
// }

function handleSelectValidations(
    element,
    errorMessage,
    validationErrors,
    rules
) {
    let value = element.val();
    console.log(value);
    if (rules.required && (!value || value == "0")) {
        console.log("select is error");
        // element.addClass("is-invalid");
        // handleErrors(element, errors.requiredError, validationErrs);
    } else {
        console.log("select is error free");
        // clearErrors(element);
    }
}

function handleErrorMessages(element, errorMessage, validationErrors) {
    element.addClass("is-invalid");
    element.siblings("#errText").text(errorMessage);
    validationErrors.push(errorMessage);
}

function clearErrors(element) {
    element.removeClass("is-invalid");
    element.addClass("is-valid");
    element.siblings("#errText").text("");
}

function checkRegex(value, regexPattern) {
    console.log("regex is==", regexPattern.test(value));
    return regexPattern.test(value);
}
