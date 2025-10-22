import { ImGift } from "react-icons/im";
import { HiOutlineRocketLaunch } from "react-icons/hi2";
import { GiBackwardTime } from "react-icons/gi";
import { CiDiscount1 } from "react-icons/ci";

const Benefits = () => {
  return (
    <>
      <section className="benefits">
        {/* <!--Header--> */}

        <header className="d-none">
          <div className="container-fluid">
            <h2 className="h2 title">Benefits</h2>
          </div>
        </header>

        {/* <!--Header--> */}

        <div className="container-fluid mb-2">
          <div className="row">
            {/* <!--Icon--> */}

            <div className="col-6 col-lg-3" data-tilt>
              <figure>
                <div className="icon">
                  <ImGift className="benefits-icons" />
                </div>
                <figcaption>
                  <span>
                    <strong>Get your gift</strong> <br />
                    <small>Are you a new customer?</small>
                  </span>
                </figcaption>
              </figure>
            </div>

            {/* <!--Icon--> */}

            <div className="col-6 col-lg-3" data-tilt>
              <figure>
                <div className="icon">
                  <HiOutlineRocketLaunch className="benefits-icons" />
                </div>
                <figcaption>
                  <span>
                    <strong>Fast delivery</strong> <br />
                    <small>We`&apos;`re shipping all over the world</small>
                  </span>
                </figcaption>
              </figure>
            </div>

            {/* <!--Icon--> */}

            <div className="col-6 col-lg-3" data-tilt>
              <figure>
                <div className="icon">
                  <GiBackwardTime className="benefits-icons" />
                </div>
                <figcaption>
                  <span>
                    <strong>Money-back guarantee</strong> <br />
                    <small>30 day money back gurantee</small>
                  </span>
                </figcaption>
              </figure>
            </div>

            {/* <!--Icon--> */}

            <div className="col-6 col-lg-3" data-tilt>
              <figure>
                <div className="icon">
                  <CiDiscount1 className="benefits-icons" />
                </div>
                <figcaption>
                  <span>
                    <strong>VIP discounts</strong> <br />
                    <small>Become VIP member</small>
                  </span>
                </figcaption>
              </figure>
            </div>
          </div>
          {/* <!--/row--> */}
        </div>
        {/* <!--/container--> */}
      </section>
    </>
  );
};

export default Benefits;
