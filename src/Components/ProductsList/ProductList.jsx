/* eslint-disable react-hooks/exhaustive-deps */
/* eslint-disable no-unused-vars */
/* eslint-disable react/jsx-key */
import { Link } from "react-router-dom";
import { IoGrid } from "react-icons/io5";
import { FaListUl } from "react-icons/fa";
import { PiHeartBold } from "react-icons/pi";
import { PiEyeLight } from "react-icons/pi";
import { HiOutlineShoppingCart } from "react-icons/hi";
import { HiMiniChevronDown } from "react-icons/hi2";
import { RiArrowDropUpLine } from "react-icons/ri";
import { useEffect, useState } from "react";
import { environmentUrl } from "../../env/enviroment";
import { envImgUrl } from "../../env/envImage";
import { toast } from "sonner";
import Sonner from "../Toaster/Sonner";
import {
  addToCart,
  addToWishlist,
  getBrandsMaster,
  getCartItems,
  getColorMaster,
  getMaterialMaster,
  getProductCategoryMaster,
  getProductsOnCategory,
} from "../../libs/endpoints";
import Carousel from "react-multi-carousel";
import "react-multi-carousel/lib/styles.css";
import Slider from "@mui/material/Slider";
import { IoIosCheckmark } from "react-icons/io";
import ReactPaginate from "react-paginate";
import { useForm } from "react-hook-form";
import Loader from "../Spinner/Loader";

