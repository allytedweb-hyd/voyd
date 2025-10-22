import { useState } from "react";
import Modal from "react-bootstrap/Modal";
// import { toast } from "sonner";
import Sonner from "../Toaster/Sonner";
import Loader from "../Spinner/Loader";
import { Tab, Tabs, TabList, TabPanel } from "react-tabs";
import "react-tabs/style/react-tabs.css";

const Classification = ({ openClassification, closeClassification }) => {
  const [loading] = useState(false);
  return (
    <>
      {" "}
      {loading && <Loader />}
      <Modal
        show={openClassification}
        onHide={closeClassification}
        size="lg"
        className="ref-frnd support-customer classification"
        centered
        backdrop="static"
      >
        <Modal.Header
          closeButton
          className="customerCloseBtn supportClose"
        ></Modal.Header>
        <div className="classificationOuter">
          <div className="firstBlock">
            <div className="leftLeaf">
              {" "}
              <img src="assets/images/topLeftL.png" alt="" />
            </div>
            <div className="rightLeaf">
              <img src="assets/images/topRightL.png" alt="" />
            </div>
            <h2>
              Save More with Good <span>Plans</span>
            </h2>
            <p className="projectCost">
              Project cost = Material cost + Making cost
            </p>
          </div>
          <div className="secondBlock">
            <Tabs>
              <TabList>
                <li className="ribbon">Classification Levels</li>
                <Tab>
                  {" "}
                  <img
                    className="diamond"
                    src="assets/images/tabClass1.png"
                    alt=""
                  />{" "}
                  Diamond
                </Tab>
                <Tab>
                  <img
                    className="platinum"
                    src="assets/images/tabClass2.png"
                    alt=""
                  />{" "}
                  Platinum
                </Tab>
                <Tab>
                  <img
                    className="gold"
                    src="assets/images/tabClass3.png"
                    alt=""
                  />{" "}
                  Gold
                </Tab>
                <Tab>
                  <img
                    className="silver"
                    src="assets/images/tabClass4.png"
                    alt=""
                  />{" "}
                  Silver
                </Tab>
                <Tab>
                  <img
                    className="bronze"
                    src="assets/images/tabClass5.png"
                    alt=""
                  />{" "}
                  Bronze
                </Tab>
              </TabList>

              <TabPanel>
                <div className="tabContent">
                  <div className="row">
                    <div className="col-md-6">
                      <h3>Material Classification</h3>
                      <p className="borderText">
                        Material Grades defined by quality, brand & cost
                      </p>
                      <div className="luxuryBlock">
                        <h4>premium & luxury</h4>
                        <p>
                          Experienced people who handle the trunk projects for a{" "}
                          <br />
                          high value projects like above 2 CR
                        </p>
                      </div>
                      <div className="luxuryBlock">
                        <h4>5000 - 8000 per SFT</h4>
                        <p>
                          Experienced people who handle the trunk projects for a{" "}
                          <br />
                          high value projects like above 2 CR
                        </p>
                      </div>
                      <div className="luxuryBlock">
                        <h4>
                          Durability / warranty <span>2 Years</span>
                        </h4>
                      </div>
                    </div>
                    <div className="col-md-6">
                      <h3>Designer Classification</h3>
                      <p className="borderText">
                        Designer Grades defined by Skill, Factory Unit & Charges
                      </p>
                      <div className="luxuryBlock">
                        <h4>premium & luxury</h4>
                        <p>
                          Experienced people who handle the trunk projects for a{" "}
                          <br />
                          high value projects like above 2 CR
                        </p>
                      </div>
                      <div className="luxuryBlock">
                        <h4>5000 - 8000 per SFT</h4>
                        <p>
                          Experienced people who handle the trunk projects for a{" "}
                          <br />
                          high value projects like above 2 CR
                        </p>
                      </div>
                      <div className="luxuryBlock">
                        <h4>
                          Durability / warranty <span>2 Years</span>
                        </h4>
                      </div>
                    </div>
                  </div>
                </div>
                {/* <div className="dontShowBtns">
                  <form action="">
                    <input type="checkbox" />
                    <label htmlFor="text">Don’t show me this again</label>
                    <button type="button">Okay</button>
                  </form>
                </div> */}
              </TabPanel>
              <TabPanel>
                <div className="tabContent">
                  <div className="row">
                    <div className="col-md-6">
                      <h3>Material Classification</h3>
                      <p className="borderText">
                        Material Grades defined by quality, brand & cost
                      </p>
                      <div className="luxuryBlock">
                        <h4>premium & luxury</h4>
                        <p>
                          Experienced people who handle the trunk projects for a{" "}
                          <br />
                          high value projects like above 2 CR
                        </p>
                      </div>
                      <div className="luxuryBlock">
                        <h4>5000 - 8000 per SFT</h4>
                        <p>
                          Experienced people who handle the trunk projects for a{" "}
                          <br />
                          high value projects like above 2 CR
                        </p>
                      </div>
                      <div className="luxuryBlock">
                        <h4>
                          Durability / warranty <span>2 Years</span>
                        </h4>
                      </div>
                    </div>
                    <div className="col-md-6">
                      <h3>Designer Classification</h3>
                      <p className="borderText">
                        Designer Grades defined by Skill, Factory Unit & Charges
                      </p>
                      <div className="luxuryBlock">
                        <h4>premium & luxury</h4>
                        <p>
                          Experienced people who handle the trunk projects for a{" "}
                          <br />
                          high value projects like above 2 CR
                        </p>
                      </div>
                      <div className="luxuryBlock">
                        <h4>5000 - 8000 per SFT</h4>
                        <p>
                          Experienced people who handle the trunk projects for a{" "}
                          <br />
                          high value projects like above 2 CR
                        </p>
                      </div>
                      <div className="luxuryBlock">
                        <h4>
                          Durability / warranty <span>2 Years</span>
                        </h4>
                      </div>
                    </div>
                  </div>
                </div>
                {/* <div className="dontShowBtns">
                  <form action="">
                    <input type="checkbox" />
                    <label htmlFor="text">Don’t show me this again</label>
                    <button type="button">Okay</button>
                  </form>
                </div> */}
              </TabPanel>
              <TabPanel>
                <div className="tabContent">
                  <div className="row">
                    <div className="col-md-6">
                      <h3>Material Classification</h3>
                      <p className="borderText">
                        Material Grades defined by quality, brand & cost
                      </p>
                      <div className="luxuryBlock">
                        <h4>premium & luxury</h4>
                        <p>
                          Experienced people who handle the trunk projects for a{" "}
                          <br />
                          high value projects like above 2 CR
                        </p>
                      </div>
                      <div className="luxuryBlock">
                        <h4>5000 - 8000 per SFT</h4>
                        <p>
                          Experienced people who handle the trunk projects for a{" "}
                          <br />
                          high value projects like above 2 CR
                        </p>
                      </div>
                      <div className="luxuryBlock">
                        <h4>
                          Durability / warranty <span>2 Years</span>
                        </h4>
                      </div>
                    </div>
                    <div className="col-md-6">
                      <h3>Designer Classification</h3>
                      <p className="borderText">
                        Designer Grades defined by Skill, Factory Unit & Charges
                      </p>
                      <div className="luxuryBlock">
                        <h4>premium & luxury</h4>
                        <p>
                          Experienced people who handle the trunk projects for a{" "}
                          <br />
                          high value projects like above 2 CR
                        </p>
                      </div>
                      <div className="luxuryBlock">
                        <h4>5000 - 8000 per SFT</h4>
                        <p>
                          Experienced people who handle the trunk projects for a{" "}
                          <br />
                          high value projects like above 2 CR
                        </p>
                      </div>
                      <div className="luxuryBlock">
                        <h4>
                          Durability / warranty <span>2 Years</span>
                        </h4>
                      </div>
                    </div>
                  </div>
                </div>
                {/* <div className="dontShowBtns">
                  <form action="">
                    <input type="checkbox" />
                    <label htmlFor="text">Don’t show me this again</label>
                    <button type="button">Okay</button>
                  </form>
                </div> */}
              </TabPanel>
              <TabPanel>
                <div className="tabContent">
                  <div className="row">
                    <div className="col-md-6">
                      <h3>Material Classification</h3>
                      <p className="borderText">
                        Material Grades defined by quality, brand & cost
                      </p>
                      <div className="luxuryBlock">
                        <h4>premium & luxury</h4>
                        <p>
                          Experienced people who handle the trunk projects for a{" "}
                          <br />
                          high value projects like above 2 CR
                        </p>
                      </div>
                      <div className="luxuryBlock">
                        <h4>5000 - 8000 per SFT</h4>
                        <p>
                          Experienced people who handle the trunk projects for a{" "}
                          <br />
                          high value projects like above 2 CR
                        </p>
                      </div>
                      <div className="luxuryBlock">
                        <h4>
                          Durability / warranty <span>2 Years</span>
                        </h4>
                      </div>
                    </div>
                    <div className="col-md-6">
                      <h3>Designer Classification</h3>
                      <p className="borderText">
                        Designer Grades defined by Skill, Factory Unit & Charges
                      </p>
                      <div className="luxuryBlock">
                        <h4>premium & luxury</h4>
                        <p>
                          Experienced people who handle the trunk projects for a{" "}
                          <br />
                          high value projects like above 2 CR
                        </p>
                      </div>
                      <div className="luxuryBlock">
                        <h4>5000 - 8000 per SFT</h4>
                        <p>
                          Experienced people who handle the trunk projects for a{" "}
                          <br />
                          high value projects like above 2 CR
                        </p>
                      </div>
                      <div className="luxuryBlock">
                        <h4>
                          Durability / warranty <span>2 Years</span>
                        </h4>
                      </div>
                    </div>
                  </div>
                </div>
                {/* <div className="dontShowBtns">
                  <form action="">
                    <input type="checkbox" />
                    <label htmlFor="text">Don’t show me this again</label>
                    <button type="button">Okay</button>
                  </form>
                </div> */}
              </TabPanel>
              <TabPanel>
                <div className="tabContent">
                  <div className="row">
                    <div className="col-md-6">
                      <h3>Material Classification</h3>
                      <p className="borderText">
                        Material Grades defined by quality, brand & cost
                      </p>
                      <div className="luxuryBlock">
                        <h4>premium & luxury</h4>
                        <p>
                          Experienced people who handle the trunk projects for a{" "}
                          <br />
                          high value projects like above 2 CR
                        </p>
                      </div>
                      <div className="luxuryBlock">
                        <h4>5000 - 8000 per SFT</h4>
                        <p>
                          Experienced people who handle the trunk projects for a{" "}
                          <br />
                          high value projects like above 2 CR
                        </p>
                      </div>
                      <div className="luxuryBlock">
                        <h4>
                          Durability / warranty <span>2 Years</span>
                        </h4>
                      </div>
                    </div>
                    <div className="col-md-6">
                      <h3>Designer Classification</h3>
                      <p className="borderText">
                        Designer Grades defined by Skill, Factory Unit & Charges
                      </p>
                      <div className="luxuryBlock">
                        <h4>premium & luxury</h4>
                        <p>
                          Experienced people who handle the trunk projects for a{" "}
                          <br />
                          high value projects like above 2 CR
                        </p>
                      </div>
                      <div className="luxuryBlock">
                        <h4>5000 - 8000 per SFT</h4>
                        <p>
                          Experienced people who handle the trunk projects for a{" "}
                          <br />
                          high value projects like above 2 CR
                        </p>
                      </div>
                      <div className="luxuryBlock">
                        <h4>
                          Durability / warranty <span>2 Years</span>
                        </h4>
                      </div>
                    </div>
                  </div>
                </div>
                {/* <div className="dontShowBtns">
                  <form action="">
                    <input type="checkbox" />
                    <label htmlFor="text">Don’t show me this again</label>
                    <button type="button">Okay</button>
                  </form>
                </div> */}
              </TabPanel>
            </Tabs>
            <div className="dontShowBtns">
              <form action="">
                {/* <input type="checkbox" />
                <label htmlFor="text">Don’t show me this again</label> */}
                <button type="button" onClick={closeClassification}>
                  Okay
                </button>
              </form>
            </div>
          </div>
        </div>
      </Modal>
      <Sonner />
    </>
  );
};
export default Classification;
