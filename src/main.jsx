import ReactDOM from "react-dom/client";
import App from "./App.jsx";
import "./index.css";
import { BrowserRouter } from "react-router-dom";
import { GoogleOAuthProvider } from "@react-oauth/google";
import store from "./redux/store";
import { Provider } from "react-redux";
import { HelmetProvider } from "react-helmet-async";

ReactDOM.createRoot(document.getElementById("root")).render(
  <HelmetProvider>
    <GoogleOAuthProvider clientId="1096450435221-6nnm98ock6l1vqmdk0j3behbi2edg15f.apps.googleusercontent.com">
      <>
        <BrowserRouter>
          {/* <BrowserRouter basename="/mr.Interior/website/"> */}
          <Provider store={store}>
            <App />
          </Provider>
        </BrowserRouter>
      </>
    </GoogleOAuthProvider>
  </HelmetProvider>
);