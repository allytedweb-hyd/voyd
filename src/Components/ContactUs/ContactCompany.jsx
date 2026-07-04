import { environmentUrl } from "../../env/enviroment";
import { toast } from "sonner";
import Sonner from "../Toaster/Sonner";
import { useState } from "react";
import Loader from "../Spinner/Loader";
import { regexPatterns } from "../../libs/constant";
import "react-phone-number-input/style.css";
import PhoneInput from "react-phone-number-input";
import SEO from "../SEO";

const ContactCompany = () => {
  const [loading, setLoading] = useState(false);
  const [formData, setForm] = useState({});
  const [formErrors, setFormErrors] = useState({});

  const onChange = (event) => {
    setForm({
      ...formData,
      city: "Hyderabad",
      state: "Telangana",
      [event.target.name]: event.target.value,
    });
  };
  const validateFields = () => {
    const errors = {};

    if (!formData.firstName) {
      errors.firstName = "Enter first name";
    } else if (!regexPatterns.alphabetsregex.test(formData.firstName)) {
      errors.firstName = "Name must be in letters only";
    }
    if (!formData.lastName) {
      errors.lastName = "Enter last name";
    } else if (!regexPatterns.alphabetsregex.test(formData.lastName)) {
      errors.lastName = "Name must be in letters only";
    }

    if (!formData.mobileNum) {
      errors.mobileNum = "Enter Mobile Number";
    } else if (
      !regexPatterns.mobileregexInternational.test(formData.mobileNum)
    ) {
      errors.mobileNum = "Enter  valid number";
    }

    if (!formData.email) {
      errors.email = "Enter an email address";
    } else if (!regexPatterns.emailregex.test(formData.email)) {
      errors.email = "Enter a valid email address";
    }
    if (!formData.message) {
      errors.message = "Enter message";
    }

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

      const apiUrl = `${environmentUrl}/contact/contactQueries.php`;
      const options = {
        method: "POST",
        body: JSON.stringify(formData),
      };
      const response = await fetch(apiUrl, options);
      const fetchedData = await response.json();
      console.log("contact query response====", fetchedData.status);
      if (fetchedData?.status === true) {
        toast.success("Thank you. Assistance will be provided shortly.");
        setForm({});
        event.target.reset();
        setFormErrors({});
      } else {
        toast.error("Something went wrong, please try again");
      }
    } catch (error) {
      console.log("contact company error", error);
    } finally {
      setLoading(false);
    }
  };

  return (
    
    <>
      <SEO
        title="Start Your Interior Journey with VOYD"
        description="Speak with our experts and discover a smarter approach to interiors, automation, quality assurance, and execution."
        keywords="contact interior experts, interior consultation, interior design consultation, interior project consultation, talk to interior experts, book interior consultation, interior project assistance,design consultation services"
      />
      {loading && <Loader />}
      <div>
        <section className="bg-contact breadCrumb">
          <div className="container">
            <div className="row">
              <div className="col-md-6 d-flex j-end align-items-center">
                <div className="con-headng">Contact Us</div>
              </div>
              <div className="col-md-6">
                <div className="contactShow">
                  <img
                    src="assets/images/pixelcut-export (28)-Photoroom (1) 1 (1).png"
                    alt=""
                  />
                </div>
              </div>
            </div>
          </div>
        </section>
        <section className="contact-overflow pt-0 contactDetails">
          <div className="tab-flex d-mob">
            <img
              src="assets/images/10322390-Photoroom 1.png"
              alt=""
              className="leaves-con"
            />
          </div>
          <div className="container con-c">
            <div className="row tab-rev">
              <div className="col-md-6">
                <div className="contact-container">
                  <h2 className="contact-title">
                    Ready to Start Your{" "}
                    <span className="highlight">Project</span> ?
                  </h2>
                  <p className="contact-subtitle">
                    Bring your vision to life - contact us today to explore how
                    we can support your growth and innovation
                  </p>
                  <div className="contact-section">
                    <div className="contact-item">
                      <div className="d-flex">
                        <img
                          src="assets/images/Group 1618873841.png"
                          alt=""
                          className="wid-location"
                        />
                      </div>
                      <div className="text-start">
                        <h3 className="contact-heading">Where Are We ?</h3>
                        <p className="contact-text">
                          Plot No 28 28/A, Survey No 40, Financial District
                          Road, Raidurgam Khajaguda Village, Serilingampally
                          Mandal, Rangareddy Dist, Hyderabad, Telangana, India
                        </p>
                      </div>
                    </div>
                    <hr />
                    <div className="contactItemOuter">
                      <div className="contact-item">
                        <div className="d-flex">
                          <img
                            src="assets/images/Group 1618873842.png"
                            alt=""
                            className="w-77"
                          />
                        </div>
                        <div className="text-start">
                          <h3 className="contact-heading">Call Us</h3>
                          {/* <p className="contact-text">+91 86395 64626</p>
                          <p className="contact-text">+91 81795 92757</p> */}
                          <p className="contact-text">+91 9115 833 833</p>
                        </div>
                      </div>

                      <div className="contact-item">
                        <div className="d-flex">
                          <img
                            src="assets/images/Group 1618873843.png"
                            alt=""
                            className="w-77"
                          />
                        </div>
                        <div className="text-start">
                          <h3 className="contact-heading">Office Hours</h3>
                          <p className="contact-text">
                            Mon - Sat: 10 am - 06 pm
                          </p>
                          <p className="contact-text">Sun: 10 am - 02 pm</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div className="col-md-6 mob-cen">
                <div className="card-c contactC">
                  <h2 className="title-c">GET IN CONTACT</h2>
                  {/* <p className="subtitle-c">
                    24/7 we will answer your questions and problems
                  </p> */}
                  <form
                    method="post"
                    className="contactForm"
                    onSubmit={submitQuery}
                  >
                    <div className="two-inp">
                      <div className="wd-hlf">
                        <input
                          type="text"
                          placeholder="First Name *"
                          className={
                            formErrors.firstName
                              ? "input-c name-set input-error"
                              : "input-c name-set"
                          }
                          name="firstName"
                          onChange={onChange}
                        />
                        {formErrors?.firstName && (
                          <p className="error-msg">{formErrors?.firstName}</p>
                        )}
                      </div>

                      <div className="wd-hlf">
                        {" "}
                        <input
                          type="text"
                          placeholder="Last Name *"
                          className={
                            formErrors.lastName
                              ? "input-c name-set input-error"
                              : "input-c name-set"
                          }
                          name="lastName"
                          onChange={onChange}
                        />
                        {formErrors?.lastName && (
                          <p className="error-msg">{formErrors?.lastName}</p>
                        )}
                      </div>
                    </div>
                    <div>
                      <input
                        type="email"
                        placeholder="Email Address *"
                        className={
                          formErrors.email
                            ? "input-c w-100 mb-rem input-error"
                            : "input-c w-100 mb-rem"
                        }
                        name="email"
                        onChange={onChange}
                      />
                      {formErrors?.email && (
                        <p className="error-msg">{formErrors?.email}</p>
                      )}
                    </div>
                    <div
                      className={
                        formErrors.mobileNum
                          ? "input-c w-100 mb-rem contactCountry input-error"
                          : "input-c w-100 mb-rem contactCountry"
                      }
                    >
                      {/* <input
                        type="text"
                        placeholder="Mobile No *"
                        maxLength="10"
                        className={
                          formErrors.mobileNum
                            ? "input-c w-100 mb-rem input-error"
                            : "input-c w-100 mb-rem"
                        }
                        name="mobileNum"
                        onChange={onChange}
                      /> */}
                      <PhoneInput
                        international
                        defaultCountry="IN"
                        value={formData.mobileNum || ""}
                        onChange={(value) =>
                          setForm((prev) => ({
                            ...prev,
                            mobileNum: value,
                          }))
                        }
                        className="search-clsp22 inputField countryCode"
                        placeholder="Mobile No *"
                        name="mobile"
                        maxLength="18"
                      />
                    </div>
                    {formErrors?.mobileNum && (
                      <p className="error-msg">{formErrors?.mobileNum}</p>
                    )}
                    <div>
                      <textarea
                        placeholder="Message *"
                        className={
                          formErrors.message
                            ? "textarea-c w-100 p-2 input-error"
                            : "textarea-c w-100 p-2"
                        }
                        name="message"
                        onChange={onChange}
                      ></textarea>
                      {formErrors?.message && (
                        <p className="error-msg msg">{formErrors?.message}</p>
                      )}
                    </div>
                    <button type="submit" className="button-c w-100 p-2">
                      SUBMIT
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section>
          <div id="map">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30455.40290108078!2d78.32387997657166!3d17.41536916548934!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb9475a2b02fdf%3A0x75429547763690ef!2sKhajaguda%2C%20Telangana!5e0!3m2!1sen!2sin!4v1746092864824!5m2!1sen!2sin"
              width="100%"
              height="100%"
              style={{ border: 0 }}
              allowFullScreen=""
              loading="lazy"
              referrerPolicy="no-referrer-when-downgrade"
            ></iframe>
          </div>
        </section>
      </div>
      <Sonner />
    </>
  );
};

export default ContactCompany;
