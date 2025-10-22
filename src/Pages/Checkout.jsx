import { useEffect, useState } from "react";
import { getCartItems } from "../libs/endpoints";
import { Link } from "react-router-dom";
import { envImgUrl } from "../env/envImage";
import { PiShoppingCartLight } from "react-icons/pi";
import { FaArrowRight } from "react-icons/fa6";

const Checkout = () => {
  const [checkoutItems, setCheckoutItems] = useState([]);
  const [totalCartVal, setTotalCartVal] = useState([]);
  const handleCkeckOutItems = async () => {
    const response = await getCartItems();
    setCheckoutItems(response?.response);
    setTotalCartVal(response?.cartTotalValue);
  };
  useEffect(() => {
    handleCkeckOutItems();
  }, []);
  // console.log("checkout items are=====", checkoutItems);

  // ----------------------- For textarea First letter Capital -----------------
  const [text, setText] = useState("");

  const handleChange = (e) => {
    let input = e.target.value;
    if (input.length > 0) {
      input = input.charAt(0).toUpperCase() + input.slice(1);
    }
    setText(input);
  };
  // ----------------------- For textarea First letter Capital -----------------

  const [shippingDetails, setShippingDetails] = useState({});

  const handleFormInput = (event) => {
    setShippingDetails({
      ...shippingDetails,
      [event.target.name]: event.target.value,
    });
  };

  const SubmitShippingDetails = () => {
    console.log("shipping details are===", shippingDetails);
  };

  return (
    <>
      {/* ============================== CHECKOUT NEW DESIGN ================================ */}

      <section className="checkOutSection">
        <div className="container">
          <div className="checkOuTitle">
            <h3>Checkout</h3>
          </div>
          <form action="">
            <div className="row">
              <div className="col-md-8">
                <div className="billingInfo">
                  <h4>Billing Information</h4>
                  <div className="row billRow">
                    <div className="col-md-6">
                      <p>
                        User Name<span className="errorSymbol">*</span>
                      </p>
                      <div className="fieldsOuter">
                        <div className="inputOuter">
                          <input type="text" placeholder="First name" />
                        </div>
                        <div className="inputOuter">
                          <input type="text" placeholder="Last name" />
                        </div>
                      </div>
                    </div>
                    <div className="col-md-6">
                      <p>
                        Company Name <span>(Optional)</span>
                      </p>

                      <div className="inputOuter">
                        <input type="text" placeholder="Company name" />
                      </div>
                    </div>
                  </div>
                  <div className="row billRow">
                    <div className="col-md-6">
                      <p>
                        Email<span className="errorSymbol">*</span>
                      </p>

                      <div className="inputOuter">
                        <input type="email" placeholder="Enter Email" />
                      </div>
                    </div>
                    <div className="col-md-6">
                      <p>
                        Mobile<span className="errorSymbol">*</span>
                      </p>

                      <div className="inputOuter">
                        <input type="number" placeholder="Enter Mobile" />
                      </div>
                    </div>
                  </div>
                  <div className="row billRow">
                    <div className="col-md-6">
                      <div className="fieldsOuter">
                        <div className="inputOuter">
                          <p>
                            State<span className="errorSymbol">*</span>
                          </p>
                          <input type="text" value="Telangana" readOnly />
                        </div>
                        <div className="inputOuter">
                          <p>
                            City<span className="errorSymbol">*</span>
                          </p>
                          <input type="text" value="Hyderabad" />
                        </div>
                      </div>
                    </div>
                    <div className="col-md-6">
                      <p>
                        Zip Code<span className="errorSymbol">*</span>
                      </p>

                      <div className="inputOuter">
                        <input type="text" placeholder="Enter Zip code" />
                      </div>
                    </div>
                  </div>
                  <div className="row billRow">
                    <div className="col-md-12">
                      <p>
                        Address<span className="errorSymbol">*</span>
                      </p>

                      <div className="inputOuter">
                        <input type="text" placeholder="Enter Address" />
                      </div>
                    </div>
                  </div>
                </div>
                <div className="checkBoxBlock">
                  <input type="checkbox" />
                  <p>Ship to different address</p>
                </div>
                <div className="paymentInfo">
                  <h4>
                    Payment Options<span className="errorSymbol">*</span>
                  </h4>
                  <div className="methodBlock">
                    <div className="method">
                      <img src="assets/icons/paIcon6.png" alt="" />
                      <p>UPI Payment</p>
                      <input
                        type="radio"
                        value="Cash on Delivery"
                        name="method"
                      />
                    </div>
                    <div className="method">
                      <img src="assets/icons/paIcon2.png" alt="" />
                      <p>Venmo</p>
                      <input
                        type="radio"
                        value="Cash on Delivery"
                        name="method"
                      />
                    </div>
                    <div className="method brRight">
                      <img src="assets/icons/paIcon3.png" alt="" />
                      <p>Paypal</p>
                      <input
                        type="radio"
                        value="Cash on Delivery"
                        name="method"
                      />
                    </div>
                    <div className="method">
                      <img src="assets/icons/paIcon4.png" alt="" />
                      <p>Amazon Pay</p>
                      <input
                        type="radio"
                        value="Cash on Delivery"
                        name="method"
                      />
                    </div>
                    <div className="method">
                      <img src="assets/icons/paIcon5.png" alt="" />
                      <p>Debit/Credi card</p>
                      <input
                        type="radio"
                        value="Cash on Delivery"
                        name="method"
                      />
                    </div>
                    <div className="method brRight">
                      <img src="assets/icons/paIcon1.png" alt="" />
                      <p>Cash on Delivery</p>
                      <input
                        type="radio"
                        value="Cash on Delivery"
                        name="method"
                      />
                    </div>
                  </div>
                  <div className="cardDetails">
                    <div className="row billRow">
                      <div className="col-md-12">
                        <p>
                          Name on Card<span className="errorSymbol">*</span>
                        </p>

                        <div className="inputOuter">
                          <input type="text" placeholder="Enter Name on Card" />
                        </div>
                      </div>
                    </div>
                    <div className="row billRow">
                      <div className="col-md-12">
                        <p>
                          Card Number<span className="errorSymbol">*</span>
                        </p>

                        <div className="inputOuter">
                          <input
                            type="number"
                            placeholder="Enter Card Number"
                          />
                        </div>
                      </div>
                    </div>
                    <div className="row billRow">
                      <div className="col-md-6">
                        <p>
                          Expire Date<span className="errorSymbol">*</span>
                        </p>

                        <div className="inputOuter">
                          <input
                            type="text"
                            id="expiry"
                            name="expiry"
                            placeholder="MM/YY"
                            pattern="(0[1-9]|1[0-2])\/[0-9]{4}"
                            required
                          />
                        </div>
                      </div>
                      <div className="col-md-6">
                        <p>
                          CVV<span className="errorSymbol">*</span>
                        </p>

                        <div className="inputOuter">
                          <input type="number" placeholder="Enter CVV" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="additionalInfo">
                  <h4>Additional Information</h4>
                  <div className="row billRow">
                    <div className="col-md-12">
                      <p>
                        Order Notes <span>(Optional)</span>
                      </p>

                      <div className="inputOuter textAreaF">
                        <textarea
                          type="text"
                          placeholder="About your order, e.g. special notes for delivery"
                          rows={5}
                          value={text}
                          onChange={handleChange}
                        ></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div className="col-md-4">
                <div className="orderSummeryBlock">
                  <h4>Order Summary</h4>
                  <div className="orderItem">
                    <img src="assets/icons/orderitem1.png" alt="" />
                    <div className="itmeNames">
                      <p>Meryl Lounge Chair</p>
                      <h5>
                        1 X <span>₹433</span>
                      </h5>
                    </div>
                  </div>
                  <div className="orderItem">
                    <img src="assets/icons/orderitem2.png" alt="" />
                    <div className="itmeNames">
                      <p>Beige Three-Seater Sofa</p>
                      <h5>
                        2 X <span>₹1950</span>
                      </h5>
                    </div>
                  </div>
                  <div className="amountsBlock">
                    <div className="amounts">
                      <p>Sub-total</p>
                      <h6>₹2537</h6>
                    </div>
                    <div className="amounts">
                      <p>Shipping</p>
                      <h6>Free</h6>
                    </div>
                    <div className="amounts">
                      <p>Discount</p>
                      <h6>₹250</h6>
                    </div>
                    <div className="amounts">
                      <p>Tax</p>
                      <h6>₹169.34</h6>
                    </div>
                  </div>
                  <div className="totalBlock">
                    <p>Total</p>
                    <h6>₹4336</h6>
                  </div>
                  <div className="placeOrderBtn">
                    <button>
                      Place Order <FaArrowRight />
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </section>

      {/* ============================== CHECKOUT OLD DESIGN ================================ */}
      {/* <section className="checkout pt-0 pt-0 mt--125">
     

        <div className="bredcum">
          <img
            src="assets/images/img-6.jpg"
            alt="lightBanner"
            className="banner-content image_zoom"
          />
          <h2 className="mt-0 mb-0">Checkout</h2>
        </div>

        <form method="post" onSubmit={SubmitShippingDetails()}>
          <div className="container">

            <div className="cart-wrapper">
              <div className="note-block">
                <div className="row">

                  <div className="col-md-6">

                    <div className="login-wrapper">

                      <div className="login-block login-block-signin">
                        <div className="h4">
                          Sign in{" "}
                          <Link
                            to="javascript:void(0);"
                            className="btn btn-main btn-sm btn-register pull-right"
                          >
                            Create an account
                          </Link>
                        </div>

                        <hr />

                        <div className="row">
                          <div className="col-12">
                            <div className="form-group">
                              <input
                                type="text"
                                value=""
                                className="form-control"
                                placeholder="User ID"
                              />
                            </div>
                          </div>

                          <div className="col-12">
                            <div className="form-group">
                              <input
                                type="password"
                                value=""
                                className="form-control"
                                placeholder="Password"
                              />
                            </div>
                          </div>

                          <div className="col-12">
                            <span className="checkbox">
                              <input type="checkbox" id="checkBoxId3" />
                              <label htmlFor="checkBoxId3">
                                Remember me &nbsp;
                                <Link to="#">Forgot password?</Link>
                              </label>
                            </span>
                          </div>

                          <div className="col-12">
                            <hr />
                            <Link to="#" className="btn btn-primary">
                              Sign in
                            </Link>
                          </div>
                        </div>
                      </div>

                      <div className="login-block login-block-signup">
                        <div className="h4">
                          Delivery Address{" "}
                        </div>

                        <hr />

                        <div className="row">
                          <div className="col-md-6">
                            <div className="form-group">
                              <input
                                type="text"
                                value=""
                                className="form-control"
                                placeholder="First name: *"
                                onChange={handleFormInput}
                              />
                            </div>
                          </div>

                          <div className="col-md-6">
                            <div className="form-group">
                              <input
                                type="text"
                                value=""
                                className="form-control"
                                placeholder="Last name: *"
                                onChange={handleFormInput}
                              />
                            </div>
                          </div>

                          <div className="col-md-4">
                            <div className="form-group">
                              <input
                                type="text"
                                value=""
                                className="form-control"
                                placeholder="Zip code: *"
                                onChange={handleFormInput}
                              />
                            </div>
                          </div>

                          <div className="col-md-8">
                            <div className="form-group">
                              <input
                                type="text"
                                value=""
                                className="form-control"
                                placeholder="City: *"
                                onChange={handleFormInput}
                              />
                            </div>
                          </div>

                          <div className="col-md-6">
                            <div className="form-group">
                              <input
                                type="text"
                                value=""
                                className="form-control"
                                placeholder="Email: *"
                                onChange={handleFormInput}
                              />
                            </div>
                          </div>

                          <div className="col-md-6">
                            <div className="form-group">
                              <input
                                type="text"
                                value=""
                                className="form-control"
                                placeholder="Phone: *"
                                onChange={handleFormInput}
                              />
                            </div>
                          </div>
                          <div className="col-md-12">
                            <div className="form-group">
                              <textarea
                                className="form-control"
                                placeholder="Address"
                                rows={6}
                                onChange={handleFormInput}
                              ></textarea>
                            </div>
                          </div>

                          <div className="col-md-12">
                            <hr />
                            <span className="checkbox">
                              <input type="checkbox" id="checkBoxId1" />
                              <label htmlFor="checkBoxId1">
                                I have read and accepted the{" "}
                                <Link to="#">terms</Link>, as well as read and
                                understood our terms of{" "}
                                <Link to="#">business contidions</Link>
                              </label>
                            </span>
                            <span className="checkbox">
                              <input type="checkbox" id="checkBoxId2" />
                              <label htmlFor="checkBoxId2">
                                Subscribe to exciting newsletters and great tips
                              </label>
                            </span>
                            <hr />
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>

                  <div className="col-md-6">
                    <div className="h4">Choose delivery</div>

                    <hr />

                    <div className="checkbox">
                      <input
                        type="radio"
                        id="deliveryId1"
                        name="deliveryOption"
                        onChange={handleFormInput}
                      />
                      <label htmlFor="deliveryId1">General Delivery</label>
                    </div>

                    <div className="checkbox">
                      <input
                        type="radio"
                        id="deliveryId2"
                        name="deliveryOption"
                        onChange={handleFormInput}
                      />
                      <label htmlFor="deliveryId2">Fast delivery</label>
                    </div>


                    <hr />

                    <div className="clearfix">
                      <p>
                        A frequently overlooked, powerful fulfillment option is
                        offering local pick-up. If you have a physical location
                        and can allow your customers to forgo paying shipping
                        costs altogether, you should!
                      </p>
                      <p>
                        <strong>Benefits:</strong>
                      </p>
                      <ul>
                        <li>Avoid both shipping and packaging costs</li>
                        <li>
                          Develop a face-to-face relationship with your
                          customers
                        </li>
                        <li>
                          Potential for additional purchases while customers are
                          at your store
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div className="cart-wrapper">

              <div className="cart-block cart-block-header clearfix">
                <div>
                  <span>Product</span>
                </div>
                <div>
                  <span>&nbsp;</span>
                </div>
                <div>
                  <span>Quantity</span>
                </div>
                <div className="text-right">
                  <span>Price</span>
                </div>
              </div>

              <div className="clearfix">
                {checkoutItems === "No Data Found" ? (
                  <div className="continer">
                    <div className="row">
                      <div className="result-card">
                        <img
                          src="assets/images/empty-cart.jpg"
                          alt="not-found"
                          className="no-cart-items"
                        />
                      </div>
                    </div>
                  </div>
                ) : (
                  checkoutItems.map((eachItem, index) => (
                    <div
                      className="cart-block cart-block-item clearfix"
                      key={index}
                    >
                      <div className="image">
                        <Link
                          to={`/singleProduct?productId=${eachItem.product_id}`}
                        >
                          <img
                            src={`${envImgUrl}/Uploads/products/${eachItem.product_image}`}
                            alt={eachItem.product_title}
                          />
                        </Link>
                      </div>
                      <div className="title">
                        <div className="h4">
                          <Link
                            to={`/singleProduct?productId=${eachItem.product_id}`}
                          >
                            {eachItem.product_title}
                          </Link>
                        </div>
                        <div>{eachItem.product_category}</div>
                      </div>
                      <div className="quantity">
                        <strong>{eachItem.product_quantity}</strong>
                      </div>
                      <div className="price">
                        <span className="final h3">
                          ₹ {eachItem.offer_price}/-
                        </span>
                        <span className="discount">
                          ₹ {eachItem.product_price}/-
                        </span>
                      </div>
                      <span className="icon icon-cross icon-delete"></span>
                    </div>
                  ))
                )}
              </div>


              <div className="row">
                <div className="col-md-4 offset-md-8">

                  <div className="cart-block cart-block-footer clearfix">
                    <div>
                      <strong>Discount 15%</strong>
                    </div>
                    <div>
                      <span>₹ 159,00</span>
                    </div>
                  </div>


                  <div className="cart-block cart-block-footer clearfix">
                    <div>
                      <strong>Shipping</strong>
                    </div>
                    <div>
                      <span>₹ 30,00</span>
                    </div>
                  </div>


                  <div className="cart-block cart-block-footer clearfix">
                    <div>
                      <strong>VAT</strong>
                    </div>
                    <div>
                      <span>₹ 59,00</span>
                    </div>
                  </div>
                </div>
              </div>

              <hr />
              <div className="clearfix">
                <div className="cart-block cart-block-footer cart-block-footer-price clearfix">
               
                  <div>
                    <div className="h2 title">Total</div>
                  </div>
                  <div>
                    <div className="h2 title">₹ {totalCartVal?.totalVal}/-</div>
                  </div>
                </div>
              </div>
            </div>


            <div className="clearfix">
              <div className="row">
                <div className="col-6">
                  <Link to="/shop" className="btn btn-clean-dark">
                    <span className="icon icon-chevron-left"></span> Shop more
                  </Link>
                </div>
                <div className="col-6 text-right">
                  <button type="submit" className="btn btn-clean-dark">
                    <PiShoppingCartLight className="icon icon-cart mr-2" />
                    Proceed to payment
                  </button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </section> */}
    </>
  );
};

export default Checkout;
