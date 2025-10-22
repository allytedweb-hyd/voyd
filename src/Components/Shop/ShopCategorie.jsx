import { useState } from "react";
import { useEffect } from "react";
import AOS from "aos";
import "aos/dist/aos.css";
import { HiOutlineArrowSmRight } from "react-icons/hi";
import { useRef } from "react";
import { Link } from "react-router-dom";
import "react-multi-carousel/lib/styles.css";
import { environmentUrl } from "../../env/enviroment";
import { envImgUrl } from "../../env/envImage";
import { useDispatch } from "react-redux";
import { useSelector } from "react-redux";
import { setActiveTab } from "../../redux/slices/shopCategorySlice";
import Loader from "../Spinner/Loader";
import NewArrivals from "./NewArrivals";
import SuperSale from "./SuperSale";
import { toast } from "sonner";
import Sonner from "../Toaster/Sonner";
import { useNavigate } from "react-router-dom";
import { ImSearch } from "react-icons/im";

const ShopCategorie = () => {
  const carouselRef = useRef(null);
  const navigate = useNavigate();
  const dispatch = useDispatch();
  const activeTab = useSelector((state) => state.tab.value);
  const [shopCategories, setShopCategories] = useState([]);
  const [loading, setLoading] = useState(true);
  const [propertyBlocks, setPropertyBlocks] = useState([]);

  const handlePrev = () => {
    if (carouselRef.current) {
      carouselRef.current.previous();
    }
  };
  useEffect(() => {
    AOS.init({
      duration: 1000, // animation duration in ms
      once: true, // whether animation should happen only once - while scrolling down
    });
  }, []);

  const handleNext = () => {
    if (carouselRef.current) {
      carouselRef.current.next();
    }
  };
  // const [activeTab, setActiveTab] = useState("room");

  const getShopCategories = async () => {
    try {
      setLoading(true);

      const apiUrl = `${environmentUrl}/shop/getShopCategories.php`;
      const options = {
        method: "GET",
      };
      const shopfetch = await fetch(apiUrl, options);
      const shopCatRes = await shopfetch.json();
      const res = shopCatRes?.response;
      setShopCategories(res);
    } catch (error) {
      console.log(error);
    } finally {
      setLoading(false);
    }
  };

  const getAllPropertyBlocks = async () => {
    try {
      setLoading(true);
      const apiUrl = `${environmentUrl}/questionnaire/getPropertyBlock.php`;
      const options = {
        method: "GET",
      };
      const response = await fetch(apiUrl, options);
      const fetchedData = await response.json();
      const propertyBlockData = fetchedData?.response;
      setPropertyBlocks(propertyBlockData);
    } catch (error) {
      console.log(error);
    } finally {
      setLoading(false);
    }
  };

  const handleShopByRoom = (room) => {
    const found = propertyBlocks.find((item) =>
      item.enter_section.toLowerCase().includes(room.toLowerCase())
    );
    console.log("property block is===", found?.enter_section);
    if (found?.enter_section == undefined) {
      toast.warning("Category Not Found");
    } else {
      navigate(`/ecommercefilter?category=${found?.section_id}`);
    }
  };

  const quotesPerPage = 10;

  const [quoteCurrentPage, setQuoteCurrentPage] = useState(1);

  const quoteIndexLast = quoteCurrentPage * quotesPerPage;
  const quoteIndexFirst = quoteIndexLast - quotesPerPage;

  const currentQuotes = shopCategories.slice(quoteIndexFirst, quoteIndexLast);

  const quoteTotalPages = Math.ceil(shopCategories.length / quotesPerPage);

  const handleQuotePageChange = (pageNumber) => {
    setQuoteCurrentPage(pageNumber);
    window.scrollTo({ top: 0, behavior: "smooth" });
  };

  const handleQuotePrev = () => {
    if (quoteCurrentPage > 1) setQuoteCurrentPage(quoteCurrentPage - 1);
    window.scrollTo({ top: 0, behavior: "smooth" });
  };

  const handleQuoteNext = () => {
    if (quoteCurrentPage < quoteTotalPages)
      setQuoteCurrentPage(quoteCurrentPage + 1);
    window.scrollTo({ top: 0, behavior: "smooth" });
  };

  useEffect(() => {
    async function catgeories() {
      await getShopCategories();
      await getAllPropertyBlocks();
      setLoading(false);
    }
    catgeories();
  }, []);
  console.log("shop categories===", shopCategories);

  return (
    <>
      {loading && <Loader />}
      <div className="bg-shp shp-tab shp-phn pos-rel">
        <div className="exploteTxt">Explore Our Products</div>
        <div>
          <img
            src="assets/images/Group 1618873316.png"
            alt=""
            className="gold-pos"
          />
        </div>
      </div>

      <section className="pt-0 shp-section">
        <div className="container">
          <div className="">
            <div className="toggle-tabs-container">
              <div className="toggle-buttons">
                <button
                  onClick={() => dispatch(setActiveTab("room"))}
                  className={`toggle-btn ${
                    activeTab === "room" ? "active-left" : ""
                  }`}
                  type="button"
                >
                  Shop by Room
                </button>
                <div className="divider-ct2"></div>

                <button
                  onClick={() => dispatch(setActiveTab("category"))}
                  className={`toggle-btn ${
                    activeTab === "category" ? "active-right" : ""
                  }`}
                  type="button"
                >
                  Shop by Category
                </button>
              </div>

              <div className="searchProduct">
                <form action="">
                  <input type="text" placeholder="Search Products" />
                  <ImSearch />
                </form>
              </div>

              <div className="tab-content width">
                {activeTab === "room" ? (
                  <div>
                    <section className="r-shp-pdng ">
                      <div className="container">
                        <div className="row row-shop shop-by-room rr">
                          <div className="col-md-6 col-sm-12 room-block-a aa">
                            <div className="cate-box shpCateTab cg-shp cb-1">
                              <div className="shpByCate  shp-byBG">Shop by</div>
                              <div>
                                <h1 className="shp-cat-txt">Living Room</h1>
                              </div>
                              <div>
                                <button
                                  className=" text-light shop-butn living-shop"
                                  type="button"
                                  onClick={() => handleShopByRoom("Living")}
                                >
                                  SHOP NOW{" "}
                                  <HiOutlineArrowSmRight className="arow-siz" />
                                </button>
                              </div>
                              <div className="sofa-pos">
                                <img
                                  src="assets/images/Group 1566.png"
                                  alt=""
                                  className="with-50 wi-big"
                                />
                              </div>
                            </div>
                          </div>

                          <div className="col-md-3 col-sm-6 tb-tp hff-t first room-block-b">
                            <div className="cate-box1 cateTab1 cb-2 df-pnh">
                              <div>
                                <div className="font-monsrt shp-by1 shp-One">
                                  Shop by
                                </div>
                                <div>
                                  <h2 className="shp-cat-txt1">Bedroom</h2>
                                </div>
                                <div>
                                  <button
                                    className=" text-light shop-butn bedroom-shop"
                                    type="button"
                                    onClick={() => handleShopByRoom("bedroom")}
                                  >
                                    SHOP NOW{" "}
                                    <HiOutlineArrowSmRight className="arow-siz" />
                                  </button>
                                </div>
                              </div>

                              <div className="cot-pdng wi-sm">
                                <img
                                  src="assets/images/16245 1.png"
                                  alt=""
                                  className="width-100 "
                                />
                              </div>
                            </div>
                          </div>

                          <div className="col-md-3 col-sm-6 tb-tp hff-t second room-block-c">
                            <div className="cate-box1 cateTab1 cb-3 df-pnh">
                              <div>
                                <div
                                  className="font-monsrt shp-by1 shp-Two 
                            "
                                >
                                  Shop by
                                </div>
                                <div>
                                  <h2 className="shp-cat-txt1">
                                    Office Essentials
                                  </h2>
                                </div>
                                <div>
                                  <button
                                    className=" text-light shop-butn officeEssentials-shop"
                                    type="button"
                                    onClick={() => handleShopByRoom("office")}
                                  >
                                    SHOP NOW{" "}
                                    <HiOutlineArrowSmRight className="arow-siz" />
                                  </button>
                                </div>
                              </div>

                              <div className="thirdC">
                                <img
                                  src="assets/images/KJHGF.png"
                                  alt=""
                                  className="w-80 wi-sm ofc"
                                />
                              </div>
                            </div>
                          </div>
                        </div>
                        <div className="row row-shpTwo shp-phon shop-by-room">
                          <div className="col-md-3 col-sm-6 tb-bm hff-t room-block-c">
                            <div className="cate-box1 cateTab1 cb-4 df-pnh">
                              <div>
                                <div className="font-monsrt shp-by1 shp-Three">
                                  Shop by
                                </div>
                                <div>
                                  <h2 className="shp-cat-txt1 ">Kids Room</h2>
                                </div>
                                <button
                                  className=" text-light shop-butn kidsroom-shop"
                                  type="button"
                                  onClick={() => handleShopByRoom("kidsroom")}
                                >
                                  SHOP NOW{" "}
                                  <HiOutlineArrowSmRight className="arow-siz" />
                                </button>
                              </div>

                              <div className="d-flex smallBoxCenter">
                                <img
                                  src="assets/images/pair-blue-running-sneakers-white-background-isolated 1.png"
                                  alt=""
                                  className="w-80 wi-sm kds"
                                />
                              </div>
                            </div>
                          </div>

                          <div className="col-md-3 col-sm-6 tb-bm hff-t room-block-b">
                            <div className="cate-box1 cateTab1 cb-5 df-pnh">
                              <div>
                                <div
                                  className="font-monsrt shp-by1  g-color
                          "
                                >
                                  Shop by
                                </div>
                                <div>
                                  <h2 className="shp-cat-txt1 text-start ">
                                    Kitchen & <br /> Dining
                                  </h2>
                                </div>
                                <button
                                  className=" text-light shop-butn kitchenroom-shop"
                                  type="button"
                                  onClick={() => handleShopByRoom("kitchen")}
                                >
                                  SHOP NOW{" "}
                                  <HiOutlineArrowSmRight className="arow-siz" />
                                </button>
                              </div>

                              <div className="d-flex smallBoxCenter">
                                <img
                                  src="assets/images/alejandrao_httpss.mj 1.png"
                                  alt=""
                                  className="with-50 wi-sm"
                                />
                              </div>
                            </div>
                          </div>

                          <div className="col-md-6 col-sm-12 cate-box shpCateTab cg-shp cb-6 col-sm-6 room-block-a lastLb">
                            <div className="row bigCardsRow">
                              <div className="col-md-7 col-sm-7">
                                <div className="">
                                  <div className="font-monsrt j-color shpByCate  shp-byBG1">
                                    Shop by
                                  </div>
                                  <div>
                                    <h1 className="shp-cat-txt">Balcony</h1>
                                  </div>
                                  <div>
                                    <button
                                      className=" text-light shop-butn mt m-ress bg-mrn"
                                      type="button"
                                      onClick={() =>
                                        handleShopByRoom("balcony")
                                      }
                                    >
                                      SHOP NOW{" "}
                                      <HiOutlineArrowSmRight className="arow-siz" />
                                    </button>
                                  </div>
                                </div>
                              </div>
                              <div className="col-md-5 col-sm-5 ">
                                <div className="j-ends j-top">
                                  <img
                                    src="assets/images/Rectangle 2 (1).png"
                                    alt=""
                                    className="with-88 wi-big"
                                  />
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </section>

                    <SuperSale />
                    <NewArrivals />
                  </div>
                ) : (
                  <div>
                    <div>
                      <div className="pos-rel">
                        <img
                          src="assets/images/Group 1618873316 (1).png"
                          alt=""
                          className="shine-img"
                        />
                      </div>
                      <section className="grass-sec grss-moble">
                        <div className="container">
                          <div className="row">
                            <h1 className="sh-txt">Shop By Category</h1>
                          </div>
                          <div className="group-cate">
                            {/* {shopCategories.length > 0 ? (
                              shopCategories.map((item, index) => ( */}
                            {currentQuotes && currentQuotes.length > 0 ? (
                              currentQuotes.map((item, index) => (
                                <div
                                  className="cate-outer cursor-pointer"
                                  key={index}
                                >
                                  <Link
                                    to={`/singlecategory?category=${item?.category_id}`}
                                  >
                                    <div className="bg-grass">
                                      <div className="grasssInner">
                                        <img
                                          src={`${envImgUrl}/Uploads/category/${item?.category_image}`}
                                          alt=""
                                          className="mt-2 "
                                        />
                                      </div>
                                      <div className="grass-txt">
                                        <div className="G-First">
                                          {item?.category_name}
                                        </div>
                                        <div className="G-Midle">
                                          {item?.offer}
                                        </div>
                                        <div className="G-First">Shop Now</div>
                                      </div>
                                    </div>
                                  </Link>
                                </div>
                              ))
                            ) : (
                              <>
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
                              </>
                            )}
                          </div>
                          {shopCategories.length > 0 && (
                            <div className="productPagination page-bg-btn-fil">
                              <div
                                className="pgn-fltr prev-flt"
                                onClick={handleQuotePrev}
                              >
                                Preview
                              </div>
                              <div className="numbers-main num-mn">
                                {(() => {
                                  const quotePageButtons = [];
                                  const quoteVisiblePages = 2;

                                  for (let i = 1; i <= quoteTotalPages; i++) {
                                    if (
                                      i === 1 ||
                                      i === quoteTotalPages ||
                                      (i >=
                                        quoteCurrentPage - quoteVisiblePages &&
                                        i <=
                                          quoteCurrentPage + quoteVisiblePages)
                                    ) {
                                      quotePageButtons.push(
                                        <button
                                          key={i}
                                          className={`page-btns ${
                                            quoteCurrentPage === i
                                              ? "grn-btn"
                                              : ""
                                          }`}
                                          onClick={() =>
                                            handleQuotePageChange(i)
                                          }
                                        >
                                          {i}
                                        </button>
                                      );
                                    } else if (
                                      (i ===
                                        quoteCurrentPage -
                                          quoteVisiblePages -
                                          1 &&
                                        quoteCurrentPage - quoteVisiblePages >
                                          2) ||
                                      (i ===
                                        quoteCurrentPage +
                                          quoteVisiblePages +
                                          1 &&
                                        quoteCurrentPage + quoteVisiblePages <
                                          quoteTotalPages - 1)
                                    ) {
                                      quotePageButtons.push(
                                        <button
                                          key={`ellipsis-${i}`}
                                          className="page-btns"
                                          disabled
                                        >
                                          ...
                                        </button>
                                      );
                                    }
                                  }

                                  return quotePageButtons;
                                })()}
                              </div>
                              <div
                                className="pgn-fltr nxt-flt"
                                onClick={handleQuoteNext}
                              >
                                Next
                              </div>
                            </div>
                          )}
                        </div>
                      </section>
                    </div>
                  </div>
                )}
              </div>
            </div>
          </div>
        </div>
      </section>
      <Sonner />
    </>
  );
};

export default ShopCategorie;
