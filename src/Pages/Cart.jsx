import { MdCancel } from "react-icons/md";
import { BsCart3 } from "react-icons/bs";
import { Link } from "react-router-dom";
import { useState, useEffect } from "react";
import { getCartItems } from "../libs/endpoints";
import { envImgUrl } from "../env/envImage";
import { LuPlus } from "react-icons/lu";
import { HiMinusSm } from "react-icons/hi";
import { environmentUrl } from "../env/enviroment";

const Cart = () => {
  const [cartItems, setCartItems] = useState([]);
  const [totalCartVal, setTotalCartVal] = useState([]);
  const handleCartItems = async () => {
    let response = await getCartItems();
    console.log("cart items response is=========", response);
    setCartItems(response?.response);
    setTotalCartVal(response?.cartTotalValue);
  };

  useEffect(() => {
    handleCartItems();
  }, []);
  console.log("total value of items in cart are===", totalCartVal);
  console.log("cart item response in cart page is===", cartItems);
  // console.log("cart count response in cart page is===", cartCount);

  const removeItemFromCart = async (productId) => {
    const apiUrl = `${environmentUrl}/cart/removeItem.php`;
    const data = {
      productId: productId,
    };
    const options = {
      method: "PUT",
      body: JSON.stringify(data),
      headers: { Authorization: "Bearer " + localStorage.getItem("token") },
    };
    const removeRes = await (await fetch(apiUrl, options)).json();
    const response = removeRes?.response;
    console.log("remove cart response===", response);
  };

  // let [prevCount, setPrevCount] = useState(null);
  const handleQuantityDecrement = (product) => {
    const modifiedItems = cartItems.filter((item) => {
      if (item?.cart_id == product?.cart_id) {
        product["product_quantity"] = Number(product?.product_quantity) - 1;
      }
      return product;
    });
    setCartItems(modifiedItems);
  };

  const handleQuantityIncrement = (product) => {
    const modifiedItems = cartItems.filter((item) => {
      if (item?.cart_id == product?.cart_id) {
        product["product_quantity"] = Number(product?.product_quantity) + 1;
      }
      return product;
    });
    setCartItems(modifiedItems);
  };

  return (
    <>
      <section className="checkout pt-0 pt-0 mt--125">
        {/* <!-- === header === --> */}

        <div className="bredcum">
          <img
            src="assets/images/img-7.jpg"
            alt="lightBanner"
            className="banner-content image_zoom"
          />
          <h2 className="mt-0 mb-0">Cart</h2>
        </div>

        {/* <div className="container"> */}
        {/* <!-- ========================  Cart wrapper ======================== --> */}

        {cartItems == undefined ? (
          <div className="container">
            <div className="row">
              <div className="result-card">
                <img
                  src="assets/images/emptyCart.gif"
                  alt="no results"
                  className="no-cart-items"
                />
              </div>
            </div>
          </div>
        ) : (
          <div className="container">
            <div className="cart-wrapper">
              {/* <!-- cart header --> */}

              <div className="cart-block cart-block-header clearfix col-lg-12 col-md-12">
                <div>
                  <span>Product</span>
                </div>
                <div>
                  <span>&nbsp;</span>
                </div>
                <div>
                  <span>Quantity</span>
                </div>
                <div className="">
                  <span>Price</span>
                </div>
              </div>

              {/* <!-- cart items --> */}

              <div className=" col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div className="clearfix">
                  {cartItems.map((eachProduct, index) => (
                    <div
                      className="cart-block cart-block-item clearfix"
                      key={index}
                    >
                      <div className="cartimagee col-md-3 col-sm-3 col-xs-12">
                        <div className="image">
                          <Link
                            to={`/singleproduct?productId=${eachProduct.product_id}`}
                          >
                            <img
                              src={`${envImgUrl}/Uploads/products/${eachProduct.image_1}`}
                              alt=""
                            />
                          </Link>
                        </div>
                      </div>
                      {/* <div className="quantityprice"> */}
                      <div className="col-md-3 col-sm-3 col-xs-12">
                        <div className="title">
                          <div className="h4">
                            <Link to="">{eachProduct.product_title}</Link>
                          </div>
                          <div>{eachProduct.product_category}</div>
                        </div>
                      </div>

                      <div className="col-md-3 col-sm-3 col-xs-6">
                        <div className="quantity">
                          <p className="tabledataa">Quantity :</p>
                          <div className="quantity-container">
                            <div
                              className="quantity-container-icon"
                              onClick={() => {
                                handleQuantityDecrement(eachProduct);
                              }}
                            >
                              <HiMinusSm />
                            </div>
                            <input
                              type="number"
                              value={eachProduct.product_quantity}
                              className="form-control form-quantity"
                            />
                            <div
                              className="quantity-container-icon"
                              onClick={() => {
                                handleQuantityIncrement(eachProduct);
                              }}
                            >
                              <LuPlus />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div className="col-md-3 col-sm-3 col-xs-6">
                        <div className="price">
                          <p className="tabledataa">Price :</p>
                          <div className="qunatityprice">
                            <span className="final h3">
                              ₹ {eachProduct.offer_price}/-
                            </span>
                            <span className="discount">
                              ₹ {eachProduct.product_price}/-
                            </span>
                          </div>
                        </div>
                      </div>

                      {/* <!--delete-this-item--> */}
                      <MdCancel
                        className="cart-remove-item"
                        onClick={() => {
                          removeItemFromCart(eachProduct.product_id);
                        }}
                      />
                    </div>
                  ))}
                </div>
              </div>

              {/* <!--cart prices --> */}

              <div className="col-md-4 offset-md-7 offset-lg-7">
                <div className="row">
                  {/* <!-- discount --> */}

                  <div className="cart-block cart-block-footer clearfix">
                    <div>
                      <strong>Discount 15%</strong>
                    </div>
                    <div>
                      <span>₹ 15,900</span>
                    </div>
                  </div>

                  {/* <!-- discount --> */}

                  <div className="cart-block cart-block-footer clearfix">
                    <div>
                      <strong>Shipping</strong>
                    </div>
                    <div>
                      <span>₹ 3,000</span>
                    </div>
                  </div>

                  {/* <!-- discount --> */}

                  <div className="cart-block cart-block-footer clearfix">
                    <div>
                      <strong>VAT</strong>
                    </div>
                    <div>
                      <span>₹ 5,900</span>
                    </div>
                  </div>
                </div>
              </div>

              {/* <!-- cart final price --> */}

              <div className="clearfix col-lg-11 col-md-11">
                <div className="cart-block cart-block-footer cart-block-footer-price clearfix">
                  {/* <div>
                    <span className="checkbox">
                      <input type="checkbox" id="couponCodeID" />
                      <label htmlFor="couponCodeID">Promo code</label>
                      <input
                        type="text"
                        className="form-control form-coupon"
                        value=""
                        placeholder="Enter your coupon code"
                      />
                    </span>
                  </div> */}
                  <div>
                    <div className="h2 title">Grand Total</div>
                  </div>
                  <div>
                    <div className="h2 title">₹ {totalCartVal?.totalVal}/-</div>
                  </div>
                </div>
              </div>

              {/* <!-- ========================  Cart navigation ======================== --> */}
              {cartItems === "No Data Found" ? (
                <div className="cart-block-buttons clearfix">
                  <div className="row">
                    <div className="col-md-10 col-sm-4 text-center">
                      <Link to="/shop" className="btn btn-outline-info">
                        Continue Shopping
                      </Link>
                    </div>
                  </div>
                </div>
              ) : (
                <div className="cart-block-buttons clearfix">
                  <div className="row">
                    <div className="col-sm-6 continueshop">
                      <Link to="/shop" className="btn btn-outline-info">
                        Continue shopping
                      </Link>
                    </div>
                    <div className="col-sm-5 text-right">
                      <Link to="/checkout" className="btn btn-outline-warning">
                        <BsCart3 className="icon icon-cart" /> Checkout
                      </Link>
                    </div>
                  </div>
                </div>
              )}
            </div>
          </div>
        )}
        {/* </div> */}
        {/* <!--/container--> */}
      </section>
    </>
  );
};

export default Cart;
