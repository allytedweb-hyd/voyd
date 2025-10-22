// /* eslint-disable no-unused-vars */
// import { Link } from "react-router-dom";
// import { FaPlay } from "react-icons/fa6";
// import { BiRightArrowAlt } from "react-icons/bi";
// import { BiLeftArrowAlt } from "react-icons/bi";
// import { BsFillHouseCheckFill } from "react-icons/bs";
// import { MdDesignServices } from "react-icons/md";
// import { useState, useEffect } from "react";
// import { environmentUrl } from "../../env/enviroment";
// import { envImgUrl } from "../../env/envImage";
// import Loader from "../Spinner/Loader";

// const WhyChoose = () => {
//   const [whyChoose, setWhyChoose] = useState([]);
//   const [loading, setLoading] = useState(true);

//   const getWhyChooseData = async () => {
//     const apiUrl = `${environmentUrl}/whyChooseUs/get.php`;
//     const options = {
//       method: "GET",
//     };
//     const response = await fetch(apiUrl, options);
//     const fetchedData = await response.json();
//     const whyChooseData = fetchedData?.response;
//     setWhyChoose(whyChooseData);
//   };

//   useEffect(() => {
//     async function start() {
//       await getWhyChooseData();
//       setLoading(false);
//     }
//     start();
//   }, []);
//   console.log("why choose us====", whyChoose);

//   return (
//     <>
//       {loading && <Loader />}
//       {!loading && (
//         <>
//           <div className="why-choose-main">
//             <div className="container">
//               <div className="title textCenter ">
//                 <h2>Why Choose Us</h2>

//               </div>
//               {whyChoose.length === 0 ? (
//                 <div className="container">
//                   <div className="row">
//                     <div className="result-card">
//                       <img src="assets/images/emptyWish.gif" alt="" />
//                       <p>No Services Data Found</p>
//                     </div>
//                   </div>
//                 </div>
//               ) : (
//                 <div className="all why-choose-flex">
//                   <div className="small-cont relativ">
//                     <section className="box1 relativ why-choose-flex box1-color">
//                       <div className="slize">
//                         <div className="info-p1">
//                           <h2>{whyChoose[0].choose_title}</h2>
//                           <p
//                             className="parag"
//                             dangerouslySetInnerHTML={{
//                               __html: whyChoose[0].description,
//                             }}
//                           ></p>
//                         </div>
//                       </div>
//                       <div className="slize">
//                         <div className="info-p2">
//                           <h2>{whyChoose[1].choose_title}</h2>
//                           <p
//                             className="parag"
//                             dangerouslySetInnerHTML={{
//                               __html: whyChoose[1].description,
//                             }}
//                           ></p>
//                         </div>
//                       </div>
//                     </section>

//                     <div className="img-center textCenter whychoose">
//                       <div className="col-lg-6 col-md-12 col-sm-12 video-column">
//                         <div id="video_block_01">
//                           <div
//                             className="video-inner wow slideInRight"
//                             data-wow-delay="00ms"
//                             data-wow-duration="1500ms"
//                           >
//                             <div className="video-btn">
//                               <Link
//                                 to=""
//                                 className="lightbox-image"
//                                 data-toggle="modal"
//                                 data-target="#myModal"
//                               >
//                                 <FaPlay className="why-choose-play-btn" />
//                                 <div className="waves wave-1"></div>
//                                 <div className="waves wave-2"></div>
//                                 <div className="waves wave-3"></div>
//                               </Link>
//                             </div>
//                           </div>
//                         </div>
//                       </div>

//                       <div className="img1">
//                         <img
//                           className="style hover animat"
//                           src={`${envImgUrl}/Uploads/whychooseUs/${whyChoose[0].choose_image}`}
//                           alt={whyChoose[0].alt_text}
//                         />
//                       </div>
//                       <div className=" img2">
//                         <img
//                           className="style hover animat"
//                           src={`${envImgUrl}/Uploads/whychooseUs/${whyChoose[1].choose_image}`}
//                           alt={whyChoose[1].alt_text}
//                         />
//                       </div>
//                       <div className=" img3">
//                         <img
//                           className="style hover animat"
//                           src={`${envImgUrl}/Uploads/whychooseUs/${whyChoose[2].choose_image}`}
//                           alt={whyChoose[2].alt_text}
//                         />
//                       </div>
//                       <div className=" img4">
//                         <img
//                           className="style hover animat"
//                           src={`${envImgUrl}/Uploads/whychooseUs/${whyChoose[3].choose_image}`}
//                           alt={whyChoose[3].alt_text}
//                         />
//                       </div>
//                     </div>

