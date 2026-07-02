import { Link, useLocation, useNavigate } from "react-router-dom";
import { FaRegUser } from "react-icons/fa6";
import { BsCart3 } from "react-icons/bs";
import { IoLogInOutline } from "react-icons/io5";
import { useContext, useEffect, useState } from "react";
import { getCartItems, getWishlistItems } from "../../libs/endpoints";
import { userContext } from "../../App";

import { FaRegHeart } from "react-icons/fa";
import CustomerSupport from "../Popups/CustomerSupport";
import { FaArrowUpRightFromSquare } from "react-icons/fa6";
import { RiCustomerService2Line } from "react-icons/ri";
import { CgMenu } from "react-icons/cg";
import { PiSignOutBold } from "react-icons/pi";
const Header = () => {

  const [isProfileDropdownOpen, setIsProfileDropdownOpen] = useState(false);
  const toggleProfileDropdown = () => {
    setIsProfileDropdownOpen(prev => !prev);
  };






  const [customerSupport, setCustomerSupport] = useState(false);
  const closeCustomerSupport = () => {
    setCustomerSupport(false);
  };

  const pathName = window.location.pathname;
  const { userDetails } = useContext(userContext);
  const navigate = useNavigate();

  const [headerTrans, setHeaderTrans] = useState("");

  const location = useLocation();

  useEffect(() => {
    if (headerTrans != pathName) {
      setHeaderTrans(pathName);
    }
  }, [location, pathName, headerTrans]);

  // on scroll sticky header
  useEffect(() => {
    window.addEventListener("scroll", isSticky);
    return () => {
      window.removeEventListener("scroll", isSticky);
    };
  });

  /* Method that will fix header after a specific scrollable */
  const isSticky = () => {
    const header = document.querySelector(".nav");
    const scrollTop = window.scrollY;
    scrollTop >= 120
      ? header.classList.add("is-sticky")
      : header.classList.remove("is-sticky");
  };

  // on scroll sticky header ends

  const [cartCount, setCartCount] = useState();
  const handleCartItems = async () => {
    let response = await getCartItems();
    if (response?.status) {
      setCartCount(response?.cartItemsCount);
    }
  };

  const [wishlistCount, setWishlistCount] = useState();
  const handleWishlistItems = async () => {
    let response = await getWishlistItems();
    if (response?.status) {
      setWishlistCount(response?.wishlistCount);
    }
  };

  let authToken = localStorage.getItem("token");
  useEffect(() => {
    handleCartItems();
    handleWishlistItems();
  }, [userDetails]);

  let hamburgerMenuEle = document.getElementById("hamburgerMenu");
  const handleHambergerMenu = () => {
    hamburgerMenuEle.classList.add("expanded");
  };

  const TogglecloseMenu = () => {
    hamburgerMenuEle.classList.remove("expanded");
  };

  // const handleGetAQuote = () => {
  //   let authToken = localStorage.getItem("token");
  //   console.log("auth token in header is =====", authToken);
  //   if (authToken == null || authToken == undefined || authToken == "") {
  //     navigate("/login");
  //     setTimeout(() => {
  //       setOpenLoginAlert(true);
  //     }, 5000);
  //   } else {
  //     navigate("/myQuotes");
  //   }
  // };

  const handleGetAQuote = () => {
    let authToken = localStorage.getItem("token");
    if (!authToken) {

      sessionStorage.setItem('redirectAfterLogin', '/myQuotes');
      navigate("/login");
    } else {
      navigate("/myQuotes");
    }
  };



  const handleSignOut = () => {
    let authToken = localStorage.getItem("token");
    localStorage.clear(authToken);
    navigate("/");
  };

  return (
    <>
      <nav className="nav navBarHeight">
        <div className="container-fluid bg-container">
          <div className="navigation navigation-main">
            <div className="container-fluid">
              <div className="row p-rev">
                <div className="col-md-2 mobile-res">
                  <div className="mainLogoBlock">
                    <Link to="/" className="logo-icon">
                      <img src="assets/images/logo/voydGreen.png" />
                    </Link>
                  </div>
                </div>
                <div className="col-md-10 po-recvet">
                  <div
                    className="floating-menu floating-menuToggle row justify-content-between d-flex align-items-start"
                    id="hamburgerMenu"
                  >
                    {/* <div className="bgLayer"></div> */}
                    {/* <div className="backgroundLayer"></div> */}
                    <ul className="col-md-8 d-flex justify-content-center togglee menuNav">
                      <li className="mobileMenuLogoLi">
                        {" "}
                        <div className="logoo mb-icon">
                          <Link to="/" className="logo-icon">
                            <img src="assets/images/logo/voydWite.png" />
                          </Link>
                        </div>
                        <button
                          type="button"
                          className="closeTogglee"
                          data-dismiss="modal"
                          aria-label="Close"
                          id="closetoggle"
                          onClick={TogglecloseMenu}
                        >
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </li>
                      <li>
                        <Link to="/" onClick={TogglecloseMenu}>
                          Home{" "}
                        </Link>
                      </li>
                      <li>
                        <Link to="/about" onClick={TogglecloseMenu}>
                          About
                        </Link>
                      </li>
                      <li className="services">
                        {/* <Link to="/services">Services </Link> */}
                        <p>Services </p>
                        <ul>
                          <li>
                            <Link
                              to="/customerservice"
                              onClick={TogglecloseMenu}
                            >
                              Customer Services{" "}
                            </Link>
                          </li>
                          <li>
                            <Link to="/vendorservice" onClick={TogglecloseMenu}>
                              Vendor Services
                            </Link>
                          </li>
                        </ul>
                      </li>
                      <li>
                        <Link to="/shop" onClick={TogglecloseMenu}>
                          Shop
                        </Link>
                      </li>
                      <li>
                        <Link to="/qualitychecker" onClick={TogglecloseMenu}>
                          <div className="d-flex qualCheck">
                            <div>Quality</div>
                            <div>Checker</div>
                          </div>
                        </Link>
                      </li>

                      <li>
                        <Link to="/verifydesigner" onClick={TogglecloseMenu}>
                          <div className="d-flex qualCheck">
                            <div>Verify</div>
                            <div>Designer</div>
                          </div>
                        </Link>
                      </li>

                      <li>
                        <Link to="/guidespage" onClick={TogglecloseMenu}>
                          Guides{" "}
                        </Link>
                      </li>

                      <li>
                        <Link to="/contact" onClick={TogglecloseMenu}>
                          Contact
                        </Link>
                      </li>

                      {/* profile */}

                      {authToken && (
                        <li className="services myprofile">
                          <p onClick={toggleProfileDropdown}>My Account</p>
                          {isProfileDropdownOpen && (
                            <ul>
                              <li>
                                <Link to="/Myorders" onClick={() => { TogglecloseMenu(); setIsProfileDropdownOpen(false); }}>
                                  My orders
                                </Link>
                              </li>
                              <li>
                                <Link to="/customerProjects" onClick={() => { TogglecloseMenu(); setIsProfileDropdownOpen(false); }}>
                                  My projects
                                </Link>
                              </li>
                              <li>
                                <Link to="/changePassword" onClick={() => { TogglecloseMenu(); setIsProfileDropdownOpen(false); }}>
                                  Change password
                                </Link>
                              </li>
                              <li>
                                <Link to="/referaldetails" onClick={() => { TogglecloseMenu(); setIsProfileDropdownOpen(false); }}>
                                  My refferals
                                </Link>
                              </li>
                            </ul>
                          )}
                        </li>
                      )}



                      {/* profile */}



                      {(authToken === null ||
                        authToken === undefined ||
                        authToken === "") && (
                          <li className="loginIcon">
                            <Link to="/login">
                              {" "}
                              <IoLogInOutline />
                              Login
                            </Link>
                          </li>
                        )}
                      {authToken === null ||
                        authToken === undefined ||
                        authToken === "" ? (
                        <li className="loginIcon">
                          <Link to="/signup">
                            {" "}
                            <FaArrowUpRightFromSquare className="sign" />
                            Signup
                          </Link>
                        </li>
                      ) : (
                        <li
                          onClick={handleSignOut}
                          className="loginIcon signIcon"
                        >
                          <Link to="">
                            <PiSignOutBold />
                            SignOut
                          </Link>
                        </li>
                      )}
                    </ul>

                    <div className="col-md-4 mobileVisibleIcons">
                      <div className="navigation navigation-top clearfix d-flex align-items-center justify-content-end">
                        <ul className="iconList">
                          <li
                            className="fullWidth one"
                            onClick={TogglecloseMenu}
                          >
                            <button
                              type="button"
                              className="getAQuotBtn"
                              onClick={handleGetAQuote}
                            >
                              Get a Quote
                            </button>
                          </li>
                          {authToken === null ||
                            authToken === undefined ||
                            authToken === "" ? (
                            <li
                              className="fullWidth two"
                              onClick={TogglecloseMenu}
                            >
                              {/* <button className="customerSupport">
                                Customer Support
                              </button> */}

                             <button
  onClick={() => setCustomerSupport(true)}
  className="customerSupport supportBtn"
  type="button"F
>
  <RiCustomerService2Line />
</button>
                            </li>
                          ) : (
                            <>
                              <li
                                className="hlinkmenu"
                                onClick={TogglecloseMenu}
                              >
                                <Link to="/YourAccount" className="open-login">
                                  <FaRegUser />
                                </Link>
                              </li>
                              <li
                                className="hlinkmenu"
                                onClick={TogglecloseMenu}
                              >
                                <Link to="/wishlist" className=" open-cart">
                                  <FaRegHeart />

                                  <span>
                                    {wishlistCount === undefined
                                      ? 0
                                      : wishlistCount}
                                  </span>
                                </Link>
                              </li>

                              <li
                                className="hlinkmenu"
                                onClick={TogglecloseMenu}
                              >
                                <Link to="/mycart" className="open-cart">
                                  <BsCart3 />
                                  <span>
                                    {cartCount === undefined ? 0 : cartCount}
                                  </span>
                                </Link>
                              </li>
                              <li
                                className="hlinkmenu"
                                onClick={() => setCustomerSupport(true)}
                              >
                                <Link className="open-login">
                                  <RiCustomerService2Line />
                                </Link>
                              </li>
                            </>
                          )}
                        </ul>

                        <button
                          type="button"
                          className="closee togglee"
                          data-dismiss="modal"
                          aria-label="Close"
                          id="closetoggle"
                          onClick={TogglecloseMenu}
                        >
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    </div>
                  </div>

                  {(authToken === null ||
                    authToken === undefined ||
                    authToken === "") && (
                      <span className="mobileLoginAc">
                        {" "}
                        <Link to="/YourAccount">
                          <FaRegUser />
                        </Link>
                      </span>
                    )}
                  <div className="toggle_out text-end">
                    <button onClick={handleHambergerMenu}>
                      <CgMenu className="open-toggle" />
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </nav>
      {/* <LoginAlert open={openLoginAlert} handleClose={handleLoginAlertClose} /> */}

      <CustomerSupport
        openCustomerSupport={customerSupport}
        closeCustomerSupport={closeCustomerSupport}
      />
    </>
  );
};

export default Header;
