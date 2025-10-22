import React, { useState, useEffect } from "react";
import { Link, useNavigate } from "react-router-dom";
import { IoIosArrowForward } from "react-icons/io";
import { GoArrowUpRight } from "react-icons/go";
import { environmentUrl } from "../../env/enviroment";
import { envImgUrl } from "../../env/envImage";
import { getBlogs } from "../../libs/endpoints";
import SubLoader from "../Spinner/subLoader";
import "react-multi-carousel/lib/styles.css";

import "react-tabs/style/react-tabs.css";
import Loader from "../Spinner/Loader";

const DesignStories = (props) => {
  let navigate = useNavigate();
  const { limit } = props;

  const [blogItemlimit, setBlogItemlimit] = useState(3);
  const [blogItemOffset, setBlogItemOffset] = useState(0);
  const [blogData, setBlogData] = useState([]);
  const [loading, setLoading] = useState(true);
  const [hideElements, setHideElements] = useState(false);

  const getBlogsData = async () => {
    try {
      setLoading(true);
      let response = await getBlogs(blogItemlimit, blogItemOffset);
      if (response?.status) {
        setBlogData(response?.response);
      } else {
        console.log(response?.message);
      }
    } catch (error) {
      console.log(error);
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    async function blog() {
      await getBlogsData();
      setLoading(false);
    }
    blog();
  }, []);

  useEffect(() => {
    const handleScroll = () => {
      const scrollHeight = window.scrollY;
      if (scrollHeight > 7500 && scrollHeight < 8000) {
        setHideElements(false);
      } else {
        setHideElements(true);
      }
    };

    window.addEventListener("scroll", handleScroll);
    return () => {
      window.removeEventListener("scroll", handleScroll);
    };
  }, []);

  const handleViewAllBlogs = () => {
    navigate("/blogList");
    getBlogsData();
  };

  const responsive = {
    superLargeDesktop: {
      // the naming can be any, depends on you.
      breakpoint: { max: 4000, min: 3000 },
      items: 3,
    },
    desktop: {
      breakpoint: { max: 3000, min: 1024 },
      items: 3,
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

  return (
    <div>
      <section className="pdng-tb articleSection">
        {loading && <Loader />}

        <div className="container">
          <div className="row d-block">
            <div>
              <h6 className="text-center blog-txt">BLOG</h6>
            </div>
            <div className="d-flex justify-content-center wrap">
              <div>
                <h1 className="creation-txtd latest">
                  <span>T</span>HE LATEST
                </h1>
              </div>
              <div>
                <h1 className="handover-txtd article">
                  <span>A</span>rticle
                </h1>
              </div>
            </div>
          </div>
          <div className="row articleRow">
            {blogData.length > 0 ? (
              blogData.map((eachBlog, index) => (
                <div className="col-md-4 col-sm-6 tab-center" key={index}>
                  <a
                    href={eachBlog.link}
                    target="_blank"
                    rel="noopener noreferrer"
                  >
                    <div className="articleImg">
                      <img
                        src={`${envImgUrl}/Uploads/blog/${eachBlog.blog_image}`}
                        alt=""
                      />
                    </div>
                  </a>
                  <div className="pt-4">
                    <p>{eachBlog.blog_title}</p>
                  </div>
                  <a
                    href={eachBlog.link}
                    target="_blank"
                    rel="noopener noreferrer"
                    className="learn-txt"
                  >
                    LEARN MORE
                    <span>
                      <IoIosArrowForward />
                    </span>
                  </a>
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
            <div className="col-md-4 col-sm-6 flexAlign">
              <div className="d-flex viewAllFlex">
                <Link to="/blogList" onClick={handleViewAllBlogs}>
                  <div className="d-flex">
                    <div className="d-flex align-items-center">
                      <div className="line"></div>
                    </div>
                    <div className="arrow-line p-4 mobilePad">
                      <span className="blogsAll"> VIEW ALL</span>
                      <span className="span-arrow">
                        <GoArrowUpRight />
                      </span>
                    </div>
                  </div>
                </Link>
              </div>
            </div>
          </div>
          {/* <div className="row j-end">
                <div className="d-flex viewAllFlex">
                  <Link to="/blogList" onClick={handleViewAllBlogs}>
                    <div className="d-flex">
                      <div className="d-flex align-items-center">
                        <div className="line"></div>
                      </div>
                      <div className="arrow-line p-4">
                        VIEW ALL
                        <span className="span-arrow">
                          <GoArrowUpRight />
                        </span>
                      </div>
                    </div>
                  </Link>
                </div>
              </div> */}
        </div>
      </section>

      {/* <section className="bg-bg p-0">
        <div className="pos-absolute tab-none">
          <img src="assets/images/pngwing 8.png" alt="" />
        </div>
        <div className="container">
          <div className="row">
            <div className="col-md-1"></div>
            <div className="col-md-10">
              {!hideElements && (
                <div>
                  <img src="assets/images/bottom_harsh (3).png" alt="" />
                </div>
              )}
              <div className="last-pos">
                <div
                  style={{
                    color: hideElements ? "white" : "black",
                    transition: "color 0.3s ease",
                  }}
                  className="set-div posText"
                >
                  <div className="space-txt1 justify-content-center">
                    spaces
                  </div>
                  <div className="space-txt justify-content-center ml-100">
                    loved my <span className="many-txt fw-bold">many</span>
                  </div>
                </div>
                <div className="pr-res">
                  <img
                    src="assets/images/Lamp (2).png"
                    alt=""
                    className="stand-top"
                  />
                </div>
              </div>
              <div
                className={`pt-100 transition-element ${
                  hideElements ? "hidden" : "visible"
                }`}
              >
                <img src="assets/images/bottom_harsh.png" alt="" />
              </div>
              <div>
                <div>
                  <div className="outer">
                    <div className="p_img">
                      <img src="assets/images/Frame 32.png" alt="" />
                    </div>
                    <div
                      className="p_cont"
                      style={{
                        color: hideElements ? "white" : "black",
                        transition: "color 0.3s ease",
                      }}
                    >
                      <h6 className="ln-ht-27 testimonial">
                        “At vel risus senectus mauris. Sed pulvinar lacinia eget
                        odio maecenas porttitor duis volutpat mi.”
                      </h6>
                      <h3 className="test-author">Susane gimmicks</h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section> */}
    </div>
  );
};

export default DesignStories;