//                     <section className="box2  relativ why-choose-flex box1-color">

//                       <div className="slize">
//                         <div className="info-p3">
//                           <h2>{whyChoose[2].choose_title}</h2>
//                           <p
//                             className="parag"
//                             dangerouslySetInnerHTML={{
//                               __html: whyChoose[2].description,
//                             }}
//                           ></p>
//                         </div>
//                       </div>

//                       <div className="slize">
//                         <div className="info-p4">
//                           <h2>{whyChoose[3].choose_title}</h2>
//                           <p
//                             className="parag"
//                             dangerouslySetInnerHTML={{
//                               __html: whyChoose[3].description,
//                             }}
//                           ></p>
//                         </div>
//                       </div>
//                     </section>
//                   </div>
//                 </div>
//               )}
//             </div>
//           </div>
//           <div className="modal fade" id="myModal">
//             <div className="modal-dialog  modal-lg modal-dialog-centered">
//               <div className="modal-content">
//                 <button type="button" className="close" data-dismiss="modal">
//                   &times;
//                 </button>

//                 <div className="modal-body">
//                   <iframe
//                     width="560"
//                     height="315"
//                     src="https://www.youtube.com/embed/pmak0cL8cNM?si=5V4NCx3yR1e-cncf"
//                     title="YouTube video player"
//                     frameBorder="0"
//                     allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
//                     allowFullScreen
//                   ></iframe>
//                 </div>
//               </div>
//             </div>
//           </div>
//         </>
//       )}
//     </>
//   );
// };

// export default WhyChoose;

import React, { useState } from "react";

const WhyChoose = () => {
  const [hoverIndex, setHoverIndex] = useState(0); // Default to the first image
  const items = [
    { text: "Free Design Consulting", imgSrc: "assets/images/house-img.png" },
    { text: "Project Inspection", imgSrc: "assets/images/interior.jpg" },
    { text: "Find Interior", imgSrc: "assets/images/findinsp.jpeg" },
    { text: "Purchase Online", imgSrc: "assets/images/inspection.jpg" },
  ];
  return (
    <>
      <section className="creat-sec pt-0">
        <div className="container">
          <div className="row d-block pb-4">
            <div>
              <h1 className="creation-txtd tab-center">FROM CREATION</h1>
            </div>
            <div className="d-flex j-center handFlex">
              <div className="hand-txt ">
                <img
                  src="assets/images/lasaki-self-watering-ceramic-decorative-indoor-flower-pot-planters-for-home-office-use-500x500 4.png"
                  alt=""
                  className="img-wdth"
                />
              </div>
              <div className="tme-txt">
                <span className="time-txt">
                  Time <br /> line
                </span>
              </div>
              <div className="d-flex justify-content-center align-items-center">
                <h1 className="handover-txtd handover"> to Handover</h1>
              </div>
            </div>
          </div>
          <div className="row">
            {/* Left Column */}
            <div className="col-md-6">
              {items.map((item, index) => (
                <div
                  key={index}
                  className={`brdr-btm ${hoverIndex === index ? "hover-div cursor-pointer" : ""
                    }`}
                  onMouseEnter={() => setHoverIndex(index)}
                  onMouseLeave={() => setHoverIndex(0)} // Reset to the first image
                >
                  <h2 className="fw-5 hoverTitles">{item.text}</h2>
                </div>
              ))}
            </div>
            {/* Right Column */}
            <div className="col-md-6 d-flex text-end justify-content-center mb-mt">
              <img
                src={items[hoverIndex].imgSrc}
                alt={items[hoverIndex].text}
                className="house-img"
              />
            </div>
          </div>
        </div>
      </section>
    </>
  );
};

export default WhyChoose;
