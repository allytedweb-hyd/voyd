import Header from "./Components/Common/Header";
import Footer from "./Components/Common/Footer";
import "./App.css";
import LazyLoader from "./Utilities/LazyLoader";
import { ToastContainer } from "react-toastify";
import { createContext, useEffect, useState } from "react";
import { environmentUrl } from "./env/enviroment";
// import Loader from "./Components/Spinner/Loader";
import { Loader } from "./Components/Spinner/Loader";
import { useLocation } from "react-router-dom";
import { verifyJwtToken } from "./Utilities/httpClient";
import { useNavigate } from "react-router-dom";
import { jwtDecode } from "jwt-decode";
import useScrollRestoration from "./libs/ScrollManager";

export const userContext = createContext(null);

function App() {
  const navigate = useNavigate();
  const location = useLocation();

  useScrollRestoration();

  // Define routes where Header and Footer should be hidden
  const hideHeaderFooter = [
    "/slideshow",
    "/newslider",
    "/login",
    "/signup",
    "/resetpassword",
    "/forgotPassword",
  ].includes(location.pathname);

  // window.scrollTo({ top: 0, left: 0, behavior: "instant" });

  const [userDetails, setUserDetails] = useState(null);
  const [isHeader, setIsHeader] = useState(true);
  const [loading, setLoading] = useState(true);
  const handleUserDetails = async () => {
    const apiUrl = `${environmentUrl}/myAccount/get.php`;
    const options = {
      method: "GET",
      headers: { Authorization: "Bearer " + localStorage.getItem("token") },
    };
    const response = await (await fetch(apiUrl, options)).json();
    if (response?.status) {
      setUserDetails(response?.response);
    } else {
      localStorage.removeItem("token");
    }
  };

  useEffect(() => {
    let token = localStorage.getItem("token");
    if (token != null || token != undefined) {
      handleUserDetails();
    }
    setLoading(false);
  }, []);

  const setHeaderVal = (bool = true) => {
    setIsHeader(bool);
  };

  const checkTokenExpiration = () => {
    let token = localStorage.getItem("token");
    if (!token) {
      return;
    }
    try {
      const decodedToken = jwtDecode(token);
      const expirationTime = decodedToken.exp * 1000;
      const currentTime = Date.now();
      if (expirationTime < currentTime) {
        localStorage.removeItem("token");
        navigate("/");
      }
    } catch (error) {
      console.error("Error decoding token:", error);
    }
  };

  useEffect(() => {
    checkTokenExpiration();
    const tokenVerification = verifyJwtToken(localStorage.getItem("token"));
    if (tokenVerification) {
      localStorage.removeItem("token");
      navigate("/");
    }
  }, []);

  return (
    <userContext.Provider
      value={{
        userDetails: userDetails,
        handleUserDetails: handleUserDetails,
        setHeaderVal: setHeaderVal,
      }}
    >
      {loading && <Loader />}
      {!loading && (
        <>
          {!hideHeaderFooter && <Header />}
          <LazyLoader />
          {!hideHeaderFooter && <Footer />}

          <ToastContainer
            position="top-right"
            autoClose={5000}
            hideProgressBar={false}
            newestOnTop={false}
            closeOnClick
            rtl={false}
            pauseOnFocusLoss
            draggable
            pauseOnHover
            theme="colored"
          />
        </>
      )}
    </userContext.Provider>
  );
}

export default App;
