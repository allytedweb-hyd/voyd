/* eslint-disable react/prop-types */
/* eslint-disable no-undef */
// import { useState } from "react";
import Modal from "react-bootstrap/Modal";
import { Link } from "react-router-dom";
import { useForm } from "react-hook-form";

const SelfOthers = (props) => {
  // console.log("get event function ===>", props?.getEvent);
  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm();

  // const [data, setData] = useState("");
  // const handleSelfOthers = (event) => {
  //   setData(event.target.value);
  // };

  const onSubmit = async (data) => {
    console.log("self and others popup data===", data);
    await props.getEvent(data);
    // console.log(
    //   "on submit self or others===",
    //   await props.getEvent(data?.quoteType)
    // );
  };

  return (
    <>
      {/* <!-- Modal --> */}

      <Modal
        show={props.show}
        onHide={props.close}
        backdrop="static"
        keyboard={false}
      >
        <form action="" method="post" onSubmit={handleSubmit(onSubmit)}>
          <div className="modal-header form">
            <h5
              className="modal-title modal-title-centered"
              id="exampleModalLabel"
            >
              Quotation For
            </h5>
            <button
              type="button"
              className="closee form"
              aria-label="Close"
              onClick={props.close}
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div className="ratio-container">
            <div>
              <div className="inputs-fields">
                <input
                  type="radio"
                  id="selfRadio"
                  // name="quoteType"
                  value="Self"
                  className="mr-2"
                  // onChange={handleSelfOthers}
                  {...register("quoteType", { required: true })}
                />

                <label htmlFor="selfRadio">Self</label>
              </div>

              {errors.quoteType && (
                <span className="error-msg">This field is required</span>
              )}
            </div>
            <div>
              <div className="inputs-fields">
                <input
                  type="radio"
                  id="otherRadio"
                  // name="quoteType"
                  value="Others"
                  className="mr-2"
                  // onChange={handleSelfOthers}
                  {...register("quoteType", { required: true })}
                />

                <label htmlFor="otherRadio">Others</label>
              </div>
              {errors.quoteType && (
                <span className="error-msg">This field is required</span>
              )}
            </div>
          </div>
          <div className="modal-footer">
            <Link to="/myQuotes">
              <button
                type="button"
                className="btn btn-danger form"
                onClick={props.close}
              >
                Cancel
              </button>
            </Link>
            <button
              type="submit"
              className="btn btn-success info"
              // onClick={submitSelfOtherDetails}
            >
              Submit
            </button>
          </div>
        </form>
      </Modal>
    </>
  );
};

export default SelfOthers;
