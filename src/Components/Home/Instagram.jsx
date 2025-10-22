import { BsInstagram } from "react-icons/bs";
import { Link } from "react-router-dom";

const Instagram = () => {
  return (
    <>
      <section className="instagram">
        {/* <!--Header--> */}

        <header>
          <h2 className="h6 title">
            <BsInstagram className="fa-3x" /> <br />
            VOYD Interiors
          </h2>
        </header>

        {/* <!--Gallery--> */}

        <div className="container">
          <div className="gallery clearfix">
            <Link className="item" to="#">
              <img src="assets/images/product-1.jpg" alt="Alternate Text" />
            </Link>
            <Link className="item" to="#">
              <img src="assets/images/product-2.jpg" alt="Alternate Text" />
            </Link>
            <Link className="item" to="#">
              <img src="assets/images/product-3.jpg" alt="Alternate Text" />
            </Link>
            <Link className="item" to="#">
              <img src="assets/images/product-4.jpg" alt="Alternate Text" />
            </Link>
            <Link className="item" to="#">
              <img src="assets/images/product-5.jpg" alt="Alternate Text" />
            </Link>
            <Link className="item" to="#">
              <img src="assets/images/product-6.jpg" alt="Alternate Text" />
            </Link>
          </div>
          {/* <!--/gallery--> */}
        </div>
      </section>
    </>
  );
};

export default Instagram;
