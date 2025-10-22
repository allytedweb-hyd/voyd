import React, { useState } from "react";
import { IoClose } from "react-icons/io5";
import { Tab, Tabs, TabList, TabPanel } from "react-tabs";
import "react-tabs/style/react-tabs.css";
const Cotation = () => {
  const [show, setShow] = useState(false);
  const [activeTab, setActiveTab] = useState("London");

  const openCity = (cityName) => {
    setActiveTab(cityName);
  };
  const [activeTab2, setActiveTab2] = useState("London2");

  const openCity2 = (cityName2) => {
    setActiveTab2(cityName2);
  };
  const handleShow = () => setShow(true);
  const handleClose = () => setShow(false);
  return (
    <div>
      <section className="leafs-bg ">
        <div className="row backdrop">
          <div className="col-lg-6 col-md-6 col-sm-12">
            <h1 className="quote-hdng text-start">YOUR QUOTATION</h1>
            <p className="text-light quote-p text-start">
              * Finalized- Click to freeze the Project (willing to proceed
              further to start the Project) <br />
              *View- Click anywhere on the particular row to view particular
              quotation
            </p>
          </div>
          <div className="col-md-6 d-flex justify-content-end">
            <div>
              <button
                className="quote-but"
                type="button"
                data-toggle="modal"
                data-target="#exampleModalCenter"
              >
                Request A Quote
              </button>
            </div>
            <div className="width-img d-flex align-items-center">
              <img src="assets/images/Group 3455.png" alt="" />
            </div>
          </div>
        </div>
      </section>

      <section className="mb-4">
        <div className="container borderr">
          <div className="row justify-content-center pt-2">
            <div className="d-flex justify-content-center">
              <button className="quote-draft ">
                <span className="quote-button">Quotations</span>{" "}
                <span className="draft-but">Drafts</span>
              </button>
            </div>
          </div>
          <div className="table-responsive">
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
                <tr>
                  <th scope="row" className="text-center">
                    #20462
                  </th>
                  <td>Hat</td>
                  <td>Matt Dickerson</td>
                  <td>Type 1</td>
                  <td>+44 567884225</td>
                  <td>13/05/2022</td>
                  <td className="text-center">
                    <button className="final-but">finalized</button>
                  </td>
                </tr>
                <tr>
                  <th scope="row" className="text-center">
                    #20462
                  </th>
                  <td>Rouger</td>
                  <td>Matt Dickerson</td>
                  <td>Type 1</td>
                  <td>+44 567884225</td>
                  <td>13/05/2022</td>
                  <td className="text-center">
                    <button className="final-but">finalized</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div className="note-txt d-flex justify-content-center align-items-center">
            <div>
              {" "}
              <button className="note-but mr-2 ">note</button>
            </div>
            <div>
              <p className="m-0">
                Final Projects will taking further and rest of the projeck will
                be deleted after 30 days
              </p>
            </div>
          </div>
        </div>
      </section>

      {/* quote modal body */}

      <div
        className="modal fade"
        id="exampleModalCenter"
        tabIndex="-1"
        role="dialog"
        aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true"
      >
        <div className="modal-dialog modalDialogOuter " role="document">
          {/* <div className="modalDialogOuter" role="document"> */}
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
      </div>
    </div>
  );
};

export default Cotation;
