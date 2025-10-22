import Carousel from "react-multi-carousel";
import "react-multi-carousel/lib/styles.css";
import { environmentUrl } from "../env/enviroment";
import { useEffect, useState, Link } from "react";
import { envImgUrl } from "../env/envImage";
import NoDataFound from "./NoDataFound";
const Testvendor = () => {
  const params = new URLSearchParams(window.location.search);
  const paramValue = params.get("id");
  const [vendor, setVendor] = useState({});
  const [vendorGoogleReviews, setVendorGoogleReviews] = useState([]);
  const [vendorTestimonials, setVendorTestimonials] = useState([]);
  const [noData, setNoData] = useState(false);

  const getVendorInfo = async () => {
    const url = `${environmentUrl}/vendor/getManageVendor.php?id=${paramValue}`;
    const options = {
      method: "GET",
    };
    const response = await (await fetch(url, options)).json();
    console.log("vendor response====", response);
    if (response?.status) {
      setVendor(response?.response);
    } else {
      setNoData(true);
    }
  };

  const getVendorGoogleReviews = async () => {
    const url = `${environmentUrl}/vendor/getGoogleReviews.php`;
    const options = {
      method: "GET",
    };
    const response = await (await fetch(url, options)).json();
    console.log("vendor google review response====", response);
    if (response?.status) {
      setVendorGoogleReviews(response?.response);
    }
  };

  const getVendorTestimonials = async () => {
    const url = `${environmentUrl}/vendor/getTestimonials.php`;
    const options = {
      method: "GET",
    };
    const response = await (await fetch(url, options)).json();
    console.log("vendor google review response====", response);
    if (response?.status) {
      setVendorTestimonials(response?.response);
    }
  };

  const responsiving = {
    superLargeDesktop: {
      breakpoint: { max: 4000, min: 3000 },
      items: 3, // Two items for super-large screens
    },
    desktop: {
      breakpoint: { max: 3000, min: 1024 },
      items: 3, // Two items for desktop
    },
    tablet: {
      breakpoint: { max: 1024, min: 574 },
      items: 2, // One item for tablets
    },
    mobile: {
      breakpoint: { max: 574, min: 0 },
      items: 1, // One item for mobile
    },
  };
  const responsivings = {
    superLargeDesktop: {
      breakpoint: { max: 4000, min: 3000 },
      items: 2, // Two items for super-large screens
    },
    desktop: {
      breakpoint: { max: 3000, min: 1024 },
      items: 2, // Two items for desktop
    },
    tablet: {
      breakpoint: { max: 1024, min: 574 },
      items: 2, // One item for tablets
    },
    mobile: {
      breakpoint: { max: 574, min: 0 },
      items: 1, // One item for mobile
    },
  };

  useEffect(() => {
    getVendorInfo();
    getVendorGoogleReviews();
    getVendorTestimonials();
  }, []);

  return (
    <>
      {noData && <NoDataFound />}
      {!noData && (
        <div className="containerFixedW">
          <section className="bg-vendor pos-rel">
            <div className="pos-rel">
              <img
                src="assets/images/Group 635.png"
                alt=""
                className="gld-circle"
              />
            </div>
            <div className="container">
              <div className="bd-div">
                <img
                  src="assets/images/Vector (5).png"
                  alt=""
                  className="com-nme"
                />
              </div>

              <div className="row bg-tra-ven m-auto vendorDesc">
                <div className="col-md-5 flx-col">
                  <div className="vendor-image-container d-flex justify-content-center">
                    <div className="vendor-profile-container">
                      <img
                        //   src="assets/images/Group 1618873185 (1).png" Replace with the actual image path
                        src={`${envImgUrl}/Uploads/vendor-management/${vendor?.vendor_image}`}
                        alt="Vendor"
                        className="vendor-image"
                      />
                    </div>
                    <div className="vendor-name">
                      <span className="ven-name">VENDOR NAME </span>
                      <span className="ven-sur">
                        {" "}
                        - {vendor?.vendor_full_name}
                      </span>
                    </div>
                  </div>
                </div>
                <div className="col-md-7 d-flex align-items-center vendorColor">
                  <div className="vendor-description">
                    <div
                      className="danc-f"
                      dangerouslySetInnerHTML={{
                        __html: vendor?.vendor_description,
                      }}
                    ></div>
                  </div>
                </div>
              </div>

              <section className="stats-section">
                {/* <div className="overlay"></div> */}
                <div className="gold-line"></div>
                <div className="stats-container">
                  <div className="stat-item">
                    <h2 className="stat-number">
                      {vendor?.projects_done > 100
                        ? `${vendor?.projects_done}+`
                        : vendor?.projects_done}
                    </h2>
                    <p className="stat-label">Projects</p>
                  </div>
                  <div className="stat-item">
                    <h2 className="stat-number">
                      {vendor?.no_of_clients > 100
                        ? `${vendor?.no_of_clients}+`
                        : vendor?.no_of_clients}
                    </h2>
                    <p className="stat-label">Clients</p>
                  </div>
                  <div className="stat-item">
                    <h2 className="stat-number">
                      {vendor?.pavilion > 100
                        ? `${vendor?.pavilion}+`
                        : vendor?.pavilion}
                    </h2>
                    <p className="stat-label">Pavilions</p>
                  </div>
                  <div className="stat-item">
                    <h2 className="stat-number">
                      {vendor?.awards > 100
                        ? `${vendor?.awards}+`
                        : vendor?.awards}
                    </h2>
                    <p className="stat-label">Awards</p>
                  </div>
                  <div className="stat-item">
                    <h2 className="stat-number">
                      {vendor?.spaces > 100
                        ? `${vendor?.spaces}+`
                        : vendor?.spaces}
                    </h2>
                    <p className="stat-label">Spaces</p>
                  </div>
                  <div className="stat-item">
                    <h2 className="stat-number">
                      {vendor?.workers > 100
                        ? `${vendor?.workers}+`
                        : vendor?.workers}
                    </h2>
                    <p className="stat-label">Workers</p>
                  </div>
                </div>
              </section>
            </div>
          </section>

          <section className="pos-rel pd-ded">
            <div className="">
              <div className="row">
                <div className="ded-layer">
                  <img src="assets/images/Layer_1.png" alt="" />
                </div>
                <div className="d-flex ded-mobile justify-content-center">
                  <h1 className="cinzel-font ded-txt mini-fnt">
                    DEDICATED TO LIVING
                  </h1>
                </div>

                <div className="row mt-182 mob-mr">
                  <div className="col-md-5 gc-2">
                    <img src="assets/images/Group 635 (2).png" alt="" />
                  </div>
                  <div className="col-md-6">
                    <div>
                      <div className="mt-5 ded-mrgn">
                        <h2 className="cinzel-font ex-txt te-bef pb-40">
                          EXCEPTIONAL LIVING
                        </h2>
                      </div>
                      <div className="livng-p">
                        Arcu ultrices volutpat donec dui faucibus etiam
                        phasellus sagittis. Lacus amet arcu pretium lacus.
                        Dignissim vulputate maecenas vulputate tempor velit.
                        Viverra ut rutrum morbi in tincidunt nullam ullamcorper
                        at varius. Quis luctus vestibulum nunc risus. Erat etiam
                        lorem ipsum luctus.
                        <br />
                        <br />
                        At vel risus senectus mauris. Sed pulvinar lacinia eget
                        odio maecenas porttitor duis volutpat mi. Amet molestie
                        tempor consectetur eget laoreet. Ligula sit viverra
                        dignissim etiam sed consectetur molestie. Egestas ac
                        nunc in lectus mauris consectetur lectus id accumsan.
                        Amet semper aliquet urna rutrum cursus eu.
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <section className="ad-mt-lines top-hd mob-hd">
            <div className="ext-lines">
              <img src="assets/images/Master Execution 1 1.png" alt="" />
            </div>

            <div className="container">
              <div className="row flex-rev">
                <div className="col-md-6">
                  <div className="row vendorimgRoss">
                    <div className="col-md-6 col-sm-6">
                      <div className="d-flex justify-content-center project-one-image-outer">
                        <img
                          src={`${envImgUrl}/Uploads/vendor-management/${vendor?.project_img_one}`}
                          alt="project 1"
                        />
                      </div>
                    </div>
                    <div className="col-md-6 col-sm-6">
                      <div className="d-flex justify-content-center project-two-image-outer">
                        <img
                          src={`${envImgUrl}/Uploads/vendor-management/${vendor?.project_img_two}`}
                          alt="project 2"
                        />
                      </div>
                    </div>
                  </div>
                </div>
                <div className="col-md-5 col-sm-12">
                  <h1 className="extin-txt mast-txt">Mastering Execution</h1>
                  <div className="ext-p">
                    {" "}
                    Arcu ultrices volutpat donec dui faucibus etiam phasellus
                    sagittis. Lacus amet arcu pretium lacus. Dignissim vulputate
                    maecenas vulputate tempor velit. Viverra ut rutrum morbi in
                    tincidunt nullam ullamcorper at varius. Quis luctus
                    vestibulum nunc risus. Erat etiam lorem ipsum luctus.
                  </div>
                </div>
                <div className="col-md-1"></div>
              </div>
            </div>
            <div className="d-flex justify-content-end">
              <img
                src="assets/images/Master execution 2 1.png"
                alt=""
                className="mstr-lins"
              />
            </div>
          </section>

          <section className="locat-sec mini-loc">
            <div className="">
              <div className="row">
                <div className="col-md-7  d-flex text-center align-items-center justify-content-center p-0">
                  <div>
                    <div>
                      <h1 className="extin-txt d-flex text-center justify-content-center ">
                        Explore the locations
                      </h1>
                    </div>
                  </div>
                </div>
                <div className="col-md-5 d-flex  j-tab-center p-0">
                  <div className="city-card citiLocation">
                    <div className="card-content ">
                      <div className="map-container">
                        <div className="map-circle">
                          <div>
                            <img src="assets/images/Precise Img.png" alt="" />
                          </div>
                        </div>
                      </div>

                      <h3 className="city-namee fleitems">
                        City -{" "}
                        <div className="firstLetter">
                          {vendor?.explore_city}
                        </div>
                      </h3>
                      <div className="mapBtns map-btn">
                        {" "}
                        <button className="location-button">
                          {vendor?.preffered_location_one}
                        </button>
                      </div>
                      <div className="mapBtns map-btn2">
                        {" "}
                        <button className="location-button">
                          {vendor?.preffered_location_two}
                        </button>
                      </div>
                      <div className="mapBtns map-btn3">
                        {" "}
                        <button className="location-button">
                          {vendor?.preffered_location_three}
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div className="row">
                <div className="col-md-8">
                  <div>
                    <img
                      src="assets/images/Explore the Locations 1.png"
                      alt=""
                      className="exp-lin"
                    />
                  </div>
                </div>
              </div>
            </div>
          </section>

          <section className="pt-0 shw-cse cse-tb cse-mob">
            <div className="container">
              <div className="row flex-rev">
                <div className="col-md-6">
                  <div className="container showcase-m"></div>

                  <div className="row mobileSubDivs">
                    <div className="col-md-4 col-sm-6 m-tile j-tab-center">
                      <div className="tile-card">
                        <div className="tile-image material-image-outer">
                          <img
                            src={`${envImgUrl}/Uploads/vendor-management/${vendor?.material_img_one}`}
                            alt="Tile 2"
                            className="img-fluid"
                          />
                          <span className="badge">SALE</span>
                        </div>
                        <h5 className="tile-title">
                          {vendor?.material_name_one}
                        </h5>

                        {/* <p className="tile-price">
                          <span className="old-price">
                            ₹{vendor?.material_price_one}.00
                          </span>
                        </p> */}
                      </div>
                    </div>

                    <div className="col-md-4 col-sm-6 m-tile j-tab-center">
                      <div className="tile-card">
                        <div className="tile-image material-image-outer">
                          <img
                            src={`${envImgUrl}/Uploads/vendor-management/${vendor?.material_img_two}`}
                            alt="Tile 2"
                            className="img-fluid"
                          />
                          <span className="badge">SALE</span>
                        </div>
                        <h5 className="tile-title">
                          {vendor?.material_name_two}
                        </h5>
                        {/* <p className="tile-price">
                          <span className="old-price">
                            ₹{vendor?.material_price_two}.00
                          </span>{" "}
                        </p> */}
                      </div>
                    </div>

                    <div className="col-md-4 col-sm-12 m-tile j-tab-center">
                      <div className="tile-card">
                        <div className="tile-image material-image-outer">
                          <img
                            src={`${envImgUrl}/Uploads/vendor-management/${vendor?.material_img_three}`}
                            alt="Tile 2"
                            className="img-fluid"
                          />
                          <span className="badge">SALE</span>
                        </div>
                        <h5 className="tile-title">
                          {vendor?.material_name_three}
                        </h5>
                        {/* <p className="tile-price">
                          <span className="old-price">
                            ₹{vendor?.material_price_three}.00
                          </span>
                        </p> */}
                      </div>
                    </div>
                    {/* </div>

                  <div className="row mobileSubDivs"> */}
                    <div className="col-md-4 col-sm-6 m-tile j-tab-center">
                      <div className="tile-card">
                        <div className="tile-image material-image-outer">
                          <img
                            src={`${envImgUrl}/Uploads/vendor-management/${vendor?.material_img_four}`}
                            alt="Tile 2"
                            className="img-fluid"
                          />
                          <span className="badge">SALE</span>
                        </div>
                        <h5 className="tile-title">
                          {vendor?.material_name_four}
                        </h5>
                        {/* <p className="tile-price">
                          <span className="old-price">
                            ₹{vendor?.material_price_four}.00
                          </span>
                        </p> */}
                      </div>
                    </div>

                    <div className="col-md-4 col-sm-6 m-tile j-tab-center">
                      <div className="tile-card">
                        <div className="tile-image material-image-outer">
                          <img
                            src={`${envImgUrl}/Uploads/vendor-management/${vendor?.material_img_five}`}
                            alt="Tile 2"
                            className="img-fluid"
                          />
                          <span className="badge">SALE</span>
                        </div>
                        <h5 className="tile-title">
                          {vendor?.material_name_five}
                        </h5>
                        {/* <p className="tile-price">
                          <span className="old-price">
                            ₹{vendor?.material_price_five}.00
                          </span>
                        </p> */}
                      </div>
                    </div>

                    <div className="col-md-4 col-sm-12 m-tile j-tab-center">
                      <div className="tile-card">
                        <div className="tile-image material-image-outer">
                          <img
                            src={`${envImgUrl}/Uploads/vendor-management/${vendor?.material_img_six}`}
                            alt="Tile 2"
                            className="img-fluid"
                          />
                          <span className="badge">SALE</span>
                        </div>
                        <h5 className="tile-title">
                          {vendor?.material_name_six}
                        </h5>
                        {/* <p className="tile-price">
                          <span className="old-price">
                            ₹{vendor?.material_price_six}.00
                          </span>
                        </p> */}
                      </div>
                    </div>
                  </div>
                </div>
                <div className="col-md-6">
                  <h1 className="extin-txt mt-5">Showcase of Excellence</h1>
                  <div className="re-pro text">-Recent Projects</div>
                </div>
              </div>
            </div>
          </section>

          <section>
            <div>
              <img
                src="assets/images/genuine-lines.png"
                alt=""
                className="gen-line"
              />
            </div>
            <div className="container mt-con mt-tbb">
              <div className="row">
                <div className="extin-txt2 txt-tab txt-mobb">
                  Genuine feedback that reflects <br /> trust and satisfaction
                </div>
                <div className="re-pro2 pb-4 pt-2 tb-rep">
                  Client Testimonials
                </div>

                <div className="row vendorTestimonysBlock">
                  <Carousel
                    responsive={responsiving}
                    autoPlay={true}
                    infinite={true}
                    arrows={false}
                    autoPlaySpeed={3000}
                    showDots={false} // Enable dots
                    dotListClass="custom-dot-list-style " // Custom class for styling dots
                  >
                    {vendorTestimonials?.map((item, index) => (
                      <div key={index}>
                        <div className=" vendorTestimonys">
                          <div className="">
                            <div className="vendor-client-testimonials-outer">
                              <img
                                src={`${envImgUrl}/Uploads/vendortestimonials/${item?.image}`}
                                alt=""
                              />
                            </div>
                          </div>
                          <div className=" su-txt testimonial-content-outer">
                            <div className="contText">
                              <p
                                className="testimonialing content"
                                dangerouslySetInnerHTML={{
                                  __html: item?.content,
                                }}
                              ></p>
                            </div>
                            <div>
                              {" "}
                              <h3 className="test-author ">
                                {item?.testimonial_name}
                              </h3>
                            </div>
                          </div>
                        </div>
                      </div>
                    ))}
                  </Carousel>
                  {/* <div className="col-md-4">
                              <div className="row">
                                  <div className="col-md-3">
                                      <div> <img src="assets/images/Frame 32.png" alt="" /></div>
                                  </div>
                                  <div className="col-md-9 su-txt">
                                      <div><h6 className="testimonialing">
                          “At vel risus senectus mauris. Sed pulvinar lacinia eget odio maecenas porttitor duis volutpat mi.”
                                      </h6></div>
                                      <div>      <h3 className="test-author">Susane gimmicks</h3></div>
                                  </div>
                              </div>
                         
                          </div>
                          <div className="col-md-4">
                              <div className="row">
                                  <div className="col-md-3">
                                      <div> <img src="assets/images/Frame 32.png" alt="" /></div>
                                  </div>
                                  <div className="col-md-9 su-txt">
                                      <div><h6 className="testimonialing">
                          “At vel risus senectus mauris. Sed pulvinar lacinia eget odio maecenas porttitor duis volutpat mi.”
                                      </h6></div>
                                      <div>      <h3 className="test-author">Susane gimmicks</h3></div>
                                  </div>
                              </div>
                         
                          </div>
                          <div className="col-md-4">
                              <div className="row">
                                  <div className="col-md-3">
                                      <div> <img src="assets/images/Frame 32.png" alt="" /></div>
                                  </div>
                                  <div className="col-md-9 su-txt">
                                      <div><h6 className="testimonialing">
                          “At vel risus senectus mauris. Sed pulvinar lacinia eget odio maecenas porttitor duis volutpat mi.”
                                      </h6></div>
                                      <div>      <h3 className="test-author">Susane gimmicks</h3></div>
                                  </div>
                              </div>
                         
                          </div> */}
                </div>
              </div>
            </div>
          </section>

          <section className="pt-5 mt-100 googleReviewSection">
            <div className="">
              <div className="row">
                <div className="col-md-4 test-tab">
                  <div className="review-container-s">
                    <div className="background-shape-s"></div>
                    <div className="review-number-s dm-sans">
                      <span className="bg-23">23</span>0+
                    </div>
                    <div className="review-text-s dm-sans">Google Reviews</div>
                  </div>
                </div>
                <div className="col-md-8">
                  <div className="dfghjkjhg">
                    <Carousel
                      responsive={responsivings}
                      autoPlay={true}
                      infinite={true}
                      arrows={false}
                      autoPlaySpeed={2000}
                      showDots={true} // Enable dots
                      dotListClass="custom-dot-list-style rh-sq mob-rh" // Custom class for styling dots
                    >
                      {vendorGoogleReviews.map((review, index) => (
                        <div className="profile-card-s" key={index}>
                          <div className="profile-header">
                            <div className="image-container">
                              <img
                                src={`${envImgUrl}/Uploads/googlereviews/${review?.image}`}
                                alt="Profile"
                                className="profile-image-s"
                              />
                            </div>
                            <div className="profile-info">
                              <h2 className="profile-name-s dm-sans">
                                {review?.review_name}
                              </h2>
                              <p className="profile-location dm-sans">
                                {review?.location}
                              </p>
                            </div>
                          </div>
                          <hr />
                          <p
                            className="profile-description-s dm-sans pt-2"
                            dangerouslySetInnerHTML={{
                              __html: review?.content,
                            }}
                          ></p>
                        </div>
                      ))}
                    </Carousel>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <section className="mt-100 pos-rel">
            <div className="pos-rel">
              <img
                src="assets/images/Group 635.png"
                alt=""
                className="gld-circle2"
              />
            </div>

            <div className="">
              <div className="row">
                <div className="visit-container py-4 text-start d-flex">
                  <a
                    href="https://mrinterior.mmworkspace.com"
                    target="_blank"
                    rel="noreferrer"
                  >
                    <div>
                      {" "}
                      <span className="extin-txt ext-phn pl-122 j-mobile-center">
                        VISIT OUR WEBSITE
                      </span>
                    </div>
                  </a>
                  <a
                    href="https://mrinterior.mmworkspace.com"
                    target="_blank"
                    rel="noreferrer"
                  >
                    <div className="visit-arrow flx-col">
                      <img src="assets/images/Vector (6).png" alt="" />
                    </div>
                  </a>
                </div>

                <div className="row">
                  <div className="col-md-9">
                    <div className="visit-p visit-phn">
                      We build exceptional living experience for 35 years
                    </div>
                  </div>
                </div>
                {/* <div className="row">
                          <div className="col-md-4"></div>
                      <div className="col-md-8
                      ">
                          <div className='pos-rel'><img src="assets/images/Group 635.png" alt=""  className=''/></div>
                          </div>
                      </div> */}
              </div>
            </div>
            <div>
              <img
                src="assets/images/Visit Our Website 1.png"
                alt=""
                className="excep-lines"
              />
            </div>
          </section>
        </div>
      )}
    </>
  );
};

export default Testvendor;
