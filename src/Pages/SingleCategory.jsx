import React, { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import { environmentUrl } from "../env/enviroment";
import { envImgUrl } from "../env/envImage";
import Loader from "../Components/Spinner/Loader";

const SingleCategory = () => {
  const [shopSubCategories, setShopSubCategories] = useState([]);
  const [category, setCategory] = useState({});
  const [loading, setLoading] = useState(false);

  const getSubCategories = async () => {
    try {
      setLoading(true);

      const windowUrl = window.location.search;
      const apiUrl = `${environmentUrl}/shop/getShopSubCategories.php${windowUrl}`;
      // console.log("params in url are===", apiUrl);
      const options = {
        method: "GET",
      };
      const subCategoriesFetch = await (await fetch(apiUrl, options)).json();
      const res = subCategoriesFetch?.response;
      setShopSubCategories(res);
      setCategory(subCategoriesFetch?.category);
    } catch (error) {
      console.log(error);
    } finally {
      setLoading(false);
    }
  };

  const [currentPage, setCurrentPage] = useState(1);
  const itemsPerPage = 10;

  const indexOfLastItem = currentPage * itemsPerPage;
  const indexOfFirstItem = indexOfLastItem - itemsPerPage;
  const currentItems = shopSubCategories.slice(
    indexOfFirstItem,
    indexOfLastItem
  );
  const totalPages = Math.ceil(shopSubCategories.length / itemsPerPage);

  const handlePageChange = (pageNumber) => {
    setCurrentPage(pageNumber);
    window.scrollTo({ top: 0, behavior: "smooth" });
  };

  const handlePrev = () => {
    if (currentPage > 1) setCurrentPage(currentPage - 1);
    window.scrollTo({ top: 0, behavior: "smooth" });
  };

  const handleNext = () => {
    if (currentPage < totalPages) setCurrentPage(currentPage + 1);
    window.scrollTo({ top: 0, behavior: "smooth" });
  };

  useEffect(() => {
    getSubCategories();
  }, []);
  console.log("shop sub cate are===", shopSubCategories);
  return (
    <>
      {loading && <Loader />}
      <div>
        <div className="bg-squares cat-hng hdng-mpn">
          <div className="singleBannerOuter">
            <img
              src={`${envImgUrl}/Uploads/category/${category?.banner_image}`}
              alt=""
              className="sofaBanner"
            />
            <div className="mt-33">
              <button className="cinzel-font cat-name">
                {category?.category_name}
              </button>
            </div>
          </div>
          <div>
            <section className="subCateSection">
              <div className="container singl-pg single-mblee single-cat-pn">
                <div className="row mb-5">
                  {/* {shopSubCategories.length > 0 ? (
                    shopSubCategories.map((item, index) => ( */}
                  {currentItems && currentItems.length > 0 ? (
                    currentItems.map((item, index) => (
                      <div className="singlecatgory" key={index}>
                        <Link
                          to={`/ecommercefilter?subCategory=${item?.subcategory_id}`}
                        >
                          {" "}
                          <div className="bg-greenish">
                            <div className="bg-design bg-design-rp bg-dsn-lgdk ">
                              <div className="img-set">
                                <img
                                  src={`${envImgUrl}/Uploads/subcategory/${item?.scategory_image}`}
                                  alt=""
                                />
                              </div>
                            </div>
                            <div>
                              <h6 className="mt-50">{item?.sub_category}</h6>
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
                            <img src="assets/images/noDataFound.png" alt="" />
                          </div>
                        </div>
                      </div>
                    </>
                  )}
                </div>

                {shopSubCategories.length > 0 && (
                  <div className="productPagination page-bg-btn-fil">
                    <div className="pgn-fltr prev-flt" onClick={handlePrev}>
                      Preview
                    </div>

                    <div className="numbers-main num-mn">
                      {(() => {
                        const pageButtons = [];
                        const visiblePages = 2;

                        for (let i = 1; i <= totalPages; i++) {
                          if (
                            i === 1 ||
                            i === totalPages ||
                            (i >= currentPage - visiblePages &&
                              i <= currentPage + visiblePages)
                          ) {
                            pageButtons.push(
                              <button
                                key={i}
                                className={`page-btns ${
                                  currentPage === i ? "grn-btn" : ""
                                }`}
                                onClick={() => handlePageChange(i)}
                              >
                                {i}
                              </button>
                            );
                          } else if (
                            (i === currentPage - visiblePages - 1 &&
                              currentPage - visiblePages > 2) ||
                            (i === currentPage + visiblePages + 1 &&
                              currentPage + visiblePages < totalPages - 1)
                          ) {
                            pageButtons.push(
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

                        return pageButtons;
                      })()}
                    </div>

                    <div className="pgn-fltr nxt-flt" onClick={handleNext}>
                      Next
                    </div>
                  </div>
                )}
              </div>
            </section>
          </div>
        </div>
      </div>
    </>
  );
};

export default SingleCategory;
