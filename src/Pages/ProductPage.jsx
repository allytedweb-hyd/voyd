import { useEffect, useState } from "react";

import { TiStar } from "react-icons/ti";
import { CiHeart } from "react-icons/ci";
import { IoCartOutline } from "react-icons/io5";
import { PiCopy } from "react-icons/pi";
import { FaFacebook } from "react-icons/fa";
import { IoLogoTwitter } from "react-icons/io";
import { FaPinterestP } from "react-icons/fa";
import { FaPlus } from "react-icons/fa6";
import { BiLike } from "react-icons/bi";
import { useRef } from "react";
import StarRatings from "react-star-ratings";

import { FaMinus } from "react-icons/fa6";
import ReactStars from "react-rating-stars-component";
import { useSearchParams } from "react-router-dom";
import Loader from "../Components/Spinner/Loader";
import { environmentUrl } from "../env/enviroment";
import {
  addToCart,
  formatCurrency,
  addToWishlist,
  getWishlistItems,
} from "../libs/endpoints";
import { envImgUrl } from "../env/envImage";
import { toast } from "sonner";
import Sonner from "../Components/Toaster/Sonner";
import { timeCalculator } from "../libs/endpoints";
import { timeCal } from "../libs/endpoints";
import { useMemo } from "react";
import RecentlyViewed from "../Components/SingleProduct/RecentlyViewed";

