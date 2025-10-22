/* eslint-disable react/prop-types */
import "lightbox.js-react/dist/index.css";
import { envImgUrl } from "../../env/envImage";
import { useEffect, useState } from "react";
import { RiCloseCircleFill } from "react-icons/ri";

const InteriorElementsAddOns = ({ totalAddons, onRemoveElement }) => {
  console.log("interior ele addons===", totalAddons);
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
  console.log("heree add ons data is--------", totalAddons);

  return (
    <>
      {/* <div className="sidebar-contact" id="interiorEleContainer">
        <div className="interior-ele-toggle" id="interiorEleBtn">
          <button onClick={SlidingInteriorEle}>Add-On&apos;s</button>
        </div>
        <div className="col-md-12">
          <div className="slider-quote" id="interiorEle">
            <div className="form-container1">
              <h1 className="addon-heading">Interior Elements Add ons</h1>
              {Object.keys(addData).map((item) => (
                <div key={item} className="interior-ele-listing">
                  <p className="interior-property-title">{item}</p>
                  <div className="interior-elements-main-card">
                    {addData[item].tabs.length > 0 &&
                      addData[item].tabs.map((element, index) => (
                        <>
                          <div key={item} className="interior-ele-listing">
                            <p className="interior-property-title addon">
                              {item + "-" + (index + 1)}
                            </p>
                            <div className="listtt">
                              {element.map((ele, i) => (
                                <>
                                  <div className="interior-ele-card" key={i}>
                                    <div
                                      className="questionnair-cat-image drag"
                                      id=""
                                    >
                                      <SlideshowLightbox className="card-lightbox">
                                        <img
                                          src={
                                            envImgUrl +
                                            "/Uploads/elements/" +
                                            ele.element_image
                                          }
                                          alt=""
                                          className="questionnair-img-drag"
                                        />
                                      </SlideshowLightbox>
                                      <MdDeleteOutline className="close-form-drag" />
                                      <h6 className="mt-2 mb-1 drag">
                                        {ele?.element_alttext}
                                      </h6>
                                    </div>
                                  </div>
                                </>
                              ))}
                            </div>
                          </div>
                        </>
                      ))}
                    {addData[item].tabs.length == 0 && (
                      <div className="container">
                        <div className="row">
                          <div className="result-container">
                            <img src="assets/images/no-element.jpg" alt="" />
                          </div>
                        </div>
                      </div>
                    )}
                  </div>
                </div>
              ))}
            </div>
          </div>
        </div>
      </div> */}

      {/* old version end */}

      <div className="sidebar-contact" id="interiorEleContainer">
        <div className="interior-ele-toggle" id="interiorEleBtn">
          <button onClick={SlidingInteriorEle}>Add-On&apos;s</button>
        </div>
        <div className=" mt-tab-v">
          <div className="col-md-12">
            <div className="slider-quote" id="interiorEle">
              <div className="form-container1 sliderItems">
                <div className="kjhgf">
                  <h1 className="addon-heading add-title">
                    Interior Elements Add ons
                  </h1>

                  {Object.keys(addData).map((item) => (
                    <>
                      <div className="add-btn subOnes" key={item}>
                        {item}
                      </div>
                      {addData[item].tabs.length > 0 &&
                        addData[item].tabs.map((element, index) => (
                          <>
                            <div className="f-btn-adj" key={index}>
                              <button className="v-price1">
                                {" "}
                                {item + "-" + (index + 1)}
                              </button>
                            </div>
                            <div className="row f-row">
                              {element.map((ele, i) => (
                                <div
                                  className=" col-md-3 col-sm-6 mt-3"
                                  key={i}
                                >
                                  <div className="f-card">
                                    <button
                                      className="close-f-btn close-l"
                                      type="button"
                                      onClick={() => onRemoveElement(ele)}
                                    >
                                      <RiCloseCircleFill />
                                    </button>
                                    <div className="l-imgss">
                                      <img
                                        src={
                                          envImgUrl +
                                          "/Uploads/elements/" +
                                          ele.element_image
                                        }
                                        alt={ele?.element_alttext}
                                        className="f-img"
                                      />
                                    </div>
                                    <div className="f-details">
                                      {`${ele?.element_name_display}/${ele?.model}`}
                                    </div>
                                    <div className="f-desc">
                                      Qty:{ele?.eleQtyPerBlock}|sft:
                                      {ele?.eleSft}
                                    </div>
                                  </div>
                                </div>
                              ))}
                              {element.length == 0 && (
                                <div className="container">
                                  <div className="row">
                                    <div className="result-container conditionImg">
                                      <img
                                        src="assets/images/noDataFound.png"
                                        alt=""
                                      />
                                    </div>
                                  </div>
                                </div>
                              )}
                            </div>
                          </>
                        ))}
                      {addData[item].tabs.length == 0 && (
                        <div className="container">
                          <div className="row">
                            <div className="result-container conditionImg">
                              <img src="assets/images/noDataFound.png" alt="" />
                            </div>
                          </div>
                        </div>
                      )}
                    </>
                  ))}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </>
  );
};

export default InteriorElementsAddOns;
