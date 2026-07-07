import AboutBanner from "../Components/AboutUs/AboutBanner";
import Gallery from "../Components/AboutUs/Gallery";
import OurServices from "../Components/AboutUs/OurServices";
import OurTeam from "../Components/AboutUs/OurTeam";
import OurVision from "../Components/AboutUs/OurVision";
import WhyUs from "../Components/AboutUs/WhyUs";
// import AboutSuccess from "../Components/AboutUs/AboutSuccess";
import SEO from "../Components/SEO";

const About = () => {
 return (
    <>
      <SEO
        title="About VOYD | Interior Innovation & Smart Living"
        description="Discover how VOYD combines design, technology, and quality to create exceptional living spaces. Discover how VOYD combines design expertise, technology, and execution excellence to create extraordinary spaces."
        keywords="Premium interior design, Premium interior designers in hyderabad, Premium interior products, Premium interior emulsion, Premium interior paint, Premium interior wall paint, Premium interior design cost, Premium interior design website"
      />
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
