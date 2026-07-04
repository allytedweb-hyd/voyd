/* eslint-disable react/prop-types */
/* eslint-disable no-unused-vars */
import { useNavigate } from "react-router-dom";
import { environmentUrl } from "../../env/enviroment";
import { useEffect, useState } from "react";
import { Tab, Tabs, TabList, TabPanel } from "react-tabs";
import "react-tabs/style/react-tabs.css";
import Modal from "react-bootstrap/Modal";
import { set, useForm } from "react-hook-form";
import { IoClose } from "react-icons/io5";
import { toast } from "sonner";
import Sonner from "../Toaster/Sonner";
import Loader from "../Spinner/Loader";
import { regexPatterns } from "../../libs/constant";
import MenuItem from "@mui/material/MenuItem";
import Select from "@mui/material/Select";
import Chip from "@mui/material/Chip";
import Box from "@mui/material/Box";
import OutlinedInput from "@mui/material/OutlinedInput";
import { useTheme } from "@mui/material/styles";
import "react-phone-number-input/style.css";
import PhoneInput from "react-phone-number-input";
import Classification from "./Classification";

const MinimalInfo = (props) => {
  const navigate = useNavigate();
  const [formData, setFormData] = useState({});
  const [errors, setErrors] = useState({});
  const [loading, setLoading] = useState(false);
  const [quoteType, setQuoteType] = useState("admin");
  const [selfOther, setSelfOther] = useState("self");
  const [propertyBlock, setPropertyBlock] = useState([]);
  const [step, setStep] = useState(2);
  const [selectedOptions, setSelectedOptions] = useState([]);
  const theme = useTheme();
  const [classification, setClassification] = useState(false);
  const [classifications, setClassifications] = useState([]);
  const [property, setProperty] = useState([]);
  const [propertyType, setPropertyType] = useState([]);
  const closeClassification = () => {
    setClassification(false);
  };

  const handleUserInput = (event) => {
    if (event.target.name === "cusSelectedRooms") {
      const selectedIds = event.target.value;

      const updatedSelection = propertyBlock
        .map((block) => ({
          block: block.enter_section,
          id: block.section_id,
        }))
        .filter((option) => selectedIds.includes(option.id));

      setSelectedOptions(updatedSelection);

      setFormData({
        ...formData,
        [event.target.name]: updatedSelection,
      });
    } else {
      if (selfOther === "others" && step === 1) {
        setFormData({
          ...formData,
          cusState: "Telangana",
          cusCity: "Hyderabad",
          [event.target.name]: event.target.value,
        });
      } else {
        setFormData({
          ...formData,
          cusPropertyCity: "Hyderabad",
          [event.target.name]: event.target.value,
        });
      }
    }
  };

  const ITEM_HEIGHT = 48;
  const ITEM_PADDING_TOP = 8;
  const MenuProps = {
    PaperProps: {
      style: {
        maxHeight: ITEM_HEIGHT * 4.5 + ITEM_PADDING_TOP,
        width: 250,
      },
    },
  };


  const getProperty = async () => {
    const apiUrl = `${environmentUrl}/questionnaire/getProperty.php`;
    const options = {
      method: "GET",
    };
    const response = await fetch(apiUrl, options);
    const fetchedData = await response.json();
    console.log("fetchedData:", fetchedData);         // 👈 log the parsed JSON
    console.log("fetchedData.response:", fetchedData?.response); // 👈 log the array
    const proRes = fetchedData?.response;
    setProperty(Array.isArray(proRes) ? proRes : []);
  };

  const getPropertyType = async () => {
    const apiUrl = `${environmentUrl}/questionnaire/getPropertyType.php`;
    const options = {
      method: "GET",
    };
    const response = await fetch(apiUrl, options);
    const fetchedData = await response.json();
    console.log("propertyType fetchedData:", fetchedData);
    console.log("propertyType fetchedData.response:", fetchedData?.response);
    const proType = fetchedData?.response;
    setPropertyType(Array.isArray(proType) ? proType : []);
  };

  const getClassificationMaster = async () => {
    const apiUrl = `${environmentUrl}/classifications/get.php`;
    const options = {
      method: "GET",
    };
    const response = await fetch(apiUrl, options);
    const fetchedData = await response.json();
    const classificationData = fetchedData?.response;
    setClassifications(classificationData);
  };
  const getPropertyBlock = async () => {
    try {
      const apiUrl = `${environmentUrl}/questionnaire/getPropertyBlock.php`;
      const options = {
        method: "GET",
      };
      const response = await fetch(apiUrl, options);
      const fetchedData = await response.json();
      if (fetchedData?.status) {
        const propertyBlockData = fetchedData?.response;
        setPropertyBlock(propertyBlockData);
      }
    } catch (error) {
      console.log("property block error", error);
    }
  };

  useEffect(() => {
    getPropertyBlock();
    getProperty();
    getPropertyType();
    getClassificationMaster();
  }, []);

  const ValidateFormFields = () => {
    let errors = {};
    if (step === 1) {
      if (!formData.cusFirstName) {
        errors.cusFirstName = "Enter first name";
      } else if (!regexPatterns.alphabetsregex.test(formData.cusFirstName)) {
        errors.cusFirstName = "Name must be in letters only";
      }
      if (!formData.cusLastName) {
        errors.cusLastName = "Enter last name";
      } else if (!regexPatterns.alphabetsregex.test(formData.cusLastName)) {
        errors.cusLastName = "Name must be in letters only";
      }

      if (!formData.cusEmail) {
        errors.cusEmail = "Enter an email address";
      } else if (!regexPatterns.emailregex.test(formData.cusEmail)) {
        errors.cusEmail = "Enter a valid email address";
      }
      // if (!formData.cusMobile) {
      //   errors.cusMobile = "Enter mobile number";
      // } else if (!regexPatterns.mobileregex.test(formData.cusMobile)) {
      //   errors.cusMobile = "Enter a valid 10 digit mobile number";
      // }
      if (!formData.cusMobile) {
        errors.cusMobile = "Enter Mobile Number";
      } else if (
        !regexPatterns.mobileregexInternational.test(formData.cusMobile)
      ) {
        errors.cusMobile = "Enter valid number";
      }
      // if (!formData.cusState) {
      //   errors.cusState = "Please enter state";
      // } else if (!regexPatterns.alphabetsregex.test(formData.cusState)) {
      //   errors.cusState = "State is Invalid, It accepts only characters";
      // }
      // if (!formData.cusCity) {
      //   errors.cusCity = "Please enter city";
      // } else if (!regexPatterns.alphabetsregex.test(formData.cusCity)) {
      //   errors.cusCity = "City is Invalid, It accepts only characters";
      // }
    } else if (step === 2) {
      if (!formData.cusProperty) {
        errors.cusProperty = "Select property";
      }
      if (!formData.cusPropertyType) {
        errors.cusPropertyType = "Select property type";
      }
      if (!formData.cusProjectType) {
        errors.cusProjectType = "Select project type";
      }
      if (!formData.cusPropertySqft) {
        errors.cusPropertySqft = "Enter property sqft";
      } else if (!regexPatterns.numbersregex.test(formData.cusPropertySqft)) {
        errors.cusPropertySqft = "Sqft must be in numbers only";
        // errors.cusPropertySqft = "Invalid, It accepts only numbers";
      }

      if (!formData.cusBudget) {
        errors.cusBudget = "Enter budget";
      } else if (!regexPatterns.numbersregex.test(formData.cusBudget)) {
        errors.cusBudget = "Budget must be in numbers only";
        // errors.cusBudget = "Invalid, It accepts only numbers";
      }

      if (!formData.cusStreet) {
        errors.cusStreet = "Enter address";
      }
      // } else if (!regexPatterns.alphaNumeric.test(formData.cusStreet)) {
      //   errors.cusStreet =
      //     "Street is Invalid, It accepts alphabets and numbers";
      // }

      if (!formData.cusLocation) {
        errors.cusLocation = "Enter locality";
      }
      // } else if (!regexPatterns.alphaNumeric.test(formData.cusLocation)) {
      //   errors.cusLocation =
      //     "Location is Invalid, It accepts alphabets and numbers";
      // }
      if (!formData.nearBy) {
        errors.cusMapLink = "Enter a near by place";
      }
      if (!formData.cusSelectedRooms) {
        errors.cusSelectedRooms = "Select rooms";
      }
    } else if (step === 3) {
      if (!formData.productClass) {
        errors.productClass = "Select product classification";
      }

      if (!formData.manufactureClass) {
        errors.manufactureClass = "Select vendor classification";
      }
    }
    return errors;
  };

  const submitMinimulInfo = async (event) => {
    event.preventDefault();

    const errors = ValidateFormFields();

    setErrors(errors);
    if (Object.keys(errors).length > 0) {
      toast.warning("Please fill all Mandatory Fields");
      return;
    }
    try {
      setLoading(true);
      const apiUrl = `${environmentUrl}/questionnaire/postQuotaion.php`;
      const options = {
        method: "POST",
        body: JSON.stringify({
          ...formData,
          quoteType: selfOther,
          projectStatus: "pending",
        }),
        headers: { Authorization: "Bearer " + localStorage.getItem("token") },
      };
      const response = await (await fetch(apiUrl, options)).json();
      console.log("minimal info popup res", response);

      if (response.status === true) {
        toast.success("Submitted Successfully");
        navigate("/questionnaire");
      } else {
        if (response.status === "warning") {
          toast.warning("Email Already exists, Try again with other mail");
        } else {
          toast.error("Something went wrong, Please Try Again");
        }
      }
    } catch (error) {
      console.log("minimal info popup error", error);
    } finally {
      setLoading(false);
    }
  };
  function getStyles(name, personName, theme) {
    return {
      fontWeight: personName.includes(name)
        ? theme.typography.fontWeightMedium
        : theme.typography.fontWeightRegular,
    };
  }

  const nextStep = () => {
    const errors = ValidateFormFields();

    setErrors(errors);
    if (Object.keys(errors).length > 0) {
      toast.warning("Please fill all Mandatory Fields");
      return;
    }
    setStep(step + 1);
  };
  const prevStep = () => setStep(step - 1);

  const handleSelfOthers = (type) => {
    setSelfOther(type);
    if (type === "self") {
      setStep(2);
    } else {
      setStep(1);
    }
  };

  const handleClassification = () => {
    setClassification(true);
  };

  return (
    <>
      {loading && <Loader />}
      <Modal
        className="getQuotModal"
        show={props?.show}
        onHide={props.close}
        backdrop="static"
        keyboard={false}
      >
        {/****************************  new version popup **************************/}

        <div className=" modalDialogOuter ">
          {/* <div className="modalDialogOuter" role="document"> */}
          <div className="backdrop2 blurr">
            <div className="modal-content">
              <div className="modal-header getQuotTabs">
                <section className="modalDialogGetQuotSection">
                  <div
                    className="modalCloseIcon"
                    data-dismiss="modal"
                    aria-label="Close"
                  >
                    <IoClose onClick={props?.close} />
                  </div>
                  <div className="row modal-wdth quotModal">
                    <div className="col-md-12">
                      <div className="row p-2 adjustSpacing">
                        <div className="col-md-3 col-sm-3 pt-res sideRadioColumn">
                          <div>
                            <img
                              src="assets/images/FYI Final Logo (1).png"
                              alt=""
                              className="lo-img popImg"
                            />
                          </div>

                          <div className="dis-grid pt-4 sideTabs radio">
                            <div className="text-start cursor-pointer">
                              <input
                                type="radio"
                                name="userType"
                                className="cursor-pointer"
                                value={"self"}
                                onChange={() => handleSelfOthers("self")}
                                checked={selfOther === "self"}
                              />{" "}
                              Self
                            </div>
                            <div className="text-start cursor-pointer">
                              <input
                                type="radio"
                                name="userType"
                                className="cursor-pointer"
                                value={"others"}
                                onChange={() => handleSelfOthers("others")}
                              />{" "}
                              Others
                            </div>
                          </div>
                        </div>
                        <div className="col-md-9 col-sm-9 rightFormsBlock">
                          <div className="rightFormOuter">
                            <h6 className="text-start my-2 pro-ov ll">
                              Project Overview
                            </h6>
                            <form method="post" onSubmit={submitMinimulInfo}>
                              <div>
                                <div className="d-flex justify-content-start ppa-res singleTabListOuter">
                                  {selfOther === "others" && (
                                    <div
                                      className={
                                        step === 1
                                          ? "cursor-pointer singleTabList active"
                                          : "cursor-pointer singleTabList"
                                      }
                                    >
                                      Address
                                    </div>
                                  )}
                                  <div
                                    className={
                                      step === 2
                                        ? "cursor-pointer singleTabList active"
                                        : "cursor-pointer singleTabList"
                                    }
                                  >
                                    Property
                                  </div>
                                  <div
                                    className={
                                      step === 3
                                        ? "cursor-pointer singleTabList active"
                                        : "cursor-pointer singleTabList"
                                    }
                                  >
                                    Project
                                  </div>
                                </div>
                                {selfOther === "others" && step === 1 && (
                                  <div className="overViewPopup resp">
                                    <div className="row mr-2">
                                      <div className="col-md-6 col-sm-6 assignMargin">
                                        <input
                                          type="text"
                                          placeholder="First Name *"
                                          className={
                                            errors.cusFirstName
                                              ? "sel-inp is-invalid"
                                              : "sel-inp"
                                          }
                                          id="CustomerFirstName"
                                          name="cusFirstName"
                                          onChange={handleUserInput}
                                          value={formData.cusFirstName || ""}
                                        />
                                        {errors.cusFirstName && (
                                          <p className="error-msg">
                                            {errors.cusFirstName}
                                          </p>
                                        )}
                                      </div>
                                      <div className="col-md-6 col-sm-6 assignMargin">
                                        <input
                                          type="text"
                                          placeholder="Last Name *"
                                          className={
                                            errors.cusLastName
                                              ? "sel-inp is-invalid"
                                              : "sel-inp"
                                          }
                                          name="cusLastName"
                                          id="customerLastName"
                                          onChange={handleUserInput}
                                          value={formData.cusLastName || ""}
                                        />
                                        {errors.cusLastName && (
                                          <p className="error-msg">
                                            {errors.cusLastName}
                                          </p>
                                        )}
                                      </div>
                                    </div>
                                    <div className="row mr-2 textCap">
                                      <div className="col-md-6 col-sm-6 assignMargin">
                                        <input
                                          type="email"
                                          placeholder="Email *"
                                          className={
                                            errors.cusEmail
                                              ? "sel-inp firstText is-invalid"
                                              : "sel-inp firstText"
                                          }
                                          id="customerEmail"
                                          name="cusEmail"
                                          onChange={handleUserInput}
                                          value={formData.cusEmail || ""}
                                        />

                                        {errors.cusEmail && (
                                          <p className="error-msg">
                                            {errors.cusEmail}
                                          </p>
                                        )}
                                      </div>
                                      <div className="col-md-6 col-sm-6 assignMargin">
                                        {/* <input
                                          type="number"
                                          placeholder="Mobile No *"
                                          className={
                                            errors?.cusMobile
                                              ? "sel-inp is-invalid"
                                              : "sel-inp"
                                          }
                                          id="customerMobile"
                                          name="cusMobile"
                                          onChange={handleUserInput}
                                        /> */}
                                        <div
                                          className={
                                            errors?.cusMobile
                                              ? "minimalCountry is-invalid"
                                              : "minimalCountry"
                                          }
                                        >
                                          <PhoneInput
                                            international
                                            defaultCountry="IN"
                                            value={formData.cusMobile || ""}
                                            onChange={(value) =>
                                              setFormData((prev) => ({
                                                ...prev,
                                                cusMobile: value,
                                              }))
                                            }
                                            className="search-clsp22 inputField countryCode"
                                            placeholder="Mobile No *"
                                            name="cusMobile"
                                            maxLength="18"

                                          />
                                        </div>
                                        {errors?.cusMobile && (
                                          <p className="error-msg">
                                            {errors?.cusMobile}
                                          </p>
                                        )}
                                      </div>
                                    </div>
                                    <div className="row mr-2">
                                      <div className="col-md-6 col-sm-6 assignMargin">
                                        <input
                                          type="text"
                                          placeholder="State *"
                                          className="sel-inp"
                                          id="CustomerState"
                                          name="cusState"
                                          onChange={handleUserInput}
                                          value="Telangana"
                                          readOnly
                                        />
                                        {/* {errors.cusState && (
                                          <p className="error-msg">
                                            {errors.cusState}
                                          </p>
                                        )} */}
                                      </div>
                                      <div className="col-md-6 col-sm-6 assignMargin">
                                        <input
                                          type="text"
                                          placeholder="City *"
                                          className="sel-inp "
                                          id="customerCity"
                                          name="cusCity"
                                          onChange={handleUserInput}
                                          value="Hyderabad"
                                          readOnly
                                        />

                                        {/* {errors.cusCity && (
                                          <p className="error-msg">
                                            {errors.cusCity}
                                          </p>
                                        )} */}
                                      </div>
                                    </div>
                                    <div className="popupSubmitBtns">
                                      <button
                                        type="button"
                                        onClick={nextStep}
                                        className="btn btn-success next-but stepNext"
                                      >
                                        Next
                                      </button>
                                    </div>
                                  </div>
                                )}
                                {step === 2 && (
                                  <div className="overViewPopup resp">
                                    <div className="row mr-2">
                                      <div className="col-md-6 col-sm-6 assignMargin">
                                        <select
                                          className={
                                            errors.cusProperty
                                              ? "sel-inp is-invalid"
                                              : "sel-inp"
                                          }
                                          id="customerProperty"
                                          name="cusProperty"
                                          onChange={handleUserInput}
                                          value={formData.cusProperty || ""}
                                        >
                                          <option value="" className="txt-gry">
                                            Select Property *
                                          </option>
                                          {property.map(
                                            (eachProperty, index) => (
                                              <option
                                                value={
                                                  eachProperty.enter_property
                                                }
                                                key={index}
                                                className="txt-gry"
                                              >
                                                {eachProperty.enter_property}
                                              </option>
                                            )
                                          )}
                                        </select>

                                        {errors.cusProperty && (
                                          <p className="error-msg">
                                            {errors.cusProperty}
                                          </p>
                                        )}
                                      </div>
                                      <div className="col-md-6 col-sm-6 assignMargin">
                                        <select
                                          className={
                                            errors.cusPropertyType
                                              ? "sel-inp is-invalid"
                                              : "sel-inp"
                                          }
                                          id="customerPropertyType"
                                          name="cusPropertyType"
                                          onChange={handleUserInput}
                                          value={formData.cusPropertyType || ""}
                                        >
                                          <option value="" className="txt-gry">
                                            Property Type *
                                          </option>
                                          {propertyType.map(
                                            (eachProType, index) => (
                                              <option
                                                value={
                                                  eachProType.property_Type
                                                }
                                                key={index}
                                                className="txt-gry"
                                              >
                                                {eachProType.property_Type}
                                              </option>
                                            )
                                          )}
                                        </select>

                                        {errors.cusPropertyType && (
                                          <p className="error-msg">
                                            {errors.cusPropertyType}
                                          </p>
                                        )}
                                      </div>
                                    </div>
                                    <div className="row mr-2">
                                      <div className="col-md-6 col-sm-6 assignMargin">
                                        <select
                                          className={
                                            errors.cusProjectType
                                              ? "sel-inp is-invalid"
                                              : "sel-inp"
                                          }
                                          id="customerProjectType"
                                          name="cusProjectType"
                                          onChange={handleUserInput}
                                          value={formData.cusProjectType || ""}
                                        >
                                          <option value="" className="txt-gry">
                                            Project Type *
                                          </option>

                                          <option value="Newly Constructed">
                                            Newly Constructed
                                          </option>
                                          <option value="Renovation">
                                            Renovation
                                          </option>
                                          <option value="Under Construction">
                                            Under Construction
                                          </option>
                                        </select>

                                        {errors.cusProjectType && (
                                          <p className="error-msg">
                                            {errors.cusProjectType}
                                          </p>
                                        )}
                                      </div>
                                      <div className="col-md-6 col-sm-6 assignMargin">
                                        <input
                                          type="text"
                                          placeholder="Budget *"
                                          className={
                                            errors.cusBudget
                                              ? "sel-inp is-invalid"
                                              : "sel-inp"
                                          }
                                          id="propertyBudget"
                                          name="cusBudget"
                                          onChange={handleUserInput}
                                          value={formData.cusBudget || ""}
                                        />

                                        {errors.cusBudget && (
                                          <p className="error-msg">
                                            {errors.cusBudget}
                                          </p>
                                        )}
                                      </div>
                                    </div>
                                    <div className="row mr-2">
                                      <div className="col-md-6 col-sm-6 assignMargin">
                                        <input
                                          type="text"
                                          placeholder="Total Square Feet *"
                                          className={
                                            errors.cusPropertySqft
                                              ? "sel-inp is-invalid"
                                              : "sel-inp"
                                          }
                                          id="totalPropertysqft"
                                          name="cusPropertySqft"
                                          onChange={handleUserInput}
                                          value={formData.cusPropertySqft || ""}
                                        />

                                        {errors.cusPropertySqft && (
                                          <p className="error-msg">
                                            {errors.cusPropertySqft}
                                          </p>
                                        )}
                                      </div>
                                      <div className="col-md-6 col-sm-6 assignMargin">
                                        <input
                                          type="text"
                                          placeholder="City *"
                                          className="sel-inp"
                                          id="ciTyName"
                                          name="cusPropertyCity"
                                          onChange={handleUserInput}
                                          value="Hyderabad"
                                          readOnly
                                        />
                                      </div>
                                    </div>
                                    <div className="row mr-2">
                                      <div className="col-md-6 col-sm-6 assignMargin">
                                        <input
                                          type="text"
                                          placeholder="Address *"
                                          className={
                                            errors.cusStreet
                                              ? "sel-inp is-invalid"
                                              : "sel-inp"
                                          }
                                          id="customerStreet"
                                          name="cusStreet"
                                          onChange={handleUserInput}
                                          value={formData.cusStreet || ""}
                                        />

                                        {errors.cusStreet && (
                                          <p className="error-msg">
                                            {errors.cusStreet}
                                          </p>
                                        )}
                                      </div>
                                      <div className="col-md-6 col-sm-6 assignMargin">
                                        <input
                                          type="text"
                                          placeholder="locality *"
                                          className={
                                            errors.cusLocation
                                              ? "sel-inp is-invalid"
                                              : "sel-inp"
                                          }
                                          id="customerLocation"
                                          name="cusLocation"
                                          onChange={handleUserInput}
                                          value={formData.cusLocation || ""}
                                        />

                                        {errors.cusLocation && (
                                          <p className="error-msg">
                                            {errors.cusLocation}
                                          </p>
                                        )}
                                      </div>
                                    </div>
                                    <div className="row mr-2">
                                      <div className="col-md-6 col-sm-6 assignMargin padLeftZ">
                                        <input
                                          type="text"
                                          placeholder="Near by *"
                                          className={
                                            errors.cusMapLink
                                              ? "sel-inp is-invalid"
                                              : "sel-inp"
                                          }
                                          id="propertyMapLink"
                                          name="nearBy"
                                          onChange={handleUserInput}
                                          value={formData.nearBy || ""}
                                        />

                                        {errors.cusMapLink && (
                                          <p className="error-msg">
                                            {errors.cusMapLink}
                                          </p>
                                        )}
                                      </div>
                                    </div>
                                    <div className="row mr-2">
                                      <div className="col-md-12 col-sm-12 assignMargin padLeftZ multiselectOuter">
                                        {/* <select
                                          className={
                                            errors.cusProjectType
                                              ? "sel-inp is-invalid"
                                              : "sel-inp"
                                          }
                                          id="customerProjectType"
                                          name="cusProjectType"
                                          multiple
                                          value={selectedOptions} // Ensure this is an array
                                          onChange={handleUserInput}
                                        >
                                          <option value="">
                                            Property Block
                                          </option>
                                          {propertyBlock.map((block, index) => (
                                            <option
                                              value={block?.section_id}
                                              key={index}
                                            >
                                              {block?.enter_section}
                                            </option>
                                          ))}
                                        </select> */}
                                        <Select
                                          displayEmpty
                                          className={
                                            errors.cusMapLink
                                              ? "requestCheckOuter is-invalid "
                                              : "requestCheckOuter"
                                          }
                                          labelId="demo-multiple-chip-label"
                                          id="demo-multiple-chip"
                                          multiple
                                          value={selectedOptions.map(
                                            (item) => item.id
                                          )} // Use ID for value matching
                                          onChange={handleUserInput}
                                          name="cusSelectedRooms"
                                          input={
                                            <OutlinedInput id="select-multiple-chip " />
                                          }
                                          style={{ width: "100%" }}
                                          renderValue={(selectedIds) => {
                                            if (selectedIds.length === 0) {
                                              return (
                                                <p
                                                  className="selectRoomP"
                                                  style={{
                                                    color: "#000000cc ",
                                                    margin: "0",
                                                    padding: "6px 15px",
                                                  }}
                                                >
                                                  Select Rooms
                                                </p>
                                              );
                                            }
                                            return (
                                              <Box
                                                className="requestCheckInnerBlock "
                                                sx={{
                                                  display: "flex",
                                                  flexWrap: "wrap",
                                                  gap: 0.5,
                                                  padding: "5px",
                                                }}
                                              >
                                                {selectedIds.map(
                                                  (id, index) => {
                                                    const item =
                                                      selectedOptions.find(
                                                        (opt) => opt.id === id
                                                      );
                                                    return (
                                                      <Chip
                                                        className="requestCheckItem"
                                                        key={index}
                                                        label={item?.block}
                                                        style={{
                                                          display: "flex",
                                                          flexDirection: "row",
                                                        }}
                                                      />
                                                    );
                                                  }
                                                )}
                                              </Box>
                                            );
                                          }}
                                          MenuProps={MenuProps}
                                        >
                                          {propertyBlock.map((name) => {
                                            const option = {
                                              block: name.enter_section,
                                              id: name.section_id,
                                            };
                                            return (
                                              <MenuItem
                                                key={option.id}
                                                value={option.id} // Only use ID here
                                                selected={selectedOptions.some(
                                                  (item) =>
                                                    item.id === option.id
                                                )}
                                              >
                                                {option.block}
                                              </MenuItem>
                                            );
                                          })}
                                        </Select>
                                        {errors.cusSelectedRooms && (
                                          <p className="error-msg room">
                                            {errors.cusSelectedRooms}
                                          </p>
                                        )}
                                      </div>
                                    </div>
                                    <div className="popupSubmitBtns">
                                      {selfOther === "others" && (
                                        <button
                                          type="button"
                                          onClick={prevStep}
                                          className="btn btn-light can-btn"
                                        >
                                          Back
                                        </button>
                                      )}
                                      <button
                                        type="button"
                                        onClick={nextStep}
                                        className="btn btn-success next-but stepNext"
                                      >
                                        Next
                                      </button>
                                    </div>
                                  </div>
                                )}
                                {step === 3 && (
                                  <div className="overViewPopup resp">
                                    <div className="row mr-2">
                                      <div className="col-md-6 col-sm-6 assignMargin">
                                        <select
                                          className={
                                            errors.productClass
                                              ? "sel-inp is-invalid"
                                              : "sel-inp"
                                          }
                                          id="productClass"
                                          name="productClass"
                                          onChange={handleUserInput}
                                        >
                                          <option value="">
                                            Select Product Class *
                                          </option>

                                          {classifications.map(
                                            (each, index) => (
                                              <option
                                                value={each.classification}
                                                key={index}
                                              >
                                                {each.classification}
                                              </option>
                                            )
                                          )}
                                        </select>
                                        {errors.productClass && (
                                          <p className="error-msg">
                                            {errors.productClass}
                                          </p>
                                        )}
                                      </div>
                                      <div className="col-md-6 col-sm-6 assignMargin">
                                        <select
                                          className={
                                            errors.manufactureClass
                                              ? "sel-inp is-invalid"
                                              : "sel-inp"
                                          }
                                          id="manufactureClass"
                                          name="manufactureClass"
                                          onChange={handleUserInput}
                                        >
                                          <option value="">
                                            Select Vendor Class *
                                          </option>
                                          {classifications.map(
                                            (each, index) => (
                                              <option
                                                value={each.classification}
                                                key={index}
                                              >
                                                {each.classification}
                                              </option>
                                            )
                                          )}
                                        </select>

                                        {errors.manufactureClass && (
                                          <p className="error-msg">
                                            {errors.manufactureClass}
                                          </p>
                                        )}
                                      </div>
                                    </div>
                                    {/* <p
                                      className="classification-link"
                                      onClick={handleClassification}
                                    >
                                      Know More About product/vendor Class..?
                                    </p> */}
                                    <div className="popupSubmitBtns">
                                      <div>
                                        <button
                                          type="button"
                                          onClick={prevStep}
                                          className="btn btn-light can-btn"
                                        >
                                          Back
                                        </button>
                                        <button
                                          type="submit"
                                          className="btn btn-success next-but stepNext"
                                        >
                                          Submit
                                        </button>
                                      </div>
                                      <div
                                        className="classificationBtn"
                                        title="To know more about product/vendor Classifications"
                                      >
                                        <button
                                          type="button"
                                          onClick={handleClassification}
                                        >
                                          {" "}
                                          Classifications
                                        </button>
                                      </div>
                                    </div>
                                  </div>
                                )}
                              </div>

                              {/* <div className="popupSubmitBtns">
                                <button
                                  type="button"
                                  className="btn btn-light can-btn"
                                  onClick={props?.close}
                                >
                                  Cancel
                                </button>
                                <button
                                  type="submit"
                                  className="btn btn-success next-but"
                                >
                                  Next
                                </button>
                              </div> */}
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
              </div>
            </div>
          </div>
        </div>
      </Modal>
      <Sonner />
      <Classification
        openClassification={classification}
        closeClassification={closeClassification}
      />
    </>
  );
};

export default MinimalInfo;
