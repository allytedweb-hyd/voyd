// import { Vortex } from "react-loader-spinner";

export const Loader = () => {
  return (
    <>
      <div className="container-fluid">
        <div className="row">
          <div className="vortex-spinner-container">
            {/* <span className="loader"></span> */}
            <div className="loaderGiff">
              <img src="assets/images/loaderLogo2.gif" alt="" />
            </div>
          </div>
        </div>
      </div>
    </>
  );
};

export default Loader;
