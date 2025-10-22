import { Link, useNavigate } from "react-router-dom";
// import { FaAnglesRight } from "react-icons/fa6";
import { FaRegEye } from "react-icons/fa";
import MyAccountSidebar from "../Components/Common/MyAccountSidebar";
import { environmentUrl } from "../env/enviroment";
import { FaRegUser } from "react-icons/fa6";
import { useEffect, useState } from "react";
const CustomerProjects = () => {
  const navigate = useNavigate();
  const [freezedProjects, setFreezedProjects] = useState([]);

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

  const getFreezedProjects = async () => {
    const apiUrl = `${environmentUrl}/questionnaire/getFreezedProjects.php`;
    const options = {
      method: "GET",
      headers: { Authorization: "Bearer " + localStorage.getItem("token") },
    };
    const fetching = await (await fetch(apiUrl, options)).json();
    const response = fetching.response;
    setFreezedProjects(response);
  };

  useEffect(() => {
    getFreezedProjects();
  }, []);
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
                <div className="row justify-content-center">
                  <div>
                    <div className="font-monsrt pb-3 qc-hdng d-flex justify-content-center padding">
                      Customer <span className="check-txt px-2"> Projects</span>
                    </div>
                  </div>
                </div>
                <div className="table-responsive myQuotTbl">
                  <table className="table ">
                    <thead className="thead-darkk">
                      <tr className="bg-brown">
                        <th scope="col" className="text-center">
                          S.No
                        </th>
                        <th scope="col " className="width-15">
                          Project Name
                        </th>
                        <th scope="col ">Budget</th>
                        <th scope="col ">Material / Maker Classification</th>
                        <th scope="col ">Assigned User</th>
                        <th scope="col ">Assigned Vendor</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Start Date</th>
                        <th scope="col"> End Date</th>
                        <th scope="col" className="text-center">
                          Status
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      {freezedProjects.length > 0 ? (
                        freezedProjects.map((item, index) => (
                          <tr
                            className="dynamicRowBg"
                            key={index}
                            id={item?.que_id}
                          >
                            <td scope="row" className="text-center">
                              <b>{index + 1}</b>
                            </td>
                            <td>{`VOYD0${item?.customer_id}-${item?.property}(${item?.property_type})-${item?.que_id}`}</td>
                            <td>{item?.budget.toLocaleString("en-IN")}</td>
                            <td>{`${item?.product_classification} / ${item?.manufacturer_classification}`}</td>
                            <td>{`${item?.assigned_project_user}`}</td>
                            <td>{`${item?.assigned_vendor}`}</td>

                            <td>{item?.mobile}</td>
                            <td>{item?.startdate}</td>
                            <td>{item?.deadline}</td>
                            <td className="text-center freezBtns">
                              <Link to={`/projectStatus?uid=${item?.que_id}`}>
                                <button className="final-but" type="button">
                                  Track
                                </button>
                              </Link>
                              <Link to={`/finalQuote?queId=${item?.que_id}`}>
                                <button className="final-but" type="button">
                                  <FaRegEye />
                                </button>
                              </Link>
                            </td>
                          </tr>
                        ))
                      ) : (
                        <tr>
                          <td colSpan={10}>
                            <div className="result-container conditionImg">
                              <img src="assets/images/noDataFound.png" alt="" />
                            </div>
                          </td>
                        </tr>
                      )}
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};
export default CustomerProjects;
