// import Carousel from "react-multi-carousel";
// import "react-multi-carousel/lib/styles.css";
// import { Link } from "react-router-dom";
// import { environmentUrl } from "../../env/enviroment";
// import { useState, useEffect } from "react";
// import { envImgUrl } from "../../env/envImage";
// import SubLoader from "../Spinner/subLoader";
// const BannerContent = () => {
//   const [multiBanner, setMultiBanner] = useState([]);
//   const [singleBanner, setSingleBanner] = useState([]);
//   const [loading, setLoading] = useState(true);

//   const getBanners = async () => {
//     const apiUrl = `${environmentUrl}/banners/get.php`;
//     const options = {
//       method: "GET",
//     };
//     try {
//       const response = await fetch(apiUrl, options);
//       const fetchedData = await response.json();
//       if (response?.status) {
//         const banners = fetchedData?.response;
//         console.log("baneers", banners);
//         let banners1 = [];
//         let remainingBanners = [];
//         banners.map((each) => {
//           if (banners1.length < 4) {
//             banners1.push(each);
//           } else {
//             remainingBanners.push(each);
//           }
//         });
//         setMultiBanner(banners1);
//         setSingleBanner(remainingBanners);
//       }
//     } catch (error) {
//       console.log(error);
//     }
//   };
//   useEffect(() => {
//     getBanners();
//     setLoading(false);

//   }, []);

//   const responsive = {
//     superLargeDesktop: {

//       breakpoint: { max: 4000, min: 3000 },
//       items: 2,
//     },
//     desktop: {
//       breakpoint: { max: 3000, min: 1024 },
//       items: 1,
//     },
//     tablet: {
//       breakpoint: { max: 1024, min: 464 },
//       items: 1,
//     },
//     mobile: {
//       breakpoint: { max: 464, min: 0 },
//       items: 1,
//     },
//   };
//   return (
//     <>
//       <section className="header-content">
//         {loading && <SubLoader />}

//         {!loading && (
//           <Carousel
//             responsive={responsive}

//             autoPlaySpeed={5000}
//             infinite={true}
//             swipeable={true}
//             className="header-content-banner"
//           >
//             {singleBanner.map((each) => (
//               <div
//                 className="item d-flex align-items-center carouselImage"
//                 key={each?.banner_id}
//               >
//                 <img
//                   src={`${envImgUrl}/Uploads/banners/${each?.banner_image}`}
//                   alt={each?.banner_alttext}
//                   className="tst_01"
//                 />
//                 <div className="container">
//                   <div className="caption">
//                     <div className="animated" data-start="fadeInUp">
//                       <div className="promo pt-3 banner">
//                         <div className="title title-sm p-0">
//                           {each?.banner_title}
//                         </div>
//                       </div>
//                     </div>
//                     <div
//                       className="animated bdesc"
//                       data-start="fadeInUp"
//                       dangerouslySetInnerHTML={{
//                         __html: each?.banner_description,
//                       }}
//                     ></div>
//                     <div className="animated" data-start="fadeInUp">
//                       <div className="pt-3 banner">
//                         <Link
//                           to="/signup"
//                           className="btn btn-outline-warning mr-2"
//                         >
//                           Request a Quote
//                         </Link>

//                       </div>
//                     </div>
//                     <div className="animated" data-start="fadeInUp">
//                       <div className="promo pt-5 banner">
//                         <div className="h6 p-0 m-0">Get special price</div>
//                         <div className="price">
//                           <span>₹ {each?.offer_price}</span>
//                         </div>
//                         <small
//                           className="d-none d-sm-block"
//                           dangerouslySetInnerHTML={{
//                             __html: each?.offer_description,
//                           }}
//                         ></small>
//                       </div>
//                     </div>
//                   </div>
//                 </div>
//               </div>
//             ))}

