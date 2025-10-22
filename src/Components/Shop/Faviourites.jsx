import { Link } from "react-router-dom";
import { TiArrowRight } from "react-icons/ti";
import { GoHeart } from "react-icons/go";
import ReactStars from "react-rating-stars-component";
import { useEffect, useState } from "react";
import {
  addToCart,
  addToWishlist,
  getWishlistItems,
  shopCategoryProducts,
} from "../../libs/endpoints";
import Loader from "../Spinner/Loader";
import { envImgUrl } from "../../env/envImage";
import { toast } from "sonner";
import Sonner from "../Toaster/Sonner";
import { HiOutlineShoppingCart } from "react-icons/hi2";
import { GoHeartFill } from "react-icons/go";

const Faviourites = () => {
  const [loading, setLoading] = useState(false);
  const [favourites, setFavourites] = useState([]);
  const [wishlisted, setWishlisted] = useState([]);

  const getFavouriteProducts = async () => {
    try {
      setLoading(true);
      const response = await shopCategoryProducts("favorite", 5, 0);
      if (response?.status) {
        setFavourites(response?.response);
      }
    } catch (error) {
      console.log(error);
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

  // const handleAddToWishlist = async (eachProduct) => {
  //   const productId = eachProduct.product_id;

  //   setWishlisted((prev) => {
  //     return prev.includes(productId)
  //       ? prev.filter((id) => id !== productId)
  //       : [...prev, productId];
  //   });

  //   try {
  //     let response = await addToWishlist(eachProduct);

  //     if (response?.status === true) {
  //       toast.success(response?.response || "Added to wishlist");
  //     } else {
  //       toast.error(response?.response || "Failed to add to wishlist");

  //       setWishlisted((prev) => {
  //         return prev.includes(productId)
  //           ? [...prev, productId]
  //           : prev.filter((id) => id !== productId);
  //       });
  //     }
  //   } catch (error) {
  //     console.error(error);
  //     toast.error("Something went wrong");

  //     setWishlisted((prev) => {
  //       return prev.includes(productId)
  //         ? [...prev, productId]
  //         : prev.filter((id) => id !== productId);
  //     });
  //   }
  // };

  const handleAddToWishlist = async (eachProduct) => {
    const token = localStorage.getItem("token");
    const productId = eachProduct.product_id;

    if (!token) {
      toast.error("Log in to add items to your wishlist");
      return;
    }

    setWishlisted((prev) => {
      return prev.includes(productId)
        ? prev.filter((id) => id !== productId)
        : [...prev, productId];
    });

    try {
      let response = await addToWishlist(eachProduct);

      if (response?.status === true) {
        toast.success(response?.response || "Added to wishlist");
      } else {
        toast.error(response?.response || "Failed to add to wishlist");

        setWishlisted((prev) => {
          return prev.includes(productId)
            ? [...prev, productId]
            : prev.filter((id) => id !== productId);
        });
      }
    } catch (error) {
      console.error(error);
      toast.error("Something went wrong");

      setWishlisted((prev) => {
        return prev.includes(productId)
          ? [...prev, productId]
          : prev.filter((id) => id !== productId);
      });
    }
  };

  const handleAddToCart = async (eachProduct) => {
    try {
      setLoading(true);
      let response = await addToCart(eachProduct);
      if (response?.status === true) {
        toast.success(response?.response || "Added to cart successfully");
      } else {
        toast.error(
          response?.response || response?.message || "Failed to add to cart"
        );
      }
    } catch (error) {
      console.error(error);
      toast.error("Something went wrong adding to cart");
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    getFavouriteProducts();
    getAllWishListedProducts();
  }, []);
  return (
    <>
      {loading && <Loader />}
      <div className="d-flex justify-content-between border-bottom mt-reco">
        <div className="disc-txt underLine dis-phn">
          <div>
            {" "}
            Customer <span className="sp-txt"> Favorites</span>{" "}
          </div>
          <img
            src="assets/images/shop/pngwingred.png"
            alt=""
            className="ml-likes btr-fl btr-fl btt-fl"
          />
        </div>
        <div className="d-flex align-items-center">
          <Link to="/ecommercefilter?productTag=favorite" classname="d-flex">
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
        {favourites.length > 0 ? (
          favourites.map((item, index) => {
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
                      <GoHeartFill
                        className="wishlist-icn"
                        style={{ color: "red" }}
                      />
                    ) : (
                      <GoHeart className="wishlist-icn" />
                    )}
                  </button>
                  <Link to={`/productpage?productId=${item.product_id}`}>
                    <div className="filProImg ">
                      <img
                        src={`${envImgUrl}/Uploads/products/${item.image_1}`}
                        alt={item.product_alttext}
                        className=""
                      />
                    </div>
                  </Link>
                  <div className="ele-types">
                    <div className="nameStars">
                      <div className="pro-text pro-ree pro-des pr-mbl ">
                        <Link to={`/productpage?productId=${item.product_id}`}>
                          {item.product_title}
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
                        {" "}
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

export default Faviourites;
