import { useState } from "react";
import OngoingPopup from "../Popups/OngoingPopup";
const AboutBanner = () => {
  const [onLoadPopup, setOnLoadPopup] = useState(false);
  const onCloseLoadPopup = () => {
    setOnLoadPopup(false);
  };
  return (
    <div>
      <div>
        <section className="abt-bg-img d-flex justify-content-center align-items-center pos-rel">
          {/* <div className="overlay-layer"></div> */}
          <div className="row w-100 j-end pos-rel z-2">
            <div className="col-md-7 col-sm-6"></div>
            <div className="col-md-5 col-sm-6 text-light text-start mob-bnr">
              <div className="about-div about-dktp abt-dsk">
                <div className="abt-bnr-txt">Find Your Interiors </div>
                <h1 className="abt-bnr-hdng bnr-phnn">
                  Who We Are: Transforming Spaces, Inspiring Lives
                </h1>
                <button
                  className="abt-con-btn text-light"
                  onClick={() => setOnLoadPopup(true)}
                >
                  Contact Us
                </button>
              </div>
            </div>
          </div>
        </section>
      </div>

      <OngoingPopup
        openOnLoadPopup={onLoadPopup}
        onCloseLoadPopup={onCloseLoadPopup}
      />
    </div>
  );
};

export default AboutBanner;
