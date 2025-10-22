const BannerMasonary = () => {
  return (
    <>
      {/* <!--Banner Masonary--> */}
      <section className="collection-banners style1 mt-4">
        <div className="container">
          <div className="grid-masonary banner-grid">
            <div className="grid-sizer col-md-4 col-lg-4"></div>
            <div className="row">
              <div className="col-12 col-sm-6 col-md-4 col-lg-4 banner-item rounded">
                <div className="collection-grid-item rounded">
                  <a href="">
                    <div className="img">
                      <img
                        className="blur-up lazyload"
                        data-src="assets/images/demo5-banner1.jpg"
                        src="assets/images/demo5-banner1.jpg"
                        alt="Girls Jacket"
                        title="Girls Jacket"
                      />
                    </div>
                    <div className="details top w-100 white-text px-2 py-2">
                      <div className="inner">
                        <h3 className="title fs-3 mb-2 mt-1 body-font text-capitalize">
                          Girls Jacket
                        </h3>
                        <span className="btn--link text-uppercase fw-600">
                          Shop Now
                        </span>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
              <div className="col-12 col-sm-6 col-md-4 col-lg-4 banner-item rounded">
                <div className="collection-grid-item rounded">
                  <a href="">
                    <div className="img">
                      <img
                        className="blur-up lazyload"
                        data-src="assets/images/demo5-banner2.jpg"
                        src="assets/images/demo5-banner2.jpg"
                        alt="Toys &amp; Accessories"
                        title="Toys &amp; Accessories"
                      />
                    </div>
                    <div className="details top w-100 white-text px-2 py-2">
                      <div className="inner">
                        <h3 className="title fs-3 mb-2 mt-1 body-font text-capitalize">
                          Toys &amp; Accessories
                        </h3>
                        <span className="btn--link text-uppercase fw-600">
                          Shop Now
                        </span>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
              <div className="col-12 col-sm-6 col-md-4 col-lg-4 banner-item">
                <div className="collection-grid-item rounded">
                  <a href="">
                    <div className="img">
                      <img
                        className="blur-up lazyload"
                        data-src="assets/images/demo5-banner3.jpg"
                        src="assets/images/demo5-banner3.jpg"
                        alt="Boys Tshirt"
                        title="Boys Tshirt"
                      />
                    </div>
                    <div className="details top w-100 white-text px-2 py-2">
                      <div className="inner">
                        <h3 className="title fs-3 mb-2 mt-1 body-font text-capitalize">
                          Boys Tshirt
                        </h3>
                        <span className="btn--link text-uppercase fw-600">
                          Shop Now
                        </span>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      {/* <!--End Banner Masonary--> */}
    </>
  );
};

export default BannerMasonary;
