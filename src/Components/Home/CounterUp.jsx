import { BsBuildings } from "react-icons/bs";
import { FaUsers } from "react-icons/fa";
import { MdDesignServices } from "react-icons/md";
import { FaChartLine } from "react-icons/fa";
import CountUp from "react-countup";
import Carousel from "react-multi-carousel";
import "react-multi-carousel/lib/styles.css";

import Marquee from "react-fast-marquee";

export const CounterUp = () => {
  // const [play, setPlay] = useState(false);

  // useEffect(() => {
  //   const timer = setTimeout(() => setPlay(true), 100); // or 200ms
  //   return () => clearTimeout(timer);
  // }, []);
  return (
    <>
      <section className=" stoppingSection bg-multiCol counter-hg coun-mini">
        <div className="container">
          <div className="">
            <div className="row">
              <div className="laugh-dk">
                <img src="assets/images/Frame 2147223404 (1).png" alt="" />
              </div>
              <div className="bg-laugh">
                <div className="img-high">
                  <img
                    src="assets/images/IMG-20250503-WA0000.png"
                    alt=""
                    className="br-five"
                  />
                </div>
                <div className="lugh-txt">
                  Dream home is possible if everything goes right ! <br />
                  We help you to get it right!
                </div>
              </div>
            </div>
            <div className="row px-3 pdng-tpng mblNone">
              <div className=" col-lg-6 col-md-6 col-sm-6 m-0 p-0 d-flex justify-content-end mobileStart">
                <div className="d-flex">
                  <div>
                    <div className="stop-txt stp-resp">What's Holding </div>
                  </div>
                  {/* 
                  <div className="mobileForYou">
                    <div className="image">
                      <div className="four-div">
                        <img src="assets/images/number-4.png" alt="" />
                      </div>
                      <div className="bbb">
                        <img src="assets/images/letter-u.png" alt="" />
                      </div>
                    </div>
                  </div> */}
                  {/* <div className="forYouImgOne">
                    <img
                      src="assets/images/number-4.png"
                      alt=""
                      className="four-image"
                    />
                  </div> */}
                </div>
              </div>
              <div className=" col-lg-6 col-md-6 col-sm-6 p-0 m-0 c-2 u-adj">
                <div className="d-flex u-sec">
                  <div className="img-eul1 forYouImgTwo">
                    <img
                      src="assets/images/letter-u.png"
                      alt=""
                      className="before-u u-imggg"
                    />
                  </div>
                  <div>
                    <h2 className="stop-txt2 text-start ">
                      back from creating <br /> your dream spaces
                    </h2>
                  </div>
                </div>
              </div>
            </div>
            <div className="row px-3 pdng-tpng desktopNone">
              <div className="whatsStopFirst">
                <h2>What’s Holding </h2>
                <img src="assets/images/letter-u.png" alt="" />
              </div>
              <div className="whatsStopSecond">
                <h2>
                  back from creating <br /> your dream spaces
                </h2>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section className="c-section c-ren ">
        <div className="container  stpng-contner">
          <div className="row">
            <div className="row px-2 border-top imageUlRow d-flex justify-content-center">
              <div className="abt-sec border-right">
                <div className="img-eul">
                  <img
                    src="assets/icons/hold1.png"
                    alt=""
                    className="pencil-img"
                  />
                </div>
                <div className="countDiv">
                  <div className="pb-2 num-count">01</div>
                  <div>
                    <h4 className="heading-txt">
                      Worried about Overspending ?
                    </h4>
                  </div>
                  <div className="ul-justify">
                    <ul className="pr-mob ul-for">
                      <li>
                        Overspending in early stages leads compromising in later
                        decisions
                      </li>
                      <li>
                        Investing on luxury items without adding a real value is
                        money lost
                      </li>
                      <li>Unclear estimates and hidden costs</li>
                    </ul>
                  </div>
                </div>
              </div>
              <div className="abt-sec border-right">
                <div className="img-eul">
                  <img
                    src="assets/icons/hold2.png"
                    alt=""
                    className="pencil-img"
                  />
                </div>
                <div className="countDiv">
                  <div className="pb-2 num-count">02</div>
                  <div>
                    <h4 className="heading-txt">
                      Struggling to find trusted designer ?
                    </h4>
                  </div>
                  <div className="ul-justify">
                    <ul className="pr-mob ul-for">
                      <li>
                        Too many freelancers claims expertise, who can you
                        really trust?
                      </li>
                      <li>
                        Past work doesn’t reflect present focus or availability
                        — time to move forward.
                      </li>
                      <li>
                        A wrong designer causes delays, rework, and poor
                        finishes
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div className=" abt-sec border-right">
                <div className="img-eul">
                  <img
                    src="assets/icons/hold3.png"
                    alt=""
                    className="pencil-img"
                  />
                </div>
                <div className="countDiv">
                  <div className="pb-2 num-count">03</div>
                  <div>
                    <h4 className="heading-txt">
                      Unsure about material to choose ?
                    </h4>
                  </div>
                  <div className="ul-justify">
                    <ul className="pr-mob ul-for">
                      <li>Lack of guidance leads to low-quality selection</li>
                      <li>
                        Crowded market, unclear pricing, and similar duplicates
                        make selection difficult.
                      </li>
                      <li>
                        Good-Looking Products Aren’t Always Durable — How Can
                        You Tell?
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div className=" abt-sec border-right">
                <div className="img-eul">
                  <img
                    src="assets/icons/hold4.png"
                    alt=""
                    className="pencil-img"
                  />
                </div>
                <div className="countDiv">
                  <div className="pb-2 num-count">04</div>
                  <div>
                    <h4 className="heading-txt">
                      No time to Follow-delayed decisions
                    </h4>
                  </div>
                  <div className="ul-justify">
                    <ul className="pr-mob ul-for">
                      <li>
                        No time to track work progress leads to incomplete work
                        and wrong results
                      </li>
                      <li>
                        Poor planning leads to endless back-and-forth revision,
                        missing time lines
                      </li>
                      <li>No regular updates or transparency</li>
                    </ul>
                  </div>
                </div>
              </div>
              <div className=" abt-sec ">
                <div className="img-eul">
                  <img
                    src="assets/icons/hold5.png"
                    alt=""
                    className="pencil-img"
                  />
                </div>
                <div className="countDiv">
                  <div className="pb-2 num-count">05</div>
                  <div>
                    <h4 className="heading-txt">
                      Confusion with Too many Designing choices
                    </h4>
                  </div>
                  <div className="ul-justify">
                    <ul className="pr-mob ul-for">
                      <li>Design vs. Function — Which One to Prioritize?</li>
                      <li>
                        Trending Designs vs. Personal Taste, What Should Be
                        Followed?
                      </li>
                      <li>Endless scrolling leads to decision fatigue</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section className="promiseSection">
        <div className="container">
          {/* ----------------------------  DESKTOP VERSION UPTO 768px  ------------------- */}
          <div className="row firstClip desktopView">
            <div className="col-md-4">
              <h2>
                What We Promise<span>.</span>
              </h2>
            </div>
            <div className="col-md-8">
              <div className="row">
                <div className="col-md-6">
                  <div className="promiseBlock">
                    <div className="proImage">1</div>
                    <div className="proLines">
                      <h5>End-to-End Interior Project Management</h5>
                      <p>
                        No disconnect, No surprises. From planning to handover,
                        we manage every detail with care.
                      </p>
                    </div>
                  </div>
                </div>
                <div className="col-md-6">
                  <div className="promiseBlock">
                    <div className="proImage">2</div>
                    <div className="proLines">
                      <h5>Verified & Skilled Interior Design Firms</h5>
                      <p>
                        Only empanelled, background-verified experts handle your
                        space
                      </p>
                    </div>
                  </div>
                </div>
                <div className="col-md-6">
                  <div className="promiseBlock">
                    <div className="proImage">3</div>
                    <div className="proLines">
                      <h5>Style your home with Timeless Trends</h5>
                      <p>
                        We explore evolving styles and craft curated design
                        collections that feel fresh today and timeless tomorrow
                      </p>
                    </div>
                  </div>
                </div>
                <div className="col-md-6">
                  <div className="promiseBlock">
                    <div className="proImage">4</div>
                    <div className="proLines">
                      <h5>Smart Budget Control & Value-Based Planning</h5>
                      <p>
                        We align your budget to the most impactful investments —
                        no waste, just meaningful upgrades.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {/* --------------------- MOBILE VIEW FROM 576px   --------------------------------- */}
          <div className="row firstClip mobileView">
            <div className="col-md-4">
              <h2>
                What We Promise<span>.</span>
              </h2>
            </div>
            <div className="col-md-8">
              <div className="row">
                <div className="col-md-6">
                  <div className="promiseBlock">
                    <div className="proImage">1</div>
                    <div className="proLines">
                      <h5>End-to-End Interior Project Management</h5>
                      <p>
                        No disconnect, No surprises. From planning to <br />{" "}
                        handover, we manage every detail with care.
                      </p>
                    </div>
                  </div>
                </div>
                <div className="col-md-6">
                  <div className="promiseBlock">
                    <div className="proImage">2</div>
                    <div className="proLines">
                      <h5>Verified & Skilled Interior Design Firms</h5>
                      <p>
                        Only empanelled, background-verified <br /> experts
                        handle your space
                      </p>
                    </div>
                  </div>
                </div>
                <div className="col-md-6">
                  <div className="promiseBlock">
                    <div className="proImage">3</div>
                    <div className="proLines">
                      <h5>Style your home with Timeless Trends</h5>
                      <p>
                        We explore evolving styles and craft curated design{" "}
                        <br />
                        collections that feel fresh today and timeless tomorrow
                      </p>
                    </div>
                  </div>
                </div>
                <div className="col-md-6">
                  <div className="promiseBlock">
                    <div className="proImage">4</div>
                    <div className="proLines">
                      <h5>Smart Budget Control & Value-Based Planning</h5>
                      <p>
                        We align your budget to the most impactful <br />{" "}
                        investments — no waste, just meaningful upgrades.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

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
          </div>
        </div>
      </section>
    </>
  );
};
