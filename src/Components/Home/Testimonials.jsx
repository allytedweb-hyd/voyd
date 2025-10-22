import { environmentUrl } from "../../env/enviroment";
import { useEffect, useState } from "react";
import { envImgUrl } from "../../env/envImage";
// import Loader from "../Spinner/Loader";
// import { BiSolidQuoteAltLeft } from "react-icons/bi";
import { IoMdStar } from "react-icons/io";
import { Tab, Tabs, TabList, TabPanel } from "react-tabs";
import "react-tabs/style/react-tabs.css";
import { Carousel } from "react-bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";

// import { Link } from "react-router-dom";
// import { BiSolidStar } from "react-icons/bi";
// import { BiSolidStarHalf } from "react-icons/bi";
// import { BiStar } from "react-icons/bi";

const Testimonials = () => {
  const [selectedTab, setSelectedTab] = useState(0);
  const [testimonials, setTesimonials] = useState([]);
  // const [loading, setLoading] = useState(true);
  const [projectTestimonials, setProjectTestimonials] = useState([]);

  // const tabs = [
  //   { icon: "assets/images/Group (2) (1).png", label: "User Review" },
  //   { icon: "assets/images/Chair.png", label: "Living room" },
  //   { icon: "assets/images/Armchair.png", label: "Dining room" },
  //   { icon: "assets/images/Bed.png", label: "Bathroom" },
  //   { icon: "assets/images/Bathtub.png", label: "Bedroom" },
  // ];

  // const responsive = {
  //   superLargeDesktop: {
  //     breakpoint: { max: 4000, min: 3000 },
  //     items: 1,
  //   },
  //   desktop: {
  //     breakpoint: { max: 3000, min: 1024 },
  //     items: 1,
  //   },
  //   tablet: {
  //     breakpoint: { max: 1024, min: 464 },
  //     items: 1,
  //   },
  //   mobile: {
  //     breakpoint: { max: 464, min: 0 },
  //     items: 1,
  //   },
  // };

  const getTestimonials = async () => {
    try {
      const apiUrl = `${environmentUrl}/testmonials/get.php`;
      const options = {
        method: "POST",
      };
      const fetching = await (await fetch(apiUrl, options)).json();
      if (fetching.status) {
        const response = fetching.response;
        setTesimonials(response);
      } else {
        setTesimonials([]);
      }
    } catch (error) {
      console.log(error);
    } finally {
      // setLoading(false);
    }
  };

  const getActiveCarouselSlide = (item) => {
    getParticularUserReview(item?.testimonial_id);
  };

  const getParticularUserReview = async (id) => {
    try {
      // setLoading(true);
      const apiUrl = `${environmentUrl}/testmonials/getInteriorTestimonials.php?userId=${id}`;
      const options = {
        method: "POST",
      };
      const fetching = await (await fetch(apiUrl, options)).json();
      const response = fetching.response;
      setProjectTestimonials(response);
    } catch (error) {
      console.log(error);
    } finally {
      // setLoading(false);
    }
  };

  useEffect(() => {
    async function testimonial() {
      await getTestimonials();
      // setLoading(false);
    }
    testimonial();
  }, []);

  return (
    <>
      {/* {loading && <Loader />} */}

      <>
        <section className="userJourneySection">
          <div className=" bg-nature  justify-content-center">
            <h1 className="creation-txtd text-center text-light py-3">
              user journey
            </h1>

            <div className="imp-dv">
              <Tabs>
                <img
                  src="assets/images/Ellipse 14 (4).png"
                  alt=""
                  className="ep-c"
                />
                <img
                  src="assets/images/Ellipse 14 (4).png"
                  alt=""
                  className="ep-c2"
                />

                <div className=" r-60-n inner-card">
                  <TabList className="br-grey userTestTabList">
                    <div className="d-flex justify-content-between px-2">
                      <Tab onClick={() => setSelectedTab(0)}>
                        <div
                          className={`f-12 d-flex align-items-center gap-2 ${selectedTab === 0
                              ? "text-black fw-bold"
                              : "text-gray-500"
                            }`}
                        >
                          <img
                            src="assets/images/Group (2) (1).png"
                            alt="User Review"
                            className={`microicns ${selectedTab === 0 ? "filter-black blackTwo" : ""
                              }`}
                          />
                          User Review
                        </div>
                      </Tab>
                      {projectTestimonials.length > 0 &&
                        projectTestimonials.map((tab, index) => (
                          <Tab
                            key={index + 1}
                            onClick={() => setSelectedTab(index + 1)}
                          >
                            <div
                              className={`f-12 d-flex align-items-center gap-2 miniCon ${selectedTab === index + 1
                                  ? "text-black fw-bold"
                                  : "text-gray-500"
                                }`}
                            >
                              <img
                                src={`${envImgUrl}/Uploads/testimonialtabs/${tab?.icon}`}
                                alt={tab.img_alt_text}
                                className={`microicns ${selectedTab === index + 1
                                    ? "filter-black"
                                    : ""
                                  }`}
                              />
                              {tab.tab_name}
                            </div>
                          </Tab>
                        ))}
                    </div>
                  </TabList>

                  <TabPanel>
                    <Carousel>
                      {testimonials.length > 0 ? (
                        testimonials?.map((item, index) => (
                          <Carousel.Item
                            key={index}
                            onMouseEnter={() => {
                              getActiveCarouselSlide(item);
                            }}
                          >
                            <div className="testmoney_card">
                              <div className="row">
                                <div className="col-md-4 backdrop-user ">
                                  <div className="d-flex justify-content-center MT-3">
                                    <img
                                      src={`${envImgUrl}/Uploads/testimonials/${item?.testimonial_image}`}
                                      alt=""
                                      className="user-imgs"
                                    />
                                  </div>
                                  <div className="border-white">
                                    <span className="dance-font text-light">
                                      {item?.testimonial_name}{" "}
                                    </span>{" "}
                                    <br />
                                    <IoMdStar className="y-col" />
                                    <span className="dance-font text-light">
                                      {item?.rating}
                                    </span>
                                  </div>
                                </div>
                                <div className="col-md-8 d-flex justify-content-center">
                                  <div className="quo-text d-flex align-items-center user-card-txt reviewTextOuter">
                                    <div className=" reviewContentBlock">
                                      <p>
                                        {/* <BiSolidQuoteAltLeft className=" firstIcon" /> */}
                                        <p
                                          dangerouslySetInnerHTML={{
                                            __html:
                                              item?.testimonial_description,
                                          }}
                                          className="text-light dance-font ln-40"
                                        ></p>

                                        {/* <BiSolidQuoteAltLeft className="exm-icon" /> */}
                                      </p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </Carousel.Item>
                        ))
                      ) : (
                        <div className="result-card">
                          <img
                            src="assets/images/noDataFound.png"
                            alt="no results"
                            className="no-cart-items"
                          />
                          {/* <p>No Interior Elements Found</p> */}
                        </div>
                      )}
                    </Carousel>
                  </TabPanel>
                  {projectTestimonials.length > 0 &&
                    projectTestimonials.map((tab, index) => (
                      <TabPanel key={index + 1}>
                        <div className="row justify-content-center livingRoom reviewTabsList">
                          <div className="col-lg-3 col-md-3 col-sm-3">
                            <div className="reviewTabImg">
                              <img
                                src={`${envImgUrl}/Uploads/testimonialtabs/${tab?.image1}`}
                                alt={tab?.img_alt_text}
                              />
                            </div>
                          </div>
                          <div className="col-lg-3 col-md-3 col-sm-3">
                            <div className="reviewTabImg">
                              <img
                                src={`${envImgUrl}/Uploads/testimonialtabs/${tab?.image2}`}
                                alt={tab?.img_alt_text}
                              />
                            </div>
                          </div>
                          <div className="col-lg-3 col-md-3 col-sm-3">
                            <div className="reviewTabImg">
                              <img
                                src={`${envImgUrl}/Uploads/testimonialtabs/${tab?.image3}`}
                                alt={tab?.img_alt_text}
                              />
                            </div>
                          </div>
                        </div>
                        <div className="row justify-content-center">
                          <div className="col-md-9 d-flex justify-content-center mt-4">
                            <div className="quo-text d-flex align-items-center user-card-txt reviewTextOuter tabsOt">
                              <div className=" reviewContentBlock">
                                <p className="text-light dance-font m-0  ln-40">
                                  {" "}
                                  <span>
                                    {/* <BiSolidQuoteAltLeft className="firstIcon" /> */}
                                  </span>
                                  <p
                                    dangerouslySetInnerHTML={{
                                      __html: tab?.description,
                                    }}
                                  ></p>
                                  <span>
                                    {/* <BiSolidQuoteAltLeft className="exm-icon" /> */}
                                  </span>
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </TabPanel>
                    ))}
                </div>
              </Tabs>
            </div>
          </div>
        </section>
        {/*  */}
      </>
    </>
  );
};

export default Testimonials;
