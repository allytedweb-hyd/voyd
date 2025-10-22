/* eslint-disable react/prop-types */
import { useState, useEffect } from "react";
import Modal from "react-bootstrap/Modal";
import { environmentUrl } from "../../env/enviroment";
import { toast } from "sonner";
import Sonner from "../Toaster/Sonner";
import Loader from "../Spinner/Loader";
import { regexPatterns } from "../../libs/constant";
import "react-phone-number-input/style.css";
import PhoneInput from "react-phone-number-input";

const ReferAFriend = ({ openReferAFriend, onCloseReferAFriend }) => {
  const [loading, setLoading] = useState(false);

  const [FormErrors, setFormErrors] = useState({});
  const [form, setForm] = useState({
    name: "",
    email: "",
    phone: "",
    city: "Hyderabad",
  });

  useEffect(() => {
    if (openReferAFriend) {
      setForm({
        name: "",
        email: "",
        phone: "",
        city: "Hyderabad",
        locality: "",
      });
      setFormErrors({});
    }
  }, [openReferAFriend]);
  const validateFields = () => {
    const errors = {};

    if (!form.name) {
      errors.name = "Enter reference name";
    } else if (!regexPatterns.alphabetsregex.test(form.name)) {
      errors.name = "Name must be in letters only";
    }

    if (!form.email) {
      errors.email = "Enter an email address";
    } else if (!regexPatterns.emailregex.test(form.email)) {
      errors.email = "Enter a valid email address";
    }
    if (!form.phone) {
      errors.phone = "Enter Mobile Number";
    } else if (!regexPatterns.mobileregexInternational.test(form.phone)) {
      errors.phone = "Enter valid number";
    }

    if (!form.locality) {
      errors.locality = "Enter area";
    }

    return errors;
  };

  const handleUserInput = (e) => {
    const { name, value } = e.target;
    setForm((prev) => ({ ...prev, [name]: value }));
  };
  const referAFriend = async (e) => {
    e.preventDefault();
    const errors = validateFields();
    setFormErrors(errors);

    if (Object.keys(errors).length > 0) {
      toast.warning("Please fill all Mandatory Fields");
      return;
    }

    try {
      setLoading(true);
      const apiUrl = `${environmentUrl}/Authentication/refer_a_frd_mail.php`;
      const options = {
        method: "POST",
        body: JSON.stringify(form),
        headers: {
          Authorization: "Bearer " + localStorage.getItem("token"),
        },
      };
      const response = await (await fetch(apiUrl, options)).json();

      if (response.status) {
        toast.success(response?.message);
        setForm({});
        setFormErrors({});
        onCloseReferAFriend();
      } else {
        toast.error(
          response?.message == "Token has expired"
            ? "Session Expired / Login to Refer a Friend "
            : response?.message
        );
      }
    } catch (error) {
      toast.error("An unexpected error occurred");
    } finally {
      setLoading(false);
    }
  };

  return (
    <>
      {loading && <Loader />}

      <Modal
        show={openReferAFriend}
        onHide={onCloseReferAFriend}
        size="lg"
        className="ref-frnd referFriendModal"
        centered
        backdrop="static"
      >
        <Modal.Header
          closeButton
          className="d-flex justify-content-end po-bun poTwo"
        ></Modal.Header>
        <div className="row bird-div">
          <div className="col-md-4 p-0">
            <div className="tw-brd birdDiv">
              <img src="assets/images/Frame 2147223333 (2).png" alt="" />
            </div>
          </div>
          <div className="col-md-8 bg-sev ">
            <div className="outer-refer  align-items-ceneter">
              <div className="refer-container">
                <div className="mobileBlockTop">
                  <img src="assets/images/uptwoo.png" alt="" />
                </div>
                <h2 className="refer-heading">Refer a Friend</h2>
                <div className="referFormOuter">
                  <p className="offer-text">
                    Get <strong>₹10,000</strong> cash Back on <br /> project
                    confirmation!*
                  </p>

                  <form
                    className="refer-form formRef"
                    method="post"
                    onSubmit={referAFriend}
                  >
                    <input
                      type="text"
                      placeholder="Reference Name *"
                      className={` bird-inp ${
                        FormErrors.name ? "refer-error" : ""
                      }`}
                      name="name"
                      onChange={handleUserInput}
                    />

                    {FormErrors?.name && (
                      <p className="error-msg">{FormErrors?.name}</p>
                    )}

                    <input
                      type="email"
                      placeholder="Email Address *"
                      className={` bird-inp ${
                        FormErrors.email ? "refer-error" : ""
                      }`}
                      name="email"
                      onChange={handleUserInput}
                    />

                    {FormErrors?.email && (
                      <p className="error-msg">{FormErrors?.email}</p>
                    )}

                    <div
                      className={` bird-inp referACountry ${
                        FormErrors.phone ? "refer-error" : ""
                      }`}
                    >
                      <PhoneInput
                        international
                        defaultCountry="IN"
                        value={form.phone || ""}
                        onChange={(value) =>
                          setForm((prev) => ({
                            ...prev,
                            phone: value,
                          }))
                        }
                        className="search-clsp22 inputField countryCode"
                        placeholder="Mobile No *"
                        name="phone"
                        maxLength="18"
                      />
                    </div>
                    {FormErrors?.phone && (
                      <p className="error-msg">{FormErrors?.phone}</p>
                    )}

                    <input
                      type="text"
                      placeholder="City *"
                      className={` bird-inp ${
                        FormErrors.city ? "refer-error" : ""
                      }`}
                      name="city"
                      onChange={handleUserInput}
                      value="Hyderabad"
                      readOnly
                    />
                    <input
                      type="text"
                      placeholder="Area *"
                      className={` bird-inp ${
                        FormErrors.locality ? "refer-error" : ""
                      }`}
                      name="locality"
                      onChange={handleUserInput}
                    />
                    {FormErrors?.locality && (
                      <p className="error-msg">{FormErrors?.locality}</p>
                    )}
                    <div className="referSubmit">
                      <button type="submit">Refer Now</button>
                    </div>
                  </form>
                  <img
                    src="assets/images/BottomT.png"
                    alt=""
                    className="bottomImg"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </Modal>
      <Sonner />
    </>
  );
};

export default ReferAFriend;
