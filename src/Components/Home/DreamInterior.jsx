import { useState } from "react";
import OngoingPopup from "../Popups/OngoingPopup";
import ReferAFriend from "../Popups/ReferAFriend";

const DreamInterior = () => {
  const [onLoadPopup, setOnLoadPopup] = useState(false);
  const [referAFriend, setReferAFriend] = useState(false);
  const onCloseLoadPopup = () => {
    setOnLoadPopup(false);
  };
  const onCloseReferAFriend = () => {
    setReferAFriend(false);
  };

  const handleServices = () => {
    let token = localStorage.getItem("token");
    if (token) {
      setReferAFriend(true);
    } else {
      setOnLoadPopup(true);
    }
  };

  // useEffect(() => {
  //   const token = localStorage.getItem("token");
  //   if (token == null || token == undefined || token == "") {
  //     setOnLoadPopup(true);
  //   } else {
  //     setReferAFriend(true);
  //   }
  // }, []);
  return (
    <>
      <section className="dreamSection">
        <div className="container">
          <div className="titlesBlock">
            <h1>
              You Dream, <span>We Execute !</span> <br /> Interior Execution{" "}
              <br className="mblpart" />
              Partner
            </h1>
            <div className="mobileGridImg">
              <img src="assets/images/Pattern.png" alt="" />
            </div>
            <p>
              Helping property owners fo find with top design firms,
              cost-effective material sourcing, <br /> quality checks, and
              end-to-end project monitoring with weekly inspection updates.
            </p>
            <div className="enrollButton">
              <button onClick={handleServices}>
                {localStorage.getItem("token") == null ||
                localStorage.getItem("token") == undefined ||
                localStorage.getItem("token") == ""
                  ? "Enroll Our Services"
                  : "Refer A Friend"}
              </button>
            </div>
          </div>
          <div className="curveCards">
            <div className="curveImages">
              <div className="one">
                <p>
                  Learn Interior <br /> Essentials
                </p>
                <img src="assets/images/dreamImg1.png" alt="" />
              </div>
              <div className="two">
                <p>Budget Planning</p>
                <img src="assets/images/dreamImg2.png" alt="" />
              </div>
              <div className="three">
                <p>Vendor Selection</p>
                <img src="assets/images/dreamImg3.png" alt="" />
              </div>
              <div className="four">
                <p>Property Inspection</p>
                <img src="assets/images/dreamImg4.png" alt="" />
              </div>
              <div className="five">
                <p>Project Monitoring</p>
                <img src="assets/images/dreamImg5.png" alt="" />
              </div>
              <div className="six">
                <p>
                  Design & Style <br /> Advisory
                </p>
                <img src="assets/images/dreamImg6.png" alt="" />
              </div>
              <div className="seven">
                <p>
                  Service <br /> Warranty
                </p>
                <img src="assets/images/dreamImg7.png" alt="" />
              </div>
            </div>
          </div>
          <div className="mobileCurveCards">
            <div className="mobileCurveImages one">
              <div className="one">
                <p>
                  Learn Interior <br /> Essentials
                </p>
                <img src="assets/images/mblDrream11.png" alt="" />
              </div>
              <div className="two">
                <p>Budget Planning</p>
                <img src="assets/images/mblDrream2.png" alt="" />
              </div>
              <div className="three">
                <p>Vendor Selection</p>
                <img src="assets/images/mblDrream3.png" alt="" />
              </div>
              <div className="four">
                <p>
                  Property <br /> Inspection
                </p>
                <img src="assets/images/mblDrream4.png" alt="" />
              </div>
            </div>
            <div className="mobileCurveImages two">
              <div className="five">
                <img src="assets/images/mblDrream5.png" alt="" />
                <p>
                  Project <br /> Monitoring
                </p>
              </div>
              <div className="six">
                <img src="assets/images/mblDrream6.png" alt="" />
                <p>
                  Design & Style <br /> Advisory
                </p>
              </div>
              <div className="seven">
                <img src="assets/images/mblDrream7.png" alt="" />
                <p>
                  Service <br /> Warranty
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>
      {onLoadPopup && (
        <OngoingPopup
          openOnLoadPopup={onLoadPopup}
          onCloseLoadPopup={onCloseLoadPopup}
        />
      )}
      {referAFriend && (
        <ReferAFriend
          openReferAFriend={referAFriend}
          onCloseReferAFriend={onCloseReferAFriend}
        />
      )}
    </>
  );
};
export default DreamInterior;
