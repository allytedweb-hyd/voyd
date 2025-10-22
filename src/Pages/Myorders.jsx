/* eslint-disable react-hooks/exhaustive-deps */
/* eslint-disable no-unused-vars */
import React, { useEffect, useState } from "react";
import { Link, useLocation, useNavigate } from "react-router-dom";
import { FaHeart } from "react-icons/fa";
import { FaCartArrowDown } from "react-icons/fa";
import { CiGift } from "react-icons/ci";
import { ImProfile } from "react-icons/im";
import { LiaSignOutAltSolid } from "react-icons/lia";
import { IoMdPerson } from "react-icons/io";
import { environmentUrl } from "../env/enviroment";
import { Tab, Tabs, TabList, TabPanel } from "react-tabs";
import { FaAnglesRight } from "react-icons/fa6";
import "react-tabs/style/react-tabs.css";
import MyAccountSidebar from "../Components/Common/MyAccountSidebar";
import Loader from "../Components/Spinner/Loader";
import { FaRegUser } from "react-icons/fa6";

const Myorders = () => {
  const navigate = useNavigate();
  const [myOrders, setMyOrders] = useState([]);
  const [loading, setLoading] = useState(false);
  const getMyOrders = async () => {
    const apiUrl = `${environmentUrl}/myOrders/get.php`;
    const options = {
      method: "GET",
      headers: { Authorization: "Bearer " + localStorage.getItem("token") },
    };
    const fetchedMyOrders = await (await fetch(apiUrl, options)).json();
    const myOrdersRes = fetchedMyOrders.response;
    // console.log("my orders in get orders function are===", myOrdersRes);
    setMyOrders(myOrdersRes);
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

  useEffect(() => {
    getMyOrders();
  }, []);
  console.log("my order are===", myOrders);
  const handleSignOut = () => {
    let authToken = localStorage.getItem("token");
    localStorage.clear(authToken);
    navigate("/login");
  };

  return (
    // ------------- NEW DESIGN CODE ------------
    <>
      {/* {loading && <Loader />} */}
      <div className="main-account-container mainBackground">
        <div className="container-fluid">
          <div className="row profilePageRow">
            <div className="row ">
              <MyAccountSidebar userDetails={getUserDetails} />

              <div className="col-lg-10 col-md-12 col-sm-12 rightMainColumn">
                <div className="mainOuter">
                  <div className="topTitles">
                    <h3>My Orders</h3>
                    {/* <button>
                      <img src="assets/images/Union.png" alt="" />
                      Filters
                    </button> */}
                  </div>
                  <div className="ordersOuterBlock">
                    <Tabs>
                      <TabList>
                        <Tab> In Process Orders (00)</Tab>
                        <Tab>Delivered Orders(00)</Tab>
                        <Tab>Cancelled Orders(00)</Tab>
                        <Tab>Return & Refund Orders(00)</Tab>
                      </TabList>

                      <TabPanel>
                        <div className="processOrders">
                          {/* <div className="ordersRow">
                            <div className="col-md-2 col-sm-2 productDetails">
                              <div className="orderImg">
                                <img
                                  src="assets/images/chair-1 (3).png"
                                  alt=""
                                />
                              </div>
                            </div>
                            <div className="col-md-4 col-sm-4 productDetails mobileEnd">
                              <p>Vonna Neva Walnut Sandalye Chair</p>
                              <h4>
                                $149.99 <span>21% OFF</span>
                              </h4>
                            </div>
                            <div className="col-md-2 col-sm-2 productDetails">
                              <p>Color</p>
                              <p className="colorCircle">
                                <div></div>Brown
                              </p>
                            </div>
                            <div className="col-md-4 col-sm-4 productDetails textEnd">
                              <h6>
                                <div></div>Deliver By Feb 28
                              </h6>
                              <p>Your Item Has Been Dispatched</p>
                            </div>
                          </div> */}
                          <div className="result-container conditionImg">
                            <img src="assets/images/noDataFound.png" alt="" />
                          </div>
                        </div>
                      </TabPanel>

                      <TabPanel>
                        <div className="processOrders">
                          {/* <div className="ordersRow">
                            <div className="col-md-2 col-sm-2 productDetails">
                              <div className="orderImg">
                                <img
                                  src="assets/images/chair-1 (3).png"
                                  alt=""
                                />
                              </div>
                            </div>
                            <div className="col-md-4 col-sm-4 productDetails mobileEnd">
                              <p>Vonna Neva Walnut Sandalye Chair</p>
                              <h4>
                                $149.99 <span>21% OFF</span>
                              </h4>
                            </div>
                            <div className="col-md-2 col-sm-2 productDetails">
                              <p>Color</p>
                              <p className="colorCircle">
                                <div></div>Brown
                              </p>
                            </div>
                            <div className="col-md-4 col-sm-4 productDetails textEnd">
                              <h6>
                                <div></div>Deliver By Feb 28
                              </h6>
                              <p>Your Item Has Been Dispatched</p>
                            </div>
                          </div> */}
                          <div className="result-container conditionImg">
                            <img src="assets/images/noDataFound.png" alt="" />
                          </div>
                        </div>
                      </TabPanel>

                      <TabPanel>
                        <div className="processOrders">
                          {/* <div className="ordersRow">
                            <div className="col-md-2 col-sm-2 productDetails">
                              <div className="orderImg">
                                <img
                                  src="assets/images/chair-1 (3).png"
                                  alt=""
                                />
                              </div>
                            </div>
                            <div className="col-md-4 col-sm-4 productDetails mobileEnd">
                              <p>Vonna Neva Walnut Sandalye Chair</p>
                              <h4>
                                $149.99 <span>21% OFF</span>
                              </h4>
                            </div>
                            <div className="col-md-2 col-sm-2 productDetails">
                              <p>Color</p>
                              <p className="colorCircle">
                                <div></div>Brown
                              </p>
                            </div>
                            <div className="col-md-4 col-sm-4 productDetails textEnd">
                              <h6>
                                <div></div>Deliver By Feb 28
                              </h6>
                              <p>Your Item Has Been Dispatched</p>
                            </div>
                          </div> */}
                          <div className="result-container conditionImg">
                            <img src="assets/images/noDataFound.png" alt="" />
                          </div>
                        </div>
                      </TabPanel>

                      <TabPanel>
                        <div className="processOrders">
                          {/* <div className="ordersRow">
                            <div className="col-md-2 col-sm-2 productDetails">
                              <div className="orderImg">
                                <img
                                  src="assets/images/chair-1 (3).png"
                                  alt=""
                                />
                              </div>
                            </div>
                            <div className="col-md-4 col-sm-4 productDetails mobileEnd">
                              <p>Vonna Neva Walnut Sandalye Chair</p>
                              <h4>
                                $149.99 <span>21% OFF</span>
                              </h4>
                            </div>
                            <div className="col-md-2 col-sm-2 productDetails">
                              <p>Color</p>
                              <p className="colorCircle">
                                <div></div>Brown
                              </p>
                            </div>
                            <div className="col-md-4 col-sm-4 productDetails textEnd">
                              <h6>
                                <div></div>Deliver By Feb 28
                              </h6>
                              <p>Your Item Has Been Dispatched</p>
                            </div>
                          </div> */}
                          <div className="result-container conditionImg">
                            <img src="assets/images/noDataFound.png" alt="" />
                          </div>
                        </div>
                      </TabPanel>
                    </Tabs>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </>
  );
};

export default Myorders;

// ----------------- OLD CODE -------------------
// <>
//   <div className="orders-bg">
//     <div className="container">
//       <div className="row">
//         <div className="col-md-12 mt-5 d-flex">
//           <div className="col-lg-3">
//             <div className="card account">
//               <div className="card-body">
//                 <h6 className="align-items-center">My Account</h6>
//                 <h6>Orders and Credits</h6>
//                 <ul>
//                   <li>
//                     <FaHeart />
//                     <Link to="/shop" className="profileicon">
//                       Your Wishlist
//                     </Link>
//                   </li>
//                   <hr />
//                   <li>
//                     <CiGift />
//                     <Link to="/Myorders" className="profileicon">
//                       Your Orders
//                     </Link>
//                   </li>
//                   <hr />
//                   <li>
//                     <FaCartArrowDown />
//                     <Link to="/cart" className="profileicon">
//                       Your Cart
//                     </Link>
//                   </li>
//                 </ul>
//                 <h6>Profile</h6>
//                 <ul>
//                   <li>
//                     <IoMdPerson />
//                     <Link to="/YourAccount" className="profileicon">
//                       Personal Information
//                     </Link>
//                   </li>
//                   <hr />
//                   <li onClick={handleSignOut}>
//                     <LiaSignOutAltSolid />
//                     <Link to="" className="profileicon">
//                       Sign Out
//                     </Link>
//                   </li>
//                 </ul>
//               </div>
//             </div>
//           </div>

//           <div className="col-lg-9">
//             <div className="card orders">
//               <div className="card-body orders">
//                 <div className="d-flex flex-column align-items-center text-center">
//                   <h2>My Orders</h2>
//                   <div className="col-lg-12">
//                     <div className="card order mt-3">
//                       <div className="card-body orders">
//                         <div className="orderimage d-flex">
//                           <img
//                             className="orderimage"
//                             src="/assets/images/item-1.jpg"
//                           />
//                           <div className="orderdetails">
//                             <h5>Chair</h5>
//                             <p>
//                               Back Modern, Elegant & Comfortable Blue Arm
//                               Shell Chairs
//                             </p>
//                             <p>
//                               <h5>2800/-</h5>
//                             </p>
//                           </div>
//                         </div>
//                       </div>
//                     </div>

//                     <div className="card order mt-3">
//                       <div className="card-body orders">
//                         <div className="orderimage d-flex">
//                           <img
//                             className="orderimage"
//                             src="/assets/images/item-3.jpg"
//                           />
//                           <div className="orderdetails">
//                             <h5>Sofa</h5>
//                             <p>
//                               Solimo Venosa Fabric 2 Seater RHS L Shape Sofa
//                             </p>
//                             <p>
//                               <h5>32000/-</h5>
//                             </p>
//                           </div>
//                         </div>
//                       </div>
//                     </div>
//                   </div>
//                 </div>
//               </div>
//             </div>
//           </div>
//         </div>
//       </div>
//     </div>
//   </div>
// </>
