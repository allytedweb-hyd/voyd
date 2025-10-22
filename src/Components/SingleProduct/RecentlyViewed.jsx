/* eslint-disable react/prop-types */
/* eslint-disable react-hooks/exhaustive-deps */
import Carousel from "react-multi-carousel";
import "react-multi-carousel/lib/styles.css";
import { FaChevronLeft, FaChevronRight } from "react-icons/fa";
import ReactStars from "react-rating-stars-component";
import { useSelector } from "react-redux";
import { useEffect, useState } from "react";
import { saveRecentlyViewed } from "../../libs/endpoints";
import { environmentUrl } from "../../env/enviroment";

const RecentlyViewed = ({ product }) => {
  const user = useSelector((state) => state.user.user);
  const [recentViewed, setRecentViewed] = useState([]);
  const responsive = {
    desktop: {
      breakpoint: { max: 3000, min: 1660 },
      items: 6,
    },
    desktopTwo: {
      breakpoint: { max: 1660, min: 1200 },
      items: 5,
    },
    miniDesktop: {
      breakpoint: { max: 1200, min: 992 },
      items: 4,
    },
    largeTab: {
      breakpoint: { max: 992, min: 768 },
      items: 3,
    },
    tablet: {
      breakpoint: { max: 768, min: 574 },
      items: 3,
    },
    mobile: {
      breakpoint: { max: 574, min: 425 },
      items: 2,
    },
    miniMobile: {
      breakpoint: { max: 425, min: 0 },
      items: 1,
    },
  };

  const CustomLeftArrow = ({ onClick }) => (
    <button className="custom-arrow left-arrow" onClick={onClick}>
      <FaChevronLeft />
    </button>
  );

  const CustomRightArrow = ({ onClick }) => (
    <button className="custom-arrow right-arrow" onClick={onClick}>
      <FaChevronRight />
    </button>
  );

  const getRecentViewed = async () => {
    const apiUrl = `${environmentUrl}/products/get-recent-viewed.php?customer_id=${user?.customer_id}`;
    const options = {
      method: "GET",
    };
    const response = await (await fetch(apiUrl, options)).json();
    if (response?.status) {
      setRecentViewed(response?.response);
    }
  };

  useEffect(() => {
    saveRecentlyViewed(
      {
        id: product.product_id,
        title: product.title,
        thumbnail: product.thumbnail,
      },
      user?.customer_id
    );
  }, [product.product_id, user?.customer_id]);

  useEffect(() => {
    getRecentViewed();
  }, []);

  return (
    <>
      <section className="pdng-btm prouctSingle">
        <div className="container proCarousel">
          <Carousel
            responsive={responsive}
            infinite
            arrows={true}
            customLeftArrow={<CustomLeftArrow />}
            customRightArrow={<CustomRightArrow />}
          >
            {recentViewed.length > 0 &&
              recentViewed.map((item, index) => (
                <div className="product-card" key={index}>
                  <div className="bg-grey">
                    <div className="wishlist-icon">♡</div>
                    <img
                      className="product-image-2"
                      src="assets/images/My project (1) 1.png"
                      alt="Sofa"
                    />
                  </div>
                  <div className="product-details-2 text-start">
                    <h6 className="col-grey tdx-sinkrs">TDX Sinkers</h6>
                    <p className="product-price-2 m-0">₹ 675.00</p>
                    <p className="product-description m-0">
                      Lorem Ipsum is the word
                    </p>
                    <div className="rating-s">
                      <ReactStars
                        count={5}
                        size={13}
                        activeColor="#FBBC04"
                        value={2}
                        edit={false}
                      />
                    </div>
                  </div>
                </div>
              ))}

            {/* Add more <div className="product-card">...</div> as needed */}
          </Carousel>
        </div>
      </section>
    </>
  );
};

export default RecentlyViewed;
