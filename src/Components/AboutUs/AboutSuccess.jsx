import { FaUsers } from "react-icons/fa";
import { CiDeliveryTruck } from "react-icons/ci";
import { BiSolidOffer } from "react-icons/bi";
import { MdLocalOffer } from "react-icons/md";

const AboutSuccess = () => {
  return (
    <>
      <section className="numbers">
        {/* <!--Header--> */}

        <header>
          <div className="container">
            <h1 className="h2 title">Your success is our success</h1>
            <div className="text">
              <p>
                Our architects and designers constantly and carefully monitor
                the environment, they accept and develop changes, research
                fashion and architectural, as well as sociological, changes and
                transform them into unique design.
              </p>
            </div>
          </div>
        </header>

        {/* <div className="container">
          <div className="row">
            <div className="col-md-3">
              <div className="item">
                <span className="chart" data-percent="100">
                  <span className="percent"></span>
                </span>
                <div className="title">Delivery</div>
                <div className="text">We act skilfully</div>
              </div>
            </div>
            <div className="col-md-3">
              <div className="item">
                <span className="chart" data-percent="40">
                  <span className="percent"></span>
                </span>
                <div className="title">Discounts</div>
                <div className="text">We respond quickly </div>
              </div>
            </div>
            <div className="col-md-3">
              <div className="item">
                <span className="chart" data-percent="85">
                  <span className="percent"></span>
                </span>
                <div className="title">Promo</div>
                <div className="text">We focus on market</div>
              </div>
            </div>
            <div className="col-md-3">
              <div className="item">
                <span className="chart" data-percent="100">
                  <span className="percent"></span>
                </span>
                <div className="title">Happy clients</div>
                <div className="text">We work with our customers </div>
              </div>
            </div>
          </div>
        </div> */}
        <div className="container">
          <div className="row">
            <div className="col-md-3">
              <div className="counter-card">
                <h1>
                  <span className="counter">2,523</span>
                </h1>
                <h3>Offers</h3>
                <MdLocalOffer className="counter-icon" />
              </div>
            </div>
            <div className="col-md-3">
              <div className="counter-card">
                <h1>
                  <span className="counter">63,075</span>
                </h1>
                <h3>Discounts</h3>
                <BiSolidOffer className="counter-icon" />
              </div>
            </div>
            <div className="col-md-3">
              <div className="counter-card">
                <h1>
                  <span className="counter">12,218</span>
                </h1>
                <h3>Deliverables</h3>
                <CiDeliveryTruck className="counter-icon" />
              </div>
            </div>
            <div className="col-md-3">
              <div className="counter-card">
                <h1>
                  <span className="counter">12,218</span>
                </h1>
                <h3>Happy Clients</h3>
                <FaUsers className="counter-icon" />
              </div>
            </div>
          </div>
        </div>
      </section>
    </>
  );
};

export default AboutSuccess;
