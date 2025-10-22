import html2canvas from "html2canvas";
import jsPDF from "jspdf";
import { useState, useEffect } from "react";
import { environmentUrl } from "../../env/enviroment";
import { Link } from "react-router-dom";
import { MdRemoveRedEye } from "react-icons/md";
import { BiStar } from "react-icons/bi";
import { BiSolidStar } from "react-icons/bi";

const Quotation = ({ addonsData }) => {
  const [quotationData, setQuotationData] = useState({});

  useEffect(() => {
    setQuotationData(addonsData);
    console.log("quotation data is====", addonsData);
  }, [addonsData]);

  const [projectData, setProjectData] = useState([]);
  const getProjectAndBudgetDetails = async () => {
    const apiUrl = `${environmentUrl}/questionnaire/getProjectAndBudgetDetails.php`;
    const options = {
      method: "GET",
      headers: { Authorization: "Bearer " + localStorage.getItem("token") },
    };
    const response = await fetch(apiUrl, options);
    const fetchedData = await response.json();
    const projectDetails = fetchedData?.response;
    setProjectData(projectDetails);
  };

  useEffect(() => {
    getProjectAndBudgetDetails();
  }, []);
  // console.log("project details in quotaion ======", projectData);

  // download quotation PDF
  const clickToDownloadQuotation = () => {
    const printableEle = document.getElementById("quotationForm");
    html2canvas(printableEle).then((canvas) => {
      const imgData = canvas.toDataURL("image/png");
      const pdf = new jsPDF();
      pdf.addImage(imgData, "JPEG", 1, 1);
      pdf.save(`quotation.pdf`);
    });
  };

  const SlidingQuotaion = () => {
    console.log("Clicked");
    let mainConEle = document.getElementById("main-container");
    let buttonEle = document.getElementById("button-container");

    mainConEle.classList.toggle("active");
    buttonEle.classList.toggle("active");
  };

  const [viewQuote, setViewQuote] = useState(false);
  const handleViewQuotation = () => {
    setViewQuote(true);
  };
  const handleCloseQuote = () => {
    setViewQuote(false);
  };
  const [freezedProject, setFreezedProject] = useState(false);
  const freezeProject = async () => {
    setFreezedProject(true);

    const apiUrl = `${environmentUrl}/questionnaire/freezeMail.php`;
    const options = {
      method: "POST",
    };
    const mailFetch = await fetch(apiUrl, options);
    const mailRes = await mailFetch.json();
    console.log("freezed mail response is", mailRes);
  };

  return (
    <>
      <div className="sidebar-contact" id="main-container">
        <div className="toggle quote" id="">
          <button onClick={SlidingQuotaion}>Quote</button>
        </div>
        {/* <div className="conatiner mt-5 quotation">
          <div className="row">
            <div className="col-lg-4 col-md-4 col-sm-5 col-xs-5">
              <div className="quotation button">
                <button className="btn btn-primary quotation">
                  View All Quotations
                </button>
              </div>
            </div>
          </div>
        </div>

        <hr /> */}
        <div className="col-md-12 ">
          <div className="slider-quote" id="quotationForm">
            <div className="form-container1">
              {!viewQuote && (
                <div className="container">
                  <div className="row">
                    <div className="group view-quotation">
                      <h2 className="text-center">YOUR QUOTATIONS</h2>
                      <p>
                        <MdRemoveRedEye /> - Click to view the complete
                        quotation in Detail
                      </p>
                      <p className="mb-3">
                        <BiStar /> - Click to freeze the project
                      </p>
                      <table>
                        <thead>
                          <tr>
                            <th>S.No</th>
                            <th>Project Name</th>
                            <th>Mobile Number</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>

                          <tr>
                            <td>1</td>
                            <td>Mr.INTRO20-Neelima</td>
                            <td>1234567890</td>
                            <td>Kakinada</td>
                            <td>Pending</td>
                            <td>
                              <div className="d-flex">
                                <button
                                  className="view-quote-btn"
                                  onClick={handleViewQuotation}
                                >
                                  <MdRemoveRedEye />
                                </button>
                                {freezedProject ? (
                                  <button className="view-quote-btn freezed-star">
                                    <BiSolidStar />
                                  </button>
                                ) : (
                                  <button
                                    className="view-quote-btn"
                                    onClick={freezeProject}
                                  >
                                    <BiStar />
                                  </button>
                                )}
                              </div>
                            </td>
                          </tr>

                          <tr>
                            <td>2</td>
                            <td>Mr.INTRO25-Satya</td>
                            <td>1234567890</td>
                            <td>Kukatpally, Hyderabad</td>
                            <td>Pending</td>
                            <td>
                              <div className="d-flex">
                                <button
                                  className="view-quote-btn"
                                  onClick={handleViewQuotation}
                                >
                                  <MdRemoveRedEye />
                                </button>
                                <button
                                  className="view-quote-btn"
                                  onClick={freezeProject}
                                >
                                  <BiStar />
                                </button>
                              </div>
                            </td>
                          </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>
              )}
              {viewQuote && (
                <div>
                  <button className="view-all-btn" onClick={handleCloseQuote}>
                    back
                  </button>

                  <div className="allquotation">
                    <h3>QUOTATION</h3>
                  </div>
                  <div className="quote-address-container">
                    <div className="quote-to-address-block">
                      <img
                        src="assets/images/FYI-logo.png"
                        alt="VOYD Interiors"
                        className="quote-logo"
                      />
                      <div className="mt-3">
                        <p>To,</p>
                        <p>{`${projectData?.first_name} ${projectData?.last_name}`}</p>
                        <p>{`${projectData?.city}, ${projectData?.locality}, ${projectData?.state}`}</p>
                        <p>
                          <span>Contact:</span> {projectData?.mobile}/
                          {projectData?.email}
                        </p>
                        <p>
                          <span>Sub:</span>{" "}
                          {`Quote for ${projectData?.property}/${projectData?.property_type} Interiors`}
                        </p>
                      </div>
                    </div>
                    <div className="quote-office-add-block">
                      <h6>VOYD Interiors</h6>
                      <p>Kacheguda Railway Station</p>
                      <p>9FQX+RQ3, RTC Colony, Kachiguda,</p>
                      <p>Hyderabad, Telangana 500027</p>
                      <p>
                        <span>GSTIN: H0965B43Y8K56 </span>
                      </p>
                    </div>
                  </div>
                  <hr className="mt-1" />
                  {/* {Object.keys(quotationData).map((each) => (
                <div className="group" key={each}>
                  {quotationData[each].length > 0 &&
                    quotationData[each].map((each, index) => (
                      <div key={index}>
                        <h3>{each}</h3>
                        <table>
                          <thead>
                            <tr>
                              <th>S NO</th>
                              <th>Items</th>
                              <th>sft</th>
                              <th>rate/sft</th>
                              <th>Amount</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>{each?.element_id}</td>
                              <td>{each?.element_name}</td>
                              <td>100</td>
                              <td>{`${each?.cost_per_sqft}/-`}</td>
                              <td>90,000/-</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    ))}
                  {quotationData[each].length == 0 && (
                    <div>
                      <h3>{each}</h3>

                      <table>
                        <thead>
                          <tr>
                            <th>S NO</th>
                            <th>Items</th>
                            <th>sft</th>
                            <th>rate/sft</th>
                            <th>Amount</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  )}
                </div>
              ))} */}

                  <div className="group">
                    <h3>Master Bedroom</h3>

                    <table>
                      <thead>
                        <tr>
                          <th>S NO</th>
                          <th>Items</th>
                          <th>sft</th>
                          <th>rate/sft</th>
                          <th>Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Sliding Wardrobes</td>
                          <td>70</td>
                          <td>2000/-</td>
                          <td>1,40,000/-</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Dressing Table</td>
                          <td>40</td>
                          <td>1,900/-</td>
                          <td>76000/-</td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>King size bed without mattress</td>
                          <td>36</td>
                          <td>3500/-</td>
                          <td>1,26,000/-</td>
                        </tr>
                        <tr>
                          <td>4</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  {/* <div className="group">
                <h3>Kids Bedroom</h3>

                <table>
                  <thead>
                    <tr>
                      <th>S NO</th>
                      <th>Items</th>
                      <th>sft</th>
                      <th>rate/sft</th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Sliding Wardrobes</td>
                      <td>60</td>
                      <td>2,000/-</td>
                      <td>1,20,000</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Dressing Table</td>
                      <td>40</td>
                      <td>1,800/-</td>
                      <td>72,000/-</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Queen size bed without mattress</td>
                      <td>36</td>
                      <td>3,100/-</td>
                      <td>1,11,600/-</td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>-</td>
                      <td>-</td>
                      <td>-</td>
                      <td>-</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div className="group">
                <h3>Pooja room</h3>

                <table>
                  <thead>
                    <tr>
                      <th>S NO</th>
                      <th>Items</th>
                      <th>sft</th>
                      <th>rate/sft</th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Pooja Mandhir</td>
                      <td>30</td>
                      <td>2,700/-</td>
                      <td>81,000</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>-</td>
                      <td>-</td>
                      <td>-</td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>-</td>
                      <td>-</td>
                      <td>-</td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>-</td>
                      <td>-</td>
                      <td>-</td>
                      <td>-</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div className="group">
                <h3>Modular Kitchen</h3>

                <table>
                  <thead>
                    <tr>
                      <th>S NO</th>
                      <th>Items</th>
                      <th>sft</th>
                      <th>rate/sft</th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Base unit</td>
                      <td>30</td>
                      <td>1,200/-</td>
                      <td>36,000/-</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Wall Unit</td>
                      <td>50</td>
                      <td>1,500/-</td>
                      <td>75,000</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Tandem Baskets + Accessories</td>
                      <td>-</td>
                      <td>-</td>
                      <td>1,37,000/-</td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>Loft</td>
                      <td>20</td>
                      <td>1,200/-</td>
                      <td>24,000/-</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div className="group">
                <h3>Bath/Wash-area</h3>

                <table>
                  <thead>
                    <tr>
                      <th>S NO</th>
                      <th>Items</th>
                      <th>sft</th>
                      <th>rate/sft</th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>sdjk</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>hdsgjka</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>bdhfhj</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>jkshdkj</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div className="group">
                <h3>Others</h3>

                <table>
                  <thead>
                    <tr>
                      <th>S NO</th>
                      <th>Items</th>
                      <th>sft</th>
                      <th>rate/sft</th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>sdjk</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>hdsgjka</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>bdhfhj</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div> */}
                  <div className="final-price-container">
                    <p>Grand Total :</p>
                    <p className="price">13,80,000/-</p>
                  </div>

                  <div className="note-container">
                    <p>
                      <span>Note:</span>This is only for Estimation
                    </p>
                    <p>
                      <span>Terms & Conditions:</span> This Quotation will be
                      disable from the website after 30days
                    </p>
                    <p>
                      <span>Email:</span>xyz@gmail.com <span>Contact:</span>
                      9876543210
                    </p>
                  </div>
                  <button
                    className="quote-download-btn"
                    onClick={clickToDownloadQuotation}
                  >
                    Download
                  </button>
                </div>
              )}
            </div>
          </div>
        </div>
      </div>
    </>
  );
};

export default Quotation;
