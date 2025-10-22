/* eslint-disable no-unused-vars */
import { useState } from "react";
import { environmentUrl } from "../../env/enviroment";

const NewsLetter = () => {
  const [newsMail, setNewsMail] = useState({});
  const onChangeMail = (event) => {
    setNewsMail({ ...newsMail, [event.target.name]: event.target.value });
  };

  const [successMsg, setSuccessMsg] = useState(false);
  const handleSubscribe = async () => {
    console.log("form body is", newsMail);
    const apiUrl = `${environmentUrl}/contact/stayInTouch.php`;
    const options = {
      method: "POST",
      body: JSON.stringify(newsMail),
    };
    const fetchedData = await (await fetch(apiUrl, options)).json();
    console.log("Response for mail is", fetchedData);
    if (fetchedData?.status) {
      setSuccessMsg(true);
    }
  };
  // setInterval(() => {
  //   setSuccessMsg(false);
  // }, 10000);
  return (
    <>
      <section className="banner">
        <div className="container-fluid">
          <div className="banner-image news-letter-img">
            {/* <!--Header--> */}

            <header>
              <div className="container">
                <h2 className="h2 title">Stay in touch!</h2>
                <div className="text">
                  <p>Be first to know about all new interior features!</p>
                </div>
              </div>
            </header>

            {/* <!--Content--> */}

            <div className="container">
              <div className="row align-items-center">
                {!successMsg && (
                  <form method="post" className="stayin-form">
                    <div className="col-md-10">
                      <input
                        type="email"
                        className="form-control stayin"
                        name="SubscribtionMail"
                        placeholder="Enter your e-mail"
                        onChange={onChangeMail}
                      />
                    </div>
                    <div className="">
                      <button
                        type="button"
                        className="btn btn-clean stay"
                        onClick={handleSubscribe}
                      >
                        Subscribe now
                      </button>
                    </div>
                  </form>
                )}
                {successMsg && (
                  <div className="container">
                    <div className="row">
                      <div>
                        <img
                          src="assets/images/verify.gif"
                          alt="verified"
                          className="subscribeimage"
                        />
                        <p className="subtext">Mail sent Successfully</p>
                      </div>
                    </div>
                  </div>
                )}
              </div>
            </div>
          </div>
        </div>
        {/* <!--/container-fluid--> */}
      </section>
    </>
  );
};

export default NewsLetter;
