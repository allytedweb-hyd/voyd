import { ColorRing } from "react-loader-spinner";

const SubLoader = () => {
  return (
    <>
      <div className="container-fluid">
        <div className="row">
          <div className="spinner-container">
            <ColorRing
              visible={true}
              height="80"
              width="80"
              ariaLabel="color-ring-loading"
              wrapperStyle={{}}
              wrapperClass="color-ring-wrapper"
              colors={["#000"]}
            />
          </div>
        </div>
      </div>
    </>
  );
};

export default SubLoader;
