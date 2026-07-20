import { useState, useEffect } from "react";
import { GoArrowUpRight } from "react-icons/go";
import { Link } from "react-router-dom";
import { environmentUrl } from "../../env/enviroment";
import { envImgUrl } from "../../env/envImage";
import ReactStars from "react-rating-stars-component";
import Sonner from "../Toaster/Sonner";
import Loader from "../Spinner/Loader";

const PopularProducts = () => {
  const [popularProducts, setPopularProducts] = useState([]);
  const [loading, setLoading] = useState(false);
  const [isScrolled, setIsScrolled] = useState(false);

  // Scroll handler for detecting when the user scrolls past a certain point
  const handleScroll = () => {
    if (window.scrollY < 5200) {
      setIsScrolled(true);
    } else {
      setIsScrolled(false);
    }
  };

  const ratingChanged = (newRating) => {
    console.log(newRating);
  };

  useEffect(() => {
    window.addEventListener("scroll", handleScroll);
    return () => {
      window.removeEventListener("scroll", handleScroll);
    };
  }, []);

  // Fetch data
  const [productsLimit, setProductsLimit] = useState(3);
  const [productsOffset, setProductsOffset] = useState(0);
  const proType = "Popular";

  const getPopularProducts = async () => {
    const url = `${environmentUrl}/products/getPopularProducts.php?proType=${proType}&&limit=${productsLimit}&&offset=${productsOffset}`;
    const options = {
      method: "GET",
    };

    try {
      setLoading(true);
      const response = await fetch(url, options);
      const fetchedData = await response.json();
      if (fetchedData?.response) {
        setPopularProducts(fetchedData.response);
      } else {
        console.log("No products found");
        setPopularProducts([]);
      }
    } catch (error) {
      console.error("Error fetching popular products:", error);
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    async function product() {
      await getPopularProducts();
      setLoading(false);
    }
    product();
  }, []);

  // Add to Cart function
  // const handleAddToCart = async (eachProduct) => {
  //   console.log("Product details for cart:", eachProduct);
  //   let response = await addToCart(eachProduct);
  //   if (response?.status) {
  //     toast.success("Successfully Added To Cart");
  //   } else {
  //     toast.error("Failed To Add");
  //   }
  // };

  // // Add to Wishlist function
  // const handleAddToWishlist = async (eachProduct) => {
  //   console.log("Product details for wishlist:", eachProduct);
  //   let response = await addToWishlist(eachProduct);
  //   if (response?.status) {
  //     toast.success("Successfully Added To Wishlist");
  //   } else {
  //     toast.error("Failed To Add");
  //   }
  // };

  return (
    <>
      {loading && <Loader />}
      <div className="pos-rel bg-blosm res-none">
        <img
          src="assets/images/cherry-blossom-2.png"
          alt=""
          className="blossm-flower"
        />
      </div>
      <div className="redbc-bg res-none">
        <img src="assets/images/Ellipse 17.png" alt="" className="redbcg" />
      </div>
      <section className="pdng-tb bg-black">
        <div className="container">
          <div className="row d-block positionIndex">
            <div className="d-flex justify-content-center">
              <div>
                <h2 className="creation-txtd text-light">Best Selling</h2>{" "}
              </div>
              <div className="pro-cen">
                <h2 className="handover-txtd text-light">Products</h2>
              </div>
            </div>
            <div className="text-center pb-4 pb-res">
              <p className="product-txt text-light ">
                Products are Crafted by professional certified teams
              </p>
            </div>
          </div>
          <div className="row besSellerRow">
            {popularProducts.length > 0 ? (
              popularProducts.map((eachProduct, index) => (
                <div
                  className="col-lg-3 col-md-4 col-sm-6 res-center"
                  key={index}
                >
                  {/* <div className='like-icon'>
                    <Link
                      to="#"
                      data-title="Add to favorites"
                      data-title-added="Added to favorites list"
                    >
                      <GrFavorite
                        onClick={() => {
                          handleAddToWishlist(eachProduct);
                        }}
                      />
                    </Link>
                  </div> */}
                  <div>
                    <Link to={`/productpage?productId=${eachProduct.product_id}`}>
                      <img
                        src={`${envImgUrl}/Uploads/products/${eachProduct.image_1}`}
                        alt="Product Image"
                        className="img-radius imageheightadjust"
                      />
                    </Link>
                  </div>
                  <Link to={`/productpage?productId=${eachProduct.product_id}`}>
                    <div className="Product-info radius">
                      <div className="title">{eachProduct.product_title}</div>
                      <div className="d-flex justify-content-between">
                        <div className="cate-txt">{eachProduct.product_category}</div>
                        {/* <div>
                        <Link
                          to="#"
                          data-title="Add to favorites"
                          data-title-added="Added to favorites list"
                          className='cart-icon'
                        >
                          <CiShoppingCart
                            onClick={() => {
                              handleAddToWishlist(eachProduct);
                            }}
                          />
                        </Link>
                      </div> */}
                      </div>

                      <div className="star-col">

                        {/* <ReactStars
                          count={5}
                          onChange={ratingChanged}
                          size={13}
                          activeColor="#ffd700"
                          isHalf={true}
                        /> */}
                        <ReactStars
                          count={5}
                          value={parseFloat(eachProduct.average_rating) || 0}
                          size={13}
                          edit={false}
                          isHalf={true}
                          activeColor="#ffd700"
                        />
                      </div>
                      <div className="price-size">
                        INR {eachProduct.product_offerprice}
                      </div>
                    </div>
                  </Link>
                </div>
              ))
            ) : (
              <div className="container">
                <div className="row">
                  <div className="result-container conditionImg">
                    <img src="assets/images/noDataFound.png" alt="" />
                  </div>
                </div>
              </div>
            )}
            <div className="col-lg-3 col-md-4 col-sm-6 res-none">
              <div
                className={
                  isScrolled
                    ? "brdr-all marginRest mobileFullLightImage"
                    : "brdr-all marginRest fullLightImage"
                }
              >
                <div className="d-flex justify-content-center flashOut">
                  <div className="viewAllBulb">
                    <img
                      src={
                        isScrolled
                          ? "assets/images/light off.png"
                          : "assets/images/Group 1618873225.png"
                      }
                      alt="light status"
                      className={isScrolled ? "light-off" : "light-on"}
                    />
                  </div>
                  <div className="viewAllBulbTwo">
                    <img
                      src="assets/images/Group 1618873225.png"
                      alt=""
                      className="light-on"
                    />
                  </div>
                </div>
                <div
                  className={`row cursor-pointer justify-content-center ${isScrolled ? "light-on-margin" : "light-off-margin"
                    }`}
                >
                  <Link to="/shop">
                    <div className="d-flex justifyCenter">
                      <div className="d-flex align-items-center">
                        <div className="line bg-light"></div>
                      </div>
                      <div className="arrow-line p-4 text-light">
                        <Link to="/ecommercefilter?productTag=Popular" className="popularAll">VIEW ALL</Link>
                        <span className="span-arrow border-light">
                          <GoArrowUpRight />
                        </span>
                      </div>
                    </div>
                  </Link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <Sonner />
    </>
  );
};

export default PopularProducts;
