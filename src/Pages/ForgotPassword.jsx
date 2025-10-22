import { environmentUrl } from "../env/enviroment";
import { useContext, useEffect, useState } from "react";
import { userContext } from "../App";
import { toast } from "sonner";
import Sonner from "../Components/Toaster/Sonner";
import Loader from "../Components/Spinner/Loader";
import OtpInput from "react-otp-input";
import { FaRegEye } from "react-icons/fa";
import { FaRegEyeSlash } from "react-icons/fa";
import { useNavigate } from "react-router-dom";
import { regexPatterns } from "../libs/constant";

const ForgotPassword = () => {
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
      errors.registeredEmail = "Email is required";
    } else if (!regexPatterns.emailregex.test(formData.registeredEmail)) {
      errors.registeredEmail =
        "Email is invalid, Please check the email format";
    }

    return errors;
  };
  const validatePasswordData = () => {
    const errors = {};
    if (!passwordData.newPassword) {
      errors.newPassword = "Password is required";
    } else if (!regexPatterns.passwordRegex.test(passwordData.newPassword)) {
      errors.newPassword =
        "Password is invalid. Use 8 or more characters with a mix of one uppercase, numbers & symbols";
    }

    if (!passwordData.confirmPassword) {
      errors.confirmPassword = "Confirm Password is required";
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
        console.log("customer form errors====", formErrors);
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
      console.log(response);
      if (response?.status) {
        setShowOtpBlock(true);
        toast.success(response?.message);
      } else {
        toast.error(response?.message);
      }
    } catch (error) {
      console.log("generate otp error", error);
    } finally {
      setLoading(false);
    }
  };

  const verifyOtp = async (event) => {
    event.preventDefault();
    setLoading(true);
    try {
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

  const handleResetOtp = () => {
    generateOtp();
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
        navigate("/login");
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

  useEffect(() => {
    setHeaderVal(false);
  }, []);
  return (
    <>
      {loading && <Loader />}
      <section className="ftco-section forgot-container">
        <div className="container">
          <div className="row justify-content-center reset align-middle">
            <div className="col-md-6 col-lg-4 col-sm-8 forgot-pass-card">
              <div className="login-wrap p-0">
                {/* <div className="forgotlock">
                    <FaLock />
                  </div> */}
                <div className="screenLogo">
                  <img src="assets/images/logo/voydGreen.png" alt="" />
                </div>

                <form
                  className="signin-form forgotForm"
                  method="post"
                  onSubmit={generateOtp}
                >
                  {!showOtpBlock && !showPasswordBlock && (
                    <>
                      <div className="col-md-12 text-center mb-3">
                        <div>
                          <h2 className="heading-section">Forgot password?</h2>
                        </div>
                        <div>
                          <p className="forgot-p">
                            {" "}
                            Please enter the email associated with your account.
                          </p>
                        </div>
                      </div>
                      <div className="form-group">
                        <input
                          type="email"
                          className={`form-control ${
                            formErrors.registeredEmail ? "input-error" : ""
                          }`}
                          // className="form-control form-control1"
                          placeholder="Enter Your Email Address"
                          id="forgotMail"
                          name="registeredEmail"
                          onChange={handleUserInput}
                        />
                        {formErrors?.registeredEmail && (
                          <p className="error-msg">
                            {formErrors?.registeredEmail}
                          </p>
                        )}
                      </div>

                      <div className="forgotButton">
                        <button type="submit" className="">
                          Send code
                        </button>
                      </div>
                    </>
                  )}
                </form>
                <form
                  className="signin-form forgotForm"
                  method="post"
                  onSubmit={verifyOtp}
                >
                  {showOtpBlock && (
                    <>
                      <div className="fieldBlock otpFieldBlock">
                        <div className="col-md-12 text-center mb-3">
                          <h2 className="heading-section">Enter 6-Digit OTP</h2>
                        </div>
                        <OtpInput
                          value={otp}
                          onChange={setOtp}
                          numInputs={6}
                          renderInput={(props) => <input {...props} />}
                          name="otp"
                          inputType="tel"
                          inputStyle={{
                            textAlign: "center",
                            height: "40px",
                            width: "40px",
                            border: "2px solid lightgrey",
                            borderRadius: "5px",
                            marginRight: "13px",
                          }}
                        />
                      </div>
                      <div className="buttonDiv pswd otpResend">
                        <button type="submit">Verify</button>
                      </div>
                      <div type="" onClick={handleResetOtp}>
                        Send code again 30:00
                      </div>
                    </>
                  )}
                </form>
                <form
                  className="signin-form forgotForm"
                  method="post"
                  onSubmit={updatePassword}
                >
                  {showPasswordBlock && (
                    <>
                      <div className="col-md-12 text-center mb-3">
                        <h2 className="heading-section">Create New Password</h2>
                      </div>
                      <div className="fieldBlock changeNewPswd">
                        <p>New Password</p>
                        <div className="changePswOuter">
                          <input
                            type={showPassword ? "text" : "password"}
                            className={`form-control ${
                              passwordErrors.confirmPassword
                                ? "input-error"
                                : ""
                            }`}
                            name="newPassword"
                            onChange={handleUserNewPassword}
                          />
                          <span>
                            {!showPassword ? (
                              <FaRegEye
                                type="button"
                                onClick={() => setShowPassword(!showPassword)}
                              />
                            ) : (
                              <FaRegEyeSlash
                                type="button"
                                onClick={() => setShowPassword(!showPassword)}
                              />
                            )}
                          </span>
                          {passwordErrors?.newPassword && (
                            <p className="error-msg">
                              {passwordErrors?.newPassword}
                            </p>
                          )}
                        </div>
                      </div>
                      <div className="fieldBlock changeNewPswd">
                        <p>Confirm New Password</p>
                        <div className="changePswOuter">
                          <input
                            type={showConfirmPassword ? "text" : "password"}
                            className={`form-control ${
                              passwordErrors.confirmPassword
                                ? "input-error"
                                : ""
                            }`}
                            name="confirmPassword"
                            onChange={handleUserNewPassword}
                          />
                          <span>
                            {!showConfirmPassword ? (
                              <FaRegEye
                                type="button"
                                onClick={() =>
                                  setConfirmPassword(!showConfirmPassword)
                                }
                              />
                            ) : (
                              <FaRegEyeSlash
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
                      <div className="buttonDiv pswd updatePswd">
                        <button type="submit">Update Password</button>
                      </div>
                    </>
                  )}
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>

      <Sonner />
    </>
  );
};

export default ForgotPassword;
