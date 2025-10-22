import { useState } from "react";
import { IoIosArrowRoundForward } from "react-icons/io";
import OngoingPopup from "../Components/Popups/OngoingPopup";
import CustomerSupport from "../Components/Popups/CustomerSupport";
import { useNavigate } from "react-router-dom";
const CustomerService = () => {
  const navigate = useNavigate();
  const [onLoadPopup, setOnLoadPopup] = useState(false);
  const onCloseLoadPopup = () => {
    setOnLoadPopup(false);
  };
  const [customerSupport, setCustomerSupport] = useState(false);
  const closeCustomerSupport = () => {
    setCustomerSupport(false);
  };

  const handletokenBasedPopup = () => {
    let token = localStorage.getItem("token");
    if (token) {
      setCustomerSupport(true);
    } else {
      setOnLoadPopup(true);
    }
  };

  const handleClaculateBudget = () => {
    let token = localStorage.getItem("token");
    if (token == null || token == undefined || token == "") {
      navigate("/login");
    } else {
      navigate("/myQuotes");
    }
  };

  return (
    <div>
      <section className="cx-bg pos-rel">
        <div>
          <img
            src="assets/images/Group 1618873926 (3).png"
            alt=""
            className="light-flash m-flash mmflash"
          />
        </div>
        <div className="container">
          <div className="row r-mt-5">
            <div className="col-md-6 col-sm-6 add-cx mob-wd">
              <div className="cx-hdng m-trans">Transform Your Home with </div>
            </div>
            <div className="col-md-6 col-sm-6 d-block add-cx1 mob-wd">
              <div className="smt-txt m-smart">
                <span className="cx-span">
                  Smart{" "}
                  <img
                    src="assets/images/vecteezy_lens-flare-light-special-effect_8507589 2.png"
                    alt=""
                    className="sparkle-img"
                  />
                </span>{" "}
                Interior
              </div>
              <div className="d-flex sol-up">
                <div>
                  <span className="smt-txt m-smart">Solutions</span>
                </div>
                <div className="rht-arow" onClick={handletokenBasedPopup}>
                  <span>
                    <button className="arrow-button m-but">
                      <IoIosArrowRoundForward />
                    </button>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <div className="bg-asdf">
        <img src="assets/images/bg-frame.png" alt="" />
      </div>
      <section className="cx-bg-cards">
        <div className="container con-dec">
          <div className="row d-flex justify-content-center mt-top">
            <div className="cards-cx">
              Get Interior <span className="col-greenn">Knowledge</span> & Make
              Informed <br /> Decisions
            </div>
            <div className="col-md-4 col-sm-6">
              <div className="card-cx">
                <div className="card-image-cx">
                  <img
                    src="assets/images/Rectangle 34626840.png"
                    alt="Material & Brand Education"
                  />
                </div>
                <div className="card-content-cx col-black">
                  <div className="card-hd">Interior Subject Knowledge</div>
                  <p>Learn about designs, budgeting & space planning</p>
                </div>
              </div>
            </div>
            <div className="col-md-4 col-sm-6">
              <div className="card-cx">
                <div className="card-image-cx">
                  <img
                    src="assets/images/Rectangle 34626840 (1).png"
                    alt="Material & Brand Education"
                  />
                </div>
                <div className="card-content-cx col-blac">
                  <div className="card-hd">Material & Brand Education</div>
                  <p className="">Compare materials, brands & pricing</p>
                </div>
              </div>
            </div>
            <div className="col-md-4 col-sm-6">
              <div className="card-cx tab-top">
                <div className="card-image-cx col-blac">
                  <img
                    src="assets/images/Rectangle 34626841.png"
                    alt="Material & Brand Education"
                  />
                </div>
                <div className="card-content-cx">
                  <div className="card-hd">Cost & Usage Insights</div>
                  <p>Know where to invest & how to optimize expenses</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section className="cx-bg-coins pos-rel">
        {/* <div><img src="assets/images/Ellipse 3967.png" alt="" className="blue-bud" /></div>
        <div><img src="assets/images/Ellipse 3968.png" alt="" className="yellow-bud" /></div> */}
        <div className="container con-cntr">
          <div className="row ">
            <div className="col-md-6 col-sm-6 align-items-center d-flex tab-flex  ">
              <div>
                <div className="v-cx-txt m-budget txxt-start">
                  Plan Your <span className="col-greenn">Budget</span> & <br />{" "}
                  Finalize Your Design
                </div>

                <div className="txt-start tab-flex">
                  <button
                    className="button-v-serv nextBt"
                    onClick={handleClaculateBudget}
                  >
                    Calculate Your Interior Budget Now
                  </button>
                </div>
              </div>
            </div>
            {/* <div className="col-md-6">
                      <div className="row">
                      <div className="trending-card">
      <div className="trending-tag">Trending designs</div>
      <div className="trending-content">
        Get cost estimates for essential, decorative & luxury brands
      </div>
    </div>
                 </div>
                 <div className="row justify-content-center">
                      <div className="trending-card t-card1">
      <div className="trending-tag b-col">Budget</div>
      <div className="trending-content">
        Get cost estimates for essential, decorative & luxury brands
      </div>
    </div>
                          </div>
                          <div className="row justify-content-end">
                      <div className="trending-card t-card2">
      <div className="trending-tag z-col">Zero Administrative efforts</div>
      <div className="trending-content">
        Get cost estimates for essential, decorative & luxury brands
      </div>
    </div>
                 </div>
                  </div> */}

            <div className="col-md-6 col-sm-6">
              <div className="grow-img">
                <img
                  src="assets/images/Group 1618873844.png"
                  alt=""
                  className=""
                />
              </div>
              <div className="coin-div">
                <img
                  src="assets/images/Frame 2147223341 (1)-Photoroom.png"
                  alt=""
                  className="coins-bud"
                />
              </div>
              <div className="info-cards-container">
                {/* Card at Start */}
                <div className="info-card-wrapper start pos-sett">
                  <div className="info-card">
                    <div className="card-tag teal">Trending designs</div>
                    <div className="card-content">
                      Get cost estimates for essential, decorative & luxury
                      brands
                    </div>
                  </div>
                </div>

                {/* Card at Center */}
                <div className="info-card-wrapper center bud-ad">
                  <div className="info-card ">
                    <div className="card-tag orange">Budget</div>
                    <div className="card-content">
                      Get cost estimates for essential, decorative & luxury
                      brands
                    </div>
                  </div>
                </div>

                {/* Card at End */}
                <div className="info-card-wrapper end">
                  <div className="info-card">
                    <div className="card-tag blue">
                      Zero Administrative efforts
                    </div>
                    <div className="card-content">
                      Quality Checks, Progress checks, Work Checks, on-floor
                      visits
                    </div>
                  </div>
                </div>
              </div>

              <div className="persong-bud">
                <img src="assets/images/Group 1618874015.png" alt="" />
              </div>
            </div>
          </div>
        </div>
      </section>

      <section className="bg-int pos-rel">
        <div>
          <img
            src="assets/images/1ce6f4c3-814a-4067-ad16-56573acfdde5-Photoroom 2.png"
            alt=""
            className="leaf-tb mob-none"
          />
        </div>
        <div className="container">
          <div className="row mob-rev1">
            <div className="col-md-6 col-sm-6 lady-styles">
              <div className="ldy-tb">
                <img
                  src="assets/images/Group 1618873934 (1).png"
                  alt=""
                  className="lady-tab"
                />
              </div>
            </div>
            <div className="col-md-6 col-sm-6">
              <div className="fw-hdng">
                <div className="v-cx-txt">
                  Find & Work with <span className="col-greenn">Verified</span>{" "}
                  <br /> Interior Designers
                </div>
                <div className="interior-container">
                  <div className="info-card2">
                    <div className="info-content1">
                      <h3>Pre-Vetted Designers</h3>
                      <p>
                        Selected based on background verification & expertise
                      </p>
                    </div>
                    <img
                      src="assets/images/Screenshot 2025-04-04 141218 (1)-Photoroom.png"
                      alt="Pre-Vetted Designers"
                    />
                  </div>

                  <div className="info-card2">
                    <div className="info-content1">
                      <h3>Match with the Right Designer</h3>
                      <p>
                        Get expertly paired based on your style, needs & budget
                      </p>
                    </div>
                    <img
                      src="assets/images/Screenshot 2025-03-13 161157 (1)-Photoroom 1 (1).png"
                      alt="Match with Designer"
                    />
                  </div>

                  <div className="info-card2">
                    <div className="info-content1">
                      <h3>View Portfolios & Customer Reviews</h3>
                      <p>
                        Explore work samples & real feedback to choose with
                        confidence
                      </p>
                    </div>
                    <img
                      src="assets/images/Screenshot 2025-03-13 160541 (1)-Photoroom 2.png"
                      alt="View Portfolios"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section className="bg-threed pos-rel">
        <div>
          <img
            src="assets/images/[freepicdownloader.com]-lantern-with-yellow-glass-cover-chain-large-Photoroom 2.png"
            alt=""
            className="light-flash1"
          />
        </div>

        <div className="container">
          <div className="v-cx-txt ex-mb">
            <span className="col-greenn">Visualize</span> Your Interiors <br />{" "}
            Before Execution
          </div>
          <div className="row mttt">
            <div className="col-md-6 col-sm-6 cd-aligns">
              <div className="card-cx1 no-sd bg-ad d-blk">
                <div className="card-image-cx">
                  <img
                    src="assets/images/div.ProductFeatureCard__graphic_margin (2).png"
                    alt="Material & Brand Education"
                  />
                </div>
                <div className="card-content-cx1">
                  <h3 className="threed-txt">3D Visualization</h3>
                  <p className="threed-txt-p">
                    See your home before it’s built with life like design
                    previews
                  </p>
                </div>
              </div>
            </div>
            <div className="col-md-6 col-sm-6">
              <div className="hor-gap">
                <div className="card-cx1 no-sd bg-ad ">
                  <div className="card-image-cx1 bg-white">
                    <img
                      src="assets/images/div.ProductFeatureCard__graphic_margin (3).png"
                      alt="Material & Brand Education"
                    />
                  </div>
                  <div className="card-content-cx1">
                    <h3 className="threed-txt">2D Sketches</h3>
                    <p className="threed-txt-p">
                      Plan your space with structured floor plans for precise
                      layout planning.
                    </p>
                  </div>
                </div>
                <div className="card-cx1 no-sd bg-ad e-block">
                  <div className="card-image-cx">
                    <img
                      src="assets/images/div.ProductFeatureCard__graphic_margin (2).png"
                      alt="Material & Brand Education"
                    />
                  </div>
                  <div className="card-content-cx1">
                    <h3 className="threed-txt">3D Visualization</h3>
                    <p className="threed-txt-p">
                      See your home before it’s built with life like design
                      previews
                    </p>
                  </div>
                </div>
                <div className="card-cx1 no-sd bg-ad">
                  <div className="card-image-cx1">
                    <img
                      src="assets/images/Frame 2147223332.png"
                      alt="Material & Brand Education"
                    />
                  </div>
                  <div className="card-content-cx1">
                    <h3 className="threed-txt">Real-Time Virtual Experience</h3>
                    <p className="threed-txt-p">
                      Walk through & approve designs in a virtual space for
                      better decision-making.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section className="bg-check mblCheck">
        <div className="container">
          <div className="row align-items-center bg-th-d">
            <div className="adj-tiles mblText">
              <div className="check-hd">Pre-Inspection for a Smooth Start</div>
              <div className="check-hd-p">
                Ensure a Problem-Free Interior Execution – Get expert evaluation
                before proceeding
              </div>
            </div>
            <div className="box-s mob-po">Identify tile damage</div>
            <div>
              <img
                src="assets/images/arrowimg.png"
                alt=""
                className="arrow-backimgone"
              />
            </div>
            <div className="d-flex justify-content-end">
              <div>
                <img
                  src="assets/images/arrowimgtwo.png"
                  alt=""
                  className="arrow-backimgtwo"
                />
              </div>
              <div className="box-s set-wl">Identify wall cracks</div>
            </div>
          </div>
        </div>
      </section>

      <section className="b-rep">
        <div className="container">
          <div className="row tab-rev row-pdng">
            <div className="col-md-5 col-sm-12">
              <div className="row">
                <div className="col-md-6 col-sm-6">
                  <div className="hor-gap">
                    <div className="">
                      <div className="tab-flex mob-tm f-tm">
                        <img
                          src="assets/images/Rectangle 34626869.png"
                          alt="Material & Brand Education"
                        />
                      </div>
                    </div>
                    <div className="">
                      <div className="tab-flex mob-tm">
                        <img
                          src="assets/images/Rectangle 34626871.png"
                          alt="Material & Brand Education"
                        />
                      </div>
                    </div>
                  </div>
                </div>
                <div className="col-md-6 col-sm-6 cd-aligns">
                  <div className="">
                    <div className="tab-flex mob-tm extra-cd">
                      <img
                        src="assets/images/Rectangle 34626870.png"
                        alt="Material & Brand Education"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div className="col-md-7 col-sm-12">
              <div className="on-site-div">
                <div className="v-cx-txt mt-0">
                  On-Site <span className="col-greenn">Supervision</span> &
                  Quality Control
                </div>
                <div className="interior-container">
                  <div className="info-card1 bg-ad">
                    <div className="info-content1">
                      <h3>Dedicated Field Supervisor</h3>
                      <p>
                        Ensuring smooth execution with expert oversight and
                        efficiency
                      </p>
                    </div>
                    <img
                      src="assets/images/contac.png"
                      alt="Pre-Vetted Designers"
                      className="img-d"
                    />
                  </div>

                  <div className="info-card1 bg-ad">
                    <div className="info-content1">
                      <h3>Material Quality Verification</h3>
                      <p>
                        Cross-check materials with contract specifications for
                        assured standards.
                      </p>
                    </div>
                    <img
                      src="assets/images/book.icon.png"
                      alt="Match with Designer"
                      className="img-d"
                    />
                  </div>

                  <div className="info-card1 bg-ad">
                    <div className="info-content1">
                      <h3>Work Progress Tracking & Site Coordination</h3>
                      <p>
                        Stay updated on construction with real-time insights.
                      </p>
                    </div>
                    <img
                      src="assets/images/thanks.icon.png"
                      alt="View Portfolios"
                      className="img-d"
                    />
                  </div>
                  <div className="info-card1 bg-ad">
                    <div className="info-content1">
                      <h3>Payment Follow-Ups </h3>
                      <p>
                        Hassle-free transactions for timely settlements and
                        financial transparency
                      </p>
                    </div>
                    <img
                      src="assets/images/3d-hand-using-online-banking-app-smartphone-Photoroom 1.png"
                      alt="View Portfolios "
                      className="img-d"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section className="b-srch">
        <div className="container">
          <div className="row">
            <div className="col-md-6 col-sm-12 d-flex align-items-center ex-sty">
              <div className="text-start">
                <div className="post-inspection-title">
                  POST-<span className="col-greenn">INSPECTION</span> & QUALITY
                  ASSURANCE
                </div>
                <p className="post-inspection-text">
                  {/* VOYD Interior Designing ensures every project meets the
                  highest standards through thorough post-inspection and
                  rigorous quality assurance processes. */}
                  From inspection to final approval, VOYD ensures every interior
                  detail meets top-quality standards, delivering designs that
                  impress and endure.
                </p>
                <div className="mob-cen">
                  <button
                    className="cta-button-new"
                    onClick={handletokenBasedPopup}
                  >
                    Customer Support
                  </button>
                </div>
              </div>
            </div>
            <div className="col-md-6 col-sm-12 d-flex align-items-center">
              <img src="assets/images/Group 1618873922.png" alt="" />
            </div>
          </div>

          <div className="row br-mob">
            <div className="quality-check-container">
              <div className="quality-check-card">
                <img
                  src="assets/images/Rectangle 71.png"
                  alt="Final Quality Check"
                  className="quality-image"
                />
                <div className="quality-content">
                  <h3>Final Quality Check</h3>
                  <p>
                    {/* VOYD ensures every detail meets the highest standards,
                    delivering flawless interiors through meticulous final
                    quality checks. */}
                    Every interior undergoes VOYD’s final quality check,
                    guaranteeing perfection, precision, and unmatched design
                    excellence.
                  </p>
                </div>
              </div>

              <div className="divider "></div>

              <div className="quality-check-card">
                <img
                  src="assets/images/Rectangle 71 (1).png"
                  alt="Prevent Future Issues"
                  className="quality-image"
                />
                <div className="quality-content">
                  <h3>Prevent Future Issues</h3>
                  <p>
                    {/* Through careful planning and preventive strategies, VOYD
                    ensures your interiors stay durable, safe, and problem-free. */}
                    VOYD implements proactive solutions and preventive measures,
                    ensuring interiors remain flawless and free from future
                    issues.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section className="bg-pricee pos-rel">
        <div className="container card-contner">
          <div className="row">
            <div className="post-inspection-title text-center">
              Buy Interior Materials at the{" "}
              <span className="multi-col"> Best Price</span>
            </div>
            {/* <div className="d-flex justify-content-between discount-tags">
              <div className="disc-mob">
                <img src="assets/images/dis-1 (1).png" alt="" />
              </div>
              <div className="disc-mob1">
                <img src="assets/images/dis-1 (2).png" alt="" />
              </div>
            </div> */}

            <div className="feature-container">
              <div className="feature-card bg-c1">
                <img
                  src="assets/images/3d-representation-reselling-market-Photoroom 1.png"
                  alt="E-Commerce Platform"
                  className="feature-image"
                />
                <div className="fi-title">E-Commerce Platform</div>
                <p>Purchase Top-Quality Interior Materials At Lower Prices</p>
              </div>
              <div className="divider1 tab-none"></div>

              <div className="feature-card bg-c2">
                <img
                  src="assets/images/bag-image.png"
                  alt="E-Commerce Platform"
                  className="feature-image"
                />
                <div className="fi-title">Compare Brands & Get Discounts</div>
                <p>Find the best deals from verified suppliers</p>
              </div>
              <div className="divider1 tab-none"></div>

              <div className="feature-card bg-c3">
                <img
                  src="assets/images/m001t0331_a_home_delivery_illustration_27sep22-Photoroom 1.png"
                  alt="E-Commerce Platform"
                  className="feature-image"
                />
                <div className="fi-title">
                  On-Time Delivery & Order Tracking
                </div>
                <p>Get products delivered without delay</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section className="bg-com bg-blockk m-status">
        <div className="container">
          <div className="row">
            <div className="col-md-6 ">
              <div className="">
                <div className="bonusOuter">
                  <img
                    src="assets/images/perks 1.png"
                    alt=""
                    className="hand-star"
                  />
                  <div className="bonus-badge"> BONUS</div>
                </div>

                <div className="post-inspection-title rightText">
                  <span className="m-p-m">HASSLE-FREE</span> Vendor{" "}
                  <span className="col-greenn m-p-m spw">REPLACEMENT</span> IF
                  NEEDED
                </div>

                <div className="vendar-options">
                  <div className="d-flex">
                    <div className="vendar-iconOuter">
                      <img
                        src="assets/images/backupicon.png"
                        alt="Backup vendar"
                        className="vendar-icon"
                      />
                    </div>
                    <div className="vendar-option">
                      <div className="vendar-text inn">
                        <div className="ven-p">
                          Get A Backup Vendor Instantly
                        </div>
                        <p className="m-0">
                          If A Supplier Fails To Deliver Quality Or On Time
                        </p>
                      </div>
                    </div>
                  </div>

                  <div className="d-flex">
                    <div className="vendar-iconOuter">
                      <img
                        src="assets/images/log-qulaity.png"
                        alt="Backup vendar"
                        className="vendar-icon"
                      />
                    </div>
                    <div className="vendar-option mo-p">
                      <div className="vendar-text inn">
                        <div className="ven-p pr-2">
                          Uninterrupted Work Progress
                        </div>
                        <p className="m-0">
                          Avoid delays with quick vendor switches
                        </p>
                      </div>
                    </div>
                  </div>
                </div>

                {/* <button className="vendar-button ">Replace a Vendor Now</button> */}
              </div>
            </div>

            <div className="col-md-6 align-items-end d-flex tab-status hasel-sphere">
              <div className="replace-container mini-status">
                <div className="qc-vendor old-vendor">
                  <img
                    src="assets/images/freepik__the-style-is-candid-image-photography-with-natural__47837 1-Photoroom 1.png"
                    className="qc-vendor-image m-qc"
                  />

                  <div className="status-badge delayed">Delayed</div>
                  <div className="status-badge irregular">Irregular</div>
                  <div className="status-badge quality-issues">
                    Quality Issues
                  </div>
                  <div className="status-icon ">
                    <img
                      src="assets/images/cross 1.png"
                      alt=""
                      className="cross-icon"
                    />
                  </div>
                </div>

                <div className="replace-arrow">
                  REPLACE{" "}
                  <img
                    src="assets/images/Vector 29490.png"
                    alt=""
                    className="arrow-top"
                  />
                </div>

                <div className="qc-vendor new-vendor">
                  <img
                    src="assets/images/[freepicdownloader.com]-indian-man-with-crossed-arms-wearing-formal-shirt-medium (1)-Photoroom 1.png"
                    alt="Old Vendor"
                    className="qc-vendor-image new-v"
                  />
                  <div className="status-badge expert">Expert</div>
                  <div className="status-badge on-time">On Time</div>
                  <div className="status-icon">
                    <img
                      src="assets/images/checked 1.png"
                      alt=""
                      className="cross-icon"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div className="col-md-6 hasel-spehere-2">
              <div>
                <img src="assets/images/Frame 2147223357.svg" alt="" />
              </div>
            </div>
          </div>
        </div>
      </section>
      <OngoingPopup
        openOnLoadPopup={onLoadPopup}
        onCloseLoadPopup={onCloseLoadPopup}
      />
      <CustomerSupport
        openCustomerSupport={customerSupport}
        closeCustomerSupport={closeCustomerSupport}
      />
    </div>
  );
};

export default CustomerService;
