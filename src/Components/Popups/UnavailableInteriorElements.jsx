/* eslint-disable react/prop-types */
import Modal from "react-bootstrap/Modal";
import { envImgUrl } from "../../env/envImage";

const UnavailableInteriorElements = ({ open, onClose, elements }) => {
  const addData = elements ?? {};
  return (
    <Modal
      show={open}
      onHide={onClose}
      size="lg"
      className="ref-frnd support-customer mblCust"
      centered
      backdrop="static"
    >
      <Modal.Header
        closeButton
        className="customerCloseBtn supportClose"
        onClick={onClose}
      ></Modal.Header>

      <div className=" mt-tab-v">
        <div className="col-md-12">
          <div className="slider-quote" id="interiorEle">
            <div className="form-container1">
              <div className="kjhgf">
                <h1 className="addon-heading add-title">
                  Unavailable Interior Elements in Upgraded Classification
                </h1>
                <div className="note-txt d-flex justify-content-center align-items-center">
                  <div>
                    {" "}
                    <button className="note-but mr-2 ">Note</button>
                  </div>
                  <div>
                    <p className="m-0 finalTextP">
                      The following interior elements are not available in the
                      upgraded classification and these will not be added to
                      your quotation estimate. Please choose alternate elements
                      that are compatible with the updated classification.
                    </p>
                  </div>
                </div>

                {Object.keys(addData).map((item) => (
                  <>
                    <div className="add-btn" key={item}>
                      {item}
                    </div>
                    {Array.isArray(addData[item]?.tabs) &&
                      addData[item].tabs.length > 0 &&
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
                              <div className=" col-md-3 col-sm-6 mt-3" key={i}>
                                <div className="f-card">
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
                    {Array.isArray(addData[item]?.tabs) &&
                      addData[item].tabs.length === 0 && (
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
    </Modal>
  );
};

export default UnavailableInteriorElements;
