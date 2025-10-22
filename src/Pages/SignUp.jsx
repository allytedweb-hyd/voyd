/* eslint-disable react-hooks/exhaustive-deps */
/* eslint-disable no-undef */
/* eslint-disable no-unused-vars */
import { Link, useNavigate } from "react-router-dom";
import { FaRegEye } from "react-icons/fa";
import { FaRegEyeSlash } from "react-icons/fa";
import { ImEyeBlocked } from "react-icons/im";
import { regexPatterns } from "../libs/constant";
import { Tab, Tabs, TabList, TabPanel } from "react-tabs";
import "react-tabs/style/react-tabs.css";
import { useContext, useEffect } from "react";
import { useState } from "react";
import { environmentUrl } from "../env/enviroment";
import { toast } from "sonner";
import Sonner from "../Components/Toaster/Sonner";
import { GoogleLogin } from "@react-oauth/google";
import { userContext } from "../App";
import Loader from "../Components/Spinner/Loader";
import { jwtDecode } from "jwt-decode";

import "react-phone-number-input/style.css";
import PhoneInput from "react-phone-number-input";

const SignUp = () => {
  const navigate = useNavigate();
  const getParams = new URLSearchParams(window.location.search);
  const params = getParams.get("refferalCode");
  const [loading, setLoading] = useState(false);
  const [showPanField, setShowPanField] = useState(false);
  const [showGstField, setShowGstField] = useState(false);
  const [visibile, setVisible] = useState(false);
  const [conVisibile, setConVisible] = useState(false);
  const [customerFormErrors, setCustomerFormErrors] = useState({});
  const [form, setForm] = useState({});
  const { setHeaderVal } = useContext(userContext);
  const [activeTab, setActiveTab] = useState("Customer");

  const handleGoogleSignup = (credentialResponse) => {
    const decoded = jwtDecode(credentialResponse.credential);

    fetch(
      `${environmentUrl}/Authentication/register.php?registrationType=${activeTab}&refferalCode=${params}`,
      {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(decoded),
      }
    )
      .then((res) => res.json())
      .then((data) => {
        if (data?.status) {
          navigate("/login");
          setTimeout(() => {
            toast.success(data?.response);
          }, 500);
        } else {
          toast.error(data?.response);
        }
      })
      .catch((err) => console.error("Signup failed:", err));
  };

  const toggleEye = () => {
    setVisible(!visibile);
  };
  const ConToggleEye = () => {
    setConVisible(!conVisibile);
  };

  const onChange = (event) => {
    if (
      (event.target.name === "vendorCompany" ||
        event.target.name === "customerCompany") &&
      event.target.value === "Registered"
    ) {
      setShowGstField(true);
      setShowPanField(false);
    } else if (
      (event.target.name === "vendorCompany" ||
        event.target.name === "customerCompany") &&
      event.target.value === "Individual"
    ) {
      setShowPanField(true);
      setShowGstField(false);
    }
    setForm({
      ...form,
      city: "Hyderabad",
      state: "Telangana",
      [event.target.name]: event.target.value,
    });
  };

  const validateFields = () => {
    let validationErrors = {};
    if (activeTab === "Customer") {
      if (!form.firstName) {
        validationErrors.firstName = "Enter first name";
      } else if (!regexPatterns.alphabetsregex.test(form.firstName)) {
        validationErrors.firstName = "Name must be in letters only";
      }

      if (!form.lastName) {
        validationErrors.lastName = "Enter last name";
      } else if (!regexPatterns.alphabetsregex.test(form.lastName)) {
        validationErrors.lastName = "Name must be in letters only";
      }

      if (!form.email) {
        validationErrors.email = "Enter an email address";
      } else if (!regexPatterns.emailregex.test(form.email)) {
        validationErrors.email = "Enter a valid email address";
      }

      // if (!form.mobileNo) {
      //   validationErrors.mobileNo = "Enter mobile number";
      // } else if (!regexPatterns.mobileregex.test(form.mobileNo)) {
      //   validationErrors.mobileNo = "Enter a valid 10 digit mobile number";
      // }
      if (!form.mobileNo) {
        validationErrors.mobileNo = "Enter Mobile Number";
      } else if (!regexPatterns.mobileregexInternational.test(form.mobileNo)) {
        validationErrors.mobileNo = "Enter a valid mobile number";
      }

      if (!form.address) {
        validationErrors.address = "Enter address";
      }

      if (!form.street) {
        validationErrors.street = "Enter street";
      }
      // if (!form.place) {
      //   validationErrors.place = "Enter Locality";
      // } else if (!regexPatterns.alphaNumeric.test(form.place)) {
      //   validationErrors.place =
      //     "Locality is invalid. It accepts only characters";
      // }
      if (!form.place) {
        validationErrors.place = "Enter locality";
      }
      // if (!form.customerCompany) {
      //   validationErrors.customerCompany = "Select Company";
      // }

      if (!form.password || !form.conPassword) {
        validationErrors.password = "Enter password";
        validationErrors.conPassword = "Enter same password";
      } else if (!regexPatterns.passwordRegex.test(form.password)) {
        validationErrors.password =
          "Password is invalid. Use 8 or more characters with a mix of one uppercase, numbers & symbols";
      } else if (form.password.trim() !== form.conPassword.trim()) {
        validationErrors.password =
          "Password and confirm password does'nt match";
        validationErrors.conPassword =
          "Password and confirm password does'nt match";
      }
      return validationErrors;
    } else {
      if (!form.VendorFirstName) {
        validationErrors.VendorFirstName = "Enter first name";
      } else if (!regexPatterns.alphabetsregex.test(form.VendorFirstName)) {
        validationErrors.VendorFirstName = "Name must be in letters only";
      }

      if (!form.vendorLastName) {
        validationErrors.vendorLastName = "Enter last name";
      } else if (!regexPatterns.alphabetsregex.test(form.vendorLastName)) {
        validationErrors.vendorLastName = "Name must be in letters only";
      }
      if (!form.vendorEmail) {
        validationErrors.vendorEmail = "Enter an email address";
      } else if (!regexPatterns.emailregex.test(form.vendorEmail)) {
        validationErrors.vendorEmail = "Enter a valid email address";
      }

      if (!form.vendorAddress) {
        validationErrors.vendorAddress = "Enter address";
      }
      if (!form.vendorStreet) {
        validationErrors.vendorStreet = "Enter street";
      }
      if (!form.vendorLocality) {
        validationErrors.vendorLocality = "Enter locality";
      }
      // if (!form.vendorMobileNo) {
      //   validationErrors.vendorMobileNo = "Enter mobile number";
      // } else if (!regexPatterns.mobileregex.test(form.vendorMobileNo)) {
      //   validationErrors.vendorMobileNo =
      //     "Enter a valid 10 digit mobile number";
      // }
      if (!form.vendorMobileNo) {
        validationErrors.vendorMobileNo = "Enter Mobile Number";
      } else if (
        !regexPatterns.mobileregexInternational.test(form.vendorMobileNo)
      ) {
        validationErrors.vendorMobileNo = "Enter a valid mobile number";
      }
      if (!form.vendorClassification) {
        validationErrors.vendorClassification = "Select classification";
      }
      if (!form.vendorCompany) {
        validationErrors.vendorCompany = "Select company";
      }
      if (form.vendorCompany === "Registered") {
        if (!form.vendorGstNo) {
          validationErrors.vendorGstNo = "Enter GST number";
        } else if (!regexPatterns.gstRegex.test(form.vendorGstNo)) {
          validationErrors.vendorGstNo =
            "Gst number is invalid. It accepts alphanumeric characters with 15 digits";
        }
      } else {
        if (!form.vendorPanNo) {
          validationErrors.vendorPanNo = "Enter a valid PAN number";
        } else if (!regexPatterns.panRegex.test(form.vendorPanNo)) {
          validationErrors.vendorPanNo =
            "Pan number is invalid. It accepts alphanumeric characters with 10 digits";
        }
      }
      console.log(" vendor validationErrors", validationErrors);

      return validationErrors;
    }
  };

  const onSelectTab = (type) => {
    setActiveTab(type);
    console.log("active tab is", activeTab);
  };
  const sendMailOnCusReg = async (refCode) => {
    console.log("function hits and ref code is", refCode);
    const formData = form;
    if (activeTab == "Customer") {
      const mailUrl = `${environmentUrl}/Authentication/cusRegMail.php`;
      const mailOption = {
        method: "POST",
        body: JSON.stringify({ ...formData, refferedBy: refCode }),
      };
      const mailFetch = await fetch(mailUrl, mailOption);
      const mailRes = await mailFetch.json();
      console.log("mail res after register", mailRes);
      if (mailRes.status) {
        toast.success(mailRes?.message);
        setForm({});
        setCustomerFormErrors({});
        navigate('/login');
      } else {
        toast.error("Oops...!, Try Again");
      }
    } else {
      const mailUrl = `${environmentUrl}/Authentication/vendorRegMail.php`;
      const mailOption = {
        method: "POST",
        body: JSON.stringify(formData),
      };
      const mailFetch = await fetch(mailUrl, mailOption);
      const mailRes = await mailFetch.json();
      if (mailRes.status) {
        toast.success(mailRes?.message);
        navigate('/');
      } else {
        toast.error("Oops...!, Try Again");
      }
    }
  };

  const registerAsCustomer = async (event) => {
    event.preventDefault();
    setLoading(true);
    try {
      const errors = validateFields();
      const isValid = Object.keys(errors).length === 0;
      setCustomerFormErrors(errors);
      if (!isValid) {
        toast.warning("Please fill all Mandatory Fields");
        return;
      }
      const formData = form;

      const signUpUrl = `${environmentUrl}/Authentication/register.php?registrationType=${activeTab}&refferalCode=${params}`;
      const options = {
        method: "POST",
        body: JSON.stringify(formData),
      };
      const response = await fetch(signUpUrl, options);
      const fetchData = await response.json();
      if (fetchData.status) {
        event.target.reset();
        toast.success(fetchData?.response);
        setForm({});
        setCustomerFormErrors({});
        sendMailOnCusReg(fetchData?.refferalCode);
      } else {
        toast.error(fetchData?.response);
      }
    } catch (error) {
      console.log("refer a frd error===", error);
      toast.error("Something went wrong. Please try again.");
    } finally {
      setLoading(false);
    }

    // }
  };

  // handling google response
  const responseMessage = (response) => {
    console.log("sucess", response);
  };
  const errorMessage = (error) => {
    console.log("error==", error);
  };

  useEffect(() => {
    setHeaderVal(false);
  }, []);

  return (
    <>
      {loading && <Loader />}
      <section className="registrationSection tabPd">
        <div className="container-fluid">
          <Tabs>
            <TabList className="sign-up-nav selectedPd">
              <Tab
                className="sign-up-nav-item customer"
                onClick={() => {
                  onSelectTab("Customer");
                }}
              >
                Customer
              </Tab>
              <Tab
                className="sign-up-nav-item customer"
                onClick={() => {
                  onSelectTab("Vendor");
                }}
              >
                Vendor
              </Tab>
            </TabList>

            <TabPanel>
              <div className="registerForms customer">
                <div className="row">
                  <div className="col-lg-6 col-md-6">
                    <div className="formBlock">
                      <h3>Customer Registration 👋</h3>

                      {/* <p className="indicate">
                        Already have an account? <Link to="/login">Log in</Link>
                      </p> */}

                      <form
                        method="post"
                        className="formSubmit registrations errs customerForm"
                        onSubmit={registerAsCustomer}
                      >
                        <div className="row">
                          <div className="form-group col-md-6">
                            <input
                              type="text"
                              id="customerFirstName"
                              className={`form-control form-control1 ${customerFormErrors.firstName
                                ? "input-error"
                                : ""
                                }`}
                              placeholder="First Name *"
                              name="firstName"
                              onChange={onChange}
                            />

                            {customerFormErrors?.firstName && (
                              <p className="error-msg">
                                {customerFormErrors?.firstName}
                              </p>
                            )}
                          </div>
                          <div className="form-group col-md-6">
                            <input
                              type="text"
                              id="CustomerLastName"
                              className={`form-control form-control1 ${customerFormErrors.lastName ? "input-error" : ""
                                }`}
                              placeholder="Last Name *"
                              name="lastName"
                              onChange={onChange}
                            />
                            {customerFormErrors?.lastName && (
                              <p className="error-msg">
                                {customerFormErrors?.lastName}
                              </p>
                            )}
                          </div>
                        </div>
                        <div className="row">
                          <div className="form-group col-md-6">
                            <input
                              id="customerEmail"
                              type="text"
                              className={`form-control form-control1 exceptC ${customerFormErrors.email ? "input-error" : ""
                                }`}
                              placeholder="Email Address *"
                              name="email"
                              onChange={onChange}
                            />
                            {customerFormErrors?.email && (
                              <p className="error-msg">
                                {customerFormErrors?.email}
                              </p>
                            )}
                          </div>
                          <div className="form-group col-md-6">
                            <div className="registerFormCountry">
                              {/* <input
                              type="number"
                              id="customerMobile"
                              className={`form-control form-control1 ${
                                customerFormErrors.mobileNo ? "input-error" : ""
                              }`}
                              placeholder="Mobile No *"
                              name="mobileNo"
                              onChange={onChange}
                            /> */}
                              <PhoneInput
                                international
                                defaultCountry="IN"
                                value={form.mobileNo || ""}
                                onChange={(value) =>
                                  setForm((prev) => ({
                                    ...prev,
                                    mobileNo: value,
                                  }))
                                }
                                // className="search-clsp22 inputField countryCode"
                                className={`form-control form-control1 registerNumberInput ${customerFormErrors.mobileNo
                                  ? "input-error"
                                  : ""
                                  }`}
                                placeholder="Mobile No *"
                                name="mobileNo"
                                maxLength="18"
                              />
                            </div>
                            {customerFormErrors?.mobileNo && (
                              <p className="error-msg">
                                {customerFormErrors?.mobileNo}
                              </p>
                            )}
                          </div>
                        </div>
                        <div className="row">
                          <div className="form-group col-md-6">
                            <input
                              id="customerAddress"
                              type="text"
                              className={`form-control form-control1 ${customerFormErrors.address ? "input-error" : ""
                                }`}
                              placeholder="Address *"
                              name="address"
                              onChange={onChange}
                            />
                            {customerFormErrors?.address && (
                              <p className="error-msg">
                                {customerFormErrors?.address}
                              </p>
                            )}
                          </div>
                          <div className="form-group col-md-6">
                            <input
                              type="text"
                              id="street"
                              className={`form-control form-control1 ${customerFormErrors.street ? "input-error" : ""
                                }`}
                              placeholder="Street *"
                              name="street"
                              onChange={onChange}
                            />
                            {customerFormErrors?.street && (
                              <p className="error-msg">
                                {customerFormErrors?.street}
                              </p>
                            )}
                          </div>
                        </div>
                        <div className="row">
                          <div className="form-group col-md-6">
                            <input
                              type="text"
                              id="customerPlace"
                              className={`form-control form-control1 ${customerFormErrors.place ? "input-error" : ""
                                }`}
                              placeholder="Locality *"
                              name="place"
                              onChange={onChange}
                            />
                            {customerFormErrors?.place && (
                              <p className="error-msg">
                                {customerFormErrors?.place}
                              </p>
                            )}
                          </div>

                          <div className="form-group col-md-6">
                            <input
                              type="text"
                              id="customerCity"
                              className="form-control form-control1"
                              placeholder="City"
                              name="city"
                              onChange={onChange}
                              // value={form?.city}
                              value="Hyderabad"
                              readOnly
                            />
                          </div>
                        </div>
                        <div className="row">
                          <div className="form-group col-md-6">
                            <input
                              type="text"
                              id="customerState"
                              className="form-control form-control1"
                              placeholder="State"
                              name="state"
                              onChange={onChange}
                              // value={form?.state}
                              value="Telangana"
                              readOnly
                            />
                          </div>
                          <div className="form-group col-md-6">
                            <input
                              type="text"
                              id="customerRefferedBy"
                              className="form-control form-control1"
                              placeholder="Apply referral code if any"
                              name="refferedBy"
                              value={params == null ? form?.refferedBy : params}
                              onChange={onChange}
                              readOnly={params != null || params == null}
                              disabled={params != null || params == null}
                            />
                          </div>
                        </div>
                        <div className="row">
                          <div className="form-group col-md-6">
                            <div className="selectSignOut">
                              <select
                                className="form-control form-control1 dropOption"
                                id="customerCompany"
                                name="customerCompany"
                                onChange={onChange}
                              >
                                <p id="errText" className="error-msg"></p>
                                <option
                                  className="optionsign"
                                  value=""
                                  disabled
                                  hidden
                                  selected
                                >
                                  Select Company Type
                                </option>
                                <option
                                  className="optionsign"
                                  value="Registered"
                                >
                                  Registered Company
                                </option>
                                <option
                                  className="optionsign"
                                  value="Individual"
                                >
                                  Individual(self)
                                </option>
                              </select>
                            </div>
                            {/* {customerFormErrors?.customerCompany && (
                              <p className="error-msg">
                                {customerFormErrors?.customerCompany}
                              </p>
                            )} */}
                          </div>{" "}
                          {showPanField && (
                            <>
                              <div className="form-group col-md-6">
                                {/* <span className="errorSymbol position">*</span> */}
                                <input
                                  type="text"
                                  id="customerPancard"
                                  className="form-control form-control1 upperCase "
                                  placeholder="PAN No"
                                  name="customerPanNo"
                                  onChange={onChange}
                                />
                                {/* {customerFormErrors?.vendorPanNo && (
                                  <p className="error-msg">
                                    {customerFormErrors?.vendorPanNo}
                                  </p>
                                )} */}
                              </div>
                              <div className="form-group col-md-6">
                                <input
                                  id="companyName"
                                  type="text"
                                  className="form-control form-control1"
                                  placeholder="Company Name"
                                  name="customerCompanyName"
                                  onChange={onChange}
                                />
                              </div>
                            </>
                          )}
                          {showGstField && (
                            <>
                              <div className="form-group col-md-6">
                                <input
                                  type="text"
                                  id="customerGstNum"
                                  className="form-control form-control1 upperCase"
                                  placeholder="GST No"
                                  name="gstNo"
                                  onChange={onChange}
                                />
                              </div>
                              <div className="form-group col-md-6">
                                <input
                                  type="text"
                                  id="customerCompanyName"
                                  className="form-control form-control1"
                                  placeholder="Company"
                                  name="customerCompanyName"
                                  onChange={onChange}
                                />
                              </div>
                            </>
                          )}
                          <div className="form-group col-md-6">
                            <input
                              type={visibile === true ? "text" : "password"}
                              id="customerPassword"
                              className={`form-control form-control1 exceptC ${customerFormErrors.password ? "input-error" : ""
                                }`}
                              placeholder="Password *"
                              name="password"
                              onChange={onChange}
                            />
                            {customerFormErrors?.password && (
                              <p className="error-msg">
                                {customerFormErrors?.password}
                              </p>
                            )}
                            <span className="password-eye1">
                              {visibile === true ? (
                                <ImEyeBlocked onClick={toggleEye} />
                              ) : (
                                <FaRegEye onClick={toggleEye} />
                              )}
                            </span>
                          </div>
                          <div className="form-group col-md-6">
                            <input
                              type={conVisibile === true ? "text" : "password"}
                              id="customerConfPassword"
                              className={`form-control form-control1 exceptC ${customerFormErrors.conPassword
                                ? "input-error"
                                : ""
                                }`}
                              placeholder="Confirm Password *"
                              name="conPassword"
                              onChange={onChange}
                            />
                            {customerFormErrors?.conPassword && (
                              <p className="error-msg">
                                {customerFormErrors?.conPassword}
                              </p>
                            )}
                            <span className="password-eye1">
                              {conVisibile === true ? (
                                <ImEyeBlocked onClick={ConToggleEye} />
                              ) : (
                                <FaRegEye onClick={ConToggleEye} />
                              )}
                            </span>
                          </div>
                        </div>

                        <div className="form-group fullWidth">
                          <button type="submit">Sign up</button>
                        </div>
                      </form>
                      <p className="formOptionalLine">
                        <span className="or-line">OR </span>
                      </p>
                      <div className="signWithGoogle">
                        <GoogleLogin
                          onSuccess={handleGoogleSignup}
                          onError={() => console.log("Google Signup Failed")}
                          size="medium"
                          text="sign up with google"
                          theme="outlined"
                        />
                      </div>
                      {/* <div className="google-login-wrapper">
                        <GoogleLogin
                          onSuccess={responseMessage}
                          onError={errorMessage}
                          theme="outline" // options: "outline", "filled_blue", "filled_black"
                          size="medium" // options: "small", "medium", "large"
                          text="signin_with" // Change text format
                        />
                      </div> */}
                      {/* <div className="leafImg">
                      </div> */}
                      <img
                        className="formLeaf"
                        src="assets/images/formLeafe.png"
                        alt=""
                      />
                    </div>
                  </div>
                  <div className="col-lg-6 col-md-6 rightColumn">
                    <div className="peopleImage">
                      <h2 className="customerTitleHead">
                        Be Part of Our 10,000+ <br /> Interiors Family
                      </h2>
                      <img src="assets/images/cust1.png" alt="" />
                    </div>
                    <div className="firstBg">
                      <img src="assets/images/cust2.png" alt="" />
                    </div>
                  </div>
                </div>
              </div>
            </TabPanel>
            <TabPanel>
              <div className=" registerForms vendor">
                <div className="row">
                  <div className="col-lg-6 col-md-6">
                    <div className="formBlock two">
                      <h3>Vendor Registration 👋</h3>
                      {/* <p>
                        Already have an account? <Link to="/login">Log in</Link>
                      </p> */}
                      <form
                        action="#"
                        className="formSubmit registrations errs vendorForm"
                        onSubmit={registerAsCustomer}
                      >
                        <div className="row">
                          <div className="form-group col-md-6">
                            {/* <span className="errorSymbol position">*</span> */}
                            <input
                              type="text"
                              id="vendorFirstName"
                              className={`form-control form-control1 ${customerFormErrors.VendorFirstName
                                ? "input-error"
                                : ""
                                }`}
                              placeholder="First Name *"
                              name="VendorFirstName"
                              onChange={onChange}
                            />
                            {customerFormErrors?.VendorFirstName && (
                              <p className="error-msg">
                                {customerFormErrors?.VendorFirstName}
                              </p>
                            )}
                          </div>
                          <div className="form-group col-md-6">
                            <input
                              type="text"
                              id="CustomerLastName"
                              className={`form-control form-control1 ${customerFormErrors.vendorLastName
                                ? "input-error"
                                : ""
                                }`}
                              placeholder="Last Name *"
                              name="vendorLastName"
                              onChange={onChange}
                            />
                            {customerFormErrors?.vendorLastName && (
                              <p className="error-msg">
                                {customerFormErrors?.vendorLastName}
                              </p>
                            )}
                          </div>
                        </div>
                        <div className="row">
                          <div className="form-group col-md-6">
                            {/* <span className="errorSymbol position">*</span> */}
                            <input
                              id="vendorEmail"
                              type="text"
                              className={`form-control form-control1 exceptC ${customerFormErrors.vendorEmail
                                ? "input-error"
                                : ""
                                }`}
                              placeholder="Email Address *"
                              name="vendorEmail"
                              onChange={onChange}
                            />
                            {customerFormErrors?.vendorEmail && (
                              <p className="error-msg">
                                {customerFormErrors?.vendorEmail}
                              </p>
                            )}
                          </div>
                          <div className="form-group col-md-6">
                            {/* <span className="errorSymbol position">*</span> */}

                            <div className="registerFormCountry">
                              {/* <input
                                type="number"
                                id="customerMobile"
                                className={`form-control form-control1 ${
                                  customerFormErrors.vendorEmail
                                    ? "input-error"
                                    : ""
                                }`}
                                placeholder="Mobile No *"
                                name="vendorMobileNo"
                                onChange={onChange}
                              /> */}
                              <PhoneInput
                                international
                                defaultCountry="IN"
                                value={form.vendorMobileNo || ""}
                                onChange={(value) =>
                                  setForm((prev) => ({
                                    ...prev,
                                    vendorMobileNo: value,
                                  }))
                                }
                                // className="search-clsp22 inputField countryCode"
                                className={`form-control form-control1 registerNumberInput ${customerFormErrors.vendorMobileNo
                                  ? "input-error"
                                  : ""
                                  }`}
                                placeholder="Mobile No *"
                                name="vendorMobileNo"
                                maxLength="18"
                              />
                            </div>
                            {customerFormErrors?.vendorMobileNo && (
                              <p className="error-msg">
                                {customerFormErrors?.vendorMobileNo}
                              </p>
                            )}
                          </div>
                        </div>
                        <div className="row">
                          <div className="form-group col-md-6">
                            <input
                              id="customerAddress"
                              type="text"
                              className={`form-control form-control1 ${customerFormErrors.vendorAddress
                                ? "input-error"
                                : ""
                                }`}
                              placeholder="Address *"
                              name="vendorAddress"
                              onChange={onChange}
                            />
                            {customerFormErrors?.vendorAddress && (
                              <p className="error-msg">
                                {customerFormErrors?.vendorAddress}
                              </p>
                            )}
                          </div>
                          <div className="form-group col-md-6">
                            <input
                              type="text"
                              id="vendorStreet"
                              className={`form-control form-control1 ${customerFormErrors.vendorStreet
                                ? "input-error"
                                : ""
                                }`}
                              placeholder="Street *"
                              name="vendorStreet"
                              onChange={onChange}
                            />
                            {customerFormErrors?.vendorStreet && (
                              <p className="error-msg">
                                {customerFormErrors?.vendorStreet}
                              </p>
                            )}
                          </div>

                          {/* <div className="form-group col-md-6">
                          <input
                            type="text"
                            id="VendorCountry"
                            className="form-control form-control1"
                            placeholder="Country"
                            name="vendorCountry"
                          />
                          <p id="errText" className="error-msg"></p>
                        </div> */}
                        </div>
                        <div className="row">
                          <div className="form-group col-md-6">
                            <input
                              type="text"
                              id="VendorLocality"
                              className={`form-control form-control1 ${customerFormErrors.vendorLocality
                                ? "input-error"
                                : ""
                                }`}
                              placeholder="Locality *"
                              name="vendorLocality"
                              onChange={onChange}
                            />
                            {customerFormErrors?.vendorLocality && (
                              <p className="error-msg">
                                {customerFormErrors?.vendorLocality}
                              </p>
                            )}
                          </div>
                          <div className="form-group col-md-6">
                            <input
                              type="text"
                              id="vendorCity"
                              className="form-control form-control1"
                              placeholder="City"
                              name="vendorCity"
                              onChange={onChange}
                              value="Hyderabad"
                              readOnly
                            />
                          </div>
                        </div>
                        <div className="row">
                          <div className="form-group col-md-6">
                            <input
                              type="text"
                              id="vendorState"
                              className="form-control form-control1"
                              placeholder="State"
                              name="vendorState"
                              onChange={onChange}
                              value="Telangana"
                              readOnly
                            />
                          </div>
                          <div className="form-group col-md-6">
                            <div
                              className={`selectSignOut ${customerFormErrors.vendorClassification
                                ? "input-error"
                                : ""
                                }`}
                            >
                              <select
                                className="form-control form-control1 col-sel dropOption "
                                id="vendorClass"
                                name="vendorClassification"
                                onChange={onChange}
                              >
                                <option
                                  className="optionsign firstOpt"
                                  value=""
                                  disabled
                                  hidden
                                  selected
                                >
                                  Select Classification *
                                </option>
                                <option className="optionsign" value="Diamond">
                                  Diamond
                                </option>
                                <option className="optionsign" value="Platinum">
                                  Platinum
                                </option>
                                <option className="optionsign" value="Gold">
                                  Gold
                                </option>

                                <option className="optionsign" value="Silver">
                                  Silver
                                </option>
                                <option className="optionsign" value="Bronze">
                                  Bronze
                                </option>
                              </select>
                            </div>
                            {customerFormErrors?.vendorClassification && (
                              <p className="error-msg">
                                {customerFormErrors?.vendorClassification}
                              </p>
                            )}
                          </div>
                        </div>
                        <div className="row">
                          <div className="form-group col-md-6">
                            <div
                              className={`selectSignOut ${customerFormErrors.vendorCompany
                                ? "input-error"
                                : ""
                                }`}
                            >
                              <select
                                className="form-control form-control1 dropOption"
                                id="VendorCompany"
                                name="vendorCompany"
                                onChange={onChange}
                              >
                                <p id="errText" className="error-msg"></p>
                                <option
                                  className="optionsign"
                                  value=""
                                  disabled
                                  hidden
                                  selected
                                >
                                  Select Company Type *
                                </option>
                                <option
                                  className="optionsign"
                                  value="Registered"
                                >
                                  Registered Company
                                </option>
                                <option
                                  className="optionsign"
                                  value="Individual"
                                >
                                  Individual(self)
                                </option>
                              </select>
                            </div>
                            {customerFormErrors?.vendorCompany && (
                              <p className="error-msg">
                                {customerFormErrors?.vendorCompany}
                              </p>
                            )}
                          </div>

                          {showPanField && (
                            <>
                              <div className="form-group col-md-6">
                                {/* <span className="errorSymbol position">*</span> */}
                                <input
                                  type="text"
                                  id="vendorPancard"
                                  className={`form-control form-control1 upperCase ${customerFormErrors.vendorPanNo
                                    ? "input-error"
                                    : ""
                                    }`}
                                  placeholder="PAN No *"
                                  name="vendorPanNo"
                                  onChange={onChange}
                                />
                                {customerFormErrors?.vendorPanNo && (
                                  <p className="error-msg">
                                    {customerFormErrors?.vendorPanNo}
                                  </p>
                                )}
                              </div>
                              <div className="form-group col-md-6">
                                <input
                                  id="companyName"
                                  type="text"
                                  className="form-control form-control1"
                                  placeholder="Company Name"
                                  name="vendorCompanyName"
                                  onChange={onChange}
                                />
                              </div>
                            </>
                          )}
                          {showGstField && (
                            <>
                              <div className="form-group col-md-6">
                                {/* <span className="errorSymbol position">*</span> */}
                                <input
                                  type="text"
                                  id="vendorGstNo"
                                  className={`form-control form-control1 upperCase ${customerFormErrors.vendorGstNo
                                    ? "input-error"
                                    : ""
                                    }`}
                                  placeholder="GST No *"
                                  name="vendorGstNo"
                                  onChange={onChange}
                                />
                                {customerFormErrors?.vendorGstNo && (
                                  <p className="error-msg">
                                    {customerFormErrors?.vendorGstNo}
                                  </p>
                                )}
                              </div>
                              <div className="form-group col-md-6">
                                <input
                                  id="companyName"
                                  type="text"
                                  className="form-control form-control1"
                                  placeholder="Company Name"
                                  name="vendorCompanyName"
                                  onChange={onChange}
                                />
                              </div>
                            </>
                          )}
                        </div>

                        <div className="form-group fullWidth vendorWidth">
                          <button type="submit">Sign up</button>
                        </div>
                      </form>
                      {/* <p className="formOptionalLine">
                        &mdash;&mdash;&mdash;&mdash;&mdash; OR
                        &mdash;&mdash;&mdash;&mdash;&mdash;
                      </p>
                      <div className="signWithGoogle">
                        <GoogleLogin
                          onSuccess={handleGoogleSignup}
                          onError={() => console.log("Google Signup Failed")}
                        />

                     
                      </div> */}
                      {/* <div className="leafImg">
                      </div> */}
                      <img
                        className="formLeaf"
                        src="assets/images/formLeafe.png"
                        alt=""
                      />
                    </div>
                  </div>
                  <div className="col-lg-6 col-md-6 rightColumnTwo">
                    <div className="peopleImageTwo">
                      <img src="assets/images/vend11.png" alt="" />
                    </div>
                    <div className="firstBgTwo">
                      <img src="assets/images/vend2.png" alt="" />
                    </div>
                  </div>
                </div>
              </div>
            </TabPanel>
          </Tabs>
        </div>
      </section>
      <Sonner />
    </>
  );
};

export default SignUp;
