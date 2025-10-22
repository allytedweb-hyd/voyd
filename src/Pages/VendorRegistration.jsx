import { Link } from "react-router-dom";

const VendorRegistration = () => {
  return (
    <>
      <section className="ftco-section login-container">
        <div className="">
          <div className="">
            <div className="col-md-12 text-center mb-5">
              <h2 className="heading-section text-center">VOYD Interiors</h2>
            </div>
          </div>
          <div className="row justify-content-center signup-card">
            <div className="">
              <div className="login-wrap  fields-container p-0">
                <h3 className="mb-4 text-center">Customer Sign Up </h3>
                <form action="#" className="signin-form form-horizantal">
                  <div className="row">
                    <div className="form-group col-md-6">
                      <input
                        type="text"
                        className="form-control form-control1"
                        placeholder="FirstName"
                        required
                      />
                    </div>
                    <div className="form-group col-md-6">
                      <input
                        type="text"
                        className="form-control form-control1"
                        placeholder="LastName"
                        required
                      />
                    </div>
                  </div>
                  <div className="row">
                    <div className="form-group col-md-6">
                      <input
                        type="text"
                        className="form-control form-control1"
                        placeholder="Mobile No"
                        required
                      />
                    </div>
                    <div className="form-group col-md-6">
                      <input
                        type="text"
                        className="form-control form-control1"
                        placeholder="Place"
                        required
                      />
                    </div>
                  </div>

                  <div className="form-group">
                    <input
                      id="password-field"
                      type="text"
                      className="form-control form-control1"
                      placeholder="Email"
                      required
                    />
                  </div>

                  <div className="form-group">
                    <button
                      type="submit"
                      className="form-control form-control1 btn btn-primary submit px-3"
                    >
                      Sign In
                    </button>
                  </div>
                  <div className="form-group d-md-flex">
                    <div className="w-50">
                      <label
                        className="checkbox-wrap-reg checkbox-primary"
                        htmlFor="rememberMe"
                      >
                        <input
                          type="checkbox"
                          id="rememberMe"
                          className="mr-2"
                        />
                        <span className="checkmark"></span>
                        Remember Me
                      </label>
                    </div>
                    <div className="w-50 text-md-right">
                      <Link to="#" className="text-white">
                        Forgot Password
                      </Link>
                    </div>
                  </div>
                </form>
                <p className="w-100 text-center">
                  &mdash; Or Sign In With &mdash;
                </p>
                <div className="social d-flex text-center">
                  <Link to="#" className="px-2 py-2 mr-md-1 rounded">
                    <span className="ion-logo-facebook mr-2"></span> Google
                  </Link>
                  <Link to="#" className="px-2 py-2 ml-md-1 rounded">
                    <span className="ion-logo-twitter mr-2"></span> Twitter
                  </Link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      ;
    </>
  );
};

export default VendorRegistration;
