/* eslint-disable react/prop-types */
import { Link } from "react-router-dom";
import { envImgUrl } from "../../env/envImage";
import { useNavigate } from "react-router-dom";
import { useEffect, useState } from "react";

const MyAccountSidebar = ({ userDetails }) => {
  const navigate = useNavigate();
  const [formData, setFormData] = useState({});
  const handleSignOut = () => {
    localStorage.removeItem("token");
    navigate("/");
  };

  const getUserProfileDetails = async () => {
    try {
      const profileDetails = await userDetails();
      setFormData(profileDetails);
    } catch (error) {
      console.log("user details get error==", error);
    }
  };

  useEffect(() => {
    getUserProfileDetails();
  }, []);

  useEffect(() => {
    console.log("Profile image:", formData?.profile_img);
    console.log("Google ID:", formData?.google_id);
  }, [formData]);

  return (
    <>
      <div className=" col-md-2 col-lg-2 sideFixColumn">
        <div className="sideBlockCard">
          <div className="accountName">
            <div className="image">
              <img
                // src={
                //   formData?.profile_img &&
                //   formData?.profile_img?.startsWith(
                //     "https://lh3.googleusercontent.com/"
                //   )
                //     ? formData?.profile_img
                //     : formData?.google_id === "" && formData?.profile_img !== ""
                //     ? envImgUrl + "/Uploads/customer/" + formData?.profile_img
                //     : "assets/images/user-profile.webp"
                // }

                src={
                  formData?.profile_img?.startsWith("https://")
                    ? formData.profile_img
                    : formData?.profile_img
                      ? envImgUrl + "/Uploads/customer/" + formData.profile_img
                      : "assets/images/user-profile.webp"
                }

                alt=""
                referrerPolicy="no-referrer"
              />
            </div>
            <h4>{`${formData?.first_name} ${formData?.last_name}`}</h4>
          </div>

          <h5>Account Settings</h5>

          <ul>
            <li>
              {/* <LiaUserSolid /> */}
              <Link to="/YourAccount" className="profileicon colorGreen">
                My Profile
              </Link>
            </li>

            <li>
              {/* <CiGift /> */}
              <Link to="/Myorders" className="profileicon">
                My Orders
              </Link>
            </li>
            <li>
              {/* <CiGift /> */}
              <Link to="/customerProjects" className="profileicon">
                My Projects
              </Link>
            </li>

            <li>
              {/* <FaHeart /> */}
              <Link to="/wishlist" className="profileicon">
                Your Wishlist
              </Link>
            </li>

            <li>
              {/* <CiGift /> */}
              <Link to="/changePassword" className="profileicon">
                Change Password
              </Link>
            </li>
            {/* <li>
                        <HiOutlineShoppingCart />
                        <Link to="/cart" className="profileicon">
                          Your Cart
                        </Link>
                      </li> */}

            {/* <li>
                        <PiWarehouseDuotone />
                        <Link to="/myProjects" className="profileicon">
                          Your Projects
                        </Link>
                      </li> */}

            <li>
              <Link to="/referaldetails" className="profileicon ">
                Referral Details
              </Link>
            </li>
            <li onClick={handleSignOut}>
              {/* <LiaSignOutAltSolid /> */}
              <Link to="" className="profileicon">
                Sign Out
              </Link>
            </li>
          </ul>
        </div>
      </div>
    </>
  );
};

export default MyAccountSidebar;
