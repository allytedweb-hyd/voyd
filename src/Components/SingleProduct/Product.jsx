/* eslint-disable react-hooks/exhaustive-deps */
// import { Link } from "react-router-dom";
// import { IoIosHeart } from "react-icons/io";
// import { IoIosHeartEmpty } from "react-icons/io";
// import { PiEye } from "react-icons/pi";
// import { PiEyeSlash } from "react-icons/pi";
// import { BiStar } from "react-icons/bi";
// import { BiSolidStar } from "react-icons/bi";
import "react-responsive-carousel/lib/styles/carousel.min.css"; // requires a loader
import { Carousel } from "react-responsive-carousel";
import { environmentUrl } from "../../env/enviroment";
import { envImgUrl } from "../../env/envImage";
import { useEffect, useState } from "react";
import { IoIosAdd } from "react-icons/io";
import { FiMinus } from "react-icons/fi";
import Zoom from "react-zoom-image-hover/dist/esm/components/Zoom";
import { addToCart } from "../../libs/endpoints";
import { toast } from "sonner";
import Sonner from "../Toaster/Sonner";
import Loader from "../Spinner/Loader";

const Product = () => {
  const [singleProduct, setSingleProduct] = useState([]);
  const [loading, setLoading] = useState(false);
  const productParams = window.location.search;
  const getSingleProduct = async () => {
    try {
      setLoading(true);
      const apiUrl = `${environmentUrl}/products/getSingleProduct.php${productParams}`;
      const options = {
        method: "GET",
      };
      const productRes = await (await fetch(apiUrl, options)).json();
      const response = productRes?.response;
      setSingleProduct(response);
    } catch (error) {
      console.log("single product error", error);
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    getSingleProduct();
  }, []);
  console.log("single product data is====", singleProduct);
  const responsive = {
    superLargeDesktop: {
      // the naming can be any, depends on you.
      breakpoint: { max: 4000, min: 3000 },
      items: 1,
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

  const handleBuyNow = async (product) => {
    const response = await addToCart(product);
    if (response?.status == "warning") {
      toast.warning("Product Already Added To Cart");
    } else {
      if (response.status) {
        toast.success("Successfully Added To Cart");
      } else {
        toast.error("Failed To Add");
      }
    }
  };

  return (
    <>
      {loading && <Loader />}
      <section className="product pt-0 pt-0 mt--125">
        <header>
          <div className="bredcum">
            <img
              src="assets/images/img-9.jpg"
              alt="lightBanner"
              className="banner-content image_zoom"
            />
            <h2 className="mt-0 mb-0">Single Product</h2>
          </div>
        </header>

        <div className="main">
          <div className="container">
            {singleProduct.map((each, index) => (
              <div className="row product-flex" key={index}>
                <div className="col-lg-4 product-flex-info">
                  <div className="clearfix">
                    <div className="clearfix">
                      {/* <!--price wrapper--> */}
                      <div className="container">
                        <h2 className="title">{each.product_title}</h2>
                        <div className="text">
                          <p
                            dangerouslySetInnerHTML={{
                              __html: each.product_description,
                            }}
                          ></p>
                        </div>
                      </div>
                      <div className="price">
                        <span className="h3">
                          ₹ {each.product_mrp}/-
                          <small>₹ {each.product_offerprice}/-</small>
                        </span>
                      </div>

                      <hr />

                      {/* <!--info-box--> */}

                      <div className="info-box">
                        <span>
                          <strong>Category :</strong>
                        </span>
                        <span>{each.sub_category}</span>
                      </div>

                      {/* <!--info-box--> */}

                      <div className="info-box">
                        <span>
                          <strong>Materials :</strong>
                        </span>
                        <span>{each.product_category}</span>
                      </div>

                      <hr />

                      {/* <!--info-box--> */}

                      {/* <div className="info-box">
                        <span>
                          <strong>Available Colors</strong>
                        </span>
                        <div className="product-colors clearfix">
                          <span className="color-btn color-btn-red"></span>
                          <span className="color-btn color-btn-blue checked"></span>
                          <span className="color-btn color-btn-green"></span>
                          <span className="color-btn color-btn-gray"></span>
                          <span className="color-btn color-btn-biege"></span>
                        </div>
                      </div>

                      <hr /> */}

                      {/* <!--info-box--> */}

                      <div className="info-box">
                        <span>
                          <strong>Choose size :</strong>
                        </span>
                        <div className="product-colors clearfix">
                          <span className="color-btn color-btn-biege">
                            <span className="product-size" data-text="">
                              S
                            </span>
                          </span>
                        </div>
                      </div>

                      <hr />

                      <div className="info-box">
                        <span>Quantity :</span>
                        <span>
                          <span className="row">
                            <span className="col-10 proquantity">
                              <button className="addition">
                                <FiMinus />
                              </button>
                              <input
                                type="number"
                                value={each.product_quantity}
                                className="form-control quantity"
                              />
                              <button className="addition">
                                <IoIosAdd />
                              </button>
                            </span>
                          </span>
                        </span>
                      </div>
                      <hr />
                      <div>
                        <span>
                          <span className="row">
                            <span className="col-12 probutton">
                              <button
                                onClick={() => {
                                  handleBuyNow(each);
                                }}
                                className="btn btn-danger quan-button"
                              >
                                Buy now
                              </button>
                            </span>
                          </span>
                        </span>
                      </div>

                      {/* <hr /> */}

                      <div className="info-box">
                        <span>
                          <small>
                            *** We progress your order for shipping as soon as
                            possible. Please note that after your order has been
                            received, we can not change the delivery address.
                            Control your address details in any case before
                            placing your order!
                          </small>
                        </span>
                      </div>

                      <hr />
                    </div>
                    {/* <!--/clearfix--> */}
                  </div>
                  {/* <!--/product-info-wrapper--> */}
                </div>
                {/* <!--/col-lg-4--> */}
                {/* <!--product item gallery--> */}

                {/* <div className="col-lg-8 product-flex-gallery"> */}
                {/* <!--product gallery--> */}

                <div className="col-lg-8 product-flex-gallery">
                  <div className="owl-product-gallery  owl-theme open-popup-gallery">
                    <Carousel
                      responsive={responsive}
                      swipeable={true}
                      labels={false}
                      showArrows={true}
                    >
                      <div>
                        <Zoom
                          height={500}
                          width={760}
                          zoomScale={1}
                          src={`${envImgUrl}/Uploads/products/${each.image_1}`}
                        />
                      </div>

                      <div>
                        <Zoom
                          height={500}
                          width={760}
                          zoomScale={1}
                          src={`${envImgUrl}/Uploads/products/${each.image_2}`}
                        />
                      </div>
                      <div>
                        <Zoom
                          height={500}
                          width={760}
                          zoomScale={1}
                          src={`${envImgUrl}/Uploads/products/${each.image_3}`}
                        />
                      </div>
                      <div>
                        <Zoom
                          height={500}
                          width={760}
                          zoomScale={1}
                          src={`${envImgUrl}/Uploads/products/${each.image_4}`}
                        />
                      </div>
                    </Carousel>
                  </div>
                </div>
                {/* </div> */}
              </div>
            ))}
          </div>
        </div>
      </section>
      <Sonner />
    </>
  );
};

export default Product;
