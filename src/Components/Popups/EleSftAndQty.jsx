/* eslint-disable react-hooks/exhaustive-deps */
/* eslint-disable react/prop-types */

import Modal from "react-bootstrap/Modal";
import { useForm } from "react-hook-form";
import { Link } from "react-router-dom";
import { toast } from "sonner";
import Sonner from "../Toaster/Sonner";
import { useState } from "react";
import Loader from "../Spinner/Loader";

const EleSftAndQty = (props) => {
  const {
    register,
    handleSubmit,
    formState: { errors },
    reset,
  } = useForm();
  const [loading, setLoading] = useState(false);

  const onSubmit = (data) => {
    props.getAllItems(data);
    console.log("get all data  is====", props);
    setLoading(true);

    if (data?.eleQuantity != "" && data?.eleSqft != "") {
      reset();
      toast.success("Successfully Added to Quotation Estimate");
      props.close();
      setLoading(false);
    }

    // console.log(data);
    // console.log("sqft qnt popup===", props?.eleQtyData);
  };
  return (
    <>
      {loading && <Loader />}
      <Modal
        show={props.show}
        id={`modalPopup${props?.eleId}`}
        backdrop="static"
        className="elementInfoPopup"
      >
        <form
          action=""
          method="post"
          onSubmit={handleSubmit(onSubmit)}
          className="elementInfoForm"
        >
          <div className="modal-header form clse-divs">
            <h5
              className="modal-title modal-title-centered"
              id="exampleModalLabel"
            >
              Element Info
            </h5>
            <div>
              <button
                type="button"
                className="closee form"
                aria-label="Close"
                onClick={props.close}
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>

          {/* <div>
              <div className="inputs-fields">
                <label htmlFor="selfRadio">Quantity</label>

                <input
                  type="text"
                  className={
                    errors.eleQuantity
                      ? "form-control is-invalid"
                      : "form-control"
                  }
                  placeholder="Qnty of Element *"
                  {...register("eleQuantity", { required: true })}
                />
              </div>

              {errors.eleQuantity && (
                <p className="error-msg eror-left">This field is required</p>
              )}
            </div> */}

          <div className="inputs-fields">
            <label htmlFor="otherRadio">Element Sqft</label>
            <input
              type="text"
              placeholder="Sqft of Element *"
              className={
                errors.eleSqft ? "form-control is-invalid" : "form-control"
              }
              {...register("eleSqft", { required: true })}
            />
          </div>
          {errors.eleSqft && (
            <p className="error-msg eror-left">Enter square feet</p>
          )}

          <div className="modal-footer ftr-adjust">
            <Link to="/questionnaire">
              <button
                type="button"
                className="btn btn-danger form"
                onClick={props.close}
              >
                Cancel
              </button>
            </Link>
            <button type="submit" className="btn btn-success info">
              Submit
            </button>
          </div>
        </form>
      </Modal>
      <Sonner />
    </>
  );
};

export default EleSftAndQty;
