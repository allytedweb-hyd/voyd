/* eslint-disable react-hooks/exhaustive-deps */
import { useEffect, useState } from "react";
import Carousel from "react-multi-carousel";
import "react-multi-carousel/lib/styles.css";
import { Tab, Tabs, TabList, TabPanel } from "react-tabs";
import "react-tabs/style/react-tabs.css";
import { environmentUrl } from "../../env/enviroment";

const BrandsWeUse = () => {



  const responsive = {
    superLargeDesktop: {
      // the naming can be any, depends on you.
      breakpoint: { max: 4000, min: 3000 },
      items: 5,
    },
    desktop: {
      breakpoint: { max: 3000, min: 1024 },
      items: 1,
    },
    tablet: {
      breakpoint: { max: 1024, min: 464 },
      items: 1,
    },
    mobile: {
      breakpoint: { max: 464, min: 0 },
      items: 1,
    },
  };


  

  const [tabCategory, setTabCategory] = useState('Kitchen')
  const getTabValue = (event) => {
    const brandCat = event.currentTarget.getAttribute("data-value")
    setTabCategory(brandCat)
    getBrandsData()
  };

  const [getBrands, setGetBrands] = useState([]);
  const getBrandsData = async () => {
    const apiUrl = `${environmentUrl}/brands/get.php?brandCategory=${tabCategory}`
    const options = {
      method:"GET"
    }
    const fetchedData = await (await fetch(apiUrl, options)).json();
    const brandsRes = fetchedData?.response 
    setGetBrands(brandsRes)

  }

  useEffect(() => {
    getBrandsData()
  }, [])
  
  console.log("brands data====", getBrands);

  return (
    <>
      <div className="site-heading text-center mt-5  mb-2">
        <h2 className="h2 title">Brands we use</h2>
      </div>

      <Tabs>
        <TabList className="why-choose-nav brands weuse" >
          <Tab className="why-choose-nav-item brands"  data-value="Kitchen" onClick={getTabValue}>
            Kitchen
          </Tab>
          <Tab className="why-choose-nav-item brands" data-value="Paints" onClick={getTabValue}>
            Paints
          </Tab>
          <Tab className="why-choose-nav-item brands"  data-value="Ply-Wood" onClick={getTabValue}>
            Ply-wood
          </Tab>
          <Tab className="why-choose-nav-item brands" data-value="Sanitary" onClick={getTabValue}>
            Sanitary
          </Tab>
          <Tab className="why-choose-nav-item brands"  data-value="Electrical"  onClick={getTabValue}>
            Electrical
          </Tab>
          <span className="nav-indicator"></span>
        </TabList>
        <TabPanel>
          <Carousel
            responsive={responsive}
            autoPlay={true}
            autoPlaySpeed={1500}
            infinite={true}
            swipeable={true}
            arrows={false}
            className="header-content container-fluid"
          >
            <div className="testimonial-slider container">
              <div className="testimonials-inner-slider">
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-1.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-2.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-3.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-5.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-6.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-7.webp"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-8.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-9.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-10.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-11.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-1.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-2.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-3.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-5.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-6.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-7.webp"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-8.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-9.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-10.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-11.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-1.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-2.png"
                    alt=""
                  />
                </div>
              </div>
            </div>
            <div className="testimonial-slider container">
              <div className="testimonials-inner-slider">
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-1.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-2.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-3.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-5.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-6.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-7.webp"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-8.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-9.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-10.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-11.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-1.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-2.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-3.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-5.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-6.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-7.webp"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-8.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-9.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-10.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-11.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-1.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-2.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-2.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-5.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/kitchen/kitchen-4.png"
                    alt=""
                  />
                </div>
              </div>
            </div>
          </Carousel>
        </TabPanel>
        <TabPanel>
          <Carousel
            responsive={responsive}
            autoPlay={true}
            autoPlaySpeed={1500}
            infinite={true}
            swipeable={true}
            arrows={false}
            className="header-content container-fluid"
          >
            <div className="testimonial-slider container">
              <div className="testimonials-inner-slider">
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/paints/paint-1.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/paints/paint-2.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/paints/paint-3.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/paints/paint-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/paints/paint-2.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/paints/paint-1.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/paints/paint-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/paints/paint-3.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/paints/paint-1.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/paints/paint-2.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/paints/paint-3.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/paints/paint-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/paints/paint-2.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/paints/paint-1.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/paints/paint-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/paints/paint-3.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/paints/paint-1.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/paints/paint-2.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/paints/paint-3.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/paints/paint-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/paints/paint-2.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/paints/paint-1.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/paints/paint-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/paints/paint-3.png"
                    alt=""
                  />
                </div>
              </div>
            </div>
          </Carousel>
        </TabPanel>
        <TabPanel>
          <Carousel
            responsive={responsive}
            autoPlay={true}
            autoPlaySpeed={1500}
            infinite={true}
            swipeable={true}
            arrows={false}
            className="header-content container-fluid"
          >
            <div className="testimonial-slider container">
              <div className="testimonials-inner-slider">
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-1.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-2.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-3.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-5.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-6.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-4.png"
                    alt=""
                  />
                </div>
              </div>
            </div>
            <div className="testimonial-slider container">
              <div className="testimonials-inner-slider">
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-1.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-2.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-3.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-5.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-6.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-4.png"
                    alt=""
                  />
                </div>
              </div>
            </div>
            <div className="testimonial-slider container">
              <div className="testimonials-inner-slider">
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-1.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-2.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-3.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-5.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-6.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/ply-wood/plywood-4.png"
                    alt=""
                  />
                </div>
              </div>
            </div>
          </Carousel>
        </TabPanel>
        <TabPanel>
          <Carousel
            responsive={responsive}
            autoPlay={true}
            autoPlaySpeed={1500}
            infinite={true}
            swipeable={true}
            arrows={false}
            className="header-content container-fluid"
          >
            <div className="testimonial-slider container">
              <div className="testimonials-inner-slider">
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/sanitary/sanitary-1.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/sanitary/sanitary-2.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/sanitary/sanitary-3.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/sanitary/sanitary-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/sanitary/sanitary-5.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/sanitary/sanitary-6.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/sanitary/sanitary-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/sanitary/sanitary-3.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/sanitary/sanitary-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/sanitary/sanitary-3.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/sanitary/sanitary-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/sanitary/sanitary-3.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/sanitary/sanitary-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/sanitary/sanitary-3.png"
                    alt=""
                  />
                </div>
              </div>
            </div>
          </Carousel>
        </TabPanel>
        <TabPanel>
          <Carousel
            responsive={responsive}
            autoPlay={true}
            autoPlaySpeed={1500}
            infinite={true}
            swipeable={true}
            arrows={false}
            className="header-content container-fluid"
          >
            <div className="testimonial-slider container">
              <div className="testimonials-inner-slider">
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/electrical/electrical-1.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/electrical/electrical-2.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/electrical/electrical-3.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/electrical/electrical-4.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/electrical/electrical-5.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/electrical/electrical-6.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/electrical/electrical-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/electrical/electrical-3.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/electrical/electrical-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/electrical/electrical-3.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/electrical/electrical-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/electrical/electrical-3.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/electrical/electrical-7.png"
                    alt=""
                  />
                </div>
                <div className="brand-we-use-card">
                  <img
                    src="assets/images/brands_we_use/electrical/electrical-3.png"
                    alt=""
                  />
                </div>
              </div>
            </div>
          </Carousel>
        </TabPanel>
      </Tabs>
    </>
  );
};

export default BrandsWeUse;
