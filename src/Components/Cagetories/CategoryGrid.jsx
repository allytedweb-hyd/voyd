import { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import { getOurServices } from "../../libs/endpoints";
import { envImgUrl } from "../../env/envImage";
import Loader from "../Spinner/Loader";

const CategoryGrid = () => {
  const [servicesData, setServicesData] = useState([]);
  const [loading, setLoading] = useState(true);

  const handleServices = async () => {
    const response = await getOurServices();
    const ourServices = response?.response;
    setServicesData(ourServices);
  };
  useEffect(() => {
    async function services() {
      await handleServices();
      setLoading(false);
    }
    services();
  }, []);
  console.log("our services data", servicesData);
  return (
    <>
      {loading && <Loader />}
      {!loading && (

        <>
          <section className="products pt-0 pt-0 mt--125">
            {/* <!--Header--> */}

            <header>
              {/* <div className="container"> */}
              {/* <ol className="breadcrumb">
              <li className="breadcrumb-item">
                <a href="#">Home</a>
              </li>
              <li className="breadcrumb-item">
                <a href="#">Library</a>
              </li>
              <li className="breadcrumb-item active" aria-current="page">
                Data
              </li>
            </ol> */}
              {/* <h2 className="title">Our Services</h2> */}
              {/* </div> */}

              <div className="bredcum">
                <img
                  src="assets/images/multi-banners/image-1.jpg"
                  alt="lightBanner"
                  className="banner-content image_zoom"
                />
                <h2 className="mt-0 mb-0">Our Services</h2>
              </div>
            </header>

            {/* <!--Content--> */}

            <div className="container">
              <div className="row">
                {/* <!--Product item--> */}
                {servicesData.length === 0 ? (
                  <div className="container">
                    <div className="row">
                      <div className="result-card">
                        <img src="assets/images/emptyWish.gif" alt="" />
                        <p>No Services Data Found</p>
                      </div>
                    </div>
                  </div>
                ) : (
                  servicesData.map((each, index) => (
                    <div className="col-6 col-lg-4" key={index}>
                      <article>
                        <div className="figure-block">
                          <div className="image">
                            <Link to="">
                              <img
                                src={`${envImgUrl}/Uploads/services/${each?.service_image}`}
                                alt={each?.service_alttext}
                                width="360"
                              />
                            </Link>
                          </div>
                          <div className="text">
                            <h2 className="title h4">
                              <Link to="">
                                {each?.service_title}
                              </Link>
                            </h2>
                          </div>
                        </div>
                      </article>
                    </div>
                  ))
                )}
              </div>
              {/* <!--/row--> */}
            </div>
            {/* <!--/container--> */}
          </section>
        </>
      )}
    </>
  );
};

export default CategoryGrid;
