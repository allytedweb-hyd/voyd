import { Link } from "react-router-dom";
// import { BiLogoFacebook } from "react-icons/bi";
// import { FaXTwitter } from "react-icons/fa6";
// import { GrGooglePlus } from "react-icons/gr";
// import { TfiYoutube } from "react-icons/tfi";
import { FaInstagram } from "react-icons/fa";
// import { BiPaperPlane } from "react-icons/bi";
// import { AiOutlineCopyrightCircle } from "react-icons/ai";
// import { MdKeyboardDoubleArrowRight } from "react-icons/md";
// import { IoLocationSharp } from "react-icons/io5";
// import { BsYoutube } from "react-icons/bs";
import { GrLocation } from "react-icons/gr";
import { MdMailOutline } from "react-icons/md";
import { IoCallOutline } from "react-icons/io5";
import { FaFacebookF, FaYoutube } from "react-icons/fa";
import { FaLinkedinIn, FaPinterestP } from "react-icons/fa";
import { FaXTwitter } from "react-icons/fa6";
import { useState } from "react";
import { environmentUrl } from "../../env/enviroment";
import { toast } from "sonner";
import Loader from "../Spinner/Loader";
import Sonner from "../Toaster/Sonner";
import { regexPatterns } from "../../libs/constant";
import "react-phone-number-input/style.css";
import PhoneInput from "react-phone-number-input";
import { parsePhoneNumberFromString } from 'libphonenumber-js';

