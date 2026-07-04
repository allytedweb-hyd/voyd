import { useState } from "react";
import OngoingPopup from "../Popups/OngoingPopup";
import CustomerSupport from "../Popups/CustomerSupport";
const InteriorServices = () => {
  const [onLoadPopup, setOnLoadPopup] = useState(false);
  const onCloseLoadPopup = () => {
    setOnLoadPopup(false);
  };
  const [customerSupport, setCustomerSupport] = useState(false);
  const closeCustomerSupport = () => {
    setCustomerSupport(false);
  };

  const handletokenBasedPopup = () => {
    let token = localStorage.getItem("token");
    if (token) {
      setCustomerSupport(true);
    } else {
      setOnLoadPopup(true);
    }
  };
  return (
    <>
      <section className="interiorServices">
        <div className="container">
          <div className="row parentRow">
            <div className="col-md-3 mobileView">
              <div className="serviceImage">
                <img
                  src="assets/images/serviceTitle.png"
                  alt=""
                  className="deskImage"
                />
                <img
                  src="assets/images/mblSliderImg.png"
                  alt=""
                  className="mobileImage"
                />
              </div>
            </div>
            <div className="col-md-9 mobileView">
              <div className="completeTextMbl">
                <h3>
                  Complete Interior <br /> Design{" "}
                  <button onClick={() => handletokenBasedPopup(true)}>
                    Support
                  </button>
                </h3>
              </div>
              <div className="row alignItems">
                <div className="col-md-3">
                  <div className="bootCampOuter">
                    <img
                      src="assets/images/bootcampBlur.png"
                      alt=""
                      className="bootcampBlurImg"
                    />
                    <div className="flip-card bootCampCard">
                      <div className="flip-card-inner">
                        <div className="flip-card-front">
                          <img src="assets/images/bootcamp.png" alt="" />
                          <h3>
                            PROJECT <br /> BOOTCAMP
                          </h3>
                          <p>T2-hour intro session</p>
                        </div>
                        <div className="flip-card-back">
                          <p>
                            Visit our Knowledge Center for insights on
                            material selection, product quality,
                            designer selection, sourcing, etc to
                            complete your dream home
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div className="automationOuter">
                    <img
                      src="assets/images/automationBlur.png"
                      alt=""
                      className="automationBlurImg"
                    />{" "}
                    <img
                      src="assets/images/poll3.png"
                      alt=""
                      className="automationImg"
                    />
                    <div className="flip-card automation">
                      <div className="flip-card-inner">
                        <div className="flip-card-front">
                          <img src="assets/images/automation.png" alt="" />
                          <h3>
                            HOME <br /> AUTOMATION
                          </h3>
                          <p>Smart home setup guide</p>
                        </div>
                        <div className="flip-card-back">
                          <p>
                            Access your home from anywhere. Enhance security, sync your apps, and create a smart home that changes your experience according to every mood.
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="col-md-6">
                  <div className="row">
                    <div className="col-md-6">
                      <div className="planningOuter">
                        <img
                          src="assets/images/planningBlur.png"
                          alt=""
                          className="planningBlurImg"
                        />
                        <img
                          src="assets/images/poll3.png"
                          alt=""
                          className="planningImg"
                        />
                        <div className="flip-card planning">
                          <div className="flip-card-inner">
                            <div className="flip-card-front">
                              <img
                                src="assets/images/planning.png"
                                alt=""
                                className="imgHeight"
                              />
                              <h3>
                                BUDGETING <br /> PLANNING
                              </h3>
                              <p>Personalized budget setup</p>
                            </div>
                            <div className="flip-card-back">
                              <p>
                                Budget Planning Software helps you control overspending, source materials cost-effectively, allocate budgets room-wise and complete dream home within budget.
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div className="col-md-6">
                      <div className="selectionOuter">
                        <img
                          src="assets/images/selectionBlur.png"
                          alt=""
                          className="selctionBlurImg"
                        />
                        <div className="flip-card selection">
                          <div className="flip-card-inner">
                            <div className="flip-card-front">
                              <img
                                src="assets/images/selectonn.png"
                                alt=""
                                className="imgHeight"
                              />
                              <h3>
                                DESIGNER <br /> SELECTION
                              </h3>
                              <p>Style-based designer match</p>
                            </div>
                            <div className="flip-card-back">
                              <p>
                                Major project failures happen due to wrong designer selection. Connect with our verified, skill-evaluated design partners for detailed discussions before you decide.
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div className="completeText">
                    <h3>
                      Complete <br /> <span>Interior</span> Design
                    </h3>
                    <button onClick={() => handletokenBasedPopup(true)}>
                      Support
                    </button>
                  </div>
                  <div className="row">
                    <div className="col-md-6">
                      <div className="marketPlaceOuter">
                        <img
                          src="assets/images/planningBlur.png"
                          alt=""
                          className="marketPlaceBlurImg"
                        />
                        <div className="flip-card marketPlace">
                          <div className="flip-card-inner">
                            <div className="flip-card-front">
                              <img
                                src="assets/images/marketplace.png"
                                alt=""
                                className="imgHeight"
                              />
                              <h3>
                                ONLINE DECOR <br /> MARKET PLACE
                              </h3>
                              <p>Shop exclusive decor deals</p>
                            </div>
                            <div className="flip-card-back">
                              <p>
                                Purchase trendy and durable decor items at affordable prices, sourced directly from manufacturers and skilled craftsmen.
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div className="col-md-6">
                      <div className="monitoringOuter">
                        <img
                          src="assets/images/monitoringBlur.png"
                          alt=""
                          className="monitoringBlurImg"
                        />
                        <img
                          src="assets/images/poll3.png"
                          alt=""
                          className="monitoringImg"
                        />
                        <div className="flip-card monitoring">
                          <div className="flip-card-inner">
                            <div className="flip-card-front">
                              <img src="assets/images/monitoring.png" alt="" />
                              <h3>
                                PROJECT <br /> MONITORING
                              </h3>
                              <p>Weekly Site Updates</p>
                            </div>
                            <div className="flip-card-back">
                              <p>
                                Track your project’s progress to spot issues early, prevent design and color errors, and stay fully transparent at every stage.
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="col-md-3">
                  <div className="finaliseOuter">
                    <img
                      src="assets/images/finaliseBlur.png"
                      alt=""
                      className="finaliseBlurImg"
                    />
                    <img
                      src="assets/images/poll3.png"
                      alt=""
                      className="finaliseImg"
                    />
                    <div className="flip-card finalisation">
                      <div className="flip-card-inner">
                        <div className="flip-card-front">
                          <img src="assets/images/finalisation.png" alt="" />
                          <h3>
                            DESIGN <br /> FINALIZATION
                          </h3>
                          <p>Final layout & material approval</p>
                        </div>
                        <div className="flip-card-back">
                          <p>
                            Finalize your designs by going beyond 2D & 3D mockups. Experience proposed designs virtually, get detail view of every aspect to confidently finalize your designs
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div className="inspectOuter">
                    <img
                      src="assets/images/inspectionBlur.png"
                      alt=""
                      className="inspectBlurImg"
                    />
                    <div className="flip-card inspection">
                      <div className="flip-card-inner">
                        <div className="flip-card-front">
                          <img src="assets/images/inspection.png" alt="" />
                          <h3>
                            PROPERTY <br /> INSPECTION
                          </h3>
                          <p>On-site space check</p>
                        </div>
                        <div className="flip-card-back">
                          <p>
                            Strong walls, quality wiring, and proper internal piping are the foundation of durable interiors. Inspect your property and fix issues before they damage your interiors
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <OngoingPopup
        openOnLoadPopup={onLoadPopup}
        onCloseLoadPopup={onCloseLoadPopup}
      />
      <CustomerSupport
        openCustomerSupport={customerSupport}
        closeCustomerSupport={closeCustomerSupport}
      />
    </>
  );
};
export default InteriorServices;
