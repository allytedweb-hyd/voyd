import { Link } from "react-router-dom";
const NotFound = () => {
  return (
    <>
      <section className="notFoundSection">
        <div className="container">
          <div className="foundContentOuter">
            <div className="foundContentInner">
              <div className="foundContent">
                <div className="image">
                  <h3>Page Not Found</h3>
                  <img src="assets/images/404.png" alt="" />
                  <div className="backButton">
                    <img src="assets/images/toyy.png" alt="" />
                    <Link to="/">
                      <button type="submit">BACK TO HOMEPAGE</button>
                    </Link>
                  </div>
                  <p>
                    We're sorry — the page you requested could not be found. {" "}
                    <br />
                    Please go back to the home page
                  </p>
                </div>
              </div>
              <div className="sideIcons">
                <div className="first">
                  <img src="assets/images/side1.png" alt="" />
                </div>
                <div className="second">
                  <img src="assets/images/side2.png" alt="" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </>
  );
};

export default NotFound;
