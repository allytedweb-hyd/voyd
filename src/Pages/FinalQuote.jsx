/* eslint-disable no-undef */
/* eslint-disable react-hooks/exhaustive-deps */
/* eslint-disable no-unused-vars */
// import React from 'react'
import React, { useEffect, useState } from "react";
import { environmentUrl } from "../env/enviroment";
import html2canvas from "html2canvas";
import jsPDF from "jspdf";
import { IoMdArrowRoundBack } from "react-icons/io";
import axios from "axios";
import { formatCurrency } from "../libs/endpoints";
import { useNavigate } from "react-router-dom";
import Loader from "../Components/Spinner/Loader";

const FinalQuote = () => {
  const navigate = useNavigate();
  const [finalQuotationData, setFinalQuotationData] = useState([]);
  const [interiorElements, setInteriorElements] = useState({});
  const [elementData, setElementData] = useState({});
  const params = new URLSearchParams(window.location.search);
  const paramVal = params.get("queId");
  const [loading, setLoading] = useState(false);

  const getProjectAndBudgetDetails = async () => {
    setLoading(true);
    const apiUrl = `${environmentUrl}/questionnaire/getFinalQuotation.php?queId=${paramVal}`;
    const options = {
      method: "GET",
      headers: { Authorization: "Bearer " + localStorage.getItem("token") },
    };
    const response = await fetch(apiUrl, options);
    // let response = await axios.get(apiUrl, options);
    const jsonResponse = await response.json();
    console.log("json response ====", jsonResponse);
    if (jsonResponse?.status) {
      setFinalQuotationData(jsonResponse?.response);
      setInteriorElements(jsonResponse?.response?.quote_data);
      setLoading(false);
    }
    return;
    // const data = response?.data?.response;
    // const parserd = JSON.stringify(response?.data?.quoteData);
    // const quototationData = JSON.parse(JSON.parse(parserd));
    // console.log("parsed data==", quototationData);
    // console.log("quotation data==", data);
    // const projectDetails = response?.data?.response;
    // setProjectData(projectDetails);
    // setElementData(quototationData);
  };

  useEffect(() => {
    getProjectAndBudgetDetails();
  }, []);

  // download quotation PDF
  const clickToDownloadQuotation = () => {
    console.log("function triggered");
    const printableEle = document.getElementById("finalEstimate");
    html2canvas(printableEle).then((canvas) => {
      const imgData = canvas.toDataURL(".pdf");
      const pdf = new jsPDF();
      pdf.addImage(imgData, "pdf", 20, 20, 190, 160);
      pdf.save(`${projectData?.first_name} ${projectData?.last_name}.pdf`);
    });
  };

  const handleBack = () => {
    navigate("/myQuotes");
  };

  return (
    <>
      {loading && <Loader />}
      {/* <div className="container">
        <button className="view-all-btn quote-final" onClick={handleBack}>
          <IoMdArrowRoundBack />
        </button>
        <div className="row quotefinal">
          <div className="finalquote col-lg-10 col-md-10 col-sm-12">
            <div id="finalEstimate">
              <div className="allquotation">
                <h3>PROJECT ESTIMATATION</h3>
              </div>
              <div className="quote-address-container">
                <div className="quote-to-address-block">
                  <img
                    src="assets/images/FYI-logo.png"
                    alt="Mr.Interior"
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
                  <h6>Mr.Interior</h6>
                  <p>Kacheguda Railway Station</p>
                  <p>9FQX+RQ3, RTC Colony, Kachiguda,</p>
                  <p>Hyderabad, Telangana 500027</p>
                  <p>
                    <span>GSTIN: H0965B43Y8K56 </span>
                  </p>
                </div>
              </div>
              <hr className="mt-1" />
              <p>{}</p>
              {Object.keys(elementData).map(
                (block, blockIndex) =>
                  elementData[block].tabs.length > 0 &&
                  elementData[block].tabs.map((element, index) => (
                    <>
                      <div className="group" key={blockIndex}>
                        <h3>{block}</h3>
                        <div key={index}>
                          <p className="table-sub-property-blocks">
                            {block + "-" + (index + 1)}
                          </p>
                          <div>
                            {element.map((eachele, eleIndex) => (
                              <table key={eleIndex}>
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
                                    <td>{eleIndex + 1}</td>
                                    <td>{eachele?.alttext_3}</td>
                                    <td>{eachele?.eleSft}</td>
                                    <td>
                                      {formatCurrency(eachele?.cost_per_sqft)}/-
                                    </td>
                                    <td>
                                      {formatCurrency(
                                        eachele?.eleSft * eachele?.cost_per_sqft
                                      )}
                                      /-
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            ))}
                          </div>
                        </div>
                      </div>
                    </>
                  ))
              )}

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
            </div>
          </div>
        </div>
        <div className="quotebtn text-center">
          <button
            className="quote-download-btn"
            onClick={clickToDownloadQuotation}
          >
            Download
          </button>
        </div>
      </div> */}
      {/* new version */}
      <section className="billHeaderSection">
        <div className="container">
          <div className="flexBlock">
            <div className="logoTitle">
              <div className="image">
                {/* <img src="assets/images/favicon.png" alt="" /> */}
                <img src="assets/images/logo/voydGreen.png" alt="" />
              </div>
              {/* <div className="titles">
                <h2>VOYD Interior</h2>
                <h2>Designing Solutions</h2>
              </div> */}
            </div>
            <div className="sideTitleBlock">
              <h3>Project Estimation Bill</h3>
              <p>Effortlessly handle your estimation bill right here.</p>
            </div>
          </div>
          <div className="row cardDetailsRow">
            <div className="col-md-5 columns">
              <div className="cardOneOuter">
                <div className="cardOne">
                  <h6>Estimated By:</h6>
                  <h5>VOYD Interior Execution Partner</h5>
                  <p>
                    Plot No 28/A, Survey No 40, Khajaguda, Serilingampalle (M),
                    Telangana 500032, Telangana 500008
                  </p>
                  <div className="contacts">
                    <span className="email">Email</span>
                    <span>contact@voydinteriors.com</span>
                  </div>
                  <div className="contacts">
                    <span>Phone</span>
                    <span>+91 9115833833</span>
                  </div>
                </div>
              </div>
            </div>
            <div className="col-md-5 columns">
              <div className="cardOneOuter">
                <div className="cardOne">
                  <h6>Estimation to:</h6>
                  <h5>
                    <span>
                      <img src="assets/images/teamImgBg.png" alt="" />
                    </span>
                    {finalQuotationData?.first_name}{" "}
                    {finalQuotationData?.last_name}
                  </h5>
                  <p>{`${finalQuotationData?.street}, ${finalQuotationData?.locality},${finalQuotationData?.near_by}, ${finalQuotationData?.property_location}, ${finalQuotationData?.city}, ${finalQuotationData?.state}`}</p>
                  <div className="contacts">
                    <span className="email">Email</span>
                    <span>{finalQuotationData?.email}</span>
                  </div>
                  <div className="contacts">
                    <span>Phone</span>
                    <span>+91 {finalQuotationData?.mobile}</span>
                  </div>
                </div>
              </div>
            </div>
            <div className="col-md-2">
              <div className="amountCard">
                <h6>Estimation Amount</h6>
                <div>
                  <h3>{formatCurrency(finalQuotationData?.budget)}</h3>
                  <h4>INR</h4>
                </div>
                <p>
                  {new Date(finalQuotationData?.created_At).toLocaleDateString(
                    "en-US",
                    {
                      year: "numeric",
                      month: "short",
                      day: "2-digit",
                    }
                  )}
                </p>
              </div>
            </div>
          </div>
          <div className="row">
            <div className="col-md-12">
              <div className="billTableCard">
                {/* ----------------first model table ----------------- */}
                <div className="billTable">
                  {/* <table>
                    <tr>
                      <th className="center">Area</th>
                      <th>Room</th>
                      <th>Item</th>
                      <th>Qty</th>
                      <th>Unit Price</th>
                      <th>Total</th>
                    </tr>
                    {Object.keys(interiorElements).map(
                      (item) =>
                        interiorElements[item].tabs.length > 0 && (
                          <tbody key={item}>
                            <tr>
                              <td rowSpan={4}>
                                <h5>{item}</h5>
                              </td>
                              {interiorElements[item].tabs.map(
                                (element, index) =>
                                  element.map((ele, i) => (
                                    <div key={i}>
                                      <td>{ele?.element_name}</td>
                                      <td>1.King Size Bed</td>
                                      <td>1</td>
                                      <td>1,00,000.00</td>
                                      <td>1,00,000.00</td>
                                    </div>
                                  ))
                              )}
                            </tr>
                            
                            <tr className="subTotalRow">
                              <td colSpan={6}>
                                <span>SUB TOTAL</span>
                                <h4>₹ 1,25,000.00</h4>
                              </td>
                            </tr>
                          </tbody>
                        )
                    )}

                   
                  </table> */}
                  <table>
                    <thead>
                      <tr>
                        <th className="center">Area</th>
                        <th>Room</th>
                        <th>Item</th>
                        <th>Qty</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      {Object.entries(interiorElements).map(
                        ([areaName, areaData], areaIndex) => {
                          const validTabs = areaData.tabs.filter(
                            (tab) => tab.length > 0
                          );
                          if (validTabs.length === 0) return null;

                          // Flatten valid tabs with tabIndex
                          const rows = validTabs.flatMap((tab, tabIndex) =>
                            tab.map((item) => ({ ...item, tabIndex }))
                          );

                          // Subtotal for this area
                          const areaSubTotal = rows.reduce(
                            (acc, ele) =>
                              acc + parseFloat(ele.minimum_price || 0),
                            0
                          );

                          return (
                            <React.Fragment key={areaIndex}>
                              {rows.map((ele, rowIndex) => {
                                const isFirstAreaRow = rowIndex === 0;

                                const tabRowsCount = rows.filter(
                                  (r) => r.tabIndex === ele.tabIndex
                                ).length;

                                const isFirstRoomRow =
                                  rowIndex ===
                                  rows.findIndex(
                                    (r) => r.tabIndex === ele.tabIndex
                                  );

                                return (
                                  <tr key={rowIndex}>
                                    {/* Area column */}
                                    {isFirstAreaRow && (
                                      <td rowSpan={rows.length}>
                                        <strong>{areaName}</strong>
                                      </td>
                                    )}

                                    {/* Room column */}
                                    {isFirstRoomRow && (
                                      <td rowSpan={tabRowsCount}>
                                        <strong>{`${areaName}-${ele.tabIndex + 1
                                          }`}</strong>
                                      </td>
                                    )}

                                    <td>
                                      {ele.element_name_display}/{ele?.model}
                                    </td>
                                    <td>1</td>
                                    <td>
                                      ₹
                                      {parseFloat(
                                        ele.minimum_price
                                      ).toLocaleString("en-IN")}
                                    </td>
                                    <td>
                                      ₹
                                      {parseFloat(
                                        ele.minimum_price
                                      ).toLocaleString("en-IN")}
                                    </td>
                                  </tr>
                                );
                              })}

                              {/* One subtotal per area */}
                              <tr className="subTotalRow">
                                <td colSpan={5} className="subTotalText">
                                  <strong>SUB TOTAL</strong>
                                </td>
                                <td>
                                  <strong>
                                    ₹{areaSubTotal.toLocaleString("en-IN")}
                                  </strong>
                                </td>
                              </tr>
                            </React.Fragment>
                          );
                        }
                      )}
                    </tbody>
                  </table>
                </div>
                <div className="grandTotal leftAligns">
                  <h3>Total</h3>
                  <h3>
                    ₹{" "}
                    {Object.values(interiorElements)
                      .reduce((grand, areaData) => {
                        return (
                          grand +
                          areaData.tabs.flat().reduce((sum, ele) => {
                            return sum + parseFloat(ele.minimum_price || 0);
                          }, 0)
                        );
                      }, 0)
                      .toLocaleString("en-IN")}
                  </h3>
                </div>
                {(() => {
                  const subTotal = Object.values(interiorElements).reduce(
                    (grand, areaData) =>
                      grand +
                      areaData.tabs
                        .flat()
                        .reduce(
                          (sum, ele) =>
                            sum + parseFloat(ele.minimum_price || 0),
                          0
                        ),
                    0
                  );

                  const gst = subTotal * 0.18;
                  const grandTotal = subTotal + gst;

                  return (
                    <>
                      <div className="grandTotal gstTotal leftAligns">
                        <h3>GST (18%)</h3>
                        <h3>₹ {gst.toLocaleString("en-IN")}</h3>
                      </div>
                      <div className="grandTotal">
                        <h3>Grand Total</h3>
                        <h3>₹ {grandTotal.toLocaleString("en-IN")}</h3>
                      </div>
                    </>
                  );
                })()}

                <div className="termsBlock">
                  <h6>Terms & Conditions:</h6>
                  <p>
                    Fees and payment terms will be established in the contract
                    or agreement prior to the commencement of the project. An
                    initial deposit will be required before any design work
                    begins. We reserve the right to suspend or halt work in the
                    event of non-payment.
                  </p>
                </div>
                <div className="contactBlock">
                  <div className="details">
                    <h6>VOYD Interior Designing Solutions</h6>
                    <p>www.voydinteriors.com</p>
                    <p>
                      contact@voydinteriors.com <span>/ +91 9115833833</span>
                    </p>
                  </div>
                  <div className="logo">
                    <img src="assets/images/logo/voydGreen.png" alt="" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </>
  );
};

export default FinalQuote;
