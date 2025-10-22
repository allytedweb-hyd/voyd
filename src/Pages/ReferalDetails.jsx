import { Link, useNavigate } from "react-router-dom";
// import { FaAnglesRight } from "react-icons/fa6";
import { FaRegEye } from "react-icons/fa";
import MyAccountSidebar from "../Components/Common/MyAccountSidebar";
import { environmentUrl } from "../env/enviroment";
import { FaRegUser } from "react-icons/fa6";
import { useEffect, useState } from "react";

import OngoingPopup from "../Components/Popups/OngoingPopup";

import ReferAFriend from "../Components/Popups/ReferAFriend";

const ReferalDetails = () => {
  const navigate = useNavigate();

  const [onLoadPopup, setOnLoadPopup] = useState(false);
  const [referAFriend, setReferAFriend] = useState(false);

  const [referralData, setReferralData] = useState([]);
  const [currentPage, setCurrentPage] = useState(1);
  const itemsPerPage = 10;

  const onCloseLoadPopup = () => {
    setOnLoadPopup(false);
  };

  const onCloseReferAFriend = () => {
    setReferAFriend(false);
  };

  const totalReward = referralData.reduce(
    (total, item) => total + (parseFloat(item.reward_amount) || 0),
    0
  );

  const handleSignOut = () => {
    localStorage.removeItem("token");
    navigate("/login");
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

  const getUserReferralDetails = async () => {
    const token = localStorage.getItem("token");
    try {
      const response = await fetch(
        `${environmentUrl}/myAccount/getrefferal.php`,
        {
          method: "GET",
          headers: {
            Authorization: `Bearer ${token}`,
            "Content-Type": "application/json",
          },
        }
      );

      if (!response.ok) {
        console.error("HTTP error", response.status);
        setReferralData([]);
        return;
      }

      const data = await response.json();

      if (data.status && data.data) {
        setReferralData(data.data);
      } else {
        setReferralData([]);
      }
    } catch (error) {
      console.error("Referral fetch error:", error);
      setReferralData([]);
    }
  };

  const handleReferAFriendClick = () => {
    const token = localStorage.getItem("token");
    if (token) {
      setReferAFriend(true);
    } else {
      setOnLoadPopup(true);
    }
  };

  useEffect(() => {
    getUserReferralDetails();
  }, []);

  const totalPages = Math.ceil(referralData.length / itemsPerPage);
  const indexOfLastRow = currentPage * itemsPerPage;
  const indexOfFirstRow = indexOfLastRow - itemsPerPage;
  const currentRows = referralData.slice(indexOfFirstRow, indexOfLastRow);

  const handlePageChange = (pageNum) => setCurrentPage(pageNum);
  const handleNext = () =>
    setCurrentPage((prev) => Math.min(prev + 1, totalPages));
  const handlePrev = () => setCurrentPage((prev) => Math.max(prev - 1, 1));

  return (
    <div>
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
                <div className="reward-card-container">
                  <div className="reward-card shadow">
                    <div className="reward-card-header">
                      Your Reward Summary
                    </div>
                    <div className="reward-card-body">
                      <h2 className="reward-amount">{totalReward} </h2>
                      <p className="reward-desc">
                        Collect more rewards by referring friends!
                      </p>
                      <button
                        className="redeem-btn"
                        onClick={handleReferAFriendClick}
                      >
                        Refer A Friend
                      </button>
                    </div>
                  </div>
                </div>

                <div className="table-responsive myQuotTbl">
                  {/* <table className="table mt-4">
                    <thead className="thead-darkk">
                      <tr className="bg-brown">
                        <th scope="col" className="text-center">
                          S.No
                        </th>
                        <th scope="col ">Customer Name</th>
                        <th scope="col " className="width-15">
                          Project Name
                        </th>
                        <th scope="col ">Project Type</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Date</th>
                        <th scope="col" className="text-center">
                          Status
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr className="dynamicRowBg">
                        <td scope="row" className="text-center">
                          1
                        </td>
                        <td className="firstLetter">Neelima </td>
                        <td>Project One</td>
                        <td>Type One</td>
                        <td>0987654387</td>
                        <td>23/3/24</td>
                        <td className="text-center freezBtns">
                          <button className="final-but" type="button">
                            Freeze
                          </button>
                          <button className="final-but" type="button">
                            <FaRegEye />
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table> */}

                  <table className="table mt-5">
                    <thead className="thead-darkk">
                      <tr className="bg-brown">
                        <th className="text-center">S.No</th>
                        <th>Customer Name</th>
                        <th>Project Name</th>
                        <th>Project Type</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        {/* <th className="text-center">Status</th> */}
                      </tr>
                    </thead>
                    <tbody>
                      {referralData.length > 0 ? (
                        currentRows.map((item, index) => (
                          <tr key={index} className="dynamicRowBg">
                            <td className="text-center">
                              {indexOfFirstRow + index + 1}
                            </td>
                            <td className="firstLetter">
                              {item.first_name} {item.last_name}
                            </td>
                            <td>{`VOYD0${item.customer_id}-${item.property || "N/A"
                              }(${item.property_type || "N/A"})-${item.que_id || "N/A"
                              }`}</td>

                            <td>{item.project_type || "N/A"}</td>
                            <td>{item.customer_mobile}</td>
                            <td>{item.customer_email}</td>
                            {/* <td className="text-center freezBtns">
                              {item.status ? (
                                <button className="final-but" type="button">
                                  {item.status}
                                </button>
                              ) : (
                                <span style={{ color: "#aaa" }}>N/A</span>
                              )}
                            </td> */}
                          </tr>
                        ))
                      ) : (
                        <tr>
                          <td
                            colSpan={7}
                            className="text-center py-4"
                            style={{ fontStyle: "italic", color: "#777" }}
                          >
                            No referral
                          </td>
                        </tr>
                      )}
                    </tbody>
                  </table>

                  {totalPages >= 1 && (
                    <div className="productPagination page-bg-btn-fil text-center mt-3">
                      <div className="pgn-fltr prev-flt" onClick={handlePrev}>
                        Previous
                      </div>

                      <div className="numbers-main num-mn">
                        {Array.from({ length: totalPages }, (_, i) => {
                          const page = i + 1;
                          return (
                            <button
                              key={page}
                              className={`page-btns ${page === currentPage ? "grn-btn" : ""
                                }`}
                              onClick={() => handlePageChange(page)}
                            >
                              {page}
                            </button>
                          );
                        })}
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

      {onLoadPopup && (
        <OngoingPopup
          openOnLoadPopup={onLoadPopup}
          onCloseLoadPopup={onCloseLoadPopup}
        />
      )}

      {referAFriend && (
        <ReferAFriend
          openReferAFriend={referAFriend}
          onCloseReferAFriend={onCloseReferAFriend}
        />
      )}
    </div>
  );
};

export default ReferalDetails;
