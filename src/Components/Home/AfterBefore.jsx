import {
  ReactCompareSlider,
  ReactCompareSliderImage,
} from "react-compare-slider";
import { Link, useNavigationType } from "react-router-dom";
import { FaAnglesRight } from "react-icons/fa6";
import { FaAnglesLeft } from "react-icons/fa6";
import { useEffect } from "react";
// import { useState } from "react";

const AfterBefore = () => {

  const navigationType = useNavigationType();


  const handleSectionClick = (sectionId) => {
    sessionStorage.setItem("scrollToSection", sectionId);
  };

  // useEffect(() => {
  //   const sectionId = sessionStorage.getItem("scrollToSection");

  //   if (sectionId) {
  //     const el = document.getElementById(sectionId);
  //     console.log("elemet to scroll is==", el);
  //     if (el) {
  //       el.scrollIntoView({ behavior: "smooth" });

  //       Optional: clear it so it doesn't scroll again on next visit
  //       setTimeout(() => {
  //         sessionStorage.removeItem("scrollToSection");
  //       }, 5000);
  //       sessionStorage.removeItem("scrollToSection");
  //     }
  //   }
  // }, []);

  useEffect(() => {
    if (navigationType === "PUSH") {
      // Only run scroll on fresh navigation, not back/forward
      const sectionId = sessionStorage.getItem("scrollToSection");
      if (sectionId) {
        const el = document.getElementById(sectionId);
        if (el) {
          el.scrollIntoView({ behavior: "smooth" });
        }
        sessionStorage.removeItem("scrollToSection");
      }
    }
  }, [navigationType]);


  return (
    <>
      <section className="scrollSection bg-roles scroll-tab scrl-mble">
        <div className="container">
          <div className="layer-effect"></div>
          <div className="row">
            <div className="d-flex justify-content-center  w-100">
              <div>
                <h2 className="creation-txtd fnt-see  mt-6">
                  See What We Can Do
                </h2>{" "}
              </div>
            </div>
            <div className="complir_sec w-100 layer">
              <h3 className="slideText">
                <FaAnglesLeft /> Slide <FaAnglesRight />
              </h3>
              <ReactCompareSlider
                className="layerSubBlock"
                changePositionOnHover={false}
                itemTwo={
                  <ReactCompareSliderImage
                    src="assets/images/Group 1618874023.png"
                    srcSet="assets/images/before new.png"
                    alt="Image one"
                  />
                }
                itemOne={
                  <ReactCompareSliderImage
                    src="assets/images/Group 1618874024.png"
                    srcSet="assets/images/TANGO-AFTER.png"
                    alt="Image two"
                  />
                }
              />
            </div>{" "}
          </div>

          <div className="get-border get-b">
            <button className="gradientt-button grad-mbl">
              Explore <span className="gradientt-text">Digital</span> Experience
            </button>
          </div>
          <div className="row counter-div count-b shiftBtns">
            <div
              className="col-md-3 col-sm-6 text-center"
              id="requirementGathering"
            >
              <Link
                to="/designchange"
                state={{ section: "requirement" }}
                onClick={() => handleSectionClick("requirementGathering")}
              >
                <div className="cursor-pointer">
                  <div className="nummm-text  ">Requirement Gathering</div>
                </div>
              </Link>
            </div>
            <div className="col-md-3 col-sm-6 text-center" id="twoDDesign">
              <Link
                to="/designchange"
                state={{ section: "develop" }}
                onClick={() => handleSectionClick("twoDDesign")}
              >
                <div className="cursor-pointer">
                  <div className="nummm-text  ">Develop a 2D Design</div>
                </div>
              </Link>
            </div>

            <div
              className="col-md-3 col-sm-6 text-center"
              id="developThreeDesign"
            >
              <Link
                to="/designchange"
                state={{ section: "experience" }}
                onClick={() => handleSectionClick("developThreeDesign")}
              >
                <div className="cursor-pointer">
                  <div className="nummm-text  ">Develop a 3D Design</div>
                </div>
              </Link>
            </div>
            <div
              className="col-md-3 col-sm-6 text-center"
              id="getSiteExperience"
            >
              <Link
                to="/designchange"
                state={{ section: "site" }}
                onClick={() => handleSectionClick("getSiteExperience")}
              >
                <div className="cursor-pointer">
                  <div className="nummm-text  ">Get Site Experience</div>
                </div>
              </Link>
            </div>
          </div>
        </div>
        <div className="girlyDiv girly-phn">
          <img src="assets/images/scrollGirl.png" alt="" className="girlyImg" />
        </div>
      </section>
    </>
  );
};

export default AfterBefore;
