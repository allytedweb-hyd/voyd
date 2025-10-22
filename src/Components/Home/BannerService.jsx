import { useState } from "react";
import Carousel from "react-multi-carousel";
import "react-multi-carousel/lib/styles.css";
import OngoingPopup from "../Popups/OngoingPopup";
import { Link } from "react-router-dom";

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

const BannerService = () => {
  const [onLoadPopup, setOnLoadPopup] = useState(false);
  const onCloseLoadPopup = () => {
    setOnLoadPopup(false);
  };
  return (
    <>
      <div className="bannerCarouseOuter">
        <Carousel
          responsive={responsive}
          autoPlay={false}
          infinite={false}
          arrows={false}
          autoPlaySpeed={90000}
          showDots={false} // Enable dots
          dotListClass="custom-dot-list-style bannerDots" // Custom class for styling dots
        >
          {/* Slide 1 */}
          <div>
            <section className="bn-sec homeBanner one">
              <div className="row">
                <div className="col-md-6 col-sm-6 pl-tab text-left justify-content-center d-flex align-items-center pl-79 ">
                  <div className="contentPadLeft">
                    <h1 className="trnsfm-txt">
                      A Trusted Link Between <br /> Clients, Creators &
                      Suppliers
                    </h1>
                    {/* <p className="col-greyish puy-4 trans-p">
                      Need expert help to bring your dream interiors to life?
                      From <br />
                      skilled carpenters and electricians to top-rated plumbers.
                    </p> */}
                    <button
                      className="btn btn-success btn-grey tranformBtn width"
                      onClick={() => setOnLoadPopup(true)}
                    >
                      Schedule a Free Consultation
                    </button>
                    <Link to="/customerservice">
                      <button className="btn btn-success btn-grey tranformBtn width explore">
                        Explore Services
                      </button>
                    </Link>
                  </div>
                </div>
                <div className="col-md-6 col-sm-6 ">
                  {/* <video width="100%" controls autoPlay loop muted>
                    <source
                      src="assets/images/Graphics (2) (online-video-cutter.com).mp4"
                      type="video/mp4"
                    />
                    Your browser does not support the video tag.
                  </video> */}
                  <img src="assets/images/bannerGif.gif" alt="" />
                </div>
              </div>
            </section>
          </div>

          {/* Slide 2 */}
          {/* <div>
            <section className="bn-sec homeBanner two">
              <div className="row net-row">
                <div className="col-md-7 col-sm-7 text-left pl-79 pl-tab">
                  <div className="contentPadLeft two">
                    <h1 className="netwrk-txt">
                      A Network of <span className="col-gren">300</span>{" "}
                      Interior Design Companies
                    </h1>
                    <div>
                      <p className="col-grey fnt-24">
                        Collaborating with over 300 interior design companies,
                        we form a powerhouse of creativity and expertise
                      </p>
                    </div>
                    <button
                      onClick={() => setOnLoadPopup(true)}
                      className="btn btn btn-success btn-greenish"
                    >
                      Transform My Space
                    </button>
                  </div>
                </div>{" "}
                <div className="col-sm-5 col-md-5 mobileColumn">
               
                  <img src="assets/images/networkVideo.gif" alt="" />
                </div>
              </div>
              <div className="row desktopRow">
                <div
                  className="col-md-12
      "
                >
                  <video width="100%" controls autoPlay loop muted>
                    <source
                      src="assets/images/network Video (1) (1) (1) (1).mp4"
                      type="video/mp4"
                    />
                    Your browser does not support the video tag.
                  </video>
                </div>
              </div>
            </section>
          </div> */}
        </Carousel>
      </div>
      {/* <div>
        <div className="row count-div2 col-bg-grey">
          <div className="col-md-3 text-center w-25 pg-20">
            <div className="number-div2">
              <div className="num-text ">500+</div>
              <div className="desc-text1">clients</div>
            </div>
          </div>
          <div className="col-md-3 text-center w-25 padL">
            <div className="number-div2">
              <div className="num-text">10+</div>
              <div className="desc-text1">Years of exprience</div>
            </div>
          </div>
          <div className="col-md-3 text-center w-25">
            <div className="number-div2">
              <div className="num-text">03+</div>
              <div className="desc-text1">Office in India</div>
            </div>
          </div>
          <div className="col-md-3 text-center w-25">
            <div className="number-div2 br-n">
              <div className="num-text ">500+</div>
              <div className="desc-text1">clients</div>
            </div>
          </div>
        </div>
      </div> */}
      <OngoingPopup
        openOnLoadPopup={onLoadPopup}
        onCloseLoadPopup={onCloseLoadPopup}
      />
    </>
  );
};

export default BannerService;
