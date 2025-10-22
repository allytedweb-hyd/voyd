import { GoArrowUpRight } from "react-icons/go";
import Carousel from "react-multi-carousel";

import { useRef } from "react";
import { Link } from "react-router-dom";
import { environmentUrl } from "../../env/enviroment";
import { useState, useEffect } from "react";
import { envImgUrl } from "../../env/envImage";
import Loader from "../Spinner/Loader";

import { LiaLongArrowAltLeftSolid } from "react-icons/lia";
import { LiaLongArrowAltRightSolid } from "react-icons/lia";

const ProductPopup = () => {
  const [prevProjects, setPrevProjects] = useState([]);
  const [loading, setLoading] = useState(true);

  const getPrevProjects = async () => {
    try {
      const apiUrl = `${environmentUrl}/gallery/getLimited.php`;
      const options = {
        method: "GET",
      };
      const response = await fetch(apiUrl, options);
      const fetchedRes = await response.json();
      console.log("prev projects are====", fetchedRes);
      if (response?.status) {
        setPrevProjects(fetchedRes?.response);
      } else {
        setPrevProjects([]);
      }
    } catch (error) {
      console.log(error);
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    async function project() {
      await getPrevProjects();
      setLoading(false);
    }
    project();
  }, []);

  const carouselRef = useRef(null);
  const responsive = {
    superLargeDesktop: {
      // the naming can be any, depends on you.
      breakpoint: { max: 4000, min: 3000 },
      items: 4,
    },
    desktop: {
      breakpoint: { max: 3000, min: 1024 },
      items: 4,
    },
    tablet: {
      breakpoint: { max: 1024, min: 464 },
      items: 3,
    },
    mobile: {
      breakpoint: { max: 464, min: 0 },
      items: 2,
    },
  };
  const goToPrev = () => {
    carouselRef.current.previous(); // Move to the previous slide
  };

  const goToNext = () => {
    carouselRef.current.next(); // Move to the next slide
  };
  return (
    <>
      {/* <div className="popup-main mfp-hide" id="productid1">
        
        <div className="product">
         

          <div className="popup-title">
            <div className="h3 title">
              Modern sofa
              <small>product category</small>
            </div>
          </div>

      

          <div className="owl-product-gallery owl-theme owl-carousel">
            <img src="assets/images/item-1.jpg" alt="" width="640" />
            <img src="assets/images/item-2.jpg" alt="" width="640" />
          </div>

        

          <div className="popup-content">
            <div className="product-info-wrapper">
              <div className="row">
               

                <div className="col-sm-6">
                  <div className="info-box">
                    <strong>Maifacturer</strong>
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
                      <span className="color-btn color-btn-biege">S</span>
                      <span className="color-btn color-btn-biege checked">
                        M
                      </span>
                      <span className="color-btn color-btn-biege">XL</span>
                      <span className="color-btn color-btn-biege">XXL</span>
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
                  ₹ 1999,00 <small>₹ 2999,00</small>
                </span>
              </div>
            </div>
            <div className="popup-cell">
              <div className="popup-buttons">
                <a href="product.html">
                  <span className="icon icon-eye"></span><span className="allCircle"></span>
                  <span className="hidden-xs">View more</span>
                </a>
                <a href="javascript:void(0);">
                  <span className="icon icon-cart"></span><span className="allCircle"></span>
                  <span className="hidden-xs">Buy</span>
                </a>
              </div>
            </div>
          </div>
        </div>
    
      </div> */}
      {loading && <Loader />}
      <section className="">
        <div className="broughtLifeOuter gapping">
          <div className="clocking res-none">
            <img src="assets/images/rb_125482 1.png" alt="" className="" />
          </div>
          <div className="container curveContainer">
            <div className="row pb-5 res-pb ">
              <div className=" widthFit col-md-8 col-sm-8">
                <div className="d-flex">
                  <div>
                    <h1 className="creation-txtd title">SPACES WE&apos;VE</h1>
                    <span className="allCircle"></span>
                  </div>
                  <div className="sofa-lampdiv">
                    <img src="assets/images/Group 11228 (1).png" alt="" />
                  </div>
                </div>
                <div className="d-flex">
                  <div>
                    <span className="allCircle"></span>
                    <h1 className="creation-txtd title">BROUGHT TO</h1>
                  </div>
                  <div>
                    <h1 className="handover-txtd life">Life</h1>
                  </div>
                </div>
              </div>
              <div className="widthFit col-md-4 col-sm-4 fex-colum cursor-pointer">
                <Link to="/portfolioCategories">
                  <div className="d-flex tab-end">
                    <div className="d-flex align-items-center">
                      <div className="line"></div>
                    </div>
                    <div className="arrow-line p-4 j-end">
                      <span className="allViewText">VIEW ALL </span>
                      <span className="span-arrow">
                        <GoArrowUpRight />
                      </span>
                    </div>
                  </div>
                </Link>
              </div>
            </div>
            <div className="vector-pos res-none">
              <div>
                <img src="assets/images/Vector 2.png" alt="" />
              </div>
            </div>
            <div className="row carouselRow">
              <div className="col-md-2 align-items-center d-flex justify-content-center">
                <div className="d-flex">
                  {/* Previous Arrow */}
                  <div className="shiftingArrows">
                    {/* <PiArrowCircleLeftThin
                      className="arrow-dir cursor-pointer"
                      onClick={goToPrev}
                    /> */}
                    <div onClick={goToPrev}>
                      {/* <img src="assets/images/arrowrightt.png" alt="" /> */}
                      <LiaLongArrowAltLeftSolid />
                    </div>
                  </div>
                  {/* Next Arrow */}
                  <div className="shiftingArrows">
                    {/* <PiArrowCircleRightThin
                      className="arrow-dir cursor-pointer"
                      onClick={goToNext}
                    /> */}
                    <div onClick={goToNext}>
                      {/* <img src="assets/images/arrowleftt.png" alt="" /> */}
                      <LiaLongArrowAltRightSolid />
                    </div>
                  </div>
                </div>
              </div>
              <div className="col-md-10 p-0">
                <div className="d-flex gp-10 car-sel">
                  <Carousel
                    ref={carouselRef} // Attach the reference to the carousel
                    responsive={responsive}
                    autoPlay={true}
                    autoPlaySpeed={1000000}
                    infinite={true}
                    swipeable={true}
                    arrows={false} // Disable the default arrows
                    rtl={true} // Optional: Right-to-left (change this as per your design)
                  >
                    {prevProjects.length > 0 ? (
                      prevProjects.map((eachProject, index) => (
                        <div className="carousel-image proCarousel" key={index}>
                          <img
                            src={`${envImgUrl}/Uploads/gallery/${eachProject?.gallery_image}`}
                            alt=""
                          />
                        </div>
                      ))
                    ) : (
                      <div className="container">
                        <div className="row">
                          <div className="result-container conditionImg">
                            <img src="assets/images/noDataFound.png" alt="" />
                          </div>
                        </div>
                      </div>
                    )}
                    {!prevProjects && <p>No Data Found</p>}
                  </Carousel>
                </div>
              </div>
            </div>
            <div className="row leafsRow">
              <div className="col-md-6">
                <div className="row res-none">
                  <div className="col-md-4">
                    <div>
                      <img
                        src="assets/images/haren_Render_a_highly_detailed_glossy_leaf_on_a_smooth_branch 2.png"
                        alt=""
                      />
                    </div>
                  </div>
                  <div className="col-md-4">
                    <span className="allCircle"></span>
                    <div>
                      <img
                        src="assets/images/haren_Render_a_highly_detailed_glossy_leaf_on_a_smooth_branch 1.png"
                        alt=""
                        className="leaf-2"
                      />
                    </div>
                  </div>
                  <div className="col-md-4">
                    <span className="allCircle"></span>
                    <div>
                      <img
                        src="assets/images/haren_Render_a_highly_detailed_glossy_leaf_on_a_smooth_branch 3.png"
                        alt=""
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </>
  );
};

export default ProductPopup;
