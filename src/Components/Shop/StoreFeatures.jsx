import { IoHomeOutline } from "react-icons/io5";
import { RiCustomerService2Fill } from "react-icons/ri";
import { FaAward } from "react-icons/fa";
import { MdStars } from "react-icons/md";

const StoreFeatures = () => {
  return (
    <>
    {/* <!--Store Feature--> */}
      <section className="store-feature-section store-features style3">
        <div className="container">
          <div className="section-header d-none">
            <h2>Store Features</h2>
          </div>
          <div className="row store-info">
            <div className="col-12 col-sm-6 col-md-3 col-lg-3 d-flex flex-column align-items-center text-center mb-3 mb-md-0">
              <IoHomeOutline className="text-white m-0 features-icon" />
              <div className="detail text-white">
                <p>
                  At Optimal, family always comes first. It inspires everything
                  that we do.
                </p>
              </div>
            </div>
            <div className="col-12 col-sm-6 col-md-3 col-lg-3 d-flex flex-column align-items-center text-center mb-3 mb-md-0">
              <RiCustomerService2Fill className="text-white m-0 features-icon" />
              <div className="detail text-white">
                <p>
                  We provide the top notch customer service, worldwide and in
                  over 10 languages.
                </p>
              </div>
            </div>
            <div className="col-12 col-sm-6 col-md-3 col-lg-3 d-flex flex-column align-items-center text-center mb-3 mb-sm-0">
              <FaAward className="text-white m-0 features-icon" />
              <div className="detail text-white">
                <p>
                  Shop the designers you know and love. Authenticity and quality
                  are guaranteed.
                </p>
              </div>
            </div>
            <div className="col-12 col-sm-6 col-md-3 col-lg-3 d-flex flex-column align-items-center text-center">
              <MdStars className="text-white m-0 features-icon" />
              <div className="detail text-white">
                <p>
                  Your feedback is important to us. We enjoy hearing from every
                  one of you.
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>
    {/* <!--End Store Feature--> */}
    </>
  );
};

export default StoreFeatures;
