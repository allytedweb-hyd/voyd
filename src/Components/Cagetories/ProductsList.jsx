import { Link } from "react-router-dom";

const ProductsList = () => {
  return (
    <>
      <section className="products">
        {/* <!--Header--> */}

        <header>
          <div className="container">
            <h2 className="title">Shop by brand</h2>
          </div>
        </header>

        <div className="container">
          <div className="row">
            {/* <!--Product item--> */}

            <div className="col-6 col-lg-4">
              <article>
                <div className="figure-block">
                  <div className="image">
                    <Link to="">
                      <img
                        src="assets/images/item-1.jpg"
                        alt=""
                        width="360"
                      />
                    </Link>
                  </div>
                  <div className="text">
                    <h2 className="title h4">
                      <Link to="">Kitchen</Link>
                    </h2>
                  </div>
                </div>
              </article>
            </div>

            {/* <!--Product item--> */}

            <div className="col-6 col-lg-4">
              <article>
                <div className="figure-block">
                  <div className="image">
                    <Link to="">
                      <img
                        src="assets/images/item-2.jpg"
                        alt=""
                        width="360"
                      />
                    </Link>
                  </div>
                  <div className="text">
                    <h2 className="title h4">
                      <Link to="">Living room</Link>
                    </h2>
                  </div>
                </div>
              </article>
            </div>

            {/* <!--Product item--> */}

            <div className="col-6 col-lg-4">
              <article>
                <div className="figure-block">
                  <div className="image">
                    <Link to="">
                      <img
                        src="assets/images/item-4.jpg"
                        alt=""
                        width="360"
                      />
                    </Link>
                  </div>
                  <div className="text">
                    <h2 className="title h4">
                      <a href="products-grid.html">Project planning</a>
                    </h2>
                  </div>
                </div>
              </article>
            </div>
          </div>
          {/* <!--/row--> */}
        </div>
      </section>
    </>
  );
};

export default ProductsList;
