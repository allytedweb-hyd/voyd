import OfferBanners from "../Components/Shop/OfferBanners";
import ShopCategorie from "../Components/Shop/ShopCategorie";
import ShopCategories from "../Components/Shop/ShopCategories";
import ShopDiscout from "../Components/Shop/ShopDiscout";
import ShopProducts from "../Components/Shop/ShopProducts";
import StoreFeatures from "../Components/Shop/StoreFeatures";
import SEO from "../Components/SEO";

const Shop = () => {
  return (
    <>
      <SEO
        title="VOYD Shop | Curated Products for Inspired Living"
        description="Explore furniture, décor, lighting, and interior essentials curated by room, category, and design style."
        keywords="Interior products for home, living room furniture, inteior items, interior products online, home decor products, furniture online, interior shopping, home furnishing store, interior decor store, premium home decor, interior products marketplace, home improvement products, interior accessories buy interior products online, shop home decor online, furniture and decor store, online interior shopping, home decor marketplace, premium furniture online, interior products shop, home styling products
interior essentials online, room decor products"
      />
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
