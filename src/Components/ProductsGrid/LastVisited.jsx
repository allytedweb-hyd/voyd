import { HiOutlineHeart } from "react-icons/hi2";
import { FaRegEye } from "react-icons/fa";
import { HiOutlineShoppingCart } from "react-icons/hi2";

const LastVisited = () => {
  return (
    <>
      <section className="products">
        <header>
          <div className="container">
            <h2 className="title">Last visited</h2>
            <div className="text">
              <p>Check out our latest collections</p>
            </div>
          </div>
        </header>

        <div className="container">
          <div className="scroll-wrapper">
            <div className="row scroll">
              {/* <!--Product item--> */}

              <div className="col-6 col-lg-4">
                <article>
                  <div className="info">
                    <span className="add-favorite">
                      <a
                        href="javascript:void(0);"
                        data-title="Add to favorites"
                        data-title-added="Added to favorites list"
                      >
                        <HiOutlineHeart />
                      </a>
                    </span>
                    <span>
                      <a
                        href="#productid1"
                        className="mfp-open"
                        data-title="Quick wiew"
                      >
                        <FaRegEye />
                      </a>
                    </span>
                  </div>
                  <div className="btn btn-add">
                    <HiOutlineShoppingCart />
                  </div>
                  <div className="figure-grid">
                    <div className="image">
                      <a href="product.html">
                        <img src="assets/images/product-10.jpg" alt="" />
                      </a>
                    </div>
                    <div className="text">
                      <h2 className="title h4">
                        <a href="product.html">Anna</a>
                      </h2>
                      <sub>₹ 159,-</sub>
                      <sup>₹ 139,-</sup>
                      <span className="description clearfix">
                        Gubergren amet dolor ea diam takimata consetetur
                        facilisis blandit et aliquyam lorem ea duo labore diam
                        sit et consetetur nulla
                      </span>
                    </div>
                  </div>
                </article>
              </div>

              {/* <!--Product item--> */}

              <div className="col-6 col-lg-4">
                <article>
                  <div className="info">
                    <span className="add-favorite">
                      <a
                        href="javascript:void(0);"
                        data-title="Add to favorites"
                        data-title-added="Added to favorites list"
                      >
                        <HiOutlineHeart />
                      </a>
                    </span>
                    <span>
                      <a
                        href="#productid1"
                        className="mfp-open"
                        data-title="Quick wiew"
                      >
                        <FaRegEye />
                      </a>
                    </span>
                  </div>
                  <div className="btn btn-add">
                    <HiOutlineShoppingCart />
                  </div>
                  <div className="figure-grid">
                    <span className="badge badge-warning">-20%</span>
                    <div className="image">
                      <a href="product.html">
                        <img src="assets/images/product-9.jpg" alt="" />
                      </a>
                    </div>
                    <div className="text">
                      <h2 className="title h4">
                        <a href="product.html">Lucy</a>
                      </h2>
                      <sub>₹ 319,-</sub>
                      <sup>₹ 219,-</sup>
                      <span className="description clearfix">
                        Gubergren amet dolor ea diam takimata consetetur
                        facilisis blandit et aliquyam lorem ea duo labore diam
                        sit et consetetur nulla
                      </span>
                    </div>
                  </div>
                </article>
              </div>

              {/* <!--Product item--> */}

              <div className="col-6 col-lg-4">
                <article>
                  <div className="info">
                    <span className="add-favorite">
                      <a
                        href="javascript:void(0);"
                        data-title="Add to favorites"
                        data-title-added="Added to favorites list"
                      >
                        <HiOutlineHeart />
                      </a>
                    </span>
                    <span>
                      <a
                        href="#productid1"
                        className="mfp-open"
                        data-title="Quick wiew"
                      >
                        <FaRegEye />
                      </a>
                    </span>
                  </div>
                  <div className="btn btn-add">
                    <HiOutlineShoppingCart />
                  </div>
                  <div className="figure-grid">
                    <span className="badge badge-info">New arrival</span>
                    <div className="image">
                      <a href="product.html">
                        <img src="assets/images/product-8.jpg" alt="" />
                      </a>
                    </div>
                    <div className="text">
                      <h2 className="title h4">
                        <a href="product.html">Ella</a>
                      </h2>
                      <sub>₹ 899,-</sub>
                      <sup>₹ 750,-</sup>
                      <span className="description clearfix">
                        Gubergren amet dolor ea diam takimata consetetur
                        facilisis blandit et aliquyam lorem ea duo labore diam
                        sit et consetetur nulla
                      </span>
                    </div>
                  </div>
                </article>
              </div>
            </div>
            {/* <!--/row--> */}
          </div>
        </div>
        {/* <!--/container--> */}
      </section>
    </>
  );
};

export default LastVisited;
