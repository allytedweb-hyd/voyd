/* eslint-disable no-unused-vars */
import React from "react";

const OrderInvoice = () => {
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

        {/* <!-- === step wrapper === --> */}

        {/* <div className="step-wrapper">
          <div className="container">
            <div className="stepper">
              <ul className="row">
                <li className="col-3 active">
                  <span data-text="Cart items"></span>
                </li>
                <li className="col-3 active">
                  <span data-text="Delivery"></span>
                </li>
                <li className="col-3 active">
                  <span data-text="Payment"></span>
                </li>
                <li className="col-3 active">
                  <span data-text="Receipt"></span>
                </li>
              </ul>
            </div>
          </div>
        </div> */}

        {/* <!-- === left content === --> */}

        <div className="container">
          {/* <!-- ========================  Receipt ======================== --> */}

          <div className="cart-wrapper">
            <div className="note-block">
              <div className="row">
                {/* <!-- === left content === --> */}

                <div className="col-md-6">
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
                        <span>Divano Corporation</span>
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
                {/* <!--/col-md-6-->
                            <!-- === right content === --> */}

                <div className="col-md-6">
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

                  <div className="h4">Payment details</div>

                  <hr />

                  <div className="row">
                    <div className="col-md-6">
                      <div className="form-group">
                        <strong>Transaction time</strong> <br />
                        <span>06/30/2017 at 00:59</span>
                      </div>
                    </div>

                    <div className="col-md-6">
                      <div className="form-group">
                        <strong>Amount</strong>
                        <br />
                        <span>$ 1259,00</span>
                      </div>
                    </div>

                    <div className="col-md-6">
                      <div className="form-group">
                        <strong>Cart details</strong>
                        <br />
                        <span>**** **** **** 5446</span>
                      </div>
                    </div>

                    <div className="col-md-6">
                      <div className="form-group">
                        <strong>Items in cart</strong>
                        <br />
                        <span>4</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <hr />

          {/* <!-- ========================  Cart navigation ======================== --> */}

          <div className="clearfix">
            <div className="row">
              <div className="col-6 offset-6 text-right">
                <a href="checkout-2.html" className="btn btn-clean-dark">
                  <span className="icon icon-printer"></span>
                  Print receipt
                </a>
              </div>
            </div>
          </div>
        </div>
        {/* <!--/container--> */}
      </section>
    </>
  );
};

export default OrderInvoice;
