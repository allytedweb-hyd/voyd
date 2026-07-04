/* eslint-disable react/prop-types */
import Modal from "react-bootstrap/Modal";
import { HiOutlineExclamationCircle } from "react-icons/hi";
import { IoCallOutline } from "react-icons/io5";
import { CiMail } from "react-icons/ci";
import { useState, useEffect } from "react";
import { environmentUrl } from "../../env/enviroment";
import { toast } from "sonner";
import Sonner from "../Toaster/Sonner";
import Loader from "../Spinner/Loader";
import { regexPatterns } from "../../libs/constant";
import "react-phone-number-input/style.css";
import PhoneInput from "react-phone-number-input";
import SEO from "../SEO";

const CustomerSupport = ({ openCustomerSupport, closeCustomerSupport }) => {
  const [formData, setFormData] = useState({});
  const [loading, setLoading] = useState(false);
  const [formErrors, setFormErrors] = useState({});
  const handleUserInput = (event) => {
    setFormData({
      ...formData,
      [event.target.name]: event.target.value,
    });
  };

  useEffect(() => {
    if (openCustomerSupport) {
      // Reset form and errors when modal opens
      setFormData({
        customerName: "",
        email: "",
        mobile: "",
        subject: "",
        query: "",
      });
      setFormErrors({});
    }
  }, [openCustomerSupport]);

  const validateFields = () => {
    const errors = {};

    if (!formData.customerName) {
      errors.customerName = "Enter name";
    } else if (!regexPatterns.alphabetsregex.test(formData.customerName)) {
      errors.customerName = "Name must be in letters only";
    }

    // if (!formData.mobile) {
    //   errors.mobile = "Enter mobile number";
    // } else if (!regexPatterns.mobileregex.test(formData.mobile)) {
    //   errors.mobile = "Enter a valid 10 digit mobile number";
    // }
    if (!formData.mobile) {
      errors.mobile = "Enter Mobile Number";
    } else if (!regexPatterns.mobileregexInternational.test(formData.mobile)) {
      errors.mobile = "Enter valid number";
    }

    if (!formData.email) {
      errors.email = "Enter an email address";
    } else if (!regexPatterns.emailregex.test(formData.email)) {
      errors.email = "Enter a valid email address";
    }
    if (!formData.subject) {
      errors.subject = "Enter issue type";
    }
    // else if (!regexPatterns.alphabetsregex.test(formData.subject)) {
    //   errors.subject = "Message is invalid It accepts only characters";
    // }

    if (!formData.query) {
      errors.query = "Enter message";
    }
    // else if (!regexPatterns.alphaNumeric.test(formData.query)) {
    //   errors.query = "Query is invalid It accepts only characters";
    // }

    return errors;
  };

  const submitQuery = async (event) => {
    event.preventDefault();
    const errors = validateFields();
    const isValid = Object.keys(errors).length === 0;
    setFormErrors(errors);
    if (!isValid) {
      toast.warning("Please fill all Mandatory Fields");
      return;
    }
    try {
      setLoading(true);
      const apiUrl = `${environmentUrl}/contact/customerSupportMail.php`;
      const options = {
        method: "POST",
        body: JSON.stringify(formData),
      };
      const response = await fetch(apiUrl, options);
      const fetchedData = await response.json();
      console.log("contact query response====", fetchedData.status);
      if (fetchedData?.status === true) {
        setFormData({});
        setFormErrors({});
        closeCustomerSupport();
        toast.success(fetchedData?.message);
      } else {
        toast.error("Something went wrong, please try again");
      }
    } catch (error) {
      toast.error("Something went wrong, please try again");
    } finally {
      setLoading(false);
    }
  };

  return (
    <>
      <SEO
        title="Customer Support | We're With You Every Step"
        description="Get dedicated assistance for project updates, inspections, quality checks, approvals, and interior execution support."
        keywords="customer support, customer assistance, project support, 
help center"
      />
      {loading && <Loader />}
      <Modal
        show={openCustomerSupport}
        onHide={closeCustomerSupport}
        size="lg"
        className="ref-frnd support-customer mblCust"
        centered
        backdrop="static"
      >
        <Modal.Header
          closeButton
          className="customerCloseBtn supportClose"
        ></Modal.Header>
        <form method="post" onSubmit={submitQuery}>
          <div className="row  supportBlockRow">
            <div className="col-md-5 col-sm-6">
              <div className="supportFormOuter">
                <img src="assets/images/poll.png" className="pollImg" alt="" />
                <h3>Customer Support</h3>
                <div className="contacts">
                  <div>
                    <CiMail /> support@voyd.com
                  </div>
                  <div>
                    <IoCallOutline /> +91 9876543212
                  </div>
                </div>
                <div className="dividerLine">
                  <p>or</p>
                </div>
                <h4>Fill out the form below</h4>
                <div className="containerInputOuter">
                  <div
                    className={`input-containering ${
                      formErrors.customerName ? "input-error" : ""
                    }`}
                  >
                    <svg
                      width="10"
                      height="10"
                      className="mx-2"
                      viewBox="0 0 25 25"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M20.6887 22.5764H18.647V20.5231C18.647 18.8222 17.276 17.4433 15.5845 17.4433H9.4596C7.76824 17.4433 6.39712 18.8222 6.39712 20.5231V22.5764H4.35547V20.5231C4.35547 17.6883 6.64067 15.3901 9.4596 15.3901H15.5845C18.4035 15.3901 20.6887 17.6883 20.6887 20.5231V22.5764ZM12.5221 13.3369C9.13935 13.3369 6.39712 10.5791 6.39712 7.17723C6.39712 3.77535 9.13935 1.01758 12.5221 1.01758C15.9048 1.01758 18.647 3.77535 18.647 7.17723C18.647 10.5791 15.9048 13.3369 12.5221 13.3369ZM12.5221 11.2837C14.7772 11.2837 16.6054 9.44516 16.6054 7.17723C16.6054 4.90931 14.7772 3.0708 12.5221 3.0708C10.2669 3.0708 8.43877 4.90931 8.43877 7.17723C8.43877 9.44516 10.2669 11.2837 12.5221 11.2837Z"
                        fill="#504A4A"
                      />
                    </svg>
                    <input
                      type="text"
                      placeholder="Name *"
                      onChange={handleUserInput}
                      name="customerName"
                    />
                  </div>
                  {formErrors?.customerName && (
                    <p className="error-msg">{formErrors?.customerName}</p>
                  )}
                  <div
                    className={`input-containering customerCountry ${
                      formErrors.customerName ? "input-error" : ""
                    }`}
                  >
                    {/* <svg
                      width="10"
                      height="10"
                      className="mx-2"
                      viewBox="0 0 20 20"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M1.87077 10.7248C3.45206 13.871 6.0063 16.4237 9.15434 18.0041L10.5507 18.7019C11.4964 19.1824 12.5412 19.4361 13.6021 19.4427C14.1553 19.4463 14.7063 19.3739 15.2398 19.2274C16.0331 19.0161 16.7691 18.6304 17.3939 18.0983C18.0188 17.5662 18.5168 16.9012 18.8514 16.152L19.1962 15.4025C19.2808 15.2184 19.2978 15.0104 19.2442 14.8151C19.1906 14.6197 19.0698 14.4495 18.9031 14.3343L14.464 11.2331C14.3275 11.1339 14.165 11.077 13.9964 11.0693C13.8279 11.0617 13.6608 11.1036 13.5159 11.19L12.6539 11.7069C11.9192 12.0579 11.0801 12.1236 10.2997 11.8912C9.51919 11.6588 8.85296 11.1448 8.4303 10.4491C8.09859 9.96936 7.90612 9.40724 7.87417 8.82495C7.84222 8.24266 7.97205 7.66289 8.24929 7.14975L8.6975 6.35721C8.77677 6.2163 8.81477 6.05593 8.80715 5.89446C8.79953 5.73298 8.7466 5.5769 8.65441 5.44407L5.55135 0.973111C5.43608 0.806489 5.26575 0.685793 5.07028 0.632228C4.8748 0.578662 4.6667 0.595653 4.48252 0.680215L3.73261 1.0248C2.98296 1.35922 2.31759 1.8569 1.78517 2.48141C1.25276 3.10593 0.866756 3.84149 0.655409 4.6343C0.233341 6.21163 0.417859 7.88976 1.17259 9.33785L1.87077 10.7248ZM2.31037 5.09087C2.48216 4.44083 2.82089 3.84692 3.29301 3.36796C3.62555 3.0407 4.01374 2.77525 4.43942 2.58403L4.53423 2.54096L6.91325 5.98679L6.73223 6.30552C6.29838 7.09721 6.0921 7.99341 6.13622 8.89498C6.18033 9.79655 6.47312 10.6684 6.9822 11.414C7.64325 12.4656 8.67131 13.2346 9.86724 13.572C11.0632 13.9094 12.3418 13.7912 13.4555 13.2402L13.9124 12.9818L17.3602 15.3594L17.3171 15.4628C17.1261 15.8884 16.8605 16.2764 16.5327 16.6085C16.0542 17.0832 15.46 17.4247 14.8088 17.5992C13.6502 17.8997 12.4211 17.7585 11.361 17.2029L9.93011 16.4793C7.11368 15.0654 4.82848 12.7815 3.41368 9.96671L2.7155 8.57115C2.14798 7.50306 2.00336 6.26065 2.31037 5.09087Z"
                        fill="#504A4A"
                      />
                    </svg> */}

                    {/* <input
                      type="number"
                      placeholder="Mobile No *"
                      onChange={handleUserInput}
                      name="mobile"
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
                  </div>
                  {formErrors?.mobile && (
                    <p className="error-msg">{formErrors?.mobile}</p>
                  )}

                  <div
                    className={`input-containering ${
                      formErrors.email ? "input-error" : ""
                    }`}
                  >
                    <svg
                      width="10"
                      height="10"
                      className="mx-2"
                      viewBox="0 0 22 17"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M19.3156 16.1555H2.63261C1.41903 16.1537 0.435366 15.1701 0.433594 13.9565V2.4119C0.435369 1.19833 1.41901 0.214663 2.63261 0.212891H19.3156C20.5291 0.214666 21.5128 1.19831 21.5146 2.4119V13.9565C21.5128 15.1701 20.5292 16.1538 19.3156 16.1555ZM2.76579 14.7351H19.1824L14.1177 9.23267C13.4554 9.95266 12.913 10.5404 12.5943 10.8866H12.5951C12.1672 11.318 11.5849 11.5604 10.9767 11.5613C10.3695 11.5622 9.78623 11.3207 9.35745 10.8901C9.03252 10.5377 8.49009 9.94823 7.83047 9.23178L2.76579 14.7351ZM15.0836 8.18428L20.0933 13.6272L20.0942 2.7414C18.8282 4.11656 16.7704 6.35294 15.0836 8.18428ZM1.85398 2.7414V13.6272L6.86459 8.18428C5.17871 6.35369 3.12533 4.12274 1.85398 2.7414ZM2.76572 1.63346C4.80494 3.84845 9.16836 8.58904 10.3979 9.92357C10.5506 10.078 10.7592 10.165 10.9767 10.1642C11.1942 10.1633 11.402 10.0754 11.5547 9.92002C12.7576 8.615 17.153 3.84057 19.1832 1.63355L2.76572 1.63346Z"
                        fill="#504A4A"
                      />
                    </svg>

                    <input
                      type="email"
                      placeholder="Email Address *"
                      onChange={handleUserInput}
                      name="email"
                    />
                  </div>
                  {formErrors?.email && (
                    <p className="error-msg">{formErrors?.email}</p>
                  )}

                  <div
                    className={`input-containering ${
                      formErrors.subject ? "input-error" : ""
                    }`}
                  >
                    <HiOutlineExclamationCircle />

                    <input
                      type="text"
                      placeholder="Issue Type *"
                      onChange={handleUserInput}
                      name="subject"
                    />
                  </div>
                  {formErrors?.subject && (
                    <p className="error-msg">{formErrors?.subject}</p>
                  )}
                </div>

                <div className="messageInput areaTect">
                  <textarea
                    placeholder="Message *"
                    rows={4}
                    onChange={handleUserInput}
                    name="query"
                    className={`${formErrors.query ? "input-error" : ""}`}
                  ></textarea>
                </div>
                {formErrors?.query && (
                  <p className="error-msg msg">{formErrors?.query}</p>
                )}

                <div className="supportSubmit">
                  <button
                    type="submit"
                    className="btn btn-success next-but2 w-100 text-capitalize mt-2"
                  >
                    SEND MESSAGE
                  </button>
                </div>
              </div>
              <div className="mobileCusImg">
                <img src="assets/images/custMotImgg.png" alt="" />
              </div>
            </div>

            <div className="col-md-7 col-sm-6 tabViewLists">
              <div className="supportImgColumn">
                <img src="assets/images/supportTextbg.png" alt="" />
              </div>
              <div className="supportImage">
                <img src="assets/images/supportImg2.png" alt="" />
              </div>
            </div>
          </div>
        </form>
      </Modal>
      <Sonner />
    </>
  );
};
export default CustomerSupport;
