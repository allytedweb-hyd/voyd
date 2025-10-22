// import { useEffect, useState } from "react";
// import { Link } from "react-router-dom";
// import { environmentUrl } from "../../env/enviroment";
// import { envImgUrl } from "../../env/envImage";
// import { getOurServices } from "../../libs/endpoints";
// import Loader from "../Spinner/Loader";

// const OurServices = () => {
//   const [services, setServices] = useState([]);
//   const [loading, setLoading] = useState(true);

//   const handleOurServices = async () => {
//     const response = await getOurServices();
//     if (response?.status) {
//       setServices(response?.response);
//     }
//   };

//   useEffect(() => {
//     async function service() {
//       await handleOurServices();
//       setLoading(false);
//     }
//     service();
//   }, []);

//   return (
//     <>
//       {loading && <Loader />}
//       {!loading && (
//         <>
//           <section className="blog blog-block service">

//             <header>
//               <div className="container">
//                 <h2 className="title">Our Services</h2>
//                 <div className="text">
//                   <p>
//                     We just keep things minimal.{" "}

//                   </p>
//                 </div>
//               </div>
//             </header>

//             <div className="container">
//               <div className="scroll-wrapper">
//                 <div className="row scroll text-center">

//                   {services.length === 0 ? (
//                     <div className="container">
//                       <div className="row">
//                         <div className="result-card">
//                           <img src="assets/images/emptyWish.gif" alt="" />
//                           <p>No Services Data Found</p>
//                         </div>
//                       </div>
//                     </div>
//                   ) : (
//                     services.map((eachService, index) => (
//                       <div className="col-md-4" key={index}>
//                         <article data-3d>
//                           <Link to="./categories">
//                             <div className="image">
//                               <img
//                                 src={`${envImgUrl}/Uploads/services/${eachService.service_image}`}
//                                 alt=""
//                               />
//                             </div>
//                             <div className="entry entry-block">
//                               <div className="label">
//                                 {eachService.service_subtitle}
//                               </div>
//                               <div className="title">
//                                 <h2 className="h4">{eachService.service_title}</h2>
//                               </div>
//                               <div className="description d-none d-sm-block">
//                                 <p
//                                   dangerouslySetInnerHTML={{
//                                     __html: eachService.service_description,
//                                   }}
//                                 ></p>
//                               </div>
//                             </div>
//                             <div className="show-more">
//                               <span className="btn btn-clean">View More</span>
//                             </div>
//                           </Link>
//                         </article>
//                       </div>
//                     ))
//                   )}
//                 </div>

//               </div>
//             </div>

//           </section>
//         </>
//       )}
//     </>
//   );
// };

// export default OurServices;
import { useState, useEffect } from "react";
import { Link } from "react-router-dom";

