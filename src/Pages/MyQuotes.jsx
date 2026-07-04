/* eslint-disable react-hooks/exhaustive-deps */
/* eslint-disable no-unused-vars */
/* eslint-disable no-undef */
// import React from 'react'
import { environmentUrl } from "../env/enviroment";
import { useEffect, useState } from "react";
import { MdRemoveRedEye } from "react-icons/md";
import { BiStar } from "react-icons/bi";
import { BiSolidStar } from "react-icons/bi";
import html2canvas from "html2canvas";
import jsPDF from "jspdf";
import SelfOther from "../Components/Popups/SelfOthers";
import MinimalInfo from "../Components/Popups/MinimalInfo";
import { FiEdit } from "react-icons/fi";
import { TiArrowBack } from "react-icons/ti";
import { Link, useNavigate } from "react-router-dom";
import { Tab, Tabs, TabList, TabPanel } from "react-tabs";
import "react-tabs/style/react-tabs.css";
import Table from "react-bootstrap/Table";
import moment from "moment";
import { toast } from "sonner";
import Sonner from "../Components/Toaster/Sonner";
import { IoClose } from "react-icons/io5";
import { FaRegEye } from "react-icons/fa";
import Loader from "../Components/Spinner/Loader";

import Classification from "../Components/Popups/Classification";

