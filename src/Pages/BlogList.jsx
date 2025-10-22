// /* eslint-disable react-hooks/exhaustive-deps */
// /* eslint-disable no-unused-vars */
// import { Link } from "react-router-dom";
// import { getBlogs } from "../libs/endpoints";
// import { useEffect, useState } from "react";
// import NotFound from "./NotFound";
// import { envImgUrl } from "../env/envImage";

// const BlogList = () => {
//   const [blogItemlimit, setBlogItemlimit] = useState(15);
//   const [blogItemOffset, setBlogItemOffset] = useState(0);
//   const [blogData, setBlogData] = useState([]);

//   const getBlogsData = async () => {
//     let response = await getBlogs(blogItemlimit, blogItemOffset);
//     if (response?.status) {
//       setBlogData(response?.response);
//     } else {
//       console.log(response?.message);
//     }
//   };

//   useEffect(() => {
//     getBlogsData();
//   }, []);

//   return (
//     <>
//       <section className="blog blog-category blog-animated pt-0 pt-0 mt--125">
//         {/* <!--Header--> */}

//         <header>
//           <div className="bredcum">
//             <img
//               src="assets/images/img-4.jpg"
//               alt="lightBanner"
//               className="banner-content image_zoom"
//             />
//             <h2 className="mt-0 mb-0">Blog</h2>
//           </div>
//           <div className="container">
//             <h2 className="title mt-5">Blog List</h2>
//             <div className="text">
//               <p>Suspendisse scelerisque odio eu felis eleifend</p>
//             </div>
//           </div>
//         </header>
//         <div className="container">
//           <div className="row">
//             <div className="col-lg-12 col-md-12 col-sm-12 col-xs-12">
//               <div className="clearfix">
//                 {/* <!--Blog item--> */}

//                 {blogData?.length > 0 &&
//                   blogData?.map((blog, index) => (
//                     <article className="article-table" key={index}>
//                       {/* <Link to={`/blogSingle?blogId=${blog?.blog_id}`}> */}
//                       <Link to="">
//                         <div className="col-lg-4 col-md-4 col-sm-4 col-sm-12 col-xs-12 bimage">
//                           <div className="image article-page-image1">
//                             <img
//                               src={`${envImgUrl}/Uploads/blog/${blog.blog_image}`}
//                             />
//                           </div>
//                         </div>

//                         <div className="col-lg-5 col-md-5 col-sm-12 col-xs-12">
//                           <div className="text">
//                             <div className="title">
//                               <p>{blog.blog_date}</p>
//                               <h2 className="h5">{blog.blog_title}</h2>
//                             </div>
//                             <div className="text-intro">
//                               <p
//                                 dangerouslySetInnerHTML={{
//                                   __html: blog?.blog_description,
//                                 }}
//                               ></p>
//                             </div>
//                           </div>
//                         </div>
//                       </Link>
//                     </article>
//                   ))}
//                 {blogData?.length <= 0 && (
//                   <div>
//                     <p>Blog Data Not Found</p>
//                   </div>
//                 )}
//               </div>

//               {/* <!-- Pagination --> */}

//               {/* <div className="pagination-wrapper">
//                 <ul className="pagination justify-content-center">
//                   <li className="page-item">
//                     <a className="page-link" to="#">
//                       &laquo;
//                     </a>
//                   </li>
//                   <li className="page-item">
//                     <a className="page-link" to="#">
//                       1
//                     </a>
//                   </li>
//                   <li className="page-item">
//                     <a className="page-link active" to="#">
//                       2
//                     </a>
//                   </li>
//                   <li className="page-item">
//                     <a className="page-link" to="#">
//                       3
//                     </a>
//                   </li>
//                   <li className="page-item">
//                     <a className="page-link" to="#">
//                       &raquo;
//                     </a>
//                   </li>
//                 </ul>
//               </div> */}
//             </div>

//             {/* <!--Blog menu--> */}

//             {/* <div className="col-lg-3">
//               <aside>
//                 <!--Box search-->

//                 <div className="box box-search">
//                   <input
//                     type="text"
//                     value=""
//                     className="form-control"
//                     placeholder="Search The Blog"
//                   />
//                   <button className="btn btn-primaryy btn-sm">Go!</button>
//                 </div>

//                 <!--Box categories-->

//                 <div className="box box-animated box-categories">
//                   <h5 className="title">Blog Categories</h5>
//                   <ul>
//                     <li>
//                       <a to="#">Interiors</a>
//                     </li>
//                     <li className="active">
//                       <a to="#">Design & decorate</a>
//                     </li>
//                     <li>
//                       <a to="#">Entertainment</a>
//                     </li>
//                     <li>
//                       <a to="#">Heating & Cooling</a>
//                     </li>
//                     <li>
//                       <a to="#">Living room</a>
//                     </li>
//                     <li>
//                       <a to="#">Kitchen</a>
//                     </li>
//                     <li>
//                       <a to="#">Small spaces</a>
//                     </li>
//                   </ul>
//                 </div>

//                 <!--Box posts-->

