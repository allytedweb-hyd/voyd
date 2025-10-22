/* eslint-disable react/jsx-key */
// import { SlideshowLightbox } from "lightbox.js-react";
// import "lightbox.js-react/dist/index.css";

import { useEffect, useState } from "react";
import { environmentUrl } from "../env/enviroment";
import { envImgUrl } from "../env/envImage";

const PortfolioSingle = () => {
  const [galleryImage, setGalleryImage] = useState([]);

  const getGalleryImages = async () => {
    const windowUrl = window.location.search;
    const apiUrl = `${environmentUrl}/gallery/get.php${windowUrl}`;
    const options = {
      method: "GET",
    };
    const response = await fetch(apiUrl, options);
    const fetchedData = await response.json();
    const gallery = fetchedData?.response;
    setGalleryImage(gallery);
  };

  useEffect(() => {
    getGalleryImages();
  }, []);
  console.log("gallery images====", galleryImage);
  return (
    <>
      <section className="protfoliosingle pt-0 pt-0 mt--125">
        <div className="bredcum">
          <img
            src="assets/images/img-11.jpg"
            alt="lightBanner"
            className="banner-content image_zoom"
          />
          <h2 className="mt-0 mb-0">Gallery</h2>
        </div>

        <div className="container mt-5">
          {/* <h2 className="heading text-center">Gallery</h2> */}
          {/* <p className="text-center">Images related to bedroom.</p> */}

          <div className="gallery-image">
            {galleryImage.map((img, index) => (
              <div className="img-box" key={index}>
                <img
                  className="gallery-image-single"
                  src={`${envImgUrl}/Uploads/gallery/${img?.gallery_image}`}
                  alt={img?.gallery_alttext}
                  key={img?.gallery_id}
                />
              </div>
            ))}
          </div>
        </div>
      </section>
    </>
  );
};

export default PortfolioSingle;
