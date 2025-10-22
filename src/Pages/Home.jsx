import OurServices from "../Components/Home/OurServices";
import PopularProducts from "../Components/Home/PopularProducts";
import ProductPopup from "../Components/Home/ProductPopup";
import DesignStories from "../Components/Home/DesignStories";
import TopCompanies from "../Components/Home/TopCompanies";
import AfterBefore from "../Components/Home/afterBefore";
import { CounterUp } from "../Components/Home/CounterUp";
import { useEffect, useState } from "react";
import BannerService from "../Components/Home/BannerService";
import OngoingPopup from "../Components/Popups/OngoingPopup";
import Testimonials from "../Components/Home/Testimonials";
import DreamInterior from "../Components/Home/DreamInterior";
import Handover from "../Components/Home/Handover";
import InteriorServices from "../Components/Home/InteriorServices";

const Home = () => {
  const [onLoadPopup, setOnLoadPopup] = useState(false);

  const onCloseLoadPopup = () => {
    setOnLoadPopup(false);
  };

  useEffect(() => {
    setTimeout(() => {
      const token = localStorage.getItem("token");
      if (token == null || token == undefined || token == "") {
        setOnLoadPopup(true);
      }
    }, 5000);
  }, []);

  return (
    <>
      <>
        {/* <Loader /> */}
        <DreamInterior />
        <CounterUp />
        <BannerService />
        <InteriorServices />
        <Handover />
        {/* <WhyChoose /> */}
        <AfterBefore />
        <OurServices />
        <PopularProducts />
        <ProductPopup />
        <DesignStories />
        <Testimonials />
        <TopCompanies />
        {onLoadPopup && (
          <OngoingPopup
            openOnLoadPopup={onLoadPopup}
            onCloseLoadPopup={onCloseLoadPopup}
          />
        )}
      </>
    </>
  );
};

export default Home;
