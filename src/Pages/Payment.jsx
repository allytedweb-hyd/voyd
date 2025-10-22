/* eslint-disable no-unused-vars */
import React from "react";

const Payment = () => {
  return (
    <>
      <section className="checkout">
        {/* <!-- === header === --> */}

        {/* <header>
                <div className="container">
                    <h2 className="title">Delivery checkout</h2>
                    <div className="text">
                        <p>Confirm your order details</p>
                    </div>
                </div>
            </header> */}

        {/* <!-- === left content === --> */}

        <div className="container">
          {/* <!-- ========================  Payment ======================== --> */}

          <div className="cart-wrapper">
            <div className="note-block">
              <div className="row">
                {/* <!-- === left content === --> */}

                <div className="col-md-6">
                  <div className="white-block">
                    <div className="h4">Order details</div>

                    <hr />

                    <div className="row">
                      <div className="col-md-6">
                        <div className="form-group">
                          <strong>Order no.</strong> <br />
                          <span>52522-63259226</span>
                        </div>
                      </div>

                      <div className="col-md-6">
                        <div className="form-group">
                          <strong>Transaction ID</strong> <br />
                          <span>2265996</span>
                        </div>
                      </div>

                      <div className="col-md-6">
                        <div className="form-group">
                          <strong>Order date</strong> <br />
                          <span>06/30/2017</span>
                        </div>
                      </div>

                      <div className="col-md-6">
                        <div className="form-group">
                          <strong>Shipping arrival</strong> <br />
                          <span>07/30/2017</span>
                        </div>
                      </div>
                    </div>

                    <div className="h4">Shipping info</div>

                    <hr />

                    <div className="row">
                      <div className="col-md-6">
                        <div className="form-group">
                          <strong>Name</strong> <br />
                          <span>John Doe</span>
                        </div>
                      </div>

                      <div className="col-md-6">
                        <div className="form-group">
                          <strong>Email</strong>
                          <br />
                          <span>johndoe@company.com</span>
                        </div>
                      </div>

                      <div className="col-md-6">
                        <div className="form-group">
                          <strong>Phone</strong>
                          <br />
                          <span>+122 523 352</span>
                        </div>
                      </div>

                      <div className="col-md-6">
                        <div className="form-group">
                          <strong>Zip</strong>
                          <br />
                          <span>94107</span>
                        </div>
                      </div>

                      <div className="col-md-6">
                        <div className="form-group">
                          <strong>City</strong>
                          <br />
                          <span>San Francisco, California</span>
                        </div>
                      </div>

                      <div className="col-md-6">
                        <div className="form-group">
                          <strong>Address</strong>
                          <br />
                          <span>795 Folsom Ave, Suite 600</span>
                        </div>
                      </div>

                      <div className="col-md-6">
                        <div className="form-group">
                          <strong>Company name</strong>
                          <br />
                          <span>Mobel Inc</span>
                        </div>
                      </div>

                      <div className="col-md-6">
                        <div className="form-group">
                          <strong>Company phone</strong>
                          <br />
                          <span>+122 333 6665</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  {/* <!--/col-md-6--> */}
                </div>

                {/* <!-- === right content === --> */}

                <div className="col-md-6">
                  <div className="white-block">
                    <div className="h4">Choose payment</div>

                    <hr />

                    <span className="checkbox">
                      <input
                        type="radio"
                        id="paymentID1"
                        name="paymentOption"
                        checked="checked"
                      />
                      <label htmlFor="paymentID1">
                        <strong>Pay via credit cart</strong> <br />
                        <small>
                          (MasterCard, Maestro, Visa, Visa Electron, JCB and
                          American Express)
                        </small>
                      </label>
                    </span>

                    <span className="checkbox">
                      <input
                        type="radio"
                        id="paymentID2"
                        name="paymentOption"
                      />
                      <label htmlFor="paymentID2">
                        <strong>PayPal</strong> <br />
                        <small>
                          Purchase with your fingertips. Look for us the next
                          time you&apos;re paying from a mobile app, and
                          checkout faster on thousands of mobile websites.
                        </small>
                      </label>
                    </span>

                    <span className="checkbox">
                      <input
                        type="radio"
                        id="paymentID3"
                        name="paymentOption"
                      />
                      <label htmlFor="paymentID3">
                        <strong>Pay via bank transfer</strong> <br />
                        <small>
                          You can make payments directly into our bank account
                          and email the bank wire transfer receipt to us. We
                          recommend bank wire transfer for payments exceeding
                          $500,00.{" "}
                        </small>
                      </label>
                    </span>

                    <hr />

                    <p>
                      Please allow three working days for the payment
                      confirmation to reflect in your
                      <a href="#">online account</a>. Once your payment is
                      confirmed, we will generate your e-invoice, which you can
                      view/print from your account or email.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <hr />

          {/* <!-- ========================  Cart navigation ======================== --> */}

          {/* <div className="clearfix">
            <div className="row">
              <div className="col-6">
                <a href="/shop" className="btn btn-clean-dark">
                  <span className="icon icon-chevron-left"></span> Shop more
                </a>
              </div>
              <div className="col-6 text-right">
                <a href="/invoice" className="btn btn-clean-dark">
                  <span className="icon icon-cart"></span> Go to checkout
                </a>
              </div>
            </div>
          </div> */}
        </div>
        {/* <!--/container--> */}
      </section>
    </>
  );
};

export default Payment;
