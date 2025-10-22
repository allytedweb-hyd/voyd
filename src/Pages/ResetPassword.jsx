import { useState } from "react";
import { useForm } from "react-hook-form";
import { FaRegEye, FaRegEyeSlash } from "react-icons/fa";
import { useContext, useEffect } from "react";
import { environmentUrl } from "../env/enviroment";
import { useNavigate } from "react-router-dom";
import { userContext } from "../App";
import { BsKeyFill } from "react-icons/bs";
import { toast } from "sonner";
import Sonner from "../Components/Toaster/Sonner";
import Loader from "../Components/Spinner/Loader";

const ResetPassword = () => {
  const { userDetails } = useContext(userContext);
  const navigate = useNavigate();
  const [visibile, setVisible] = useState(false);
  const [conVisibile, setConVisible] = useState(false);
  const [loading, setLoading] = useState(false);

  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm();
  const { setHeaderVal } = useContext(userContext);

  const onSubmit = async (data) => {
    console.log("reset password data====", data);
    try {
      setLoading(true);
      if (data?.password == data?.conPassword) {
        const apiUrl = `${environmentUrl}/forgotPassword/resetPassword.php`;
        const options = {
          method: "POST",
          body: JSON.stringify({
            ...data,
            customerId: userDetails?.customer_id,
          }),
        };
        const fetchres = await (await fetch(apiUrl, options)).json();
        // console.log("reset pass res====", fetchres);
        if (fetchres?.status) {
          toast.success("Password Changed Successfully");
          navigate("/login");
        } else {
          toast.error("Failed to Change Password");
        }
      } else {
        toast.warning("Password and Confirm Password Does'nt Match");
      }
    } catch (error) {
      console.log("reset password error", error);
    } finally {
      setLoading(false);
    }
  };

  const toggleEye = () => {
    setVisible(!visibile);
  };
  const ConToggleEye = () => {
    setConVisible(!conVisibile);
  };

  useEffect(() => {
    setHeaderVal(false);
  }, []);

  return (
    <>
      {loading && <Loader />}
      <section className="ftco-section reset-container">
        <div className="container">
          <div className="row justify-content-center reset">
            <div className="col-md-8 col-lg-4 col-sm-8 forgot-pass-card">
              <div className="login-wrap p-0">
                <form
                  className="signin-form"
                  method="post"
                  onSubmit={handleSubmit(onSubmit)}
                >
                  <div className="forgotlock">
                    <BsKeyFill />
                  </div>
                  <div className="col-md-12 text-center mb-3">
                    <h2 className="heading-section">Reset Password</h2>
                  </div>
                  <div className="form-group">
                    <div className="form-group">
                      <label className="form-label">New Password</label>
                      <input
                        type={visibile === true ? "text" : "password"}
                        id="resetPassword"
                        className={
                          errors.password
                            ? "form-control form-control1 is-invalid"
                            : "form-control form-control1"
                        }
                        placeholder="Password"
                        {...register("password", { required: true })}
                      />
                      {errors.password && (
                        <span className="error-msg">
                          This field is required
                        </span>
                      )}
                      <span className="reset-pass-eye-icon">
                        {visibile === true ? (
                          <FaRegEyeSlash onClick={toggleEye} />
                        ) : (
                          <FaRegEye onClick={toggleEye} />
                        )}
                      </span>
                    </div>
                    <div className="form-group">
                      <label className="form-label">Confirm Password</label>

                      <input
                        type={conVisibile === true ? "text" : "password"}
                        id="ConfPassword"
                        className={
                          errors.password
                            ? "form-control form-control1 is-invalid"
                            : "form-control form-control1"
                        }
                        placeholder="Confirm Password"
                        {...register("conPassword", { required: true })}
                      />
                      {errors.password && (
                        <span className="error-msg">
                          This field is required
                        </span>
                      )}
                      <span className="reset-pass-eye-icon">
                        {conVisibile === true ? (
                          <FaRegEyeSlash onClick={ConToggleEye} />
                        ) : (
                          <FaRegEye onClick={ConToggleEye} />
                        )}
                      </span>
                    </div>
                  </div>

                  <div className="mb-2 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <button
                      type="submit"
                      className="btn btn-primary forgot submit"
                    >
                      Reset
                    </button>
                  </div>
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

export default ResetPassword;
