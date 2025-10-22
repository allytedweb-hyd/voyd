/* eslint-disable no-unused-vars */
// eslint-disable-next-line no-unused-vars
import { Suspense, lazy } from "react";
import { Route, Routes } from "react-router-dom";
import Loader from "../Components/Spinner/Loader";
// import DesignChanges from "../Components/Home/DesignChanges";
import SlideShow from "../Components/Home/SlideShow";
import NewSlider from "../Components/Home/NewSlider";
import Cotation from "../Pages/Cotation";
import ProjectDetails from "../Pages/ProjectDetails";
import Services from "../Pages/Services";
import QualityChcker from "../Pages/QualityChcker";
import ShopByCategory from "../Pages/ShopByCategory";
import SingleCategory from "../Pages/SingleCategory";
import QueryPopup from "../Pages/QueryPopup";
import ReferalDetails from "../Pages/ReferalDetails";
import EcommerceFilter from "../Components/Shop/EcommerceFilter";
import MyCart from "../Pages/MyCart";

const LazyLoader = () => {
  const Login = lazy(() => import("../Pages/Login"));
  const Register = lazy(() => import("../Pages/SignUp"));
  const Home = lazy(() => import("../Pages/Home"));
  const About = lazy(() => import("../Pages/About"));
  const Contact = lazy(() => import("../Pages/Contact"));
  const Categories = lazy(() => import("../Pages/Categories"));
  const BlogList = lazy(() => import("../Pages/BlogList"));
  const BlogSingle = lazy(() => import("../Pages/BlogSingle"));
  const Products = lazy(() => import("../Pages/Products"));
  const ProductsGrid = lazy(() => import("../Pages/ProductsGrid"));
  const SingleProduct = lazy(() => import("../Pages/SingleProduct"));
  const Cart = lazy(() => import("../Pages/Cart"));
  const Checkout = lazy(() => import("../Pages/Checkout"));
  const Payment = lazy(() => import("../Pages/Payment"));
  const OrderInvoice = lazy(() => import("../Pages/OrderInvoice"));
  const Questionnaire = lazy(() => import("../Pages/Questionnaire"));
  const PortfolioSub = lazy(() => import("../Pages/PortfolioSub"));
  const PortfolioSingle = lazy(() => import("../Pages/PortfolioSingle"));
  const Wishlist = lazy(() => import("../Pages/Wishlist"));
  const NotFound = lazy(() => import("../Pages/NotFound"));
  const Shop = lazy(() => import("../Pages/Shop"));
  const ShopSubCategories = lazy(() => import("../Pages/ShopSubCategories"));
  const YourAccount = lazy(() => import("../Pages/YourAccount"));
  const Myorders = lazy(() => import("../Pages/Myorders"));
  const ExcessQuoteForm = lazy(() => import("../Pages/ExcessQuoteForm"));
  const MyProjects = lazy(() => import("../Pages/Myprojects"));
  const MyQuotes = lazy(() => import("../Pages/MyQuotes"));
  const ForgotPassword = lazy(() => import("../Pages/ForgotPassword"));
  const ResetPassword = lazy(() => import("../Pages/ResetPassword"));
  const TrackProject = lazy(() => import("../Pages/TrackProject"));
  const EditQuestionnaire = lazy(() => import("../Pages/EditQuestionnaire"));
  const FinalQuote = lazy(() => import("../Pages/FinalQuote"));
  const NoDataFound = lazy(() => import("../Pages/NoDataFound"));
  const CustomerService = lazy(() => import("../Pages/CustomerService"));
  const VendorService = lazy(() => import("../Pages/VendorService"));
  const GuidesPage = lazy(() => import("../Pages/GuidesPage"));
  const ProjectsPage = lazy(() => import("../Pages/ProjectsPage"));
  const Testvendor = lazy(() => import("../Pages/Testvendor"));
  const ProductPage = lazy(() => import("../Pages/ProductPage"));
  const EstimationBill = lazy(() => import("../Pages/EstimationBill"));
  const ChangePassword = lazy(() => import("../Pages/ChangePassword"));
  const ProductDetail = lazy(() => import("../Pages/ProductDetail"));
  const CustomerProjects = lazy(() => import("../Pages/CustomerProjects"));
  const DesignChanges = lazy(() => import("../Components/Home/DesignChanges"));
  // const Pageone = lazy(() => import("../Pages/pageOne"));

  // const DesignChanges = lazy()=> import ("../Pages/")

  return (
    <>
      <Suspense fallback={<Loader />}>
        <Routes>
          <Route path="/login" element={<Login />} />
          <Route path="/signup" element={<Register />} />
          <Route path="/" element={<Home />} />
          <Route path="/about" element={<About />} />
          <Route path="/contact" element={<Contact />} />
          <Route path="/categories" element={<Categories />} />
          <Route path="/blogList" element={<BlogList />} />
          <Route path="/blogSingle" element={<BlogSingle />} />
          <Route path="/products" element={<Products />} />
          <Route path="/productsGrid" element={<ProductsGrid />} />
          <Route path="/singleproduct" element={<SingleProduct />} />
          <Route path="/x" element={<Cart />} />
          <Route path="/checkout" element={<Checkout />} />
          <Route path="/payment" element={<Payment />} />
          <Route path="/invoice" element={<OrderInvoice />} />
          <Route path="/questionnaire" element={<Questionnaire />} />
          <Route path="/editQuestionnaire" element={<EditQuestionnaire />} />
          <Route path="/portfolioCategories" element={<PortfolioSub />} />
          <Route path="/portfolioSingle" element={<PortfolioSingle />} />
          <Route path="/wishlist" element={<Wishlist />} />
          <Route path="/shop" element={<Shop />} />
          <Route path="/shopSubcategories" element={<ShopSubCategories />} />
          <Route path="/yourAccount" element={<YourAccount />} />
          <Route path="/Myorders" element={<Myorders />} />
          <Route path="/excessQuoteForm" element={<ExcessQuoteForm />} />
          <Route path="/myQuotes" element={<MyQuotes />} />
          <Route path="/myProjects" element={<MyProjects />} />
          <Route path="/projectStatus" element={<TrackProject />} />
          <Route path="/forgotPassword" element={<ForgotPassword />} />
          <Route path="/resetPassword" element={<ResetPassword />} />
          <Route path="/finalQuote" element={<FinalQuote />} />
          <Route path="*" element={<NotFound />} />
          <Route path="/designchange" element={<DesignChanges />} />
          <Route path="/slideshow" element={<SlideShow />} />
          <Route path="/newslider" element={<NewSlider />} />
          <Route path="/quotepage" element={<Cotation />} />
          <Route path="/projectdetails" element={<ProjectDetails />} />
          <Route path="/services" element={<Services />} />
          <Route path="/qualitychecker" element={<QualityChcker />} />
          <Route path="/shopbycategory" element={<ShopByCategory />} />
          <Route path="/singlecategory" element={<SingleCategory />} />
          <Route path="/querypopup" element={<QueryPopup />} />
          <Route path="/productpage" element={<ProductPage />} />
          {/* <Route path="/vendorpage" element={<Vendorspage />} /> */}
          <Route path="/estimationBill" element={<EstimationBill />} />
          <Route path="/VendorInfo" element={<Testvendor />} />
          {/* <Route path="/pppp" element={<pageOne />} /> */}
          <Route path="/projectspage" element={<ProjectsPage />} />
          <Route path="/guidespage" element={<GuidesPage />} />
          <Route path="/changePassword" element={<ChangePassword />} />
          <Route path="/vendorservice" element={<VendorService />} />
          <Route path="/customerservice" element={<CustomerService />} />
          <Route path="/nodatafound" element={<NoDataFound />} />
          <Route path="/ecommercefilter" element={<EcommerceFilter />} />
          <Route path="/singleProject" element={<ProductDetail />} />
          <Route path="/referaldetails" element={<ReferalDetails />} />
          <Route path="/customerProjects" element={<CustomerProjects />} />
          <Route path="/mycart" element={<MyCart />} />
        </Routes>
      </Suspense>
    </>
  );
};

export default LazyLoader;
