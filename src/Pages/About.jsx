import AboutBanner from "../Components/AboutUs/AboutBanner";
import Gallery from "../Components/AboutUs/Gallery";
import OurServices from "../Components/AboutUs/OurServices";
import OurTeam from "../Components/AboutUs/OurTeam";
import OurVision from "../Components/AboutUs/OurVision";
import WhyUs from "../Components/AboutUs/WhyUs";
// import AboutSuccess from "../Components/AboutUs/AboutSuccess";

const About = () => {
  return (
    <>
      {/* <AboutCompany />
      <OurTeam /> */}
      <AboutBanner />
      <OurVision />
      <WhyUs />
      {/* <OurServices /> */}
      <OurTeam />
      <Gallery />
    </>
  );
};

export default About;
