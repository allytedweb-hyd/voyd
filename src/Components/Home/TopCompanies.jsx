/* eslint-disable react/jsx-key */
/* eslint-disable react-hooks/exhaustive-deps */
import Carousel from "react-multi-carousel";
import "react-multi-carousel/lib/styles.css";
import { environmentUrl } from "../../env/enviroment";
import { useEffect, useState } from "react";
import { envImgUrl } from "../../env/envImage";
import Loader from "../Spinner/Loader";

const TopCompanies = () => {
  const responsive = {
    superLargeDesktop: {
      // the naming can be any, depends on you.
      breakpoint: { max: 4000, min: 3000 },
      items: 3,
    },
    desktop: {
      breakpoint: { max: 3000, min: 1024 },
      items: 3,
    },
    tablet: {
      breakpoint: { max: 1024, min: 574 },
      items: 3,
    },
    mobile: {
      breakpoint: { max: 574, min: 0 },
      items: 2,
    },
    // mobileMini: {
    //   breakpoint: { max: 450, min: 0 },
    //   items: 1,
    // },
  };

  const [topCompanies, setTopCompanies] = useState([]);
  const [loading, setLoading] = useState(true);

  const getTopCompanies = async () => {
    try {
      setLoading(true);
      const apiUrl = `${environmentUrl}/topCompanies/get.php`;
      const options = {
        method: "GET",
      };
      const response = await fetch(apiUrl, options);
      const fetchedData = await response.json();
      const topCompaniesData = fetchedData?.response;
      setTopCompanies(topCompaniesData);
    } catch (error) {
      console.log(error);
    } finally {
      setLoading(false);
    }
  };
  useEffect(() => {
    async function company() {
      await getTopCompanies();
      setLoading(false);
    }
    company();
  }, []);
  // console.log("top companies data===", topCompanies);

  return (
    <>
      {loading && <Loader />}

      <div className="container pb-5 res-pb">
        <div className="d-flex justify-content-center mt-5 res-mrgn">
          <div>
            <h1 className="creation-txtd populer">POPULAR</h1>{" "}
          </div>
          <div>
            <h1 className="handover-txtd">Companies</h1>
          </div>
        </div>
        <div className="row brdr-grey py-3">
          <Carousel
            responsive={responsive}
            autoPlay={true}
            autoPlaySpeed={1500}
            infinite={true}
            swipeable={true}
            arrows={false}
            className="companiesFirst"
          >
            {topCompanies.length > 0 ? (
              topCompanies.map((eachCompany, index) => (
                <div className="popular-products-card" key={index}>
                  <img
                    src={`${envImgUrl}/Uploads/companies/${eachCompany.company_image}`}
                    alt={eachCompany.company_alttext}
                    key={eachCompany.company_id}
                  />
                </div>
              ))
            ) : (
              <div className="container">
                <div className="row">
                  <div className="result-container conditionImg">
                    <img src="assets/images/noDataFound.png" alt="" />
                  </div>
                </div>
              </div>
            )}
          </Carousel>
          <Carousel
            responsive={responsive}
            autoPlay={true}
            autoPlaySpeed={1500}
            infinite={true}
            swipeable={true}
            arrows={false}
            rtl={true}
            className="companiesSecond"
          >
            {topCompanies.map((eachCompany, index) => (
              <div className="popular-products-card" key={index}>
                <img
                  src={`${envImgUrl}/Uploads/companies/${eachCompany.company_image}`}
                  alt={eachCompany.company_alttext}
                  key={eachCompany.company_id}
                />
              </div>
            ))}
          </Carousel>
        </div>
      </div>
    </>
  );
};

export default TopCompanies;