//                 <div className="box box-animated box-posts">
//                   <h5 className="title">Popular Posts</h5>
//                   <ul>
//                     <li>
//                       <a to="article.html">
//                         <span className="date">
//                           <span>Sep</span>
//                           <span>22</span>
//                         </span>
//                         <span className="text">
//                           How to Keep Your Heating and Cooling Vents Clean
//                         </span>
//                       </a>
//                     </li>
//                     <li>
//                       <a to="article.html">
//                         <span className="date">
//                           <span>Aug</span>
//                           <span>19</span>
//                         </span>
//                         <span className="text">
//                           How to Keep Your Heating and Cooling Vents Clean
//                         </span>
//                       </a>
//                     </li>
//                     <li>
//                       <a to="article.html">
//                         <span className="date">
//                           <span>Jul</span>
//                           <span>18</span>
//                         </span>
//                         <span className="text">
//                           Steal these 3 Home Design Trends for Wedding
//                           Decorating Ideas
//                         </span>
//                       </a>
//                     </li>
//                     <li>
//                       <a to="article.html">
//                         <span className="date">
//                           <span>Jun</span>
//                           <span>07</span>
//                         </span>
//                         <span className="text">
//                           Caring for Windows: 5 Tips for People in Glass Houses
//                         </span>
//                       </a>
//                     </li>
//                   </ul>
//                 </div>

//                 <!--Box tags-->

//                 <div className="box box-tags">
//                   <h5 className="title">Popular posts</h5>
//                   <ul className="clearfix">
//                     <li>
//                       <a to="#" className="btn btn-outline-secondary btn-sm">
//                         Furniture
//                       </a>
//                     </li>
//                     <li>
//                       <a to="#" className="btn btn-outline-secondary btn-sm">
//                         Interior
//                       </a>
//                     </li>
//                     <li>
//                       <a to="#" className="btn btn-outline-secondary btn-sm">
//                         Living
//                       </a>
//                     </li>
//                     <li>
//                       <a to="#" className="btn btn-outline-secondary btn-sm">
//                         Space
//                       </a>
//                     </li>
//                     <li>
//                       <a to="#" className="btn btn-outline-secondary btn-sm">
//                         Modern
//                       </a>
//                     </li>
//                     <li>
//                       <a to="#" className="btn btn-outline-secondary btn-sm">
//                         House
//                       </a>
//                     </li>
//                     <li>
//                       <a to="#" className="btn btn-outline-secondary btn-sm">
//                         Guides
//                       </a>
//                     </li>
//                     <li>
//                       <a to="#" className="btn btn-outline-secondary btn-sm">
//                         How to
//                       </a>
//                     </li>
//                     <li>
//                       <a to="#" className="btn btn-outline-secondary btn-sm">
//                         Kitchen
//                       </a>
//                     </li>
//                   </ul>
//                 </div>
//               </aside>
//             </div> */}
//             {/* <!--/col-lg-3--> */}
//           </div>
//           {/* <!--/row--> */}
//         </div>
//         {/* <!--/container--> */}
//       </section>
//     </>
//   );
// };

// export default BlogList;

import { LuCalendarDays } from "react-icons/lu";
import { FaRegCommentDots } from "react-icons/fa";
import { CiUser } from "react-icons/ci";
import "bootstrap/dist/css/bootstrap.min.css";
import { useState, useEffect } from "react";
import { GoArrowUpRight } from "react-icons/go";
import { environmentUrl } from "../env/enviroment";
import { envImgUrl } from "../env/envImage";
import { Link } from "react-router-dom";

