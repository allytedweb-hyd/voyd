/* eslint-disable no-undef */
/* eslint-disable no-unused-vars */

function validateFormFields(fields) {
  let ValidationErrors = [];

  fields.forEach((field) => {
    let element = $(field.element);
    let value = element.val();
    let rules = field.rules;
    let errorMessage = field.errors;

    if (element.attr("type") == "file") {
      validateImages(element, errorMessage, ValidationErrors, rules);
    } else {
      if (rules.required && !value) {
        handleErrorMessages(
          element,
          errorMessage.requiredError,
          ValidationErrors
        );
      } else if (rules.regex && !checkRegex(value, rules.regex)) {
        handleErrorMessages(element, errorMessage.regexError, ValidationErrors);
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
  return regexPattern.test(value);
}
