import { useEffect, useState } from "react";

import { TiStar } from "react-icons/ti";
import { CiHeart } from "react-icons/ci";
import { IoCartOutline } from "react-icons/io5";
import { PiCopy } from "react-icons/pi";
import { FaFacebook } from "react-icons/fa";
import { IoLogoTwitter } from "react-icons/io";
import { FaPinterestP } from "react-icons/fa";
import { BsStarHalf } from "react-icons/bs";
import { FaPlus } from "react-icons/fa6";
import { BiLike } from "react-icons/bi";
import Carousel from "react-multi-carousel";
import "react-multi-carousel/lib/styles.css";
import { FaMinus } from "react-icons/fa6";
import { FaChevronLeft, FaChevronRight } from "react-icons/fa";
import ReactStars from "react-rating-stars-component";
import { useSearchParams } from "react-router-dom";
import Loader from "../Components/Spinner/Loader";
import { environmentUrl } from "../env/enviroment";
import { addToCart, formatCurrency, addToWishlist } from "../libs/endpoints";
import { envImgUrl } from "../env/envImage";
import { toast } from "sonner";
import Sonner from "../Components/Toaster/Sonner";

const ProductPage = () => {
  const [searchParams] = useSearchParams();
  const params = searchParams.get("productId");
  const [loading, setLoading] = useState([]);
  const [product, setProduct] = useState({});
  const [customerReview, setCustomerReview] = useState({
    productId: params,
  });
  const [customerReviewError, setCustomerReviewError] = useState({});
  const [svgRating, setAvgRating] = useState([]);
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
      }
    } catch (error) {
      console.log(error);
    } finally {
      setLoading(false);
    }
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

  const handleAddToCart = async (id) => {
    try {
      const response = await addToCart(id);
      if (response?.status) {
        toast.success("Successfully Added To Cart");
      }
    } catch (error) {
      console.log(error);
      toast.error(error?.response?.data?.message);
    }
  };
  const handleAddToWishlist = async (id) => {
    try {
      const response = await addToWishlist(id);
      if (response?.status) {
        toast.success("Successfully Added To wishlist");
      }
    } catch (error) {
      console.log(error);
      toast.error(error?.response?.data?.message);
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
      if (response?.status) {
        toast.success(response?.message);
        customerReview.reset();
        setCustomerReview({});
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

  const getAvgRating = async () => {
    try {
      setLoading(true);
      const apiUrl = `${environmentUrl}/reviews/averageRating.php?productId=${params}`;
      const options = {
        method: "GET",
      };
      const response = await (await fetch(apiUrl, options)).json();
      if (response?.status) {
        console.log("rating response====", response?.data);
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
    getProduct();
    getAvgRating();
  }, []);
  return (
    <>
      {loading && <Loader />}
      <section className="singleProSect">
        <div className="container mini-deskrp lg-tab">
          <div className="row single-pro">
            <div className="col-md-6">
              <div className="border-grey ">
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
              </div>
            </div>
            <div className="col-md-1"></div>
            <div className="col-md-5">
              <div className="product-container">
                <div className="rating-s">
                  {" "}
                  <div className="str-coll str-mbl">
                    <ReactStars
                      count={5}
                      size={13}
                      activeColor="#FBBC04"
                      value={3.5}
                      edit={false}
                    />
                  </div>
                  <span className="text-dark pb-sans top-rtng">
                    {" "}
                    {product?.average_rating} / 5.0{" "}
                  </span>
                  {/* <span className="col-grey usag-num">(556)</span> */}
                </div>
                <h1 className="long-chr">{product?.product_title}</h1>
                <div className="row">
                  <div className="col-md-10 widthP">
                    <div className="row pb-sans row-wdth">
                      <div className="col-md-6 col-sm-6">
                        <div className=" sku-txt">
                          Sku:{" "}
                          <span className="text-dark fw-bold">A264671</span>
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
                    <div className="color-options d-flex gap-3 ">
                      <div
                        className="color-teal"
                        style={{ backgroundColor: product?.color_code }}
                      ></div>
                    </div>
                  </div>
                  <div className="col-md-6">
                    <div>
                      <label htmlFor="cars">size:</label>
                    </div>

                    <div>
                      <select className="sel-inp-qc  cursor-pointer">
                        <option className="txt-gry">Hinges</option>
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
                      <select className="sel-inp-qc  cursor-pointer">
                        <option className="txt-gry">Hinges</option>
                      </select>
                    </div>
                  </div>
                  <div className="col-md-6">
                    <div>
                      <label htmlFor="cars">Leg Finish:</label>
                    </div>

                    <div>
                      {" "}
                      <select className="sel-inp-qc  cursor-pointer">
                        <option className="txt-gry">Hinges</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div className="row btnsR my-3">
                  <div className="col-md-4 col-sm-6">
                    <div className=" qt-div">
                      <div>
                        <button className="quantity-btn bg-transparent">
                          <FaMinus />
                        </button>
                      </div>
                      <div>
                        <h6 className="align-items-center d-flex m-0">1</h6>
                      </div>
                      <button className="quantity-btn bg-transparent">
                        <FaPlus />
                      </button>
                    </div>
                  </div>
                  <div className="col-md-4  col-sm-6 w-of">
                    <button
                      className="add-cart cart-bun text-light"
                      type="button"
                      onClick={() => handleAddToCart(product?.product_id)}
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
                    <p className="wishlisting text-success">
                      <CiHeart className="hrt-sym" />
                      Add to Wishlist
                    </p>
                  </div>
                  <div className="col-grish pb-sans shr-txt">
                    Share product:
                    <PiCopy className="s-icons" />
                    <FaFacebook className="s-icons-red" />
                    <IoLogoTwitter className="s-icons" />
                    <FaPinterestP className="s-icons" />
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
                        <h6 className="pb-sans">Description</h6>
                      </div>
                      <div>
                        <p className="inter-font col-grey fnt-15">
                          {product?.product_description}
                        </p>
                      </div>
                    </div>
                  </div>
                  <div className="col-md-3">
                    <div className="ln-ht-25 border-right">
                      <div>
                        <h6 className="pb-sans">Feature</h6>
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
                  </div>
                  <div className="col-md-3">
                    <div className="pb-sans fnt-13 ln-ht-25 ">
                      <div>
                        <h6 className="pb-sans">Shipping Information</h6>
                      </div>
                      <div>
                        Courier:{" "}
                        <span className="col-grey">
                          {" "}
                          2 - 4 days, free shipping
                        </span>
                      </div>
                      <div>
                        Local Shipping:{" "}
                        <span className="col-grey">
                          {" "}
                          up to one week, $19.00
                        </span>
                      </div>
                      <div>
                        UPS Ground Shipping:
                        <span className="col-grey"> 4 - 6 days, $29.00</span>
                      </div>
                      <div>
                        Unishop Global Export:
                        <span className="col-grey"> 3 - 4 days, $39.00</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="row">
                  <ul>
                    <li>
                      <strong>Additional Information:</strong>
                      <div
                        className="pb-sans fnt-15 col-grey  list-style-type-disc py-3 pTop"
                        dangerouslySetInnerHTML={{
                          __html: product?.additional_info,
                        }}
                      ></div>
                    </li>
                    <li className="">
                      <strong>Specifications:</strong>
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
                            <p className="rating-value m-0">4.8</p>
                            <span className="rating-s">
                              <TiStar />
                              <TiStar />
                              <TiStar />
                              <TiStar />
                              <TiStar />
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
                <div className="row">
                  <div className="col-md-8">
                    <div className="">
                      <h2 className="review-title">Reviews</h2>
                      <div className="review-card">
                        {/* Avatar */}
                        <div className="review-avatar">A.T</div>

                        {/* Review Content */}
                        <div className="review-content">
                          <div className="review-header">
                            <span className="review-name">Nicolas Cage</span>
                            <span className="review-time">3 Days ago</span>
                          </div>

                          {/* Star Rating */}
                          <span className="rating-s">
                            <TiStar />
                            <TiStar />
                            <TiStar />
                            <TiStar />
                            <TiStar />
                          </span>

                          {/* Review Title */}
                          <p className="review-heading">Great Product</p>

                          {/* Review Text */}
                          <p className="review-text">
                            There are many variations of passages of Lorem Ipsum
                            available, but the majority have suffered alteration
                            in some form, by injected humour.
                          </p>

                          {/* Like & Reply */}
                          <div className="review-actions">
                            <span className="review-like col-grey">
                              <BiLike className="mr-2" />
                              Like
                            </span>
                            <span className="review-reply">Reply</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div className="row">
                  <div className="col-md-8">
                    <div className="">
                      <div className="review-card">
                        {/* Avatar */}
                        <div className="review-avatar">A.T</div>

                        {/* Review Content */}
                        <div className="review-content">
                          <div className="review-header">
                            <span className="review-name">Nicolas Cage</span>
                            <span className="review-time">3 Days ago</span>
                          </div>

                          {/* Star Rating */}
                          <span className="rating-s">
                            <TiStar />
                            <TiStar />
                            <TiStar />
                            <TiStar />
                            <TiStar />
                          </span>

                          {/* Review Title */}
                          <p className="review-heading">Great Product</p>

                          {/* Review Text */}
                          <p className="review-text ">
                            There are many variations of passages of Lorem Ipsum
                            available, but the majority have suffered alteration
                            in some form, by injected humour.
                          </p>

                          {/* Like & Reply */}
                          <div className="review-actions">
                            <span className="review-like col-grey">
                              <BiLike className="mr-2" />
                              Like
                            </span>
                            <span className="review-reply">Reply</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div className="viewAllRew">View All Reviews</div>
                  </div>
                </div>
              </div>
            </section>

            <section>
              <div className="container">
                <div className="row">
                  <div className="col-md-8">
                    <div className="fnt-inter">
                      <h2 className="review-title2">Write a Review</h2>
                      <form method="post" onSubmit={submitReview}>
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
                          <p className="error-msg logError">
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

            <section className="pdng-btm prouctSingle">
              <div className="container proCarousel">
                <Carousel
                  responsive={responsive}
                  infinite
                  arrows={true}
                  customLeftArrow={<CustomLeftArrow />}
                  customRightArrow={<CustomRightArrow />}
                >
                  <div className="product-card">
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
                        <TiStar />
                        <TiStar />
                        <TiStar />
                        <TiStar />
                        <BsStarHalf className="mb-str" />
                        <span className="rating-count">(121)</span>
                      </div>
                    </div>
                  </div>
                  <div className="product-card">
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
                        <TiStar />
                        <TiStar />
                        <TiStar />
                        <TiStar />
                        <BsStarHalf className="mb-str" />
                        <span className="rating-count">(121)</span>
                      </div>
                    </div>
                  </div>
                  <div className="product-card">
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
                        <TiStar />
                        <TiStar />
                        <TiStar />
                        <TiStar />
                        <BsStarHalf className="mb-str" />
                        <span className="rating-count">(121)</span>
                      </div>
                    </div>
                  </div>
                  <div className="product-card">
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
                        <TiStar />
                        <TiStar />
                        <TiStar />
                        <TiStar />
                        <BsStarHalf className="mb-str" />
                        <span className="rating-count">(121)</span>
                      </div>
                    </div>
                  </div>
                  <div className="product-card">
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
                        <TiStar />
                        <TiStar />
                        <TiStar />
                        <TiStar />
                        <BsStarHalf className="mb-str" />
                        <span className="rating-count">(121)</span>
                      </div>
                    </div>
                  </div>
                  <div className="product-card">
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
                        <TiStar />
                        <TiStar />
                        <TiStar />
                        <TiStar />
                        <BsStarHalf className="mb-str" />
                        <span className="rating-count">(121)</span>
                      </div>
                    </div>
                  </div>

                  {/* Add more <div className="product-card">...</div> as needed */}
                </Carousel>
              </div>
            </section>

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
