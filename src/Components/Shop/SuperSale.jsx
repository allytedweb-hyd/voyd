import { useEffect, useRef, useState } from "react";
import Carousel from "react-multi-carousel";
import "react-multi-carousel/lib/styles.css";
import { GoHeart } from "react-icons/go";
import { addToCart, shopCategoryProducts } from "../../libs/endpoints";
import Loader from "../Spinner/Loader";
import ReactStars from "react-rating-stars-component";
import { envImgUrl } from "../../env/envImage";
import { environmentUrl } from "../../env/enviroment";
import { toast } from "sonner";
import Sonner from "../Toaster/Sonner";
import { TiArrowRight } from "react-icons/ti";
import { Link } from "react-router-dom";
import { HiOutlineShoppingCart } from "react-icons/hi2";
import { GoHeartFill } from "react-icons/go";
import { addToWishlist, getWishlistItems } from "../../libs/endpoints";

const SuperSale = () => {
  const carouselRef = useRef(null);
  const [loading, setLoading] = useState(false);
  const [superSaleProducts, setSuperSaleProducts] = useState([]);
  const [saleStatus, setSaleStatus] = useState(null);
  const [countdown, setCountdown] = useState("");
  const [rawSeconds, setRawSeconds] = useState(null);
  const [currentSaleId, setCurrentSaleId] = useState(null);
  const [wishlisted, setWishlisted] = useState([]);

  const getAllWishListedProducts = async () => {
    try {
      setLoading(true);
      const response = await getWishlistItems();
      if (response?.status && Array.isArray(response?.response)) {
        const productIds = response.response.map((item) => item.product_id);
        setWishlisted(productIds);
      }
    } catch (error) {
      console.log(error);
    } finally {
      setLoading(false);
    }
  };

  // const handleAddToWishlist = async (eachProduct) => {
  //   try {
  //     let response = await addToWishlist(eachProduct);
  //     if (response?.status) {
  //       toast.success(response?.response);
  //       getAllWishListedProducts();
  //     } else {
  //       const errorMsg = response?.message || "Something went wrong";
  //       toast.error(errorMsg);
  //     }
  //   } catch (error) {
  //     console.log(error);
  //     toast.error("An error occurred. Please try again.");
  //   }
  // };

  const handleAddToWishlist = async (eachProduct) => {
    try {
      const response = await addToWishlist(eachProduct);

      if (response?.status) {
        toast.success(response?.response);

        setWishlisted((prev) => {
          const alreadyWishlisted = prev.includes(eachProduct.product_id);
          if (alreadyWishlisted) {
            return prev.filter((id) => id !== eachProduct.product_id);
          } else {
            return [...prev, eachProduct.product_id];
          }
        });
      } else {
        const errorMsg = response?.message || "Something went wrong";
        toast.error(errorMsg);
      }
    } catch (error) {
      console.log(error);
      toast.error("An error occurred. Please try again.");
    }
  };

  const responsivee = {
    superLargeDesktop: {
      breakpoint: { max: 4000, min: 3000 },
      items: 4,
    },
    desktop: {
      breakpoint: { max: 3000, min: 1250 },
      items: 5,
    },
    miniDesktop: {
      breakpoint: { max: 1250, min: 991 },
      items: 4,
    },
    tablet: {
      breakpoint: { max: 991, min: 767 },
      items: 3,
    },
    miniTablet: {
      breakpoint: { max: 767, min: 574 },
      items: 3,
    },
    mobile: {
      breakpoint: { max: 574, min: 0 },
      items: 1,
    },
  };

  const getCountdownParts = (seconds) => {
    const d = Math.floor(seconds / (24 * 60 * 60));
    const h = Math.floor((seconds % (24 * 60 * 60)) / 3600);
    const m = Math.floor((seconds % 3600) / 60);
    const s = seconds % 60;

    return {
      days: String(d).padStart(2, "0"),
      hours: String(h).padStart(2, "0"),
      minutes: String(m).padStart(2, "0"),
      seconds: String(s).padStart(2, "0"),
    };
  };

  const fetchSaleData = async () => {
    try {
      setLoading(true);
      const apiUrl = `${environmentUrl}/shop/getSuperSale.php`;
      const options = {
        method: "GET",
      };
      const response = await fetch(apiUrl, options);
      const res = await response.json();
      if (res.status === true && Array.isArray(res.response)) {
        // CASE 1: array of sales
        let liveSale = null;
        let upcomingSales = [];

        for (const saleObj of res.response) {
          if (saleObj.ends_in) {
            liveSale = saleObj;
            break;
          } else if (saleObj.starts_in) {
            upcomingSales.push(saleObj);
          }
        }

        if (liveSale) {
          setSaleStatus("live");
          setCurrentSaleId(liveSale.super_sale_id || null);
          const totalSec = extractSecondsFromFormattedString(liveSale.ends_in);
          setRawSeconds(totalSec);
        } else if (upcomingSales.length > 0) {
          // Pick the soonest upcoming sale
          let soonest = upcomingSales[0];
          let minSeconds = extractSecondsFromFormattedString(soonest.starts_in);

          for (const sale of upcomingSales) {
            const sec = extractSecondsFromFormattedString(sale.starts_in);
            if (sec < minSeconds) {
              minSeconds = sec;
              soonest = sale;
            }
          }

          setSaleStatus("scheduled");
          setCurrentSaleId(soonest.sale_id || null);
          setRawSeconds(minSeconds);
          setSuperSaleProducts([]);
        } else {
          setSaleStatus("none");
          setRawSeconds(null);
          setSuperSaleProducts([]);
          setCurrentSaleId(null);
        }
      } else if (
        res.status === false &&
        res.response &&
        res.response.starts_in
      ) {
        // CASE 2: scheduled sale returned as single object

        const totalSec = extractSecondsFromFormattedString(
          res.response.starts_in
        );

        setSaleStatus("scheduled");
        setRawSeconds(totalSec);
        setSuperSaleProducts([]);
      } else {
        setSaleStatus("none");
        setRawSeconds(null);
        setSuperSaleProducts([]);
      }
    } catch (error) {
      console.log("get all super sale products error==", error);
    } finally {
      setLoading(false);
    }
  };

  const extractSecondsFromFormattedString = (str) => {
    const [d, h, m, s] = str.match(/\d+/g).map(Number);
    return d * 86400 + h * 3600 + m * 60 + s;
  };

  const getAllSuperSaleProducts = async () => {
    try {
      setLoading(true);
      const response = await shopCategoryProducts("super_sale", 5, 0);
      if (response?.status) {
        setSuperSaleProducts(response?.response);
      }
    } catch (error) {
      console.log("get all super sale products error==", error);
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    if (saleStatus === "live") {
      getAllSuperSaleProducts();
    } else {
      setSuperSaleProducts([]);
    }
  }, [saleStatus]);

  // useEffect(() => {
  //   fetchSaleData();

  //   const id = setInterval(() => {
  //     fetchSaleData();
  //   }, 60 * 1000);

  //   setIntervalId(id);

  //   return () => clearInterval(id);
  // }, []);

  // useEffect(() => {
  //   if (rawSeconds === null) return;

  //   const countdownId = setInterval(() => {
  //     setRawSeconds((prev) => {
  //       if (prev <= 1) {
  //         clearInterval(countdownId);
  //         // fetchSaleData();
  //         return 0;
  //       }
  //       return prev - 1;
  //     });
  //   }, 1000);

  //   return () => clearInterval(countdownId);
  // }, [rawSeconds]);

  const handleAddToCart = async (eachProduct) => {
    let saleInfo = null;
    if (saleStatus === "live" && currentSaleId) {
      saleInfo = {
        saleId: currentSaleId,
        salePrice: eachProduct?.product_offerprice,
      };
    }

    // const res = await addToCart(eachProduct, saleInfo);

    // if (res.status) {
    //   toast.success(res.response);
    // } else {
    //   toast.error(res.response);
    // }
    try {
      const res = await addToCart(eachProduct, saleInfo);

      if (res.status) {
        toast.success(res.response || "Item added to cart");
      } else {
        const errorMsg =
          res?.response || res?.message || "Something went wrong";
        toast.error(errorMsg);

        if (res.code === 401 || errorMsg.toLowerCase().includes("log in")) {
          // openLoginModal();
        }
      }
    } catch (error) {
      console.error("Add to cart error:", error);
      toast.error("Something went wrong. Please try again.");
    }
  };

  useEffect(() => {
    fetchSaleData();
    if (rawSeconds !== null) {
      setCountdown(getCountdownParts(rawSeconds));
    }
  }, [rawSeconds]);

  useEffect(() => {
    getAllWishListedProducts();
  }, []);

  return (
    <>
      {loading && <Loader />}
      {saleStatus !== "none" && (
        <section className="ovr-unset unset-lrge obs-stp onSalesSection">
          <div className="container">
            <div className="row my-4">
              <div className="col-md-12">
                <div className="d-flex justify-content-between align">
                  <div className="OnSale">On Sale Products </div>
                  <div>
                    {saleStatus === "live" && (
                      <div className="countdown-container one">
                        <span className="countdown-text">
                          🔥 Super Sale is LIVE! and Ends in :
                        </span>
                        {rawSeconds !== null && (
                          <div className="countdown-timer">
                            <span className="time-box font-inter">
                              {countdown?.days}
                            </span>
                            <span className="separator">:</span>
                            <span className="time-box font-inter">
                              {countdown?.hours}
                            </span>
                            <span className="separator">:</span>
                            <span className="time-box font-inter">
                              {countdown?.minutes}
                            </span>
                            <span className="separator">:</span>
                            <span className="time-box font-inter">
                              {countdown?.seconds}
                            </span>
                          </div>
                        )}
                      </div>
                    )}
                  </div>

                  <div className="d-flex align-items-center">
                    <Link
                      to="/ecommercefilter?productTag=super_sale"
                      classname="d-flex"
                    >
                      {" "}
                      <div className="v-text">
                        View All
                        <span>
                          <TiArrowRight />
                        </span>
                      </div>
                    </Link>
                  </div>
                </div>
              </div>
            </div>

            <div className="row obs-stp">
              <div className="col-md-2 col-sm-2">
                <div className="bgyellow-card">
                  <div className="super-sale">
                    <img
                      src="assets/images/Group 1618873655.png"
                      alt=""
                      className="mt-3"
                    />
                  </div>
                  <div className="d-flex justify-content-center pt-3">
                    <button className="offer-btn">up to 50% off</button>
                  </div>
                </div>
              </div>

              <div className="col-md-10 col-sm-10 m-auto p-rel">
                {saleStatus === "scheduled" && (
                  <div className="countdown-container two">
                    <span className="countdown-text">
                      🚀 Super Sale Coming Soon and Starts with in :
                    </span>
                    {rawSeconds !== null && (
                      <div className="countdown-timer">
                        <span className="time-box font-inter">
                          {countdown?.days}
                        </span>
                        <span className="separator">:</span>
                        <span className="time-box font-inter">
                          {countdown?.hours}
                        </span>
                        <span className="separator">:</span>
                        <span className="time-box font-inter">
                          {countdown?.minutes}
                        </span>
                        <span className="separator">:</span>
                        <span className="time-box font-inter">
                          {countdown?.seconds}
                        </span>
                      </div>
                    )}
                  </div>
                )}
                {saleStatus === "live" && (
                  <div
                    id="carouselExampleControls"
                    className="carousel slide"
                    data-bs-ride="carousel"
                    ref={carouselRef}
                  >
                    <div className="carousel-inner">
                      <div className="carousel-item active">
                        <div className="row pro-carousel pro-lrge">
                          <Carousel
                            responsive={responsivee}
                            autoPlay={false}
                            autoPlaySpeed={1000}
                            infinite={true}
                            swipeable={true}
                            arrows={true}
                            className="onSaleProductsCarousel"
                          >
                            {/* {superSaleProducts.length > 0 ? (
                              superSaleProducts.map((product, index) => (
                                const isWishlisted = wishlisted.includes(product.product_id);
                            return ( */}
                            {superSaleProducts.length > 0 ? (
                              superSaleProducts.map((product, index) => {
                                const isWishlisted = wishlisted.includes(
                                  product.product_id
                                );
                                return (
                                  <div className="col-md-2" key={index}>
                                    <div className="box-product-sale box-miniLrge">
                                      <div className="d-flex justify-content-end">
                                        {/* <GoHeart className="wishlist-icn2" /> */}

                                        <button
                                          // className="wishlist-btn"
                                          className="d-flex justify-content-end heart-sty heart-mdle wishListButton"
                                          onClick={() =>
                                            handleAddToWishlist(product)
                                          }
                                          type="button"
                                          aria-label={
                                            isWishlisted
                                              ? "Remove from wishlist"
                                              : "Add to wishlist"
                                          }
                                        >
                                          {isWishlisted ? (
                                            <GoHeartFill
                                              className="wishlist-icn"
                                              style={{ color: "red" }}
                                            />
                                          ) : (
                                            <GoHeart className="wishlist-icn" />
                                          )}
                                        </button>
                                      </div>
                                      <Link
                                        to={`/productpage?productId=${product?.product_id}`}
                                      >
                                        <div className="j-centerr-mob  j-centerTab w-100 text-center">
                                          <img
                                            src={`${envImgUrl}/Uploads/products/${product?.image_1}`}
                                            alt=""
                                            className=" zoom-image  tab-chr"
                                          />
                                        </div>
                                      </Link>
                                      <div className=" nameStars">
                                        <div className=" pro-text2">
                                          <Link
                                            to={`/productpage?productId=${product?.product_id}`}
                                          >
                                            {product?.product_title}
                                          </Link>
                                        </div>

                                        <div className="ratingStarsOuter">
                                          <ReactStars
                                            count={5}
                                            // size={13}
                                            activeColor="#FBBC04"
                                            value={product?.average_rating}
                                            edit={false}
                                          />
                                        </div>
                                      </div>
                                      <div className="nameStars">
                                        <div className="superCart">
                                          {/* <button
                                          className="stopToApply"
                                          title="Add to cart"
                                          type="button"
                                          onClick={() =>
                                            handleAddToCart(product)
                                          }
                                        >
                                          <img
                                            src="assets/icons/add-to-cart.png"
                                            alt=""
                                          />
                                        </button> */}
                                          <button
                                            className="cart-btn cart-rp"
                                            type="button"
                                            title="Add to caty"
                                            onClick={() =>
                                              handleAddToCart(product)
                                            }
                                          >
                                            <HiOutlineShoppingCart />
                                          </button>
                                        </div>
                                        <div className="price-column">
                                          <div className="fnt-wt pri-dol2 text-center">
                                            <span className="stricked-price">
                                              ₹{product?.product_mrp}
                                            </span>
                                            ₹{product?.product_offerprice}
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                );
                              })
                            ) : (
                              <div className="container">
                                <div className="row">
                                  <div className="result-container conditionImg">
                                    <img
                                      src="assets/images/noDataFound.png"
                                      alt=""
                                    />
                                  </div>
                                </div>
                              </div>
                            )}
                          </Carousel>
                        </div>
                      </div>
                    </div>
                  </div>
                )}
              </div>
            </div>
          </div>
        </section>
      )}
      <Sonner />
    </>
  );
};

export default SuperSale;
