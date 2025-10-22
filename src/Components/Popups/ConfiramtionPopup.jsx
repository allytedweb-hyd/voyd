/* eslint-disable no-unused-vars */
/* eslint-disable react/prop-types */
import React, { useState } from "react";
import Modal from "react-bootstrap/Modal";
import Button from "react-bootstrap/Button";
import { environmentUrl } from "../../env/enviroment";
import { useNavigate } from "react-router-dom";
import { toast } from "sonner";
import Sonner from "../Toaster/Sonner";
import Loader from "../Spinner/Loader";

const ConfiramtionPopup = (props) => {
  const [loading, setLoading] = useState(false);
  const navigate = useNavigate();
  const finalFormSubmit = async () => {
    const isAnyElementAdded = () => {
      const addons = props?.totalAddons || {};
      return Object.values(addons).some(
        (section) =>
          Array.isArray(section?.tabs) &&
          section.tabs.some((tab) => Array.isArray(tab) && tab.length > 0)
      );
    };

    if (!isAnyElementAdded()) {
      toast.warning(
        "Please add at least one interior element before submitting the quotation."
      );
      return;
    }
    try {
      setLoading(true);
      const apiUrl = `${environmentUrl}/questionnaire/postQuestionnaireQuote.php?queId=${props?.queId}`;
      const options = {
        method: "POST",
        body: JSON.stringify({
          ...props?.totalAddons,
        }),
        headers: {
          Authorization: "Bearer " + localStorage.getItem("token"),
        },
      };
      const postData = await (await fetch(apiUrl, options)).json();
      if (postData?.status) {
        props?.close();
        toast.success("Quote saved succesfully");
        navigate("/myQuotes?finalSubmit=true");
      } else {
        toast.error("Failed to Submit Data");
      }
    } catch (e) {
      console.log("final submittion error is==", e);
    } finally {
      setLoading(false);
    }
  };

  return (
    <>
      {loading && <Loader />}
      <div>
        <Modal
          className="confirmationPopup elementInfoPopup"
          show={props?.show}
          onHide={props?.close}
          animation={true}
          center
          backdrop="static"
        >
          <Modal.Header>
            <Modal.Title>Confirmation</Modal.Title>
            <button
              type="button"
              className="closee form"
              aria-label="Close"
              onClick={props.close}
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </Modal.Header>
          <Modal.Body className="popup-body">
            <div className="confirmText">
              <img src="assets/images/confirmIcon.png" alt="" />
              <p>Uneditable after submission Do you wish to submit?</p>
            </div>
            <div className="confirmation-buttons">
              <Button
                variant="secondary"
                onClick={props?.close}
                className="noBtn"
              >
                No
              </Button>
              <Button
                variant="primary"
                onClick={finalFormSubmit}
                className="yesBtnn yes"
              >
                yes
              </Button>
            </div>
          </Modal.Body>
        </Modal>
      </div>
      <Sonner />
    </>
  );
};

export default ConfiramtionPopup;
