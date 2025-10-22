import { useEffect, useState } from "react";
import { FaRegHeart } from "react-icons/fa";
import { CiHeart } from "react-icons/ci";
// import { FiTrash2 } from "react-icons/fi";
import { MdRemoveCircleOutline } from "react-icons/md";
import { FaArrowRight } from "react-icons/fa";
import { FaCheckCircle } from "react-icons/fa";
import { addToWishlist, formatCurrency, getCartItems } from "../libs/endpoints";
import Loader from "../Components/Spinner/Loader";
import { environmentUrl } from "../env/enviroment";
import { envImgUrl } from "../env/envImage";
import { toast } from "sonner";
import Sonner from "../Components/Toaster/Sonner";
import { getWishlistItems } from "../libs/endpoints";

const MyCart = () => {
  const [cartItems, setCartItems] = useState([]);
  const [loading, setLoading] = useState(false);
  const [cartTotalPrice, setCartTotalPrice] = useState(0);
  const [filteredCartItems, setFilteredCartItems] = useState([]);
  const [searchTerm, setSearchTerm] = useState("");
  const [wishlistedItems, setWishlistedItems] = useState([]);
  // const getAllCartItems = async () => {
  //   try {
  //     setLoading(true);
  //     const response = await getCartItems();
  //     if (response?.status) {
  //       setCartItems(response?.response);
  //       setFilteredCartItems(response?.response);
  //       setCartTotalPrice(response?.cartTotalValue?.totalVal);
  //     }
  //   } catch (error) {
  //     console.log(error);
  //   } finally {
  //     setLoading(false);
  //   }
  // };

  // const handleAddToWishlist = async (item) => {
  //   try {
  //     setLoading(true);
  //     const response = await addToWishlist(item);
  //     if (response?.status) {
  //       toast.success("Successfully Added To Wishlist");
  //       await getAllCartItems();
  //     }
  //   } catch (error) {
  //     console.log("add to wishlist error===", error);
  //   } finally {
  //     setLoading(false);
  //   }
  // };

  const getAllCartItems = async () => {
    try {
      setLoading(true);
      const response = await getCartItems();
      if (response?.status) {
        // const items = response?.response || [];

        const items = (response?.response || []).map((item) => ({
          ...item,
          current_quantity: item.current_quantity || 1,
        }));

        setCartItems(items);

        const newFilteredItems =
          searchTerm.trim() !== ""
            ? items.filter((item) =>
                item?.product_title
                  ?.toLowerCase()
                  .includes(searchTerm.toLowerCase())
              )
            : items;

        setFilteredCartItems(newFilteredItems);
        setCartTotalPrice(response?.cartTotalValue?.totalVal || 0);
      } else {
        setCartItems([]);
        setFilteredCartItems([]);
        setCartTotalPrice(0);
      }
    } catch (error) {
      console.log(error);
      setCartItems([]);
      setFilteredCartItems([]);
      setCartTotalPrice(0);
    } finally {
      setLoading(false);
    }
  };

  // const handleAddToWishlist = async (item) => {
  //   try {
  //     setLoading(true);
  //     const response = await addToWishlist(item);
  //     console.log("Adding to wishlist item:", item);
  //     if (response?.status) {
  //       const itemId = String(item?.product_id);
  //       if (!itemId) {
  //         toast.error("Product ID is missing");
  //         return;
  //       }
  //       const isAlreadyWishlisted = wishlistedItems.includes(itemId);

  //       if (isAlreadyWishlisted) {
  //         toast.success("Removed from wishlist");
  //         setWishlistedItems((prev) => prev.filter((id) => id !== itemId));
  //       } else {
  //         toast.success("Added to wishlist");
  //         setWishlistedItems((prev) => [...prev, itemId]);
  //       }

  //       await getAllCartItems();
  //     }
  //   } catch (error) {
  //     console.log("add to wishlist error===", error);
  //     toast.error("Failed to update wishlist");
  //   } finally {
  //     setLoading(false);
  //   }
  // };

  const handleAddToWishlist = async (item) => {
    try {
      setLoading(true);

      const token = localStorage.getItem("token");
      if (!token) {
        toast.error("Log in to add items to your wishlist");
        return;
      }

      const wishlistItem = {
        product_id: item.product_id,
        product_img: item.product_img || "",
        product_img_alt: item.alttext_1 || "",
        quantity: item.product_quantity || 1,
        product_name: item.product_title,
        product_mrp: item.product_price || 0,
        product_offer_price: item.offer_price || 0,
        category: item.product_category || "",
      };

      console.log("Data sent to addToWishlist API:", wishlistItem);

      const response = await addToWishlist(wishlistItem);

      if (response?.status) {
        toast.success("Added to wishlist");
        setWishlistedItems((prev) => [...prev, String(item.product_id)]);
        await getAllCartItems();
      } else {
        throw new Error(response?.message || "Wishlist update failed");
      }
    } catch (error) {
      console.log("Wishlist error:", error);
      toast.error("Failed to update wishlist");
    } finally {
      setLoading(false);
    }
  };

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
    if (removeRes?.status) {
      toast.success(removeRes?.response);
      await getAllCartItems();
    }
  };

  // const handleQuantityDecrement = (product) => {
  //   const modifiedItems = cartItems.filter((item) => {
  //     if (item?.cart_id == product?.cart_id) {
  //       product["product_quantity"] = Number(product?.product_quantity) - 1;
  //     }
  //     return product;
  //   });
  //   setCartItems(modifiedItems);
  // };

  const handleQuantityDecrement = (product) => {
    setCartItems((prevItems) =>
      prevItems.map((item) => {
        if (item.cart_id === product.cart_id) {
          const currentQty = Number(item.current_quantity || 1);
          if (currentQty <= 1) {
            toast.warning("Minimum quantity is 1");
            return item;
          }
          return { ...item, current_quantity: currentQty - 1 };
        }
        return item;
      })
    );
  };

  const handleSearch = (event) => {
    const term = event.target.value;
    setSearchTerm(term);

    if (term.trim() === "") {
      // If empty, reset to show all
      setFilteredCartItems(cartItems);
    } else {
      // Otherwise, filter by search term
      const filtered = cartItems.filter((item) =>
        item?.product_title?.toLowerCase().includes(term.toLowerCase())
      );
      setFilteredCartItems(filtered);
    }
  };

  // const handleQuantityIncrement = (product) => {
  //   const modifiedItems = cartItems.filter((item) => {
  //     if (item?.cart_id == product?.cart_id) {
  //       product["product_quantity"] = Number(product?.product_quantity) + 1;
  //     }
  //     return product;
  //   });
  //   setCartItems(modifiedItems);
  // };

  const handleQuantityIncrement = (product) => {
    setCartItems((prevItems) =>
      prevItems.map((item) => {
        if (item.cart_id === product.cart_id) {
          const currentQty = Number(item.current_quantity || 1);
          const maxQty = Number(item.product_quantity);
          if (currentQty >= maxQty) {
            toast.warning("Maximum quantity reached");
            return item;
          }
          return { ...item, current_quantity: currentQty + 1 };
        }
        return item;
      })
    );
  };

  useEffect(() => {
    getAllCartItems();
  }, []);

  useEffect(() => {
    const fetchWishlist = async () => {
      try {
        const res = await getWishlistItems();
        if (res?.status) {
          const ids = res.response.map((item) => String(item.product_id));
          setWishlistedItems(ids);
        }
      } catch (error) {
        console.log("Failed to load wishlist", error);
      }
    };
    fetchWishlist();
  }, []);

  useEffect(() => {
    if (searchTerm.trim() === "") {
      setFilteredCartItems(cartItems);
    }
  }, [cartItems, searchTerm]);

  return (
    <div>
      {loading && <Loader />}
      <section className="myCrtSection">
        <div className="container main-crt-card">
          <div className="con-inner-ct">
            <div className="row ">
              <div className="cart-container">
                <div className="cart-header">
                  <h1>MY CART</h1>
                  <p>HOME &gt; MY CART</p>
                </div>

                <div className="row cart-box">
                  <div className="col-md-4">
                    <h5 className="cart-title">My Cart (3)</h5>
                  </div>
                  <div className="col-md-4">
                    {" "}
                    <input
                      type="text"
                      className="cart-search"
                      placeholder="| Search items in your cart..."
                      value={searchTerm}
                      onChange={handleSearch}
                    />
                  </div>
                  <div className="col-md-4"></div>
                </div>
              </div>
            </div>
            <div className="row crt-card-sec">
              <div className="itm-slc">
                <input type="checkbox" name="" id="" />0 ITEMS SELECTED
              </div>
              <div className="col-md-8 cartItemsOuter">
                {filteredCartItems.length > 0 ? (
                  filteredCartItems.map((item, index) => (
                    <div className="row cart-item-card-ct" key={index}>
                      <div className="col-md-4">
                        <div className="cart-item-image-wrapper-ct">
                          <span className="discount-badge-ct">
                            SAVE {item?.product_price - item?.offer_price}
                            /-
                          </span>
                          <div className="cart-imgs">
                            {" "}
                            <img
                              src={`${envImgUrl}/Uploads/products/${item?.product_img}`}
                              alt=""
                              className="cart-item-image-ct"
                            />
                          </div>
                        </div>
                      </div>
                      <div className="col-md-8">
                        <div className="cart-item-details-ct">
                          <h5 className="product-title-ct">
                            {item?.product_title}
                          </h5>
                          <p
                            className="product-description-ct"
                            dangerouslySetInnerHTML={{
                              __html: item?.product_description,
                            }}
                          ></p>

                          <div className="price-section-ct">
                            <span className="price-ct">
                              ₹{item?.offer_price}
                            </span>
                            <span className="old-price-ct">
                              ₹{item?.product_price}
                            </span>
                          </div>

                          {/* Quantity Controls */}
                          <div className="quantity-box-ct">
                            <button
                              type="button"
                              onClick={() => handleQuantityDecrement(item)}
                            >
                              -
                            </button>
                            <span>{item.current_quantity || 1}</span>
                            <button
                              type="button"
                              onClick={() => handleQuantityIncrement(item)}
                            >
                              +
                            </button>
                          </div>

                          {/* Availability & Actions */}
                          <div className="cart-actions-ct">
                            <span className="free-shipping-ct">
                              FREE SHIPPING
                            </span>
                            <div className="d-flex justify-content-between tabCal">
                              <div className="stock-status-ct">
                                <FaCheckCircle className="stock-icon-ct" />
                                <span>In stock</span>
                              </div>

                              <div className="wishlist-remove-ct">
                                {/* <button
                                  className="wishlist-ct"
                                  type="button"
                                  onClick={() => handleAddToWishlist(item)}
                                >
                                  <FaRegHeart /> Add to Wishlist
                                </button> */}
                                <button
                                  tabIndex={0}
                                  className={`wishlisting text-success ${
                                    wishlistedItems.includes(
                                      String(item.product_id)
                                    )
                                      ? "wishlisted"
                                      : ""
                                  }`}
                                  onClick={() => handleAddToWishlist(item)}
                                  onKeyDown={(e) => {
                                    if (e.key === "Enter" || e.key === " ")
                                      handleAddToWishlist(item);
                                  }}
                                  style={{
                                    cursor: "pointer",
                                    userSelect: "none",
                                  }}
                                  aria-pressed={wishlistedItems.includes(
                                    String(item.product_id)
                                  )}
                                  aria-label={
                                    wishlistedItems.includes(
                                      String(item.product_id)
                                    )
                                      ? "Remove from wishlist"
                                      : "Add to wishlist"
                                  }
                                >
                                  <CiHeart
                                    className="hrt-sym"
                                    style={{
                                      color: wishlistedItems.includes(
                                        String(item.product_id)
                                      )
                                        ? "red"
                                        : "inherit",
                                    }}
                                  />
                                  {wishlistedItems.includes(
                                    String(item.product_id)
                                  )
                                    ? "Wishlisted"
                                    : "Add to Wishlist"}
                                </button>

                                <div className="remove-container-ct">
                                  <div className="divider-ct"></div>
                                  <button
                                    className="remove-ct"
                                    type="button"
                                    onClick={() =>
                                      removeItemFromCart(item?.product_id)
                                    }
                                  >
                                    <MdRemoveCircleOutline className="remove-icon-ct" />
                                    <span className="remove-text-ct">
                                      Remove
                                    </span>
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  ))
                ) : (
                  <div className="container">
                    <div className="row">
                      <div className="result-container conditionImg cart">
                        <img src="assets/images/noDataFound.png" alt="" />
                      </div>
                    </div>
                  </div>
                )}
              </div>
              {cartItems.length > 0 && (
                <div className="col-md-4 paddingZ">
                  <div className="order-summary-container-ct">
                    <h3 className="summary-title-ct">Order Summary</h3>

                    <div className="summary-item-ct">
                      <span className="label-ct">Sub Total:</span>
                      <span className="value-ct">
                        {formatCurrency(cartTotalPrice)}/-
                      </span>
                    </div>

                    <div className="summary-item-ct">
                      <span className="label-ct">Shpping estimate:</span>
                      <span className="value-ct">$600.00</span>
                    </div>

                    <div className="summary-item-ct">
                      <span className="label-ct">Tax estimate:</span>
                      <span className="value-ct">
                        {" "}
                        {formatCurrency(Number(cartTotalPrice) * 0.18)}/-
                      </span>
                    </div>

                    <div className="summary-item-total-ct">
                      <span className="label-bold-ct">ORDER TOTAL:</span>
                      <span className="value-bold-ct">
                        {" "}
                        {formatCurrency(
                          Number(cartTotalPrice * 0.18) + Number(cartTotalPrice)
                        )}
                        /-
                      </span>
                    </div>

                    <button className="checkout-btn-ct">CHECKOUT</button>
                    <button className="continue-btn-ct">
                      CONTINUE SHOPPING{" "}
                      <FaArrowRight className="arrow-icon-ct" />
                    </button>
                  </div>
                </div>
              )}
            </div>
          </div>
        </div>
      </section>
      <Sonner />
    </div>
  );
};

export default MyCart;