//             <div className="row banner-content-container multiple">
//               {multiBanner.map((eachMultiBanner) => (
//                 <div
//                   className="col-md-3  pr-0 pl-0"
//                   key={eachMultiBanner?.banner_id}
//                   data-aos="fade-up"
//                 >
//                   <div className="overflow_img">
//                     <img
//                       src={`${envImgUrl}/Uploads/banners/${eachMultiBanner?.banner_image}`}
//                       alt="lightBanner"
//                       className="banner-content image_zoom"
//                     />
//                     <div className="banner-opacity">
//                       <h3 className="banner-des">
//                         {eachMultiBanner?.banner_title}
//                       </h3>
//                     </div>
//                   </div>
//                 </div>
//               ))}
//             </div>

//           </Carousel>
//         )}
//       </section>
//     </>
//   );
// };

// export default BannerContent;

import React from "react";
import { FaArrowRight } from "react-icons/fa";

const BannerContent = () => {
  return (
    <>
      <section className="bg-bannner pb-4">
        <div className="eli-20 tab-none">
          <img src="assets/images/Ellipse 20.png" alt="" className="pos-ab" />
        </div>

        {/* <div className='d-flex justify-content-between'>
          <div className=''><img src="assets/images/Ellipse 13.png" alt="" /></div>
          <div><img src="assets/images/Ellipse 20.png" alt="" /></div>
        </div> */}

        {/* <div className="">
          <div className="botom-1"><img src="assets/images/Ellipse 6.png" alt="" /></div>
          <div className="botom-2"><img src="assets/images/Ellipse 12.png" alt="" /></div>
        </div> */}
        <div className="row m-0">
          <div className="scr-nid tab-none">
            <img src="assets/images/Ellipse 6.png" alt="" className="pos-ab" />
          </div>
          <div className="bc-1 tab-none">
            <img
              src="assets/images/red-ellipse.png"
              alt=""
              className="pos-ab"
            />
          </div>
          <div className="banner-div">
            <div className="circle-1">
              {/* <h1 className='arrow-pos'><FaArrowCircleRight />

</h1> */}
              <div className="circle-2">
                <div className="mg-left">
                  {" "}
                  <h1 className="get-txt">GET</h1>
                </div>
                <div className="circle-3">
                  <h1 className="txt-digital ">DIGITAL </h1>
                </div>
                <div className="text-end">
                  <h1 className="exp-txt">
                    <span>EXPERIENCE </span>{" "}
                  </h1>
                </div>
              </div>
            </div>
            <div>
              <h1 className="arrow-pos">
                <FaArrowRight color="white" />
              </h1>{" "}
            </div>
          </div>

          <div className="container">
            <div className="row vfx-image bg-blacking">
              <div className="tab-bk">
                <img
                  src="assets/images/img.png"
                  alt=""
                  className="vfx-imgsize"
                />
              </div>
            </div>

            <div className="row count-div">
              <div className="col-md-3 text-center w-25">
                <div className="number-div">
                  <div className="num-text fw-bold text-light">500+</div>
                  <div className="desc-text">clients</div>
                </div>
              </div>
              <div className="col-md-3 text-center w-25">
                <div className="number-div">
                  <div className="num-text fw-bold text-light">10+</div>
                  <div className="desc-text">Years of exprience</div>
                </div>
              </div>
              <div className="col-md-3 text-center w-25">
                <div className="number-div">
                  <div className="num-text fw-bold text-light">03+</div>
                  <div className="desc-text">Office in India</div>
                </div>
              </div>
              <div className="col-md-3 text-center w-25">
                <div className="number-div-l">
                  <div className="num-text fw-bold text-light">500+</div>
                  <div className="desc-text">clients</div>
                </div>
              </div>
            </div>
            <div className="vertical-text tab-none"> Interior</div>
            <div className="horizontal-txt tab-none">find your In</div>
          </div>
        </div>
        <div className="oiuyt">
          <img src="" alt="" />
        </div>

        <div className="d-flex justify-content-between two-shades">
          <div className="scr-hid tab-none">
            <img src="assets/images/Ellipse 12.png" alt="" className="pos-ab" />
          </div>
        </div>
      </section>
    </>
  );
};

export default BannerContent;
