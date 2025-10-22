import { useEffect, useState } from "react";
import { environmentUrl } from "../env/enviroment";
import { envImgUrl } from "../env/envImage";
// import { TiArrowRight } from "react-icons/ti";
import { FaArrowRight } from "react-icons/fa6";
import GuidesPdfPopup from "../Components/Popups/GuidesPdfPopup";

const GuidesPage = () => {
  const [pdfPopup, setPdfPopup] = useState(false);
  const [file, setFile] = useState(null);

  const onClosePdfPopup = () => {
    setPdfPopup(false);
  };

  const [guides, setGuides] = useState([]);
  const getGuides = async () => {
    const apiUrl = `${environmentUrl}/guides/get.php`;
    const options = {
      method: "GET",
    };
    const response = await fetch(apiUrl, options);
    const fetchedData = await response.json();
    if (fetchedData?.status) {
      setGuides(fetchedData?.response);
    }
  };
  const downloadGuidePdf = (pdfFile) => {
    setFile(pdfFile);
    setPdfPopup(true);
  };

  const [currentPage, setCurrentPage] = useState(1);
  const itemsPerPage = 16;

  const indexOfLastItem = currentPage * itemsPerPage;
  const indexOfFirstItem = indexOfLastItem - itemsPerPage;
  const currentItems = guides.slice(indexOfFirstItem, indexOfLastItem);
  const totalPages = Math.ceil(guides.length / itemsPerPage);

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
    getGuides();
  }, []);
  return (
    <div>
      <section className="bannertwo bannerGuid banner-style banner-mob">
        <div className="container guide-con">
          <div className="row">
            <div className="col-md-6 col-sm-6 guides-column">
              <h1 className="room-txt">Room-by-Room</h1>
              <h1 className="guide-teext">Guides</h1>
              <h5 className="guideSubTxt">-Design Every Corner Right</h5>
            </div>
            <div className="col-md-6 col-sm-6 guides-column">
              <div className="cardss-ad">
                <img src="assets/images/Group 1618874324.png" alt="" />
              </div>
            </div>
          </div>
        </div>
      </section>
      <section className="bg-skyy guidesSection">
        <div className="container">
          <div className="row guidesRow">
            {currentItems && currentItems.length > 0 ? (
              currentItems.map((guide, index) => (
                <div className="col-lg-3 col-md-4 col-sm-6" key={index}>
                  <div className="pdfCard guidCard">
                    <div className="pdfImg">
                      <img
                        src={`${envImgUrl}/Uploads/guides/${guide?.image}`}
                        alt="image"
                      />
                    </div>
                    <div className="b-contn">
                      <h4>{guide?.title}</h4>
                      <span
                        className="description"
                        dangerouslySetInnerHTML={{ __html: guide?.description }}
                      ></span>

                      <div className="pdfButtons textB mob-bd">
                        <button
                          type="button"
                          onClick={() => downloadGuidePdf(guide?.pdf)}
                        >
                          <span className="spanBlockTwo">
                            Download Now
                            <FaArrowRight className="slideArrow" />
                          </span>
                        </button>
                        {/* <span className="hid-spn"> Download Now <TiArrowRight className="arow-guide" /></span> */}
                        <div className="pdf-div">
                          <img src={"assets/images/pdf.png"} alt="" />
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
          {guides.length > 0 && (
            <div className="guidesPagntion pgn-tab">
              <div className="d-flex ft ">
                <div
                  className="prev-t"
                  onClick={handlePrev}
                  style={{ cursor: "pointer" }}
                >
                  Preview
                </div>
                <div className="d-flex gap-2 man-txt">
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
                <div
                  className="prev-t"
                  onClick={handleNext}
                  style={{ cursor: "pointer" }}
                >
                  Next
                </div>
              </div>
            </div>
          )}
        </div>
      </section>
      <GuidesPdfPopup
        openPdfPopup={pdfPopup}
        onClosePdfPopup={onClosePdfPopup}
        guidePdf={file}
      />
    </div>
  );
};

export default GuidesPage;
