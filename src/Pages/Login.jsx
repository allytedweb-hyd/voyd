/* eslint-disable react-hooks/exhaustive-deps */
import React from "react";
import { useNavigate, Link } from "react-router-dom";
import { FaRegEye } from "react-icons/fa";
import { FaRegEyeSlash } from "react-icons/fa";
import { useEffect, useState, useContext } from "react";
import { environmentUrl } from "../env/enviroment";
import { userContext } from "../App";
import { useDispatch } from "react-redux";
import { createUser } from "../redux/slices/userSlice";
import Loader from "../Components/Spinner/Loader";
import { toast } from "sonner";
import Sonner from "../Components/Toaster/Sonner";
import { jwtDecode } from "jwt-decode";
import { GoogleLogin } from "@react-oauth/google";
import ForgotModal from "../Components/Popups/ForgotModal";

export const UserContext = React.createContext();

const Login = () => {
  const navigate = useNavigate();


  const handleLoginSuccess = (defaultPath) => {
    const redirectPath = sessionStorage.getItem('redirectAfterLogin');
    if (redirectPath) {
      sessionStorage.removeItem('redirectAfterLogin');
      navigate(redirectPath);
    } else {
      navigate(defaultPath);
    }
  };


  const [formData, setFormData] = useState({});
  const [formErrors, setFormErrors] = useState({});
  const [forgotModal, setForgotModal] = useState(false);
  const [visibile, setVisible] = useState(false);
  const closeForgotModal = () => {
    setForgotModal(false);
  };

  const { setHeaderVal } = useContext(userContext);
  const dispatch = useDispatch();
  const [loading, setLoading] = useState(false);

  const handleGoogleSignup = (credentialResponse) => {
    const decoded = jwtDecode(credentialResponse.credential);

    fetch(`${environmentUrl}/Authentication/login.php`, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(decoded),
    })
      .then((res) => res.json())
      .then((data) => {
        if (data?.status) {
          const user = data?.userData;
          localStorage.setItem("token", data?.token);
          dispatch(createUser(data?.userData));
          // navigate("/YourAccount");
          // handleLoginSuccess('/YourAccount');

          const isAddressIncomplete = !user?.address?.trim() ||
            !user?.delivery_address?.trim() ||
            !user?.street?.trim() ||
            !user?.city?.trim() ||
            !user?.state?.trim() ||
            !user?.place?.trim();


          // if (isAddressIncomplete) {
          //   handleLoginSuccess('/YourAccount');
          //   toast.warning("Please fill the required address details.");
          // } else {
          //   handleLoginSuccess('/');
          // }

          toast.success(data?.message, { duration: 2000 });

          if (isAddressIncomplete) {




            setTimeout(() => {
              handleLoginSuccess('/YourAccount');
              setTimeout(() => {
                toast.warning("Please fill the required address details.", {
                  duration: 5000,
                });
              }, 2000);
            }, 1000);
          } else {
            setTimeout(() => {
              handleLoginSuccess('/');
            }, 2000);
          }





          // setTimeout(() => {
          //   toast.success(data?.message);
          // }, 500);
        } else {
          toast.error(data?.message);
        }
      })
      .catch((err) => console.error("Signup failed:", err));
  };

  const toggleEye = () => {
    setVisible(!visibile);
  };

  const handleUserInput = (event) => {
    setFormData({
      ...formData,
      [event.target.name]: event.target.value,
    });
  };

  const validateForm = () => {
    const error = {};
    if (!formData.userId) {
      error.userId = "Email is required";
    }
    if (!formData.userPassword) {
      error.userPassword = "Password is required";
    }
    return error;
  };
  const handleSubmit = async (event) => {
    event.preventDefault();
    const errors = validateForm();
    const isValid = Object.keys(errors).length === 0;
    setFormErrors(errors);
    if (!isValid) {
      toast.warning("Please fill all Mandatory Fields");
      return;
    }
    try {
      setLoading(true);
      const apiUrl = `${environmentUrl}/Authentication/login.php`;
      const options = {
        method: "POST",
        body: JSON.stringify(formData),
      };
      const response = await fetch(apiUrl, options);
      const fetchedData = await response.json();

      if (fetchedData?.status) {
        localStorage.setItem("token", fetchedData?.token);
        dispatch(createUser(fetchedData?.userData));
        // navigate("/");
        handleLoginSuccess('/');
        setTimeout(() => {
          toast.success(fetchedData?.message);
        }, 500);
      } else {
        toast.error(fetchedData?.message);
      }
    } catch (error) {
      toast.error(error.response?.response);
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
      <section className="userLoginSection">
        <div className="container-fluid">
          <div className="row">
            <div className="col-md-6 first">
              <img src="assets/images/Loginleft.jpg" alt="" />
            </div>
            <div className="col-md-6 second">
              <div className="topImage">
                <img src="assets/images/pngwing.png" alt="" />
              </div>
              <div className="loginFormMain">
                <div className="formBlock">
                  <h3>Step Into Your Dream Space 👋</h3>
                  <p>
                    <span className="mobileNone">
                      It’s your space. You design it.
                    </span>{" "}
                    Start transforming your interiors.
                  </p>
                  <form method="post" onSubmit={handleSubmit}>
                    <div className="form-group">
                      <input
                        type="email"
                        className={
                          formErrors.userId
                            ? "form-control form-control1  is-invalid"
                            : "form-control form-control1"
                        }
                        placeholder="Email Address *"
                        id="userMailId"
                        name="userId"
                        onChange={handleUserInput}
                      />
                      {formErrors.userId && (
                        <p className="error-msg logError">
                          {formErrors.userId}
                        </p>
                      )}
                    </div>
                    <div className="form-group">
                      <input
                        id="user-password"
                        type={visibile === true ? "text" : "password"}
                        className={
                          formErrors.userPassword
                            ? "form-control form-control1 is-invalid"
                            : "form-control form-control1"
                        }
                        placeholder="Password *"
                        name="userPassword"
                        onChange={handleUserInput}
                      />
                      {formErrors.userPassword && (
                        <p className="error-msg logError">
                          {formErrors.userPassword}
                        </p>
                      )}{" "}
                      <span className="password-eye">
                        {visibile === true ? (
                          <FaRegEye onClick={toggleEye} />
                        ) : (
                          <FaRegEyeSlash onClick={toggleEye} />
                        )}
                      </span>
                    </div>
                    <p className="pp">
                      <Link onClick={() => setForgotModal(true)}>
                        Forgot Password ?
                      </Link>
                      <Link to="/signup">Create New Account</Link>
                    </p>
                    <button type="submit">Sign In</button>
                  </form>
                  <p className="formOptionalLine">
                    <span className="or-line">OR </span>
                  </p>
                  <div className="signWithGoogle">
                    <GoogleLogin
                      onSuccess={handleGoogleSignup}
                      onError={() => console.log("Google Signup Failed")}
                      size="medium" // options: "small", "medium", "large"
                    />
                  </div>
                </div>
                <div className="fomImg">
                  <img src="assets/images/cxz.png" alt="" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* <section className="ftco-section login-container">
        <div className="container">
          <div className="row justify-content-center">
            <div className="col-md-6 col-lg-4 login-card">
              <div className="login-logo-container">
                <img src="assets/images/FYI-logo.png" alt="Logo" />
              </div>
              <div className="login-wrap p-0">
                <form
                  className="signin-form"
                  method="post"
                  onSubmit={handleSubmit(onSubmit)}
                >
                  <div className="form-group">
                    <input
                      type="text"
                      className={
                        errors.userId
                          ? "form-control form-control1 is-invalid"
                          : "form-control form-control1"
                      }
                      placeholder="Username"
                      id="userMailId"
                      {...register("userId", { required: true })}
                    />
                    {errors.userId && (
                      <span className="error-msg">
                        This field is required
                      </span>
                    )}
                  </div>
                  <div className="form-group">
                    <input
                      id="userPassword"
                      type={visibile === true ? "text" : "password"}
                      className={
                        errors.userPassword
                          ? "form-control form-control1 is-invalid"
                          : "form-control form-control1"
                      }
                      placeholder="Password"
                      {...register("userPassword", { required: true })}
                    />
                    {errors.userPassword && (
                      <span className="error-msg">
                        This field is required
                      </span>
                    )}{" "}
                    <span className="password-eye">
                      {visibile === true ? (
                        <FaRegEyeSlash onClick={toggleEye} />
                      ) : (
                        <FaRegEye onClick={toggleEye} />
                      )}
                    </span>
                  </div>
                  <div className="form-group mb-2">
                    <button
                      type="submit"
                      className="form-control form-control1 btn btn-primary submit px-3"
                    >
                      Sign In
                    </button>
                  </div>
                  <div className="form-group d-md-flex">
                    <div className="w-50">
                      <Link
                        to="/forgotPassword"
                        className="text-white sub-link"
                      >
                        Forgot Password
                      </Link>
                    </div>
                    <div className="w-50 text-md-right">
                      <Link to="/signup" className="sub-link">
                        Create New Account
                      </Link>
                    </div>
                  </div>
                </form>
                <p className="w-100 text-center">
                  &mdash; Or Sign In With &mdash;
                </p>
                <div className="social d-flex text-center">
                  <div className="google-login">
                    <img
                      src="assets/images/search.png"
                      alt="google login"
                      className="google-login-icon"
                    />
                    <button
                      className="form-control form-control1 submit px-3"
                      onClick={() => googleLogin()}
                    >
                      Sign in with Google{" "}
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section> */}
      <ForgotModal
        openForgotModal={forgotModal}
        closeForgotModal={closeForgotModal}
      />
      <Sonner />
    </>
  );
};

export default Login;
