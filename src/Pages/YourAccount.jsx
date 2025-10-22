/* eslint-disable no-unused-vars */
import React, { useContext, useEffect, useState } from "react";
import { Link, useLocation, useNavigate } from "react-router-dom";
import { FaHeart } from "react-icons/fa";
import { CiGift } from "react-icons/ci";
import { LiaSignOutAltSolid } from "react-icons/lia";
import { IoMdPerson } from "react-icons/io";
import { environmentUrl } from "../env/enviroment";
import { userContext } from "../App";
import { PiWarehouseDuotone } from "react-icons/pi";
import { HiOutlineShoppingCart } from "react-icons/hi2";
import { LiaUserSolid } from "react-icons/lia";
import { PiUploadSimpleBold } from "react-icons/pi";
import { toast } from "sonner";
import Sonner from "../Components/Toaster/Sonner";
import { FaAnglesRight } from "react-icons/fa6";
import { envImgUrl } from "../env/envImage";
import MyAccountSidebar from "../Components/Common/MyAccountSidebar";
import Loader from "../Components/Spinner/Loader";
import { FaRegUser } from "react-icons/fa6";

const YourAccount = () => {
  const navigate = useNavigate();
  const [formData, setFormData] = useState({});
  const [userProfileDetails, setUserProfileDetails] = useState([]);
  const [profilePreview, setProfilePreview] = useState(null);
  const { userDetails } = useContext(userContext);
  const userLoginDetails = userDetails;
  const [loading, setLoading] = useState(false);
  const [formErrors, setFormErrors] = useState({});

  const handleUserInput = (event) => {
    // setFormData({
    //   ...formData,
    //   [event.target.name]: event.target.value,
    // });

    const { name, value } = event.target;
    console.log("Input changed:", { name, value });

    setFormData({ ...formData, [name]: value });
  };

  const validateForm = () => {
    const errors = {};

    let mobile = formData.customer_mobile.trim();

    // Remove spaces, hyphens, and country code if present
    mobile = mobile.replace(/\s|-/g, "");
    if (mobile.startsWith("+91")) {
      mobile = mobile.slice(3);
    } else if (mobile.startsWith("91") && mobile.length === 12) {
      mobile = mobile.slice(2);
    }

    if (!mobile) {
      errors.customer_mobile = "Enter mobile number ";
    } else if (!/^[6-9]\d{9}$/.test(mobile)) {
      errors.customer_mobile = "Enter a valid number";
    }

    if (!formData.first_name || !formData.first_name.trim()) {
      errors.first_name = "First name is required.";
    } else if (!/^[a-zA-Z ]+$/.test(formData.first_name)) {
      errors.first_name = "Only letters and spaces are allowed.";
    }

    if (!formData.last_name || !formData.last_name.trim()) {
      errors.last_name = "Last name is required.";
    } else if (!/^[a-zA-Z ]+$/.test(formData.last_name)) {
      errors.last_name = "Only letters and spaces are allowed.";
    }

    if (!formData.place || !formData.place.trim()) {
      errors.place = "Locality is required.";
    }

    if (!formData.street || !formData.street.trim()) {
      errors.street = "Street is required.";
    }

    if (!formData.city || !formData.city.trim()) {
      errors.city = "City is required.";
    }

    if (!formData.state || !formData.state.trim()) {
      errors.state = "State is required.";
    }

    // if (!formData.customer_mobile || !formData.customer_mobile.trim()) {
    //   errors.customer_mobile = "Custumer number is required.";
    // } else if (!/^[6-9]\d{9}$/.test(formData.customer_mobile)) {
    //   errors.customer_mobile = "Enter a valid 10-digit phone number.";
    // }

    // if (!formData.customer_mobile || !formData.customer_mobile.trim()) {
    //   errors.customer_mobile = "Custumer number is required.";
    // }

    if (!formData.customer_email || !formData.customer_email.trim()) {
      errors.customer_email = "Email is required.";
    } else if (
      !/^[\w.-]+@([\w-]+\.)+[\w-]{2,4}$/.test(formData.customer_email)
    ) {
      errors.customer_email = "Enter a valid email address.";
    }

    if (!formData.address || !formData.address.trim()) {
      errors.address = "Address is required.";
    }

    if (!formData.delivery_address || !formData.delivery_address.trim()) {
      errors.delivery_address = "Address is required.";
    }

    return errors;
  };

  const updateUserProfile = async (event) => {
    event.preventDefault();

    const errors = validateForm();
    setFormErrors(errors);

    if (Object.keys(errors).length > 0) {
      toast.error("Please fill the required fields in the form.");
      return;
    }

    try {
      setLoading(true);
      const apiUrl = `${environmentUrl}/Authentication/update_user_profile.php`;
      const options = {
        method: "put",
        body: JSON.stringify(formData),
        headers: { Authorization: "Bearer " + localStorage.getItem("token") },
      };
      const response = await (await fetch(apiUrl, options)).json();
      console.log("update profile response===", response);
      // if (response?.status) {
      //   toast.success(response?.response);
      //   getUserData();
      // }

      if (response?.status) {
        toast.success(response?.response || "Profile updated successfully!");

        if (
          formData.profile_img &&
          formData.profile_img.startsWith("data:image/")
        ) {
          setProfilePreview(formData.profile_img);
        }

        getUserData();
      } else {
        toast.error(response?.response || "Update failed. Please try again.");
      }
    } catch (error) {
      console.log("update profile error==", error);
    } finally {
      setLoading(false);
    }
  };

  const getUserData = async () => {
    try {
      setLoading(true);
      const apiUrl = `${environmentUrl}/Authentication/get_user_profile.php`;
      const options = {
        method: "POST",
        body: JSON.stringify(formData),
        headers: { Authorization: "Bearer " + localStorage.getItem("token") },
      };
      const response = await (await fetch(apiUrl, options)).json();
      console.log("get user response===", response);
      console.log("Profile Image from API:", response?.response?.profile_img);
      console.log("Google ID from API:", response?.response?.google_id);
      console.log("Full user profile API response:", response);
      if (response?.status) {
        setFormData({
          first_name: response?.response?.first_name,
          last_name: response?.response?.last_name,
          customer_mobile: response?.response?.customer_mobile,
          profile_img: response?.response?.profile_img,
          customer_email: response?.response?.customer_email,
          address: response?.response?.address,
          delivery_address: response?.response?.delivery_address,
          refferal_code: response?.response?.refferal_code,
          google_id: response?.response?.google_id,
          place: response?.response?.place || "",
          street: response?.response?.street || "",
          city: response?.response?.city || "Hyderabad",
          state: response?.response?.state || "Telangana",
        });
        setProfilePreview(null);
        return response?.response;
      }
    } catch (error) {
      console.log("user details get error==", error);
    } finally {
      setLoading(false);
    }
  };

  // const handleProfileImage = (event) => {
  //   const file = event.target.files[0];
  //   if (file) {
  //     const reader = new FileReader();
  //     reader.readAsDataURL(file);
  //     console.log("images is====", URL.createObjectURL(event.target.files[0]));
  //     setProfilePreview(URL.createObjectURL(event.target.files[0]));
  //     reader.onloadend = () => {
  //       setFormData((prev) => ({
  //         ...prev,
  //         [event.target.name]: reader.result,
  //       }));
  //     };
  //   }
  //   console.log("form data is", formData);
  //   console.log("file is", profilePreview);
  // };

  const handleProfileImage = (event) => {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.readAsDataURL(file);

      reader.onloadend = () => {
        const base64Image = reader.result;

        setProfilePreview(URL.createObjectURL(file));

        // setFormData((prev) => ({
        //   ...prev,
        //   [event.target.name]: base64Image,
        //   google_id: prev.google_id || "",
        // }));

        setFormData((prev) => ({
          ...prev,
          [event.target.name]: base64Image,
          google_id: "", // force custom image display
        }));

        console.log("form data is", {
          ...formData,
          [event.target.name]: base64Image,
        });
        console.log("profile preview is", URL.createObjectURL(file));
      };
    }
  };

  useEffect(() => {
    getUserData();
    console.log("userLoginDetails===", userLoginDetails);
  }, []);

  const handleSignOut = () => {
    let authToken = localStorage.getItem("token");
    localStorage.clear(authToken);
    navigate("/login");
  };

  return (
    // -------------- NEW DESIGN CODE ------------
    <>
      <div className={"main-account-container mainBackground"}>
        {/* <div className="slidBlock">
          <div className="slidBlockInner">
            <ul>
              <li>
                <Link to="/YourAccount" className="profileicon colorGreen">
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
                <Link to="/changePassword" className="profileicon">
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
            {localStorage.getItem("token") && (
              <div className="row ">
                <MyAccountSidebar userDetails={getUserData} />
                <div className="col-lg-10 col-md-12 col-sm-12 rightMainColumn account">
                  <div className="mainOuter">
                    <div className="d-flex justify-content-between align-items-center">
                      <div className="topTitles title-btm">
                        <h3>My Profile</h3>
                      </div>
                      <div>
                        <h5>
                          Refferal Code:
                          {formData?.refferal_code}{" "}
                        </h5>
                      </div>
                    </div>
                    <div className="accountFormCard">
                      <form
                        action=""
                        method="put"
                        onSubmit={updateUserProfile}
                        encType="multipart/form-data"
                      >
                        <div className="firstBlock">
                          <div className="fields row">
                            <h3 className="accTitle">Account Settings</h3>
                            {/* <div className="mobileTopProfile">
                              <h3>Account Settings</h3>
                              <div className="userImg">
                                <img src="assets/images/face6.jpg" alt="" />
                              </div>
                            </div> */}

                            <div className="fieldBlock col-md-6">
                              <p>
                                First Name<span className="errorSymbol">*</span>
                              </p>
                              {/* <div className="twoFields"> */}
                              <input
                                type="text"
                                className={`form-control ${formErrors.first_name ? "is-invalid" : ""
                                  }`}
                                placeholder="first name"
                                value={formData?.first_name || ""}
                                name="first_name"
                                onChange={handleUserInput}
                              />
                              {formErrors.first_name && (
                                <p className="error-msg logError">
                                  {formErrors.first_name}
                                </p>
                              )}
                              {/* </div> */}
                            </div>
                            <div className="fieldBlock col-md-6">
                              <p>
                                Last Name<span className="errorSymbol">*</span>
                              </p>

                              <input
                                type="text"
                                className={`form-control ${formErrors.last_name ? "is-invalid" : ""
                                  }`}
                                placeholder="last name"
                                value={formData?.last_name || ""}
                                name="last_name"
                                onChange={handleUserInput}
                              />
                              {formErrors.last_name && (
                                <p className="error-msg logError">
                                  {formErrors.last_name}
                                </p>
                              )}
                            </div>
                            <div className="fieldBlock col-md-6">
                              <p>
                                Mobile Number
                                <span className="errorSymbol">*</span>
                              </p>
                              <input
                                type="tel"
                                className={`form-control ${formErrors.customer_mobile ? "is-invalid" : ""
                                  }`}
                                placeholder="Mobile Number"
                                value={formData?.customer_mobile || ""}
                                name="customer_mobile"
                                // onChange={handleUserInput}
                                onChange={(e) => {
                                  const onlyNumbers = e.target.value.replace(
                                    /[^\d+]/g,
                                    ""
                                  );
                                  handleUserInput({
                                    target: {
                                      name: e.target.name,
                                      value: onlyNumbers,
                                    },
                                  });
                                }}
                              />
                              {formErrors.customer_mobile && (
                                <p className="error-msg logError">
                                  {formErrors.customer_mobile}
                                </p>
                              )}
                            </div>

                            <div className="fieldBlock col-md-6">
                              <p>
                                Email<span className="errorSymbol">*</span>
                              </p>
                              <input
                                type="email"
                                className={`form-control ${formErrors.customer_email ? "is-invalid" : ""
                                  }`}
                                placeholder="xyz@example.com"
                                value={formData?.customer_email || ""}
                                name="customer_email"
                                onChange={handleUserInput}
                              />
                              {formErrors.customer_email && (
                                <p className="error-msg logError">
                                  {formErrors.customer_email}
                                </p>
                              )}
                            </div>

                            <div className="fieldBlock col-md-6">
                              <p>
                                Locality<span className="errorSymbol">*</span>
                              </p>
                              <input
                                type="text"
                                className={`form-control ${formErrors.place ? "is-invalid" : ""
                                  }`}
                                placeholder="Locality"
                                value={formData?.place || ""}
                                name="place"
                                onChange={handleUserInput}
                              />
                              {formErrors.place && (
                                <p className="error-msg logError">
                                  {formErrors.place}
                                </p>
                              )}
                            </div>

                            <div className="fieldBlock col-md-6">
                              <p>
                                Street<span className="errorSymbol">*</span>
                              </p>
                              <input
                                type="text"
                                className={`form-control ${formErrors.street ? "is-invalid" : ""
                                  }`}
                                placeholder="Street"
                                value={formData?.street || ""}
                                name="street"
                                onChange={handleUserInput}
                              />
                              {formErrors.street && (
                                <p className="error-msg logError">
                                  {formErrors.street}
                                </p>
                              )}
                            </div>
                            <div className="fieldBlock col-md-6">
                              <p>
                                City<span className="errorSymbol">*</span>
                              </p>
                              <input
                                type="text"
                                className={`form-control ${formErrors.city ? "is-invalid" : ""
                                  }`}
                                placeholder="City"
                                value={formData?.city || ""}
                                name="city"
                                onChange={handleUserInput}
                              />
                              {formErrors.city && (
                                <p className="error-msg logError">
                                  {formErrors.city}
                                </p>
                              )}
                            </div>

                            <div className="fieldBlock col-md-6">
                              <p>
                                State<span className="errorSymbol">*</span>
                              </p>
                              <input
                                type="text"
                                className={`form-control ${formErrors.state ? "is-invalid" : ""
                                  }`}
                                placeholder="State"
                                value={formData?.state || ""}
                                name="state"
                                onChange={handleUserInput}
                              />
                              {formErrors.state && (
                                <p className="error-msg logError">
                                  {formErrors.state}
                                </p>
                              )}
                            </div>
                          </div>
                          <div className="profileimagecontainerr">
                            {/* <div> <button
                              type="button"
                              className="getfrndtBtn"

                            >
                              Refer A Friend
                            </button></div> */}
                            <div className="image">
                              <div className="userImg">
                                <div
                                  className="uploadImageBlock
                          "
                                >
                                  <label
                                    htmlFor="file-upload"
                                    className="custom-file-label uploadLabel"
                                  >
                                    <PiUploadSimpleBold />
                                    Upload Photo
                                  </label>
                                  <input
                                    type="file"
                                    id="file-upload"
                                    className="custom-file-input"
                                    name="profile_img"
                                    onChange={handleProfileImage}
                                  />
                                </div>
                                <img
                                  // src={
                                  //   formData?.profile_img &&
                                  //     formData?.profile_img?.startsWith(
                                  //       "https://lh3.googleusercontent.com/"
                                  //     )
                                  //     ? formData?.profile_img
                                  //     : formData?.google_id == "" &&
                                  //       formData?.profile_img !== "" &&
                                  //       profilePreview == null
                                  //       ? `${envImgUrl}/Uploads/customer/${formData?.profile_img}`
                                  //       : profilePreview != null &&
                                  //         formData?.google_id === "" &&
                                  //         formData?.profile_img.startsWith(
                                  //           "data:image/"
                                  //         )
                                  //         ? profilePreview
                                  //         : "assets/images/user-profile.webp"
                                  // }

                                  src={
                                    profilePreview
                                      ? profilePreview
                                      : formData?.profile_img?.startsWith("data:image/")
                                        ? formData?.profile_img
                                        : formData?.profile_img?.startsWith("https://lh3.googleusercontent.com/")
                                          ? formData?.profile_img
                                          : formData?.profile_img
                                            ? `${envImgUrl}/Uploads/customer/${formData.profile_img}`
                                            : "assets/images/user-profile.webp"
                                  }
                                  alt="profile image"
                                  // referrerPolicy={
                                  //   userLoginDetails?.google_id
                                  //     ? "no-referrer"
                                  //     : ""
                                  // }
                                  referrerPolicy="no-referrer"
                                />
                              </div>
                            </div>
                          </div>
                        </div>
                        <div className="secondBlock row">
                          <div className="fieldBlock">
                            <p>
                              Permanent Address
                              <span className="errorSymbol">*</span>
                            </p>
                            <textarea
                              name="address"
                              id=""
                              className={`form-control ${formErrors.address ? "is-invalid" : ""
                                }`}
                              placeholder="My Home  tycoon, Dno-5C, Begumpet (500016), Hyderabad,
Telengana."
                              rows={4}
                              value={formData?.address || ""}
                              onChange={handleUserInput}
                            ></textarea>
                            {formErrors.address && (
                              <p className="error-msg logError">
                                {formErrors.address}
                              </p>
                            )}
                          </div>
                          <div className="fieldBlock">
                            <p>
                              Delivery Address
                              <span className="errorSymbol">*</span>
                            </p>
                            <textarea
                              name="delivery_address"
                              id=""
                              placeholder="My Home  tycoon, Dno-5C, Begumpet (500016), Hyderabad,
Telengana."
                              className={`form-control ${formErrors.delivery_address ? "is-invalid" : ""
                                }`}
                              rows={4}
                              value={formData?.delivery_address || ""}
                              onChange={handleUserInput}
                            ></textarea>
                            {formErrors.delivery_address && (
                              <p className="error-msg logError">
                                {formErrors.delivery_address}
                              </p>
                            )}
                          </div>
                        </div>
                        <div className="buttonDiv">
                          <button type="submit">Update</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            )}
          </div>
        </div>
      </div>
      <Sonner />
    </>
    // ------------------- OLD CODE -----------------
    // <>
    //   <div
    //     className={
    //       userLoginDetails == undefined || userLoginDetails == null
    //         ? "account-bg"
    //         : "main-account-container"
    //     }
    //   >
    //     <div className="container-fluid">
    //       <div className="row">
    //         {userLoginDetails != undefined ? (
    //           <div className="col-md-12 mt-5 youraccount d-flex">
    //             <div className="col-lg-3 col-md-4 col-sm-8">
    //               <div className="card account">
    //                 <div className="card-body">
    //                   <h6 className="align-items-center">My Account</h6>
    //                   <h6>Orders and Credits</h6>
    //                   <ul>
    //                     <li>
    //                       <FaHeart />
    //                       <Link to="/shop" className="profileicon">
    //                         Your Wishlist
    //                       </Link>
    //                     </li>
    //                     <hr />
    //                     <li>
    //                       <CiGift />
    //                       <Link to="/Myorders" className="profileicon">
    //                         Your Orders
    //                       </Link>
    //                     </li>
    //                     <hr />
    //                     <li>
    //                       <HiOutlineShoppingCart />
    //                       <Link to="/cart" className="profileicon">
    //                         Your Cart
    //                       </Link>
    //                     </li>
    //                     <hr />
    //                     <li>
    //                       <PiWarehouseDuotone />
    //                       <Link to="/myProjects" className="profileicon">
    //                         Your Projects
    //                       </Link>
    //                     </li>
    //                   </ul>
    //                   <h6>Profile</h6>
    //                   <ul>
    //                     <li>
    //                       <LiaUserSolid />
    //                       <Link to="/YourAccount" className="profileicon">
    //                         Personal Information
    //                       </Link>
    //                     </li>
    //                     <hr />
    //                     <li onClick={handleSignOut}>
    //                       <LiaSignOutAltSolid />
    //                       <Link to="" className="profileicon">
    //                         Sign Out
    //                       </Link>
    //                     </li>
    //                   </ul>
    //                 </div>
    //               </div>
    //             </div>

    //             <div className="col-lg-9 col-md-8 col-sm-12">
    //               <div className="card profile">
    //                 <div className="card-body profile">
    //                   <h3 className="text-center">Personal Information</h3>
    //                   <div className="row">
    //                     <div className="col-md-6">
    //                       <div className="profileinfo">
    //                         <div className="info">
    //                           <div className="profileimage">
    //                             <img
    //                               src="assets/images/pngtree-businessman-user-avatar.png"
    //                               alt="Admin"
    //                               className="rounded-circle p-1 bg-primary"
    //                               width="110"
    //                             />
    //                           </div>
    //                           <div className="mt-3 text-center">
    //                             <h5>{`${userLoginDetails?.first_name}.${userLoginDetails?.last_name}`}</h5>
    //                             <p className="text-secondary mb-1">
    //                               User Id: {userLoginDetails?.customer_id}
    //                             </p>
    //                             <p className="text-muted font-size-sm">
    //                               {userLoginDetails?.address}
    //                             </p>
    //                           </div>
    //                         </div>
    //                       </div>
    //                     </div>

    //                     <div className="col-md-6">
    //                       <div className="personal information form">
    //                         <div className="contact_field">
    //                           <p className="text-center">
    //                             Fill Your Details For Better User Experience
    //                           </p>
    //                           <div className="row">
    //                             <div className="col-md-12">
    //                               <input
    //                                 type="text"
    //                                 className="form-control form-group"
    //                                 placeholder="First Name"
    //                               />
    //                             </div>
    //                             <div className="col-md-12">
    //                               <input
    //                                 type="text"
    //                                 className="form-control form-group"
    //                                 placeholder="Last Name"
    //                               />
    //                             </div>
    //                             {/* <div className="col-md-12">
    //                               <input
    //                                 type="mail"
    //                                 className="form-control form-group"
    //                                 placeholder="Designation"
    //                               />
    //                             </div> */}
    //                           </div>
    //                           <div className="row">
    //                             <div className="col-md-12">
    //                               <input
    //                                 type="mail"
    //                                 className="form-control form-group"
    //                                 placeholder="Email"
    //                               />
    //                             </div>
    //                             <div className="col-md-12">
    //                               <input
    //                                 type="number"
    //                                 className="form-control form-group"
    //                                 placeholder="Number"
    //                               />
    //                             </div>
    //                           </div>
    //                           <textarea
    //                             className="form-control form-group"
    //                             placeholder="Address"
    //                           ></textarea>
    //                           <div className="text-center">
    //                             <button className="btn btn-primary myaccount">
    //                               Save Changes
    //                             </button>
    //                           </div>
    //                         </div>
    //                       </div>
    //                     </div>
    //                   </div>
    //                 </div>
    //               </div>
    //             </div>
    //           </div>
    //         ) : (
    //           <div className="container">
    //             <div className="row">
    //               <div
    //                 className={
    //                   userLoginDetails == undefined || userLoginDetails == null
    //                     ? "result-card image-waiting-container image-more-access mt-4 mb-4"
    //                     : "result-card image-waiting-container mt-4 mb-4"
    //                 }
    //               >
    //                 <div className="col-md-6">
    //                   <img
    //                     src="assets/images/need more access.jpg"
    //                     alt="no results"
    //                     className="no-cart-items loginn"
    //                   />
    //                 </div>
    //                 <div className="image-waiting-content col-md-6 text-left">
    //                   <p>
    //                     To Have More Access Please Login/SignUp By Clicking
    //                     Below Button
    //                   </p>

    //                   <Link to="/login" className="login-access-btn">
    //                     Login/Signup
    //                   </Link>
    //                 </div>
    //               </div>
    //             </div>
    //           </div>
    //         )}
    //       </div>
    //     </div>
    //   </div>
    // </>
  );
};

export default YourAccount;