const OurServices = () => {
  const [imageSrc, setImageSrc] = useState("assets/images/image 5 (2).png");
  const [isLightOn, setIsLightOn] = useState(false); // State to track if light is on

  // State to track the scroll position
  const [scrollPosition, setScrollPosition] = useState(0);

  // Handle scroll event
  const handleScroll = () => {
    const scrollY = window.scrollY; // Get the scroll position
    setScrollPosition(scrollY); // Update the scroll position
  };

  // Update the image source based on scroll position
  useEffect(() => {
    // When scroll position is greater than 500px, change the image
    if (scrollPosition > 3000) {
      setImageSrc("assets/images/image 5 (3).png");
      setIsLightOn(false); // Replace with the second image
    } else {
      setImageSrc("assets/images/image 5 (2).png");
      setIsLightOn(true); // The default image
    }
  }, [scrollPosition]); // Re-run when scrollPosition changes

  // Add scroll event listener on component mount
  useEffect(() => {
    window.addEventListener("scroll", handleScroll);

    // Cleanup the event listener on unmount
    return () => {
      window.removeEventListener("scroll", handleScroll);
    };
  }, []);
  return (
    <>
      <section className="pdng-tb2 serviceSection">
        <div className="container">
          <div className="row pdng-btm tb-services">
            <div className="col-md-8">
              <div>
                <h1 className="bridge-txt text-light t-center">BRIDGE TO</h1>
              </div>
              <div className="d-flex t-center j-center">
                <div>
                  <h1 className="elegence-txt text-light">Elegance</h1>
                </div>
                <div className="tme-txting">
                  <div className="time-txt">
                    - End to End Interior Elements
                    <br />
                    {/* <span className="serv-span">Services</span> */}
                  </div>
                </div>
              </div>
            </div>
            <div className="col-md-2"></div>
            <div className="col-md-2 lamp-light">
              <div
                className={`d-flex lamp-imgs ${isLightOn ? "" : "bg-circle"}`}
              >
                <div>
                  <img
                    src={imageSrc}
                    alt="Lamp Image"
                    className="lmp-imgsize"
                  />
                </div>
              </div>
            </div>
          </div>

          <div className="row">
            <div className="d-flex justify-content-between">
              <div className="briSubDiv">
                <div className="bri-icons one">
                  <img
                    src="assets/icons/Elegancea.png"
                    alt=""
                    className="war-img"
                  />
                </div>
                <div className="bri-icons two">
                  <img
                    src="assets/icons/Eleganceaa.png"
                    alt=""
                    className="war-img"
                  />
                </div>
                <div className="bridge-icon">Modular Kitchen</div>
              </div>
              <div className="briSubDiv">
                <div className="bri-icons one">
                  <img
                    src="assets/icons/Eleganceb.png"
                    alt=""
                    className="war-img"
                  />
                </div>
                <div className="bri-icons two">
                  <img
                    src="assets/icons/Elegancebb.png"
                    alt=""
                    className="war-img"
                  />
                </div>
                <div className="bridge-icon">Storage & Wardrobes</div>
              </div>
              <div className="briSubDiv">
                <div className="bri-icons one">
                  <img
                    src="assets/icons/Elegancec.png"
                    alt=""
                    className="war-img"
                  />
                </div>
                <div className="bri-icons two">
                  <img
                    src="assets/icons/Elegancecc.png"
                    alt=""
                    className="war-img"
                  />
                </div>
                <div className="bridge-icon">Master Bedrooms</div>
              </div>
              <div className="briSubDiv">
                <div className="bri-icons one">
                  <img
                    src="assets/icons/Eleganced.png"
                    alt=""
                    className="war-img"
                  />
                </div>
                <div className="bri-icons two">
                  <img
                    src="assets/icons/Elegancedd.png"
                    alt=""
                    className="war-img"
                  />
                </div>
                <div className="bridge-icon">Space Saving Furniture</div>
              </div>
              <div className="briSubDiv">
                <div className="bri-icons one">
                  <img
                    src="assets/icons/Elegancee.png"
                    alt=""
                    className="war-img"
                  />
                </div>
                <div className="bri-icons two">
                  <img
                    src="assets/icons/Eleganceee.png"
                    alt=""
                    className="war-img"
                  />
                </div>
                <div className="bridge-icon">Bathrooms</div>
              </div>
            </div>
          </div>
          <div className="row row-second">
            <div className="d-flex justify-content-between">
              <div className="briSubDiv">
                <div className="bri-icons one">
                  <img
                    src="assets/icons/Elegancef.png"
                    alt=""
                    className="war-img"
                  />
                </div>
                <div className="bri-icons two">
                  <img
                    src="assets/icons/Eleganceff.png"
                    alt=""
                    className="war-img"
                  />
                </div>
                <div className="bridge-icon">Swing Chairs</div>
              </div>
              <div className="briSubDiv">
                <div className="bri-icons one">
                  <img
                    src="assets/icons/Eleganceg.png"
                    alt=""
                    className="war-img"
                  />
                </div>
                <div className="bri-icons two">
                  <img
                    src="assets/icons/Elegancegg.png"
                    alt=""
                    className="war-img"
                  />
                </div>
                <div className="bridge-icon">Sofa Sets</div>
              </div>
              <div className="briSubDiv">
                <div className="bri-icons one">
                  <img
                    src="assets/icons/Eleganceh.png"
                    alt=""
                    className="war-img"
                  />
                </div>
                <div className="bri-icons two">
                  <img
                    src="assets/icons/Elegancehh.png"
                    alt=""
                    className="war-img"
                  />
                </div>
                <div className="bridge-icon">Study Tables</div>
              </div>
              <div className="briSubDiv">
                <div className="bri-icons one">
                  <img
                    src="assets/icons/Elegancei.png"
                    alt=""
                    className="war-img"
                  />
                </div>
                <div className="bri-icons two">
                  <img
                    src="assets/icons/Eleganceii.png"
                    alt=""
                    className="war-img"
                  />
                </div>
                <div className="bridge-icon">Wall Painting</div>
              </div>
              <div className="briSubDiv">
                <div className="bri-icons one">
                  <img
                    src="assets/icons/Elegancej.png"
                    alt=""
                    className="war-img"
                  />
                </div>
                <div className="bri-icons two">
                  <img
                    src="assets/icons/Elegancejj.png"
                    alt=""
                    className="war-img"
                  />
                </div>
                <div className="bridge-icon">Dining Table</div>
              </div>
            </div>
          </div>
          <div className="row row-second">
            <div className="d-flex justify-content-between">
              <div className="briSubDiv">
                <div className="bri-icons one">
                  <img
                    src="assets/icons/Elegancek.png"
                    alt=""
                    className="war-img"
                  />
                </div>
                <div className="bri-icons two">
                  <img
                    src="assets/icons/Elegancekk.png"
                    alt=""
                    className="war-img"
                  />
                </div>
                <div className="bridge-icon">Pooja Units</div>
              </div>
              <div className="briSubDiv">
                <div className="bri-icons one">
                  <img
                    src="assets/icons/Elegancel.png"
                    alt=""
                    className="war-img"
                  />
                </div>
                <div className="bri-icons two">
                  <img
                    src="assets/icons/Elegancell.png"
                    alt=""
                    className="war-img"
                  />
                </div>
                <div className="bridge-icon">Crockery </div>
              </div>
              <div className="briSubDiv">
                <div className="bri-icons one">
                  <img
                    src="assets/icons/Elegancem.png"
                    alt=""
                    className="war-img"
                  />
                </div>
                <div className="bri-icons two">
                  <img
                    src="assets/icons/Elegancemm.png"
                    alt=""
                    className="war-img"
                  />
                </div>
                <div className="bridge-icon">Wallpaper</div>
              </div>
              <div className="briSubDiv">
                <div className="bri-icons one">
                  <img
                    src="assets/icons/Elegancen.png"
                    alt=""
                    className="war-img"
                  />
                </div>
                <div className="bri-icons two">
                  <img
                    src="assets/icons/Elegancenn.png"
                    alt=""
                    className="war-img"
                  />
                </div>
                <div className="bridge-icon">TV Units</div>
              </div>
              <div className="briSubDiv">
                <div className="bri-icons one">
                  <img
                    src="assets/icons/Eleganceo.png"
                    alt=""
                    className="war-img"
                  />
                </div>
                <div className="bri-icons two">
                  <img
                    src="assets/icons/Eleganceoo.png"
                    alt=""
                    className="war-img"
                  />
                </div>
                <div className="bridge-icon">False Ceiling</div>
              </div>
            </div>
          </div>

          {/* <div className="row">
            <div className="col-md-4 col-sm-6 imageColumn p-0  res-mb">
              <div>
                <img src=" assets/images/s-6.png" alt="" className="w-440" />
              </div>
           
            </div>
            <div className="col-md-4 col-sm-6 imageColumn p-0 pic-up  ">
              <div>
                <img src="assets/images/s-2.png" alt="" className="w-440" />
              </div>
           
            </div>
            <div className="col-md-4 col-sm-6 imageColumn p-0 ">
              <div>
                <img src="assets/images/s-3.png" alt="" className="w-440" />
              </div>
          
            </div>
          </div> */}

          {/* <h1 className="text-center m-0 p-0 text-light pd-font res-pb divideTitles bedroom">
            BEDROOMS
          </h1> */}

          {/* <div className="row">
            <div className="col-md-4 col-sm-6 imageColumn p-0 ">
              <div>
                <img src="assets/images/s-1.png" alt="" className="w-440" />
              </div>
             
            </div>
            <div className="col-md-4 col-sm-6 imageColumn p-0 pic-down  res-mb ">
              <div>
                <img src="assets/images/s-5.png" alt="" className="w-440" />
              </div>

             
            </div>
            <div className="col-md-4 col-sm-6 imageColumn p-0 ">
              <div>
                <img src=" assets/images/s-4.png" alt="" className="w-440" />
              </div>
            
            </div>
          </div> */}
          {/* <div className="row  pt-top twoHeads">
            <div className="col-md-4">
              <h1 className=" m-0 p-0 text-light text-center pd-font divideTitles ceiling">
                CEILINGS
              </h1>
            </div>
            <div className="col-md-4">
              <h1 className=" m-0 p-0 text-light text-center pd-font divideTitles ceiling">
                FURNITURE
              </h1>
            </div>
          </div> */}

          {/* <div className="row">
            <div className="col-md-4 col-sm-6 imageColumn p-0 pic-down  mrgn-tt res-mb ">
              <div>
                <img src="assets/images/s-7.png" alt="" className="w-440" />
              </div>
             
            </div>
            <div className="col-md-4 col-sm-6 imageColumn p-0   ">
              <div>
                <img src="assets/images/s-8.png" alt="" className="w-440" />
              </div>
             
            </div>
            <div className="col-md-4 col-sm-6 imageColumn p-0 pic-down ">
              <div>
                <img src="assets/images/s-9.png" alt="" className="w-440" />
              </div>
             
            </div>
          </div> */}
          {/* <div className="row justify-content-center">
            <div>
              {" "}
              <Link to={"/services"}>
                <h1 className=" m-0 pt-2 tab-mt text-light text-center pd-font text-light divideTitles">
                  & MORE
                </h1>
              </Link>
            </div>
          </div> */}
        </div>
      </section>
    </>
  );
};

export default OurServices;
