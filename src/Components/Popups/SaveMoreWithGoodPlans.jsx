/* eslint-disable react/prop-types */
import { useState } from "react";
import { environmentUrl } from "../../env/enviroment";
import { useEffect } from "react";
import { envImgUrl } from "../../env/envImage";

const SaveMoreWithGoodPlans = ({
  open,
  close,
  saveMoreGoodPlans,
  makersClassification,
  materialClassification,
}) => {
  const [saveMorePlans, setSaveMorePlans] = useState([]);
  const getAllPlans = async () => {
    const apiUrl = `${environmentUrl}/questionnaire/get_good_plans.php`;
    const option = {
      method: "GET",
      headers: {
        Authorization: "Bearer " + localStorage.getItem("token"),
      },
    };
    const response = await (await fetch(apiUrl, option)).json();
    console.log("response is=====", response);
    if (response.status) {
      setSaveMorePlans(response?.response);
    }
  };

  const handleUpdatePlans = async (plan) => {
    console.log("plan info===", plan);
    saveMoreGoodPlans(plan);
  };

  useEffect(() => {
    getAllPlans();
  }, []);

  return (
    <>
      <div
        className={`modal fade ${open ? "show" : ""}`}
        tabIndex="-1"
        style={{ display: open ? "block" : "none" }}
      >
        <div className="modal-dialog modal-dialog-centered custom-modal-width2 upgradationPopup">
          <div className="modal-content mc-adju2 bg-lt-grey ">
            <div className="modal-body p-0 brdr-30">
              <div className="card border-none ">
                <div className="card-body bg-lt-grey text-center p-0">
                  <div>
                    <div>
                      <div className="row"></div>
                      <div className="">
                        <div>
                          <button
                            type="button"
                            className="btn-close close-b"
                            onClick={close}
                          >
                            <img
                              src="assets/images/Group 1618873579.png"
                              alt=""
                            />
                          </button>
                        </div>
                        <div className="leaf-brdr">
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
                        <div className="overflowScroll planUpgrade">
                          <div>
                            <table className="min-w-full border border-gray-300 border-collapse">
                              <thead>
                                <tr className="bg-gray-200">
                                  <th className="bordering2  padd-tab px-py-t">
                                    Material Classification
                                  </th>
                                  <th className="bordering2  padd-tab px-py-t">
                                    Maker Classification
                                  </th>

                                  <th className="bordering2  padd-tab px-py-t">
                                    Approx. Project cost{" "}
                                  </th>
                                </tr>
                              </thead>
                              <tbody>
                                {saveMorePlans?.map((item, index) => (
                                  <tr className="ln-10" key={index}>
                                    <td className="bordering border border-gray-300  px-4 py-2 px-py-t">
                                      <div className="mkr-div">
                                        <div className="tet-st">
                                          <img
                                            src={`${envImgUrl}/Uploads/classifications/${item?.material_icon}`}
                                            alt=""
                                            className="w-t-25"
                                          />{" "}
                                        </div>
                                        <div className="materialFrm">
                                          {item?.material_class}
                                        </div>
                                      </div>
                                      <div
                                        className="lat-txt"
                                        title={item?.material_text}
                                      >
                                        {item?.material_text}
                                      </div>
                                    </td>
                                    <td className="bordering border border-gray-300  px-4 py-2 px-py-t">
                                      <div className="mkr-div">
                                        <div className="tet-st">
                                          {" "}
                                          <img
                                            src={`${envImgUrl}/Uploads/classifications/${item?.maker_icon}`}
                                            alt=""
                                            className="w-t-25"
                                          />
                                        </div>
                                        <div className="materialFrm">
                                          {item?.makers_class}
                                        </div>
                                      </div>
                                      <div className="lat-txt">
                                        {item?.maker_text}
                                      </div>{" "}
                                    </td>

                                    <td className="bordering border border-gray-300  px-4 py-2 px-py-t text-center">
                                      <div className="upgradePrice">
                                        <h3> {item?.project_cost} </h3>
                                        <button
                                          className="up-btn update"
                                          type="button"
                                          onClick={() =>
                                            handleUpdatePlans(item)
                                          }
                                          disabled={
                                            makersClassification ===
                                              item?.makers_class &&
                                            materialClassification ===
                                              item?.material_class
                                              ? true
                                              : false
                                          }
                                        >
                                          Update{" "}
                                          <img
                                            src="assets/images/update.png"
                                            alt=""
                                          />
                                        </button>
                                      </div>
                                    </td>
                                  </tr>
                                ))}
                              </tbody>
                            </table>
                          </div>
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
      {open && (
        <div className={`modal-backdrop fade ${open ? "show" : ""}`}></div>
      )}
    </>
  );
};

export default SaveMoreWithGoodPlans;
