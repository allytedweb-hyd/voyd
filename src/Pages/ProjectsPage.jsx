import { FaPhoneSquareAlt } from "react-icons/fa";
import { LuMessageCircle } from "react-icons/lu";
import { useSearchParams } from "react-router-dom";
import { useEffect, useState } from "react";
import { environmentUrl } from "../env/enviroment";
import { envImgUrl } from "../env/envImage";
import ReactStars from "react-rating-stars-component";
import Lightbox from "yet-another-react-lightbox";
import "yet-another-react-lightbox/styles.css";
import "yet-another-react-lightbox/plugins/thumbnails.css";
import Thumbnails from "yet-another-react-lightbox/plugins/thumbnails";
import Zoom from "yet-another-react-lightbox/plugins/zoom";
import Carousel from "react-multi-carousel";
import "react-multi-carousel/lib/styles.css";


const ProjectsPage = () => {
  const [selectedSlides, setSelectedSlides] = useState([]);
  const [prevProjects, setPrevProjects] = useState([]);
  const [prevProjectsCategory, setPrevProjectsCategory] = useState([]);
  const [searchParams] = useSearchParams();

  const [lightboxOpen, setLightboxOpen] = useState(false);
  const [lightboxIndex, setLightboxIndex] = useState(0);

  const [currentPage, setCurrentPage] = useState(1);
  const itemsPerPage = 12;

  const indexOfLastItem = currentPage * itemsPerPage;
  const indexOfFirstItem = indexOfLastItem - itemsPerPage;
  const paginatedProjects = prevProjects.slice(indexOfFirstItem, indexOfLastItem);

  const totalPages = Math.ceil(prevProjects.length / itemsPerPage);


  const responsive = {
    desktop: {
      breakpoint: { max: 3000, min: 1024 },
      items: 1,
    },
    tablet: {
      breakpoint: { max: 1024, min: 464 },
      items: 1,
    },
    mobile: {
      breakpoint: { max: 464, min: 0 },
      items: 1,
    },
  };




  // const slides = prevProjects.map((item) => ({
  //   src: `${envImgUrl}/Uploads/gallery/${item?.gallery_image}`,
  //   alt: item?.gallery_alttext || "Project Image",
  // }));

  // const slides = prevProjects.flatMap((item) =>
  //   Object.keys(item)
  //     .filter((key) => key.startsWith("gallery_image") && item[key])
  //     .map((key) => ({
  //       src: `${envImgUrl}/Uploads/gallery/${item[key]}`,
  //       alt: item?.gallery_alttext || "Project Image",
  //     }))
  // );


  const numberFormat = (value) =>
    new Intl.NumberFormat("en-IN", {
      currency: "INR",
      style: "currency",
    }).format(value);

  const getCategoryBasedProjects = async () => {
    const apiUrl = `${environmentUrl}/gallery/get.php?projectCategory=${searchParams.get(
      "projectCategory"
    )}`;
    const options = {
      method: "GET",
    };
    const response = await fetch(apiUrl, options);
    const fetchedData = await response.json();
    console.log("prev projects are====", fetchedData);
    if (fetchedData?.status) {
      setPrevProjects(fetchedData?.response?.prevProjects);
      setPrevProjectsCategory(fetchedData?.response?.previousProjectsCat);
    }
  };

  useEffect(() => {
    getCategoryBasedProjects();
  }, []);

  useEffect(() => {
    setCurrentPage(1);
  }, [prevProjects]);


  const handlePageChange = (page) => setCurrentPage(page);

  const handlePrevPage = () => {
    if (currentPage > 1) setCurrentPage((prev) => prev - 1);
  };

  const handleNextPage = () => {
    if (currentPage < totalPages) setCurrentPage((prev) => prev + 1);
  };


  return (
    // <div>
    //   <section className="aboutBanner1 sub">
    //     <div className="row">
    //       <div className="container">
    //         <div className="col-md-12">
    //           {/* <div>
    //             <h3 className="project-txt">Our Project At</h3>
    //           </div> */}
    //           <h1 className="jbedj capitalize">
    //             {prevProjectsCategory?.category_name}
    //           </h1>
    //         </div>
    //       </div>
    //     </div>
    //   </section>
    //   <section className="bg-lite">
    //     <div className="container">
    //       <div className="row previousRow">
    //         {prevProjects && prevProjects.length > 0 ? (
    //           prevProjects.map((item, index) => (
    //             <div className="  col-md-3 col-sm-6  mt-m-t" key={index}>
    //               <div className="cartCard">
    //                 <div className="text-center image">
    //                   <img
    //                     src={`${envImgUrl}/Uploads/gallery/${item?.gallery_image}`}
    //                     alt={item?.gallery_alttext}
    //                   />
    //                 </div>
    //                 <div className="previousInfo">
    //                   <div className="flexFlow">
    //                     <h3 title={numberFormat(item?.price)}>
    //                       {numberFormat(item?.price)}
    //                     </h3>
    //                     <div className="statRatings">
    //                       <ReactStars
    //                         count={5}
    //                         value={item?.rating}
    //                         size={18}
    //                         activeColor="#a6876a"
    //                         isHalf={true}
    //                         edit={false}
    //                       />
    //                     </div>
    //                   </div>
    //                   <div className="flexFlow">
    //                     <h5 title={prevProjectsCategory?.category_name}>
    //                       {prevProjectsCategory?.category_name}
    //                     </h5>
    //                     <h5 title={`Falt No-${item?.flat}`}>
    //                       Falt No-{item?.flat}
    //                     </h5>
    //                   </div>
    //                   <div className="flexFlow">
    //                     <div className="userInfo">
    //                       <img
    //                         src={`${envImgUrl}/Uploads/gallery/${item?.profile_img}`}
    //                         alt="img"
    //                       />
    //                       <div>
    //                         <h6 title={item?.customer_name}>
    //                           {item?.customer_name}
    //                         </h6>
    //                         <p>{item?.customer_status}</p>
    //                       </div>
    //                     </div>
    //                     <div>
    //                       <div className="d-flex align-items-center justify-content-center cont-in mt-2">
    //                         <FaPhoneSquareAlt />
    //                         <LuMessageCircle className="msg-icon" />
    //                       </div>
    //                     </div>
    //                   </div>
    //                 </div>
    //               </div>
    //             </div>
    //           ))
    //         ) : (
    //           <div className="container">
    //             <div className="row">
    //               <div className="result-container conditionImg">
    //                 <img src="assets/images/noDataFound.png" alt="" />
    //               </div>
    //             </div>
    //           </div>
    //         )}
    //       </div>
    //     </div>
    //   </section>
    // </div>

    <div>
      <section className="aboutBanner1 sub">
        <div className="row">
          <div className="container">
            <div className="col-md-12">
              <h1 className="jbedj capitalize">
                {prevProjectsCategory?.category_name}
              </h1>
            </div>
          </div>
        </div>
      </section>

      <section className="bg-lite">
        <div className="container">
          <div className="row previousRow">
            {paginatedProjects.length > 0 ? (
              paginatedProjects.map((item, index) => (
                <div className="col-md-3 col-sm-6 mt-m-t" key={index}>
                  <div className="cartCard">
                    <div className="text-center image project-images">
                      <Carousel
                        responsive={responsive}
                        infinite
                        autoPlay={true}
                        showDots={false}
                        arrows={false}
                        keyBoardControl


                      >
                        {/* {Object.keys(item)
                          .filter((key) => !isNaN(key) && key !== "0")
                          .map((key, i) => (
                            <img
                              key={i}
                              src={`${envImgUrl}/Uploads/gallery/${item[key]}`}
                              alt={`Project Image ${i + 1}`}
                              style={{ width: "100%", cursor: "pointer", maxHeight: "200px", objectFit: "cover" }}
                              onClick={() => {
                                setLightboxIndex(index + indexOfFirstItem);
                                setLightboxOpen(true);
                              }}
                            />
                          ))} */}
                        {Object.keys(item)
                          .filter((key) => key.startsWith("gallery_image") && item[key])
                          .map((key, i) => (
                            <img
                              key={i}
                              src={`${envImgUrl}/Uploads/gallery/${item[key]}`}
                              alt={`Project Image ${i + 1}`}
                              style={{
                                width: "100%",
                                cursor: "pointer",
                                maxHeight: "200px",
                                objectFit: "cover"
                              }}
                              onClick={() => {
                                const projectImages = Object.keys(item)
                                  .filter((key) => key.startsWith("gallery_image") && item[key])
                                  .map((key) => ({
                                    src: `${envImgUrl}/Uploads/gallery/${item[key]}`,
                                    alt: item?.gallery_alttext || "Project Image",
                                  }));

                                setSelectedSlides(projectImages);
                                setLightboxIndex(0);
                                setLightboxOpen(true);
                              }}

                            />
                          ))}

                      </Carousel>
                    </div>

                    <div className="previousInfo">
                      <div className="flexFlow">
                        <h3 title={numberFormat(item?.price)}>
                          {numberFormat(item?.price)}
                        </h3>
                        <div className="statRatings">
                          <ReactStars
                            count={5}
                            value={item?.rating}
                            size={18}
                            activeColor="#a6876a"
                            isHalf={true}
                            edit={false}
                          />
                        </div>
                      </div>
                      <div className="flexFlow">
                        <h5 title={prevProjectsCategory?.category_name}>
                          {prevProjectsCategory?.category_name}
                        </h5>
                        <h5 title={`Flat No-${item?.flat}`}>
                          Flat No-{item?.flat}
                        </h5>
                      </div>
                      <div className="flexFlow">
                        <div className="userInfo">
                          <img
                            src={`${envImgUrl}/Uploads/gallery/${item?.profile_img}`}
                            alt="img"
                          />
                          <div>
                            <h6 title={item?.customer_name}>
                              {item?.customer_name}
                            </h6>
                            <p>{item?.customer_status}</p>
                          </div>
                        </div>
                        <div>
                          <div className="d-flex align-items-center justify-content-center cont-in mt-2">
                            <FaPhoneSquareAlt />
                            <LuMessageCircle className="msg-icon" />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
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
          </div>


          {prevProjects.length > 0 && (
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
                          className={`page-btns ${currentPage === i ? "grn-btn" : ""
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

      {/* <Lightbox
        open={lightboxOpen}
        index={lightboxIndex}
        close={() => setLightboxOpen(false)}
        slides={slides}
        plugins={[Thumbnails, Zoom]}
      /> */}
      <Lightbox
        open={lightboxOpen}
        index={lightboxIndex}
        close={() => setLightboxOpen(false)}
        slides={selectedSlides}
        plugins={[Thumbnails, Zoom]}
      />
    </div>

  );
};

export default ProjectsPage;
