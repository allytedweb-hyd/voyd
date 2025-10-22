import { Link } from "react-router-dom";
import { PiHeartBold } from "react-icons/pi";
import { PiEyeLight } from "react-icons/pi";
import { HiOutlineShoppingCart } from "react-icons/hi";
const RecentlyViewed = () => {
  return (
    <>
      <section className="products">
        <header>
          <div className="container">
            <h2 className="title">Recently Visited</h2>
            <div className="text">
              <p>Check out our latest collections</p>
            </div>
          </div>
        </header>

        <div className="container">
          <div className="row">
            {/* <!--Product item--> */}

            <div className="col-6 col-lg-3">
              <article>
                <div className="info">
                  <span className="add-favorite">
                    <Link
                      to=""
                      data-title="Add to favorites"
                      data-title-added="Added to favorites list"
                    >
                      <PiHeartBold />
                    </Link>
                  </span>
                  <span>
                    <Link
                      to="#productid1"
                      className="mfp-open"
                      data-title="Quick wiew"
                    >
                      <PiEyeLight />
                    </Link>
                  </span>
                </div>
                <div className="btn btn-add">
                  <HiOutlineShoppingCart />
                </div>
                <div className="figure-grid">
                  <div className="image">
                    <Link to="product.html">
                      <img src="assets/images/product-10.jpg" alt="" />
                    </Link>
                  </div>
                  <div className="text">
                    <h2 className="title h4">
                      <Link to="product.html">Anna</Link>
                    </h2>
                    <sub>₹ 159,-</sub>
                    <sup>₹ 139,-</sup>
                    <span className="description clearfix">
                      Gubergren amet dolor ea diam takimata consetetur facilisis
                      blandit et aliquyam lorem ea duo labore diam sit et
                      consetetur nulla
                    </span>
                  </div>
                </div>
              </article>
            </div>

            {/* <!--Product item--> */}

            <div className="col-6 col-lg-3">
              <article>
                <div className="info">
                  <span className="add-favorite">
                    <Link
                      to="javascript:void(0);"
                      data-title="Add to favorites"
                      data-title-added="Added to favorites list"
                    >
                      <PiHeartBold />
                    </Link>
                  </span>
                  <span>
                    <a
                      href="#productid1"
                      className="mfp-open"
                      data-title="Quick wiew"
                    >
                      <PiEyeLight />
                    </a>
                  </span>
                </div>
                <div className="btn btn-add">
                  <HiOutlineShoppingCart />
                </div>
                <div className="figure-grid">
                  <span className="badge badge-warning">-20%</span>
                  <div className="image">
                    <Link to="product.html">
                      <img src="assets/images/product-9.jpg" alt="" />
                    </Link>
                  </div>
                  <div className="text">
                    <h2 className="title h4">
                      <Link to="product.html">Lucy</Link>
                    </h2>
                    <sub>₹ 319,-</sub>
                    <sup>₹ 219,-</sup>
                    <span className="description clearfix">
                      Gubergren amet dolor ea diam takimata consetetur facilisis
                      blandit et aliquyam lorem ea duo labore diam sit et
                      consetetur nulla
                    </span>
                  </div>
                </div>
              </article>
            </div>

            {/* <!--Product item--> */}

            <div className="col-6 col-lg-3">
              <article>
                <div className="info">
                  <span className="add-favorite">
                    <Link
                      to="javascript:void(0);"
                      data-title="Add to favorites"
                      data-title-added="Added to favorites list"
                    >
                      <PiHeartBold />
                    </Link>
                  </span>
                  <span>
                    <Link
                      to="#productid1"
                      className="mfp-open"
                      data-title="Quick wiew"
                    >
                      <PiEyeLight />
                    </Link>
                  </span>
                </div>
                <div className="btn btn-add">
                  <HiOutlineShoppingCart />
                </div>
                <div className="figure-grid">
                  <span className="badge badge-info">New arrival</span>
                  <div className="image">
                    <Link to="product.html">
                      <img src="assets/images/product-8.jpg" alt="" />
                    </Link>
                  </div>
                  <div className="text">
                    <h2 className="title h4">
                      <Link to="product.html">Ella</Link>
                    </h2>
                    <sub>₹ 899,-</sub>
                    <sup>₹ 750,-</sup>
                    <span className="description clearfix">
                      Gubergren amet dolor ea diam takimata consetetur facilisis
                      blandit et aliquyam lorem ea duo labore diam sit et
                      consetetur nulla
                    </span>
                  </div>
                </div>
              </article>
            </div>

            {/* <!--Product item--> */}

            <div className="col-6 col-lg-3">
              <article>
                <div className="info">
                  <span className="add-favorite added">
                    <Link
                      to="javascript:void(0);"
                      data-title="Add to favorites"
                      data-title-added="Added to favorites list"
                    >
                      <PiHeartBold />
                    </Link>
                  </span>
                  <span>
                    <Link
                      to="#productid1"
                      className="mfp-open"
                      data-title="Quick wiew"
                    >
                      <PiEyeLight />
                    </Link>
                  </span>
                </div>
                <div className="btn btn-add">
                  <HiOutlineShoppingCart />
                </div>
                <div className="figure-grid">
                  <div className="image">
                    <Link to="product.html">
                      <img src="assets/images/product-7.jpg" alt="" />
                    </Link>
                  </div>
                  <div className="text">
                    <h2 className="title h4">
                      <Link to="product.html">Grace</Link>
                    </h2>
                    <sub>₹ 699/-</sub>
                    <sup>₹ 499/-</sup>
                    <span className="description clearfix">
                      Gubergren amet dolor ea diam takimata consetetur facilisis
                      blandit et aliquyam lorem ea duo labore diam sit et
                      consetetur nulla
                    </span>
                  </div>
                </div>
              </article>
            </div>
          </div>
          {/* <!--/row--> */}
        </div>
        {/* <!--/container--> */}
      </section>
    </>
  );
};

export default RecentlyViewed;
