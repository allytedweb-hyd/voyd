import ReactDOM from "react-dom/client";
import App from "./App.jsx";
import "./index.css";
import { BrowserRouter } from "react-router-dom";
import { GoogleOAuthProvider } from "@react-oauth/google";
import store from "./redux/store";
import { Provider } from "react-redux";

ReactDOM.createRoot(document.getElementById("root")).render(
  <GoogleOAuthProvider clientId="333173030576-uef3cbcom6plsul3hfikn8628dr7jlgb.apps.googleusercontent.com">
    <>
      <BrowserRouter>
        {/* <BrowserRouter basename="/mr.Interior/website/"> */}
        <Provider store={store}>
          <App />
        </Provider>
      </BrowserRouter>
    </>
  </GoogleOAuthProvider>
);
