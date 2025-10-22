import { Tab, Tabs, TabList, TabPanel } from "react-tabs";
import "react-tabs/style/react-tabs.css";
import { FaChevronRight } from "react-icons/fa";
import { FaAnglesRight } from "react-icons/fa6";

const Handover = () => {
  return (
    <>
      <section className="handoverSection">
        <div className="container">
          <h2>
            Budget Planning to <span>Handover</span>
          </h2>
          <Tabs className="handoverTabs desktopVersion">
            <TabList>
              <Tab>1. Cost Planning</Tab> <FaChevronRight />
              <Tab>2. Finalize the Design Firm</Tab> <FaChevronRight />
              <Tab>3. Design Planning & Visualization</Tab> <FaChevronRight />
              <Tab>4. Project Monitoring</Tab> <FaChevronRight />
              <Tab>5. Handover</Tab>
            </TabList>

            <TabPanel>
              <div className="row">
                <div className="col-md-5">
                  <div className="tabPoints">
                    <ul>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Room wise cost planning
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Essentials and luxury elements
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Full interior + appliances + furniture + decor cost
                      </li>
                    </ul>
                  </div>
                </div>
                <div className="col-md-7">
                  <div className="handoverImg">
                    <img src="assets/images/handover1.png" alt="" />
                  </div>
                </div>
              </div>
            </TabPanel>
            <TabPanel>
              <div className="row">
                <div className="col-md-5">
                  <div className="tabPoints">
                    <ul>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Connect with verified interior vendors
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Define your design requirement
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Confirm the cost and timeline
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Kick start the project
                      </li>
                    </ul>
                  </div>
                </div>
                <div className="col-md-7">
                  <div className="handoverImg">
                    <img src="assets/images/handover2.png" alt="" />
                  </div>
                </div>
              </div>
            </TabPanel>
            <TabPanel>
              <div className="row">
                <div className="col-md-5">
                  <div className="tabPoints">
                    <ul>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Choose designs from modern catalogue
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Visualize space with 2D layout
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Experience future home in 3D
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Get the real time experience
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Finalize the design
                      </li>
                    </ul>
                  </div>
                </div>
                <div className="col-md-7">
                  <div className="handoverImg">
                    <img src="assets/images/handover3.png" alt="" />
                  </div>
                </div>
              </div>
            </TabPanel>
            <TabPanel>
              <div className="row">
                <div className="col-md-5">
                  <div className="tabPoints">
                    <ul>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Pre-build inspection
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Material quality checks
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Monitor daily progress
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Weakly reporting
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Labour attendance tracking
                      </li>
                    </ul>
                  </div>
                </div>
                <div className="col-md-7">
                  <div className="handoverImg">
                    <img src="assets/images/handover4.png" alt="" />
                  </div>
                </div>
              </div>
            </TabPanel>
            <TabPanel>
              <div className="row">
                <div className="col-md-5">
                  <div className="tabPoints">
                    <ul>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Final inspections
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Fix any correction / damages
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Professional cleaning & shining
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Project completion signoff
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Initiate 2 years service warranty
                      </li>
                    </ul>
                  </div>
                </div>
                <div className="col-md-7">
                  <div className="handoverImg">
                    <img src="assets/images/handover5.png" alt="" />
                  </div>
                </div>
              </div>
            </TabPanel>
          </Tabs>
          <Tabs className="handoverTabs mobileVersion">
            <TabList>
              <Tab>
                <div> 1</div> <FaChevronRight />
                {/* <FaAnglesRight /> */}
              </Tab>
              <Tab>
                <div>2</div> <FaChevronRight />
                {/* <FaAnglesRight /> */}
              </Tab>
              <Tab>
                <div>3</div> <FaChevronRight />
                {/* <FaAnglesRight /> */}
              </Tab>
              <Tab>
                <div>4</div> <FaChevronRight />
                {/* <FaAnglesRight /> */}
              </Tab>
              <Tab>
                <div>5</div>
              </Tab>
            </TabList>

            <TabPanel>
              <div className="row">
                <h3 className="tabTitleHeading">
                  Cost <span>Planning</span>
                </h3>
                <div className="col-md-5">
                  <div className="tabPoints">
                    <ul>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Room wise cost planning
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Essentials and luxury elements
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Full interior + appliances + furniture + decor cost
                      </li>
                    </ul>
                  </div>
                </div>
                <div className="col-md-7">
                  <div className="handoverImg">
                    <img src="assets/images/handover1.png" alt="" />
                  </div>
                </div>
              </div>
            </TabPanel>
            <TabPanel>
              <div className="row">
                <h3 className="tabTitleHeading">
                  Finalize the <span>Design</span> Firm
                </h3>
                <div className="col-md-5">
                  <div className="tabPoints">
                    <ul>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Connect with verified interior vendors
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Define your design requirement
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Confirm the cost and timeline
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Kick start the project
                      </li>
                    </ul>
                  </div>
                </div>
                <div className="col-md-7">
                  <div className="handoverImg">
                    <img src="assets/images/handover2.png" alt="" />
                  </div>
                </div>
              </div>
            </TabPanel>
            <TabPanel>
              <div className="row">
                <h3 className="tabTitleHeading">
                  Design Planning & <span>Visualization</span>
                </h3>
                <div className="col-md-5">
                  <div className="tabPoints">
                    <ul>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Choose designs from modern catalogue
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Visualize space with 2D layout
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Experience future home in 3D
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Get the real time experience
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Finalize the design
                      </li>
                    </ul>
                  </div>
                </div>
                <div className="col-md-7">
                  <div className="handoverImg">
                    <img src="assets/images/handover3.png" alt="" />
                  </div>
                </div>
              </div>
            </TabPanel>
            <TabPanel>
              <div className="row">
                <h3 className="tabTitleHeading">
                  Project <span>Monitoring</span>
                </h3>
                <div className="col-md-5">
                  <div className="tabPoints">
                    <ul>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Pre-build inspection
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Material quality checks
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Monitor daily progress
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Weakly reporting
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Labour attendance tracking
                      </li>
                    </ul>
                  </div>
                </div>
                <div className="col-md-7">
                  <div className="handoverImg">
                    <img src="assets/images/handover4.png" alt="" />
                  </div>
                </div>
              </div>
            </TabPanel>
            <TabPanel>
              <div className="row">
                <h3 className="tabTitleHeading">
                  <span>Handover</span>
                </h3>
                <div className="col-md-5">
                  <div className="tabPoints">
                    <ul>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Final inspections
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Fix any correction / damages
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Professional cleaning & shining
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Project completion signoff
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Project completion signoff
                      </li>
                      <li>
                        <img src="assets/images/tick.png" alt="" />
                        Initiate 2 years service warranty
                      </li>
                    </ul>
                  </div>
                </div>
                <div className="col-md-7">
                  <div className="handoverImg">
                    <img src="assets/images/handover5.png" alt="" />
                  </div>
                </div>
              </div>
            </TabPanel>
          </Tabs>
        </div>
      </section>
    </>
  );
};
export default Handover;
