/* eslint-disable react-hooks/exhaustive-deps */
import { HiOutlineHeart } from "react-icons/hi2";
import { FaRegEye } from "react-icons/fa";
import { HiOutlineShoppingCart } from "react-icons/hi2";
import { IoList } from "react-icons/io5";
import { PiGridFourFill } from "react-icons/pi";
import { LuSlidersHorizontal } from "react-icons/lu";
import { Link } from "react-router-dom";
import {
  getBrandsMaster,
  getColorMaster,
  getMaterialMaster,
  getProductCategoryMaster,
  getProductsOnCategory,
} from "../../libs/endpoints";
import { useEffect, useState } from "react";
import { envImgUrl } from "../../env/envImage";
import { addToCart, addToWishlist } from "../../libs/endpoints";
import { RxCross2 } from "react-icons/rx";
import ReactPaginate from "react-paginate";
import { HiMiniChevronDown } from "react-icons/hi2";
import { RiArrowDropUpLine } from "react-icons/ri";
import Slider from "@mui/material/Slider";
import { environmentUrl } from "../../env/enviroment";
import { toast } from "sonner";
import Sonner from "../Toaster/Sonner";
import Loader from "../Spinner/Loader";

const ProductsGridView = () => {
  const [showFilter, setShowFilters] = useState(false);
  const [loading, setLoading] = useState(false);
  const showFilterDropDown = (event) => {
    console.log("click event id is====", event);
    setShowFilters(!showFilter);
  };

  const [productsGrid, setProductsGrid] = useState([]);
  const handleProductsGrid = async () => {
    const response = await getProductsOnCategory();
    // console.log("products grid view response is", response);
    setProductsGrid(response?.response);
  };
  useEffect(() => {
    handleProductsGrid();
  }, []);
  const categoryParams = window.location.search;
  console.log("category query params in product grid", categoryParams);

  console.log("products grid view===========", productsGrid);

  const handleAddToCart = async (eachProduct) => {
    console.log("product detail by clicking cart are", eachProduct);
    let response = await addToCart(eachProduct);

    if (response?.status == "warning") {
      toast.warning("Product Already Added To Cart");
    } else {
      if (response?.status) {
        toast.success("Successfully Added To Cart");
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
  const handleGridFilters = () => {
    let popupEle = document.getElementById("girdFilters");
    popupEle.classList.add("active");
  };
  const handlepopupClose = () => {
    let popupEle = document.getElementById("girdFilters");
    popupEle.classList.remove("active");
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

  useEffect(() => {
    handleColours();
    handleProductCategory();
    handleMaterialMaster();
    handleProductBrands();
  }, []);

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
        {/* <!--Header--> */}

        <header>
          <div className="bredcum">
            <img
              src="assets/images/img-7.jpg"
              alt="lightBanner"
              className="banner-content image_zoom"
            />
            <h2 className="mt-0 mb-0">Product grid category</h2>
          </div>
        </header>

        {/* <!--Content--> */}

        <div className="container">
          <div className="row">
            {/* <!--Left content--> */}

            <div className="col-12">
              {/* <!--Product filters--> */}

              <div className="filters filters-fixed" id="girdFilters">
                <div className="filter-scroll">
                  <div className="filter-header">
                    <span className="h4">Filter products</span>
                    <br />
                    Select your options
                  </div>
                  <hr />

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
                    {showFilter && (
                      <div className="filter-content" id="price filter">
                        <div className="price-filter">
                          <Slider
                            value={range}
                            onChange={handleChanges}
                            valueLabelDisplay="auto"
                            min={1000}
                            max={500000}
                          />
                          <p className="text-center">
                            {`Prince Range ₹ ${range[0]} - ${range[1]}`}
                          </p>
                        </div>
                      </div>
                    )}
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
                      {productCat.map((eachCat, index) => (
                        <span className="checkbox" key={index}>
                          <input
                            type="radio"
                            name="radiogroup-type"
                            id="typeIdAll"
                            checked="checked"
                          />
                          <label htmlFor="typeIdAll">
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
                      {materialMaster.map((each, index) => (
                        <span className="checkbox" key={index}>
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
                  <div className="filter-box">
                    <div
                      className="title products-filter"
                      onClick={showFilterDropDown}
                    >
                      Brands <RiArrowDropUpLine />
                      <HiMiniChevronDown />
                    </div>
                    <div className="filter-content">
                      {brands.map((eachBrand, index) => (
                        <span className="checkbox" key={index}>
                          <input
                            type="checkbox"
                            id={`materialMaster${eachBrand.brand_id}`}
                            name={`${eachBrand.enter_brand}Val`}
                            onChange={() => {
                              captureBrandMaster(eachBrand.brand_id);
                            }}
                            value={eachBrand.brand_id}
                          />

                          <label htmlFor="discountId1">
                            {eachBrand.enter_brand}
                          </label>
                        </span>
                      ))}
                    </div>
                  </div>

                  <button
                    type="button"
                    onClick={applyProductFilters}
                    className="btn- btn-primary"
                  >
                    Apply Filters
                  </button>
                </div>

                {/* <!-- Close filters on mobile / update filters--> */}

                <div
                  className="toggle-filters-close btn btn-circle"
                  onClick={handlepopupClose}
                >
                  <RxCross2 />
                </div>
              </div>
              {/* <!--/filters--> */}
            </div>

            {/* <!--Right content--> */}

            <div className="col-12">
              {/* <!--Sort bar--> */}

              <div className="sort-bar clearfix">
                <div className="sort-results pull-left">
                  {/* <!--Showing result per page--> */}

                  <select>
                    <option value="1">10</option>
                    <option value="2">50</option>
                    <option value="3">100</option>
                    <option value="4">All</option>
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
                    <option value="1">Name</option>
                    <option value="2">Popular items</option>
                    <option value="3">Price: lowest</option>
                    <option value="4">Price: highest</option>
                  </select>

                  {/* <!--Grid-list view--> */}

                  <span className="grid-list">
                    <Link to={`/productsGrid${categoryParams}`}>
                      <PiGridFourFill />
                    </Link>
                    <Link to={`/products${categoryParams}`}>
                      <IoList />
                    </Link>
                    <button
                      onClick={handleGridFilters}
                      className="toggle-filters-mobile grid-view-filter-icon"
                    >
                      <LuSlidersHorizontal />
                      <span
                        className="spinner-grow spinner-grow-sm text-warning"
                        role="status"
                        aria-hidden="true"
                      ></span>
                    </button>
                  </span>
                </div>
                {/* <!--/sort-options--> */}
              </div>

              {/* <!--Products collection--> */}

              <div className="row">
                {/* <!--Product item--> */}
                {productsGrid.map((eachGrid, index) => (
                  <div className="col-6 col-lg-4" key={index}>
                    <article>
                      <div className="info">
                        <span className="add-favorite">
                          <Link
                            to=""
                            data-title="Add to favorites"
                            data-title-added="Added to favorites list"
                          >
                            <HiOutlineHeart
                              onClick={() => {
                                handleAddToWishlist(eachGrid);
                              }}
                            />
                          </Link>
                        </span>
                        <span>
                          <Link
                            to=""
                            className="mfp-open"
                            data-title="Quick wiew"
                          >
                            <FaRegEye />
                          </Link>
                        </span>
                      </div>
                      <div className="btn btn-add">
                        <HiOutlineShoppingCart
                          onClick={() => {
                            handleAddToCart(eachGrid);
                          }}
                        />
                      </div>
                      <div className="figure-grid">
                        <span
                          className={`badge ${
                            eachGrid.productTag === "Offer"
                              ? "badge-danger"
                              : "badge-info"
                          }`}
                        >
                          {eachGrid.productTag}
                        </span>
                        <div className="image grid-image">
                          <Link
                            to={`/singleproduct?productId=${eachGrid.product_id}`}
                          >
                            <img
                              src={`${envImgUrl}/Uploads/products/${eachGrid.image_1}`}
                              alt={eachGrid.product_alttext}
                            />
                          </Link>
                        </div>
                        <div className="text">
                          <h2 className="title h4">
                            <Link
                              to={`/singleproduct?productId=${eachGrid.product_id}`}
                            >
                              {eachGrid.product_title}
                            </Link>
                          </h2>
                          <sub>₹ {eachGrid.product_mrp}/-</sub>
                          <sup>₹ {eachGrid.product_offerprice}/-</sup>
                          <span
                            className="description clearfix"
                            dangerouslySetInnerHTML={{
                              __html: eachGrid.product_description,
                            }}
                          ></span>
                        </div>
                      </div>
                    </article>
                  </div>
                ))}

                {/* <!--Product item--> */}
              </div>

              {/* <!--Pagination--> */}

              <div className="pagination-wrapper">
                <ReactPaginate
                  breakLabel="..."
                  nextLabel="next >"
                  pageRangeDisplayed={5}
                  previousLabel="< previous"
                  renderOnZeroPageCount={null}
                  pageCount={4}
                />
              </div>
            </div>
            {/* <!--/product items--> */}
          </div>
          {/* <!--/row--> */}
        </div>
      </section>
      <Sonner />
    </>
  );
};

export default ProductsGridView;
