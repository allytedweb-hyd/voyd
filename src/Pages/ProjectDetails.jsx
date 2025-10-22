import React from "react";
import { PiSlidersHorizontalBold } from "react-icons/pi";
import { FaAngleDoubleRight } from "react-icons/fa";
import { IoIosClose } from "react-icons/io";
import { FiMinus } from "react-icons/fi";
import { FaAngleRight } from "react-icons/fa";
import "bootstrap/dist/css/bootstrap.min.css";
import { useState, useEffect } from "react";
import { IoCloseCircle } from "react-icons/io5";
import { IoMdCloseCircleOutline } from "react-icons/io";
import { Button, Offcanvas } from "react-bootstrap";
import InteriorElementsAddOns from "../Components/Questionnair/InteriorElementsAddOns";

const ProjectDetails = ({ totalAddons }) => {
  const [fade, setFade] = useState(false);
  const [show, setShow] = useState(false);
  const [isOffcanvasVisible, setIsOffcanvasVisible] = useState(false);
  const [placement, setPlacement] = useState("start");

  const handleClose = () => setIsOffcanvasVisible(false);
  const handleShow = (placement) => {
    setPlacement(placement);
    setIsOffcanvasVisible(true);
  };
  console.log("interior ele addons===", typeof totalAddons);
  const [addData, setAddData] = useState({});
  const SlidingInteriorEle = () => {
    let interiorCon = document.getElementById("interiorEleContainer");
    let interiorBtnEle = document.getElementById("interiorEleBtn");

    interiorCon.classList.toggle("active");
    interiorBtnEle.classList.toggle("active");
  };

  useEffect(() => {
    setAddData(totalAddons);
  }, [totalAddons]);
  useEffect(() => {
    if (show) {
      setTimeout(() => setFade(true), 10);
    } else {
      setFade(false);
    }
  }, [show]);

  const quotations = [
    {
      id: 1,
      projectName: "Mr.INTRO20-Neelima",
      mobileNumber: "1234567890",
      address: "Kakinada",
      status: "Pending",
    },
    {
      id: 2,
      projectName: "Mr.INTRO25-Satya",
      mobileNumber: "1234567890",
      address: "Kukatpally, Hyderabad",
      status: "Pending",
    },
  ];

  return (
    <>
      <InteriorElementsAddOns />
      <div className="bg-leaf-img">
        <div>
          <h1 className="pd-txt m-0">Project Details</h1>
        </div>
      </div>
      {/* <div>
          
          <div className='gren-leaf'><img src="assets/images/Component 1.png" alt="" /></div>
     
      </div> */}
      <div className="container new-con-width mt-3">
        <div className="row-main">
          <div className="row ">
            <div className="col-md-3 element">
              <div className="d-flex prjects-font ot-fnt">
                <div className="wi-40">Customer Name</div>
                <div className="wi-10">:</div>
                <div className="wi-50">Cummins Pat</div>
              </div>
              <div className="d-flex  ot-fnt">
                <div className="wi-40">Contact</div>
                <div className="wi-10">:</div>
                <div className="wi-50">9122567891</div>
              </div>
              <div className="d-flex  ot-fnt">
                <div className="wi-40">Property</div>
                <div className="wi-10">:</div>
                <div className="wi-50">Gated Villa / ( 2BHK )</div>
              </div>

              <div>
                {/* <div className="row fnt-14">
                            
                <div className="col-md-5 col-sm-6  wdth-50 ot-fnt text-start">Contact</div>
                <div className="col-md-1">:</div>
                              <div className="col-md-6  wdth-50 ot-fnt col-sm-6 text-start">  9346175460</div>
                             

                          </div>
                          <div className="row fnt-14">
                <div className="col-md-5 col-sm-6  wdth-50 ot-fnt text-start">Property</div>
                <div className="col-md-1">:</div>
                              <div className="col-md-6  wdth-50 ot-fnt col-sm-6 text-start"> Gated villa / (2BHK)</div>
                              

                      </div> */}
              </div>
            </div>
            <div className="col-md-4 element">
              <div className="d-flex  ot-fnt">
                <div className="wi-40">Project</div>
                <div className="wi-10">:</div>
                <div className="wi-50">RO027-Gated villa(2BHK)-36</div>
              </div>
              <div className="d-flex  ot-fnt">
                <div className="wi-40">Project Type</div>
                <div className="wi-10">:</div>
                <div className="wi-50">Platinum & Platinum</div>
              </div>
              <div className="d-flex  ot-fnt">
                <div className="wi-40">Location</div>
                <div className="wi-10">:</div>
                <div className="wi-50">Telangana, Hyderabad</div>
              </div>
            </div>
            <div className="col-md-3 element">
              <div className="d-flex  ot-fnt">
                <div className="wi-40">Total budget</div>
                <div className="wi-10">:</div>
                <div className="wi-50">Cummins Pat</div>
              </div>
              <div className="d-flex  ot-fnt">
                <div className="wi-40">Utilized</div>
                <div className="wi-10">:</div>
                <div className="wi-50">5,00000 INR</div>
              </div>
              <div className="d-flex  ot-fnt">
                <div className="wi-40">Balance</div>
                <div className="wi-10">:</div>
                <div className="wi-50">15,00000 INR</div>
              </div>
            </div>
            <div className="col-md-2 d-flex justify-content-center align-items-center view-bn">
              <button className="v-price" onClick={() => setShow(true)}>
                View Pricing Options <FaAngleRight className="fnt-22" />
              </button>
            </div>
          </div>
        </div>
        {/* <div className='d-flex justify-content-end'> 
        <button className='v-price'>off canvas <FaAngleRight  className='fnt-22'/>
              </button></div> */}
        <div className="row mt-3">
          <div className="col-md-3 ">
            <div className="filter-div mb-2 p-4">
              <div className="d-flex mb-4">
                <div>
                  <h6 className="fil-txt text-dark m-0">Filter</h6>
                </div>
                <div className="px-3 d-flex align-items-center text-dark slider-icon">
                  <PiSlidersHorizontalBold />
                </div>
              </div>
              <div className="col-md-10 mb-2 p-0">
                <select
                  name="cars"
                  id="cars"
                  className="sel-inp cursor-pointer"
                >
                  <option value="volvo" className="txt-gry">
                    Property Block
                  </option>
                </select>
              </div>
              <div className="col-md-10 mb-2 p-0">
                <select
                  name="cars"
                  id="cars"
                  className="sel-inp cursor-pointer"
                >
                  <option value="volvo" className="txt-gry">
                    Living Room
                  </option>
                </select>
              </div>
              <div className="col-md-10 mb-2 p-0">
                <select
                  name="cars"
                  id="cars"
                  className="sel-inp cursor-pointer"
                >
                  <option value="volvo" className="txt-gry">
                    No of Property Blocks(rooms)
                  </option>
                </select>
              </div>
              <div className="col-md-10 mb-2 p-0">
                <select
                  name="cars"
                  id="cars"
                  className="sel-inp cursor-pointer"
                >
                  <option value="volvo" className="txt-gry">
                    Interior Elements
                  </option>
                </select>
              </div>
              <div className="col-md-10 mb-2 p-0">
                <select
                  name="cars"
                  id="cars"
                  className="sel-inp cursor-pointer"
                >
                  <option value="volvo" className="txt-gry">
                    Material
                  </option>
                </select>
              </div>

              <div className="col-md-10 mb-2 p-0">
                <select
                  name="cars"
                  id="cars"
                  className="sel-inp cursor-pointer"
                >
                  <option value="volvo" className="txt-gry">
                    Design
                  </option>
                </select>
              </div>

              <div className="col-md-12 mb-2 p-0 ">
                <select name="cars" id="cars" className="sel-inp border-none">
                  <option value="volvo" className="txt-gry">
                    Price Range
                  </option>
                </select>
              </div>

              <div className="progress-bar-container">
                <div className="progress-line">
                  <div className="progress-button">
                    <FaAngleDoubleRight />{" "}
                  </div>
                </div>
              </div>

              <div className="col-md-12 d-flex justify-content-between py-3 border-bottom">
                <div className="col-grey">
                  <span className="font-weight-bold text-dark">$50</span> from
                </div>
                <div className="col-grey">
                  to <span className="font-weight-bold text-dark">$500</span>
                </div>
              </div>
              <div className="col-md-12">
                <button
                  className="sub-qt-btn"
                  type="button"
                  data-toggle="modal"
                  data-target="#exampleModal"
                >
                  SUBMIT QUOTE
                </button>
              </div>

              <div>
                {/* Button to trigger modal */}

                {/* Modal */}
                <div
                  className="modal fade"
                  id="exampleModal"
                  tabIndex="-1"
                  role="dialog"
                  aria-labelledby="exampleModalLabel"
                  aria-hidden="true"
                >
                  <div className="modal-dialog" role="document">
                    <div className="modal-content bdy-wdth">
                      <div className="modal-header">
                        <h5 className="modal-title" id="exampleModalLabel">
                          <div className="d-flex justify-content-between">
                            <div>
                              <h6 className="text-center text-dark ">
                                Confirmation
                              </h6>
                            </div>
                            <div className="d-flex">
                              <IoIosClose
                                className="close-icon-lg cursor-pointer"
                                data-dismiss="modal"
                                aria-label="Close"
                              />
                            </div>
                          </div>
                          <div className="cautn-btn2">
                            <div className="d-flex">
                              <div>
                                <img
                                  src="assets/images/Icon.png"
                                  alt=""
                                  className="caution-img"
                                />
                              </div>
                              <div>
                                <p className="after-txt m-0 col-grey">
                                  Once this is Submitted it can't be edit,
                                  <br /> Are you Sure and want to submit
                                </p>
                              </div>
                            </div>
                          </div>
                        </h5>
                        {/* <button
                type="button"
                className="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button> */}
                      </div>
                      <div className="modal-body bdy-btm-pdng ">...</div>
                      <div className="modal-footer pdng-ftr justify-content-start pt-4">
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
                </div>
              </div>
            </div>
            <div className="filter-div mb-2 p-4">
              <div className="text-center">
                <div>
                  <img src="assets/images/Frame 30.png" alt="" />
                </div>
                <div className="bag-text col-grey">
                  You have note added any products to your favorite
                </div>
              </div>
            </div>
          </div>
          <div className="col-md-9">
            <div className="row mb-3">
              <div className="col-md-3 col-sm-6 p-2">
                <div className="card card-sdw">
                  <div className="card-image">
                    <img
                      src="assets/images/Rectangle 119.png"
                      alt="Room with chair and lamp"
                    />
                  </div>
                  <div className="card-content con-div">
                    <h6 className="font-weight-bold fnt-w-14">
                      Name/Style
                      <FiMinus className="close-icon2" />
                      <span class="highlight col-grey ">
                        TV Unit/Antic Mount
                      </span>
                    </h6>
                    <p className=" fnt-sm2 col-fig">
                      made by wood mounted to wall
                    </p>
                    <p className="fw-6">
                      Material Used
                      <FiMinus className="close-icon2" />
                      <span className="col-fig fnt-sm2">Wooden Laminate</span>
                    </p>
                    <p className="p-lngh-fnt">
                      <strong>
                        LxWxH <FiMinus className="close-icon2" />
                      </strong>
                      <span className="col-fig"> 46</span>{" "}
                      <IoIosClose className="close-icon3" />
                      <span className="col-fig"> 34</span>{" "}
                      <IoIosClose className="close-icon3" />
                      <span className="col-fig"> 10</span>{" "}
                    </p>

                    <div className="d-flex justify-content-between">
                      <div className="fnt-sm col-fig">
                        <strong className="col-black">
                          1Sft <FiMinus className="close-icon2" />
                        </strong>{" "}
                        1200/-
                      </div>
                      <div className="fnt-sm col-fig">
                        <strong className="col-black">Min</strong>{" "}
                        <FiMinus className="close-icon2" />
                        55000/-
                      </div>
                      <div className="fnt-sm col-fig">
                        <strong className="col-black">Max</strong>
                        <FiMinus className="close-icon2" />
                        79999/-
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div className="col-md-3 col-sm-6 p-2">
                <div class="card card-sdw">
                  <div class="card-image">
                    <img
                      src="assets/images/Rectangle 2185.png"
                      alt="Room with chair and lamp"
                    />
                  </div>
                  <div class="card-content con-div">
                    <h6 className="font-weight-bold fnt-w-14">
                      Name/Style
                      <FiMinus className="close-icon2" />
                      <span class="highlight col-grey ">
                        TV Unit/Antic Mount
                      </span>
                    </h6>
                    <p className=" fnt-sm2 col-fig">
                      made by wood mounted to wall
                    </p>
                    <p className="fw-6">
                      Material Used
                      <FiMinus className="close-icon2" />
                      <span className="col-fig fnt-sm2">Wooden Laminate</span>
                    </p>
                    <p className="p-lngh-fnt">
                      <strong>
                        LxWxH <FiMinus className="close-icon2" />
                      </strong>
                      <span className="col-fig"> 46</span>{" "}
                      <IoIosClose className="close-icon3" />
                      <span className="col-fig"> 34</span>{" "}
                      <IoIosClose className="close-icon3" />
                      <span className="col-fig"> 10</span>{" "}
                    </p>

                    <div className="d-flex justify-content-between">
                      <div className="fnt-sm col-fig">
                        <strong className="col-black">
                          1Sft <FiMinus className="close-icon2" />
                        </strong>{" "}
                        1200/-
                      </div>
                      <div className="fnt-sm col-fig">
                        <strong className="col-black">Min</strong>{" "}
                        <FiMinus className="close-icon2" />
                        55000/-
                      </div>
                      <div className="fnt-sm col-fig">
                        <strong className="col-black">Max</strong>
                        <FiMinus className="close-icon2" />
                        79999/-
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div className="col-md-3 col-sm-6 p-2">
                <div class="card card-sdw">
                  <div class="card-image">
                    <img
                      src="assets/images/Rectangle 121.png"
                      alt="Room with chair and lamp"
                    />
                  </div>
                  <div class="card-content con-div">
                    <h6 className="font-weight-bold fnt-w-14">
                      Name/Style
                      <FiMinus className="close-icon2" />
                      <span class="highlight col-grey ">
                        TV Unit/Antic Mount
                      </span>
                    </h6>
                    <p className=" fnt-sm2 col-fig">
                      made by wood mounted to wall
                    </p>
                    <p className="fw-6">
                      Material Used
                      <FiMinus className="close-icon2" />
                      <span className="col-fig fnt-sm2">Wooden Laminate</span>
                    </p>
                    <p className="p-lngh-fnt">
                      <strong>
                        LxWxH <FiMinus className="close-icon2" />
                      </strong>
                      <span className="col-fig"> 46</span>{" "}
                      <IoIosClose className="close-icon3" />
                      <span className="col-fig"> 34</span>{" "}
                      <IoIosClose className="close-icon3" />
                      <span className="col-fig"> 10</span>{" "}
                    </p>

                    <div className="d-flex justify-content-between">
                      <div className="fnt-sm col-fig">
                        <strong className="col-black">
                          1Sft <FiMinus className="close-icon2" />
                        </strong>{" "}
                        1200/-
                      </div>
                      <div className="fnt-sm col-fig">
                        <strong className="col-black">Min</strong>{" "}
                        <FiMinus className="close-icon2" />
                        55000/-
                      </div>
                      <div className="fnt-sm col-fig">
                        <strong className="col-black">Max</strong>
                        <FiMinus className="close-icon2" />
                        79999/-
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div className="col-md-3 col-sm-6 p-2">
                <div class="card card-sdw">
                  <div class="card-image">
                    <img
                      src="assets/images/Rectangle 123.png"
                      alt="Room with chair and lamp"
                    />
                  </div>
                  <div class="card-content con-div">
                    <h6 className="font-weight-bold fnt-w-14">
                      Name/Style
                      <FiMinus className="close-icon2" />
                      <span class="highlight col-grey ">
                        TV Unit/Antic Mount
                      </span>
                    </h6>
                    <p className=" fnt-sm2 col-fig">
                      made by wood mounted to wall
                    </p>
                    <p className="fw-6">
                      Material Used
                      <FiMinus className="close-icon2" />
                      <span className="col-fig fnt-sm2">Wooden Laminate</span>
                    </p>
                    <p className="p-lngh-fnt">
                      <strong>
                        LxWxH <FiMinus className="close-icon2" />
                      </strong>
                      <span className="col-fig"> 46</span>{" "}
                      <IoIosClose className="close-icon3" />
                      <span className="col-fig"> 34</span>{" "}
                      <IoIosClose className="close-icon3" />
                      <span className="col-fig"> 10</span>{" "}
                    </p>

                    <div className="d-flex justify-content-between">
                      <div className="fnt-sm col-fig">
                        <strong className="col-black">
                          1Sft <FiMinus className="close-icon2" />
                        </strong>{" "}
                        1200/-
                      </div>
                      <div className="fnt-sm col-fig">
                        <strong className="col-black">Min</strong>{" "}
                        <FiMinus className="close-icon2" />
                        55000/-
                      </div>
                      <div className="fnt-sm col-fig">
                        <strong className="col-black">Max</strong>
                        <FiMinus className="close-icon2" />
                        79999/-
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div className="row mb-3">
              <div className="col-md-3 col-sm-6 p-2">
                <div class="card card-sdw">
                  <div class="card-image">
                    <img
                      src="assets/images/Rectangle 119.png"
                      alt="Room with chair and lamp"
                    />
                  </div>
                  <div class="card-content con-div">
                    <h6 className="font-weight-bold fnt-w-14">
                      Name/Style
                      <FiMinus className="close-icon2" />
                      <span class="highlight col-grey ">
                        TV Unit/Antic Mount
                      </span>
                    </h6>
                    <p className=" fnt-sm2 col-fig">
                      made by wood mounted to wall
                    </p>
                    <p className="fw-6">
                      Material Used
                      <FiMinus className="close-icon2" />
                      <span className="col-fig fnt-sm2">Wooden Laminate</span>
                    </p>
                    <p className="p-lngh-fnt">
                      <strong>
                        LxWxH <FiMinus className="close-icon2" />
                      </strong>
                      <span className="col-fig"> 46</span>{" "}
                      <IoIosClose className="close-icon3" />
                      <span className="col-fig"> 34</span>{" "}
                      <IoIosClose className="close-icon3" />
                      <span className="col-fig"> 10</span>{" "}
                    </p>

                    <div className="d-flex justify-content-between">
                      <div className="fnt-sm col-fig">
                        <strong className="col-black">
                          1Sft <FiMinus className="close-icon2" />
                        </strong>{" "}
                        1200/-
                      </div>
                      <div className="fnt-sm col-fig">
                        <strong className="col-black">Min</strong>{" "}
                        <FiMinus className="close-icon2" />
                        55000/-
                      </div>
                      <div className="fnt-sm col-fig">
                        <strong className="col-black">Max</strong>
                        <FiMinus className="close-icon2" />
                        79999/-
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div className="col-md-3 col-sm-6 p-2">
                <div class="card card-sdw">
                  <div class="card-image">
                    <img
                      src="assets/images/Rectangle 2185.png"
                      alt="Room with chair and lamp"
                    />
                  </div>
                  <div class="card-content con-div">
                    <h6 className="font-weight-bold fnt-w-14">
                      Name/Style
                      <FiMinus className="close-icon2" />
                      <span class="highlight col-grey ">
                        TV Unit/Antic Mount
                      </span>
                    </h6>
                    <p className=" fnt-sm2 col-fig">
                      made by wood mounted to wall
                    </p>
                    <p className="fw-6">
                      Material Used
                      <FiMinus className="close-icon2" />
                      <span className="col-fig fnt-sm2">Wooden Laminate</span>
                    </p>
                    <p className="p-lngh-fnt">
                      <strong>
                        LxWxH <FiMinus className="close-icon2" />
                      </strong>
                      <span className="col-fig"> 46</span>{" "}
                      <IoIosClose className="close-icon3" />
                      <span className="col-fig"> 34</span>{" "}
                      <IoIosClose className="close-icon3" />
                      <span className="col-fig"> 10</span>{" "}
                    </p>

                    <div className="d-flex justify-content-between">
                      <div className="fnt-sm col-fig">
                        <strong className="col-black">
                          1Sft <FiMinus className="close-icon2" />
                        </strong>{" "}
                        1200/-
                      </div>
                      <div className="fnt-sm col-fig">
                        <strong className="col-black">Min</strong>{" "}
                        <FiMinus className="close-icon2" />
                        55000/-
                      </div>
                      <div className="fnt-sm col-fig">
                        <strong className="col-black">Max</strong>
                        <FiMinus className="close-icon2" />
                        79999/-
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div className="col-md-3 col-sm-6 p-2">
                <div class="card card-sdw">
                  <div class="card-image">
                    <img
                      src="assets/images/Rectangle 121.png"
                      alt="Room with chair and lamp"
                    />
                  </div>
                  <div class="card-content con-div">
                    <h6 className="font-weight-bold fnt-w-14">
                      Name/Style
                      <FiMinus className="close-icon2" />
                      <span class="highlight col-grey ">
                        TV Unit/Antic Mount
                      </span>
                    </h6>
                    <p className=" fnt-sm2 col-fig">
                      made by wood mounted to wall
                    </p>
                    <p className="fw-6">
                      Material Used
                      <FiMinus className="close-icon2" />
                      <span className="col-fig fnt-sm2">Wooden Laminate</span>
                    </p>
                    <p className="p-lngh-fnt">
                      <strong>
                        LxWxH <FiMinus className="close-icon2" />
                      </strong>
                      <span className="col-fig"> 46</span>{" "}
                      <IoIosClose className="close-icon3" />
                      <span className="col-fig"> 34</span>{" "}
                      <IoIosClose className="close-icon3" />
                      <span className="col-fig"> 10</span>{" "}
                    </p>

                    <div className="d-flex justify-content-between">
                      <div className="fnt-sm col-fig">
                        <strong className="col-black">
                          1Sft <FiMinus className="close-icon2" />
                        </strong>{" "}
                        1200/-
                      </div>
                      <div className="fnt-sm col-fig">
                        <strong className="col-black">Min</strong>{" "}
                        <FiMinus className="close-icon2" />
                        55000/-
                      </div>
                      <div className="fnt-sm col-fig">
                        <strong className="col-black">Max</strong>
                        <FiMinus className="close-icon2" />
                        79999/-
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div className="col-md-3 col-sm-6 p-2">
                <div class="card card-sdw">
                  <div class="card-image">
                    <img
                      src="assets/images/Rectangle 123.png"
                      alt="Room with chair and lamp"
                    />
                  </div>
                  <div class="card-content con-div">
                    <h6 className="font-weight-bold fnt-w-14">
                      Name/Style
                      <FiMinus className="close-icon2" />
                      <span class="highlight col-grey ">
                        TV Unit/Antic Mount
                      </span>
                    </h6>
                    <p className=" fnt-sm2 col-fig">
                      made by wood mounted to wall
                    </p>
                    <p className="fw-6">
                      Material Used
                      <FiMinus className="close-icon2" />
                      <span className="col-fig fnt-sm2">Wooden Laminate</span>
                    </p>
                    <p className="p-lngh-fnt">
                      <strong>
                        LxWxH <FiMinus className="close-icon2" />
                      </strong>
                      <span className="col-fig"> 46</span>{" "}
                      <IoIosClose className="close-icon3" />
                      <span className="col-fig"> 34</span>{" "}
                      <IoIosClose className="close-icon3" />
                      <span className="col-fig"> 10</span>{" "}
                    </p>

                    <div className="d-flex justify-content-between">
                      <div className="fnt-sm col-fig">
                        <strong className="col-black">
                          1Sft <FiMinus className="close-icon2" />
                        </strong>{" "}
                        1200/-
                      </div>
                      <div className="fnt-sm col-fig">
                        <strong className="col-black">Min</strong>{" "}
                        <FiMinus className="close-icon2" />
                        55000/-
                      </div>
                      <div className="fnt-sm col-fig">
                        <strong className="col-black">Max</strong>
                        <FiMinus className="close-icon2" />
                        79999/-
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div className="row">
              <div className="col-md-4">
                <div className="d-flex justify-content-between ">
                  <div className="col-grey fnt-12">prevoius page</div>
                  <div className="d-flex gap-2">
                    <button className="page-btns grn-btn">1</button>{" "}
                    <button className="page-btns">2</button>{" "}
                    <button className="page-btns">3</button>{" "}
                    <button className="page-btns">4</button>{" "}
                    <button className="page-btns">5</button>{" "}
                    <button className="page-btns">6</button>{" "}
                    <button className="page-btns">7</button>
                  </div>
                  <div className="fnt-12 text-dark">Next page</div>
                </div>
              </div>
              <div className="col-md-6"></div>
            </div>
          </div>
        </div>

        <div className="container ">
          <div className="row justify-content-center">
            <div className="table-hdng text-center pb-3 w-100">
              <strong>
                List Of Vendors Under <span className="ptnm-txt">PLATINUM</span>{" "}
                Classification
              </strong>
              <div className="ovr-hidn">
                <div
                  className="table-responsive"
                  style={{ overflowX: "auto", whiteSpace: "nowrap" }}
                >
                  <table className="table mt-2" style={{ minWidth: "800px" }}>
                    <thead className="thead-dark">
                      <tr className="bg-brown">
                        <th className="text-center text-light tbl-l-br">
                          <div className="tbl-iner">S.No</div>
                        </th>
                        <th className="text-light tbl-brs">
                          {" "}
                          <div className="tbl-iner">Vendor Name</div>
                        </th>
                        <th className="width-15 text-light">
                          {" "}
                          <div className="tbl-iner">Customer Name</div>
                        </th>
                        <th className="text-light">
                          {" "}
                          <div className="tbl-iner">Customer Type</div>
                        </th>
                        <th className="text-light tbl-r-br">
                          {" "}
                          <div className="tbl-iner">GST No</div>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr className="brdr-brm-grey">
                        <th>#20462</th>
                        <td>Hat</td>
                        <td>Matt Dickerson</td>
                        <td>Type 1</td>
                        <td>+44 567884225</td>
                      </tr>
                      <tr className="brdr-brm-grey">
                        <th>#20462</th>
                        <td>Hat</td>
                        <td>Matt Dickerson</td>
                        <td>Type 1</td>
                        <td>+44 567884225</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div className="row py-3 pagins">
            <div className="col-md-3"></div>
            <div className="col-md-6 d-flex justify-content-center ">
              <button className="page-bg-btn d-flex justify-content-between">
                <div className="col-grey fnt-12 mr-4 mrgn-mob">
                  prevoius page
                </div>
                <div className="mr-4 d-flex">
                  <button className="page-btns2">1</button>{" "}
                  <button className="page-btns2">2</button>{" "}
                  <button className="page-btns2">3</button>{" "}
                  <button className="page-btns2">4</button>{" "}
                  <button className="page-btns2">5</button>{" "}
                  <button className="page-btns2">6</button>{" "}
                  <button className="page-btns2">7</button>
                </div>
                <div className="fnt-12 text-dark d-flex align-items-center">
                  Next page
                </div>
              </button>
            </div>
            <div className="col-md-3"></div>
          </div>
          {/* <button className="btn btn-primary" onClick={() => setShow(true)}>
        Open Modal
      </button> */}

          {show && (
            <div
              className={`modal fade ${fade ? "show" : ""}`}
              tabIndex="-1"
              style={{ display: fade ? "block" : "none" }}
            >
              <div className="modal-dialog modal-dialog-centered custom-modal-width2">
                <div className="modal-content mc-adju2 bg-lt-grey ">
                  {/* <div className="modal-header">
              
                <button
                  type="button"
                  className="btn-close"
                  onClick={() => setShow(false)}
                ></button>
              </div> */}
                  <div className="modal-body p-0 brdr-30">
                    <div className="card border-none ">
                      <div className="card-body bg-lt-grey text-center p-0">
                        <div>
                          <div>
                            <div className="row"></div>
                            <div className="row">
                              <div>
                                <button
                                  type="button"
                                  className="btn-close close-b"
                                  onClick={() => setShow(false)}
                                >
                                  <img
                                    src="assets/images/Group 1618873579.png"
                                    alt=""
                                  />
                                </button>
                              </div>
                              <div>
                                <img
                                  src="assets/images/Group 427320765.png"
                                  alt=""
                                  className="mob-dec"
                                />
                              </div>

                              <div className="save-txt">
                                Save More with Good{" "}
                                <span className="plan-txt">Plans</span>
                              </div>
                              {/* <div className="row">
                              <div className="col-md-4">maker Classification</div>
                              <div className="col-md-4"></div>
                              <div className="col-md-4"></div>
                            </div> */}
                              <div className="overflow-x-auto">
                                <table className="min-w-full border border-gray-300">
                                  <thead>
                                    <tr className="bg-gray-200">
                                      <th className="bordering2  padd-tab px-py-t">
                                        Maker Classification
                                      </th>
                                      <th className="bordering2  padd-tab px-py-t">
                                        Material Classification
                                      </th>
                                      <th className="bordering2  padd-tab px-py-t">
                                        Approx. Project cost{" "}
                                      </th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr className="ln-10">
                                      <td className="bordering  px-4 py-2 px-py-t">
                                        <div className="tet-st">
                                          {" "}
                                          <img
                                            src="assets/images/c8339885ab 3.png"
                                            alt=""
                                            className="w-t-25"
                                          />
                                          Platinum{" "}
                                        </div>
                                        <div className="lat-txt">
                                          Company's with own Brand & factory
                                          Brands that follow standard quality
                                          Mark{" "}
                                        </div>{" "}
                                      </td>
                                      <td className="bordering  px-4 py-2 px-py-t">
                                        <div className="tet-st">
                                          <img
                                            src="assets/images/c8339885ab 3.png"
                                            alt=""
                                            className="w-t-25"
                                          />{" "}
                                          Platinum <br />
                                        </div>
                                        <div className="lat-txt">
                                          Brands that follow standard quality
                                          guidelines with ISI Mark{" "}
                                        </div>
                                      </td>
                                      <td className="bordering  px-4 py-2 px-py-t text-center">
                                        36.00 Lakhs{" "}
                                        <button className="up-btn update">
                                          Update{" "}
                                          <img
                                            src="assets/images/update.png"
                                            alt=""
                                          />
                                        </button>
                                      </td>
                                    </tr>
                                    <tr className="ln-10">
                                      <td className="bordering  px-4 py-2 px-py-t">
                                        <div className="tet-st">
                                          <img
                                            src="assets/images/Gold Silver bronze coins 1.png"
                                            alt=""
                                            className="w-t-25"
                                          />{" "}
                                          Gold <br />
                                        </div>
                                        <div className="lat-txt">
                                          Company's with own Brand & factory
                                          Brands that follow standard quality
                                          Mark{" "}
                                        </div>{" "}
                                      </td>
                                      <td className="bordering  px-4 py-2 px-py-t">
                                        <div className="tet-st">
                                          {" "}
                                          <img
                                            src="assets/images/c8339885ab 3.png"
                                            alt=""
                                            className="w-t-25"
                                          />
                                          Platinum{" "}
                                        </div>
                                        <div className="lat-txt">
                                          Brands that follow standard quality
                                          guidelines with ISI Mark{" "}
                                        </div>{" "}
                                      </td>
                                      <td className="bordering  px-4 py-2 px-py-t text-center">
                                        36.00 Lakhs{" "}
                                        <button className="up-btn update">
                                          Update{" "}
                                          <img
                                            src="assets/images/update.png"
                                            alt=""
                                          />
                                        </button>
                                      </td>
                                    </tr>
                                    <tr className="ln-10">
                                      <td className="bordering  px-4 py-2 px-py-t">
                                        <div className="tet-st">
                                          <img
                                            src="assets/images/Gold Silver bronze coins 1.png"
                                            alt=""
                                            className="w-t-25"
                                          />{" "}
                                          Gold <br />
                                        </div>
                                        <div className="lat-txt">
                                          Company's with own Brand & factory
                                          Brands that follow standard quality
                                          Mark{" "}
                                        </div>{" "}
                                      </td>
                                      <td className="bordering  px-4 py-2 px-py-t">
                                        {" "}
                                        <div className="tet-st">
                                          <img
                                            src="assets/images/Gold Silver bronze coins 1.png"
                                            alt=""
                                            className="w-t-25"
                                          />{" "}
                                          Gold <br />
                                        </div>
                                        <div className="lat-txt">
                                          Brands that follow standard quality
                                          guidelines with ISI Mark{" "}
                                        </div>{" "}
                                      </td>
                                      <td className="bordering text-center  px-4 py-2 px-py-t">
                                        36.00 Lakhs{" "}
                                        <button className="up-btn update">
                                          Update{" "}
                                          <img
                                            src="assets/images/update.png"
                                            alt=""
                                          />
                                        </button>
                                      </td>
                                    </tr>
                                    <tr className="ln-10">
                                      <td className="bordering  px-4 py-2 px-py-t">
                                        <div className="tet-st">
                                          <img
                                            src="assets/images/Gold Silver bronze coins 7.png"
                                            alt=""
                                            className="w-t-25"
                                          />{" "}
                                          Silver <br />
                                        </div>
                                        <div className="lat-txt">
                                          Company's with own Brand & factory
                                          Brands that follow standard quality
                                          Mark{" "}
                                        </div>{" "}
                                      </td>
                                      <td className="bordering  px-4 py-2 px-py-t">
                                        <div className="tet-st">
                                          <img
                                            src="assets/images/Gold Silver bronze coins 1.png"
                                            alt=""
                                            className="w-t-25"
                                          />{" "}
                                          Gold <br />
                                        </div>
                                        <div className="lat-txt">
                                          Brands that follow standard quality
                                          guidelines with ISI Mark{" "}
                                        </div>{" "}
                                      </td>
                                      <td className="bordering text-center  px-4 py-2 px-py-t">
                                        36.00 Lakhs{" "}
                                        <button className="up-btn update">
                                          Update{" "}
                                          <img
                                            src="assets/images/update.png"
                                            alt=""
                                          />
                                        </button>
                                      </td>
                                    </tr>
                                    <tr className="ln-10">
                                      <td className="bordering  px-4 py-2 px-py-t">
                                        <div className="tet-st">
                                          <img
                                            src="assets/images/Gold Silver bronze coins 7.png"
                                            alt=""
                                            className="w-t-25"
                                          />{" "}
                                          Silver <br />
                                        </div>
                                        <div className="lat-txt">
                                          Company's with own Brand & factory
                                          Brands that follow standard quality
                                          Mark{" "}
                                        </div>{" "}
                                      </td>
                                      <td className="bordering  px-4 py-2 px-py-t">
                                        <div className="tet-st">
                                          <img
                                            src="assets/images/Gold Silver bronze coins 7.png"
                                            alt=""
                                            className="w-t-25"
                                          />{" "}
                                          Silver <br />
                                        </div>
                                        <div className="lat-txt">
                                          Brands that follow standard quality
                                          guidelines with ISI Mark{" "}
                                        </div>{" "}
                                      </td>
                                      <td className="bordering text-center  px-4 py-2 px-py-t">
                                        36.00 Lakhs{" "}
                                        <button className="up-btn update">
                                          Update{" "}
                                          <img
                                            src="assets/images/update.png"
                                            alt=""
                                          />
                                        </button>
                                      </td>
                                    </tr>
                                    <tr className="ln-10">
                                      <td className="bordering  px-4 py-2 px-py-t">
                                        &nbsp;
                                      </td>
                                      <td className="bordering  px-4 py-2 px-py-t">
                                        &nbsp;
                                      </td>
                                      <td className="bordering  px-4 py-2 px-py-t">
                                        &nbsp;
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                        {/* <button className="btn btn-secondary" onClick={() => setShow(false)}>
                      Close
                    </button> */}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          )}

          {show && (
            <div className={`modal-backdrop fade ${fade ? "show" : ""}`}></div>
          )}
        </div>
      </div>
    </>
  );
};

export default ProjectDetails;
