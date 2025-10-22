/* eslint-disable no-unused-vars */
/* eslint-disable react-hooks/exhaustive-deps */
// import React from 'react'
import Quotation from "../Components/Questionnair/Quotation";
import { SlideshowLightbox } from "lightbox.js-react";
import "lightbox.js-react/dist/index.css";
import InteriorElementsAddOns from "../Components/Questionnair/InteriorElementsAddOns";
import { IoBagAdd } from "react-icons/io5";
import { Tab, Tabs, TabList, TabPanel } from "react-tabs";
import "react-tabs/style/react-tabs.css";
import { useEffect, useState } from "react";
import { environmentUrl } from "../env/enviroment";
import { toast } from "sonner";
import Sonner from "../Components/Toaster/Sonner";
import { envImgUrl } from "../env/envImage";
import Joyride from "react-joyride";
import { Link, useNavigate } from "react-router-dom";
import ReactPaginate from "react-paginate";
import { IoBagRemove } from "react-icons/io5";
import { getItemValue } from "../libs/constant";
import Slider from "@mui/material/Slider";
import VendorList from "../Components/Questionnair/VendorList";
import ConfiramtionPopup from "../Components/Popups/ConfiramtionPopup";
import { set, useForm } from "react-hook-form";
import EleSftAndQty from "../Components/Popups/EleSftAndQty";
import { formatCurrency } from "../libs/endpoints";
import SubLoader from "../Components/Spinner/subLoader";
import { FaAngleRight } from "react-icons/fa";
import { FiMinus } from "react-icons/fi";
import { IoIosClose } from "react-icons/io";
import { FaAngleDoubleRight } from "react-icons/fa";
import { PiSlidersHorizontalBold } from "react-icons/pi";
import SaveMoreWithGoodPlans from "../Components/Popups/SaveMoreWithGoodPlans";
import NoDataFound from "./NoDataFound";
import { FcRemoveImage } from "react-icons/fc";
import { FcAddImage } from "react-icons/fc";
import { IoMdAddCircle } from "react-icons/io";
import { IoIosRemoveCircle } from "react-icons/io";
import { FaChevronRight } from "react-icons/fa6";
import Carousel from "react-multi-carousel";
import "react-multi-carousel/lib/styles.css";
import Lightbox from "yet-another-react-lightbox";
import "yet-another-react-lightbox/styles.css";
import "yet-another-react-lightbox/plugins/thumbnails.css";
import Thumbnails from "yet-another-react-lightbox/plugins/thumbnails";
import Zoom from "yet-another-react-lightbox/plugins/zoom";
import Slideshow from "yet-another-react-lightbox/plugins/slideshow";
import Loader from "../Components/Spinner/Loader";
import { truncateHTML } from "../libs/constant";
import UnavailableInteriorElements from "../Components/Popups/UnavailableInteriorElements";

