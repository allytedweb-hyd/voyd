import React from 'react';

const OurServices = () => {
  return (
    <div>
      <section className="pdng-section-top pdng-sc-btm">
        <div className="container">
          <div className="row justify-content-center">
            <div>
              <div className="cinzel-hdng text-center">
                Our <span className="inter-hdng">Services</span>
              </div>
              <div className="text-center ">
                <p className="mb-1 p-vison">
                  We offer bespoke interior design solutions tailored to your needs,
                </p>
              </div>
              <div className="text-center pb-3">
                <p className="p-vison">
                  ensuring every space is both beautiful and functional.
                </p>
              </div>
            </div>
          </div>

          <div className="row mb-js">
            {/* Chair & Furniture */}
            <div className="col-md-4 col-sm-6 mb-res">
              <div className="card b-none">
                <div>
                  <img
                    className="card-img-top"
                    src="assets/images/Image Placeholder.png"
                    alt="Chair and Furniture"
                  />
                </div>
                <div className="card-body mx-ht">
                  <p className="card-text">
                    Discover our curated collection of chairs and furniture, designed to blend
                    comfort with exquisite style. Each piece is crafted with meticulous attention
                    to detail, ensuring both functionality and aesthetic appeal in your space.
                  </p>
                </div>
              </div>
            </div>

            {/* Table Furniture */}
            <div className="col-md-4 col-sm-6 mb-res">
              <div className="card b-none">
                <div>
                  <img
                    className="card-img-top"
                    src="assets/images/Image Placeholder (1).png"
                    alt="Table Furniture"
                  />
                </div>
                <div className="card-body mx-ht">
                  <p className="card-text">
                    Explore our elegant range of table furniture, perfectly combining form and
                    function. From dining tables to coffee tables, each piece is crafted to
                    enhance your space with timeless style and durability.
                  </p>
                </div>
              </div>
            </div>

            {/* Bed Furniture */}
            <div className="col-md-4 col-sm-6 mb-res ">
              <div className="card b-none card-nw-styles">
                <div>
                  <img
                    className="card-img-top"
                    src="assets/images/Image Placeholder (2).png"
                    alt="Bed Furniture"
                  />
                </div>
                <div className="card-body mx-ht">
                  <p className="card-text">
                    Transform your bedroom with our stylish bed furniture, designed for both
                    comfort and sophistication. Our range features durable materials and elegant
                    finishes, ensuring a restful retreat that complements your personal style.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
};

export default OurServices;
