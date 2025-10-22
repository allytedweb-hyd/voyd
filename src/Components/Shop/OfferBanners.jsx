/* eslint-disable react/jsx-key */
import { useEffect, useState } from "react";
import Carousel from "react-multi-carousel";
import "react-multi-carousel/lib/styles.css";
import { environmentUrl } from "../../env/enviroment";
// import { Link } from "react-router-dom";
import { envImgUrl } from "../../env/envImage";
import Loader from "../Spinner/Loader";

const OfferBanners = () => {
  const [offers, setOffers] = useState([]);
  const [loading, setLoading] = useState(true);

  const getOfferBanners = async () => {
    const apiUrl = `${environmentUrl}/shop/getBanners.php`;
    const options = {
      method: "GET",
    };
    const offerBannerFetch = await (await fetch(apiUrl, options)).json();
    const res = offerBannerFetch?.response;
    setOffers(res);
  };
  useEffect(() => {
    async function banner() {
      await getOfferBanners();
      setLoading(false);
    }
    banner();
  }, []);
  console.log("offer banners are", offers);

  const responsive = {
    superLargeDesktop: {
      // the naming can be any, depends on you.
      breakpoint: { max: 4000, min: 3000 },
      items: 5,
    },
    desktop: {
      breakpoint: { max: 3000, min: 1024 },
      items: 1,
    },
    tablet: {
      breakpoint: { max: 1024, min: 464 },
      items: 1,
    },
    mobile: {
      breakpoint: { max: 464, min: 0 },
      items: 1,
    },
  };

  return (
    <>
      {loading && <Loader />}
      {!loading && (

        <>
          <div id="page-content">
            {/* <!--Home slider--> */}
            <section className="header-content">
              <Carousel
                responsive={responsive}
                // autoPlay={true}
                autoPlaySpeed={5000}
                infinite={true}
                swipeable={true}
                className="header-content-banner"
              >
                {/* <!--Slide item--> */}

                {offers.map((eachImg) => (
                  <div className="item d-flex align-items-center carouselImage">
                    <img
                      src={`${envImgUrl}/Uploads/shopbanners/${eachImg.bnr_img}`}
                      alt={eachImg.bnr_alt_text}
                      key={eachImg.bnr_id}
                      className="tst_01"
                    />
                  </div>
                ))}
              </Carousel>
            </section>
            {/* <!--End Home slider--> */}
          </div>
        </>
      )}
    </>
  );
};
export default OfferBanners;
