import Modal from "react-bootstrap/Modal";
import { useState } from "react";
import { regexPatterns } from "../../libs/constant";
import { toast } from "sonner";
import Sonner from "../Toaster/Sonner";
import { environmentUrl } from "../../env/enviroment";
import Loader from "../Spinner/Loader";
import "react-phone-number-input/style.css";
import PhoneInput from "react-phone-number-input";
import { BiSolidDownArrow } from "react-icons/bi";

const BookConsultation = ({ openBookPopup, onCloseBookPopup }) => {
  const [loading, setLoading] = useState(false);
  const [consultation, setConsultation] = useState({
    city: "Hyderabad",
  });
  const [consultationErrors, setConsultationErrors] = useState({});

  const validateForm = () => {
    let errors = {};

    if (!consultation.name) {
      errors.name = "Name is required";
    } else if (!regexPatterns.alphabetsregex.test(consultation.name)) {
      errors.name = "Name must be in letters only";
    }

    // if (!consultation.mobileNum) {
    //   errors.mobileNum = "Phone number is required";
    // }
    if (!consultation.mobileNum) {
      errors.mobileNum = "Enter Mobile Number";
    } else if (
      !regexPatterns.mobileregexInternational.test(consultation.mobileNum)
    ) {
      errors.mobileNum = "Enter valid number";
    }

    if (!consultation.email) {
      errors.email = "Email is required";
    } else if (!regexPatterns.emailregex.test(consultation.email)) {
      errors.email = "Enter a valid email address";
    }

    if (!consultation.locality) {
      errors.locality = "Locality is required";
    }
    // else if (!regexPatterns.alphabetsregex.test(consultation.locality)) {
    //   errors.locality = "Locality type must be in letters";
    // }

    if (!consultation.whoAmI) {
      errors.whoAmI = "Who am i is required";
    }
    if (!consultation.message) {
      errors.message = "Message is required";
    }
    // else if (!regexPatterns.alphabetsregex.test(consultation.message)) {
    //   errors.message = "Message type must be in letters";
    // }

    return errors;
  };

  const handleUserInput = (event) => {
    const { name, value } = event.target;
    setConsultation((prevForm) => ({
      ...prevForm,
      [name]: value,
    }));
  };

  const bookAConsultation = async (e) => {
    e.preventDefault();
    console.log("consultation", consultation);
    const errors = validateForm();
    const isValid = Object.keys(errors).length === 0;
    setConsultationErrors(errors);
    if (!isValid) {
      toast.warning("Please fill all Mandatory Fields");
      return;
    }
    try {
      setLoading(true);
      const apiUrl = `${environmentUrl}/vendor/consultationLead.php`;
      const options = {
        method: "POST",
        body: JSON.stringify(consultation),
      };
      const response = await fetch(apiUrl, options);
      const fetchedData = await response.json();
      console.log("Response for mail is", fetchedData);
      if (fetchedData?.status) {
        toast.success(fetchedData?.message);
        setConsultation({
          name: "",
          mobileNum: "",
          email: "",
          locality: "",
          whoAmI: "",
          message: "",
        });
        onCloseBookPopup();
      }
    } catch (error) {
      console.log("error", error);
    } finally {
      setLoading(false);
    }
  };

  return (
    <>
      {loading && <Loader />}
      <Modal
        show={openBookPopup}
        onHide={onCloseBookPopup}
        size="lg"
        className="ref-frnd consultationModal "
        centered
        backdrop="static"
      >
        <div className="consultOuter">
          <Modal.Header
            closeButton
            className="customerCloseBtn supportClose"
          ></Modal.Header>

          <div className="row consultationRow ">
            <div className="col-md-5 ">
              <h2>
                Be Part of Our 10,000+ <br /> Interiors Family
              </h2>
              <div className="consultImage">
                <img src="assets/images/consultBg3.png" alt="" />
              </div>
            </div>
            <div className="col-md-7 ">
              <div className="consultForm">
                <form action="" method="post" onSubmit={bookAConsultation}>
                  <div className="row consultFormRow">
                    <div className="col-md-6">
                      <div className="labelDiv">
                        <label htmlFor="name">Full Name</label>
                      </div>
                      <div className="consultInput">
                        <input
                          type="text"
                          name="name"
                          onChange={handleUserInput}
                        />
                        {consultationErrors.name && (
                          <p className="error-msg logError">
                            {consultationErrors.name}
                          </p>
                        )}
                      </div>
                    </div>
                    <div className="col-md-6">
                      <div className="labelDiv">
                        <label htmlFor="phone">Phone</label>
                      </div>
                      <div className="consultInput">
                        {/* <input
                          type="number"
                          name="mobileNum"
                          onChange={handleUserInput}
                        /> */}
                        <PhoneInput
                          international
                          defaultCountry="IN"
                          value={consultation.mobileNum || ""}
                          onChange={(value) =>
                            setConsultation((prev) => ({
                              ...prev,
                              mobileNum: value,
                            }))
                          }
                          className="search-clsp22 inputField countryCode"
                          placeholder="Mobile No *"
                          name="mobileNum"
                          maxLength="18"
                        />
                        {consultationErrors.mobileNum && (
                          <p className="error-msg logError">
                            {consultationErrors.mobileNum}
                          </p>
                        )}
                      </div>
                    </div>
                  </div>
                  <div className="row consultFormRow">
                    <div className="col-md-6">
                      <div className="labelDiv">
                        <label htmlFor="email">Email</label>
                      </div>
                      <div className="consultInput">
                        <input
                          type="email"
                          name="email"
                          onChange={handleUserInput}
                        />
                        {consultationErrors.email && (
                          <p className="error-msg logError">
                            {consultationErrors.email}
                          </p>
                        )}
                      </div>
                    </div>
                    <div className="col-md-6">
                      <div className="labelDiv">
                        <label htmlFor="city">City</label>
                      </div>
                      <div className="consultInput">
                        <input
                          type="text"
                          value="Hyderabad"
                          readOnly
                          name="city"
                          onChange={handleUserInput}
                        />
                      </div>
                    </div>
                  </div>
                  <div className="row consultFormRow">
                    <div className="col-md-6">
                      <div className="labelDiv">
                        <label htmlFor="locality">Locality</label>
                      </div>
                      <div className="consultInput">
                        <input
                          type="text"
                          name="locality"
                          onChange={handleUserInput}
                        />
                        {consultationErrors.locality && (
                          <p className="error-msg logError">
                            {consultationErrors.locality}
                          </p>
                        )}
                      </div>
                    </div>
                    <div className="col-md-6">
                      <div className="labelDiv">
                        <label htmlFor="phone">Who Am I</label>
                      </div>
                      <div className="consultInput drop">
                        <select
                          defaultValue=""
                          name="whoAmI"
                          onChange={handleUserInput}
                        >
                          <option value="" disabled hidden>
                            Select an option
                          </option>
                          <option value="option1">Option 1</option>
                          <option value="option2">Option 2</option>
                          <option value="option3">Option 3</option>
                        </select>
                        <BiSolidDownArrow />
                        {consultationErrors.whoAmI && (
                          <p className="error-msg logError">
                            {consultationErrors.whoAmI}
                          </p>
                        )}
                      </div>
                    </div>
                  </div>
                  <div className="row consultFormRow">
                    <div className="col-md-12">
                      <div className="labelDiv">
                        <label htmlFor="message">Message</label>
                      </div>
                      <div className="consultInput">
                        <input
                          type="text"
                          name="message"
                          onChange={handleUserInput}
                        />
                        {consultationErrors.message && (
                          <p className="error-msg logError">
                            {consultationErrors.message}
                          </p>
                        )}
                      </div>
                    </div>
                  </div>
                  <div className="row consultFormRow">
                    <div className="consultBtn">
                      <button type="submit">Send Message</button>
                    </div>
                  </div>
                </form>
              </div>
              <div className="consultImage">
                <img src="assets/images/vend11.png" alt="" />
              </div>
            </div>
          </div>
        </div>
      </Modal>
      <Sonner />
    </>
  );
};
export default BookConsultation;
