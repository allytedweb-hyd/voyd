import { useContext, useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import { FaAnglesRight } from "react-icons/fa6";
import { userContext } from "../App";
import { FaRegEye } from "react-icons/fa";
import { FaRegEyeSlash } from "react-icons/fa";
import { environmentUrl } from "../env/enviroment";
import OtpInput from "react-otp-input";
import Loader from "../Components/Spinner/Loader";
import Sonner from "../Components/Toaster/Sonner";
import { toast } from "sonner";
import MyAccountSidebar from "../Components/Common/MyAccountSidebar";
import { FaRegUser } from "react-icons/fa6";

const ChangePassword = () => {
  const navigate = useNavigate();
  const { userDetails } = useContext(userContext);
  const [formData, setFormData] = useState({});
  const [otp, setOtp] = useState("");
  const [showPasswordBlock, setShowPasswordBlock] = useState(false);
  const [showOtpBlock, setShowOtpBlock] = useState(false);
  const [loading, setLoading] = useState(false);
  const [passwordData, newPasswordData] = useState({});
  const [showPassword, setShowPassword] = useState(false);
  const [showConfirmPassword, setConfirmPassword] = useState(false);
  const userLoginDetails = userDetails;
  const handleSignOut = () => {
    localStorage.removeItem("token");
    navigate("/login");
  };

  let auth = localStorage.getItem("token");
  console.log("user details using context", userLoginDetails);

  const handleUserInput = (event) => {
    setFormData({
      ...formData,
      [event.target.name]: event.target.value,
    });
  };

  const validateEmail = () => {
    const newErrors = {};
    const email = formData?.registeredEmail?.trim();

    if (!email) {
      newErrors.registeredEmail = "Email is required.";
    } else {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        newErrors.registeredEmail = "Please enter a valid email address.";
      }
    }

    setErrors((prev) => ({ ...prev, ...newErrors }));
    return Object.keys(newErrors).length === 0;
  };

  const generateOtp = async () => {
    if (!validateEmail()) return;
    setLoading(true);
    try {
      const apiUrl = `${environmentUrl}/Authentication/generate_reset_pass_otp.php`;
      const options = {
        method: "POST",
        body: JSON.stringify(formData),
        headers: { Authorization: "Bearer " + localStorage.getItem("token") },
      };
      const response = await (await fetch(apiUrl, options)).json();
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

  const validateOtp = () => {
    const newOtpErrors = Array(6).fill(null);

    if (otp.length !== 6) {
      for (let i = 0; i < 6; i++) {
        if (!otp[i]) newOtpErrors[i] = true;
      }
      setErrors((prev) => ({ ...prev, otp: newOtpErrors }));
      toast.error("Please fill all 6 digits of the OTP");
      return false;
    }

    for (let i = 0; i < 6; i++) {
      if (!/^\d$/.test(otp[i])) {
        newOtpErrors[i] = true;
      }
    }

    const hasErrors = newOtpErrors.some((e) => e !== null);
    if (hasErrors) {
      setErrors((prev) => ({ ...prev, otp: newOtpErrors }));
      toast.error("OTP must contain only digits");
      return false;
    }

    setErrors((prev) => ({ ...prev, otp: Array(6).fill(null) }));
    return true;
  };

  const verifyOtp = async () => {
    if (!validateOtp()) return;

    setLoading(true);
    try {
      const apiUrl = `${environmentUrl}/Authentication/verify_reset_pass_otp.php`;
      const options = {
        method: "POST",
        body: JSON.stringify({ otp: otp }),
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

  const [errors, setErrors] = useState({});

  const validatePasswordFields = () => {
    const newErrors = {};
    const { newPassword, confirmPassword } = passwordData;

    if (!newPassword) {
      newErrors.newPassword = "New password is required.";
    } else {
      if (newPassword.length < 8) {
        newErrors.newPassword = "Password must be at least 8 characters.";
      } else if (!/[A-Z]/.test(newPassword)) {
        newErrors.newPassword = "Must include at least one uppercase letter.";
      } else if (!/[!@#$%^&*(),.?":{}|<>]/.test(newPassword)) {
        newErrors.newPassword = "Must include at least one special character.";
      }
    }

    if (!confirmPassword) {
      newErrors.confirmPassword = "Please confirm your password.";
    } else if (confirmPassword !== newPassword) {
      newErrors.confirmPassword = "Passwords do not match.";
    }

    setErrors(newErrors);
    return Object.keys(newErrors).length === 0;
  };

  const updatePassword = async () => {
    if (passwordData.newPassword !== passwordData.confirmPassword) {
      toast.warning("Password does not match");
      return;
    }
    if (!validatePasswordFields()) return;
    setLoading(true);
    try {
      const apiUrl = `${environmentUrl}/Authentication/reset_user_password.php`;
      const options = {
        method: "POST",
        body: JSON.stringify(passwordData),
        headers: { Authorization: "Bearer " + localStorage.getItem("token") },
      };
      const response = await (await fetch(apiUrl, options)).json();
      if (response?.status) {
        toast.success(response?.message);
        setTimeout(() => {
          navigate("/YourAccount");
        }, 1500);
      } else {
        toast.error(response?.message);
      }
    } catch (error) {
      console.log("update password error", error);
    } finally {
      setLoading(false);
    }
  };

  const getUserDetails = async () => {
    try {
      const apiUrl = `${environmentUrl}/Authentication/get_user_profile.php`;
      const options = {
        method: "GET",
        headers: { Authorization: "Bearer " + localStorage.getItem("token") },
      };
      const response = await fetch(apiUrl, options);
      const fetchedData = await response.json();
      if (response?.status) {
        return fetchedData?.response;
      }
      console.log("user details are===", fetchedData);
    } catch (error) {
      console.log("user details get error==", error);
    }
  };

  return (
    <>
      {loading && <Loader />}

      <div className="main-account-container mainBackground">
        {/* <div className="slidBlock">
          <div className="slidBlockInner">
            <ul>
              <li>
            
                <Link to="/YourAccount" className="profileicon ">
                  My Profile
                </Link>
              </li>

              <li>
              
                <Link to="/Myorders" className="profileicon ">
                  My Orders
                </Link>
              </li>

              <li>
           
                <Link to="/wishlist" className="profileicon ">
                  Your Wishlist
                </Link>
              </li>

       

              <li>
            
                <Link to="/changePassword" className="profileicon colorGreen">
                  Change Password
                </Link>
              </li>

              <li>
                <Link to="/referaldetails" className="profileicon ">
                  Referral Details
                </Link>
              </li>

          
              <li onClick={handleSignOut}>
                
                <Link to="" className="profileicon">
                  Sign Out
                </Link>
              </li>
            </ul>
            <span>
              <FaRegUser />
            </span>
          </div>
        </div> */}
        <div className="container-fluid">
          <div className="row profilePageRow">
            <div className="row ">
              <MyAccountSidebar userDetails={getUserDetails} />

              <div className="col-lg-10 col-md-12 col-sm-12 rightMainColumn">
                <div className="mainOuter">
                  <div className="topTitles">
                    <h3>Change Password</h3>
                  </div>
                  <div className="accountFormCard update">
                    <form action="" method="post">
                      <div className="firstBlock ">
                        <div className="fields changePswd">
                          {!showOtpBlock && !showPasswordBlock && (
                            <>
                              <div className="fieldBlock">
                                <p>
                                  Enter Registered Email
                                  <span className="errorSymbol">*</span>
                                </p>
                                <div className="changePswOuter">
                                  <input
                                    type="email"
                                    className={`form-control ${
                                      errors.registeredEmail
                                        ? "Passworderrorinput"
                                        : ""
                                    }`}
                                    name="registeredEmail"
                                    onChange={handleUserInput}
                                  />
                                  {errors.registeredEmail && (
                                    <p className="error-msg logError">
                                      {errors.registeredEmail}
                                    </p>
                                  )}
                                </div>
                              </div>
                              <div className="buttonDiv pswd">
                                <button type="button" onClick={generateOtp}>
                                  Send OTP
                                </button>
                              </div>
                            </>
                          )}
                          {showOtpBlock && (
                            <>
                              <div className="fieldBlock">
                                <p>Enter OTP to verify</p>
                                {/* <OtpInput
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
                                /> */}
                                <OtpInput
                                  value={otp}
                                  onChange={(value) => {
                                    setOtp(value);
                                    if (errors.otp?.length > 0) {
                                      setErrors((prev) => ({
                                        ...prev,
                                        otp: Array(6).fill(null),
                                      }));
                                    }
                                  }}
                                  numInputs={6}
                                  isInputNum
                                  inputType="tel"
                                  renderInput={(props, index) => (
                                    <div
                                      style={{
                                        display: "inline-block",
                                        textAlign: "center",
                                      }}
                                      key={index}
                                    >
                                      <input
                                        {...props}
                                        style={{
                                          textAlign: "center",
                                          height: "40px",
                                          width: "40px",
                                          border: errors.otp?.[index]
                                            ? "1px solid red"
                                            : "1px solid lightgrey",
                                          borderRadius: "5px",
                                          marginRight: "13px",
                                        }}
                                      />
                                    </div>
                                  )}
                                />
                              </div>
                              <div className="buttonDiv pswd">
                                <button type="button" onClick={verifyOtp}>
                                  Verify OTP
                                </button>
                              </div>
                            </>
                          )}
                          {showPasswordBlock && (
                            <>
                              <div className="fieldBlock">
                                <p>New Password</p>
                                <div className="changePswOuter">
                                  <input
                                    type={showPassword ? "text" : "password"}
                                    className={`form-control ${
                                      errors.newPassword
                                        ? "Passworderrorinput"
                                        : ""
                                    }`}
                                    name="newPassword"
                                    onChange={handleUserNewPassword}
                                  />
                                  <span>
                                    {!showPassword ? (
                                      <FaRegEyeSlash
                                        type="button"
                                        onClick={() =>
                                          setShowPassword(!showPassword)
                                        }
                                      />
                                    ) : (
                                      <FaRegEye
                                        type="button"
                                        onClick={() =>
                                          setShowPassword(!showPassword)
                                        }
                                      />
                                    )}
                                  </span>
                                </div>
                                {errors.newPassword && (
                                  <p className="error-msg logError">
                                    {errors.newPassword}
                                  </p>
                                )}
                              </div>
                              <div className="fieldBlock">
                                <p>Confirm Password</p>
                                <div className="changePswOuter">
                                  <input
                                    type={
                                      showConfirmPassword ? "text" : "password"
                                    }
                                    className={`form-control ${
                                      errors.confirmPassword
                                        ? "Passworderrorinput"
                                        : ""
                                    }`}
                                    name="confirmPassword"
                                    onChange={handleUserNewPassword}
                                  />
                                  <span>
                                    {!showConfirmPassword ? (
                                      <FaRegEyeSlash
                                        type="button"
                                        onClick={() =>
                                          setConfirmPassword(
                                            !showConfirmPassword
                                          )
                                        }
                                      />
                                    ) : (
                                      <FaRegEye
                                        type="button"
                                        onClick={() =>
                                          setConfirmPassword(
                                            !showConfirmPassword
                                          )
                                        }
                                      />
                                    )}
                                  </span>
                                </div>
                                {errors.confirmPassword && (
                                  <p className="error-msg logError">
                                    {errors.confirmPassword}
                                  </p>
                                )}
                              </div>
                              <div className="buttonDiv pswd">
                                <button type="button" onClick={updatePassword}>
                                  Update Password
                                </button>
                              </div>
                            </>
                          )}
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <Sonner />
    </>
  );
};
export default ChangePassword;
