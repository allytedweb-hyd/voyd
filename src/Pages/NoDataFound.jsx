const NoDataFound = () => {
  return (
    <div>
      <section className="pos-rel bg-nodata">
        <div>
          <img
            src="assets/images/Group 1618873927 (1) 1.png"
            alt=""
            className="leaf-str"
          />
        </div>
        <div className="container no-data-s">
          <div className="row">
            <div className="col-md-8  flx-col1">
              <div className="no-data">Data Not Found</div>
              {/* <div className="text-start d-ddd homeBt">
                <button className="cta-button1">GO BACK TO HOMEPAGE</button>
              </div> */}
            </div>
            <div className="col-md-4 map-container1">
              <div className="mob-flexxy">
                <img
                  src="assets/images/Frame 2147223333 (1).png"
                  alt=""
                  className="locker-img"
                />
              </div>
              {/* <div className="d-nnn mob-flexxy">
                <button className="cta-button1">GO BACK TO HOMEPAGE</button>
              </div> */}
            </div>
          </div>
        </div>
      </section>
    </div>
  );
};

export default NoDataFound;