const BlogList = () => {
  const [blogs, setBlogs] = useState([]);
  const [loading, setLoading] = useState(false);

  const getBlogs = async () => {
    setLoading(true);
    try {
      const apiUrl = `${environmentUrl}/blogs/get.php`;
      const options = {
        method: "GET",
      };

      const data = await fetch(apiUrl, options);
      const fetchedData = await data.json();
      setBlogs(fetchedData?.response);
    } catch (e) {
      console.log("error", e);
    } finally {
      setLoading(false);
    }
  };

  const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleDateString("en-US", {
      year: "numeric",
      month: "short",
      day: "numeric",
    });
  };

  useEffect(() => {
    getBlogs();
  }, []);

  return (
    <div>
      <section className="pt-0">
        <div>
          <div>
            <img
              src="assets/images/pngwing.com (6) 1.png"
              alt=""
              className="mgn-minus"
            />
          </div>
          <div className="container blog-cntr">
            <div className="row mb-5">
              <div className="col-md-6">
                <div className="blog-hed">
                  Interior Design Articles: Ideas, Trends, and Inspiration
                </div>
                <p className="blog-sub-hed col-grey">
                  Join our community of interior design enthusiasts! Share your
                  expertise, inspire readers, and become a valued part of our
                  creative team.
                </p>
              </div>
              <div className="col-md-6">
                <div className="row px-blog mt-45">
                  <div className="col-md-4 col-sm-4 d-flex justify-content-end cards-row">
                    <div className="bg-room">
                      <div className="rm-text">
                        <span className="sp-ar">
                          <GoArrowUpRight className="col-white" />
                        </span>
                        <br />
                        Top Interior Trends 2024
                      </div>
                    </div>
                  </div>

                  <div className="col-md-4 col-sm-4 m-dn cards-row">
                    <div className="bg-room2">
                      <div className="rm-text">
                        <span className="sp-ar">
                          <GoArrowUpRight className="col-white" />
                        </span>
                        <br />
                        Furniture Selection & Aesthetics
                      </div>
                    </div>{" "}
                  </div>
                  <div className="col-md-4 col-sm-4 cards-row">
                    <div className="bg-room3 three">
                      <div className="rm-text">
                        <span className="sp-ar">
                          <GoArrowUpRight className="col-white" />
                        </span>
                        <br />
                        Sustainable & Eco-Friendly Interiors
                      </div>
                    </div>{" "}
                  </div>
                </div>
              </div>
            </div>

            <div className="blog-main-outer">
              {blogs.length > 0 &&
                blogs.map((blog, index) => {
                  const isEven = index % 2 === 0;
                  return (
                    <Link to={blog?.link} target="_blank" key={index}>
                      <div className="row pt-ARTCLE ">
                        {isEven ? (
                          <>
                            <div className="col-md-6">
                              <div className="pointer-cursor">
                                <img
                                  src={`${envImgUrl}/Uploads/blog/${blog?.blog_image}`}
                                  alt=""
                                  className="w-100 brdr-rad"
                                />
                              </div>
                            </div>
                            <div className="col-md-6 d-flex align-items-center">
                              <div>
                                <div className="art-blog">
                                  {blog?.blog_title}
                                </div>
                                <div className="d-flex gap-3 fnt-15 pt-2 mb-ARTCLE mb-blog">
                                  <div>
                                    <LuCalendarDays className="mx-2 mb-1" />
                                    {formatDate(blog?.blog_date)}
                                  </div>
                                  <div>
                                    <FaRegCommentDots className="mx-2 mb-1" />{" "}
                                    {blog?.comments} Comments
                                  </div>
                                  <div>
                                    <CiUser className="mx-2 mb-1" />
                                    {blog?.author}
                                  </div>
                                </div>
                                <div
                                  className="art-blog-p col-grey"
                                  dangerouslySetInnerHTML={{
                                    __html: blog?.blog_description,
                                  }}
                                ></div>
                              </div>
                            </div>
                          </>
                        ) : (
                          <>
                            <div className="col-md-6 order-md-2">
                              <div className="pointer-cursor">
                                <img
                                  src={`${envImgUrl}/Uploads/blog/${blog?.blog_image}`}
                                  alt=""
                                  className="w-100 brdr-rad"
                                />
                              </div>
                            </div>
                            <div className="col-md-6 order-md-1 d-flex align-items-center">
                              <div>
                                <div className="art-blog">
                                  {blog?.blog_title}
                                </div>
                                <div className="d-flex gap-3 fnt-15 pt-2 mb-ARTCLE mb-blog">
                                  <div>
                                    <LuCalendarDays className="mx-2 mb-1" />
                                    {formatDate(blog?.blog_date)}
                                  </div>
                                  <div>
                                    <FaRegCommentDots className="mx-2 mb-1" />{" "}
                                    {blog?.comments} Comments
                                  </div>
                                  <div>
                                    <CiUser className="mx-2 mb-1" />
                                    {blog?.author}
                                  </div>
                                </div>
                                <div
                                  className="art-blog-p col-grey"
                                  dangerouslySetInnerHTML={{
                                    __html: blog?.blog_description,
                                  }}
                                ></div>
                              </div>
                            </div>
                          </>
                        )}
                      </div>
                    </Link>
                  );
                })}
            </div>
            {/* <div className="blog-main-outer">
              {blogs.length > 0 &&
                blogs.map((blog, index) => (
                  <Link to={blog?.link} target="_blank" key={index}>
                    <div className="row pt-ARTCLE">
                      <div className="col-md-6">
                        <div className="pointer-cursor">
                          <img
                            src={`${envImgUrl}/Uploads/blog/${blog?.blog_image}`}
                            alt=""
                            className="w-100 brdr-rad"
                          />
                        </div>
                      </div>
                      <div className="col-md-6 d-flex align-items-center ">
                        <div>
                          <div>
                            <div className="art-blog">{blog?.blog_title}</div>
                            <div className="d-flex gap-3 fnt-15 pt-2 mb-ARTCLE mb-blog">
                              <div>
                                <LuCalendarDays className="mx-2 mb-1" />
                                {formatDate(blog?.blog_date)}
                              </div>
                              <div>
                                <FaRegCommentDots className="mx-2 mb-1" />{" "}
                                {blog?.comments}
                                Comments
                              </div>
                              <div>
                                <CiUser className="mx-2 mb-1" />
                                {blog?.author}
                              </div>
                            </div>
                          </div>
                          <div
                            className="art-blog-p col-grey"
                            dangerouslySetInnerHTML={{
                              __html: blog?.blog_description,
                            }}
                          ></div>
                        </div>
                      </div>
                    </div>
                  </Link>
                ))}
            </div> */}
          </div>
        </div>
      </section>
    </div>
  );
};

export default BlogList;