const Footer = () => {
  const [loading, setLoading] = useState(false);
  const [formData, setFormData] = useState({});
  const [formErrors, setFormErrors] = useState({});

  const handleUserInput = (event) => {
    setFormData({
      ...formData,
      [event.target.name]: event.target.value,
    });
  };

  const validateFields = () => {
    let validationErrors = {};

    if (!formData.role) {
      validationErrors.role = "Select Role";
    }

    if (!formData.name) {
      validationErrors.name = "Enter Name";
    }
    if (!formData.mobile) {
      validationErrors.mobile = "Enter Mobile Number";
    } else if (!regexPatterns.mobileregexInternational.test(formData.mobile)) {
      validationErrors.mobile = "Enter valid number";
    }
    return validationErrors;
  };

  // const getInTouch = async (event) => {
  //   event.preventDefault();
  //   setLoading(true);

  //   try {
  //     const errors = validateFields();
  //     console.log("errors====", errors);
  //     const isValid = Object.keys(errors).length === 0;
  //     setFormErrors(errors);
  //     if (!isValid) {
  //       toast.warning("Please fill all Mandatory Fields");
  //       return;
  //     }
  //     const apiUrl = `${environmentUrl}/contact/stayInTouch.php`;
  //     const options = {
  //       method: "post",
  //       body: JSON.stringify(formData),
  //     };
  //     const response = await (await fetch(apiUrl, options)).json();
  //     if (response?.status) {
  //       toast.success(response?.response);
  //       setFormData({});
  //       setFormErrors({});
  //       event.target.reset();
  //     }
  //   } catch (error) {
  //     console.log("get in touch error is===", error);
  //   } finally {
  //     setLoading(false);
  //   }
  // };


  const getInTouch = async (event) => {
    event.preventDefault();
    setLoading(true);

    try {
      const errors = validateFields();
      const isValid = Object.keys(errors).length === 0;
      setFormErrors(errors);
      if (!isValid) {
        toast.warning("Please fill all Mandatory Fields");
        return;
      }


      const phoneNumberObj = parsePhoneNumberFromString(formData.mobile || "");

      let combinedNumber = "";
      if (phoneNumberObj) {

        const countryCode = '+' + phoneNumberObj.countryCallingCode;
        const nationalNumber = phoneNumberObj.nationalNumber;
        combinedNumber = `${countryCode}-${nationalNumber}`;
      }


      const dataToSend = {
        ...formData,
        mobile: combinedNumber,
      };

      const apiUrl = `${environmentUrl}/contact/stayInTouch.php`;
      const options = {
        method: "POST",
        body: JSON.stringify(dataToSend),
      };

      const response = await (await fetch(apiUrl, options)).json();
      if (response?.status) {
        toast.success(response?.response);
        setFormData({});
        setFormErrors({});
        event.target.reset();
      }
    } catch (error) {
      console.log("get in touch error is===", error);
    } finally {
      setLoading(false);
    }
  };

  return (
    <>
      {loading && <Loader />}
      <footer>
        <div>
          <div className="footer-wrap footerSection block">
            <div className="container ">
              {/* <!--footer showroom--> */}
              <div className="footer-showroom">
                <div className="row justify-content-center d-block">
                  <div className="">
                    <div>
                      {" "}
                      <h1 className="footer-head text-center ">
                        Get Started With Us
                      </h1>
                    </div>
                    <p className="text-light text-center foter-txt">
                      Your one-stop solution for stylish, functional, and <br />
                      hassle-free interior design and execution.
                    </p>
                    <div className="row touchFormRow positions">
                      <div className="col-md-10 col-sm-12">
                        <form action="" method="post" onSubmit={getInTouch}>
                          <div className="row  bg-back m-auto background-grey">
                            <div className="col-md-3 col-sm-3 d-flex justify-content-center marginZero b-right">
                              {" "}
                              <span className="inp-txt selectOption mbl">
                                <select
                                  name="role"
                                  className="inputField "
                                  id="userrole"
                                  onChange={handleUserInput}
                                >
                                  <option value="" hidden selected>
                                    Who Am I *
                                  </option>
                                  <option value="Customer">Customer</option>
                                  <option value="Designer">Designer</option>
                                  <option value="Vendor">Vendor</option>
                                </select>
                              </span>
                              {formErrors?.role && (
                                <p className="error-msg role">
                                  {formErrors?.role}
                                </p>
                              )}
                            </div>

                            <div className="col-md-3 col-sm-3 d-flex justify-content-center marginZero b-right">
                              {" "}
                              <span className="inp-txt mbl">
                                <input
                                  type="text"
                                  placeholder="Name *"
                                  name="name"
                                  onChange={handleUserInput}
                                  className="inputField "
                                />
                              </span>{" "}
                              {formErrors?.name && (
                                <p className="error-msg">{formErrors?.name}</p>
                              )}
                            </div>

                            <div className="col-md-3 col-sm-3 d-flex justify-content-center marginZero ninty">
                              <span className="inp-txt mbl">
                                {/* <input
                                  type="number"
                                  placeholder="Mobile No *"
                                  maxLength="10"
                                  name="mobile"
                                  onChange={handleUserInput}
                                  className="inputField"
                                /> */}
                                <PhoneInput
                                  international
                                  defaultCountry="IN"
                                  value={formData.mobile || ""}
                                  onChange={(value) =>
                                    setFormData((prev) => ({
                                      ...prev,
                                      mobile: value,
                                    }))
                                  }
                                  className="search-clsp22 inputField countryCode"
                                  placeholder="Mobile No *"
                                  name="mobile"
                                  maxLength="18"
                                />
                              </span>
                              {formErrors?.mobile && (
                                <p className="error-msg num">
                                  {formErrors?.mobile}
                                </p>
                              )}
                            </div>

                            <div className="col-md-3 col-sm-3 d-flex justify-content-end tab-sub mblBlock">
                              <button
                                className="btn btn-succ touchSubmit"
                                type="submit"
                              >
                                submit
                              </button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <div className="row news-div mt-5">
                  <div className="col-md-3 col-sm-6">
                    <div className="footer-box1">
                      <div className="mainLogoBlock">
                        <Link to="/">
                          <img src="assets/images/logo/voydWite.png" />
                        </Link>
                      </div>
                      <p className="wht-dp pt-4">
                        A smart workspace is a digital environment that brings
                        together all the content of workgroup members with their
                        favorite tools.
                      </p>
                    </div>
                  </div>

                  <div className="col-md-3 col-sm-6 siteMapsOuter">
                    <div className="row d-block">
                      <div className="row m-0 p-0">
                        <h5>Sitemap</h5>
                      </div>

                      <div className="row subListRow">
                        <div className="col-md-12">
                          <ul>
                            <li>
                              <Link to="/">Home</Link>
                            </li>
                            <li>
                              <Link to="/about">About</Link>
                            </li>
                            <li>
                              <Link to="/qualitychecker">Quality-Checker</Link>
                            </li>
                            <li>
                              <Link to="/guidespage">Guides</Link>
                            </li>
                            <li>
                              <Link to="/contact">Contact</Link>
                            </li>
                          </ul>
                        </div>

                        {/* <div className="col-md-5">
                          <ul>
                            <li>
                              <Link to="/blogList">Blog</Link>
                            </li>
                          </ul>
                        </div> */}
                      </div>
                    </div>
                    <div className="row d-block twoChild">
                      <div className="row m-0 p-0">
                        <h5>Services</h5>
                      </div>

                      <div className="row subListRow">
                        <div className="col-md-12">
                          <ul>
                            <li>
                              <Link to="/customerservice">Customer</Link>
                            </li>
                            <li>
                              <Link to="/vendorservice">Vendor</Link>
                            </li>
                            <li>
                              <Link to="/shop">E-commerce</Link>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div className="col-md-3 col-sm-6">
                    <div className="row d-block">
                      <div className="row m-0 p-0">
                        <h5>Contact US</h5>
                      </div>

                      <div className="row">
                        <div className="col-md-12 ln-30">
                          <>
                            <div className="wht-dp d-flex">
                              <div>
                                <span className="mr-2">
                                  <GrLocation />
                                </span>
                              </div>{" "}
                              <div className="addressDetailBr">
                                Plot No 28 28/A, Survey No 40, <br /> Financial
                                District Road, <br /> Raidurgam Khajaguda
                                Village, <br />
                                Serilingampally Mandal, <br /> Rangareddy Dist,{" "}
                                <br />
                                Hyderabad, Telangana, India
                                <br />
                              </div>
                            </div>
                          </>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div className="col-md-3 col-sm-6">
                    <div className="row d-block">
                      <div className="row m-0 p-0">
                        <h5>Customer Support</h5>
                      </div>

                      <div className="row">
                        <div className="col-md-12">
                          <div>
                            <div className="wht-dp d-flex underNon mb-2">
                              <div>
                                <span className="mr-2">
                                  <MdMailOutline />
                                </span>
                              </div>{" "}
                              <div>contact@company.com</div>
                            </div>
                            <div className="wht-dp d-flex underNon">
                              <div>
                                <span className="mr-2">
                                  <IoCallOutline />
                                </span>
                              </div>{" "}
                              {/* <div>+91 86395 64626</div> */}
                              <div>+91 9115 833 833</div>
                            </div>
                            <div>
                              <div className="text-light pt-4">
                                Connect with Us:
                              </div>

                              <div className="icon-container1 d-flex">
                                <div className="icon-wrapper">
                                  <a
                                    href="https://www.facebook.com/voydinteriors"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                  >
                                    <FaFacebookF className="icon f-10" />
                                  </a>
                                </div>
                                <div className="icon-wrapper">
                                  <a
                                    href="https://www.instagram.com/voydinteriors/"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                  >
                                    <FaInstagram className="icon f-10" />
                                  </a>
                                </div>
                                <div className="icon-wrapper">
                                  <a
                                    href="https://www.linkedin.com/company/voyd-interior/"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                  >
                                    <FaLinkedinIn className="icon f-10" />
                                  </a>
                                </div>
                                <div className="icon-wrapper">
                                  <a
                                    href="https://www.youtube.com/@VoydInteriors"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                  >
                                    <FaYoutube className="icon f-10" />
                                  </a>
                                </div>
                                <div className="icon-wrapper">
                                  <a
                                    href="https://in.pinterest.com/VOYDinteriors/"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                  >
                                    <FaPinterestP className="icon f-10" />
                                  </a>
                                </div>
                                <div className="icon-wrapper">
                                  <a
                                    href="https://x.com/VOYDInteriors"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                  >
                                    <FaXTwitter className="icon f-10" />
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div className="row brdr-right m-auto">
                    <p className="text-light text-center">
                      @2025 All <span>rights</span> reserved by{" "}
                      <span className="col-ylow">Makersmind</span>
                    </p>
                  </div>
                </div>

                {/* <!--footer links--> */}

                {/* <!--footer social--> */}
              </div>
            </div>
          </div>
        </div>
      </footer>
      <Sonner />
    </>
  );
};

export default Footer;