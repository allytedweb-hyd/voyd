import { envImgUrl } from "../../env/envImage";
import { httpClient } from "../../Utilities/httpClient";
import { useEffect, useState } from "react";
const OurVision = () => {
  const [FounderInfo, setFounderInfo] = useState({});
  const getFounderInfo = async () => {
    try {
      const response = await httpClient.get("/about/aboutCompany.php");
      console.log("founder response", response);
      if (response?.status === 200) {
        setFounderInfo(response?.data?.response);
      }
    } catch (error) {
      console.log(error);
    }
  };

  useEffect(() => {
    getFounderInfo();
  }, []);
  return (
    <div>
      <section className="pdng-section-top tp-mbl">
        <div className="container">
          <div className="row justify-content-center">
            <div>
              <div className="cinzel-hdng text-center">
                From the <span className="inter-hdng">Founder’s</span> Desk: Our
                Vision and Journey
              </div>
              <div className="text-center  j-centerr">
                <p className="mb-1 p-vison">
                  Explore our demo video to see our design solutions in action.
                </p>
              </div>
              <div className="text-center  j-centerr m-0-tab">
                <p className="p-vison">
                  Get a clear view of the quality and craftsmanship we deliver.
                </p>
              </div>
            </div>
          </div>
          <div className="row border-grey vis-top p-0">
            <div className="col-md-5 col-sm-12 p-0 img-cnt">
              <div className="abt-vis-pht">
                <img
                  src={`${envImgUrl}/Uploads/aboutus/${FounderInfo?.founder_image}`}
                  alt={FounderInfo?.founder_img_alttext}
                  className=""
                />
              </div>
            </div>
            <div className="col-md-7 col-sm-12  founder-cen">
              <div className="padding-sides">
                <p
                  className="abt-fndr dm-sans p-vison  text-start"
                  dangerouslySetInnerHTML={{
                    __html: FounderInfo?.founder_description,
                  }}
                ></p>
                <div>
                  <h4 className="anv-hdng">{FounderInfo?.founder_name}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
};

export default OurVision;
