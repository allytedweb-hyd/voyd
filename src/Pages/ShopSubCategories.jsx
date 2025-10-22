/* eslint-disable react-hooks/exhaustive-deps */
/* eslint-disable react/jsx-key */
/* eslint-disable no-unused-vars */
import { useEffect, useState, useSearchParams } from "react";
import { environmentUrl } from "../env/enviroment";
import { envImgUrl } from "../env/envImage";
import { Link } from "react-router-dom";
import NoResults from "../Components/Shop/NoResults";

const ShopSubCategories = () => {
  const [shopSubCategories, setShopSubCategories] = useState([]);

  const getSubCategories = async () => {
    const windowUrl = window.location.search;
    const apiUrl = `${environmentUrl}/shop/getShopSubCategories.php${windowUrl}`;
    // console.log("params in url are===", apiUrl);
    const options = {
      method: "GET",
    };
    const subCategoriesFetch = await (await fetch(apiUrl, options)).json();
    const res = subCategoriesFetch?.response;
    setShopSubCategories(res);
  };
  useEffect(() => {
    getSubCategories();
  }, []);
  console.log("shop sub cate are===", shopSubCategories);
  return (
    <>
      <section className="about pt-0 pt-0 mt--125">
        {/* <!--Header--> */}

        <div className="bredcum">
          <img
            src="assets/images/shop-cat-breadcrumb.jpg"
            alt="lightBanner"
            className="banner-content image_zoom"
          />
          <h2 className="mt-0 mb-0">Shop By Sub-Categories</h2>
        </div>
        <div className="pt-5">
          <div className="container">
            <div className="row">
              {shopSubCategories === "No Data Found" ? (
                <NoResults />
              ) : (
                <div className="collection-grid-slider">
                  {shopSubCategories.map((eachSubCat, index) => (
                    <div className="collection-item" key={index}>
                      <Link
                        to={`/products?subCategory=${eachSubCat?.subcategory_id}`}
                        className="collection-grid-link"
                      >
                        <div className="img rounded-circle">
                          <img
                            className="blur-up lazyload"
                            src={`${envImgUrl}/Uploads/subcategory/${eachSubCat?.scategory_image}`}
                            alt={eachSubCat?.alt_text}
                            key={eachSubCat?.subcategory_id}
                          />
                        </div>
                        <div className="details">
                          <h3 className="collection-item-title body-font text-capitalize">
                            {eachSubCat?.sub_category}
                          </h3>
                        </div>
                      </Link>
                    </div>
                  ))}
                </div>
              )}
            </div>
          </div>
        </div>
      </section>
    </>
  );
};

export default ShopSubCategories;
