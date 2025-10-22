// import React from 'react'

const ExcessQuoteForm = () => {
  return (
    <>
      <div className="container">
        <div className="row">
          <div className="form-container excess-form col-lg-8 col-md-12 col-sm-12">
            <form method="post" encType="" className="excessform">
              <h3 className="excess-form text-center">Details Form</h3>
              <div className="row">
                <div className="col-md-6">
                  <label htmlFor="excessQuoteCusId">Customer Id</label>
                  <input
                    type="text"
                    className="form-control form-control2"
                    id="excessQuoteCusId"
                    readOnly={true}
                  />
                </div>
                <div className="col-md-6">
                  <label htmlFor="excessQuoteCusName">Customer Name</label>
                  <input
                    type="text"
                    className="form-control form-control2"
                    id="excessQuoteCusName"
                    readOnly={true}
                  />
                </div>
              </div>
              <div className="row">
                <div className="col-md-6">
                  <label htmlFor="excessQuoteProjectClass">Quotation Id</label>
                  <input
                    type="text"
                    className="form-control form-control2"
                    id="excessQuoteProjectClass"
                    readOnly={true}
                  />
                </div>
                <div className="col-md-6">
                  <label htmlFor="excessQuoteCusProjectName">
                    Project Name
                  </label>
                  <input
                    type="text"
                    className="form-control form-control2"
                    id="excessQuoteCusProjectName"
                    readOnly={true}
                  />
                </div>
              </div>
              <div className="row">
                <div className="col-md-6">
                  <label htmlFor="excessQuoteProjectClass">Project Class</label>
                  <input
                    type="text"
                    className="form-control form-control2"
                    id="excessQuoteProjectClass"
                    readOnly={true}
                  />
                </div>
                <div className="col-md-6">
                  <label htmlFor="excessQuote">Vendor Name</label>
                  <input
                    type="text"
                    className="form-control form-control2"
                    id="excessQuoteProjectClass"
                  />
                </div>
              </div>
              <div className="row">
                <div className="col-md-6">
                  <label htmlFor="excessQuoteItemName">Item Name</label>
                  <input
                    type="text"
                    className="form-control form-control2"
                    id="excessQuoteItemName"
                  />
                </div>
                <div className="col-md-6">
                  <label htmlFor="excessQuoteItemCode">Item Code</label>
                  <input
                    type="text"
                    className="form-control form-control2"
                    id="excessQuoteItemCode"
                  />
                </div>{" "}
              </div>
              <div className="row">
                <div className="col-md-6">
                  <label htmlFor="excessQuoteItemQuantity">Quantity</label>
                  <input
                    type="text"
                    className="form-control form-control2"
                    id="excessQuoteItemQuantity"
                  />
                </div>
              </div>
              <div className="form-group excess-form">
                <button
                  type="submit"
                  className="form-control btn btn-primary submit excessform"
                >
                  Submit
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </>
  );
};

export default ExcessQuoteForm;
