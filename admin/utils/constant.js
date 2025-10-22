/* eslint-disable no-unused-vars */
// let baseUrl = "https://localhost:81/testingAxiosApi/endPoints/";
// const imageUrl = "https://mmworkspace.com/mr.Interior/admin/";
// const imageUrl = "http://localhost:81/mr.Interior/admin/"
const imageUrl = "http://localhost/mr.Interior/admin/";

let endPoints = {
  brands: "brandsEndPoint.php",
};

let regexPatterns = {
  allwhitespace: /(\s+)/gu,
  numbersregex: /^[0-9]*$/,
  mobileregex: /^\d{10}$/,
  smallAlphabetsRegex: /^[a-z]*$/,
  capsAlphabetsRegex: /^[A-Z]*$/,
  alphabetsregex: /^[a-zA-Z ]*$/,
  // alphaNumeric: /^([a-zA-Z\d_]){4,8}$/,
  alphaNumeric: /^$|^[a-zA-Z0-9]+$/,

  // eslint-disable-next-line no-useless-escape
  emailregex: /^\w+([\.-]?\w+)@\w+([-]?\w+)\.([a-z]{2,3})(\.[a-z]{2,3})?$/,
  urlregex:
    /^(http[s]?:\/\/)?(www\.)?[a-zA-Z0-9]+([-]?\w+)\.([a-z]{2,12})(\.[a-z]{2,12})?$/,
  phone: /^[0-9]{10}$/,
};