const ProductPage = () => {
  const [searchParams] = useSearchParams();
  const params = searchParams.get("productId");
  const [loading, setLoading] = useState([]);
  const [product, setProduct] = useState({});
  const [customerReview, setCustomerReview] = useState({
    productId: params,
  });
  const [customerReviewRating, setCustomerReviewRating] = useState([]);
  const [customerReviewError, setCustomerReviewError] = useState({});
  const [avgRating, setAvgRating] = useState([]);

  const zoomRef = useRef(null);

  const handleZoom = (e) => {
    const rect = zoomRef.current.getBoundingClientRect();
    const x = ((e.clientX - rect.left) / rect.width) * 100;
    const y = ((e.clientY - rect.top) / rect.height) * 100;

    const img = zoomRef.current.querySelector("img");
    img.style.transformOrigin = `${x}% ${y}%`;
    img.style.transform = "scale(2)";
  };

  const resetZoom = () => {
    const img = zoomRef.current.querySelector("img");
    img.style.transform = "scale(1)";
  };

  const [imagesByColor, setImagesByColor] = useState({});
  const [selectedColor, setSelectedColor] = useState(null);
  const [displayImages, setDisplayImages] = useState([]);
  const [colorMap, setColorMap] = useState({});

  const [selectedSize, setSelectedSize] = useState("");
  const [selectedMaterial, setSelectedMaterial] = useState("");
  const [selectedQuantity, setSelectedQuantity] = useState(1);

  const [selectedImage, setSelectedImage] = useState(null);

  const [sizesList, setSizesList] = useState([]);
  const [materialsList, setMaterialsList] = useState([]);
  const [maxQuantity, setMaxQuantity] = useState(1);

  const [likes, setLikes] = useState({});
  const [replies, setReplies] = useState({});
  const [replyInputs, setReplyInputs] = useState({});

  const [likesCount, setLikesCount] = useState({});
  const [likeLoading, setLikeLoading] = useState({});

  const [showAllReviews, setShowAllReviews] = useState(false);
  const [showReplies, setShowReplies] = useState({});
  // const [wishlisted, setWishlisted] = useState([]);

  const handleLike = async (reviewId) => {
    if (likeLoading[reviewId]) return;

    setLikeLoading((prev) => ({ ...prev, [reviewId]: true }));

    try {
      const response = await fetch(`${environmentUrl}/reviews/like.php`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Authorization: "Bearer " + localStorage.getItem("token"),
        },
        body: JSON.stringify({ review_id: reviewId }),
      });

      const result = await response.json();

      if (result.status) {
        // setLikes((prev) => ({
        //   ...prev,
        //   [reviewId]: !prev[reviewId],

        // }));
        setLikes((prev) => {
          const updatedLikes = { ...prev, [reviewId]: !prev[reviewId] };
          console.log("Updated likes:", updatedLikes);
          return updatedLikes;
        });

        if (typeof result.totalLikes === "number") {
          setLikesCount((prev) => ({
            ...prev,
            [reviewId]: result.totalLikes,
          }));
        }

        toast.success(result.message);
      } else {
        toast.error(result.message || "Error");
      }
    } catch (error) {
      toast.error("Something went wrong");
    } finally {
      setLikeLoading((prev) => ({ ...prev, [reviewId]: false }));
    }
  };

  const toggleReplyBox = (reviewId) => {
    setReplies((prev) => ({
      ...prev,
      [reviewId]: !prev[reviewId],
    }));
  };

  const handleReplyInputChange = (reviewId, text) => {
    setReplyInputs((prev) => ({
      ...prev,
      [reviewId]: text,
    }));
  };

  const submitReply = async (event, reviewId) => {
    event.preventDefault();

    const replyContent = replyInputs[reviewId]?.trim();
    if (!replyContent) {
      toast.warning("Reply cannot be empty");
      return;
    }

    try {
      const apiUrl = `${environmentUrl}/reviews/reply.php`;
      const response = await fetch(apiUrl, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Authorization: "Bearer " + localStorage.getItem("token"),
        },
        body: JSON.stringify({
          reviewId: reviewId,
          replyContent: replyContent,
        }),
      });

      if (response.status === 401) {
        toast.error("You must be logged in to submit a reply");
        return;
      }

      const result = await response.json();

      if (result.status) {
        toast.success("Reply submitted!");
        setReplyInputs((prev) => ({ ...prev, [reviewId]: "" }));
        setReplies((prev) => ({ ...prev, [reviewId]: false }));
        getCustomerReviews();
      } else {
        toast.error(result.message || "Failed to submit reply");
      }
    } catch (error) {
      console.error("Reply error:", error);
      toast.error("Something went wrong. Try again later.");
    }
  };

  const getProduct = async () => {
    try {
      const apiUrl = `${environmentUrl}/products/getSingleProduct.php?productId=${params}`;
      const options = {
        method: "GET",
      };
      const response = await (await fetch(apiUrl, options)).json();
      console.log("product response", response);
      if (response?.status) {
        setProduct(response?.response);
        setImagesByColor(response.response.images_by_color || {});
        setImagesByColor(response.response.images_by_color || {});
        setColorMap(response.response.colorMap || {});

        console.log("Color Map:", response.response.colorMap);
        console.log("Images By Color:", response.response.images_by_color);
        console.log(
          "images_by_color from API:",
          response.response.images_by_color
        );

        const colorShades = Object.keys(
          response.response.images_by_color || {}
        );
        if (colorShades.length > 0) {
          const firstColor = colorShades[0];
          setSelectedColor(firstColor);

          const firstColorObj =
            response.response.images_by_color[firstColor] || {};
          const images = Array.isArray(firstColorObj.images)
            ? firstColorObj.images
            : [];

          // setDisplayImages(images);
          setDisplayImages(images);
          if (images.length > 0) {
            setSelectedImage(images[0]);
          }

          const sizes = firstColorObj.size
            ? firstColorObj.size.split(",").map((s) => s.trim())
            : [];

          const materials = firstColorObj.material
            ? firstColorObj.material.split(",").map((m) => m.trim())
            : [];

          setSizesList(sizes);
          setMaterialsList(materials);

          setSelectedSize(sizes[0] || "");
          setSelectedMaterial(materials[0] || "");
          const initialQty = Number.isInteger(parseInt(firstColorObj.quantity))
            ? parseInt(firstColorObj.quantity)
            : 0;

          setSelectedQuantity(initialQty > 0 ? 1 : 0);
          setMaxQuantity(initialQty);
        }
      }
    } catch (error) {
      console.log(error);
    } finally {
      setLoading(false);
    }
  };

  const handleColorClick = (colorShade) => {
    console.log("Color clicked:", colorShade);

    const colorObj = imagesByColor[colorShade] || {};
    console.log("Color object data:", colorObj);

    const images = Array.isArray(colorObj.images) ? colorObj.images : [];
    console.log("Images for selected color:", images);

    const sizes = colorObj.size
      ? colorObj.size.split(",").map((s) => s.trim())
      : [];
    const materials = colorObj.material
      ? colorObj.material.split(",").map((m) => m.trim())
      : [];
    // const quantity = parseInt(colorObj.quantity) || 1;
    const quantity = Number.isInteger(parseInt(colorObj.quantity))
      ? parseInt(colorObj.quantity)
      : 0;
    setSelectedQuantity(1);
    setMaxQuantity(quantity);

    console.log("Sizes:", sizes);
    console.log("Materials:", materials);
    console.log("Quantity:", quantity);

    setSelectedColor(colorShade);
    // setDisplayImages(images);
    setDisplayImages(images);
    if (images.length > 0) {
      setSelectedImage(images[0]);
    }

    setSizesList(sizes);
    setMaterialsList(materials);
    setSelectedSize(sizes[0] || "");
    setSelectedMaterial(materials[0] || "");
    // setSelectedQuantity(quantity);
  };

  const incrementQuantity = () => {
    setSelectedQuantity((prev) => {
      console.log("Current quantity:", prev, "Max quantity:", maxQuantity);
      if (prev < maxQuantity) {
        return prev + 1;
      } else {
        console.log("Quantity limit reached. Showing toast...");
        toast.warning(`Only ${maxQuantity} item(s) available in stock.`);
        return prev;
      }
    });
  };

  const decrementQuantity = () => {
    setSelectedQuantity((prev) => (prev > 1 ? prev - 1 : 1));
  };

  const features = useMemo(() => {
    if (!product?.product_features) return [];
    try {
      return JSON.parse(product.product_features);
    } catch {
      return [];
    }
  }, [product?.product_features]);

  const productUrl = window.location.href;

  const copyToClipboard = () => {
    navigator.clipboard.writeText(productUrl).then(() => {
      toast.success("Product URL copied to clipboard!");
    });
  };

  const shareOnFacebook = () => {
    const facebookShareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(
      productUrl
    )}`;
    window.open(facebookShareUrl, "_blank", "width=600,height=400");
  };

  const shareOnTwitter = () => {
    const text = encodeURIComponent(
      product?.product_title || "Check this product"
    );
    const twitterShareUrl = `https://twitter.com/intent/tweet?url=${encodeURIComponent(
      productUrl
    )}&text=${text}`;
    window.open(twitterShareUrl, "_blank", "width=600,height=400");
  };

  const shareOnPinterest = () => {
    const pinterestShareUrl = `https://pinterest.com/pin/create/button/?url=${encodeURIComponent(
      productUrl
    )}&description=${encodeURIComponent(product?.product_title || "")}`;
    window.open(pinterestShareUrl, "_blank", "width=600,height=400");
  };

  // const handleAddToCart = async (product) => {
  //   const cartData = {
  //     ...product,
  //     selectedColor,
  //     selectedSize,
  //     selectedMaterial,
  //     quantity: selectedQuantity,
  //   };
  //   try {
  //     const response = await addToCart(cartData);
  //     if (response?.status) {
  //       toast.success("Successfully Added To Cart");
  //     }
  //   } catch (error) {
  //     console.log(error);
  //     toast.error(error?.response?.data?.message);
  //   }
  // };

  const handleAddToCart = async (product) => {
    const cartData = {
      ...product,
      selectedColor,
      selectedSize,
      selectedMaterial,
      quantity: selectedQuantity,
    };
    try {
      const response = await addToCart(cartData);
      if (response?.status) {
        toast.success("Successfully Added To Cart");
      } else {
        if (response.message === "Log in to add items to your cart") {
          toast.error("Log in to add items to your cart");
        } else {
          toast.error(response?.message || "Already added to cart");
        }
      }
    } catch (error) {
      console.log(error);
      toast.error(error?.response?.data?.message || "Something went wrong");
    }
  };

  const getAllWishListedProducts = async () => {
    try {
      setLoading(true);
      const response = await getWishlistItems();
      return response;
    } catch (error) {
      console.log(error);
    } finally {
      setLoading(false);
    }
  };

  const [wishlisted, setWishlisted] = useState([]);
  const productId = String(product.product_id || product.id || "");

  useEffect(() => {
    async function fetchWishlist() {
      try {
        const response = await getAllWishListedProducts();
        if (response?.status && Array.isArray(response.response)) {
          const productIds = response.response.map((item) =>
            String(item.product_id)
          );
          console.log("Fetched wishlist IDs:", productIds);
          setWishlisted(productIds);
        } else {
          setWishlisted([]);
        }
      } catch (error) {
        console.error("Failed to load wishlist", error);
        setWishlisted([]);
      }
    }
    fetchWishlist();
  }, []);

  // Check if current product is wishlisted
  // Make sure types match (string/number)

  // const handleAddToWishlist = async (product) => {
  //   try {
  //     const response = await addToWishlist(product);
  //     console.log("wishlist response", response);
  //     if (response?.status) {
  //       toast.success(response?.message);
  //       setWishlisted(prev => [...prev, product.product_id]);
  //     } else {
  //       toast.error(response?.message);
  //     }
  //   } catch (error) {
  //     console.log(error);
  //     toast.error(error?.response?.data?.message);
  //   }
  // };
  const isWishlisted = wishlisted.includes(productId);
  const handleAddToWishlist = async () => {
    if (!productId) {
      toast.error("Invalid product");
      return;
    }

    try {
      const response = await addToWishlist(product);
      if (response?.status) {
        if (isWishlisted) {
          toast.success("Removed from wishlist");
          setWishlisted((prev) => prev.filter((id) => id !== productId));
        } else {
          toast.success("Added to wishlist");
          setWishlisted((prev) => [...prev, productId]);
        }
      } else {
        toast.error(response?.message || "Failed to update wishlist");
      }
    } catch (error) {
      toast.error("Something went wrong");
    }
  };

  const ratingChanged = (newRating) => {
    setCustomerReview({ ...customerReview, customerRating: newRating });
  };
  const handleCustomerReview = (event) => {
    setCustomerReview({
      ...customerReview,
      [event.target.name]: event.target.value,
    });
  };

  const validateForm = () => {
    const error = {};
    if (!customerReview.customerRating) {
      error.customerRating = "Rating is required";
    }
    if (!customerReview.customerReviewTitle) {
      error.customerReviewTitle = "Title is required";
    }
    if (!customerReview.customerReviewContent) {
      error.customerReviewContent = "Review is required";
    }
    return error;
  };

  const formRef = useRef(null);

  const submitReview = async (event) => {
    event.preventDefault();
    const errors = validateForm();
    const isValid = Object.keys(errors).length === 0;
    setCustomerReviewError(errors);
    if (!isValid) {
      toast.warning("Please fill all Mandatory Fields");
      return;
    }
    try {
      setLoading(true);
      const apiUrl = `${environmentUrl}/reviews/post.php`;
      const options = {
        method: "POST",
        body: JSON.stringify(customerReview),
        headers: { Authorization: "Bearer " + localStorage.getItem("token") },
      };
      const response = await (await fetch(apiUrl, options)).json();
      // if (response?.status) {

      //   toast.success(response?.message || "Review submitted successfully");
      //   formRef.current?.reset();
      //   customerReview.reset();
      //   setCustomerReview({});
      //   getCustomerReviews();
      // }
      if (response?.status) {
        toast.success(response?.message || "Review submitted successfully");
        formRef.current?.reset();
        setCustomerReview({ productId: params });

        setTimeout(() => {
          getCustomerReviews();
          getAvgRating();
        }, 500);
      } else {
        toast.error(response?.message);
      }
    } catch (error) {
      console.log(error);
      toast.error(error?.response?.data?.message);
    } finally {
      setLoading(false);
    }
  };

  const getCustomerReviews = async () => {
    try {
      setLoading(true);
      const apiUrl = `${environmentUrl}/reviews/get.php?productId=${params}`;
      const options = {
        method: "GET",
      };
      const response = await (await fetch(apiUrl, options)).json();
      // if (response?.status) {
      //   setCustomerReviewRating(response?.response);
      // }
      if (response?.status && Array.isArray(response.response)) {
        setCustomerReviewRating(response.response);
      } else {
        toast.error(response?.message || "No reviews found");
      }
    } catch (error) {
      console.log("get customer review error", error);
      toast.error(error?.response?.data?.message);
    } finally {
      setLoading(false);
    }
  };

  const getAvgRating = async () => {
    try {
      setLoading(true);
      const apiUrl = `${environmentUrl}/reviews/averageRating.php?productId=${params}`;
      const options = {
        method: "GET",
      };
      const response = await (await fetch(apiUrl, options)).json();
      if (response?.status) {
        setAvgRating(response?.data);
      }
    } catch (error) {
      console.log(error);
      toast.error(error?.response?.data?.message);
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    if (!customerReviewRating) return;

    const initialLikes = {};
    const initialLikesCount = {};

    customerReviewRating.forEach((review) => {
      const id = String(review.cus_review_id);

      initialLikes[id] = review.likedByUser === 1;
      initialLikesCount[id] = review.likes || 0;
    });

    setLikes(initialLikes);
    setLikesCount(initialLikesCount);
  }, [customerReviewRating]);

  useEffect(() => {
    getProduct();
    getAvgRating();
    getCustomerReviews();
  }, []);

  const ratingValue = Number(product?.average_rating) || 0;

  return (
    <>
      {loading && <Loader />}
      <section className="singleProSect">
        <div className="container mini-deskrp lg-tab">
          <div className="row single-pro">
            <div className="col-md-6">
              {/* <div className="border-grey ">
                <img
                  src={`${envImgUrl}/Uploads/products/${product?.product_image}`}
                  alt=""
                  className="w-100 "
                />
              </div>
              <div className=" image-mainImage">
                <div className="image-hoverImage">
                  <img
                    src={`${envImgUrl}/Uploads/products/${product?.product_image}`}
                    alt=""
                    className="br-15"
                  />
                </div>
                <div className="image-hoverImage">
                  <img
                    src={`${envImgUrl}/Uploads/products/${product?.image_1}`}
                    alt=""
                    className="br-15 "
                  />
                </div>
                <div className="image-hoverImage">
                  <img
                    src={`${envImgUrl}/Uploads/products/${product?.image_2}`}
                    alt=""
                    className="br-15 "
                  />
                </div>
                <div className="image-hoverImage">
                  <img
                    src={`${envImgUrl}/Uploads/products/${product?.image_3}`}
                    alt=""
                    className="br-15 "
                  />
                </div>
                <div className="image-hoverImage">
                  <img
                    src={`${envImgUrl}/Uploads/products/${product?.image5}`}
                    alt=""
                    className="br-15 "
                  />
                </div>
              </div> */}

              <div className="border-grey singleProImg ">
                {/* {displayImages[0] && (
                  <img
                    src={`${envImgUrl}/Uploads/products/${displayImages[0].image}`}
                    alt={displayImages[0].alt || ""}
                  />
                )} */}
                {/* {selectedImage && (
                  <img
                    src={`${envImgUrl}/Uploads/products/${selectedImage.image}`}
                    alt={selectedImage.alt || ""}
                  />
                )} */}
                <div
                  className="zoom-container"
                  onMouseMove={(e) => handleZoom(e)}
                  onMouseLeave={() => resetZoom()}
                  ref={zoomRef}
                >
                  <img
                    src={`${envImgUrl}/Uploads/products/${selectedImage?.image}`}
                    alt=""
                    className="zoom-image"
                  />
                </div>
              </div>

              <div className="image-mainImage">
                {/* {displayImages.map((imgObj, idx) => (
                  <div key={idx} className="image-hoverImage">
                    <img
                      src={`${envImgUrl}/Uploads/products/${imgObj.image}`}
                      alt={imgObj.alt || ""}
                    />
                  </div>
                ))} */}

                {displayImages.map((imgObj, idx) => (
                  <div
                    key={idx}
                    className="image-hoverImage"
                    onClick={() => setSelectedImage(imgObj)}
                    style={{
                      cursor: "pointer",
                      border:
                        selectedImage === imgObj ? "2px solid black" : "none",
                    }}
                  >
                    <img
                      src={`${envImgUrl}/Uploads/products/${imgObj.image}`}
                      alt={imgObj.alt || ""}
                    />
                  </div>
                ))}
              </div>
            </div>
            <div className="col-md-1"></div>
            <div className="col-md-5">
              <div className="product-container">
                <div className="rating-s">
                  {" "}
                  <div className="str-coll fStars str-mbl">
                    {/* <ReactStars
                      count={5}
                      activeColor="#FBBC04"
                      value={3.5}
                      edit={false}
                    /> */}

                    <StarRatings
                      rating={ratingValue}
                      starRatedColor="#FBBC04"
                      numberOfStars={5}
                      name="rating"
                      starDimension="13px"
                      starSpacing="2px"
                    />

                    <span className="text-dark pb-sans top-rtng">
                      {" "}
                      {product?.average_rating} / 5.0{" "}
                    </span>
                  </div>
                  {/* <span className="col-grey usag-num">(556)</span> */}
                </div>
                <h1 className="long-chr">{product?.product_title}</h1>
                <div className="row">
                  <div className="col-md-10 widthP">
                    <div className="row pb-sans row-wdth">
                      <div className="col-md-6 col-sm-6">
                        <div className=" sku-txt">
                          Sku:{" "}
                          <span className="text-dark fw-bold">
                            {product?.sku}
                          </span>
                        </div>
                        <div className="brand-txt">
                          Brand :<span>{product?.brand_title}</span>
                        </div>
                      </div>
                      <div className="col-md-6 col-sm-6">
                        <div className="sku-txt mb-1">
                          {" "}
                          Availability:{" "}
                          <span className="in-stock-txt">
                            {product?.availability == "in_stock"
                              ? "In Stock"
                              : "Out of Stock"}
                          </span>
                        </div>
                        <div className="sku-txt">
                          {" "}
                          Category:{" "}
                          <span className="in-stock">
                            {product?.category_name}
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div className="col-md-4"></div>
                </div>
                <div className="price my-3">
                  <span className="dol-pri pb-sans">
                    ₹{formatCurrency(product?.product_offerprice)}
                  </span>
                  <span className="old-pricing">
                    ₹{formatCurrency(product?.product_mrp)}
                  </span>{" "}
                  <span className="discount-btn pb-sans">
                    {Math.round(
                      ((product?.product_mrp - product?.product_offerprice) /
                        product?.product_mrp) *
                        100
                    )}
                    % OFF
                  </span>
                </div>
                <div className="row pb-3 fnt-13 mat-hin">
                  <div className="col-md-6">
                    <div className="pb-sans pb-2">color</div>
                    {/* <div className="color-options d-flex gap-3 ">
                      <div
                        className="color-teal"
                        style={{ backgroundColor: product?.color_code }}
                      ></div>
                    </div> */}

                    <div className="color-options d-flex gap-3">
                      {Object.keys(imagesByColor).map((shade) => {
                        const code = colorMap[shade] || "#ccc";
                        console.log("Swatch shade:", shade, "Code:", code);
                        console.log(colorMap);
                        const isSel = shade === selectedColor;
                        return (
                          <div
                            className="colorBlock"
                            key={shade}
                            onClick={() => handleColorClick(shade)}
                            style={{
                              backgroundColor: code,
                              border: isSel
                                ? "2px solid black"
                                : "1px solid #ccc",

                              borderRadius: "50%",
                              cursor: "pointer",
                            }}
                            title={shade}
                          />
                        );
                      })}
                    </div>
                  </div>
                  <div className="col-md-6">
                    <div>
                      <label htmlFor="cars">size:</label>
                    </div>

                    <div>
                      <select
                        className="sel-inp-qc sPro  cursor-pointer"
                        value={selectedSize}
                        onChange={(e) => setSelectedSize(e.target.value)}
                      >
                        <option className="txt-gry" value={selectedSize}>
                          {" "}
                          {selectedSize || "Select Size"}
                        </option>
                      </select>
                    </div>
                  </div>
                </div>

                <div className="row pb-3 fnt-13 mat-hin">
                  <div className="col-md-6">
                    <div>
                      <label htmlFor="cars">material:</label>
                    </div>

                    <div>
                      {" "}
                      <select
                        className="sel-inp-qc sPro  cursor-pointer"
                        value={selectedMaterial}
                        onChange={(e) => setSelectedMaterial(e.target.value)}
                      >
                        {materialsList.length === 0 && (
                          <option value="">Select Material</option>
                        )}
                        {materialsList.map((material) => (
                          <option
                            className="txt-gry"
                            key={material}
                            value={material.trim()}
                          >
                            {material.trim()}
                          </option>
                        ))}
                      </select>
                    </div>
                  </div>
                  <div className="col-md-6">
                    <div>
                      <label htmlFor="cars">Leg Finish:</label>
                    </div>

                    <div>
                      {" "}
                      <select className="sel-inp-qc sPro  cursor-pointer">
                        <option className="txt-gry">Hinges</option>
                      </select>
                    </div>
                  </div>
                </div>

                {/* <div className="row btnsR my-3">
                  <div className="col-md-4 col-sm-6">
                    <div className=" qt-div">
                      <div>
                        <button onClick={decrementQuantity} className="quantity-btn bg-transparent">
                          <FaMinus />
                        </button>
                      </div>
                      <div>
                        <h6 className="align-items-center d-flex m-0">{selectedQuantity}</h6>
                      </div>
                      <button onClick={incrementQuantity}

                        disabled={selectedQuantity >= maxQuantity} className="quantity-btn bg-transparent">
                        <FaPlus />
                      </button>
                    </div>
                  </div>
                  <div className="col-md-4  col-sm-6 w-of">
                    <button
                      className="add-cart cart-bun text-light"
                      type="button"
                      onClick={() => handleAddToCart(product)}
                    >
                      {" "}
                      <IoCartOutline className="fnt-23" />
                      Add to Cart
                    </button>
                  </div>
                  <div className="col-md-4 col-sm-6 tb-pad-auto w-of">
                    <button className="buy-now buy-rd text-light">
                      Buy Now
                    </button>
                  </div>
                </div> */}

                <div className="row btnsR my-3">
                  {maxQuantity > 0 ? (
                    <>
                      <div className="col-md-4 col-sm-6">
                        <div className="qt-div">
                          <button
                            onClick={decrementQuantity}
                            className="quantity-btn bg-transparent"
                          >
                            <FaMinus />
                          </button>
                          <div>
                            <h6 className="align-items-center d-flex m-0 incNumber">
                              {selectedQuantity}
                            </h6>
                          </div>
                          <button
                            onClick={incrementQuantity}
                            className="quantity-btn bg-transparent"
                            // disabled={selectedQuantity >= maxQuantity}
                          >
                            <FaPlus />
                          </button>
                        </div>
                      </div>
                      <div className="col-md-4 col-sm-6 w-of">
                        <button
                          className="add-cart cart-bun text-light"
                          type="button"
                          onClick={() => handleAddToCart(product)}
                        >
                          <IoCartOutline className="fnt-23" />
                          Add to Cart
                        </button>
                      </div>
                      <div className="col-md-4 col-sm-6 tb-pad-auto w-of">
                        <button className="buy-now buy-rd text-light">
                          Buy Now
                        </button>
                      </div>
                    </>
                  ) : (
                    <div className="col-12">
                      <h5 className="text-danger">Out of Stock</h5>
                    </div>
                  )}
                </div>

                {/* <div>
                  <p className="shipping-info my-4 pb-sans">
                    {" "}
                    Free 3-5 day shipping • Ergonomic Design • 30-day trial
                  </p>
                </div> */}
                <div className="d-flex gap-5 wsh-div">
                  <div>
                    {" "}
                    {/* <p className="wishlisting text-success">
                      <CiHeart className="hrt-sym" />
                      Add to Wishlist
                    </p> */}
                    <p
                      role="button"
                      tabIndex={0}
                      className={`wishlisting text-success ${
                        isWishlisted ? "wishlisted" : ""
                      }`}
                      onClick={handleAddToWishlist}
                      onKeyDown={(e) => {
                        if (e.key === "Enter" || e.key === " ")
                          handleAddToWishlist();
                      }}
                      style={{ cursor: "pointer", userSelect: "none" }}
                      aria-pressed={isWishlisted}
                      aria-label={
                        isWishlisted
                          ? "Remove from wishlist"
                          : "Add to wishlist"
                      }
                    >
                      <CiHeart
                        className="hrt-sym"
                        style={{ color: isWishlisted ? "red" : "inherit" }}
                      />
                      {isWishlisted ? "Wishlisted" : "Add to Wishlist"}
                    </p>
                  </div>
                  {/* <div className="col-grish pb-sans shr-txt">
                    Share product:
                    <PiCopy className="s-icons" />
                    <FaFacebook className="s-icons-red" />
                    <IoLogoTwitter className="s-icons" />
                    <FaPinterestP className="s-icons" />
                  </div> */}

                  <div className="col-grish pb-sans shr-txt">
                    Share product:
                    <PiCopy
                      className="s-icons"
                      style={{ cursor: "pointer" }}
                      onClick={copyToClipboard}
                      title="Copy URL"
                    />
                    <FaFacebook
                      className="s-icons-red"
                      style={{ cursor: "pointer" }}
                      onClick={shareOnFacebook}
                      title="Share on Facebook"
                    />
                    <IoLogoTwitter
                      className="s-icons"
                      style={{ cursor: "pointer" }}
                      onClick={shareOnTwitter}
                      title="Share on Twitter"
                    />
                    <FaPinterestP
                      className="s-icons"
                      style={{ cursor: "pointer" }}
                      onClick={shareOnPinterest}
                      title="Share on Pinterest"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <div className="">
        <div className="container border">
          <div className="row">
            <section className="pt-0">
              <div className="container">
                <div className="row">
                  <div className="productDetails gaps">
                    <div className="pdct-txt">Description</div>
                    <div className="pdct-txt">Additional information</div>
                    <div className="pdct-txt">Specification</div>
                    <div className="pdct-txt">Review</div>
                  </div>
                </div>
                <div className="row de-padng">
                  <div className="col-md-6">
                    <div>
                      <div>
                        <h6 className="pb-sans title">Description</h6>
                      </div>
                      <div>
                        {/* <p className="inter-font col-grey fnt-15">
                          {product?.product_description}
                        </p> */}
                        <p className="inter-font col-grey fnt-15">
                          {product?.product_description?.replace(
                            /<[^>]*>?/gm,
                            ""
                          )}
                        </p>
                      </div>
                    </div>
                  </div>
                  {/* <div className="col-md-3">
                    <div className="ln-ht-25 border-right">
                      <div>
                        <h6 className="pb-sans title">Feature</h6>
                      </div>
                      <div className="pb-sans fnt-15">
                        <img
                          src="assets/images/Medal.png"
                          alt=""
                          className="w-20"
                        />{" "}
                        Free 1 Year Warranty
                      </div>
                      <div className="pb-sans fnt-13">
                        <img
                          src="assets/images/CreditCard.png"
                          alt=""
                          className="w-20"
                        />{" "}
                        Free Shipping & Fasted Delivery
                      </div>
                      <div className="pb-sans fnt-13">
                        <img
                          src="assets/images/Handshake.png"
                          alt=""
                          className="w-20"
                        />{" "}
                        100% Money-back guarantee
                      </div>
                      <div className="pb-sans fnt-13">
                        <img
                          src="assets/images/Headphones.png"
                          alt=""
                          className="w-20"
                        />{" "}
                        24/7 Customer support
                      </div>
                      <div className="pb-sans fnt-13">
                        <img
                          src="assets/images/Headphones.png"
                          alt=""
                          className="w-20"
                        />{" "}
                        24/7 Customer support
                      </div>
                      <div></div>
                    </div>
                  </div> */}

                  <div className="col-md-3">
                    <div className="ln-ht-25 border-right">
                      <div>
                        <h6 className="pb-sans title">Feature</h6>
                      </div>
                      {features.length > 0 ? (
                        features.map((feature, idx) => (
                          <div
                            key={idx}
                            className="pb-sans fnt-13"
                            style={{
                              display: "flex",
                              alignItems: "center",
                              marginBottom: "6px",
                            }}
                          >
                            <img
                              src={`${envImgUrl}/Uploads/products/${feature.icon}`}
                              alt={feature.text}
                              className="w-20"
                              style={{
                                width: "20px",
                                height: "20px",
                                marginRight: "6px",
                              }}
                            />
                            <span>{feature.text}</span>
                          </div>
                        ))
                      ) : (
                        <div className="pb-sans fnt-13">
                          No features available
                        </div>
                      )}
                    </div>
                  </div>

                  <div className="col-md-3">
                    <div className="pb-sans fnt-13 ln-ht-25 ">
                      <div>
                        <h6 className="pb-sans title">Shipping Information</h6>
                      </div>
                      <div>
                        Courier:{" "}
                        <span className="col-grey"> {product?.courier}</span>
                      </div>
                      <div>
                        Local Shipping:{" "}
                        <span className="col-grey"> {product?.shipping}</span>
                      </div>
                      <div>
                        UPS Ground Shipping:
                        <span className="col-grey">
                          {" "}
                          {product?.ground_shipping}
                        </span>
                      </div>
                      <div>
                        Unishop Global Export:
                        <span className="col-grey">
                          {" "}
                          {product?.global_export}
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="row">
                  <ul>
                    <li>
                      <h6 className="pb-sans title">Additional Information:</h6>
                      <div
                        className="pb-sans fnt-15 col-grey  list-style-type-disc py-3 pTop"
                        dangerouslySetInnerHTML={{
                          __html: product?.additional_info,
                        }}
                      ></div>
                    </li>
                    <li className="">
                      <h6 className="pb-sans title">Specifications:</h6>
                      <div
                        className="pb-sans list-style-type-disc col-grey fnt-15 py-3 pTop"
                        dangerouslySetInnerHTML={{
                          __html: product?.specification,
                        }}
                      ></div>
                    </li>
                  </ul>
                </div>
              </div>
            </section>

            <section className="sectionFeedback">
              <div className="container fed-rp">
                <div className="row">
                  <div className="feedback-container">
                    <h2 className="feedback-title">Customers Feedback</h2>
                    <div className="row">
                      <div className="feedback-wrapper">
                        {/* Product Rating Box */}

                        <div className="col-md-3 col-sm-12">
                          <div className="rating-box">
                            <p className="rating-value m-0">
                              {avgRating?.average_rating}
                            </p>
                            <span className="rating-s">
                              <ReactStars
                                count={5}
                                size={13}
                                activeColor="#FBBC04"
                                value={avgRating?.average_rating}
                                edit={false}
                                isHalf={true}
                              />
                            </span>

                            <p className="rating-text col-grey">
                              Product Rating
                            </p>
                          </div>
                        </div>

                        {/* Ratings Breakdown */}
                        <div className="col-md-7 col-sm-12">
                          <div className="rating-breakdown">
                            {/* 5 Stars */}
                            <div className="rating-row">
                              <div className="progress-baring">
                                <div
                                  className="progressing"
                                  style={{ width: "70%" }}
                                ></div>
                              </div>
                              <span className="rating-s">
                                <TiStar />
                                <TiStar />
                                <TiStar />
                                <TiStar />
                                <TiStar />
                              </span>

                              <span className="percentage">70%</span>
                            </div>

                            {/* 4 Stars */}
                            <div className="rating-row">
                              <div className="progress-baring">
                                <div
                                  className="progressing"
                                  style={{ width: "15%" }}
                                ></div>
                              </div>
                              <span className="rating-s">
                                <TiStar />
                                <TiStar />
                                <TiStar />
                                <TiStar />
                                <TiStar />
                              </span>

                              <span className="percentage">15%</span>
                            </div>

                            {/* 3 Stars */}
                            <div className="rating-row">
                              <div className="progress-baring">
                                <div
                                  className="progressing"
                                  style={{ width: "10%" }}
                                ></div>
                              </div>
                              <span className="rating-s">
                                <TiStar />
                                <TiStar />
                                <TiStar />
                                <TiStar />
                                <TiStar />
                              </span>

                              <span className="percentage">10%</span>
                            </div>

                            {/* 2 Stars */}
                            <div className="rating-row">
                              <div className="progress-baring">
                                <div
                                  className="progressing"
                                  style={{ width: "3%" }}
                                ></div>
                              </div>
                              <span className="rating-s">
                                <TiStar />
                                <TiStar />
                                <TiStar />
                                <TiStar />
                                <TiStar />
                              </span>
                              <span className="percentage">3%</span>
                            </div>

                            {/* 1 Star */}
                            <div className="rating-row">
                              <div className="progress-baring">
                                <div
                                  className="progressing"
                                  style={{ width: "2%" }}
                                ></div>
                              </div>
                              <span className="rating-s">
                                <TiStar />
                                <TiStar />
                                <TiStar />
                                <TiStar />
                                <TiStar />
                              </span>

                              <span className="percentage">2%</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            <section>
              <div className="container reviewCont">
                <h2 className="review-title">Reviews</h2>
                {customerReviewRating && customerReviewRating.length > 0 ? (
                  // customerReviewRating.map((item, index) => {
                  (showAllReviews
                    ? customerReviewRating
                    : customerReviewRating.slice(0, 1)
                  ).map((item, index) => {
                    return (
                      <div className="row" key={index}>
                        <div className="col-md-8">
                          <div className="">
                            <div className="review-card">
                              {/* Avatar */}
                              <div className="review-avatar desc">
                                {/* {item?.customer_first_name
                                  .charAt(0)
                                  .toUpperCase()}{" "}
                                {item?.customer_last_name
                                  .charAt(0)
                                  .toUpperCase()} */}
                                {item?.customer_first_name
                                  ?.charAt(0)
                                  ?.toUpperCase() || ""}{" "}
                                {item?.customer_last_name
                                  ?.charAt(0)
                                  ?.toUpperCase() || ""}
                              </div>

                              {/* Review Content */}
                              <div className="review-content">
                                <div className="review-header">
                                  {/* <div className="review-avatar mbl">
                                    {item?.customer_first_name
                                      ?.charAt(0)
                                      ?.toUpperCase() || ""}{" "}
                                    {item?.customer_last_name
                                      ?.charAt(0)
                                      ?.toUpperCase() || ""}
                                  </div> */}
                                  <span className="review-name">
                                    {item?.customer_first_name}{" "}
                                    {item?.customer_last_name}
                                  </span>
                                  <span className="review-time">
                                    {timeCalculator(item?.created_at)}
                                  </span>
                                </div>

                                <span className="rating-s reviewStars">
                                  <ReactStars
                                    count={5}
                                    activeColor="#FBBC04"
                                    value={item?.rating}
                                    edit={false}
                                    isHalf={true}
                                  />
                                </span>

                                <p className="review-heading">
                                  {item?.review_title}
                                </p>

                                <p className="review-text">
                                  {item?.review_content}
                                </p>

                                {item.replies && item.replies.length > 0 && (
                                  <>
                                    <span
                                      className="view-replies-toggle"
                                      onClick={() =>
                                        setShowReplies((prev) => ({
                                          ...prev,
                                          [item.cus_review_id]:
                                            !prev[item.cus_review_id],
                                        }))
                                      }
                                      style={{
                                        cursor: "pointer",
                                        color: "#007bff",
                                        display: "inline-block",
                                      }}
                                    >
                                      {showReplies[item.cus_review_id]
                                        ? "Hide Replies"
                                        : `View Replies (${item.replies.length})`}
                                    </span>

                                    {showReplies[item.cus_review_id] && (
                                      <div className="review-replies">
                                        {item.replies.map((reply) => {
                                          const nameParts =
                                            reply.user_name?.split(" ") || [];
                                          const firstInitial =
                                            nameParts[0]
                                              ?.charAt(0)
                                              .toUpperCase() || "";
                                          const lastInitial =
                                            nameParts[1]
                                              ?.charAt(0)
                                              .toUpperCase() || "";
                                          const initials = `${firstInitial}${lastInitial}`;

                                          return (
                                            <div
                                              key={reply.reply_id}
                                              className="reply-card"
                                            >
                                              <div className="reply-content d-flex">
                                                <span className="reply-avatar">
                                                  {initials}
                                                </span>
                                                <span className="reply-name">
                                                  {reply.user_name}
                                                </span>
                                                <span className="reply-time">
                                                  {timeCal(reply.created_at)}
                                                </span>
                                              </div>
                                              <p className="replyMsg">
                                                {reply.content}
                                              </p>
                                            </div>
                                          );
                                        })}
                                      </div>
                                    )}
                                  </>
                                )}

                                <div className="reviewBlock">
                                  <div className="review-actions">
                                    {/*  <span className="review-like col-grey">
                                      <BiLike className="mr-2" />
                                      Like
                                    </span>*/}
                                    <span
                                      className={`review-like ${
                                        likes[item.cus_review_id]
                                          ? "liked"
                                          : "unliked"
                                      } ${
                                        likeLoading[item.cus_review_id]
                                          ? "loading"
                                          : ""
                                      }`}
                                      onClick={() =>
                                        handleLike(item.cus_review_id)
                                      }
                                      style={{
                                        cursor: likeLoading[item.cus_review_id]
                                          ? "not-allowed"
                                          : "pointer",
                                      }}
                                    >
                                      <BiLike className="mr-2" />
                                      Like {likesCount[item.cus_review_id] || 0}
                                    </span>

                                    {/* <span className="review-reply">Reply</span>
                                    <div className="replyBlock">
                                      <form className="replyForm">
                                        <input type="text" />
                                        <button type="submit">Submit</button>
                                      </form>
                                    </div> */}
                                    <span
                                      className="review-reply"
                                      onClick={() =>
                                        toggleReplyBox(item.cus_review_id)
                                      }
                                    >
                                      Reply
                                    </span>

                                    {replies[item.cus_review_id] && (
                                      <div className="replyBlock">
                                        <form
                                          className="replyForm"
                                          onSubmit={(e) =>
                                            submitReply(e, item.cus_review_id)
                                          }
                                        >
                                          <input
                                            type="text"
                                            value={
                                              replyInputs[item.cus_review_id] ||
                                              ""
                                            }
                                            onChange={(e) =>
                                              handleReplyInputChange(
                                                item.cus_review_id,
                                                e.target.value
                                              )
                                            }
                                            placeholder="Write your reply..."
                                          />
                                          <button type="submit">Submit</button>
                                        </form>
                                      </div>
                                    )}
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    );
                  })
                ) : (
                  <h1 className="noReviews">No Reviews</h1>
                )}

                {/* <div className="viewAllRew">View All Reviews</div> */}
                {customerReviewRating.length > 1 && (
                  <div
                    className="viewAllRew"
                    onClick={() => setShowAllReviews((prev) => !prev)}
                    style={{
                      cursor: "pointer",
                      textAlign: "center",
                      marginTop: "20px",
                      color: "#007bff",
                    }}
                  >
                    {showAllReviews ? "Show Less" : "View All Reviews"}
                  </div>
                )}
              </div>
            </section>

            <section>
              <div className="container">
                <div className="row reviewRow">
                  <div className="col-md-8">
                    <div className="fnt-inter">
                      <h2 className="review-title2">Write a Review</h2>
                      <form ref={formRef} method="post" onSubmit={submitReview}>
                        <label className="review-label2">
                          What is it like to Product?
                        </label>
                        <div className="stars2">
                          <ReactStars
                            count={5}
                            size={20}
                            activeColor="#FBBC04"
                            name="customerRating"
                            onChange={ratingChanged}
                            isHalf={true}
                            gap={5}
                          />
                          {customerReviewError.customerRating && (
                            <p className="error-msg logError">
                              {customerReviewError.customerRating}
                            </p>
                          )}
                        </div>

                        <label className="review-label2">Review Title</label>
                        <input
                          type="text"
                          className="review-input bg-transparent"
                          placeholder="Great Products"
                          name="customerReviewTitle"
                          onChange={handleCustomerReview}
                        />
                        {customerReviewError.customerReviewTitle && (
                          <p className="error-msg logError">
                            {customerReviewError.customerReviewTitle}
                          </p>
                        )}

                        <label className="review-label2">Review Content</label>
                        <textarea
                          className="review-textarea2 bg-transparent"
                          placeholder="Write your review here..."
                          name="customerReviewContent"
                          onChange={handleCustomerReview}
                        ></textarea>
                        {customerReviewError.customerReviewContent && (
                          <p className="error-msg logError text">
                            {customerReviewError.customerReviewContent}
                          </p>
                        )}
                        <button className="submit-button2 my-4" type="submit">
                          Submit review
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            {/* <RecentlyViewed product={product} /> */}

            {/* <section className='pdng-btm'>
              <div className="container">
                <div className="row">
                  <div className="col-md-2">
                    <div className="product-card">
                      <div className='bg-grey'>
                        <div className="wishlist-icon">♡</div>
                        <img
                          className="product-image-2"
                          src="assets/images/My project (1) 1.png"
                          alt="Sofa"
                        />
                      </div>
                      <div className="product-details-2 text-start">
                        <h6 className="
         col-grey">TDX Sinkers</h6>
                        <p className="product-price-2 m-0">₹ 675.00</p>
                        <p className="product-description m-0 ">Lorem Ipsum is the word</p>

                        <div className="rating-s"> <TiStar /><TiStar /><TiStar /><TiStar /><BsStarHalf className='w-11' />
                          <span className="rating-count">(121)</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div className="col-md-2">
                    <div className="product-card">
                      <div className='bg-grey'>
                        <div className="wishlist-icon">♡</div>
                        <img
                          className="product-image-2"
                          src="assets/images/My project (1) 1.png"
                          alt="Sofa"
                        />
                      </div>
                      <div className="product-details-2 text-start">
                        <h6 className="
         col-grey">TDX Sinkers</h6>
                        <p className="product-price-2 m-0">₹ 675.00</p>
                        <p className="product-description m-0 ">Lorem Ipsum is the word</p>

                        <div className="rating-s"> <TiStar /><TiStar /><TiStar /><TiStar /><BsStarHalf className='w-11' />
                          <span className="rating-count">(121)</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div className="col-md-2">
                    <div className="product-card">
                      <div className='bg-grey'>
                        <div className="wishlist-icon">♡</div>
                        <img
                          className="product-image-2"
                          src="assets/images/My project (1) 1.png"
                          alt="Sofa"
                        />
                      </div>
                      <div className="product-details-2 text-start">
                        <h6 className="
         col-grey">TDX Sinkers</h6>
                        <p className="product-price-2 m-0">₹ 675.00</p>
                        <p className="product-description m-0 ">Lorem Ipsum is the word</p>

                        <div className="rating-s"> <TiStar /><TiStar /><TiStar /><TiStar /><BsStarHalf className='w-11' />
                          <span className="rating-count">(121)</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div className="col-md-2">
                    <div className="product-card">
                      <div className='bg-grey'>
                        <div className="wishlist-icon">♡</div>
                        <img
                          className="product-image-2"
                          src="assets/images/My project (1) 1.png"
                          alt="Sofa"
                        />
                      </div>
                      <div className="product-details-2 text-start">
                        <h6 className="
         col-grey">TDX Sinkers</h6>
                        <p className="product-price-2 m-0">₹ 675.00</p>
                        <p className="product-description m-0">Lorem Ipsum is the word</p>

                        <div className="rating-s"> <TiStar /><TiStar /><TiStar /><TiStar /><BsStarHalf className='w-11' />
                          <span className="rating-count">(121)</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div className="col-md-2">
                    <div className="product-card">
                      <div className='bg-grey'>
                        <div className="wishlist-icon">♡</div>
                        <img
                          className="product-image-2"
                          src="assets/images/My project (1) 1.png"
                          alt="Sofa"
                        />
                      </div>
                      <div className="product-details-2 text-start">
                        <h6 className="
         col-grey">TDX Sinkers</h6>
                        <p className="product-price-2 m-0">₹ 675.00</p>
                        <p className="product-description m-0 col-grey">Lorem Ipsum is the word</p>

                        <div className="rating-s"> <TiStar /><TiStar /><TiStar /><TiStar /><BsStarHalf className='w-11' />
                          <span className="rating-count">(121)</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div className="col-md-2">
                    <div className="product-card">
                      <div className='bg-grey'>
                        <div className="wishlist-icon">♡</div>
                        <img
                          className="product-image-2"
                          src="assets/images/My project (1) 1.png"
                          alt="Sofa"
                        />
                      </div>
                      <div className="product-details-2 text-start">
                        <h6 className="
         col-grey">TDX Sinkers</h6>
                        <p className="product-price-2 m-0">₹ 675.00</p>
                        <p className="product-description m-0 col-grey">Lorem Ipsum is the word</p>

                        <div className="rating-s"> <TiStar /><TiStar /><TiStar /><TiStar /><BsStarHalf className='w-11' />
                          <span className="rating-count">(121)</span>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </section> */}
          </div>
        </div>
      </div>
      <Sonner />
    </>
  );
};

export default ProductPage;