const EditQuestionnaire = () => {
  const [addonsData, setAddonsData] = useState({});
  const [projectData, setProjectData] = useState([]);
  const [vendorData, setVendorData] = useState([]);
  const [propertyBlockVal, setPropertyBlockVal] = useState("");
  const [confirmation, setConfirmation] = useState(false);
  const [noOfTabs, setNoOfTabs] = useState([]);
  const [interiorEleData, setInteriorEleData] = useState([]);
  const [interiorEleVal, setInteriorEleVal] = useState("");
  const [propertyBlock, setPropertyBlock] = useState([]);
  const [totalAddons, setTotalAddons] = useState({});
  const [tabIndex, setTabIndex] = useState(0);
  const [materialMaster, setMaterialMaster] = useState([]);
  const [interiorEle, setInteriorEle] = useState([]);
  const [materialFilterVal, setMaterialFilterVal] = useState("");
  const [designFilterVal, setDesignFilterVal] = useState("");
  const [range, setRange] = useState([1000, 1000]);
  const [eleQtyPopup, setEleQtyPopup] = useState(false);
  const [loading, setLoading] = useState(true);
  const [popupIdData, setPopupIdData] = useState("");
  const [eleQtyData, setEleQtyData] = useState();
  const [vendorClass, setVendorClass] = useState("");
  const [totalProjectBudget, setTotalProjectBudget] = useState(0);
  const [utilizedBudget, setUtilizedBudget] = useState(0);
  const [remainingBudget, setRemainingBudget] = useState(
    Number(projectData?.budget)
  );
  const [selectedRooms, setSelectedRooms] = useState([]);
  const [openSaveMore, setOpenSaveMore] = useState(false);
  const [makersClassification, setMakersClassification] = useState(null);
  const [materialClassification, setMaterialClassification] = useState(null);
  const [openLightbox, setOpenLightbox] = useState(false);
  const [lightboxSlides, setLightboxSlides] = useState([]);
  const [selectedIndex, setSelectedIndex] = useState(0);
  const [addedElements, setAddedElements] = useState([]);
  const [showRemovedPopup, setShowRemovedPopup] = useState(false);
  const [removedPopupList, setRemovedPopupList] = useState([]);
  const [allAvailableItems, setAllAvailableItems] = useState([]);

  const stripHTML = (html) => {
    const tmp = document.createElement("div");
    tmp.innerHTML = html;
    return tmp.textContent || tmp.innerText || "";
  };

  const formatLocation = (...parts) =>
    parts
      .filter(Boolean)
      .map((part) => part.charAt(0).toUpperCase() + part.slice(1).toLowerCase())
      .join(", ");

  const responsive = {
    superLargeDesktop: {
      breakpoint: { max: 4000, min: 3000 },
      items: 1, // Two items for super-large screens
    },
    desktop: {
      breakpoint: { max: 3000, min: 1024 },
      items: 1, // Two items for desktop
    },
    tablet: {
      breakpoint: { max: 1024, min: 464 },
      items: 1, // One item for tablets
    },
    mobile: {
      breakpoint: { max: 464, min: 0 },
      items: 1, // One item for mobile
    },
  };

  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm();

  // Set addons by adding to cart
  let navigate = useNavigate();

  const SelectTabsWhenChanged = (event) => {
    const propValue = propertyBlock.find((element) => {
      return element.section_id == propertyBlockVal;
    });
    // console.log(propValue?.enter_section);
    const values = totalAddons[propValue?.enter_section];
    values["tabs"] = [];
    const noOfBlocks = parseInt(event.target.value);
    for (let i = 1; i <= noOfBlocks; i++) {
      values.tabs.push([]);
    }
    setTotalAddons({
      ...totalAddons,
      [propValue?.enter_section]: values,
    });
    setNoOfTabs(
      totalAddons[propValue?.enter_section].tabs.length == 0
        ? [1]
        : totalAddons[propValue?.enter_section].tabs
    );
  };

  const PushItemsIntoTabs = async (ele) => {
    console.log("pushed ele is====", ele);
    const propValue = propertyBlock.find((element) => {
      return element.section_id == propertyBlockVal;
    });

    const values = totalAddons[propValue?.enter_section];

    if (!values?.tabs?.length || values.tabs.length === 0) {
      toast.warning(
        "Please select number of rooms before adding interior elements to project estimate."
      );
      return;
    }
    setEleQtyData(ele);
    setEleQtyPopup(true);
  };

  const getAllItems = (elementData) => {
    console.log("element qty data ====", eleQtyData);
    console.log("teb index is======", tabIndex);
    const propValue = propertyBlock.find((element) => {
      return element.section_id == propertyBlockVal;
    });
    // console.log(propValue?.enter_section);

    const values = totalAddons[propValue?.enter_section];

    console.log(
      `values are ${JSON.stringify(values)} and values} tabs are ${
        values.tabs
      } tab index is ${tabIndex}`
    );

    setUtilizedBudget(
      Number(utilizedBudget) + Number(eleQtyData?.maximum_price)
    );

    values.tabs[tabIndex].push({
      ...eleQtyData,
      eleQtyPerBlock: elementData?.eleQuantity,
      eleSft: elementData?.eleSqft,
    });
    setRemainingBudget(Number(totalProjectBudget) - Number(utilizedBudget));

    setTotalAddons({
      ...totalAddons,
      [propValue?.enter_section]: values,
    });
    setAddedElements((prev) => [
      ...prev,
      `${eleQtyData.element_id}_${tabIndex}`,
    ]);
    console.log("utilized amount is====", utilizedBudget);
  };

  const GetElementNameById = (arr, id, key, returnKey = null) => {
    const propValue = arr.find((element) => {
      return element[key] == id;
    });
    if (returnKey == null) {
      return propValue;
    }
    return propValue[returnKey];
  };

  const getProjectAndBudgetDetails = async () => {
    const apiUrl = `${environmentUrl}/questionnaire/getProjectAndBudgetDetails.php`;
    const options = {
      method: "GET",
      headers: { Authorization: "Bearer " + localStorage.getItem("token") },
    };
    const response = await fetch(apiUrl, options);
    const fetchedData = await response.json();
    if (fetchedData?.status) {
      const projectDetails = fetchedData?.response;
      setProjectData(projectDetails);
      setTotalProjectBudget(projectDetails?.budget);

      if (fetchedData?.selectedRooms) {
        const propertyBlockData = fetchedData?.selectedRooms;
        let value = {};
        fetchedData?.selectedRooms.forEach((property) => {
          value[property.enter_section] = { tabs: [] };
        });
        setTotalAddons(value);
        setPropertyBlock(propertyBlockData);
      }
    }
  };

  useEffect(() => {
    getProjectAndBudgetDetails();

    const authToken = localStorage.getItem("token");
    if (authToken == "" || authToken == undefined || authToken == null) {
      navigate("/");
    }
  }, []);

  // onScroll sticky budget management
  useEffect(() => {
    // window.addEventListener("scroll", isSticky);
    // return () => {
    //   window.removeEventListener("scroll", isSticky);
    // };
  });

  /* Method that will fix header after a specific scrollable */
  // const isSticky = () => {
  //   const header = document.querySelector(".budget-management-nav");
  //   const scrollTop = window.scrollY;
  //   scrollTop >= 190
  //     ? header.classList.add("budget-is-sticky")
  //     : header.classList.remove("budget-is-sticky");
  // };

  const handlePropertyBlock = async (event) => {
    setPropertyBlockVal(event.target.value);
    const propValue = propertyBlock.find((element) => {
      return element.section_id == event.target.value;
    });
    // console.log("totalAddons[propValue?.enter_section].tabs",totalAddons[propValue?.enter_section].tabs)
    setNoOfTabs(
      totalAddons[propValue?.enter_section].tabs.length == 0
        ? [1]
        : totalAddons[propValue?.enter_section].tabs
    );
    setTabIndex(0);
    await getInteriorEle(event.target.value);
  };
  // console.log("no of tabs====", noOfTabs);

  const handleNumberOfBlocks = (event) => {
    const noOfBlocks = parseInt(event.target.value);
    let newArr = [];
    for (let i = 1; i <= noOfBlocks; i++) {
      newArr.push(i);
    }
    // console.log("no of block are", newArr.length);
    return setNoOfTabs(newArr);
  };

  const handleInteriorElements = async (interiorElement) => {
    // const interiorElement = event.target.value;
    setLoading(true);
    try {
      setInteriorEleVal(interiorElement);
      const apiUrl = `${environmentUrl}/questionnaire/getInteriorElements.php?propertyBlock=${propertyBlockVal}&interiorElement=${interiorElement}&classification=${projectData?.product_classification}`;
      const options = {
        method: "GET",
      };
      const fetchedInteriorEle = await (await fetch(apiUrl, options)).json();
      const interiorEleRes = fetchedInteriorEle?.response;
      console.log("interior ele res is====", interiorEleRes);
      setInteriorEleData(interiorEleRes);
    } catch (error) {
      console.log("interior elements error is===", error);
    } finally {
      setLoading(false);
    }
  };
  console.log("interior ele data===", interiorEleData);

  // const getPropertyBlock = async () => {
  //   const apiUrl = `${environmentUrl}/questionnaire/getPropertyBlock.php`;
  //   const options = {
  //     method: "GET",
  //   };
  //   const response = await fetch(apiUrl, options);
  //   const fetchedData = await response.json();
  //   const propertyBlockData = fetchedData?.response;
  //   let value = {};
  //   fetchedData?.response.forEach((property) => {
  //     value[property.enter_section] = { tabs: [] };
  //   });
  //   setTotalAddons(value);
  //   setPropertyBlock(propertyBlockData);
  // };
  // console.log("total addons", totalAddons);

  const getMaterialMaster = async () => {
    const apiUrl = `${environmentUrl}/questionnaire/getMaterialMaster.php`;
    const options = { method: "GET" };
    const response = await fetch(apiUrl, options);
    const fetchedData = await response.json();
    const materialMasterData = fetchedData?.response;
    setMaterialMaster(materialMasterData);
  };

  const getVendorsData = async () => {
    const apiUrl = `${environmentUrl}/vendor/get.php?vendorClass=${projectData?.manufacturer_classification}`;
    const options = {
      method: "GET",
    };
    const vendorFetch = await (await fetch(apiUrl, options)).json();
    const vendorRes = vendorFetch?.response;
    setVendorData(vendorRes);
    setVendorClass(projectData?.manufacturer_classification);
  };

  // pagination
  const quotesPerPage = 10;

  const [quoteCurrentPage, setQuoteCurrentPage] = useState(1);

  const quoteIndexLast = quoteCurrentPage * quotesPerPage;
  const quoteIndexFirst = quoteIndexLast - quotesPerPage;

  const currentQuotes = interiorEleData.slice(quoteIndexFirst, quoteIndexLast);

  const quoteTotalPages = Math.ceil(interiorEleData.length / quotesPerPage);

  const handleQuotePageChange = (pageNumber) => {
    setQuoteCurrentPage(pageNumber);
    // window.scrollTo({ top: 0, behavior: "smooth" });
  };

  const handleQuotePrev = () => {
    if (quoteCurrentPage > 1) setQuoteCurrentPage(quoteCurrentPage - 1);
    // window.scrollTo({ top: 0, behavior: "smooth" });
  };

  const handleQuoteNext = () => {
    if (quoteCurrentPage < quoteTotalPages)
      setQuoteCurrentPage(quoteCurrentPage + 1);
    // window.scrollTo({ top: 0, behavior: "smooth" });
  };
  // pagination end

  useEffect(() => {
    getVendorsData();
  }, [projectData]);

  useEffect(() => {
    // getPropertyBlock();
    getMaterialMaster();
  }, []);

  // console.log("interior element data is ==", addonsData);
  // submitting form to get a quote

  const submitFormBtn = (data) => {
    // setBlockSqft(data.propertyBlockSft);
    setConfirmation(true);
  };

  const getInteriorEle = async (block) => {
    const apiUrl = `${environmentUrl}/questionnaire/getInteriorElementMaster.php?propertyBlock=${block}`;
    const options = {
      method: "GET",
    };
    const response = await fetch(apiUrl, options);
    const fetchedData = await response.json();
    const interiorEleData = fetchedData?.response;
    setInteriorEle(interiorEleData);
    setLoading(false);
  };

  useEffect(() => {
    async function element() {
      // await getInteriorEle();
      setLoading(false);
    }
    element();
  }, [propertyBlockVal]);
  // console.log("interEle data========", interiorEle);

  // const handleEachBlockSqft = (event) => {
  //   setBlockSqft(event.target.value);
  // };

  const getData = async (data) => {
    return data;
  };

  const [itemAdded, setItemAdded] = useState(false);
  const addInteriorElements = (ele) => {
    console.log("element id is", ele.element_id);
    console.log("propertyBlockVal", propertyBlockVal);
    let objVal = getItemValue(propertyBlock, "section_id", propertyBlockVal);
    // console.log("objVal====", objVal);
    let section = objVal["enter_section"];
    let modfiedSection = addonsData[section];
    // console.log("modified selection is====", modfiedSection);
    // modfiedSection.map((each) => {
    //   let index = modfiedSection.indexOf(each.element_id);
    //   console.log("index is", index);
    // });

    modfiedSection.push(ele);
    setAddonsData({
      ...addonsData,
      [section]: modfiedSection,
      utilizedBudget: utilizedBudget,
    });
  };

  const removeInteriorElements = (ele) => {
    const propValue = propertyBlock.find(
      (element) => element.section_id == propertyBlockVal
    );
    const currentTab = totalAddons[propValue?.enter_section].tabs[tabIndex];
    const removedItem = currentTab.find(
      (item) => item.element_id === ele.element_id
    );

    // Proceed only if the element exists in that tab
    if (!removedItem) {
      toast.error("Element not found in tab.");
      return;
    }
    // Deduct the removed item's amount from utilized budget
    const newUtilizedBudget =
      Number(utilizedBudget) - Number(removedItem.maximum_price);
    setUtilizedBudget(newUtilizedBudget);

    // Recalculate remaining budget
    setRemainingBudget(Number(totalProjectBudget) - newUtilizedBudget);

    const updatedTabs = totalAddons[propValue?.enter_section].tabs.map(
      (tab, i) =>
        i === tabIndex
          ? tab.filter((item) => item.element_id !== ele.element_id)
          : tab
    );

    setTotalAddons({
      ...totalAddons,
      [propValue?.enter_section]: {
        ...totalAddons[propValue?.enter_section],
        tabs: updatedTabs,
      },
    });

    setAddedElements((prev) =>
      prev.filter((id) => id !== `${ele.element_id}_${tabIndex}`)
    );

    toast.success("Successfully Removed from Quotation Estimate");
  };

  const handleMaterialFilter = async (event) => {
    const materialFilter = event.target.value;
    setMaterialFilterVal(materialFilter);
    const apiUrl = `${environmentUrl}/questionnaire/getInteriorElements.php?propertyBlock=${propertyBlockVal}&&interiorElement=${interiorEleVal}&&material=${materialFilter}`;
    const options = {
      method: "GET",
    };
    const fetchedInteriorEle = await (await fetch(apiUrl, options)).json();
    const interiorEleRes = fetchedInteriorEle?.response;
    setInteriorEleData(interiorEleRes);
    setLoading(false);
  };
  const handleDesignFilter = async (event) => {
    const designFilter = event.target.value;
    setDesignFilterVal(designFilter);
    const apiUrl = `${environmentUrl}/questionnaire/getInteriorElements.php?propertyBlock=${propertyBlockVal}&&interiorElement=${interiorEleVal}&&material=${materialFilterVal}&&design=${designFilter}`;
    const options = {
      method: "GET",
    };
    const fetchedInteriorEle = await (await fetch(apiUrl, options)).json();
    const interiorEleRes = fetchedInteriorEle?.response;
    setInteriorEleData(interiorEleRes);
    setLoading(false);
  };

  const handleChanges = async (event, newValue) => {
    setRange(newValue);
    const apiUrl = `${environmentUrl}/questionnaire/getInteriorElements.php?propertyBlock=${propertyBlockVal}&&interiorElement=${interiorEleVal}&&material=${materialFilterVal}&&minPrice=${range[0]}&&maxPrice=${range[1]}`;
    const options = {
      method: "GET",
    };
    const fetchedInteriorEle = await (await fetch(apiUrl, options)).json();
    const interiorEleRes = fetchedInteriorEle?.response;
    setInteriorEleData(interiorEleRes);
    setLoading(false);
  };

  const getAllAvailableItemsOfNewPlan = async (classification) => {
    console.log("classification", classification);

    try {
      setLoading(true);
      const apiUrl = `${environmentUrl}/questionnaire/getAvailableClassElements.php?classification=${classification}`;
      const options = {
        method: "GET",
      };
      const response = await fetch(apiUrl, options);
      const fetchedData = await response.json();
      const allAvailableItems = fetchedData?.response;
      setAllAvailableItems(allAvailableItems);
      return allAvailableItems;
    } catch (error) {
      console.log("get all available items of new plan error is===", error);
    } finally {
      setLoading(false);
    }
  };

  const validateExistingTotalAddons = (allItems) => {
    console.log("all items are=====", allItems, totalAddons);
    const updatedClassifcationItems = allItems;
    const updatedClassification = projectData?.product_classification;
    const updatedSelectedItems = {};
    const removedElementsForPopup = {};

    Object.entries(totalAddons).forEach(([roomName, roomData]) => {
      const { tabs } = roomData;

      const updatedTabs = tabs.map((tab, tabIndex) => {
        const updatedTab = [];

        tab.forEach((element) => {
          const matchedElement = allItems.find(
            (newEl) =>
              newEl.element_name === element.element_name &&
              newEl.element_category === element.element_category &&
              newEl.material === element.material
          );

          if (matchedElement) {
            updatedTab.push(matchedElement);
          } else {
            if (!removedElementsForPopup[roomName]) {
              removedElementsForPopup[roomName] = { tabs: tabs.map(() => []) };
            }
            removedElementsForPopup[roomName].tabs[tabIndex].push(element);
          }
        });

        return updatedTab;
      });

      updatedSelectedItems[roomName] = {
        ...roomData,
        tabs: updatedTabs,
      };
    });

    return {
      updatedSelectedItems,
      removedElementsForPopup,
    };
  };

  const getSaveMoreGoodPlans = async (plan) => {
    console.log("save more good plans hitted", plan);
    console.log("project details=====", projectData);
    try {
      setLoading(true);
      const apiUrl = `${environmentUrl}/questionnaire/updateToSaveMoreGoodPlans.php`;
      const options = {
        method: "put",
        headers: {
          "Content-Type": "application/json",
          Authorization: "Bearer " + localStorage.getItem("token"),
        },
        body: JSON.stringify({
          queId: projectData?.que_id,
          makers_classification: plan?.makers_class,
          material_classification: plan?.material_class,
        }),
      };
      const response = await (await fetch(apiUrl, options)).json();
      if (response?.status) {
        toast.success(response?.response);
        setOpenSaveMore(false);
        await getProjectAndBudgetDetails();
        await getVendorsData();
        const allAvailableItems = await getAllAvailableItemsOfNewPlan(
          plan?.material_class
        );
        // 2. Build lookup map keyed by element_name + model
        const newPlanElementMap = {};
        for (const item of allAvailableItems) {
          const key = `${item.element_name}_${item.model}`;
          newPlanElementMap[key] = item;
        }

        const removedElements = [];
        const updatedTotalAddons = {};

        // 3. Loop through your current quote
        for (const [blockName, blockData] of Object.entries(totalAddons)) {
          const newTabs = [];

          for (const tabElements of blockData.tabs) {
            const newTabElements = [];

            for (const element of tabElements) {
              const key = `${element.element_name}_${element.model}`;
              const matchingElement = newPlanElementMap[key];

              if (matchingElement) {
                // Element exists in new plan → replace it with new plan data
                newTabElements.push({
                  ...matchingElement,
                  eleSft: element.eleSft, // keep user sqft
                  eleQtyPerBlock: element.eleQtyPerBlock, // keep user quantity
                  product_classification: plan?.makers_class,
                  material_classification: plan?.material_class,
                });
              } else {
                // Not found in new plan → remove
                removedElements.push({
                  ...element,
                  blockName,
                });
              }
            }

            newTabs.push(newTabElements);
          }

          updatedTotalAddons[blockName] = {
            tabs: newTabs,
          };
        }

        setTotalAddons(updatedTotalAddons);
        setTabIndex(0);

        console.log("Removed elements:", removedElements);
        const formattedUnavailableElements =
          formatRemovedElements(removedElements);

        if (removedElements.length > 0) {
          setRemovedPopupList(formattedUnavailableElements);
          setShowRemovedPopup(true);
        } else {
          toast.success("Classification upgraded successfully.");
        }
      }
    } catch (error) {
      console.log("error in save more good plans", error);
    } finally {
      setLoading(false);
    }
  };

  const formatRemovedElements = (removedElements) => {
    const formatted = {};

    removedElements.forEach((ele) => {
      const block = ele.blockName || "Others"; // Default block if missing

      if (!formatted[block]) {
        formatted[block] = { tabs: [[]] }; // Initialize with one tab
      }

      formatted[block].tabs[0].push(ele); // Add to first tab
    });

    return formatted;
  };

  const steps = [
    {
      target: "#takeTourBtn",
      content:
        "By Clicking Start Tour You Will Comes To Know How To Interact With The Flow To Make a Quotation",
      disableBeacon: true,
    },
    {
      target: "#cusPropertBlock",
      content:
        "By Selecting This property Block Helps You For Quote Estimation of Particular Block After Completing Whole Process for First Block You can Select Another Block And Repeat The Same Until Whole Quote For Your Dream House Get Estimated",
    },
    {
      target: "#noOfBlocks",
      content:
        "By Selecting no of blocks For How Many Blocks Do You Want the Quotation For, (For Example Your Having 2halls in your house you want quote for both hall-1 and hall-2 So tabs will Generate Based on This Quantity",
    },
    {
      target: "#cusInteriorEle",
      content:
        "Based On The Property Block You Selected All the Interior Elements Like Tv Units, Wardrobes, Sliders.... Will Be Display In the Right Side",
    },
    {
      target: "#blogSqft",
      content:
        "Enter Total SquareFeet Of Your Room That You Selected In Property Block Dropdown",
    },
    {
      target: "#materialFilter",
      content:
        "Comes under Filter, By Using Material Filter Interior Elements will Get Filtered Based on filter You Selected ",
    },
    {
      target: "#designFilter",
      content:
        "Comes under Filter, By Using Material Filter Interior Elements will Get Filtered Based on filter You Selected ",
    },
    {
      target: "#priceFilter",
      content:
        "Comes under Filter, By Using Material Filter Interior Elements will Get Filtered Based on filter You Selected",
    },
    {
      target: "#interiorTabs",
      content:
        "Based on No of Blocks You Selected Tabs Will Display Here You Switch Tabs For each Interior Block To Get Estimation",
    },
    {
      target: "#interiorTabPanels",
      content:
        "Based on interior Element Dropdown You Selected All the Elements will Display Here ",
    },
    {
      target: "#addonCartButton",
      content:
        "By Clicking Add Button This Element Get Selected and it Goes in Add on Slider Location at Right Stickey",
    },
  ];

  const handleImageClick = (imagesArray, index) => {
    setLightboxSlides(imagesArray);
    setSelectedIndex(index);
    setOpenLightbox(true);
  };

  return (
    <>
      {/* <Joyride
        steps={steps}
        continuous={true}
        debug={true}
        run={true}
        showSkipButton={true}
        showProgress={true}
        spotlightClicks={true}
        spotlightPadding={5}
        getHelpers={undefined}
        styles={{
          options: {
            arrowColor: "#fff",
            backgroundColor: "#ffffff",
            overlayColor: "rgb(0 0 0 / 45%)",
            primaryColor: "#5caeab",
            textColor: "#000",
            zIndex: 0,
            spotlightShadow: "0 0 15px rgba(0, 0, 0, 0.5)",
            beaconSize: 36,
          },
          buttonNext: {
            height: "auto",
            width: "auto",
            fontSize: 12,
          },
        }}
      /> */}
      {/* <section className="questionnaire pt-0 pt-0 mt--125">
        <header>
          <div className="bredcum">
            <img
              src="assets/images/multi-banners/image-1.jpg"
              alt="lightBanner"
              className="banner-content image_zoom"
            />
            <h2 className="mt-0 mb-0">Questionnaire</h2>
          </div>
        </header>

        <div className="container-fluid ">
          <div className="balance row budget-management-nav">
            <div className=" col-lg-4 col-md-4 col-sm-6 col-xs-12 budget-management-block">
              <div className="sub-heading-container mr-3 details">
                <p>
                  <span>Customer Name</span>
                </p>
                <p>
                  <span>Contact</span>
                </p>
                <p>
                  <span>Property</span>
                </p>
              </div>
              <div className="values-container">
                <p>
                  : {`${projectData?.first_name} ${projectData?.last_name}`}
                </p>
                <p>: {`${projectData?.mobile} / ${projectData?.email}`}</p>
                <p>
                  :
                  {`${projectData?.property} / (${projectData?.property_type})`}
                </p>
              </div>
            </div>
            <div className=" col-lg-4 col-md-4 col-sm-6 col-xs-12 budget-management-block project">
              <div className="sub-heading-container mr-3 project">
                <p>
                  <span>Project Name</span>
                </p>
                <p>
                  <span>Project Type</span>
                </p>
                <p>
                  <span>Location</span>
                </p>
              </div>
              <div className="values-container">
                <p>
                  :{" "}
                  {`MR.INTRO0${projectData?.customer_id}-${projectData?.property}(${projectData?.property_type})-${projectData?.que_id}`}
                </p>
                <p>
                  :{" "}
                  {`${projectData?.product_classification} & ${projectData?.manufacturer_classification}`}
                </p>
                <p>
                  :{" "}
                  {`${projectData?.state}, ${projectData?.city}, ${projectData?.locality}`}
                </p>
              </div>
            </div>

            <div className="col-lg-4 col-md-4 col-sm-12 col-xs-12 budget-management-block amount">
              <div className="sub-heading-container mr-3 amount">
                <p>
                  <span>Total Amount</span>
                </p>
                <p>
                  <span>Utilized Amount</span>
                </p>
                <p>
                  <span>Balance Amount</span>
                </p>
              </div>
              <div className="values-container">
                <p>: {formatCurrency(String(totalProjectBudget))}/-</p>
                <p>: {formatCurrency(String(utilizedBudget))}/-</p>
                <p className={remainingBudget <= 30000 ? "exceed_bal" : ""}>
                  : {formatCurrency(String(remainingBudget))}/-
                </p>
              </div>
            </div>
          </div>
        </div>

        <div className="container-fluid">
          <div className="row form">
            <div className="form form-container col-lg-3 col-md-4 col-sm-12 col-xs-12">
              <div className="tab element">
                <h4>Property Info</h4>
                <form method="POST" onSubmit={handleSubmit(submitFormBtn)}>
                  <div className="form-row">
                    <div
                      className="form-group col-lg-12 col-md-12 col-sm-6 col-xs-12"
                      id="cusPropertBlock"
                    >
                      <label
                        htmlFor="spCoverPage"
                        className="questionnair-form"
                      >
                        Property Block
                      </label>
                      <select
                        className={
                          errors.propertyBlock
                            ? "form-control selectpicker is-invalid"
                            : "form-control selectpicker"
                        }
                        {...register("propertyBlock", {
                          required: true,
                          onChange: (e) => {
                            handlePropertyBlock(e);
                          },
                        })}
                      >
                        <option value="">Select</option>
                        {propertyBlock.map((eachBlock, index) => (
                          <option value={eachBlock?.section_id} key={index}>
                            {eachBlock?.enter_section}
                          </option>
                        ))}
                      </select>
                      {errors.propertyBlock && (
                        <p className="error-msg">This field is required</p>
                      )}
                    </div>

                    <div
                      className="form-group col-lg-12 col-md-12 col-sm-6 col-xs-12"
                      id="noOfBlocks"
                    >
                      <label
                        htmlFor="spCoverPage"
                        className="questionnair-form"
                      >
                        No of Property Blocks(rooms)
                      </label>
                      <select
                        className={
                          errors.propertyBlock
                            ? "form-control selectpicker is-invalid"
                            : "form-control selectpicker"
                        }
                 
                        {...register("noOfPropertyBlocks", {
                          required: true,
                          onChange: (e) => {
                            SelectTabsWhenChanged(e);
                          },
                        })}
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
                      {errors.noOfPropertyBlocks && (
                        <p className="error-msg">This field is required</p>
                      )}
                    </div>
                  </div>

                  <div className="form-row">
                    <div
                      className="form-group col-lg-12 col-md-12 col-sm-6 col-xs-12"
                      id="cusInteriorEle"
                    >
                      <label htmlFor="" className="questionnair-form">
                        Interior Elements
                      </label>
                      {interiorEle === "Data not found" ||
                      interiorEle.length == 0 ? (
                        <select
                          className={
                            errors.propertyBlock
                              ? "form-control selectpicker is-invalid"
                              : "form-control selectpicker"
                          }
                          onChange={handleInteriorElements}
                        >
                          <option value="">Select</option>
                        </select>
                      ) : (
                        <select
                          className={
                            errors.propertyBlock
                              ? "form-control selectpicker is-invalid"
                              : "form-control selectpicker"
                          }
                     
                          id="cusInteriorEle"
                          {...register("InteriorElement", {
                            required: true,
                            onChange: (e) => {
                              handleInteriorElements(e);
                            },
                          })}
                        >
                          <option value="">Select</option>
                          {interiorEle.length > 0 &&
                            interiorEle.map((eachEle, index) => (
                              <option value={eachEle?.element_id} key={index}>
                                {eachEle?.element_name}
                              </option>
                            ))}
                        </select>
                      )}

                      {errors.InteriorElement && (
                        <p className="error-msg">This field is required</p>
                      )}
                    </div>
                  </div>

                  <div className="form-row">
                    <div
                      className="form-group col-lg-12 col-md-12 col-sm-6 col-xs-12"
                      id="materialFilter"
                    >
                      <label htmlFor="" className="questionnair-form">
                        Material
                      </label>
                      <select
                        className="form-control selectpicker"
                        name="materialType"
                        onChange={handleMaterialFilter}
                      >
                        <option value="">Select</option>
                        {materialMaster.map((material, index) => (
                          <option value={material?.material_id} key={index}>
                            {material?.material_name}
                          </option>
                        ))}
                      </select>
                      <p id="errText" className="error-msg"></p>
                    </div>
                    <div
                      className="form-group col-lg-12 col-md-12 col-sm-6 col-xs-12"
                      id="designFilter"
                    >
                      <label htmlFor="" className="questionnair-form">
                        Design
                      </label>
                      <select
                        className="form-control selectpicker"
                        name="designType"
                        onChange={handleInteriorElements}
                        id="cusInteriorEle"
                      >
                        <option value="">Select</option>
                        <option value="1">Classic</option>
                        <option value="2">Modern</option>
                      </select>
                    </div>
                  </div>

                  <div className="form-row">
                    <div
                      className="form-group col-lg-12 col-md-12 col-sm-6 col-xs-12"
                      id="priceFilter"
                    >
                      <label
                        htmlFor="spCoverPageColour"
                        className="questionnair-form"
                      >
                        Price Range
                      </label>
                      <div className="price-filter">
                        <Slider
                          value={range}
                          onChange={handleChanges}
                          valueLabelDisplay="auto"
                          max={500000}
                          min={500}
                        />
                        <p className="text-center">
                          {`Prince Range ₹ ${range[0].toLocaleString()} - ${range[1].toLocaleString()}`}
                        </p>
                      </div>
                    </div>
                  </div>
                  <button className="btn btn-primary quotation" type="submit">
                    Submit
                  </button>
                </form>
              </div>
            </div>
            <div className="col-lg-9 col-md-8 col-sm-12  images-container">
              {loading && <SubLoader />}

              {!loading && (
                <>
                  <Tabs>
                    <TabList
                      className="why-choose-nav elements"
                      id="interiorTabs"
                    >
                      {noOfTabs.map((each, index) => (
                        <Tab
                          key={index}
                          className="why-choose-nav-item elements"
                          onClick={() => {
                            setTabIndex(index);
                          }}
                        >
                          {`${GetElementNameById(
                            propertyBlock,
                            propertyBlockVal,
                            "section_id",
                            "enter_section"
                          )}-${index + 1}`}
                        </Tab>
                      ))}
                    </TabList>
                    {noOfTabs != undefined && interiorEleData.length > 0 ? (
                      noOfTabs.map((each, index) => (
                        <TabPanel id={`interiorTabPanel${each}`} key={index}>
                          <div className="row">
                            {interiorEleData.length === 0 ? (
                              <div className="row">
                                <div className="result-card">
                                  <img
                                    src="assets/images/emptyWish.gif"
                                    alt="no results"
                                    className="no-cart-items"
                                  />
                                  <p>No Interior Elements Found</p>
                                </div>
                              </div>
                            ) : (
                              interiorEleData.map((each, index) => (
                                <div
                                  className="col-lg-4 col-md-6 col-sm-6 col-xs-12"
                                  key={index}
                                >
                                  <div id="image-container">
                                    <div
                                      className="questionnair-cat-image"
                                      id="dragTvUnit"
                                    >
                                      <SlideshowLightbox className="card-lightbox">
                                        <img
                                          src={`${envImgUrl}/Uploads/elements/${each?.element_image}`}
                                          alt={each?.element_alttext}
                                          className="questionnair-img"
                                        />
                                        <img
                                          src={`${envImgUrl}/Uploads/elements/${each?.image_1}`}
                                          alt={each?.alttext_1}
                                          className="questionnair-img"
                                        />
                                        <img
                                          src={`${envImgUrl}/Uploads/elements/${each?.image_2}`}
                                          alt={each?.alttext_2}
                                          className="questionnair-img"
                                        />
                                        <img
                                          src={`${envImgUrl}/Uploads/elements/${each?.image_3}`}
                                          alt={each?.alttext_3}
                                          className="questionnair-img"
                                        />
                                        <img
                                          src={`${envImgUrl}/Uploads/elements/${each?.image_4}`}
                                          alt={each?.alttext_4}
                                          className="questionnair-img"
                                        />
                                      </SlideshowLightbox>

                                      <div className="image-details-container form">
                                        <div>
                                          <h6 className="mb-1">
                                            {`${each?.element_name} - ${each?.model}`}

                                          
                                          </h6>
                                          <p
                                            className="elementtdesc"
                                            dangerouslySetInnerHTML={{
                                              __html: each?.element_description,
                                            }}
                                          ></p>
                                          <div className="pricing-detail-container">
                                            <div className="pricing-details">
                                              <p>
                                                <span>Material Type:</span>{" "}
                                                {each?.material}
                                              </p>
                                            </div>

                                            <div className="quotation-element-price">
                                              <div className="pricing-details dimension">
                                                <p>
                                                  <span>Length:</span>
                                                  {each?.length}
                                                </p>
                                                <p>
                                                  <span>Width:</span>{" "}
                                                  {each?.width}
                                                </p>
                                                <p>
                                                  <span>Height:</span>{" "}
                                                  {each?.height}
                                                </p>
                                              </div>
                                              <div className="pricing-details minmax">
                                                <p>
                                                  <span>1sqft:</span>{" "}
                                                  {each?.cost_per_sqft}
                                                  /-
                                                </p>
                                                <p className="price-calculation">
                                                  <span>min:</span>{" "}
                                                  {each?.minimum_price}/-
                                                </p>
                                                <p className="price-calculation">
                                                  <span>max:</span>{" "}
                                                  {each?.maximum_price}/-
                                                </p>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <button
                                          type="button"
                                          className="btn btn-success form"
                                          data-toggle="tooltip"
                                          data-placement="top"
                                          title="Click to add Element"
                                          onClick={() => {
                                            PushItemsIntoTabs(each);
                                          }}
                                        >
                                          <IoBagAdd />
                                        </button>
                                        {itemAdded && (
                                          <button
                                            type="button"
                                            className="btn btn-danger remove form"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Click to add Element"
                                            onClick={() => {
                                              removeInteriorElements(each);
                                            }}
                                          >
                                            <IoBagRemove />
                                          </button>
                                        )}
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              ))
                            )}
                            <div className="pagination-wrapper">
                              <ReactPaginate
                                breakLabel="...."
                                nextLabel="Next >"
                                onPageChange={3}
                                pageRangeDisplayed={2}
                                pageCount={9}
                                previousLabel="< Prev"
                              />
                            </div>
                          </div>
                        </TabPanel>
                      ))
                    ) : (
                      <>
                    
                        <div className="container col-md-12 col-sm-12 col-xs-12">
                          <div className="row">
                            <div className="result-card image-waiting-container">
                              <div className="image-waiting-content col-lg-7 col-md-7 col-sm-12 col-xs-12 text-left">
                                <h4>
                                  Guide To Make Quotation For Ur Dream Interiors{" "}
                                </h4>
                                <ul>
                                  <li>
                                    Select An Option From Property Block In Left
                                    Side Form
                                  </li>
                                  <li>
                                    Now Select Quantity For No Of Property
                                    Blocks
                                  </li>
                                  <li>
                                    Select The Interior Element(Tv unit,
                                    wardroabe etc....)
                                  </li>
                                  <li>
                                    You Can Also Select Interior Elements By
                                    Applying Below Filters (price, material,
                                    design...)
                                  </li>
                                  <li>
                                    After Submitting Your Data Quotation Will
                                    Get Prepared And Displayed By Clicking
                                    Sticky Quote Button On Right side End{" "}
                                  </li>
                                </ul>
                                <Link to="">
                                  <button type="button" id="takeTourBtn">
                                    Start Tour
                                  </button>
                                </Link>
                              </div>
                              <div className="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                <img
                                  src="assets/images/image-filtering.jpg"
                                  alt="no results"
                                  className="no-cart-items"
                                />
                              </div>
                            </div>
                          </div>
                        </div>
                      </>
                    )}
                  </Tabs>
                </>
              )}
            </div>
          </div>
          <Quotation addonsData={addonsData} />
          <InteriorElementsAddOns totalAddons={totalAddons} />
          <VendorList vendorList={vendorData} vendorClass={vendorClass} />
        </div>
      </section>
      <ConfiramtionPopup
        show={confirmation}
        close={() => setConfirmation(false)}
        totalAddons={totalAddons}
        queId={queryParamVal}
      />
      <EleSftAndQty
        eleId={popupIdData}
        show={eleQtyPopup}
        close={() => setEleQtyPopup(false)}
        getAllItems={getAllItems}
      /> */}

      {/* edit questionnaire */}

      <div className="bg-leaf-img">
        <div>
          <h1 className="pd-txt m-0">Project Details</h1>
        </div>
      </div>
      <div className="container new-con-width mt-3">
        <div className="row-main">
          <div className="row detailsRibbon">
            <div className="col-md-3 element">
              <div className="d-flex prjects-font ot-fnt">
                <div className="wi-40">Customer Name</div>
                <div className="wi-10">:</div>
                <div className="wi-50">{`${projectData?.first_name} ${projectData?.last_name}`}</div>
              </div>
              <div className="d-flex prjects-font  ot-fnt">
                <div className="wi-40">Contact</div>
                <div className="wi-10">:</div>
                <div className="wi-50">{`${projectData?.mobile}`}</div>
              </div>
              <div className="d-flex prjects-font ot-fnt">
                <div className="wi-40">Property</div>
                <div className="wi-10">:</div>
                <div className="wi-50">{`${projectData?.property} / (${projectData?.property_type})`}</div>
              </div>
              <div></div>
            </div>
            <div className="col-md-4 element">
              <div className="d-flex prjects-font ot-fnt">
                <div className="wi-40">Project Name</div>
                <div className="wi-10">:</div>
                <div className="wi-50">
                  {" "}
                  {`VOYD0${projectData?.customer_id}-${projectData?.property}(${projectData?.property_type})-${projectData?.que_id}`}
                </div>
              </div>
              <div className="d-flex prjects-font ot-fnt">
                <div className="wi-40">Project Type</div>
                <div className="wi-10">:</div>
                <div className="wi-50">{`${projectData?.product_classification} & ${projectData?.manufacturer_classification}`}</div>
              </div>
              <div className="d-flex prjects-font ot-fnt">
                <div className="wi-40">Location</div>
                <div className="wi-10">:</div>
                <div className="wi-50 capitalize">
                  {formatLocation(
                    projectData?.state,
                    projectData?.city,
                    projectData?.locality,
                    projectData?.near_by
                  )}
                </div>
                {/* <div className="wi-50">{`${projectData?.state}, ${projectData?.city}, ${projectData?.locality}`}</div> */}
              </div>
            </div>
            <div className="col-md-3 element">
              <div className="d-flex prjects-font ot-fnt">
                <div className="wi-40">Total budget</div>
                <div className="wi-10">:</div>
                <div className="wi-50">
                  {formatCurrency(totalProjectBudget)} INR
                </div>
              </div>
              <div className="d-flex prjects-font ot-fnt">
                <div className="wi-40">Utilized</div>
                <div className="wi-10">:</div>
                <div className="wi-50">
                  {formatCurrency(utilizedBudget)} INR
                </div>
              </div>
              <div className="d-flex prjects-font ot-fnt">
                <div className="wi-40">Balance</div>
                <div className="wi-10">:</div>
                <div className="wi-50">
                  {formatCurrency(totalProjectBudget - utilizedBudget)} INR
                </div>
              </div>
            </div>
            <div className="col-md-2 d-flex justify-content-center align-items-center view-bn pricingOptionBtn">
              <button
                type="button"
                className="v-price options"
                onClick={() => setOpenSaveMore(true)}
              >
                View Pricing Options <FaChevronRight />
              </button>
            </div>
          </div>
        </div>
        <div className="row mt-3">
          <div className="col-md-3  ">
            <div className="filterStickyOuter">
              <form
                method="post"
                onSubmit={handleSubmit(submitFormBtn)}
                className="submitQuotForm"
              >
                <div className="filter-div mb-2 p-4">
                  <div className="d-flex mb-4">
                    <div>
                      <h6 className="fil-txt text-dark m-0">Filter</h6>
                    </div>
                    <div className="px-3 d-flex align-items-center text-dark slider-icon">
                      <PiSlidersHorizontalBold />
                    </div>
                  </div>
                  <div className="col-md-10 quest-gaps">
                    <select
                      id="cars"
                      className={
                        errors.propertyBlock
                          ? "sel-inp cursor-pointer is-invalid selectedOption"
                          : "sel-inp cursor-pointer selectedOption"
                      }
                      {...register("propertyBlock", {
                        required: true,
                        onChange: (e) => {
                          handlePropertyBlock(e);
                        },
                      })}
                    >
                      <option value="" className="txt-gry">
                        Property Block *
                      </option>
                      {propertyBlock.map((eachBlock, index) => (
                        <option
                          value={eachBlock?.section_id}
                          key={index}
                          className="txt-gry"
                        >
                          {eachBlock?.enter_section}
                        </option>
                      ))}
                    </select>
                    {errors.propertyBlock && (
                      <p className="error-msg">Select property block</p>
                    )}
                  </div>

                  <div className="col-md-10 quest-gaps">
                    <select
                      id="cars"
                      className={
                        errors.noOfPropertyBlocks
                          ? "sel-inp cursor-pointer is-invalid"
                          : "sel-inp cursor-pointer"
                      }
                      {...register("noOfPropertyBlocks", {
                        required: true,
                        onChange: (e) => {
                          SelectTabsWhenChanged(e);
                        },
                      })}
                    >
                      <option value="" className="txt-gry">
                        No of Property Blocks(rooms) *
                      </option>

                      <option value="1" className="txt-gry">
                        1
                      </option>
                      <option value="2" className="txt-gry">
                        2
                      </option>
                      <option value="3" className="txt-gry">
                        3
                      </option>
                      <option value="4" className="txt-gry">
                        4
                      </option>
                      <option value="5" className="txt-gry">
                        5
                      </option>
                      <option value="6" className="txt-gry">
                        6
                      </option>
                      <option value="7" className="txt-gry">
                        7
                      </option>
                      <option value="8" className="txt-gry">
                        8
                      </option>
                      <option value="9" className="txt-gry">
                        9
                      </option>
                      <option value="10" className="txt-gry">
                        10
                      </option>
                    </select>
                    {errors.noOfPropertyBlocks && (
                      <p className="error-msg">Select block rooms</p>
                    )}
                  </div>
                  <div className="col-md-10 quest-gaps">
                    {interiorEle === "Data not found" ? (
                      <select
                        className={
                          errors.propertyBlock
                            ? "sel-inp cursor-pointer is-invalid"
                            : "sel-inp cursor-pointer"
                        }
                        onChange={handleInteriorElements}
                      >
                        <option value="" className="txt-gry">
                          {" "}
                          Interior Elements *
                        </option>
                      </select>
                    ) : (
                      <select
                        className={
                          errors.propertyBlock
                            ? "sel-inp cursor-pointer is-invalid"
                            : "sel-inp cursor-pointer"
                        }
                        id="cusInteriorEle"
                        {...register("InteriorElement", {
                          required: true,
                          onChange: (e) => {
                            handleInteriorElements(e.target.value);
                          },
                        })}
                      >
                        <option value="">Interior Elements *</option>
                        {interiorEle.map((eachEle, index) => (
                          <option
                            value={eachEle?.element_id}
                            className="txt-gry"
                            key={index}
                          >
                            {eachEle?.element_name}
                          </option>
                        ))}
                      </select>
                    )}

                    {errors.InteriorElement && (
                      <p className="error-msg">Select interior elements</p>
                    )}
                  </div>

                  <div className="col-md-10 quest-gaps">
                    <select
                      name="materialType"
                      id="cars"
                      className="sel-inp cursor-pointer"
                      onChange={handleMaterialFilter}
                    >
                      <option value="" className="txt-gry">
                        Material
                      </option>
                      {materialMaster.map((material, index) => (
                        <option
                          value={material?.material_id}
                          key={index}
                          className="txt-gry"
                        >
                          {material?.material_name}
                        </option>
                      ))}
                    </select>

                    {/* <p id="errText" className="error-msg"></p> */}
                  </div>

                  <div className="col-md-10 quest-gaps">
                    <select
                      name="designType"
                      onChange={handleDesignFilter}
                      id="cusInteriorEle"
                      className="sel-inp cursor-pointer"
                    >
                      <option value="" className="txt-gry">
                        Design
                      </option>
                      <option value="Classic">Classic</option>
                      <option value="Modern">Modern</option>
                    </select>
                  </div>

                  <div className="col-md-12 quest-gaps mda-btm">
                    <div
                      name="cars"
                      id="cars"
                      className="sel-inp border-none mda-price"
                    >
                      Price Range
                    </div>
                  </div>

                  {/* <div className="progress-bar-container">
                <div className="progress-line">
                  <div className="progress-button">
                    <FaAngleDoubleRight />{" "}
                  </div>
                </div>
                </div> */}
                  <Slider
                    className="progressLine"
                    value={range}
                    onChange={handleChanges}
                    valueLabelDisplay="auto"
                    max={500000}
                    min={500}
                  />
                  {/* <p className="text-center">{`Prince Range ₹ $ - $`}</p> */}
                  <div className="col-md-12 d-flex justify-content-between pdng-slider border-bottom">
                    <div className="from-txt">
                      <span className="price-range-txt">
                        ₹{range[0].toLocaleString()}
                      </span>{" "}
                      From
                    </div>
                    <div className="from-txt">
                      To{" "}
                      <span className="price-range-txt">
                        ₹{range[1].toLocaleString()}
                      </span>
                    </div>
                  </div>
                  <div className="col-md-12">
                    <button className="sub-qt-btn" type="submit">
                      SUBMIT QUOTE
                    </button>
                  </div>
                </div>
              </form>
              <div className="filter-div two">
                <div className="text-center">
                  <div>
                    <img src="assets/images/Frame 30.png" alt="" />
                  </div>
                  <div className="bag-text col-grey">
                    You have note added any products to your favorite
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div className="col-md-9">
            <div className="row mb-3 questionnaireCard">
              {!loading && (
                <>
                  <Tabs>
                    <TabList className="quote-draft quatTabs" id="interiorTabs">
                      {noOfTabs.map((each, index) => (
                        <Tab
                          key={index}
                          className="quote-button tabButtons"
                          onClick={() => {
                            setTabIndex(index);
                          }}
                        >
                          {`${GetElementNameById(
                            propertyBlock,
                            propertyBlockVal,
                            "section_id",
                            "enter_section"
                          )}-${index + 1}`}
                        </Tab>
                      ))}
                    </TabList>
                    {noOfTabs != undefined && interiorEleData.length > 0 ? (
                      noOfTabs.map((each, index) => (
                        <TabPanel id={`interiorTabPanel${each}`} key={index}>
                          <div className="row liv-cards mobileLive">
                            {/* {interiorEleData.length === 0 ? ( */}
                            {currentQuotes.length === 0 ? (
                              <div className="row ">
                                <div className="result-card">
                                  <img
                                    src="assets/images/noDataFound.png"
                                    alt="no results"
                                    className="no-cart-items"
                                  />
                                  <p>No Interior Elements Found</p>
                                </div>
                              </div>
                            ) : (
                              interiorEleData.map((ele, index) => {
                                const images = [
                                  ele?.element_image,
                                  ele?.image_1,
                                  ele?.image_2,
                                  ele?.image_3,
                                  ele?.image_4,
                                ]
                                  .filter(Boolean) // Remove null/undefined
                                  .map((img) => ({
                                    src: `${envImgUrl}/Uploads/elements/${img}`,
                                  }));
                                return (
                                  <div
                                    className="col-lg-3 col-md-4 col-sm-6 p-2"
                                    key={index}
                                  >
                                    <div className="card card-sdw tt">
                                      <Carousel
                                        responsive={responsive}
                                        autoPlay={true}
                                        infinite={true}
                                        // autoPlaySpeed={2000}
                                        arrows={false}
                                        showDots={false} // Enable dots
                                      >
                                        {images.map((img, index) => (
                                          <div
                                            className="card-image"
                                            key={index}
                                          >
                                            <img
                                              src={img.src}
                                              alt={ele?.element_alttext}
                                              onClick={() =>
                                                handleImageClick(images, index)
                                              }
                                              style={{ cursor: "pointer" }}
                                            />
                                          </div>
                                        ))}
                                      </Carousel>

                                      <div className="card-content con-div">
                                        <div className="projectContent">
                                          <h5>
                                            Name <span>: </span>
                                          </h5>
                                          <h6
                                            className="colorBlue"
                                            title={ele?.element_name_display}
                                          >
                                            {`${ele?.element_name_display}`}
                                          </h6>
                                        </div>
                                        <div className="projectContent">
                                          <h5>
                                            Style <span>:</span>{" "}
                                          </h5>
                                          <h6
                                            className="colorBlue"
                                            title={ele?.model}
                                          >
                                            {`${ele?.model}`}
                                          </h6>
                                        </div>
                                        <div className="projectContent">
                                          <h5>
                                            Size <span>:</span>
                                          </h5>
                                          <h6
                                            className="sizesLine"
                                            title={`${ele?.length} x ${ele?.width} x ${ele?.height} (LxWxH)`}
                                          >
                                            <div>
                                              <span>{ele?.length}</span>
                                              <IoIosClose />
                                              <span>{ele?.width}</span>
                                              <IoIosClose />
                                              <span>{ele?.height}</span>
                                              <span> (LxWxH)</span>
                                            </div>
                                          </h6>
                                        </div>
                                        <div className="projectContent">
                                          <h5>
                                            Prize <span>: </span>
                                          </h5>
                                          <h6
                                            className="sizesLine"
                                            title={`Min - ${ele?.minimum_price}/- Max - ${ele?.maximum_price}/-`}
                                          >
                                            <div>
                                              <span>
                                                <strong className="col-black">
                                                  Min
                                                </strong>{" "}
                                                -{ele?.minimum_price}/-
                                              </span>
                                              <span>
                                                <strong className="col-black">
                                                  Max
                                                </strong>{" "}
                                                -{ele?.maximum_price}/-
                                              </span>
                                            </div>
                                          </h6>
                                        </div>
                                        <div className="projectContent">
                                          <h5>
                                            Material <span>: </span>
                                          </h5>
                                          <h6
                                            className="material"
                                            title={ele?.material_name_display}
                                          >
                                            {ele?.material_name_display}
                                          </h6>
                                        </div>

                                        <div className="projectContent">
                                          <p
                                            title={stripHTML(
                                              ele?.element_description
                                            )}
                                          >
                                            {truncateHTML(
                                              ele?.element_description,
                                              10
                                            )}
                                          </p>
                                          <div className="d-flex justify-content-end gap-1">
                                            {addedElements.includes(
                                              `${ele.element_id}_${tabIndex}`
                                            ) ? (
                                              <>
                                                <div
                                                  className="addElement"
                                                  title="Click to add Element"
                                                  onClick={() => {
                                                    removeInteriorElements(ele);
                                                  }}
                                                >
                                                  <img
                                                    src="assets/images/Remove from bag.svg"
                                                    alt=""
                                                    className="add-bg"
                                                  />
                                                </div>
                                              </>
                                            ) : (
                                              <div
                                                className="addElement"
                                                title="Click to add Element"
                                                onClick={() => {
                                                  PushItemsIntoTabs(ele);
                                                }}
                                              >
                                                <img
                                                  src="assets/images/Add to bag.svg"
                                                  alt=""
                                                  className="add-bg"
                                                />
                                              </div>
                                            )}
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                );
                              })
                            )}
                          </div>

                          {interiorEleData.length > 0 && (
                            <div className="guidesPagntion pgn-tab">
                              <div className="d-flex ft">
                                <div
                                  className="prev-t"
                                  onClick={handleQuotePrev}
                                  style={{ cursor: "pointer" }}
                                >
                                  Preview
                                </div>
                                <div className="d-flex gap-2 man-txt">
                                  {(() => {
                                    const quotePageButtons = [];
                                    const quoteVisiblePages = 2;

                                    for (let i = 1; i <= quoteTotalPages; i++) {
                                      if (
                                        i === 1 ||
                                        i === quoteTotalPages ||
                                        (i >=
                                          quoteCurrentPage -
                                            quoteVisiblePages &&
                                          i <=
                                            quoteCurrentPage +
                                              quoteVisiblePages)
                                      ) {
                                        quotePageButtons.push(
                                          <button
                                            key={i}
                                            className={`page-btns ${
                                              quoteCurrentPage === i
                                                ? "grn-btn"
                                                : ""
                                            }`}
                                            onClick={() =>
                                              handleQuotePageChange(i)
                                            }
                                          >
                                            {i}
                                          </button>
                                        );
                                      } else if (
                                        (i ===
                                          quoteCurrentPage -
                                            quoteVisiblePages -
                                            1 &&
                                          quoteCurrentPage - quoteVisiblePages >
                                            2) ||
                                        (i ===
                                          quoteCurrentPage +
                                            quoteVisiblePages +
                                            1 &&
                                          quoteCurrentPage + quoteVisiblePages <
                                            quoteTotalPages - 1)
                                      ) {
                                        quotePageButtons.push(
                                          <button
                                            key={`ellipsis-${i}`}
                                            className="page-btns"
                                            disabled
                                          >
                                            ...
                                          </button>
                                        );
                                      }
                                    }

                                    return quotePageButtons;
                                  })()}
                                </div>
                                <div
                                  className="prev-t"
                                  onClick={handleQuoteNext}
                                  style={{ cursor: "pointer" }}
                                >
                                  Next
                                </div>
                              </div>
                            </div>
                          )}
                        </TabPanel>
                      ))
                    ) : (
                      <>
                        <div className="noDataComponent">
                          <NoDataFound />
                        </div>
                      </>
                    )}
                  </Tabs>
                </>
              )}
            </div>

            <div className="row paginationNone">
              <div className="pagntion pgn-tab">
                <div className="d-flex justify-content-between ">
                  <div className="prev-t">previous page</div>
                  <div className="d-flex gap-2 man-txt">
                    <button className="page-btns grn-btn">1</button>{" "}
                    <button className="page-btns">2</button>{" "}
                    <button className="page-btns">3</button>{" "}
                    <button className="page-btns">4</button>{" "}
                    <button className="page-btns">5</button>{" "}
                    <button className="page-btns">6</button>{" "}
                    <button className="page-btns">7</button>
                  </div>
                  <div className="prev-t">Next page</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <InteriorElementsAddOns
        totalAddons={totalAddons}
        onRemoveElement={removeInteriorElements}
      />
      <VendorList vendorList={vendorData} vendorClass={vendorClass} />
      <SaveMoreWithGoodPlans
        open={openSaveMore}
        close={() => setOpenSaveMore(false)}
        saveMoreGoodPlans={getSaveMoreGoodPlans}
        makersClassification={projectData?.manufacturer_classification}
        materialClassification={projectData?.product_classification}
      />
      <EleSftAndQty
        eleId={popupIdData}
        show={eleQtyPopup}
        close={() => setEleQtyPopup(false)}
        getAllItems={getAllItems}
      />
      <ConfiramtionPopup
        show={confirmation}
        close={() => setConfirmation(false)}
        totalAddons={totalAddons}
        queId={projectData?.que_id}
      />
      <Lightbox
        open={openLightbox}
        close={() => setOpenLightbox(false)}
        slides={lightboxSlides}
        index={selectedIndex}
        plugins={[Thumbnails, Zoom, Slideshow]}
      />
      <UnavailableInteriorElements
        open={showRemovedPopup}
        onClose={() => setShowRemovedPopup(false)}
        elements={removedPopupList}
      />

      <Sonner />
    </>
  );
};

export default EditQuestionnaire;
