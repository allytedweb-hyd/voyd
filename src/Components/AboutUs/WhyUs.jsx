// import Carousel from "react-multi-carousel";
import Marquee from "react-fast-marquee";
import "react-multi-carousel/lib/styles.css";
const WhyUs = () => {
  // const responsiveee = {
  //   superLargeDesktop: {
  //     // the naming can be any, depends on you.
  //     breakpoint: { max: 4000, min: 3000 },
  //     items: 5,
  //   },
  //   desktop: {
  //     breakpoint: { max: 3000, min: 1200 },
  //     items: 5,
  //   },
  //   miniDesktop: {
  //     breakpoint: { max: 1200, min: 1024 },
  //     items: 4,
  //   },
  //   tablet: {
  //     breakpoint: { max: 1024, min: 574 },
  //     items: 3,
  //   },
  //   mobile: {
  //     breakpoint: { max: 574, min: 0 },
  //     items: 2,
  //   },
  //   // mobileMini: {
  //   //   breakpoint: { max: 450, min: 0 },
  //   //   items: 1,
  //   // },
  // };
  return (
    <div>
      <section className="round-bg">
        <div className="container liven-con">
          <div className="row">
            <div className="why-hdn">Why to Choose</div>
            <div className="li-divv">
              <div className="livnsa-txt">VOYD</div>
              <div className="vec-line">
                <img
                  src="assets/images/Vector 29564.png"
                  // src="assets/images/crossline.jpeg"
                  alt=""
                  className="vc-img"
                />
              </div>
            </div>

            <div className="smoothScrollLeft">
              <Marquee gradient={false} speed={50} pauseOnHover={true}>
                {/* ---------- first time -------------- */}
                <div className="iconic-container">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/endToEnd.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">
                    End-To-End Project Monitoring
                  </div>
                </div>
                <div className="iconic-container">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/visualise.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Visualization (2D, 3D)</div>
                </div>
                <div className="iconic-container">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/incurance.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Insurance</div>
                </div>
                <div className="iconic-container">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/designngFirm.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Verified Designing Firms</div>
                </div>
                <div className="iconic-container">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/budgeting.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Transparent budgeting</div>
                </div>
                {/* ---------- second time -------------- */}
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/endToEnd.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">
                    End-To-End Project Monitoring
                  </div>
                </div>
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/visualise.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Visualization (2D, 3D)</div>
                </div>
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/incurance.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Insurance</div>
                </div>
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/designngFirm.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Verified Designing Firms</div>
                </div>
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/budgeting.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Transparent budgeting</div>
                </div>
                {/* ---------- third time -------------- */}
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/endToEnd.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">
                    End-To-End Project Monitoring
                  </div>
                </div>
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/visualise.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Visualization (2D, 3D)</div>
                </div>
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/incurance.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Insurance</div>
                </div>
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/designngFirm.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Verified Designing Firms</div>
                </div>
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/budgeting.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Transparent budgeting</div>
                </div>
                {/* ---------- fourth time -------------- */}
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/endToEnd.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">
                    End-To-End Project Monitoring
                  </div>
                </div>
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/visualise.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Visualization (2D, 3D)</div>
                </div>
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/incurance.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Insurance</div>
                </div>
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/designngFirm.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Verified Designing Firms</div>
                </div>
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/budgeting.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Transparent budgeting</div>
                </div>
                {/* ---------- fifth time -------------- */}
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/endToEnd.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">
                    End-To-End Project Monitoring
                  </div>
                </div>
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/visualise.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Visualization (2D, 3D)</div>
                </div>
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/incurance.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Insurance</div>
                </div>
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/designngFirm.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Verified Designing Firms</div>
                </div>
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/budgeting.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Transparent budgeting</div>
                </div>
              </Marquee>
            </div>
            <div className="smoothScrollRight">
              <Marquee direction="right" speed={50} pauseOnHover={true}>
                {/* ---------- first time -------------- */}
                <div className="iconic-container aaaaaaaaaaaaaaaaaaaaa">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/designConsultation.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Design Consultation</div>
                </div>
                <div className="iconic-container">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/furnitureCommerce.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">
                    Decor & Furniture E-Commerce
                  </div>
                </div>
                <div className="iconic-container">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/proInspection.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Property Inspection</div>
                </div>
                <div className="iconic-container">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/budgetControl.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Budget Controlling</div>
                </div>
                <div className="iconic-container">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/serviceWarenty.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Service Warranty</div>
                </div>
                {/* ---------- second time -------------- */}
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/designConsultation.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Design Consultation</div>
                </div>
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/furnitureCommerce.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">
                    Decor & Furniture E-Commerce
                  </div>
                </div>
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/proInspection.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Property Inspection</div>
                </div>
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/budgetControl.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Budget Controlling</div>
                </div>
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/serviceWarenty.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Service Warranty</div>
                </div>
                {/* ---------- third time -------------- */}
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/designConsultation.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Design Consultation</div>
                </div>
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/furnitureCommerce.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">
                    Decor & Furniture E-Commerce
                  </div>
                </div>
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/proInspection.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Property Inspection</div>
                </div>
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/budgetControl.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Budget Controlling</div>
                </div>
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/serviceWarenty.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Service Warranty</div>
                </div>
                {/* ---------- fourth time -------------- */}
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/designConsultation.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Design Consultation</div>
                </div>
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/furnitureCommerce.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">
                    Decor & Furniture E-Commerce
                  </div>
                </div>
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/proInspection.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Property Inspection</div>
                </div>
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/budgetControl.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Budget Controlling</div>
                </div>
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/serviceWarenty.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Service Warranty</div>
                </div>
                {/* ---------- fifth time -------------- */}
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/designConsultation.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Design Consultation</div>
                </div>
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/furnitureCommerce.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">
                    Decor & Furniture E-Commerce
                  </div>
                </div>
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/proInspection.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Property Inspection</div>
                </div>
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/budgetControl.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Budget Controlling</div>
                </div>
                <div className="iconic-container mobileDisplayNone">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/serviceWarenty.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Service Warranty</div>
                </div>
              </Marquee>
            </div>

            {/* <div className="consult-div">
              <Carousel
                responsive={responsiveee}
                autoPlay={true}
                autoPlaySpeed={2000}
                infinite={true}
                swipeable={true}
                arrows={false}
                className="header-content container-fluid"
              >
                <div className="iconic-container">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/endToEnd.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">
                    End-To-End Project Monitoring
                  </div>
                </div>
                <div className="iconic-container">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/visualise.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Visualization ( 2D, 3D )</div>
                </div>
                <div className="iconic-container">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/incurance.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Insurance</div>
                </div>
                <div className="iconic-container">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/designngFirm.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Verified Designing Firms</div>
                </div>
                <div className="iconic-container">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/budgeting.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Transparent budgeting</div>
                </div>
              </Carousel>
            </div>
            <div className="consult-div2">
              <Carousel
                responsive={responsiveee}
                autoPlay={true}
                autoPlaySpeed={2000}
                infinite={true}
                swipeable={true}
                arrows={false}
                rtl={true}
                className="header-content container-fluid py-4"
              >
                <div className="iconic-container">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/designConsultation.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Design Consultation</div>
                </div>
                <div className="iconic-container">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/furnitureCommerce.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">
                    Decor & Furniture E-Commerce
                  </div>
                </div>
                <div className="iconic-container">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/proInspection.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Property Inspection</div>
                </div>
                <div className="iconic-container">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/budgetControl.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Budget Controlling</div>
                </div>
                <div className="iconic-container">
                  <div className="green-wrapper">
                    <img
                      src="assets/icons/serviceWarenty.png"
                      alt=" Icon"
                      className="green-icon"
                    />
                  </div>
                  <div className="iconic-text">Service Warranty</div>
                </div>
              </Carousel>
            </div> */}
          </div>
        </div>
      </section>
    </div>
  );
};

export default WhyUs;
