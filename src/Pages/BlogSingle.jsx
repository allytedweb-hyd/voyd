import { ImUser } from "react-icons/im";
import { BiSolidCalendar } from "react-icons/bi";
import { FaComments } from "react-icons/fa";
import { Link } from "react-router-dom";
import { useEffect, useState } from "react";
import { environmentUrl } from "../env/enviroment";

const BlogSingle = () => {
  const [singleBlog, setSingleBlog] = useState([]);
  const getSingleBlog = async () => {
    const windowUrl = window.location.search;
    const apiUrl = `${environmentUrl}/blogs/getSingleBlog.php${windowUrl}`;
    const options = {
      method: "GET",
    };
    const response = await (await fetch(apiUrl, options)).json();
    const fetchedData = response?.response;
    setSingleBlog(fetchedData);
  };

  useEffect(() => {
    getSingleBlog();
  }, []);
  console.log("single blog response is", singleBlog);

  return (
    <>
      <section className="blog pt-0 pt-0 mt--125">
        {/* <!--Header--> */}

        <div className="bredcum">
          <img
            src="assets/images/img-6.jpg"
            alt="lightBanner"
            className="banner-content image_zoom"
          />
          <h2 className="mt-0 mb-0">Blog Single</h2>
        </div>

        <header>
          <div className="container">
            <h2 className="title">
              In Virtual Reality, How Much <br />
              Body Do You Need?
            </h2>
          </div>
        </header>

        <div className="container">
          <div className="row">
            <div className="col-lg-9">
              {/* <!--Blog post--> */}

              <div className="blog-post">
                {/* <!--Blog content--> */}

                <div className="blog-post-content pt-0">
                  {/* <!--Title--> */}

                  <div className="blog-post-title">
                    {/* <h1 className="h1 blog-title">
                                        In Virtual Reality, How Much <br />Body Do You Need?
                                    </h1> */}

                    <h2 className="blog-subtitle h5">
                      It might be as little as a pair of hands and feet,
                      researchers in Japan found after recording subjects who
                      wore an Oculus Rift headset.
                    </h2>

                    <hr />

                    {/* <!--Info--> */}

                    <div className="blog-info">
                      <div className="entry">
                        <ImUser className="mr-2" />
                        <span>John Doe</span>
                      </div>
                      <div className="entry">
                        <BiSolidCalendar className="mr-2" />
                        <span>03.03.2017</span>
                      </div>
                      <div className="entry">
                        <FaComments className="mr-2" />
                        <span>4 comments</span>
                      </div>
                    </div>

                    <hr />
                  </div>

                  {/* <!--Main image--> */}

                  <div className="blog-image-main">
                    <img src="assets/images/product-5.jpg" alt="" />
                  </div>

                  {/* <!--Blog text--> */}

                  <div className="blog-post-text">
                    <h4>How connected are your body and your consciousness?</h4>
                    <p>
                      When Michiteru Kitazaki, a professor of engineering at
                      Toyohashi University of Technology in Japan, recently
                      posed this question in an email, he evoked an idea from
                      Japanese culture known as tamashii, or the soul without a
                      body.
                    </p>
                    <h4>
                      What furniture styles are the easiest to add to your
                      space?
                    </h4>
                    <p>
                      When you bring new furniture into your home, you don’t
                      have to stay with the same style as your existing decor.
                      That said, there are styles that are easier to
                      incorporate. Look for furniture that has simple and clean
                      lines, like contemporary and mid-century modern pieces.
                      Adding these styles can also give your space a trendy
                      update without a big price tag.{" "}
                    </p>
                    <p>
                      Transitional is a comfortable style that draws from
                      traditional and contemporary lines. This popular style
                      works well for updating a traditional home without going
                      in an entirely different decorating direction.
                    </p>
                    <p>
                      If your room already has a strong style story, simple
                      additions won’t detract from what you already have in
                      there. If your room is neutral or decorated in simple
                      furnishings, then look for dynamic new pieces that give
                      your space that pulled-together look.{" "}
                    </p>
                    {/* <p>
                      <img
                        src="assets/images/product-4.jpg"
                        alt="This is an alternative image description. It will generate auto caption."
                      />
                    </p>
                    <h4>
                      How to use color to style your new and old furniture
                      together
                    </h4>
                    <p>
                      Color is the element that can tie your existing furniture
                      with your newly-purchased pieces. Using color as the
                      unifying feature in your space is a simple way to make
                      your new style look effortless. Here’s how to make the
                      most out of color in your room
                    </p>
                    <ul>
                      <li>
                        Use Your Existing Color Palette: If you love your color
                        palette now, then shop for new furniture and decor that
                        works with everything you already have — simple!
                      </li>
                      <li>
                        Add One or Two New Accent Colors: Have fun with color by
                        adding new decor to your color scheme.
                      </li>
                      <li>
                        Use Accessories: Colorful accessories can serve as a
                        bridge between all of your furniture. Add throw pillows,
                        artwork and decorative items with colors from your
                        existing and new furniture.
                      </li>
                    </ul>
                    <p>
                      Will it soon be possible, he wondered, to simulate the
                      feeling of a spirit not attached to any particular
                      physical form using virtual or augmented reality?
                    </p>
                    <p>
                      If so, a good place to start would be to figure out the
                      minimal amount of body we need to feel a sense of self,
                      especially in digital environments where more and more
                      people may find themselves for work or play. It might be
                      as little as a pair of hands and feet, report Dr. Kitazaki
                      and a Ph.D. student, Ryota Kondo.
                    </p>
                    <p>
                      <img
                        src="assets/images/product-2.jpg"
                        alt="This is an alternative image description. It will generate auto caption."
                      />
                    </p>
                    <p>
                      In a paper published Tuesday in Scientific Reports, they
                      showed that animating virtual hands and feet alone is
                      enough to make people feel their sense of body drift
                      toward an invisible avatar.
                    </p>
                    <h4>Virtual reality</h4>
                    <p>
                      The original body ownership trick was the rubber-hand
                      illusion. In the 1990s, researchers found that if they hid
                      a person’s actual hand behind a partition, placed a rubber
                      hand in view next to it and repeatedly tapped and stroked
                      the real and fake hand in synchrony, the subject would
                      soon eerily start to feel sensation in the rubber hand.
                    </p>
                    <p>
                      Today, technologists working on virtual reality are using
                      modern-day riffs on the rubber-hand illusion to understand
                      how users will adjust when presented with digital bodies
                      that do not match their own. Some researchers have
                      suggested that having users digitally swap bodies with
                      people of other races, genders, ages or abilities could
                      reduce implicit bias, though this work has its limits.
                    </p>
                    <p>
                      Using an Oculus Rift virtual reality headset and a motion
                      sensor, Dr. Kitazaki’s team performed a series of
                      experiments in which volunteers watched disembodied hands
                      and feet move two meters in front of them in a virtual
                      room. In one experiment, when the hands and feet mirrored
                      the participants’ own movements, people reported feeling
                      as if the space between the appendages were their own
                      bodies.
                    </p>
                    <p>
                      This demonstrates the power of synchronized actions and
                      our brain’s ability to fill in missing information, said
                      V.S. Ramachandran, a professor at the University of
                      California, San Diego and rubber-hand illusion pioneer who
                      did not participate in the new study. The “improbability
                      of synchrony occurring by chance” overrides all other
                      information, he said, even knowledge that an invisible
                      body cannot be yours.
                    </p> */}
                  </div>

                  {/* <!--/blog-info--> */}
                </div>
                {/* <!--/blog-post-content--> */}
              </div>
              {/* <!--/comments--> */}
            </div>
            {/* <!--col-sm-8--> */}
            {/* <!--Blog menu--> */}

            <div className="col-lg-3">
              <aside>
                {/* <!--Box search--> */}

                <div className="box box-search">
                  <input
                    type="text"
                    value=""
                    className="form-control"
                    placeholder="Search the blog"
                  />
                  <button className="btn btn-primary btn-sm blog">
                    Search
                  </button>
                </div>

                {/* <!--Box categories--> */}

                <div className="box box-animated box-categories">
                  <h5 className="title">Blog categories</h5>
                  <ul>
                    <li>
                      <Link to="#">Interiors</Link>
                    </li>
                    <li className="active">
                      <Link to="#">Design & decorate</Link>
                    </li>
                    <li>
                      <Link to="#">Entertainment</Link>
                    </li>
                    <li>
                      <Link to="#">Heating & Cooling</Link>
                    </li>
                    <li>
                      <Link to="#">Living room</Link>
                    </li>
                    <li>
                      <Link to="#">Kitchen</Link>
                    </li>
                    <li>
                      <Link to="#">Small spaces</Link>
                    </li>
                  </ul>
                </div>

                {/* <!--Box posts--> */}

                <div className="box box-animated box-posts">
                  <h5 className="title">Popular posts</h5>
                  <ul>
                    <li>
                      <Link to="#">
                        <span className="date">
                          <span>Sep</span>
                          <span>22</span>
                        </span>
                        <span className="text">
                          How to Keep Your Heating and Cooling Vents Clean
                        </span>
                      </Link>
                    </li>
                    <li>
                      <Link to="#">
                        <span className="date">
                          <span>Aug</span>
                          <span>19</span>
                        </span>
                        <span className="text">
                          How to Keep Your Heating and Cooling Vents Clean
                        </span>
                      </Link>
                    </li>
                    <li>
                      <Link to="#">
                        <span className="date">
                          <span>Jul</span>
                          <span>18</span>
                        </span>
                        <span className="text">
                          Steal these 3 Home Design Trends for Wedding
                          Decorating Ideas
                        </span>
                      </Link>
                    </li>
                    <li>
                      <Link to="#">
                        <span className="date">
                          <span>Jun</span>
                          <span>07</span>
                        </span>
                        <span className="text">
                          Caring for Windows: 5 Tips for People in Glass Houses
                        </span>
                      </Link>
                    </li>
                  </ul>
                </div>

                {/* <!--Box tags--> */}

                <div className="box box-tags">
                  <h5 className="title">Popular posts</h5>
                  <ul className="clearfix">
                    <li>
                      <Link to="#" className="btn btn-outline-secondary btn-sm">
                        Furniture
                      </Link>
                    </li>
                    <li>
                      <Link to="#" className="btn btn-outline-secondary btn-sm">
                        Interior
                      </Link>
                    </li>
                    <li>
                      <Link to="#" className="btn btn-outline-secondary btn-sm">
                        Living
                      </Link>
                    </li>
                    <li>
                      <Link to="#" className="btn btn-outline-secondary btn-sm">
                        Space
                      </Link>
                    </li>
                    <li>
                      <Link to="#" className="btn btn-outline-secondary btn-sm">
                        Modern
                      </Link>
                    </li>
                    <li>
                      <Link to="#" className="btn btn-outline-secondary btn-sm">
                        House
                      </Link>
                    </li>
                    <li>
                      <Link to="#" className="btn btn-outline-secondary btn-sm">
                        Guides
                      </Link>
                    </li>
                    <li>
                      <Link to="#" className="btn btn-outline-secondary btn-sm">
                        How to
                      </Link>
                    </li>
                    <li>
                      <Link to="#" className="btn btn-outline-secondary btn-sm">
                        Kitchen
                      </Link>
                    </li>
                  </ul>
                </div>
              </aside>
            </div>
            {/* <!--/col-lg-3--> */}
          </div>
          {/* <!--/row--> */}
        </div>
        {/* <!--/container--> */}
      </section>
    </>
  );
};

export default BlogSingle;
