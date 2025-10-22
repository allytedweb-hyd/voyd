import { useContext, useEffect, useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import { addToCart, getWishlistItems } from "../libs/endpoints";
import { environmentUrl } from "../env/enviroment";
import { userContext } from "../App";
import { RiDeleteBin6Line } from "react-icons/ri";
import MyAccountSidebar from "../Components/Common/MyAccountSidebar";
import { FaRegUser } from "react-icons/fa6";
import ReactStars from "react-rating-stars-component";
import { envImgUrl } from "../env/envImage";
import Loader from "../Components/Spinner/Loader";
import { toast } from "sonner";

import { HiOutlineShoppingCart } from "react-icons/hi2";

const Wishlist = () => {
  const navigate = useNavigate();
  const [loading, setLoading] = useState(false);

  const { userDetails } = useContext(userContext);
  const userLoginDetails = userDetails;
  const handleSignOut = () => {
    localStorage.removeItem("token");
    navigate("/login");
  };

  const [wishlistItems, setWishlistItems] = useState([]);

  const handleWishlistItems = async () => {
    try {
      setLoading(true);
      let response = await getWishlistItems();
      if (response?.status) {
        setWishlistItems(response?.response);
      } else {
        console.log(response?.message);
      }
    } catch (error) {
      console.log(error);
    } finally {
      setLoading(false);
    }
  };

  // const removeItemFromWishlist = async (productId) => {
  //   try {
  //     setLoading(true);
  //     const apiUrl = `${environmentUrl}/wishlist/removeWishlistItem.php`;
  //     const data = {
  //       productId: productId,
  //     };
  //     const options = {
  //       method: "PUT",
  //       body: JSON.stringify(data),
  //       headers: { Authorization: "Bearer " + localStorage.getItem("token") },
  //     };
  //     const removeRes = await (await fetch(apiUrl, options)).json();
  //     if (removeRes?.status) {
  //       toast.success(removeRes?.response);
  //       await handleWishlistItems();
  //     } else {
  //       toast.error("Failed To Remove From Wishlist");
  //     }
  //   } catch (error) {
  //     console.log(error);
  //   } finally {
  //     setLoading(false);
  //   }
  // };

  const removeItemFromWishlist = async (productId) => {
    try {
      setLoading(true);
      const apiUrl = `${environmentUrl}/wishlist/removeWishlistItem.php`;
      const data = { productId };
      const options = {
        method: "PUT",
        body: JSON.stringify(data),
        headers: { Authorization: "Bearer " + localStorage.getItem("token") },
      };
      const removeRes = await (await fetch(apiUrl, options)).json();
      if (removeRes?.status) {
        toast.success(removeRes?.response);

        setWishlistItems((prev) =>
          prev.filter((item) => item.product_id !== productId)
        );
      } else {
        toast.error("Failed To Remove From Wishlist");
      }
    } catch (error) {
      console.log(error);
    } finally {
      setLoading(false);
    }
  };

  const getUserDetails = async () => {
    try {
      setLoading(true);
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
    } finally {
      setLoading(false);
    }
  };

  const [currentPage, setCurrentPage] = useState(1);
  const itemsPerPage = 12;

  const indexOfLastItem = currentPage * itemsPerPage;
  const indexOfFirstItem = indexOfLastItem - itemsPerPage;
  const currentItems = wishlistItems.slice(indexOfFirstItem, indexOfLastItem);
  const totalPages = Math.ceil(wishlistItems.length / itemsPerPage);

  const handlePageChange = (pageNumber) => {
    setCurrentPage(pageNumber);
    window.scrollTo({ top: 0, behavior: "smooth" });
  };

  const handlePrev = () => {
    if (currentPage > 1) setCurrentPage(currentPage - 1);
    window.scrollTo({ top: 0, behavior: "smooth" });
  };

  const handleNext = () => {
    if (currentPage < totalPages) setCurrentPage(currentPage + 1);
    window.scrollTo({ top: 0, behavior: "smooth" });
  };

  const handleAddToCart = async (product) => {
    try {
      const response = await addToCart(product);
      if (response?.status) {
        toast.success("Successfully Added To Cart");
        await handleWishlistItems();
      }
    } catch (error) {
      console.log(error);
      toast.error(error?.response?.data?.message);
    }
  };

  useEffect(() => {
    handleWishlistItems();
  }, []);

  return (
    // ------------------- NEW DESIGN CODE ---------------
    <>
      {loading && <Loader />}
      <div className="main-account-container mainBackground">
        <div className="slidBlock">
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
                <Link to="/wishlist" className="profileicon colorGreen">
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
        </div>
        <div className="container-fluid">
          <div className="row profilePageRow">
            <div className="row ">
              <MyAccountSidebar userDetails={getUserDetails} />

              <div className="col-lg-10 col-md-12 col-sm-12 rightMainColumn">
                <div className="mainOuter">
                  <div className="topTitles">
                    <h3>
                      Wishlist (
                      {wishlistItems.length > 9
                        ? wishlistItems.length
                        : `0${wishlistItems.length}`}
                      )
                    </h3>
                    {/* <button>
                      <img src="assets/images/Union.png" alt="" />
                      Filters
                    </button> */}
                  </div>
                  <div className="row wishlistRow">
                    {/* {wishlistItems.length > 0 ? (
                      wishlistItems.map((eachItem, index) => ( */}
                    {currentItems && currentItems.length > 0 ? (
                      currentItems.map((eachItem, index) => (
                        <div
                          className="col-md-3 col-sm-3 wishColumn"
                          key={index}
                        >
                          <div className="wishCard">
                            <button
                              className="deleteBtn"
                              type="button"
                              onClick={() =>
                                removeItemFromWishlist(eachItem.product_id)
                              }
                            >
                              <RiDeleteBin6Line />
                            </button>
                            <div className="image">
                              <img
                                src={`${envImgUrl}/Uploads/products/${eachItem?.product_img}`}
                                alt={eachItem.alt_text}
                              />
                            </div>
                            <div className="ele-types">
                              <div className="nameStars">
                                <div className="pro-text pro-ree pro-des pr-mbl ">
                                  {eachItem?.product_title}
                                </div>
                                <div className="str-coll str-mbl ratingStarsOuter">
                                  <ReactStars
                                    count={5}
                                    // size={13}
                                    activeColor="#FBBC04"
                                    value={eachItem?.average_rating}
                                    edit={false}
                                  />
                                </div>
                              </div>
                              <div className="nameStars">
                                <div className="btn-start">
                                  <button
                                    className="cart-btn cart-rp"
                                    type="button"
                                    onClick={() => handleAddToCart(eachItem)}
                                  >
                                    <HiOutlineShoppingCart />
                                  </button>
                                </div>
                                <div className="pri-doll pri-pnkl">
                                  <span className="stricked-price">
                                    ₹{eachItem?.product_price}
                                  </span>
                                  ₹{eachItem?.product_offer_price}
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      ))
                    ) : (
                      <div className="container">
                        <div className="row">
                          <div className="result-container conditionImg">
                            <img src="assets/images/noDataFound.png" alt="" />
                          </div>
                        </div>
                      </div>
                    )}
                  </div>

                  {wishlistItems.length > 0 && (
                    <div className="productPagination page-bg-btn-fil">
                      <div className="pgn-fltr prev-flt" onClick={handlePrev}>
                        Preview
                      </div>

                      <div className="numbers-main num-mn">
                        {(() => {
                          const pageButtons = [];
                          const visiblePages = 2;

                          for (let i = 1; i <= totalPages; i++) {
                            if (
                              i === 1 ||
                              i === totalPages ||
                              (i >= currentPage - visiblePages &&
                                i <= currentPage + visiblePages)
                            ) {
                              pageButtons.push(
                                <button
                                  key={i}
                                  className={`page-btns ${
                                    currentPage === i ? "grn-btn" : ""
                                  }`}
                                  onClick={() => handlePageChange(i)}
                                >
                                  {i}
                                </button>
                              );
                            } else if (
                              (i === currentPage - visiblePages - 1 &&
                                currentPage - visiblePages > 2) ||
                              (i === currentPage + visiblePages + 1 &&
                                currentPage + visiblePages < totalPages - 1)
                            ) {
                              pageButtons.push(
                                <button
                                  key={`ellipsis-${i}`}
                                  className="page-btns"
                                  disabled
                                >
                                  ...
                                </button>
                              );
                            }
                          }

                          return pageButtons;
                        })()}
                      </div>

                      <div className="pgn-fltr nxt-flt" onClick={handleNext}>
                        Next
                      </div>
                    </div>
                  )}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </>
    // ---------------- OLD CODE ----------------------
    // <>
    //   <section className="checkout pt-0 pt-0 mt--125">
    //     <div className="bredcum">
    //       <img
    //         src="assets/images/img-7.jpg"
    //         alt="lightBanner"
    //         className="banner-content image_zoom"
    //       />
    //       <h2 className="mt-0 mb-0">Wishlist</h2>
    //     </div>

    //     <div className="container">

    //       <div className="wishlist-grid-products grid--view-items wishlist-grid mt-4 mb-5">
    //         {wishlistItems === "No Data Found" ? (
    //           <div className="container">
    //             <div className="row">
    //               <div className="result-card">
    //                 <img
    //                   src="assets/images/emptyWishlist.png"
    //                   alt="no results"
    //                   className="no-cart-items"
    //                 />
    //               </div>
    //             </div>
    //           </div>
    //         ) : (
    //           <>
    //             <div className="container">
    //               <div className="row">
    //                 {wishlistItems.map((eachItem, index) => (
    //                   <div
    //                     className="col-6 col-sm-4 col-md-3 col-lg-3 "
    //                     key={index}
    //                   >
    //                     <div className="item">
    //                       <button
    //                         type="button"
    //                         className="wishlist-remove-icon"
    //                         onClick={() => {
    //                           removeItemFromWishlist(eachItem?.product_id);
    //                         }}
    //                       >
    //                         <RxCross2 className="close-icon" />
    //                       </button>
    //                       <div className="product-image">

    //                         <img
    //                           className="primary blur-up lazyloaded"
    //                           src={`${envImgUrl}/Uploads/products/${eachItem?.product_img}`}
    //                           alt={eachItem?.img_alt_text}
    //                         />
    //                       </div>

    //                       <div className="product-details text-center">
    //                         <div className="product-name text-captilized">
    //                           <Link to="">{eachItem?.product_title}</Link>
    //                         </div>

    //                         <div className="product-price">
    //                           <span className="old-price">
    //                             ₹ {eachItem?.product_mrp}/-
    //                           </span>
    //                         </div>
    //                         <button className="wishlist-add-btn">
    //                           Add to Cart
    //                         </button>
    //                       </div>
    //                     </div>
    //                   </div>
    //                 ))}
    //               </div>
    //             </div>
    //           </>
    //         )}
    //       </div>
    //     </div>
    //   </section>
    // </>
  );
};

export default Wishlist;
