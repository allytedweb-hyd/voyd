/* eslint-disable react-hooks/exhaustive-deps */
/* eslint-disable no-unused-vars */
/* eslint-disable no-undef */
/* eslint-disable react/jsx-key */
// import { SlideshowLightbox } from "lightbox.js-react";
import "lightbox.js-react/dist/index.css";
import { environmentUrl } from "../../env/enviroment";
import { useEffect, useState } from "react";
import { toast } from "sonner";
import Sonner from "../Toaster/Sonner";

const QuestionaireForms = () => {
  const [propertyBlockVal, setPropertyBlockVal] = useState("");
  const [loading, setLoading] = useState(false);
  const handlePropertyBlock = (event) => {
    setPropertyBlockVal(event.target.value);
  };
  // console.log("property block", propertyBlockVal);

  const handleNumberOfBlocks = (event) => {
    const noOfBlocks = event.target.value;
    // console.log("no of block are", noOfBlocks);
  };

  const handleInteriorElements = (event) => {
    const interiorEleVal = event.target.value;

    // console.log("interior ele value", interiorEleVal);
  };

  const [propertyBlock, setPropertyBlock] = useState([]);
  const getPropertyBlock = async () => {
    try {
      setLoading(true);

      const apiUrl = `${environmentUrl}/questionnaire/getPropertyBlock.php`;
      const options = {
        method: "GET",
      };
      const response = await fetch(apiUrl, options);
      const fetchedData = await response.json();
      const propertyBlockData = fetchedData?.response;
      setPropertyBlock(propertyBlockData);
    } catch (error) {
      console.log("property block error", error);
    } finally {
      setLoading(false);
    }
  };
  // console.log("property block", propertyBlock);

  const [materialMaster, setMaterialMaster] = useState([]);
  const getMaterialMaster = async () => {
    try {
      setLoading(true);
      const apiUrl = `${environmentUrl}/questionnaire/getMaterialMaster.php`;
      const options = {
        method: "GET",
      };
      const response = await fetch(apiUrl, options);
      const fetchedData = await response.json();
      const materialMasterData = fetchedData?.response;
      setMaterialMaster(materialMasterData);
    } catch (error) {
      console.log("material master error", error);
    } finally {
      setLoading(false);
    }
  };
  useEffect(() => {
    getPropertyBlock();
    getMaterialMaster();
  }, []);
  // console.log("material master data is", materialMaster);
  // console.log("property block fetch is==", propertyBlock);
  // submitting form to get a quote
  const submitFormBtn = (event) => {
    event.preventDefault();
    let validationRules = [
      {
        element: "#cusPropertBlock",
        rules: {
          required: true,
        },
        errors: {
          requiredError: "This Field is required",
        },
      },

      {
        element: "#noOfBlocks",
        rules: {
          required: true,
        },
        errors: {
          requiredError: "This Field is required",
        },
      },
      {
        element: "#cusInteriorEle",
        rules: {
          required: true,
        },
        errors: {
          requiredError: "This Field is required",
        },
      },
      {
        element: "#blogSqft",
        rules: {
          required: true,
        },
        errors: {
          requiredError: "This Field is required",
        },
      },
    ];
    let IsFormValid = validateFormFields(validationRules);
    if (IsFormValid.length > 0) {
      toast.warning("Please Fill the Mandatory fields");
      return;
    } else {
      alert("no errors");
    }
  };

  const [interiorEle, setInteriorEle] = useState([]);
  const getInteriorEle = async () => {
    try {
      setLoading(true);

      const apiUrl = `${environmentUrl}/questionnaire/getInteriorElementMaster.php?propertyBlock=${propertyBlockVal}`;
      const options = {
        method: "GET",
      };
      const response = await fetch(apiUrl, options);
      const fetchedData = await response.json();
      const interiorEleData = fetchedData?.response;
      setInteriorEle(interiorEleData);
    } catch (error) {
      console.log("interior ele error", error);
    } finally {
      setLoading(false);
    }
  };
  useEffect(() => {
    getInteriorEle();
  }, [propertyBlockVal]);
  console.log("interior ele data", interiorEle);

  return (
    <>
      <Sonner />
      <div className="tab">
        <h4>Property Info</h4>
        <form method="POST" onSubmit={submitFormBtn}>
          <div className="form-row">
            <div className="form-group col-md-12">
              <label htmlFor="spCoverPage" className="questionnair-form">
                Property Block
              </label>
              <select
                className="form-control selectpicker"
                id="cusPropertBlock"
                name=""
                onChange={handlePropertyBlock}
              >
                <option value="">Select</option>
                {propertyBlock.map((eachBlock) => (
                  <option value={eachBlock.enter_section}>
                    {eachBlock.enter_section}
                  </option>
                ))}
              </select>
              <p id="errText" className="error-msg"></p>
            </div>
          </div>
          <div className="form-row">
            <div className="form-group col-md-12">
              <label htmlFor="spCoverPage" className="questionnair-form">
                No of Blocks(rooms)
              </label>
              <select
                className="form-control selectpicker"
                onChange={handleNumberOfBlocks}
                id="noOfBlocks"
              >
                <option value="">Select</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
              </select>
              <p id="errText" className="error-msg"></p>
            </div>
          </div>
          <div className="form-row">
            <div className="form-group col-md-12">
              <label htmlFor="" className="questionnair-form">
                Interior Elements
              </label>
              {interiorEle === "Data not found" ? (
                <select
                  className="form-control selectpicker"
                  onChange={handleInteriorElements}
                  id="cusInteriorEle"
                >
                  <option value="">Select</option>
                </select>
              ) : (
                <select
                  className="form-control selectpicker"
                  onChange={handleInteriorElements}
                  id="cusInteriorEle"
                >
                  <option value="">Select</option>
                  {interiorEle.map((eachEle) => (
                    <option value={eachEle.element_name}>
                      {eachEle.element_name}
                    </option>
                  ))}
                </select>
              )}

              <p id="errText" className="error-msg"></p>
            </div>
            <div className="form-group col-md-12">
              <label htmlFor="spCoverPageColour" className="questionnair-form">
                Block Sft
              </label>
              <input
                type="text"
                className="form-control"
                placeholder="Enter Block Sft"
                id="blogSqft"
              />
              <p id="errText" className="error-msg"></p>
            </div>
            <div className="form-group col-md-12">
              <label htmlFor="" className="questionnair-form">
                Material
              </label>
              <select
                className="form-control selectpicker"
                // onChange={handleInteriorElements}
                id="cusInteriorEle"
              >
                <option value="">Select</option>
                {materialMaster.map((material) => (
                  <option value={material.material_name}>
                    {material.material_name}
                  </option>
                ))}
              </select>
              <p id="errText" className="error-msg"></p>
            </div>
            <div className="form-group col-md-12">
              <label htmlFor="" className="questionnair-form">
                Design
              </label>
              <select
                className="form-control selectpicker"
                // onChange={handleInteriorElements}
                id="cusInteriorEle"
              >
                <option value="">Select</option>
                <option value="Modern">Modern</option>
                <option value="Classic">Classic</option>
              </select>
              <p id="errText" className="error-msg"></p>
            </div>
          </div>

          <div className="form-row">
            <div className="form-group col-md-12">
              <label htmlFor="spCoverPageColour" className="questionnair-form">
                Price Range
              </label>
              <input
                type="text"
                className="form-control"
                placeholder="priceRange"
                id="blogSqft"
              />
              <p id="errText" className="error-msg"></p>
            </div>
          </div>
          <button className="btn btn-primary" type="submit">
            Submit
          </button>
        </form>
      </div>
      <Sonner />
    </>
  );
};

export default QuestionaireForms;
