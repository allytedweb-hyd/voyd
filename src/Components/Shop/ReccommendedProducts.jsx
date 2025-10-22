import { TiArrowRight } from "react-icons/ti";
import { GoHeart } from "react-icons/go";
import { Link } from "react-router-dom";
import { useEffect, useState } from "react";
import { environmentUrl } from "../../env/enviroment";
import ReactStars from "react-rating-stars-component";
import { envImgUrl } from "../../env/envImage";
import Loader from "../Spinner/Loader";
import { HiOutlineShoppingCart } from "react-icons/hi2";
import { toast } from "sonner";
import Sonner from "../Toaster/Sonner";
import {
  addToCart,
  addToWishlist,
  getWishlistItems,
} from "../../libs/endpoints";
import { GoHeartFill } from "react-icons/go";

const ReccommendedProducts = () => {
  const [loading, setLoading] = useState(false);
  const [recommended, setRecommended] = useState([]);
  const [wishlisted, setWishlisted] = useState([]);

  const getRecommendedProducts = async () => {
    try {
      setLoading(true);
      const apiUrl = `${environmentUrl}/products/getRecommendedProducts.php?limit=5&offset=0`;
      const options = {
        method: "GET",
      };
      const response = await (await fetch(apiUrl, options)).json();
      if (response?.status) {
        console.log("most searched products data is====", response);
        setRecommended(response?.response);
      }
    } catch (error) {
      console.log(error);
    } finally {
      setLoading(false);
    }
  };

  // const handleAddToCart = async (eachProduct) => {
  //   try {
  //     setLoading(true);
  //     let response = await addToCart(eachProduct);
  //     if (response?.status) {
  //       toast.success(response?.response);
  //     } else {
  //       toast.error(response?.response);
  //     }
  //   } catch (error) {
  //     console.log(error);
  //   } finally {
  //     setLoading(false);
  //   }
  // };
  const handleAddToCart = async (eachProduct) => {
    try {
      setLoading(true);
      let response = await addToCart(eachProduct);
      if (response?.status) {
        toast.success(response?.response || "Item added to cart");
      } else {
        const errorMsg =
          response?.response || response?.message || "Something went wrong";
        toast.error(errorMsg);
      }
    } catch (error) {
      console.log(error);
      toast.error("An error occurred. Please try again.");
    } finally {
      setLoading(false);
    }
  };

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

  // // Add to Wishlist function
  // const handleAddToWishlist = async (eachProduct) => {
  //   try {
  //     let response = await addToWishlist(eachProduct);
  //     if (response?.status == true) {
  //       toast.success(response?.response);
  //       getAllWishListedProducts();
  //     } else {
  //       toast.error(response?.response);
  //     }
  //   } catch (error) {
  //     console.log(error);
  //   }
  // };

  // const handleAddToWishlist = async (eachProduct) => {
  //   const productId = eachProduct.product_id;

  //   setWishlisted((prev) => {
  //     const alreadyWishlisted = prev.includes(productId);
  //     if (alreadyWishlisted) {
  //       return prev.filter((id) => id !== productId);
  //     } else {
  //       return [...prev, productId];
  //     }
  //   });

  //   try {
  //     let response = await addToWishlist(eachProduct);

  //     if (response?.status === true) {
  //       toast.success(response?.response || "Added to wishlist");
  //     } else {
  //       toast.error(response?.message || "Something went wrong");

  //       setWishlisted((prev) => {
  //         const alreadyWishlisted = prev.includes(productId);
  //         if (alreadyWishlisted) {
  //           return [...prev, productId];
  //         } else {
  //           return prev.filter((id) => id !== productId);
  //         }
  //       });
  //     }
  //   } catch (error) {
  //     console.log(error);
  //     toast.error("An error occurred. Please try again.");

  //     setWishlisted((prev) => {
  //       const alreadyWishlisted = prev.includes(productId);
  //       if (alreadyWishlisted) {
  //         return [...prev, productId];
  //       } else {
  //         return prev.filter((id) => id !== productId);
  //       }
  //     });
  //   }
  // };

  const handleAddToWishlist = async (eachProduct) => {
    const token = localStorage.getItem("token");

    if (!token) {
      toast.error("Log in to add items to your wishlist");
      return;
    }

    const productId = eachProduct.product_id;

    // optimistic toggle
    setWishlisted((prev) => {
      const alreadyWishlisted = prev.includes(productId);
      if (alreadyWishlisted) {
        return prev.filter((id) => id !== productId);
      } else {
        return [...prev, productId];
      }
    });

    try {
      let response = await addToWishlist(eachProduct);
      if (response?.status === true) {
        toast.success(response.response || "Added to wishlist");
      } else {
        toast.error(response.message || "Something went wrong");
        // revert on failure
        setWishlisted((prev) => {
          const alreadyWishlisted = prev.includes(productId);
          if (alreadyWishlisted) {
            return [...prev, productId];
          } else {
            return prev.filter((id) => id !== productId);
          }
        });
      }
    } catch (error) {
      console.log(error);
      toast.error("An error occurred. Please try again.");
      // revert on failure
      setWishlisted((prev) => {
        const alreadyWishlisted = prev.includes(productId);
        if (alreadyWishlisted) {
          return [...prev, productId];
        } else {
          return prev.filter((id) => id !== productId);
        }
      });
    }
  };

  useEffect(() => {
    getRecommendedProducts();
    getAllWishListedProducts();
  }, []);
  return (
    <>
      {loading && <Loader />}
      <div className="d-flex justify-content-between border-bottom mt-reco">
        <div className="disc-txt underLine dis-phn ">
          <div>
            {" "}
            Recommended <span className="sp-txt">Products</span>{" "}
          </div>
          <img
            src="assets/images/shop/thumb.png"
            alt=""
            className="ml-bufly btr-fl  "
          />
        </div>
        <div className="d-flex align-items-center">
          <Link to="/ecommercefilter?productTag=Recommended" className="d-flex">
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

      <div className="row row-shppp disc-Main discover-M">
        {recommended.length > 0 ? (
          recommended.map((item, index) => {
            const isWishlisted = wishlisted.includes(item.product_id);

            return (
              <div
                className="disc-card-box shp-set discover-xt shp-settt shp-mobile icon-sty"
                key={index}
              >
                <div className="text-center box-product box-rsnve">
                  <button
                    className="d-flex justify-content-end heart-sty heart-mdle "
                    type="button"
                    onClick={() => handleAddToWishlist(item)}
                  >
                    {isWishlisted ? (
                      <GoHeartFill className="wishlist-icn heart-icon" />
                    ) : (
                      <GoHeart className="wishlist-icn" />
                    )}
                  </button>
                  <Link to={`/productpage?productId=${item.product_id}`}>
                    <div className="filProImg ">
                      <img
                        src={`${envImgUrl}/Uploads/products/${item?.image_1}`}
                        alt={item?.product_alttext}
                        className=""
                      />
                    </div>
                  </Link>
                  <div className="ele-types">
                    <div className="nameStars">
                      <div className="pro-text pro-ree pro-des pr-mbl ">
                        <Link to={`/productpage?productId=${item.product_id}`}>
                          {item?.product_title}
                        </Link>
                      </div>
                      <div className="str-coll str-mbl">
                        <ReactStars
                          count={5}
                          size={13}
                          activeColor="#FBBC04"
                          value={item?.average_rating}
                          edit={false}
                        />
                      </div>
                    </div>
                    <div className="nameStars">
                      <div className="btn-start">
                        <button
                          className="cart-btn cart-rp"
                          type="button"
                          onClick={() => handleAddToCart(item)}
                        >
                          <HiOutlineShoppingCart />
                        </button>
                      </div>
                      <div className="pri-doll pri-pnkl">
                        <span className="stricked-price">
                          ₹{item?.product_mrp}
                        </span>
                        ₹{item?.product_offerprice}
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
                <img src="assets/images/noDataFound.png" alt="" />
              </div>
            </div>
          </div>
        )}
      </div>
      <Sonner />
    </>
  );
};

export default ReccommendedProducts;