const MyQuotes = () => {
  const [smShow, setSmShow] = useState(false);
  const [viewQuote, setViewQuote] = useState(false);
  const [minimalInfo, setMinimalInfo] = useState(false);
  const [myQuotations, setMyQuotations] = useState([]);
  const [freezedProject, setFreezedProject] = useState(false);
  const [data, setData] = useState("");
  const [tabName, setTabName] = useState(0);
  const [loading, setLoading] = useState(false);
  const navigate = useNavigate();
  const itemsPerPage = 10;

  const [currentPage, setCurrentPage] = useState(1);
  const [pages, setPages] = useState([]);

  const [classification, setClassification] = useState(false);
  const closeClassification = () => {
    setClassification(false);
  };

  const getEvent = async (data) => {
    setSmShow(false);
    setData(data?.quoteType);
  };

  const handleViewQuotation = () => {
    setViewQuote(true);
  };

  const handleCloseQuote = () => {
    setViewQuote(false);
  };

  const handleRequestQuote = () => {
    setSmShow(true);
  };

  const freezeProject = async (id) => {
    try {
      setLoading(true);
      const apiUrl = `${environmentUrl}/questionnaire/freezeMail.php`;
      const options = {
        method: "POST",
        headers: { Authorization: "Bearer " + localStorage.getItem("token") },
        body: JSON.stringify({ queId: id }),
      };

      const mailFetch = await fetch(apiUrl, options);
      const mailRes = await mailFetch.json();
      if (mailRes?.status) {
        console.log("freezed mail response is", mailRes);
        await getMyQuotations(tabName);
        // rowEle.textContent = mailRes?.freezeStatus;
        toast.success("Project Freezed successfully");
      } else {
        toast.error("something went wrong");
      }
    } catch (error) {
      console.log("freeze project error", error);
    } finally {
      setLoading(false);
    }
  };

  const indexOfLastItem = currentPage * itemsPerPage;
  const indexOfFirstItem = indexOfLastItem - itemsPerPage;
  const currentItems = myQuotations.slice(indexOfFirstItem, indexOfLastItem);
  const totalPages = Math.ceil(myQuotations.length / itemsPerPage);

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

  const quotesPerPage = 10;

  const [quoteCurrentPage, setQuoteCurrentPage] = useState(1);

  const quoteIndexLast = quoteCurrentPage * quotesPerPage;
  const quoteIndexFirst = quoteIndexLast - quotesPerPage;

  const currentQuotes = myQuotations.slice(quoteIndexFirst, quoteIndexLast);

  const quoteTotalPages = Math.ceil(myQuotations.length / quotesPerPage);

  const handleQuotePageChange = (pageNumber) => {
    setQuoteCurrentPage(pageNumber);
    window.scrollTo({ top: 0, behavior: "smooth" });
  };

  const handleQuotePrev = () => {
    if (quoteCurrentPage > 1) setQuoteCurrentPage(quoteCurrentPage - 1);
    window.scrollTo({ top: 0, behavior: "smooth" });
  };

  const handleQuoteNext = () => {
    if (quoteCurrentPage < quoteTotalPages)
      setQuoteCurrentPage(quoteCurrentPage + 1);
    window.scrollTo({ top: 0, behavior: "smooth" });
  };

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

  const getMyQuotations = async (name) => {
    try {
      const apiUrl = `${environmentUrl}/questionnaire/getMyQuotes.php?quoteCat=${name}`;
      const options = {
        method: "GET",
        // body: JSON.stringify({ quotation: tabName }),
        headers: { Authorization: "Bearer " + localStorage.getItem("token") },
      };
      const vendorFetch = await (await fetch(apiUrl, options)).json();
      const vendorRes = vendorFetch?.response;
      setMyQuotations(vendorRes);
    } catch (error) {
      console.log("my quotations error", error);
    } finally {
      setLoading(false);
    }
  };
  useEffect(() => {
    getMyQuotations(tabName);
  }, []);

  useEffect(() => {
    const queryParams = new URLSearchParams(window.location.search);
    const paramsVal = queryParams.get("finalSubmit");
    if (window.location.pathname === "/myQuotes" && paramsVal === null) {
      setMinimalInfo(true);
    }
  }, [window.location.search]);

  const handleTabs = async (event) => {
    await getMyQuotations(event.target.tabIndex);
  };

  const editProjectQuotation = (id) => {
    navigate(`/editQuestionnaire?queId=${id}`);
  };

  const viewProjectQuotation = (id) => {
    navigate(`/finalQuote?queId=${id}`);
  };

  const openQuotePopup = () => {
    setMinimalInfo(true);
  };

  return (
    <>
      {loading && <Loader />}
      {/* {!loading && (
        <div className="container col-lg-11 col-md-11 col-sm-11 col-xs-11">
          <div className="row">
            <div className="my-quotes-container">
              {myQuotations == undefined || myQuotations === 0 ? (
                <div className="container">
                  <div className="row no-quote-data">
                    <img src="assets/images/no-quotations.jpg" alt="" />
                    <p>No Quotations Yet</p>
                    <div>
                      <button
                        className="new-quote-btn"
                        onClick={handleRequestQuote}
                      >
                        Request Quote
                      </button>
                    </div>
                  </div>
                </div>
              ) : (
                !viewQuote && (
                  <div className="container col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div className="row">
                      <div className="group view-quotation">
                        <h2 className="text-center">YOUR QUOTATIONS</h2>
                        <div className="instructions-container">
                          <div>
                            <p>
                              <span>Freeze</span> - Click to freeze the project
                              (willing to proceed further to start the project)
                            </p>
                            <p>
                              <span>
                                View <MdRemoveRedEye />
                              </span>
                              - Click anywhere on the particular row to view
                              particular quotation
                            </p>
                          </div>
                          <div>
                            <button
                              className="new-quote-btn"
                              onClick={handleRequestQuote}
                            >
                              Request Quote
                            </button>
                          </div>
                        </div>
                        <div className="tabs-container">
                          <Tabs>
                            <TabList className="sign-up-nav">
                              <Tab
                                className="sign-up-nav-item customer"
                                tabIndex="0"
                                id="submitted"
                                onClick={handleTabs}
                              >
                                Quotations
                              </Tab>
                              <Tab
                                className="sign-up-nav-item customer"
                                tabIndex="1"
                                id="pending"
                                onClick={handleTabs}
                              >
                                Drafts
                              </Tab>
                            </TabList>
                            <TabPanel>
                              <div className="newtableee">
                                <table>
                                  <thead>
                                    <tr>
                                      <th>S.No</th>
                                      <th>Customer Name</th>
                                      <th>Project Name</th>
                                      <th>Project Type</th>
                                      <th>Mobile</th>
                                      <th>Date</th>
                                      <th>Status</th>
                                    </tr>

                                    {myQuotations.length != 0 &&
                                      myQuotations.map((each, index) => (
                                        <tr
                                          key={index}
                                          id={`table${each?.que_id}`}
                                          className="my-quotes-row"
                                        >
                                          <td>
                                            <Link
                                              to={`/finalQuote?queId=${each?.que_id}`}
                                            >
                                              {" "}
                                              {index + 1}
                                            </Link>
                                          </td>
                                          <td>
                                            <Link
                                              to={`/finalQuote?queId=${each?.que_id}`}
                                            >{`${each?.first_name} ${each?.last_name}`}</Link>
                                          </td>
                                          <td>
                                            <Link
                                              to={`/finalQuote?queId=${each?.que_id}`}
                                            >
                                              {`Mr.INTRO0${each?.customer_id}-${each?.property}(${each?.property_type})-${each?.que_id}`}
                                            </Link>
                                          </td>
                                          <td>
                                            <Link
                                              to={`/finalQuote?queId=${each?.que_id}`}
                                            >{`${each?.product_classification} / ${each?.manufacturer_classification}`}</Link>
                                          </td>

                                          <td>
                                            <Link
                                              to={`/finalQuote?queId=${each?.que_id}`}
                                            >
                                              {each?.mobile}
                                            </Link>
                                          </td>
                                          <td>
                                            <Link
                                              to={`/finalQuote?queId=${each?.que_id}`}
                                            >
                                              {moment(each?.created_At).format(
                                                "DD-MM-YYYY"
                                              )}
                                            </Link>
                                          </td>
                                          <td>
                                            <div className="quotation-action-btns">
                                              <button
                                                className="view-quote-btn"
                                                onClick={() =>
                                                  freezeProject(each?.que_id)
                                                }
                                              >
                                                Freeze
                                              </button>
                                            </div>
                                          </td>
                                        
                                        </tr>
                                      ))}
                                  </thead>
                                </table>
                                {myQuotations.length == 0 && (
                                  <p className="tbl-no-data">
                                    No Quotations Found
                                  </p>
                                )}
                              </div>
                            </TabPanel>
                            <TabPanel>
                              <div className="newtableee">
                                <table>
                                  <thead>
                                    <tr>
                                      <th>S.No</th>
                                      <th>Customer Name</th>
                                      <th>Project Name</th>
                                      <th>Project Type</th>
                                      <th>Date</th>
                                      <th>Mobile</th>

                                      <th>Draft</th>
                                    </tr>

                                    {myQuotations.length != 0 &&
                                      myQuotations.map((each, index) => (
                                        <tr key={index} id={each?.que_id}>
                                          <td>{index + 1}</td>
                                          <td>{`${each?.first_name} ${each?.last_name}`}</td>
                                          <td>
                                            {`Mr.INTRO0${each?.customer_id}-${each?.property}(${each?.property_type})-${each?.que_id}`}
                                          </td>
                                          <td>{`${each?.product_classification} / ${each?.manufacturer_classification}`}</td>

                                          <td>
                                            {moment(each?.created_At).format(
                                              "DD-MM-YYYY"
                                            )}
                                          </td>
                                          <td>{each?.mobile}</td>

                                          <td>
                                            <Link
                                              to={`/editQuestionnaire?queId=${each?.que_id}`}
                                            >
                                              <button className="view-quote-btn">
                                                <FiEdit />
                                              </button>
                                            </Link>
                                          </td>
                                        </tr>
                                      ))}
                                  </thead>
                                </table>
                                {myQuotations.length == 0 && (
                                  <p className="tbl-no-data">
                                    No Data Found in Drafts
                                  </p>
                                )}
                              </div>
                            </TabPanel>
                          </Tabs>
                        </div>

                        <div>
                          <span>
                            Note:{" "}
                            <p>
                              This Quotations will be disable from the website
                              after 30days from the time of creation{" "}
                            </p>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                )
              )}

              {viewQuote && (
                <div>
                  <button className="quote-back-btn" onClick={handleCloseQuote}>
                    <TiArrowBack />
                  </button>

                  <div className="allquotation">
                    <h3>QUOTATION</h3>
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
                        <p>Hari</p>
                        <p>{`"Kakinada, j.k.pur, Andhra`}</p>
                        <p>
                          <span>Contact:</span> 9876543210/ xyz@gmail.com
                        </p>
                        <p>
                          <span>Sub:</span>{" "}
                          {`Quote for Gated Villa/ 2BHK Interiors`}
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
      )} */}
      {/* <SelfOther
        show={smShow}
        close={() => setSmShow(false)}
        getEvent={getEvent}
      /> */}
      <MinimalInfo
        show={minimalInfo}
        close={() => setMinimalInfo(false)}
        type={data}
      />

      {/* ********************************* new quotes design********************** */}
      <div>
        <section className="leafs-bg top">
          <div className="row backdrop">
            <div className="col-lg-6 col-md-6 col-sm-12">
              <h1 className="quote-hdng text-start">YOUR QUOTATION</h1>
              <p className="text-light quote-p text-start">
                * Finalized- Click to freeze the Project (willing to proceed
                further to start the Project) <br />* View- Click anywhere on
                the particular row to view particular quotation
              </p>
            </div>
            <div className="col-md-6 d-flex justify-content-end">
              <div>
                <button
                  className="quote-but top"
                  type="button"
                  onClick={openQuotePopup}
                >
                  Request A Quote
                </button>
                <button
                  className="quote-but top"
                  type="button"
                  onClick={() => setClassification(true)}
                >
                  Classification
                </button>
              </div>
              {/* <div className="width-img increase d-flex align-items-center">
                <img src="assets/images/Group 3455.png" alt="" />
              </div> */}
            </div>
          </div>
        </section>

        <section className="mb-4 quotSection">
          <div className="container borderr getQuots">
            <div className="row justify-content-center pt-2">
              <div className="d-flex justify-content-center">
                <Tabs>
                  <TabList className="quote-draft quatTabs">
                    <Tab
                      className="quote-button tabButtons"
                      tabIndex="0"
                      id="submitted"
                      onClick={handleTabs}
                    >
                      Quotations
                    </Tab>
                    {/* <div className="lineBlock"></div> */}
                    <Tab
                      className="draft-but tabButtons"
                      tabIndex="1"
                      id="pending"
                      onClick={handleTabs}
                    >
                      Drafts
                    </Tab>
                  </TabList>
                  {myQuotations == undefined || myQuotations.length === 0 ? (
                    <div className="container">
                      <div className="row no-quote-data d-flex flex-column justify-content-center">
                        <img src="assets/images/noDataFound.png" alt="" />
                        {/* <p>No Quotations Yet</p> */}
                        <div
                          style={{
                            display: "flex",
                            justifyContent: "center",
                          }}
                        >
                          {/* <button
                          className="getAQuotBtn"
                          onClick={handleRequestQuote}
                        >
                          Request Quote
                        </button> */}
                        </div>
                      </div>
                    </div>
                  ) : (
                    <>
                      <TabPanel>
                        <div className="table-responsive myQuotTbl">
                          <table className="table mt-4">
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
                              {/* {myQuotations.length != 0 &&
                                myQuotations.map((each, index) => ( */}
                              {currentQuotes && currentQuotes.length > 0 ? (
                                currentQuotes.map((each, index) => (
                                  <tr key={index} className="dynamicRowBg">
                                    <th scope="row" className="text-center">
                                      <b>
                                        {(quoteCurrentPage - 1) *
                                          quotesPerPage +
                                          index +
                                          1}
                                      </b>
                                    </th>
                                    <td className="firstLetter">{`${each?.first_name} ${each?.last_name}`}</td>
                                    <td>{`Mr.INTRO0${each?.customer_id}-${each?.property}(${each?.property_type})-${each?.que_id}`}</td>
                                    <td>{`${each?.product_classification} / ${each?.manufacturer_classification}`}</td>
                                    <td>{each?.mobile}</td>
                                    <td>
                                      {moment(each?.created_At).format(
                                        "DD/MM/YYYY"
                                      )}
                                    </td>
                                    <td className="text-center freezBtns">
                                      <button
                                        className="final-but"
                                        type="button"
                                        onClick={() =>
                                          freezeProject(each?.que_id)
                                        }
                                      >
                                        Freeze
                                      </button>
                                      <button
                                        className="final-but"
                                        type="button"
                                        onClick={() =>
                                          viewProjectQuotation(each?.que_id)
                                        }
                                      >
                                        <FaRegEye />
                                      </button>
                                    </td>
                                  </tr>
                                ))
                              ) : (
                                <tr>
                                  <td colSpan="7" className="text-center">
                                    No quotes available
                                  </td>
                                </tr>
                              )}
                            </tbody>
                          </table>

                          <div className="guidesPagntion pgn-tab">
                            <div className="d-flex ft">
                              <div
                                className="prev-t"
                                onClick={handleQuotePrev}
                                style={{ cursor: "pointer" }}
                              >
                                Preview
                              </div>
                              <div className="d-flex gap-2 man-txt">
                                {(() => {
                                  const quotePageButtons = [];
                                  const quoteVisiblePages = 2;

                                  for (let i = 1; i <= quoteTotalPages; i++) {
                                    if (
                                      i === 1 ||
                                      i === quoteTotalPages ||
                                      (i >=
                                        quoteCurrentPage - quoteVisiblePages &&
                                        i <=
                                        quoteCurrentPage + quoteVisiblePages)
                                    ) {
                                      quotePageButtons.push(
                                        <button
                                          key={i}
                                          className={`page-btns ${quoteCurrentPage === i
                                            ? "grn-btn"
                                            : ""
                                            }`}
                                          onClick={() =>
                                            handleQuotePageChange(i)
                                          }
                                        >
                                          {i}
                                        </button>
                                      );
                                    } else if (
                                      (i ===
                                        quoteCurrentPage -
                                        quoteVisiblePages -
                                        1 &&
                                        quoteCurrentPage - quoteVisiblePages >
                                        2) ||
                                      (i ===
                                        quoteCurrentPage +
                                        quoteVisiblePages +
                                        1 &&
                                        quoteCurrentPage + quoteVisiblePages <
                                        quoteTotalPages - 1)
                                    ) {
                                      quotePageButtons.push(
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

                                  return quotePageButtons;
                                })()}
                              </div>
                              <div
                                className="prev-t"
                                onClick={handleQuoteNext}
                                style={{ cursor: "pointer" }}
                              >
                                Next
                              </div>
                            </div>
                          </div>
                        </div>
                      </TabPanel>

                      <TabPanel>
                        <table className="table mt-4">
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
                            {/* {myQuotations.length != 0 && 
                              myQuotations.map((each, index) => ( */}
                            {currentItems && currentItems.length > 0 ? (
                              currentItems.map((each, index) => (
                                <tr key={index} className="dynamicRowBg">
                                  <td scope="row" className="text-center">
                                    <b>
                                      {(currentPage - 1) * itemsPerPage +
                                        index +
                                        1}
                                    </b>
                                  </td>
                                  <td className="firstLetter">{`${each?.first_name} ${each?.last_name}`}</td>
                                  <td>{`VOYD0${each?.customer_id}-${each?.property}(${each?.property_type})-${each?.que_id}`}</td>
                                  <td>{`${each?.product_classification} / ${each?.manufacturer_classification}`}</td>
                                  <td>{each?.mobile}</td>
                                  <td>
                                    {" "}
                                    {moment(each?.created_At).format(
                                      "DD/MM/YYYY"
                                    )}
                                  </td>
                                  <td className="text-center">
                                    <button
                                      className="final-but"
                                      type="button"
                                      onClick={() =>
                                        editProjectQuotation(each?.que_id)
                                      }
                                    >
                                      <FiEdit />
                                    </button>
                                  </td>
                                </tr>
                              ))
                            ) : (
                              <tr>
                                <td colSpan="7" className="text-center">
                                  No drafts available
                                </td>
                              </tr>
                            )}
                          </tbody>
                        </table>
                        <div className="guidesPagntion pgn-tab">
                          <div className="d-flex ft">
                            <div
                              className="prev-t"
                              onClick={handlePrev}
                              style={{ cursor: "pointer" }}
                            >
                              Preview
                            </div>
                            <div className="d-flex gap-2 man-txt">
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
                                        className={`page-btns ${currentPage === i ? "grn-btn" : ""
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
                                      currentPage + visiblePages <
                                      totalPages - 1)
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
                            <div
                              className="prev-t"
                              onClick={handleNext}
                              style={{ cursor: "pointer" }}
                            >
                              Next
                            </div>
                          </div>
                        </div>
                      </TabPanel>
                    </>
                  )}
                </Tabs>

                {/* <button className="quote-draft">
                  <span className="quote-button">Quotations</span>{" "}
                  <span className="draft-but">Drafts</span>
                </button> */}
              </div>
            </div>

            <div className="note-txt d-flex justify-content-center align-items-center">
              <div>
                {" "}
                <button className="note-but mr-2 ">Note</button>
              </div>
              <div>
                <p className="m-0 finalTextP">
                  {/* Final Projects will taking further and rest of the project
                  will be deleted after 30 days */}
                  Final projects will be saved for continued use. Other projects
                  will be deleted after 30 days.
                </p>
              </div>
            </div>
          </div>
        </section>

        {/* quote modal body */}

        {/* <div
          className="modal fade"
          id="exampleModalCenter"
          tabIndex="-1"
          role="dialog"
          aria-labelledby="exampleModalCenterTitle"
          aria-hidden="true"
        >
          <div className="modal-dialog modalDialogOuter " role="document">
            <div className="backdrop2">
              <div className="modal-content">
                <div className="modal-header getQuotTabs">
                  <section className="p-0">
                    <div>
                      <div
                        className="d-flex justify-content-end pt-2 px-3 close-icon-lg cursor-pointer"
                        data-dismiss="modal"
                        aria-label="Close"
                      >
                        <IoClose />
                      </div>
                    </div>
                    <div className="row modal-wdth ">
                      <div className="col-md-12">
                        <Tabs>
                          <div className="row p-2">
                            <div className="col-md-3 pt-4 pt-res">
                              <div>
                                <img
                                  src="assets/images/FYI Final Logo (1).png"
                                  alt=""
                                  className="lo-img"
                                />
                              </div>

                              <TabList className="dis-grid pt-4 sideTabs">
                                <Tab className="text-start cursor-pointer">
                                  <input
                                    type="radio"
                                    name="userType"
                                    className="cursor-pointer"
                                  />{" "}
                                  Self
                                </Tab>
                                <Tab className="text-start cursor-pointer">
                                  <input
                                    type="radio"
                                    name="userType"
                                    className="cursor-pointer"
                                  />{" "}
                                  Others
                                </Tab>
                              </TabList>
                            </div>
                            <div className="col-md-9">
                              <h6 className="text-start my-2 pro-ov">
                                Project Overview
                              </h6>
                              <TabPanel>
                                <Tabs>
                                  <TabList className="d-flex justify-content-start pro-pro singleTabListOuter">
                                    <Tab className=" cursor-pointer singleTabList">
                                      Property
                                    </Tab>
                                    <Tab className=" cursor-pointer singleTabList">
                                      Project
                                    </Tab>
                                  </TabList>

                                  <TabPanel>
                                    <div className="row mr-2">
                                      <div className="col-md-6 mb-2">
                                        <select
                                          name="cars"
                                          id="cars"
                                          className="sel-inp"
                                        >
                                          <option
                                            value="volvo"
                                            className="txt-gry"
                                          >
                                            Property
                                          </option>
                                        </select>
                                      </div>
                                      <div className="col-md-6 mb-2">
                                        <select
                                          name="cars"
                                          id="cars"
                                          className="sel-inp"
                                        >
                                          <option
                                            value="volvo"
                                            className="txt-gry"
                                          >
                                            Property type
                                          </option>
                                        </select>
                                      </div>
                                    </div>
                                    <div className="row mr-2">
                                      <div className="col-md-6 mb-2">
                                        <input
                                          type="text"
                                          placeholder="locality"
                                          className="sel-inp"
                                        />
                                      </div>
                                      <div className="col-md-6 mb-2">
                                        <input
                                          type="text"
                                          placeholder="Budget"
                                          className="sel-inp"
                                        />
                                      </div>
                                    </div>
                                    <div className="row mr-2">
                                      <div className="col-md-6 mb-2">
                                        <input
                                          type="text"
                                          placeholder="Map Link"
                                          className="sel-inp"
                                        />
                                      </div>
                                      <div className="col-md-6 mb-2">
                                        <input
                                          type="text"
                                          placeholder="Total Square Feet of Property"
                                          className="sel-inp"
                                        />
                                      </div>
                                    </div>
                                    <div className="row mr-2">
                                      <div className="col-md-6 mb-2">
                                        <input
                                          type="text"
                                          placeholder="Property Location"
                                          className="sel-inp"
                                        />
                                      </div>
                                      <div className="col-md-6 mb-2">
                                        <input
                                          type="text"
                                          placeholder="Address"
                                          className="sel-inp"
                                        />
                                      </div>
                                    </div>
                                  </TabPanel>
                                  <TabPanel>
                                    <div className="row mr-2">
                                      <div className="col-md-6 mb-2">
                                        <select
                                          name="cars"
                                          id="cars"
                                          className="sel-inp"
                                        >
                                          <option
                                            value="Select"
                                            className="txt-gry"
                                          >
                                            Product Classification
                                          </option>
                                        </select>
                                      </div>
                                      <div className="col-md-6 mb-2">
                                        <select
                                          name="cars"
                                          id="cars"
                                          className="sel-inp"
                                        >
                                          <option
                                            value="Select"
                                            className="txt-gry"
                                          >
                                            Manufacturer Classification
                                          </option>
                                        </select>
                                      </div>
                                    </div>
                                  </TabPanel>
                                </Tabs>
                              </TabPanel>
                              <TabPanel>
                                <Tabs>
                                  <TabList className="d-flex justify-content-start ppa-res singleTabListOuter">
                                    <Tab className=" cursor-pointer singleTabList">
                                      Address
                                    </Tab>
                                    <Tab className=" cursor-pointer singleTabList">
                                      Property
                                    </Tab>
                                    <Tab className=" cursor-pointer singleTabList">
                                      Project
                                    </Tab>
                                  </TabList>
                                  <TabPanel>
                                    <div className="row mr-2">
                                      <div className="col-md-6 mb-2">
                                        <input
                                          type="text"
                                          placeholder="First Name"
                                          className="sel-inp"
                                        />
                                      </div>
                                      <div className="col-md-6 mb-2">
                                        <input
                                          type="text"
                                          placeholder="Last Name"
                                          className="sel-inp"
                                        />
                                      </div>
                                    </div>
                                    <div className="row mr-2">
                                      <div className="col-md-6 mb-2">
                                        <input
                                          type="email"
                                          placeholder="xyz@example.com"
                                          className="sel-inp"
                                        />
                                      </div>
                                      <div className="col-md-6 mb-2">
                                        <input
                                          type="email"
                                          placeholder="Mobile No"
                                          className="sel-inp"
                                        />
                                      </div>
                                    </div>
                                    <div className="row mr-2">
                                      <div className="col-md-6 mb-2">
                                        <select
                                          name="cars"
                                          id="cars"
                                          className="sel-inp"
                                        >
                                          <option
                                            value="
      enter state
      "
                                            className="txt-gry"
                                          >
                                            state
                                          </option>
                                        </select>
                                      </div>
                                      <div className="col-md-6 mb-2">
                                        <select
                                          name="cars"
                                          id="cars"
                                          className="sel-inp"
                                        >
                                          <option
                                            value="
      City
      "
                                            className="txt-gry"
                                          >
                                            Enter city
                                          </option>
                                        </select>
                                      </div>
                                    </div>
                                  </TabPanel>
                                  <TabPanel>
                                    <div className="row mr-2">
                                      <div className="col-md-6 mb-2">
                                        <select
                                          name="cars"
                                          id="cars"
                                          className="sel-inp"
                                        >
                                          <option
                                            value="volvo"
                                            className="txt-gry"
                                          >
                                            Property
                                          </option>
                                        </select>
                                      </div>
                                      <div className="col-md-6 mb-2">
                                        <select
                                          name="cars"
                                          id="cars"
                                          className="sel-inp"
                                        >
                                          <option
                                            value="volvo"
                                            className="txt-gry"
                                          >
                                            Property type
                                          </option>
                                        </select>
                                      </div>
                                    </div>
                                    <div className="row mr-2">
                                      <div className="col-md-6 mb-2">
                                        <input
                                          type="text"
                                          placeholder="locality"
                                          className="sel-inp"
                                        />
                                      </div>
                                      <div className="col-md-6 mb-2">
                                        <input
                                          type="text"
                                          placeholder="Budget"
                                          className="sel-inp"
                                        />
                                      </div>
                                    </div>
                                    <div className="row mr-2">
                                      <div className="col-md-6 mb-2">
                                        <input
                                          type="text"
                                          placeholder="Map Link"
                                          className="sel-inp"
                                        />
                                      </div>
                                      <div className="col-md-6 mb-2">
                                        <input
                                          type="text"
                                          placeholder="Total Square Feet of Property"
                                          className="sel-inp"
                                        />
                                      </div>
                                    </div>
                                    <div className="row mr-2">
                                      <div className="col-md-6 mb-2">
                                        <input
                                          type="text"
                                          placeholder="Property Location"
                                          className="sel-inp"
                                        />
                                      </div>
                                      <div className="col-md-6 mb-2">
                                        <input
                                          type="text"
                                          placeholder="Address"
                                          className="sel-inp"
                                        />
                                      </div>
                                    </div>
                                  </TabPanel>
                                  <TabPanel>
                                    <div className="row mr-2">
                                      <div className="col-md-6 mb-2">
                                        <select
                                          name="cars"
                                          id="cars"
                                          className="sel-inp"
                                        >
                                          <option
                                            value="volvo"
                                            className="txt-gry"
                                          >
                                            Property
                                          </option>
                                        </select>
                                      </div>
                                      <div className="col-md-6 mb-2">
                                        <select
                                          name="cars"
                                          id="cars"
                                          className="sel-inp"
                                        >
                                          <option
                                            value="volvo"
                                            className="txt-gry"
                                          >
                                            Property type
                                          </option>
                                        </select>
                                      </div>
                                    </div>
                                  </TabPanel>
                                </Tabs>
                              </TabPanel>
                              <div className="d-flex pt-5 gap-1 pb-3">
                                <button
                                  type="button"
                                  className="btn btn-light can-btn"
                                  data-dismiss="modal"
                                >
                                  Cancel
                                </button>
                                <button
                                  type="button"
                                  className="btn btn-success next-but"
                                >
                                  NEXT
                                </button>
                              </div>
                            </div>
                          </div>
                        </Tabs>
                      </div>
                    </div>
                  </section>
                </div>
              </div>
            </div>
          </div>
        </div> */}
      </div>
      <Sonner />
      <Classification
        openClassification={classification}
        closeClassification={closeClassification}
      />
    </>
  );
};

export default MyQuotes;
