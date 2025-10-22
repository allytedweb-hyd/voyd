import { useRoutes } from "react-router-dom";
import LazyLoader from "./LazyLoader";

const Routes = () => {
  const routes = [
    {
      path: "/login",
      name: "Login",
      element: LazyLoader("Login"),
    },
    {
      path: "/signup",
      name: "SignUp",
      element: LazyLoader("SignUp"),
    },
    {
      path: "/",
      name: "Home",
      element: LazyLoader("Home"),
    },
    {
      path: "/about",
      name: "About",
      element: LazyLoader("About"),
    },
    {
      path: "/contact",
      name: "Contact",
      element: LazyLoader("Contact"),
    },
    {
      path: "/categories",
      name: "Categories",
      element: LazyLoader("Categories"),
    },
    {
      path: "/blogList",
      name: "BlogList",
      element: LazyLoader("BlogList"),
    },
    {
      path: "/blogSingle",
      name: "BlogSingle",
      element: LazyLoader("BlogSingle"),
    },
    {
      path: "/products",
      name: "Products",
      element: LazyLoader("Products"),
    },
    {
      path: "/productsGrid",
      name: "ProductsGrid",
      element: LazyLoader("ProductsGrid"),
    },
    {
      path: "/singleproduct",
      name: "SingleProduct",
      element: LazyLoader("SingleProduct"),
    },
    {
      path: "/cart",
      name: "Cart",
      element: LazyLoader("Cart"),
    },
    {
      path: "/checkout",
      name: "Checkout",
      element: LazyLoader("Checkout"),
    },
    {
      path: "/questionnaire",
      name: "Questionnaire",
      element: LazyLoader("Questionnaire"),
    },
    {
      path: "/portfolioCategories",
      name: "PortfolioSub",
      element: LazyLoader("PortfolioSub"),
    },
    {
      path: "/portfolioSingle",
      name: "PortfolioSingle",
      element: LazyLoader("PortfolioSingle"),
    },
  ];
  return useRoutes(routes);
};

export default Routes;