const ProductList = () => {
  const [showFilter, setShowFilters] = useState(false);
  const [loading, setLoading] = useState(true);
  const showFilterDropDown = (event) => {
    console.log("click event id is====", event);
    setShowFilters(!showFilter);
  };

  const [colorMaster, setColorMaster] = useState([]);
  const handleColours = async () => {
    const response = await getColorMaster();
    const colors = response?.response;
    console.log("color master in handle colors are", colorMaster);
    setColorMaster(colors);
  };

  const [productCat, setProductCat] = useState([]);
  const handleProductCategory = async () => {
    const response = await getProductCategoryMaster();
    const ProductCatRes = response?.response;
    setProductCat(ProductCatRes);
  };

  const [materialMaster, setMaterialMaster] = useState([]);
  const handleMaterialMaster = async () => {
    const response = await getMaterialMaster();
    const materialRes = response?.response;
    setMaterialMaster(materialRes);
  };

  const [brands, setBrands] = useState([]);
  const handleProductBrands = async () => {
    const response = await getBrandsMaster();
    const brandRes = response?.response;
    setBrands(brandRes);
  };

  const [products, setProducts] = useState([]);
  const handleProductsOnCategory = async () => {
    let response = await getProductsOnCategory();
    console.log("products page response is====", response);
    setProducts(response?.response);
  };

  const categoryParams = window.location.search;
  // console.log("category query params in product list", categoryParams);
  useEffect(() => {
    handleColours();
    handleProductCategory();
    handleMaterialMaster();
    handleProductBrands();
    handleProductsOnCategory();
  }, []);
  console.log("color masters are", colorMaster);
  // console.log("product cat masters are", productCat);
  // console.log("material  masters are", materialMaster);
  // console.log("brands  masters are", brands);
  console.log("products are", products);

  const handleAddToCart = async (eachProduct) => {
    console.log("product detail by clicking cart are", eachProduct);
    let response = await addToCart(eachProduct);
    if (response?.status == "warning") {
      toast.warning("Product Already Added To Cart", {
        position: toast.POSITION.TOP_RIGHT,
      });
    } else {
      if (response?.status) {
        toast.success("Successfully Added To Cart");
        getCartItems();
      } else {
        toast.error("Failed To Add");
      }
    }
  };

  const handleAddToWishlist = async (eachProduct) => {
    console.log("product details by clicking wishlist are", eachProduct);
    let response = await addToWishlist(eachProduct);
    if (response?.status) {
      toast.success("Successfully Added To Wishlist");
    } else {
      toast.error("Failed To Add");
    }
  };

  const [productQuickView, setProductQuickView] = useState([]);
  const [quickViewPopup, setQuickViewPopup] = useState(false);
  const handleProductQuickView = (eachProduct) => {
    setProductQuickView(eachProduct);
    setQuickViewPopup(!quickViewPopup);
    console.log("quick view product details", eachProduct);
    console.log("quick view product popup", quickViewPopup);
  };

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
      items: 2,
    },
    mobile: {
      breakpoint: { max: 464, min: 0 },
      items: 1,
    },
  };

  const [range, setRange] = useState([1000, 1000]);
  const handleChanges = (event, newValue) => {
    setRange(newValue);
  };

  const [brandMasterVal, setBrandMasterVal] = useState([]);
  const captureBrandMaster = (bId) => {
    const index = brandMasterVal.indexOf(bId);
    if (index == -1) {
      setBrandMasterVal([...brandMasterVal, bId]);
    } else {
      brandMasterVal.splice(index, 1);
      setBrandMasterVal([...brandMasterVal]);
    }
    console.log("brands master value is", brandMasterVal);
  };

  const [materialMasterVal, setMaterialMasterVal] = useState([]);
  const captureMaterialMaster = (mId) => {
    const index = materialMasterVal.indexOf(mId);
    if (index == -1) {
      setMaterialMasterVal([...materialMasterVal, mId]);
    } else {
      materialMasterVal.splice(index, 1);
      setMaterialMasterVal([...materialMasterVal]);
    }
    console.log("masterval array", materialMasterVal);
  };

  /// apply Filters functionality ///
  const applyProductFilters = async () => {
    console.log("apply filter triggered");
    try {
      setLoading(true);
      const apiUrl = `${environmentUrl}/products/get.php?material=${materialMasterVal}&&brand=${brandMasterVal}&&minPrice=${range[0]}&&maxPrice=${range[1]}`;
      const options = { method: "POST" };
      const fetchData = await (await fetch(apiUrl, options)).json();
      console.log(fetchData?.response);
    } catch (error) {
      console.log("refer a frd error===", error);
    } finally {
      setLoading(false);
    }
  };

  return (
    <>
      {loading && <Loader />}
      <section className="products pt-0 pt-0 mt--125">
        <header>
          <div className="bredcum">
            <img
              src="assets/images/img-5.jpg"
              alt="lightBanner"
              className="banner-content image_zoom"
            />
            <h2 className="mt-0 mb-0">Product list category</h2>
          </div>

          <div className="container">
            {/* <ol className="breadcrumb">
                        <li className="breadcrumb-item"><a to="#">Home</a></li>
                        <li className="breadcrumb-item"><a to="#">Library</a></li>
                        <li className="breadcrumb-item active" aria-current="page">Data</li>
                    </ol> */}
            {/* <h2 className="title">Product list category</h2> */}
            {/* <div className="text">
              <p>Nam egestas tincidunt turpis</p>
            </div> */}
          </div>
        </header>
        <div className="container">
          <div className="row">
            {/* <!-- === Left content === --> */}

            <div className="col-lg-3">
              {/* <!-- === Product filters === --> */}

              <div className="filters">
                <div className="filter-scroll-list">
                  <div className="filter-header d-block d-sm-none">
                    <span className="h4">Filter products</span>
                    <br />
                    Select your options
                    <hr />
                  </div>

                  {/* <!--Colors--> */}

                  <div className="filter-box" id="colorFilter">
                    <div
                      className="title products-filter"
                      onClick={showFilterDropDown}
                    >
                      Colors <RiArrowDropUpLine />
                      <HiMiniChevronDown />
                    </div>

                    <div className="filter-content">
                      <div className="product-colors clearfix">
                        {colorMaster === "No Data Found" ? (
                          <div className="no-result-container">
                            <img src="assets/images/no-results.png" alt="" />
                            <p className="m-0"> No Colors Found</p>
                          </div>
                        ) : (
                          colorMaster.map((eachColor, index) => (
                            <span
                              key={index}
                              className={`color-btn`}
                              style={{
                                backgroundColor: `${eachColor.color_code}`,
                              }}
                              id={`Color${eachColor.color_id}`}
                            ></span>
                          ))
                        )}
                        {/* <span className="color-btn color-btn-pink"></span>
                        <span className="color-btn color-btn-orange"></span>
                        <span className="color-btn color-btn-red"></span>
                        <span className="color-btn color-btn-blue"></span>
                        <span className="color-btn color-btn-green"></span>
                        <span className="color-btn color-btn-gray"></span>
                        <span className="color-btn color-btn-biege"></span>
                        <span className="color-btn color-btn-black"></span>
                        <span className="color-btn color-btn-white"></span> */}
                      </div>
                    </div>
                  </div>

                  {/* <!--Price--> */}

                  <div className="filter-box" id="priceFilter">
                    <div
                      className="title products-filter"
                      onClick={showFilterDropDown}
                    >
                      Price{" "}
                      {showFilter == true ? (
                        <RiArrowDropUpLine />
                      ) : (
                        <HiMiniChevronDown />
                      )}
                    </div>

                    <div className="filter-content" id="price filter">
                      <div className="price-filter">
                        <Slider
                          value={range}
                          onChange={handleChanges}
                          valueLabelDisplay="auto"
                          max={500000}
                          min={1000}
                        />
                        <p className="text-center">
                          {`Prince Range ₹ ${range[0]} - ${range[1]}`}
                        </p>
                      </div>
                    </div>
                  </div>

                  {/* <!--Type--> */}

                  <div className="filter-box" id="categoryFilter">
                    <div
                      className="title products-filter"
                      onClick={showFilterDropDown}
                    >
                      Type <RiArrowDropUpLine />
                      <HiMiniChevronDown />
                    </div>

                    <div className="filter-content">
                      {productCat.map((eachCat) => (
                        <span className="checkbox">
                          <input
                            type="radio"
                            name="productCategoryFilter"
                            id={`productId${eachCat.category_id}`}
                            value={eachCat.category_id}
                            // checked="checked"
                          />
                          <label htmlFor={`productId${eachCat.category_id}`}>
                            {eachCat.category_name} <i>(1200)</i>
                          </label>
                        </span>
                      ))}
                    </div>
                  </div>

                  {/* <!--Material--> */}

                  <div className="filter-box active">
                    <div
                      className="title products-filter"
                      onClick={showFilterDropDown}
                    >
                      Material <RiArrowDropUpLine />
                      <HiMiniChevronDown />
                    </div>
                    <div className="filter-content">
                      {materialMaster.map((each) => (
                        <span className="checkbox">
                          <input
                            type="checkbox"
                            id={`materialMaster${each.material_id}`}
                            name={`${each.material_name}Val`}
                            onChange={() => {
                              captureMaterialMaster(each.material_id);
                            }}
                            value={each.material_id}
                          />
                          <label htmlFor={`materialMaster${each.material_id}`}>
                            {each.material_name} <i>(1200)</i>
                          </label>
                        </span>
                      ))}
                    </div>
                  </div>

                  {/* <!--Discount--> */}

                  <div className="filter-box">
                    <div
                      className="title products-filter"
                      onClick={showFilterDropDown}
                    >
                      Brands <RiArrowDropUpLine />
                      <HiMiniChevronDown />
                    </div>
                    <div className="filter-content">
                      {brands.map((eachBrand) => (
                        <span className="checkbox">
                          <input
                            type="checkbox"
                            id={`materialMaster${eachBrand.brand_id}`}
                            name={`${eachBrand.enter_brand}Val`}
                            onChange={() => {
                              captureBrandMaster(eachBrand.brand_id);
                            }}
                            value={eachBrand.brand_id}
                          />

                          <label
                            htmlFor={`materialMaster${eachBrand.brand_id}`}
                          >
                            {eachBrand.enter_brand}
                          </label>
                        </span>
                      ))}
                    </div>
                  </div>

                  {/* <!--Availability--> */}

                  {/* <div className="filter-box">
                    <div
                      className="title products-filter"
                      onClick={showFilterDropDown}
                    >
                      Availability{" "}
                      {showFilter == true ? (
                        <RiArrowDropUpLine />
                      ) : (
                        <HiMiniChevronDown />
                      )}
                    </div>
                    <div className="filter-content">
                      <span className="checkbox">
                        <input
                          type="checkbox"
                          id="availableId1"
                          checked="checked"
                        />
                        <label htmlFor="availableId1">
                          In stock <i>(152)</i>
                        </label>
                      </span>
                      <span className="checkbox">
                        <input type="checkbox" id="availableId2" />
                        <label htmlFor="availableId2">
                          1 Week <i>(100)</i>
                        </label>
                      </span>
                      <span className="checkbox">
                        <input type="checkbox" id="availableId3" />
                        <label htmlFor="availableId3">
                          2 Weeks <i>(80)</i>
                        </label>
                      </span>
                    </div>
                  </div> */}
                  <button
                    type="button"
                    onClick={applyProductFilters}
                    className="btn- btn-primary"
                  >
                    Apply Filters
                  </button>
                </div>
                {/* <!--/filter-scroll-->
                            <!-- Close filters on mobile / update filters--> */}
                <div className="toggle-filters-close btn btn-circle">
                  <i className="icon icon-cross"></i>
                </div>
              </div>
              {/* <!--/filters--> */}
            </div>

            {/* <!--Right content--> */}

            <div className="col-lg-9">
              {/* <!-- === Sort bar === --> */}

              <div className="sort-bar clearfix">
                <div className="sort-results pull-left">
                  {/* <!--Showing result per page--> */}

                  <select>
                    <option value="10">10</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                  </select>
                  {/* <!--Items counter--> */}
                  <span>
                    Showing all <strong>50</strong> of <strong>348</strong>{" "}
                    items
                  </span>
                </div>

                {/* <!--Sort options--> */}

                <div className="sort-options pull-right">
                  <span className="d-none d-sm-inline-block">Sort by</span>

                  <select>
                    <option value="">Select</option>
                    <option value="Name">Name</option>
                    <option value="Popularity">Popular items</option>
                    <option value="lowest">Price: lowest</option>
                    <option value="highest">Price: highest</option>
                  </select>

                  {/* <!--Grid-list view--> */}

                  <span className="grid-list">
                    <Link to={`/productsGrid${categoryParams}`}>
                      <IoGrid />
                    </Link>
                    <Link to={`/products${categoryParams}`}>
                      <FaListUl />
                    </Link>
                    <Link
                      to=""
                      className="toggle-filters-mobile d-inline-block d-md-none"
                    >
                      <span
                        className="spinner-grow spinner-grow-sm text-warning"
                        role="status"
                        aria-hidden="true"
                      ></span>
                      <i className="fa fa-sliders"></i>
                    </Link>
                  </span>
                </div>
                {/* <!--/sort-options--> */}
              </div>

              {/* <!--Products collection--> */}

              <div className="row">
                {/* <!--Product item--> */}
                {products.map((eachProduct) => (
                  <div className="col-12">
                    <article>
                      <div className="info">
                        <span className="add-favorite">
                          <Link
                            to=""
                            data-title="Add to favorites"
                            data-title-added="Added to favorites list"
                          >
                            <PiHeartBold
                              onClick={() => {
                                handleAddToWishlist(eachProduct);
                              }}
                            />
                          </Link>
                        </span>
                        <span>
                          <Link
                            to=""
                            className="mfp-open"
                            data-title="Quick wiew"
                            data-toggle="modal"
                            data-target="#exampleModalLong"
                          >
                            <PiEyeLight
                              onClick={() => {
                                handleProductQuickView(eachProduct);
                              }}
                            />
                          </Link>
                        </span>
                      </div>
                      <div className="btn btn-add">
                        <HiOutlineShoppingCart
                          onClick={() => {
                            handleAddToCart(eachProduct);
                          }}
                        />
                      </div>
                      <div className="figure-list list-image">
                        <span
                          className={`badge ${
                            eachProduct.productTag === "Offer"
                              ? "badge-danger"
                              : "badge-info"
                          }`}
                        >
                          {eachProduct.productTag}
                        </span>
                        <div className="image">
                          <Link
                            to={`/singleproduct?productId=${eachProduct.product_id}`}
                          >
                            <img
                              src={`${envImgUrl}/Uploads/products/${eachProduct.image_1}`}
                              alt={eachProduct.alttext_1}
                            />
                          </Link>
                        </div>
                        <div className="text">
                          <h2 className="title h4">
                            <Link
                              to={`/singleproduct?productId=${eachProduct.product_id}`}
                            >
                              {eachProduct.product_title}
                            </Link>
                          </h2>
                          <sub>₹ {eachProduct.product_mrp}/-</sub>
                          <sup>
                            ₹ {eachProduct.product_offerprice}
                            /-
                          </sup>
                          <span
                            className="description clearfix"
                            dangerouslySetInnerHTML={{
                              __html: eachProduct.product_description,
                            }}
                          ></span>
                        </div>
                      </div>
                    </article>
                  </div>
                ))}
              </div>
              {/* <!--/row--> */}
              <div className="pagination-wrapper">
                <ReactPaginate
                  breakLabel="...."
                  nextLabel="Next >"
                  onPageChange={3}
                  pageRangeDisplayed={2}
                  pageCount={9}
                  previousLabel="< Prev"
                  // renderOnZeroPageCount={null}
                />
              </div>

              {/* <!--/col-lg-9--> */}
            </div>
          </div>

          {/* <!--/row--> */}
        </div>
        {/* <button
          type="button"
          className="btn btn-primary"
          data-toggle="modal"
          data-target="#exampleModalLong"
        >
          Launch demo modal
        </button> */}
        <div
          className="modal fade"
          id="exampleModalLong"
          tabIndex="-1"
          role="dialog"
          aria-labelledby="exampleModalLongTitle"
          aria-hidden="true"
        >
          <div className="modal-dialog" role="document">
            <div className="modal-content">
              <div className="modal-header">
                <h5 className="modal-title" id="exampleModalLongTitle">
                  Modal title
                </h5>
                <button
                  type="button"
                  className="close product"
                  data-dismiss="modal"
                  aria-label="Close"
                >
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div className="modal-body product">
                <div className="product">
                  <div className="popup-title">
                    <div className="h3 title">
                      Heading
                      <small>Heading Category</small>
                    </div>
                  </div>
                  <Carousel responsive={responsive}>
                    <div>
                      <img src="/assets/images/item-1.jpg" alt="" width="640" />
                    </div>
                    <div>
                      <img src="/assets/images/item-2.jpg" alt="" width="640" />
                    </div>
                    <div>
                      <img src="/assets/images/item-3.jpg" alt="" width="640" />
                    </div>
                    <div>
                      <img src="/assets/images/item-4.jpg" alt="" width="640" />
                    </div>
                  </Carousel>

                  <div className="popup-content">
                    <div className="product-info-wrapper">
                      <div className="row">
                        <div className="col-sm-6 product">
                          <div className="info-box">
                            <strong>Manufacturer</strong>
                            <span>Brand name</span>
                          </div>
                          <div className="info-box">
                            <strong>Materials</strong>
                            <span>Wood, Leather, Acrylic</span>
                          </div>
                          <div className="info-box">
                            <strong>Availability</strong>
                            <span>
                              <i className="fa fa-check-square-o"></i> in stock
                            </span>
                          </div>
                        </div>

                        <div className="col-sm-6">
                          <div className="info-box">
                            <strong>Available Colors</strong>
                            <div className="product-colors clearfix">
                              <span className="color-btn color-btn-red"></span>
                              <span className="color-btn color-btn-blue checked"></span>
                              <span className="color-btn color-btn-green"></span>
                              <span className="color-btn color-btn-gray"></span>
                              <span className="color-btn color-btn-biege"></span>
                            </div>
                          </div>
                          <div className="info-box">
                            <strong>Choose size</strong>
                            <div className="product-colors clearfix">
                              <span className="color-btn color-btn-biege">
                                S
                              </span>
                              <span className="color-btn color-btn-biege checked">
                                M
                              </span>
                              <span className="color-btn color-btn-biege">
                                XL
                              </span>
                              <span className="color-btn color-btn-biege">
                                XXL
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div className="popup-table">
                    <div className="popup-cell">
                      <div className="price">
                        <span className="h3">
                          $ 1999,00 <small>$ 2999,00</small>
                        </span>
                      </div>
                    </div>
                    <div className="popup-cell">
                      <div className="popup-buttons">
                        <Link to="#">
                          <span className="icon icon-eye"></span>{" "}
                          <span className="hidden-xs">View more</span>
                        </Link>
                        <Link to="#">
                          <span className="icon icon-cart"></span>{" "}
                          <span className="hidden-xs">Buy</span>
                        </Link>
                      </div>
                    </div>
                  </div>

                  {/* </div> <!--/product--> */}
                </div>
              </div>
              {/* <div className="modal-footer">
                <button
                  type="button"
                  className="btn btn-secondary"
                  data-dismiss="modal"
                >
                  Close
                </button>
              </div> */}
            </div>
          </div>
        </div>
      </section>
      <Sonner />
    </>
  );
};

export default ProductList;
