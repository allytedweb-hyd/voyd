/* eslint-disable no-useless-escape */
/* eslint-disable no-unused-vars */

export const regexPatterns = {
  allwhitespace: /(\s+)/gu,
  numbersregex: /^[0-9]*$/,
  mobileregex: /^[6-9]\d{9}$/,
  // mobileregexInternational: /^\+[1-9]\d{1,14}$/,
  // mobileregexInternational: /^\+91[6-9]\d{9}$/,
  // mobileregexInternational: /^\+(?:91[6-9]\d{9}|[1-9]\d{7,14})$/,
  mobileregexInternational: /^(?:\+91[6-9]\d{9}|\+(?!91)[1-9]\d{7,14})$/,
  smallAlphabetsRegex: /^[a-z]*$/,
  capsAlphabetsRegex: /^[A-Z]*$/,
  alphabetsregex: /^[a-zA-Z ]*$/,
  alphaNumeric: /^[a-zA-Z0-9\- ]+$/,
  // eslint-disable-next-line no-useless-escape
  emailregex: /^\w+([\.-]?\w+)@\w+([-]?\w+)\.([a-z]{2,3})(\.[a-z]{2,3})?$/,
  urlregex:
    /^(http[s]?:\/\/)?(www\.)?[a-zA-Z0-9]+([-]?\w+)\.([a-z]{2,12})(\.[a-z]{2,12})?$/,
  phone: /^[0-9]{10}$/,
  passwordRegex:
    /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&^()\-_=+{}[\]|;:'",.<>\/\\`~])[A-Za-z\d@$!%*#?&^()\-_=+{}[\]|;:'",.<>\/\\`~]{8,}$/,
  gstRegex: /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/,
  panRegex: /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/,
};

export const getItemValue = (arr, key, value) => {
  return arr.find((item) => {
    return item[key] == value;
  });
};

export function truncateHTML(html, wordLimit = 10) {
  const div = document.createElement("div");
  div.innerHTML = html;
  const text = div.textContent || div.innerText || "";
  const words = text.split(" ");
  if (words.length <= wordLimit) return text;
  return words.slice(0, wordLimit).join(" ") + "...";
}
