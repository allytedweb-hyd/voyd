import OfferBanners from "../Components/Shop/OfferBanners";
import ShopCategorie from "../Components/Shop/ShopCategorie";
import ShopCategories from "../Components/Shop/ShopCategories";
import ShopDiscout from "../Components/Shop/ShopDiscout";
import ShopProducts from "../Components/Shop/ShopProducts";
import StoreFeatures from "../Components/Shop/StoreFeatures";

const Shop = () => {
  return (
    <>
      {/* <OfferBanners />
      <ShopCategories />
      <StoreFeatures />  */}
      <ShopCategorie />
      <ShopProducts />
      <ShopDiscout/>

    </>
  );
};

export default Shop;
