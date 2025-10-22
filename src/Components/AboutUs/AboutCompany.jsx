/* eslint-disable react-hooks/exhaustive-deps */
import { useEffect, useState } from "react";
import { environmentUrl } from "../../env/enviroment";

const AboutCompany = () => {
  const [aboutData, setAboutData] = useState([]);
  const getAboutData = async () => {
    const apiUrl = `${environmentUrl}/about/aboutCompany.php`;
    const options = {
      method: "POST",
    };
    const fetchedData = await (await fetch(apiUrl, options)).json();
    const response = fetchedData?.response;
    setAboutData(response);
    // console.log("about data is=====", response);
  };

  useEffect(() => {
    getAboutData();
  }, []);
  console.log("about data set state is=====", aboutData);

  return (
    <>
      <section className="about pt-0 pt-0 mt--125">
        {/* <!--Header--> */}

        <div className="bredcum">
          <img
            src="assets/images/multi-banners/logo_make_11_06_2023_308.jpg"
            alt="lightBanner"
            className="banner-content image_zoom"
          />
          <h2 className="mt-0 mb-0">About us</h2>
        </div>

        <div className="pt-5">
          <div className="container">
            <div className="row">
              <div className="col-md-4">
                <h4>FYI(Find Your Interiors)</h4>
                <p
                  className="aboutcontentt"
                  dangerouslySetInnerHTML={{
                    __html: aboutData[0]?.about_description,
                  }}
                ></p>
              </div>
              <div className="col-md-4">
                <h4>Our success</h4>
                <p
                  className="aboutcontentt"
                  dangerouslySetInnerHTML={{
                    __html: aboutData[1]?.about_description,
                  }}
                ></p>
              </div>
              <div className="col-md-4">
                <h4>What we beleive in</h4>
                <p
                  className="aboutcontentt"
                  dangerouslySetInnerHTML={{
                    __html: aboutData[2]?.about_description,
                  }}
                ></p>
              </div>
            </div>
          </div>
        </div>
      </section>
    </>
  );
};

export default AboutCompany;
