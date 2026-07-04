import { useState } from "react";
// import OngoingPopup from "../Components/Popups/OngoingPopup";
import BookConsultation from "../Components/Popups/BookConsultation";
import SEO from "../Components/SEO";
const VendorService = () => {
  // const [onLoadPopup, setOnLoadPopup] = useState(false);
  // const onCloseLoadPopup = () => {
  //   setOnLoadPopup(false);
  // };
  const [bookPopup, setBookPopup] = useState(false);
  const onCloseBookPopup = () => {
    setBookPopup(false);
  };
  return (
    <>
      <SEO
        title="Grow Your Interior Business with VOYD"
        description="A complete support ecosystem for interior vendors—from client acquisition to project execution."
        keywords="vendors for interior designers, interior vendor services, interior business growth, interior project leads, qualified interior leads, interior vendor platform
interior contractor leads, vendor support services, interior business solutions
interior partner network, interior project opportunities"
      />

      <div className="v-sec-bg">
        <section>
          <div className="">
            <div className="row ">
              <div className="col-md-8 col-sm-8 d-flex align-items-center">
                <div className="v-all-div">
                  <div className="v-serv-txt">
                    How We Drive Interior Designers&#39;{" "}
                    <span className="gro-txt">Growth</span>
                  </div>
                  <p className="v-serv-p">
                    We help bring your dream spaces to life with a variety of
                    creative and functional interior designs. Let’s create
                    beauty together with our expert team.
                  </p>
                  <div className="txt-start">
                    <button
                      className="button-v-serv1"
                      onClick={() => setBookPopup(true)}
                    >
                      Book a Consultation
                    </button>
                  </div>
                </div>
              </div>
              <div className="col-md-4 col-sm-4">
                <div className="d-mob-none">
                  <img src="assets/images/Group 1618873979.png" alt="" />
                </div>
              </div>
            </div>
          </div>
        </section>
        <section>
          <div className="container con-vs">
            <div className="row mob-rev">
              <div className="col-md-6  col-sm-6  j-c-mob  d-flex align-items-center">
                <div className="j-centerr-mob w-half  d-flex justify-content-center">
                  <img
                    src="assets/images/Group 1618873906.png"
                    alt=""
                    className=""
                  />
                </div>
              </div>
              <div className="col-md-6  col-sm-6   text-start d-flex align-items-center">
                <div>
                  <div className="v-serv-ul">
                    1. Qualified Leads & Business Growth
                  </div>
                  <ul className="v-serv-li">
                    <li>
                      Get high-quality, verified leads from customers actively
                      seeking interior solutions.
                    </li>
                    <li>
                      {" "}
                      AI-powered lead matching based on expertise, location, and
                      budget preferences.
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div className="row rev1">
              <div className="col-md-6  col-sm-6   text-start d-flex align-items-center">
                <div>
                  <div className="v-serv-ul">
                    2. Guaranteed & Timely Payments
                  </div>
                  <ul className="v-serv-li">
                    <li>
                      No more payment delays—our platform ensures
                      milestone-based payments.{" "}
                    </li>
                    <li>
                      {" "}
                      Secure transactions with escrow protection for both
                      designers and clients.
                    </li>
                  </ul>
                </div>
              </div>
              <div className="col-md-6  col-sm-6  j-c-mob  d-flex align-items-center">
                <div className="j-centerr-mob w-half">
                  <img
                    src="assets/images/Group 1618873914.png"
                    alt=""
                    className=""
                  />
                </div>
              </div>
            </div>
            <div className="row mob-rev">
              <div className="col-md-6  col-sm-6  j-c-mob  d-flex align-items-center">
                <div className="j-centerr-mob w-half">
                  <img
                    src="assets/images/Group 1618873980.png"
                    alt=""
                    className=""
                  />
                </div>
              </div>
              <div className="col-md-6  col-sm-6   text-start d-flex align-items-center">
                <div>
                  <div className="v-serv-ul">
                    3. Raw Material Sourcing & On-Time Delivery
                  </div>
                  <ul className="v-serv-li">
                    <li>
                      Connect with verified material suppliers for
                      cost-effective procurement.
                    </li>
                    <li>
                      Real-time tracking of material availability and delivery
                      schedules.
                    </li>
                    <li>
                      Bulk order discounts and vendor negotiations handled by
                      our platform.
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div className="row rev1 row-gp">
              <div className="col-md-6  col-sm-6   text-start d-flex align-items-center">
                <div>
                  <div className="v-serv-ul">
                    4. Vendor Profile Marketing & Branding
                  </div>
                  <ul className="v-serv-li">
                    <li>
                      Get featured in our designer directory for greater
                      visibility.
                    </li>
                    <li>
                      {" "}
                      Market your profile with case studies, testimonials, and
                      portfolio showcases.
                    </li>
                    <li>
                      {" "}
                      Exclusive access to high-net-worth clients looking for
                      premium interior design services.
                    </li>
                  </ul>
                </div>
              </div>
              <div className="col-md-6  col-sm-6  j-c-mob  d-flex align-items-center">
                <div className="j-centerr-mob w-half">
                  <img
                    src="assets/images/Group 1618873908.png"
                    alt=""
                    className=""
                  />
                </div>
              </div>
            </div>
            <div className="row mob-rev row-gp">
              <div className="col-md-6  col-sm-6  j-c-mob  d-flex align-items-center">
                <div className="j-centerr-mob w-half">
                  <img
                    src="assets/images/Group 1618873909.png"
                    alt=""
                    className=""
                  />
                </div>
              </div>
              <div className="col-md-6  col-sm-6   text-start d-flex align-items-center">
                <div>
                  <div className="v-serv-ul">
                    5. Fewer Design Revisions & Smooth Approvals
                  </div>
                  <ul className="v-serv-li">
                    <li>
                      Top trending, modern and classical designs approved by top
                      designer architects{" "}
                    </li>
                    <li>
                      Reduce unnecessary revisions with pre-approved 3D
                      visualizations and AI-backed design recommendations.
                    </li>
                    <li>
                      Clients get a realistic project preview, minimizing
                      last-minute changes.
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div className="row l-div rev1 row-gp">
              <div className="col-md-6  col-sm-6   text-start d-flex align-items-center">
                <div>
                  <div className="v-serv-ul">
                    6. Ready-Made Studio Space for Client Meetings
                  </div>
                  <ul className="v-serv-li">
                    <li>
                      Access pre-furnished studio spaces to meet and impress
                      potential customers..
                    </li>
                    <li>
                      Showcase design samples and material selections in a
                      professional setting.
                    </li>
                    <li>
                      Improve conversion rates by giving clients a real-time
                      experience of your work.
                    </li>
                  </ul>
                </div>
              </div>
              <div className="col-md-6  col-sm-6  j-c-mob  d-flex align-items-center">
                <div className="j-centerr-mob w-half">
                  <img
                    src="assets/images/Group 1618873905.png"
                    alt=""
                    className=""
                  />
                </div>
              </div>
            </div>
            <div className="row mob-rev row-gp">
              <div className="col-md-6  col-sm-6  j-c-mob  d-flex align-items-center">
                <div className="j-centerr-mob w-half">
                  <img
                    src="assets/images/Group 1618874320.png"
                    alt=""
                    className=""
                  />
                </div>
              </div>
              <div className="col-md-6  col-sm-6   text-start d-flex align-items-center">
                <div>
                  <div className="v-serv-ul">7. Labor Support</div>
                  <ul className="v-serv-li">
                    <li>
                      Top trending, modern and classical designs approved by top
                      designer architects{" "}
                    </li>
                    <li>
                      Reduce unnecessary revisions with pre-approved 3D
                      visualizations and AI-backed design recommendations.
                    </li>
                    <li>
                      Clients get a realistic project preview, minimizing
                      last-minute changes.
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div className="row rev1 row-gp">
              <div className="col-md-6  col-sm-6   text-start d-flex align-items-center">
                <div>
                  <div className="v-serv-ul">8.Remote Monitoring</div>
                  <ul className="v-serv-li">
                    <li>
                      Get featured in our designer directory for greater
                      visibility.
                    </li>
                    <li>
                      {" "}
                      Market your profile with case studies, testimonials, and
                      portfolio showcases.
                    </li>
                    <li>
                      {" "}
                      Exclusive access to high-net-worth clients looking for
                      premium interior design services.
                    </li>
                  </ul>
                </div>
              </div>
              <div className="col-md-6  col-sm-6  j-c-mob  d-flex align-items-center">
                <div className="j-centerr-mob w-half">
                  <img
                    src="assets/images/Group 1618874321.png"
                    alt=""
                    className=""
                  />
                </div>
              </div>
            </div>
            <div className="row mob-rev row-gp pb-phn">
              <div className="col-md-6  col-sm-6  j-c-mob  d-flex align-items-center">
                <div className="j-centerr-mob w-half">
                  <img
                    src="assets/images/Group 1618874322.png"
                    alt=""
                    className=""
                  />
                </div>
              </div>
              <div className="col-md-6  col-sm-6   text-start d-flex align-items-center ">
                <div>
                  <div className="v-serv-ul">9. 2D and 3D Design Services</div>
                  <ul className="v-serv-li">
                    <li>
                      No more payment delays—our platform ensures
                      milestone-based payments.{" "}
                    </li>
                    <li>
                      Secure transactions with escrow protection for both
                      designers and clients.{" "}
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </section>
        <div>
          <img src="assets/images/Ellipse 5.png" alt="" className="c-v-serv" />
        </div>

        <section>
          <div className="container"></div>
        </section>
      </div>
      {/* <OngoingPopup
        openOnLoadPopup={onLoadPopup}
        onCloseLoadPopup={onCloseLoadPopup}
      /> */}
      <BookConsultation
        openBookPopup={bookPopup}
        onCloseBookPopup={onCloseBookPopup}
      />
    </>
  );
};

export default VendorService;
