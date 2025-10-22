// import { Tab, Tabs, TabList, TabPanel } from "react-tabs";
// import "react-tabs/style/react-tabs.css";

import { useEffect, useState } from "react";
import { environmentUrl } from "../../env/enviroment";

const BudgetManagement = () => {
  const [projectData, setProjectData] = useState([]);
  const getProjectAndBudgetDetails = async () => {
    const apiUrl = `${environmentUrl}/questionnaire/getProjectAndBudgetDetails.php`;
    const options = {
      method: "GET",
    };
    const response = await fetch(apiUrl, options);
    const fetchedData = await response.json();
    const projectDetails = fetchedData?.response;
    setProjectData(projectDetails);
  };

  useEffect(() => {
    getProjectAndBudgetDetails();
  }, []);
  console.log("project budget details===", projectData);

  useEffect(() => {
    window.addEventListener("scroll", isSticky);
    return () => {
      window.removeEventListener("scroll", isSticky);
    };
  });

  /* Method that will fix header after a specific scrollable */
  const isSticky = () => {
    const header = document.querySelector(".budget-management-nav");
    const scrollTop = window.scrollY;
    scrollTop >= 190
      ? header.classList.add("budget-is-sticky")
      : header.classList.remove("budget-is-sticky");
  };

  return (
    <>
      <div className="container-fluid ">
        <div className="balance col-md-12 col-sm-12 col-xs-12 budget-management-nav">
          <div className="col-md-4 budget-management-block">
            <div className="sub-heading-container mr-3">
              <p>
                <span>Customer Name</span>
              </p>
              <p>
                <span>Contact</span>
              </p>
              <p>
                <span>Property</span>
              </p>
            </div>
            <div className="values-container">
              <p>: Mr.Anvesh</p>
              <p>: 9876543210/xyz@gmail.com</p>
              <p>: Individual house/(3BHK)</p>
            </div>
          </div>
          <div className="col-md-4 budget-management-block">
            <div className="sub-heading-container mr-3">
              <p>
                <span>Project Name</span>
              </p>
              <p>
                <span>Project Type</span>
              </p>
              <p>
                <span>Location</span>
              </p>
            </div>
            <div className="values-container">
              <p>: Interior project</p>
              <p>: Platinum & Gold</p>
              <p>: Hyderabad</p>
            </div>
          </div>

          <div className="col-md-4 budget-management-block">
            <div className="sub-heading-container mr-3">
              <p>
                <span>Total Amount</span>
              </p>
              <p>
                <span>Utilized Amount</span>
              </p>
              <p>
                <span>Balance Amount</span>
              </p>
            </div>
            <div className="values-container">
              <p>: 20,00,000</p>
              <p>: 12,00,000</p>
              <p>: 8,00,000</p>
            </div>
          </div>
        </div>
      </div>
    </>
  );
};

export default BudgetManagement;
