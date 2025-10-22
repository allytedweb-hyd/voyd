import Modal from "react-bootstrap/Modal";
import { environmentUrl } from "../../env/enviroment";
import { useContext, useEffect, useState } from "react";
import { userContext } from "../../App";
import { toast } from "sonner";
import Sonner from "../../Components/Toaster/Sonner";
import Loader from "../../Components/Spinner/Loader";
import OtpInput from "react-otp-input";
import { FaRegEye } from "react-icons/fa";
import { FaRegEyeSlash } from "react-icons/fa";
import { useNavigate } from "react-router-dom";
import { regexPatterns } from "../../libs/constant";

const ForgotModal = ({ openForgotModal, closeForgotModal }) => {
  const { userDetails } = useContext(userContext);
  const [loading, setLoading] = useState(false);
  const [formData, setFormData] = useState({});
  const [formErrors, setFormErrors] = useState({});
  const [showOtpBlock, setShowOtpBlock] = useState(false);
  const [showPasswordBlock, setShowPasswordBlock] = useState(false);
  const [passwordData, newPasswordData] = useState({});
  const [passwordErrors, newPasswordErrors] = useState({});
  const [showPassword, setShowPassword] = useState(false);
  const [showConfirmPassword, setConfirmPassword] = useState(false);
  const [otpTimeLeft, setOtpTimeLeft] = useState(30);
  const [activateResend, setActivateResend] = useState(false);
  const [otpFormErrors, setOtpFormErrors] = useState({});

  const [otp, setOtp] = useState("");
  const navigate = useNavigate();

  const { setHeaderVal } = useContext(userContext);

  const handleUserInput = (event) => {
    setFormData({
      ...formData,
      [event.target.name]: event.target.value,
    });
  };

  const validateFormData = () => {
    const errors = {};
    if (!formData.registeredEmail) {
      errors.registeredEmail = "Enter a Valid Email Address";
    } else if (!regexPatterns.emailregex.test(formData.registeredEmail)) {
      errors.registeredEmail =
        "Email is invalid, Please check the email format";
    }

    return errors;
  };
  const validatePasswordData = () => {
    const errors = {};
    if (!passwordData.newPassword) {
      errors.newPassword = "Enter New Password";
    } else if (!regexPatterns.passwordRegex.test(passwordData.newPassword)) {
      errors.newPassword =
        "Password is invalid. Use 8 or more characters with a mix of one uppercase, numbers & symbols";
    }

    if (!passwordData.confirmPassword) {
      errors.confirmPassword = "Enter the same Password";
    } else if (
      passwordData.newPassword &&
      passwordData.newPassword.trim() !== passwordData.confirmPassword.trim()
    ) {
      errors.confirmPassword = "Password and Confirm Password doesn't match";
    }
    return errors;
  };

  const generateOtp = async (event) => {
    if (event) event.preventDefault();
    setLoading(true);

    try {
      const errors = validateFormData();
      const isValid = Object.keys(errors).length === 0;
      setFormErrors(errors);
      if (!isValid) {
        toast.warning("Please fill all Mandatory Fields");
        return;
      }
      let data = { ...formData, type: "forgotPassword" };
      const apiUrl = `${environmentUrl}/Authentication/generate_reset_pass_otp.php`;
      const options = {
        method: "POST",
        body: JSON.stringify(data),
        headers: { Authorization: "Bearer " + localStorage.getItem("token") },
      };
      const response = await (await fetch(apiUrl, options)).json();
      if (response?.status) {
        setShowOtpBlock(true);
        toast.success(response?.message);
        generateOtpTimer(otpTimeLeft);
      } else {
        toast.error(response?.message);
      }
    } catch (error) {
      console.log("generate otp error", error);
    } finally {
      setLoading(false);
    }
  };

  const formatTime = (sec) => {
    const min = Math.floor(sec / 60);
    const remSec = sec % 60;
    return `${String(min).padStart(2, "0")}:${String(remSec).padStart(2, "0")}`;
  };

  const otpValidation = () => {
    const errors = {};
    if (!otp) {
      errors.otp = "Enter OTP";
    }
    return errors;
  };

  const verifyOtp = async (event) => {
    event.preventDefault();
    const errors = otpValidation();
    setOtpFormErrors(errors);
    if (Object.keys(errors).length > 0) {
      toast.warning("Please Enter OTP");
      return;
    }

    try {
      setLoading(true);
      const apiUrl = `${environmentUrl}/Authentication/verify_reset_pass_otp.php`;
      const options = {
        method: "POST",
        body: JSON.stringify({
          otp: otp,
          type: "forgotPassword",
          email: formData?.registeredEmail,
        }),
        headers: { Authorization: "Bearer " + localStorage.getItem("token") },
      };
      const response = await (await fetch(apiUrl, options)).json();
      if (response?.status) {
        setShowOtpBlock(false);
        setShowPasswordBlock(true);
        toast.success(response?.message);
      } else {
        toast.error(response?.message);
      }
    } catch (error) {
      console.log("verify otp error", error);
    } finally {
      setLoading(false);
    }
  };

  const handleUserNewPassword = (event) => {
    newPasswordData({
      ...passwordData,
      [event.target.name]: event.target.value,
    });
  };

  const handleResetOtp = async () => {
    if (!activateResend) return;
    const newTime = 30;
    setOtpTimeLeft(newTime);
    setActivateResend(false);
    generateOtpTimer(newTime);
  };

  const generateOtpTimer = (otpTime) => {
    console.log("function hits");
    if (otpTime <= 0) {
      console.log("if block hits");
      return;
    }

    const interval = setInterval(() => {
      setOtpTimeLeft((prev) => {
        if (prev <= 1) {
          clearInterval(interval);
          setActivateResend(true);

          return 0;
        }
        return prev - 1;
      });
    }, 1000);

    return () => clearInterval(interval);
  };

  const updatePassword = async (event) => {
    event.preventDefault();

    const errors = validatePasswordData();
    const isValid = Object.keys(errors).length === 0;
    newPasswordErrors(errors);
    if (!isValid) {
      console.log("customer form errors====", formErrors);
      toast.warning("Please fill all Mandatory Fields");
      return;
    }
    try {
      setLoading(true);
      let data = {
        ...passwordData,
        type: "forgotPassword",
        email: formData?.registeredEmail,
      };
      const apiUrl = `${environmentUrl}/Authentication/reset_user_password.php`;
      const options = {
        method: "POST",
        body: JSON.stringify(data),
        headers: { Authorization: "Bearer " + localStorage.getItem("token") },
      };
      const response = await (await fetch(apiUrl, options)).json();
      if (response?.status) {
        closeForgotModal();
        setTimeout(() => {
          toast.success(response?.message);
        }, 300);
      } else {
        toast.error(response?.message);
      }
    } catch (error) {
      console.log("update password error", error);
    } finally {
      setLoading(false);
    }
  };

  const closeForgotpopup = () => {
    setShowOtpBlock(false);
    setShowPasswordBlock(false);
  };

  useEffect(() => {
    setHeaderVal(false);
  }, []);
  return (
    <>
      {loading && <Loader />}
      <Modal
        show={openForgotModal}
        onHide={closeForgotModal}
        size="lg"
        className="ref-frnd support-customer ForgotMoal bg-extra-s"
        centered
        backdrop="static"
      >
        <Modal.Header
          closeButton
          className="customerCloseBtn fogot"
          onClick={closeForgotpopup}
        ></Modal.Header>
        <div className="red-flowe-bg">
          <img src="assets/images/Rectangle 2 431.png" alt="" />
        </div>
        <div className="modalFormsOuter mini-screens">
          <div>
            <form
              className="signin-form forgotForm for-mdal"
              method="post"
              onSubmit={generateOtp}
            >
              {!showOtpBlock && !showPasswordBlock && (
                <>
                  <div className="col-md-12 text-align-for mb-3">
                    <div>
                      <h2 className="heading-section">Forgot Password ?</h2>
                    </div>
                    <div>
                      <p className="forgot-p">
                        {" "}
                        Please enter the email associated with your account.
                      </p>
                    </div>
                  </div>
                  <div className="form-group for-plcehldr">
                    <input
                      type="email"
                      className={`form-control form-popup ${
                        formErrors.registeredEmail ? "input-error" : ""
                      }`}
                      // className="form-control form-control1"
                      placeholder="Enter Your Email Address"
                      id="forgotMail"
                      name="registeredEmail"
                      onChange={handleUserInput}
                    />
                    {formErrors?.registeredEmail && (
                      <p className="error-msg">{formErrors?.registeredEmail}</p>
                    )}
                  </div>

                  <div className="forgotButton">
                    <button type="submit" className="">
                      Send Code
                    </button>
                  </div>
                </>
              )}
            </form>
          </div>
          <form
            className="signin-form forgotForm"
            method="post"
            onSubmit={verifyOtp}
          >
            {showOtpBlock && (
              <>
                <div className="fieldBlock otpFieldBlock">
                  <div className="col-md-12 text-align-for mb-3">
                    <h2 className="heading-section">
                      {" "}
                      Please check your email
                    </h2>
                    <div>
                      <p className="forgot-p">
                        {" "}
                        We’ve sent a code to{" "}
                        <span className="reg-fntw">
                          Registered Email Address
                        </span>
                      </p>
                    </div>
                  </div>
                  <div className="input-gap">
                    <OtpInput
                      value={otp}
                      onChange={setOtp}
                      numInputs={6}
                      renderInput={(props) => <input {...props} />}
                      name="otp"
                      className="inputs-mrgnns gap-2"
                      inputType="tel"
                      inputStyle={{
                        textAlign: "center",
                        height: "40px",
                        width: "40px",
                        border: "2px solid white",
                        borderRadius: "5px",
                      }}
                    />
                  </div>
                </div>
                <div className="buttonDiv pswd otpResend">
                  <button type="submit">Verify</button>
                </div>
                <div onClick={handleResetOtp}>
                  <span
                    className={activateResend ? "send-txt" : "disabled-text"}
                  >
                    Send code again{" "}
                  </span>{" "}
                  <span
                    className={activateResend ? "disabled-text" : "timer-txt"}
                  >
                    {formatTime(otpTimeLeft)}
                  </span>
                </div>
              </>
            )}
          </form>
          <form
            className="signin-form forgotForm extr-wdth"
            method="post"
            onSubmit={updatePassword}
          >
            {showPasswordBlock && (
              <>
                <div className="col-md-12 text-align-for mb-3">
                  <h2 className="heading-section"> Reset Password</h2>
                </div>
                <div className="fieldBlock changeNewPswd">
                  <div className="changePswOuter lt-error">
                    <input
                      type={showPassword ? "text" : "password"}
                      className={`form-control ${
                        passwordErrors.confirmPassword ? "input-error" : ""
                      }`}
                      name="newPassword"
                      placeholder="New Password"
                      onChange={handleUserNewPassword}
                    />
                    <span>
                      {!showPassword ? (
                        <FaRegEyeSlash
                          type="button"
                          onClick={() => setShowPassword(!showPassword)}
                        />
                      ) : (
                        <FaRegEye
                          type="button"
                          onClick={() => setShowPassword(!showPassword)}
                        />
                      )}
                    </span>
                    {passwordErrors?.newPassword && (
                      <p className="error-msg">{passwordErrors?.newPassword}</p>
                    )}
                  </div>
                </div>
                <div className="fieldBlock changeNewPswd">
                  <div className="changePswOuter lt-error">
                    <input
                      type={showConfirmPassword ? "text" : "password"}
                      className={`form-control ${
                        passwordErrors.confirmPassword ? "input-error" : ""
                      }`}
                      name="confirmPassword"
                      placeholder="Confirm New Password"
                      onChange={handleUserNewPassword}
                    />
                    <span>
                      {!showConfirmPassword ? (
                        <FaRegEyeSlash
                          type="button"
                          onClick={() =>
                            setConfirmPassword(!showConfirmPassword)
                          }
                        />
                      ) : (
                        <FaRegEye
                          type="button"
                          onClick={() =>
                            setConfirmPassword(!showConfirmPassword)
                          }
                        />
                      )}
                    </span>
                    {passwordErrors?.confirmPassword && (
                      <p className="error-msg">
                        {passwordErrors?.confirmPassword}
                      </p>
                    )}
                  </div>
                </div>
                {/* <p className="restrict-text">
                  Min. 8 chars, incl. 1 special, 1 uppercase & 1 lowercase
                  letter.
                </p> */}
                <div className="buttonDiv pswd updatePswd">
                  <button type="submit">Reset Password</button>
                </div>
              </>
            )}
          </form>
        </div>
      </Modal>
      <Sonner />
    </>
  );
};
export default ForgotModal;
