import { LiaUser } from "react-icons/lia";
import { IoHeartSharp } from "react-icons/io5";
import { HiOutlineShoppingCart } from "react-icons/hi2";
import { RxHamburgerMenu } from "react-icons/rx";
import { RxCross2 } from "react-icons/rx";

const SampleHeader = () => {
  return (
    <>
      {/* // <!-- ======================== Navigation ======================== --> */}

      <nav>
        <div className="container">
          <a href="index.html" className="logo">
            <img
              src="assets/images/divano-logo.svg"
              alt=""
              width="130"
              height="55"
            />
          </a>

          {/* <!-- ==========  Main navigation ========== --> */}

          <div className="navigation navigation-main">
            <a href="#" className="open-login">
              <LiaUser />
            </a>
            <a href="#" className="open-search">
              <IoHeartSharp />
            </a>
            <a href="#" className="open-cart">
              <HiOutlineShoppingCart /> <span>4</span>
            </a>
            <a href="#" className="open-menu">
              <RxHamburgerMenu />
            </a>

            <div className="floating-menu">
              {/* <!--mobile toggle menu trigger--> */}
              <div className="close-menu-wrapper">
                <span className="close-menu">
                  <RxCross2 />{" "}
                </span>
              </div>
              <div className="left-side">
                <a href="/" className="logo-icon">
                  <img
                    src="assets/images/logo-new.png"
                    alt="Alternate Text"
                    width="150"
                    height="34"
                  />
                </a>
              </div>
              <ul>
                <li>
                  <a href="#">Home </a>
                </li>
                <li>
                  <a href="#">About </a>
                </li>
                <li>
                  <a href="#">Services </a>
                </li>
                <li>
                  <a href="#">Blog </a>
                </li>
                <li>
                  <a href="#">Contact </a>
                </li>
                <li>
                  <a href="#">Shop </a>
                </li>

                <li>
                  <a href="javascript:void(0);" className="open-login">
                    <LiaUser />
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0);" className="open-search">
                    <IoHeartSharp />{" "}
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0);" className="open-cart">
                    <HiOutlineShoppingCart />

                    <span>4</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>

          {/* <!-- ==========  Search wrapper ========== --> */}

          <div className="search-wrapper">
            <input className="form-control" placeholder="Search..." />
            <button className="btn btn-outline-dark btn-sm">Search now</button>
          </div>

          {/* <!-- ==========  Login wrapper ========== --> */}

          <div className="login-wrapper">
            <div className="h5">Sign in</div>
            <form>
              <div className="form-group">
                <input
                  type="email"
                  className="form-control"
                  id="exampleInputEmail1"
                  placeholder="Email"
                />
              </div>
              <div className="form-group">
                <input
                  type="password"
                  className="form-control"
                  id="exampleInputPassword1"
                  placeholder="Password"
                />
              </div>
              <div className="form-group">
                <a
                  href="#forgotpassword"
                  className="open-popup btn btn-main btn-sm"
                >
                  Forgot password?
                </a>
                <a
                  href="#createaccount"
                  className="open-popup btn btn-main btn-sm"
                >
                  Dont have an account?
                </a>
              </div>
              <button
                type="submit"
                className="btn btn-block btn-outline-primary"
              >
                Submit
              </button>
            </form>
          </div>

          {/* <!-- ==========  Cart wrapper ========== --> */}

          <div className="cart-wrapper">
            <div className="checkout">
              <div className="clearfix">
                {/* <!--cart item--> */}

                <div className="row">
                  <div className="cart-block cart-block-item clearfix">
                    <div className="image">
                      <a href="product.html">
                        <img src="assets/images/item-1.jpg" alt="" />
                      </a>
                    </div>
                    <div className="title">
                      <div>
                        <a href="product.html">Product item</a>
                      </div>
                      <small>Product category</small>
                    </div>
                    <div className="quantity">
                      <input
                        type="number"
                        value="2"
                        className="form-control form-quantity"
                      />
                    </div>
                    <div className="price">
                      <span className="final">$ 1.998</span>
                      <span className="discount">$ 2.666</span>
                    </div>
                    {/* <!--delete-this-item--> */}
                    <span className="icon icon-cross icon-delete"></span>
                  </div>

                  {/* <!--cart item--> */}

                  <div className="cart-block cart-block-item clearfix">
                    <div className="image">
                      <a href="product.html">
                        <img src="assets/images/item-2.jpg" alt="" />
                      </a>
                    </div>
                    <div className="title">
                      <div>
                        <a href="product.html">Product item</a>
                      </div>
                      <small>Product category</small>
                    </div>
                    <div className="quantity">
                      <input
                        type="number"
                        value="2"
                        className="form-control form-quantity"
                      />
                    </div>
                    <div className="price">
                      <span className="final">$ 1.998</span>
                      <span className="discount">$ 2.666</span>
                    </div>
                    {/* <!--delete-this-item--> */}
                    <span className="icon icon-cross icon-delete"></span>
                  </div>

                  {/* <!--cart item--> */}

                  <div className="cart-block cart-block-item clearfix">
                    <div className="image">
                      <a href="product.html">
                        <img src="assets/images/item-3.jpg" alt="" />
                      </a>
                    </div>
                    <div className="title">
                      <div>
                        <a href="product.html">Product item</a>
                      </div>
                      <small>Product category</small>
                    </div>
                    <div className="quantity">
                      <input
                        type="number"
                        value="2"
                        className="form-control form-quantity"
                      />
                    </div>
                    <div className="price">
                      <span className="final">$ 1.998</span>
                      <span className="discount">$ 2.666</span>
                    </div>
                    {/* <!--delete-this-item--> */}
                    <span className="icon icon-cross icon-delete"></span>
                  </div>
                </div>

                <hr />

                {/* <!--cart prices --> */}

                <div className="clearfix">
                  <div className="cart-block cart-block-footer clearfix">
                    <div>
                      <strong>Discount 15%</strong>
                    </div>
                    <div>
                      <span>$ 159,00</span>
                    </div>
                  </div>

                  <div className="cart-block cart-block-footer clearfix">
                    <div>
                      <strong>Shipping</strong>
                    </div>
                    <div>
                      <span>$ 30,00</span>
                    </div>
                  </div>

                  <div className="cart-block cart-block-footer clearfix">
                    <div>
                      <strong>VAT</strong>
                    </div>
                    <div>
                      <span>$ 59,00</span>
                    </div>
                  </div>
                </div>

                <hr />

                {/* <!--cart final price --> */}

                <div className="clearfix">
                  <div className="cart-block cart-block-footer clearfix">
                    <div>
                      <strong>Total</strong>
                    </div>
                    <div>
                      <div className="h4 title">$ 1259,00</div>
                    </div>
                  </div>
                </div>

                {/* <!--cart navigation --> */}

                <div className="cart-block-buttons clearfix">
                  <div className="row">
                    <div className="col-sm-6">
                      <a
                        href="products-grid.html"
                        className="btn btn-outline-info"
                      >
                        Continue shopping
                      </a>
                    </div>
                    <div className="col-sm-6 text-right">
                      <a
                        href="checkout-1.html"
                        className="btn btn-outline-warning"
                      >
                        <span className="icon icon-cart"></span> Checkout
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </nav>
    </>
  );
};

export default SampleHeader;
