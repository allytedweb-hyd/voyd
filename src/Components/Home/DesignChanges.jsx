import { FaArrowRight } from "react-icons/fa";
import { useEffect, useRef } from "react";
import { useLocation } from "react-router-dom";

const DesignChanges = () => {
  const location = useLocation();
  const requirementRef = useRef(null);
  const developRef = useRef(null);
  const experienceRef = useRef(null);
  const siteRef = useRef(null);

  useEffect(() => {
    const scrollToTarget = () => {
      const section = location.state?.section;

      let targetRef = null;

      switch (section) {
        case "requirement":
          targetRef = requirementRef;
          break;
        case "develop":
          targetRef = developRef;
          break;
        case "experience":
          targetRef = experienceRef;
          break;
        case "site":
          targetRef = siteRef;
          break;
        default:
          break;
      }

      if (targetRef?.current) {
        setTimeout(() => {
          requestAnimationFrame(() => {
            const yOffset = -90; // offset from top
            const y =
              targetRef.current.getBoundingClientRect().top +
              window.pageYOffset +
              yOffset;

            window.scrollTo({ top: y, behavior: "smooth" });
          });
        }, 300);
      }
    };

    scrollToTarget();
  }, [location.state]);

  return (
    <>
      {/* <section className="bg-bannner pb-4">
        <div className="eli-20 tab-none">
          <img src="assets/images/Ellipse 20.png" alt="" className="pos-ab" />
        </div>

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
      </section> */}

      <section className="p-0 merge-out mrg-one">
        <div className="">
          <div className="row">
            <div>
              <img src="assets/images/Hero (1).png" alt="" className="hro-vfxx" />
            </div>
          </div>
        </div>
        <div className="vfx-fix lap-lrge tab-lrg ex-tb bg-and bg-andd bg-as bg-ass">
          <div className="row vfx-image">
            <div className="tab-bk">
              <img src="assets/images/img.png" alt="" className="vfx-imgsize" />
            </div>
          </div>

          <div className="row count-div txture-bg">
            <div className="col-md-3 text-center w-25">
              <div className="number-div">
                <div className="num-text txtture-txt">500+</div>
                <div className="desc-text">clients</div>
              </div>
            </div>
            <div className="col-md-3 text-center w-25">
              <div className="number-div">
                <div className="num-text txtture-txt">10+</div>
                <div className="desc-text">Years of exprience</div>
              </div>
            </div>
            <div className="col-md-3 text-center w-25">
              <div className="number-div">
                <div className="num-text txtture-txt">03+</div>
                <div className="desc-text">Office in India</div>
              </div>
            </div>
            <div className="col-md-3 text-center w-25">
              <div className="number-div border-none">
                <div className="num-text txtture-txt">500+</div>
                <div className="desc-text">clients</div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section className="bg-design-col pb-5 mb-btmm">
        <div>
          <img
            src="assets/images/Ellipse 22 (2).png"
            alt=""
            className="blue-right"
          />
        </div>
        <div>
          <img
            src="assets/images/Ellipse 22 (2).png"
            alt=""
            className="blue-right2"
          />
        </div>
        <div>
          <img
            src="assets/images/Ellipse 22 (2).png"
            alt=""
            className="blue-right3"
          />
        </div>
        <div>
          <img
            src="assets/images/Ellipse 22 (2).png"
            alt=""
            className="blue-right4"
          />
        </div>

        <div className="green-elpse">
          <img src="assets/images/Ellipse 18 (1) (1).png" alt="" />
        </div>
        <div className="container res-pang">
          <div className="row justify-content-center text-center head-pb">
            <div>
              <div className="design-hdng mob-dn-hng">
                Get Digital experience and <br /> start <span>interiors</span>
              </div>
            </div>
          </div>
          {/* <div className="row bot-2">
            <div className="one-num">1</div>
          </div> */}

          <div className="row row-one mt-row" ref={requirementRef}>
            <div className="col-md-4">
              <div className="mb-wdth mmt-3">
                <img
                  src="assets/images/DeWatermark.ai_1748672612872.jpg"
                  alt=""
                  className="mtp-3 zif-vdio"
                />
              </div>
            </div>
            <div className="col-md-4 pdng-tp-3">
              <div>
                <h5 className="sub-interior text-light">
                  Requirement <span className="col-gren">Gathering</span>
                </h5>
                <div className="text-light space-text">
                  <ul>
                    <li>Confirm Room-Wise list of elements</li>
                    <li>Space Planning and Rough Layout</li>
                    <li>
                      Freeze the scope with technical experts <br /> (
                      Electrician, Vastu, Lighting etc)
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div className="col-md-4"></div>
          </div>
          {/* <div className="row  bot-1">
            <div className="two-num">2</div>
          </div> */}
          <div className="row row-two" ref={developRef}>
            <div className="col-md-4 "></div>
            <div className="col-md-4 pdng-tp-3">
              <div>
                <h5 className="sub-interior text-light">
                  Develop a <span className="col-gren">2D design </span>
                </h5>
                <div className="text-light space-text">
                  <ul>
                    <li>
                      Plan Electrical Points for False Ceiling, Fans, AC and
                      More
                    </li>
                    <li>
                      Mark Dimensions and Placement of Key Interior Elements
                    </li>
                    <li>Organize Furniture and Decor Layout</li>
                    <li>
                      Create a Complete 2D Layout With All Interior Features
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div className="col-md-4 ">
              <div className="mb-wdth mmt-3">
                <img
                  src="assets/images/2D-design.webp"
                  alt=""
                  className="mtp-3 zif-vdio"
                />
              </div>
            </div>
          </div>
          {/* <div className="row bot-2">
            <div className="one-num">3</div>
          </div> */}
          <div className="row row-one third-none" ref={experienceRef}>
            <div className="col-md-4 gif-ad">
              <div className="mb-wdth pl-40">
                <img
                  src="assets/images/WhatsAppVideo2025-01-08at5.49.23PM-ezgif.com-gif-maker.gif"
                  alt=""
                  className=""
                />
              </div>
            </div>
            <div className="col-md-4 pdng-tp-3">
              <div>
                <h5 className="sub-interior text-light">
                  Develop a <span className="col-gren">3D design</span>
                </h5>
                <div className="text-light space-text">
                  <ul>
                    <li>Finalize the Color Palette</li>
                    <li>Choose Laminate Colors & Texture</li>
                    <li>Match</li>
                    <li>Curtain, Furniture & Fabrics</li>
                    <li>Decor Items ( Wall Art, Plants, Ceramics, Lights)</li>
                  </ul>
                </div>
              </div>
            </div>
            <div className="col-md-4"></div>
          </div>
          {/* <div className="row bot-1">
            <div className="one-num">4</div>
          </div> */}
          <div className="row row-two " ref={siteRef}>
            <div className="col-md-4"></div>
            <div className="col-md-4 pdng-tp-3">
              <div>
                <h5 className="sub-interior text-light">
                  Get<span className="col-gren"> Site Experience</span>
                </h5>
                <div className="text-light space-text">
                  <ul>
                    <li>View the design, Wall by wall</li>
                    <li>Check the color design</li>
                    <li>Finalize the design to Build</li>
                  </ul>
                </div>
              </div>
            </div>
            <div className="col-md-4 ">
              <div className="mb-wdth">
                <img
                  src="assets/images/presentation-ezgif.com-video-to-gif-converter.gif"
                  alt=""
                  className="mtp-3 zif-vdio"
                />
              </div>
            </div>
          </div>
        </div>
        <div>
          <img
            src="assets/images/Ellipse 22 (2).png"
            alt=""
            className="blue-right3"
          />
        </div>
      </section>
      <div className="horizontal-txting stroke-text tab-none d-none">
        OUR PROCESS
      </div>
    </>
  );
};

export default DesignChanges;
