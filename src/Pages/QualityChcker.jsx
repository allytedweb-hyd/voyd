import { useEffect, useState } from "react";
import "bootstrap/dist/css/bootstrap.min.css";
import { environmentUrl } from "../env/enviroment";
import Loader from "../Components/Spinner/Loader";
import { envImgUrl } from "../env/envImage";
import { IoMdRemoveCircleOutline } from "react-icons/io";
import { MdAddCircleOutline } from "react-icons/md";
import QualityCheckDetails from "../Components/Popups/QualityCheckDetails";
import { MdVerified } from "react-icons/md";
import { toast } from "sonner";


const QualityChcker = () => {
  const [qualityChecker, setQualityChecker] = useState([
    { productImg: "", productName: "", productType: "", subType: "" },
  ]);
  const [loading, setLoading] = useState(false);
  const [products, setProducts] = useState([]);
  const [productType, setProductType] = useState([]);
  const [subType, setSubType] = useState([]);
  const [openQualityModal, setOpenQualityModal] = useState(false);

  // ------------------ NEWLY ADDED FUNCTIONS OPEN ----------------------
  // const [rows, setRows] = useState([
  //   {
  //     productName: "",
  //     productType: "",
  //     subType: "",
  //     image: "",
  //   },
  // ]);
  const handleAddRow = () => {
    setQualityChecker([
      ...qualityChecker,
      {
        productImg: "",
        productName: "",
        productType: "",
        subType: "",
        verifiedBadge: "",
      },
    ]);
  };
  const handleRemoveRow = (index) => {
    const updatedRows = [...qualityChecker];
    updatedRows.splice(index, 1);
    setQualityChecker(updatedRows);
  };
  const handleMultipleFields = (e, index) => {
    const { name, value } = e.target;
    const updatedRows = [...qualityChecker];
    updatedRows[index][name] = value;
    setQualityChecker(updatedRows);
    if (e.target.name == "productName") {
      const selectedProduct = products.find((p) => p.product_master === value);
      updatedRows[index].productImg = selectedProduct?.product_img || "";
      qualityChecker[index].productName = e.target.value;
      getProductType(e.target.value);
    }
    if (e.target.name == "productType") {
      getProductSubType(e.target.value);
    }
    if (e.target.name == "subType") {
      const selectedBadge = subType.find((p) => p.sub_type === value);
      updatedRows[index].verifiedBadge = selectedBadge?.recommend || "";
    }
    setQualityChecker(updatedRows);
  };
  // ------------------ NEWLY ADDED FUNCTIONS CLOSE ---------------------

  // -------------- OLD FUNCTIONALITY OPEN -------------

  // const addQualityFields = () => {
  //   setQualityChecker([
  //     ...qualityChecker,
  //     { productImg: "", productName: "", productType: "", subType: "" },
  //   ]);
  // };

  // const removeQualityFields = (index) => {
  //   let newFormValues = [...qualityChecker];
  //   newFormValues.splice(index, 1);
  //   setQualityChecker(newFormValues);
  // };

  // const handleMultipleFields = (e, index) => {
  //   let newFormValues = [...qualityChecker];
  //   if (e.target.name == "productName") {
  //     setProductImg(products[index]?.product_img);
  //     newFormValues[index].productName = e.target.value;
  //   }
  //   if (e.target.name == "productType") {
  //     newFormValues[index].productType = e.target.value;
  //   }
  //   if (e.target.name == "subType") {
  //     newFormValues[index].subType = e.target.value;
  //   }
  //   setQualityChecker(newFormValues);
  // };

  // -------------- OLD FUNCTIONALITY COLSE ----------

  const getProductSubType = async (value) => {
    try {
      setLoading(true);
      const apiUrl = `${environmentUrl}/qualityChecker/get_sub_type.php?subType=${value}`;
      const options = {
        method: "GET",
      };
      const response = await (await fetch(apiUrl, options)).json();
      if (response?.status) {
        setSubType(response?.response);
      }
    } catch (error) {
      console.log("get product sub type error is===", error);
    } finally {
      setLoading(false);
    }
  };

  const getProductType = async (value) => {
    try {
      setLoading(true);
      const apiUrl = `${environmentUrl}/qualityChecker/get_product_type.php?product=${value}`;
      const options = {
        method: "GET",
      };
      const response = await (await fetch(apiUrl, options)).json();

      console.log("product type is===", response);
      if (response?.status) {
        setProductType(response?.response);
      }
    } catch (error) {
      console.log("get product type error is===", error);
    } finally {
      setLoading(false);
    }
  };

  const getQualityCheckerProducts = async () => {
    try {
      setLoading(true);
      const apiUrl = `${environmentUrl}/qualityChecker/get_product.php`;
      const options = {
        method: "GET",
      };
      const response = await (await fetch(apiUrl, options)).json();
      if (response?.status) {
        setProducts(response?.response);
      }
    } catch (error) {
      console.log("quality checker error is===", error);
    } finally {
      setLoading(false);
    }
  };

  const sendQualityCheckReport = () => {

    const hasInvalidRow = qualityChecker.some(
      (row) => !row.productName || !row.productType || !row.subType
    );

    if (hasInvalidRow) {
      toast.error("Please select all fields before submitting!");
      return;
    }

    setOpenQualityModal(true);
    console.log("quality checker data is===", qualityChecker);
  };

  const closeQualityCheckPopup = () => {
    setOpenQualityModal(false);
  };

  const clearDataAfterSuccess = () => {
    setQualityChecker([
      { productImg: "", productName: "", productType: "", subType: "" },
    ]);
  };

  useEffect(() => {
    if (window.location.pathname === "/qualitychecker") {
      getQualityCheckerProducts();
    }
  }, []);

  return (
    <>
      {loading && <Loader />}
      <div>
        <section className="qc-bg qualSection">
          <div className="">
            <div className="row justify-content-center">
              <div>
                <div className="font-monsrt qc-hdng pb-3 d-flex justify-content-center">
                  Quality <span className="check-txt px-2"> Checker</span>
                </div>
                <div>
                  <p className="many-txt">
                    Ensure product quality by selecting options from the
                    dropdowns below
                  </p>
                </div>
              </div>
            </div>

            {/* by using bootsrap divs */}
            <div className="container">
              <div className="table-styles bg-white mb-5 padLeft qc-outer">
                <div className="row tetCentering backLight">
                  <div className="col-md-2 col-sm-2 qc-all qual-chck imageC tEnd tCenterM">
                    Image
                  </div>
                  <div className="col-md-3  col-sm-3  qc-all1  qual-chck padR">
                    Product
                  </div>
                  <div className="col-md-3  col-sm-3  qc-all2   qual-chck tEnd">
                    Product Type
                  </div>
                  <div className="col-md-3  col-sm-3  qc-all  qual-chck tEnd padR">
                    Sub Type
                  </div>
                  <div className="col-md-1 col-sm-1  qc-all  qual-chck m-non tEnd"></div>
                </div>
                <div className="loopRowOuter">
                  {qualityChecker.map((row, index) => (
                    <div className="row loopingRow tetCentering" key={index}>
                      <div className="col-md-2 col-sm-2 qc-25 qual-chck imageC">
                        <div className="qual-image">
                          <img
                            src={
                              row?.productImg
                                ? `${envImgUrl}/Uploads/productmaster/${row?.productImg}`
                                : "assets/images/gallery-vector (2).jpg"
                            }
                            alt="product image"
                          />
                        </div>
                      </div>
                      <div className="col-md-3  col-sm-3  qc-25   qual-chck d-flex align-items-center ">
                        <select
                          className="sel-inp-qc  cursor-pointer"
                          onChange={(e) => handleMultipleFields(e, index)}
                          name="productName"
                          value={row.productName || ""}
                        >
                          <option className="txt-gry">select</option>
                          {products?.map((each, idx) => (
                            <option
                              className="txt-gry"
                              key={idx}
                              value={each.product_master}
                            >
                              {each.product_master}
                            </option>
                          ))}
                        </select>
                      </div>
                      <div className="col-md-3  col-sm-3  qc-25 d-flex align-items-center   qual-chck">
                        <select
                          className="sel-inp-qc  cursor-pointer"
                          onChange={(e) => handleMultipleFields(e, index)}
                          name="productType"
                          value={row.productType || ""}
                        >
                          <option className="txt-gry">Select</option>
                          {productType?.map((each, idx) => (
                            <option
                              className="txt-gry"
                              key={idx}
                              value={each.product_type}
                            >
                              {each.product_type}
                            </option>
                          ))}
                        </select>
                      </div>
                      <div className="col-md-3  col-sm-3  qc-25 q-chkk q-ch  qual-chck d-flex gap-2 mob-remove align-items-center">
                        <select
                          className="sel-inp-qc cursor-pointer thirdDroOption"
                          onChange={(e) => handleMultipleFields(e, index)}
                          name="subType"
                          value={row.subType || ""}
                        >
                          <option className="txt-gry">Select</option>
                          {subType?.map((each, index) => (
                            <option
                              className="txt-gry"
                              key={index}
                              value={each.sub_type}
                            >
                              {each.sub_type}
                            </option>
                          ))}
                        </select>
                        {row?.subType && (
                          <MdVerified
                            className={
                              row?.verifiedBadge == "highly_recommend"
                                ? "verified-badge highly-recommended"
                                : row?.verifiedBadge == "recommend"
                                  ? "verified-badge recommended"
                                  : "verified-badge not-recommended"
                            }
                          />
                        )}
                      </div>
                      <div className="col-md-1 col-sm-1 qc-25 buttonsColumn twillBtns">
                        <div className="addRRemovesOuter">
                          {index > 0 && (
                            <button
                              className="btn btn-danger remove"
                              onClick={() => handleRemoveRow(index)}
                            >
                              <IoMdRemoveCircleOutline />
                            </button>
                          )}
                          {index === qualityChecker.length - 1 && (
                            <button
                              className="btn btn-success add"
                              onClick={handleAddRow}
                            >
                              <MdAddCircleOutline />
                            </button>
                          )}
                        </div>
                      </div>
                    </div>
                  ))}
                </div>
                <div className="note-txt d-flex justify-content-center align-items-center my-3">
                  <button
                    type="button"
                    onClick={sendQualityCheckReport}
                    className="btn btn-success next-but2 text-capitalize"
                  >
                    Send Quality Report{" "}
                    <img src="assets/images/Group (4).png" alt="" />
                  </button>
                </div>
              </div>
            </div>

            {/* table format */}
            {/* <div className="container">
              <div className="table-responsive table-styles bg-white mb-5">


                <div className="table-container">
                  <table className="table">
                    <thead>
                      <tr>
                        <th scope="col" className="text-center size-25">
                          Image
                        </th>
                        <th scope="col" className="text-start size-25">
                          Product
                        </th>
                        <th scope="col" className="text-start size-25">
                          Product Type
                        </th>
                        <th scope="col" className="text-start size-25">
                          Sub Type
                        </th>
                      </tr>
                    </thead>
                  </table>

               
                  <div className="table-body-container">
                    <table className="table">
                      <tbody>
                        {qualityChecker.map((each, index) => (
                          <tr key={index} className="border-bottom">
                            <td className="text-center size-25">
                              <img
                                src={
                                  productImg
                                    ? `${envImgUrl}/Uploads/productmaster/${productImg}`
                                    : "assets/images/Rectangle 34626548.png"
                                }
                                alt=""
                                className="res-65"
                              />
                            </td>
                            <td className="size-25">
                              <select
                                className="sel-inp-qc mt-25 cursor-pointer"
                                onChange={(e) => handleMultipleFields(e, index)}
                                name="productName"
                              >
                                <option className="txt-gry">select</option>
                                {products?.map((each, index) => (
                                  <option
                                    className="txt-gry"
                                    key={index}
                                    value={each?.product_master}
                                  >
                                    {each?.product_master}
                                  </option>
                                ))}
                              </select>
                            </td>
                            <td className="size-25">
                              <select
                                className="sel-inp-qc mt-25 cursor-pointer"
                                onChange={(e) => handleMultipleFields(e, index)}
                                name="productType"
                              >
                                <option className="txt-gry">Steel</option>
                              </select>
                            </td>
                            <td className="size-25">
                              <select
                                className="sel-inp-qc mt-25 cursor-pointer"
                                onChange={(e) => handleMultipleFields(e, index)}
                                name="subType"
                              >
                                <option className="txt-gry">Overlay</option>
                              </select>
                            </td>

                            {index ? (
                              <div
                                onClick={() => removeQualityFields(index)}
                                style={{ cursor: "pointer", color: "red" }}
                              >
                                <FaMinusSquare size={30} className="mt-4" />
                              </div>
                            ) : null}
                          </tr>
                        ))}
                        <div
                          onClick={() => addQualityFields()}
                          style={{ cursor: "pointer" }}
                        >
                          <FaPlusSquare size={30} className="plus-con" />
                        </div>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div className="note-txt d-flex justify-content-center align-items-center my-3">
                  <button
                    type="button"
                    className="btn btn-success next-but2 text-capitalize"
                  >
                    Send Quality Report{" "}
                    <img src="assets/images/Group (4).png" alt="" />
                  </button>
                </div>
              </div>
            </div> */}
          </div>
        </section>
      </div>
      <QualityCheckDetails
        openQtyCheckDetails={openQualityModal}
        closeQtyCheckDetails={closeQualityCheckPopup}
        qualityCheckInfo={qualityChecker}
        clearQualityCheckInfo={clearDataAfterSuccess}
      />
    </>
  );
};

export default QualityChcker;
