import { Link } from "react-router-dom";
import { TiArrowRight } from "react-icons/ti";
import { GoHeart } from "react-icons/go";
import { useEffect, useState } from "react";
import { environmentUrl } from "../../env/enviroment";
import { envImgUrl } from "../../env/envImage";
import ReactStars from "react-rating-stars-component";
import Loader from "../Spinner/Loader";
import { toast } from "sonner";
import Sonner from "../Toaster/Sonner";
import {
  addToCart,
  addToWishlist,
  getWishlistItems,
} from "../../libs/endpoints";
import { HiOutlineShoppingCart } from "react-icons/hi2";
import { GoHeartFill } from "react-icons/go";

const MostSearched = () => {
  const [loading, setLoading] = useState(false);
  const [mostSearched, setMostSearched] = useState([]);
  const [wishlisted, setWishlisted] = useState([]);

  const getMostSearchedProducts = async () => {
    try {
      setLoading(true);
      const apiUrl = `${environmentUrl}/products/getMostSearchedProducts.php?limit=5&offset=0`;
      const options = {
        method: "GET",
      };
      const response = await (await fetch(apiUrl, options)).json();
      if (response?.status) {
        console.log("most searched products data is====", response);
        setMostSearched(response?.response);
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
  //       toast.success("Successfully Added To Wishlist");
  //       getAllWishListedProducts();
  //     } else if (response?.status == "warning") {
  //       toast.warning("Product Already Added To Wishlist");
  //     } else {
  //       toast.error("Failed To Add");
  //     }
  //   } catch (error) {
  //     console.log(error);
  //   }
  // };

  // const handleAddToWishlist = async (eachProduct) => {
  //   const productId = eachProduct.product_id;

  //   setWishlisted((prev) => {
  //     const alreadyWishlisted = prev.includes(productId);
  //     return alreadyWishlisted
  //       ? prev.filter((id) => id !== productId)
  //       : [...prev, productId];
  //   });

  //   try {
  //     let response = await addToWishlist(eachProduct);

  //     if (response?.status === true) {
  //       toast.success(response?.response || "Successfully added to wishlist");
  //     } else if (response?.status === "warning") {
  //       toast.warning(response?.response || "Product already in wishlist");
  //     } else {
  //       toast.error(response?.response || "Failed to add");

  //       setWishlisted((prev) => {
  //         const alreadyWishlisted = prev.includes(productId);
  //         return alreadyWishlisted
  //           ? [...prev, productId]
  //           : prev.filter((id) => id !== productId);
  //       });
  //     }
  //   } catch (error) {
  //     console.log(error);
  //     toast.error("An error occurred. Please try again.");

  //     setWishlisted((prev) => {
  //       const alreadyWishlisted = prev.includes(productId);
  //       return alreadyWishlisted
  //         ? [...prev, productId]
  //         : prev.filter((id) => id !== productId);
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

    setWishlisted((prev) => {
      const alreadyWishlisted = prev.includes(productId);
      return alreadyWishlisted
        ? prev.filter((id) => id !== productId)
        : [...prev, productId];
    });

    try {
      const response = await addToWishlist(eachProduct);

      if (response?.status === true) {
        toast.success(response?.response || "Successfully added to wishlist");
      } else if (response?.status === "warning") {
        toast.warning(response?.response || "Product already in wishlist");
      } else {
        toast.error(response?.response || "Failed to add");

        setWishlisted((prev) => {
          const alreadyWishlisted = prev.includes(productId);
          return alreadyWishlisted
            ? [...prev, productId]
            : prev.filter((id) => id !== productId);
        });
      }
    } catch (error) {
      console.log(error);
      toast.error("An error occurred. Please try again.");

      setWishlisted((prev) => {
        const alreadyWishlisted = prev.includes(productId);
        return alreadyWishlisted
          ? [...prev, productId]
          : prev.filter((id) => id !== productId);
      });
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

  // const handleAddToCart = async (eachProduct) => {
  //   try {
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
      let response = await addToCart(eachProduct);
      if (response?.status) {
        toast.success(response?.response || "Added to cart successfully");
      } else {
        toast.error(
          response?.response || response?.message || "Failed to add to cart"
        );
      }
    } catch (error) {
      console.log(error);
      toast.error("An error occurred. Please try again.");
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    getMostSearchedProducts();
    getAllWishListedProducts();
  }, []);
  return (
    <>
      {loading && <Loader />}
      <div className="d-flex justify-content-between border-bottom mt-reco">
        <div className="disc-txt underLine dis-phn">
          <div>
            {" "}
            Most searched <span className="sp-txt">Products</span>{" "}
          </div>
          <img
            src="assets/images/shop/pngwingh.png"
            alt=""
            className="ml-bufly btr-fl btr-fl "
          />
        </div>
        <div className="d-flex align-items-center">
          <Link
            to="/ecommercefilter?productTag=mostSearched"
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

      <div className="row row-shppp disc-Main discover-M">
        {mostSearched.length > 0 ? (
          mostSearched.map((item, index) => {
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

export default MostSearched;
