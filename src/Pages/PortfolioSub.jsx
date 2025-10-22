/* eslint-disable react/jsx-key */
import { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import { environmentUrl } from "../env/enviroment";
import { envImgUrl } from "../env/envImage";

import { GoArrowUpRight } from "react-icons/go";

const PortfolioSub = () => {
  const [galleryCat, setGalleryCat] = useState([]);

  const [currentPage, setCurrentPage] = useState(1);
  const itemsPerPage = 12;

  const getGalleryCat = async () => {
    const apiUrl = `${environmentUrl}/gallery/getCategories.php`;
    const options = {
      method: "GET",
    };
    const response = await fetch(apiUrl, options);
    const fetchedData = await response.json();
    if (fetchedData?.status) {
      setGalleryCat(fetchedData?.response);
    }
  };


  const indexOfLastItem = currentPage * itemsPerPage;
  const indexOfFirstItem = indexOfLastItem - itemsPerPage;
  const paginatedData = galleryCat.slice(indexOfFirstItem, indexOfLastItem);
  const totalPages = Math.ceil(galleryCat.length / itemsPerPage);

  const handlePageChange = (page) => setCurrentPage(page);
  const handlePrevPage = () => {
    if (currentPage > 1) setCurrentPage((prev) => prev - 1);
  };
  const handleNextPage = () => {
    if (currentPage < totalPages) setCurrentPage((prev) => prev + 1);
  };

  useEffect(() => {
    getGalleryCat();
  }, []);
  useEffect(() => {
    setCurrentPage(1);
  }, [galleryCat]);
  // console.log("gallery categories are====", galleryCat);

  return (
    <>
      {/* <section className="protfoliosub pt-0 pt-0 mt--125">
        <div className="bredcum">
          <img
            src="assets/images/img-11.jpg"
            alt="lightBanner"
            className="banner-content image_zoom"
          />
          <h2 className="mt-0 mb-0">Portfolio</h2>
        </div>

        <div className="container mt-5">
          <h2 className="heading text-center">Portfolio</h2>
          <p className="text-center">We just keep things minimal.</p>
          <div className="gallery-image">
            {galleryCat.map((eachImage, index) => (
              <div className="img-box" key={index}>
                <img
                  src={`${envImgUrl}/Uploads/galleryMaster/${eachImage?.category_banner}`}
                  alt={eachImage?.banner_alt_text}
                  key={eachImage?.gcategory_id}
                />
                <div className="transparent-box">
                  <div className="caption1">
                    <div>
                      <p>{eachImage?.category_name}</p>
                      <p className="opacity-low">Cinematic</p>
                    </div>
                    <Link
                      to={`/portfolioSingle?galleryCategory=${eachImage?.category_name}`}
                    >
                      <button
                        className="sub-navigation"
                        onClick={getCategoryImage(eachImage?.category_name)}
                      >
                        view more <BsArrowRightShort className="nav-icon" />
                      </button>
                    </Link>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section> */}
      <section className="aboutBanner1 breadCrum">
        <div className="row">
          <div className="container">
            {/* <div className="col-md-6"> */}
            {/* <div>
                <h3 className="project-txt">Our Project At</h3>
              </div> */}
            <h1 className="jbedj">Our Previous Projects</h1>
            {/* </div> */}
          </div>
        </div>
      </section>
      <section className="categoriesCardsSection">
        <div className="container">
          <div className="row">
            {/* {galleryCat &&
              galleryCat.map((eachImage, index) => (
                <div className="  col-lg-3 col-md-4 col-sm-6" key={index}>
                  <div className="cateCard">
                    <div className="image">
                      <img
                        src={`${envImgUrl}/Uploads/galleryMaster/${eachImage?.category_banner}`}
                        alt="image"
                      />
                    </div>
                    <div className="details " title={eachImage?.category_name}>
                      <h5>{eachImage?.category_name}</h5>
                      <Link
                        to={`/projectspage?projectCategory=${eachImage?.gcategory_id}`}
                      >
                        ViewMore <GoArrowUpRight />
                      </Link>
                      <Link to={`/singleProject`}>
                        ViewOne <GoArrowUpRight />
                      </Link>
                    </div>
                  </div>
                </div>
              ))} */}

            {paginatedData && paginatedData.length > 0 ? (
              paginatedData.map((eachImage, index) => (
                <div className="col-lg-3 col-md-4 col-sm-6" key={index}>
                  <div className="cateCard">
                    <div className="image">
                      <img
                        src={`${envImgUrl}/Uploads/galleryMaster/${eachImage?.category_banner}`}
                        alt={eachImage?.banner_alt_text || "image"}
                      />
                    </div>
                    <div className="details" title={eachImage?.category_name}>
                      <h5>{eachImage?.category_name}</h5>
                      <Link
                        to={`/projectspage?projectCategory=${eachImage?.gcategory_id}`}
                      >
                        ViewMore <GoArrowUpRight />
                      </Link>
                    </div>
                  </div>
                </div>
              ))
            ) : (
              <div className="text-center py-5">
                <img src="/assets/images/noDataFound.png" alt="No Data" />
              </div>
            )}

          </div>

          {galleryCat.length > 0 && (
            <div className="productPagination page-bg-btn-fil text-center mt-4">
              <div className="pgn-fltr prev-flt" onClick={handlePrevPage}>
                Previous
              </div>

              <div className="numbers-main num-mn d-inline-block d-flex">
                {(() => {
                  const buttons = [];
                  const visiblePages = 2;

                  for (let i = 1; i <= totalPages; i++) {
                    if (
                      i === 1 ||
                      i === totalPages ||
                      (i >= currentPage - visiblePages &&
                        i <= currentPage + visiblePages)
                    ) {
                      buttons.push(
                        <button
                          key={i}
                          className={`page-btns ${currentPage === i ? "grn-btn" : ""}`}
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
                      buttons.push(
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

                  return buttons;
                })()}
              </div>

              <div className="pgn-fltr nxt-flt" onClick={handleNextPage}>
                Next
              </div>
            </div>
          )}


        </div>
      </section>
    </>
  );
};

export default PortfolioSub;
