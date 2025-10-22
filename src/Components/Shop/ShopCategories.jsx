/* eslint-disable react/jsx-key */
import { environmentUrl } from "../../env/enviroment";
import { useState, useEffect } from "react";
import { envImgUrl } from "../../env/envImage";
import { Link } from "react-router-dom";
import NoResults from "./NoResults";
import Loader from "../Spinner/Loader";

const ShopCategories = () => {
  const [shopCategories, setShopCategories] = useState([]);
  const [loading, setLoading] = useState(true);


  const getShopCategories = async () => {
    const apiUrl = `${environmentUrl}/shop/getShopCategories.php`;
    const options = {
      method: "GET",
    };
    const shopfetch = await fetch(apiUrl, options);
    const shopCatRes = await shopfetch.json();
    const res = shopCatRes?.response;
    setShopCategories(res);
  };

  useEffect(() => {
    async function catgeories() {
      await getShopCategories();
      setLoading(false);
    }
    catgeories();
  }, []);
  console.log("shop categories===", shopCategories);

  return (
    <>
      {loading && <Loader />}
      {!loading && (

        <>
          {/* <!--Collection Slider Section--> */}
          <section className="section collection-slider background-none">
            <div className="container">
              <div className="ecom-section-header">
                <h2>Shop By Category</h2>
              </div>
              {shopCategories === "No Data Found" ? (
                <NoResults />
              ) : (
                <div className="collection-grid-slider">
                  {shopCategories.map((eachCat, index) => (
                    <div className="collection-item" key={index}>
                      <Link
                        to={`/shopSubcategories?category=${eachCat.category_id}`}
                        className="collection-grid-link"
                      >
                        <div className="img rounded-circle">
                          <img
                            className="blur-up lazyload"
                            src={`${envImgUrl}/Uploads/category/${eachCat.category_image}`}
                            alt={eachCat.alt_text}
                            key={eachCat.category_id}
                          />
                        </div>
                        <div className="details">
                          <h3 className="collection-item-title body-font text-capitalize">
                            {eachCat.category_name}
                          </h3>
                        </div>
                      </Link>
                    </div>
                  ))}
                </div>
              )}
            </div>
          </section>
          {/* <!--Collection Slider Section--> */}
        </>
      )}
    </>
  );
};

export default ShopCategories;
