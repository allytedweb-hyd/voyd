import { useEffect, useRef, useState } from "react";
import { FaAngleRight, FaAngleLeft } from "react-icons/fa";
import { BiCategoryAlt } from "react-icons/bi";
import { PiSlidersHorizontalBold } from "react-icons/pi";
import { TfiAngleDown } from "react-icons/tfi";
import { CiSearch } from "react-icons/ci";
import { IoClose } from "react-icons/io5";
import Slider from "@mui/material/Slider";
import { GoHeart } from "react-icons/go";
import { useSelector } from "react-redux";
import {
  addToCart,
  addToWishlist,
  getProductCategoryMaster,
  getProductsOnCategory,
} from "../../libs/endpoints";
import Loader from "../Spinner/Loader";
import { envImgUrl } from "../../env/envImage";
import { toast } from "sonner";
import Sonner from "../Toaster/Sonner";
import ReactStars from "react-rating-stars-component";
import { HiOutlineShoppingCart } from "react-icons/hi2";
import { environmentUrl } from "../../env/enviroment";
import { Link } from "react-router-dom";
import { getWishlistItems } from "../../libs/endpoints";
import { GoHeartFill } from "react-icons/go";

const EcommerceFilter = () => {
  const scrollRef = useRef(null);
  const [loading, setLoading] = useState(false);
  const [products, setProducts] = useState([]);
  const [categories, setCategories] = useState([]);
  const [rooms, setRooms] = useState([]);
  const shopCat = useSelector((state) => state?.tab?.value);
  const [currentPage, setCurrentPage] = useState(1);
  const itemsPerPage = 16;
  const [selectedRoom, setSelectedRoom] = useState(null);
  const [selectedCategory, setSelectedCategory] = useState(null);
  const [searchTerm, setSearchTerm] = useState("");
  const [filteredProducts, setFilteredProducts] = useState([]);

  const [selectedCategories, setSelectedCategories] = useState([]);
  const [selectedDiscounts, setSelectedDiscounts] = useState([]);
  const [priceRange, setPriceRange] = useState([10, 1000]);

  const [isCategoryOpen, setCategoryOpen] = useState(true);
  const [isRoomOpen, setRoomOpen] = useState(true);

  const [showAllCategories, setShowAllCategories] = useState(false);
  const [showAllRooms, setShowAllRooms] = useState(false);
  const [wishlisted, setWishlisted] = useState([]);

  const [isSearchOpen, setSearchOpen] = useState(true);
  const [isDiscountOpen, setDiscountOpen] = useState(true);

  const getAllWishListedProducts = async () => {
    try {
      const response = await getWishlistItems();
      if (response?.status && Array.isArray(response?.response)) {
        const productIds = response.response.map((item) => item.product_id);
        setWishlisted(productIds);
      }
    } catch (error) {
      console.error("Error fetching wishlist:", error);
    }
  };

  const initialLimit = 6;

  const scroll = (direction) => {
    if (scrollRef.current) {
      const scrollAmount = 4 * 110;
      scrollRef.current.scrollBy({
        left: direction === "right" ? scrollAmount : -scrollAmount,
        behavior: "smooth",
      });
    }
  };

  // const getAllProductsBasedOnCategory = async () => {
  //   try {
  //     setLoading(true);
  //     const response = await getProductsOnCategory();
  //     setProducts(response?.response);
  //     console.log("products page response is====", response);
  //     console.log("new arrivals====", response);
  //   } catch (error) {
  //     console.log(error);
  //   } finally {
  //     setLoading(false);
  //   }
  // };

  const getAllProductsBasedOnCategory = async () => {
    try {
      setLoading(true);
      const response = await getProductsOnCategory();
      const fetchedProducts = response?.response || [];
      setProducts(fetchedProducts);
    } catch (error) {
      console.error("Error fetching products:", error);
    } finally {
      setLoading(false);
    }
  };

  const handleRoomClick = (room) => {
    console.log("Room clicked:", room);
    setSelectedRoom(room === selectedRoom ? null : room);
  };

  const handleCategoryClick = (category) => {
    setSelectedCategory(category === selectedCategory ? null : category);
  };

  // const getAllProductsBasedOnCategory = async () => {
  //   try {
  //     setLoading(true);
  //     const response = await getProductsOnCategory();
  //     let fetchedProducts = response?.response || [];

  //     console.log("Fetched products from API:", fetchedProducts);

  //     if (shopCat === "room" && selectedRoom) {
  //       fetchedProducts = fetchedProducts.filter(
  //         (product) => Number(product.room) === Number(selectedRoom)
  //       );
  //     }

  //     if (shopCat === "category" && selectedCategory) {
  //       fetchedProducts = fetchedProducts.filter(
  //         (product) => Number(product.product_category) === Number(selectedCategory)
  //       );
  //       console.log(`Filtered products by category (${selectedCategory}):`, fetchedProducts);
  //     }

  //     setProducts(fetchedProducts);
  //   } catch (error) {
  //     console.error("Error fetching products:", error);
  //   } finally {
  //     setLoading(false);
  //     setProducts(fetchedProducts);
  //     setFilteredProducts(fetchedProducts);
  //   }
  // };

  // useEffect(() => {
  //   if (searchTerm.trim() === "") {
  //     setFilteredProducts(products);
  //   } else {
  //     const filtered = products.filter((product) =>
  //       product?.product_title?.toLowerCase().includes(searchTerm.toLowerCase())
  //     );
  //     setFilteredProducts(filtered);
  //   }
  // }, [searchTerm, products]);

  const [tags, setTags] = useState(() => {
    try {
      const stored = JSON.parse(localStorage.getItem("recentTags"));
      if (Array.isArray(stored) && stored.length > 0) {
        return stored;
      }
    } catch (e) {
      console.warn("Failed to parse localStorage tags:", e);
    }

    return ["New", "Kitchen Dining", "Home Decor", "Garden", "Outdoor"];
  });

  const handleRemoveTag = (tagToRemove) => {
    setTags(tags.filter((tag) => tag !== tagToRemove));
  };

  const handleAddTag = (customTerm) => {
    const term = (customTerm || searchTerm).trim();

    if (!term) return;

    if (!tags.includes(term)) {
      const updated = [term, ...tags.filter((t) => t !== term)].slice(0, 10);
      setTags(updated);
    }

    setSearchTerm(term);
  };

  const handleApplyFilters = () => {
    let filtered = [...products];

    console.log("Total products before filtering:", products.length);

    if (shopCat === "category" && selectedRoom) {
      filtered = filtered.filter(
        (product) => Number(product.room) === Number(selectedRoom)
      );
      console.log("Filtered by room:", filtered.length);
    }

    if (shopCat === "room" && selectedCategories.length > 0) {
      filtered = filtered.filter((product) =>
        selectedCategories.includes(product.product_category)
      );
      console.log("Filtered by categories:", filtered.length);
    }

    if (searchTerm.trim() !== "") {
      filtered = filtered.filter((product) =>
        product?.product_title?.toLowerCase().includes(searchTerm.toLowerCase())
      );
      console.log("Filtered by search:", filtered.length);
    }

    filtered = filtered.filter((product) => {
      const offerPrice = parseFloat(product.product_offerprice);
      return (
        !isNaN(offerPrice) &&
        offerPrice >= priceRange[0] &&
        offerPrice <= priceRange[1]
      );
    });
    console.log("Filtered by price range:", priceRange, filtered.length);

    if (selectedDiscounts.length > 0) {
      const numericDiscounts = selectedDiscounts.map((d) => Number(d));
      const maxSelected = Math.max(...numericDiscounts);

      filtered = filtered.filter((product) => {
        const mrp = parseFloat(product.product_mrp);
        const offer = parseFloat(product.product_offerprice);

        if (isNaN(mrp) || isNaN(offer) || mrp === 0) return false;

        const discount = ((mrp - offer) / mrp) * 100;

        return discount <= maxSelected;
      });

      console.log("Filtered by discount ≤", maxSelected, "→", filtered.length);
    }

    console.log("Final filtered products:", filtered.length);
    setFilteredProducts(filtered);
    setCurrentPage(1);
  };

  const getProductCategories = async () => {
    try {
      const response = await getProductCategoryMaster();
      if (response?.status) {
        setCategories(response?.response);
      }
    } catch (error) {
      console.log("error===", error);
    }
  };

  // const handleAddToCart = async (eachProduct) => {
  //   console.log("Product details for cart:", eachProduct);
  //   let response = await addToCart(eachProduct);
  //   if (response?.status) {
  //     toast.success(response?.response);
  //   } else {
  //     toast.error(response?.response);
  //   }
  // };

  // // Add to Wishlist function
  // const handleAddToWishlist = async (eachProduct) => {
  //   console.log("Product details for wishlist:", eachProduct);
  //   let response = await addToWishlist(eachProduct);
  //   if (response?.status) {
  //     toast.success("Successfully Added To Wishlist");
  //   } else {
  //     toast.error("Failed To Add");
  //   }
  // };

  const handleAddToCart = async (eachProduct) => {
    try {
      setLoading(true);
      let response = await addToCart(eachProduct);
      if (response?.status === true) {
        toast.success(response?.response || "Added to cart successfully");
      } else {
        toast.error(
          response?.response || response?.message || "Failed to add to cart"
        );
      }
    } catch (error) {
      console.error("Add to cart error:", error);
      toast.error("Something went wrong adding to cart");
    } finally {
      setLoading(false);
    }
  };

  const handleAddToWishlist = async (eachProduct) => {
    const token = localStorage.getItem("token");

    if (!token) {
      toast.error("Log in to add items to your wishlist");
      return;
    }

    const productId = eachProduct.product_id;
    const isAlreadyWishlisted = wishlisted.includes(productId);

    setWishlisted((prev) => {
      return isAlreadyWishlisted
        ? prev.filter((id) => id !== productId)
        : [...prev, productId];
    });

    try {
      const response = await addToWishlist(eachProduct);

      if (response?.status === true) {
        toast.success(
          isAlreadyWishlisted ? "Removed from Wishlist" : "Added to Wishlist"
        );
      } else {
        setWishlisted((prev) => {
          return isAlreadyWishlisted
            ? [...prev, productId]
            : prev.filter((id) => id !== productId);
        });

        toast.error(response?.response || "Wishlist update failed");
      }
    } catch (error) {
      console.error("Wishlist toggle error:", error);

      setWishlisted((prev) => {
        return isAlreadyWishlisted
          ? [...prev, productId]
          : prev.filter((id) => id !== productId);
      });

      toast.error("Something went wrong");
    }
  };

  // const handleAddToWishlist = async (eachProduct) => {
  //   const isAlreadyWishlisted = wishlisted.includes(eachProduct.product_id);

  //   try {
  //     const response = await addToWishlist(eachProduct);

  //     if (response?.status) {
  //       toast.success(
  //         isAlreadyWishlisted ? "Removed from Wishlist" : "Added to Wishlist"
  //       );
  //       await getAllWishListedProducts();
  //     } else {
  //       toast.error(response?.response || "Wishlist update failed");
  //     }
  //   } catch (error) {
  //     console.error("Wishlist toggle error:", error);
  //     toast.error("Something went wrong");
  //   }
  // };

  const getAllRooms = async () => {
    try {
      setLoading(true);
      const apiUrl = `${environmentUrl}/questionnaire/getPropertyBlock.php`;
      const options = {
        method: "GET",
      };
      const response = await (await fetch(apiUrl, options)).json();
      if (response?.status) {
        setRooms(response?.response);
      }
    } catch (error) {
      console.log("errors====", error);
    } finally {
      setLoading(false);
    }
  };

  const indexOfLastItem = currentPage * itemsPerPage;
  const indexOfFirstItem = indexOfLastItem - itemsPerPage;
  const currentItems = filteredProducts.slice(
    indexOfFirstItem,
    indexOfLastItem
  );
  const totalPages = Math.ceil(filteredProducts.length / itemsPerPage);

  const handlePageChange = (pageNumber) => {
    setCurrentPage(pageNumber);
    window.scrollTo({ top: 0, behavior: "smooth" });
  };

  const handlePrev = () => {
    if (currentPage > 1) setCurrentPage(currentPage - 1);
    window.scrollTo({ top: 0, behavior: "smooth" });
  };

  const handleNext = () => {
    if (currentPage < totalPages) setCurrentPage(currentPage + 1);
    window.scrollTo({ top: 0, behavior: "smooth" });
  };

  useEffect(() => {
    getAllProductsBasedOnCategory();
    getAllRooms();
    getProductCategories();
  }, []);

  useEffect(() => {
    let updatedProducts = [...products];

    if (shopCat === "room" && selectedRoom) {
      updatedProducts = updatedProducts.filter(
        (product) => Number(product.room) === Number(selectedRoom)
      );
    }

    if (shopCat === "category" && selectedCategory) {
      updatedProducts = updatedProducts.filter(
        (product) =>
          Number(product.product_category) === Number(selectedCategory)
      );
    }

    if (searchTerm.trim() !== "") {
      updatedProducts = updatedProducts.filter((product) =>
        product?.product_title?.toLowerCase().includes(searchTerm.toLowerCase())
      );
    }

    setFilteredProducts(updatedProducts);
    setCurrentPage(1);
  }, [products, searchTerm, selectedRoom, selectedCategory, shopCat]);

  // useEffect(() => {
  //   try {
  //     const stored = JSON.parse(localStorage.getItem("recentTags"));
  //     if (Array.isArray(stored) && stored.length > 0) {
  //       setTags(stored);
  //     }
  //   } catch (e) {
  //     console.warn("Failed to load tags from localStorage:", e);
  //   }
  // }, []);

  useEffect(() => {
    try {
      localStorage.setItem("recentTags", JSON.stringify(tags));
    } catch (e) {
      console.warn("Failed to save tags to localStorage:", e);
    }
  }, [tags]);

  // useEffect(() => {
  //   getAllProductsBasedOnCategory();
  // }, [selectedRoom, selectedCategory]);

  useEffect(() => {
    getAllWishListedProducts();
  }, []);

  return (
    <>
      {loading && <Loader />}
      <div className="fill-mains">
        <section className="filterSection">
          <div className="row filFistRow">
            {shopCat === "room" && (
              <div className="col-md-12">
                <div className="row FilterOutr">
                  <div className="col-md-2 d-flex gap-1 pr-0 wi-hf">
                    <div className="roomType">
                      <img src="assets/images/roomicon.png" alt="" />
                    </div>
                    <div className="rm-fnt">Room Type</div>
                  </div>
                  <div className="col-md-8 carouselWrapper wi-hff">
                    <button
                      className="arrowButton"
                      onClick={() => scroll("left")}
                    >
                      <FaAngleLeft />
                    </button>

                    <div className="buttonOuter" ref={scrollRef}>
                      <button
                        type="button"
                        className={`filterButtons2 ${selectedRoom === null ? "active" : ""
                          }`}
                        onClick={() => setSelectedRoom(null)}
                      >
                        All
                      </button>

                      {rooms.length > 0 ? (
                        rooms.map((each) => (
                          <button
                            key={each.section_id}
                            className={`filterButtons2 ${selectedRoom === each.section_id ? "active" : ""
                              }`}
                            onClick={() => handleRoomClick(each.section_id)}
                          >
                            {each?.enter_section}
                          </button>
                        ))
                      ) : (
                        <p>No Room Categories Found</p>
                      )}
                    </div>

                    <button
                      className="arrowButton"
                      onClick={() => scroll("right")}
                    >
                      <FaAngleRight />
                    </button>
                  </div>
                  <div className="col-md-2"></div>
                </div>
              </div>
            )}
            {shopCat === "category" && (
              <div className="col-md-12">
                <div className="FilterOutr">
                  <div className=" col-md-2 cat-out wi-hf">
                    <div className="catIcon">
                      <BiCategoryAlt />
                    </div>
                    <div className="rm-fnt">Category</div>
                  </div>
                  <div className="col-md-10 carouselWrapper wi-hff">
                    <button
                      className="arrowButton"
                      onClick={() => scroll("left")}
                    >
                      <FaAngleLeft />
                    </button>

                    <div className="buttonOuter" ref={scrollRef}>
                      <button
                        type="button"
                        className={`filterButtons2 ${selectedCategory === null ? "active" : ""
                          }`}
                        onClick={() => setSelectedCategory(null)}
                      >
                        All
                      </button>

                      {categories.length > 0 ? (
                        categories.map((each) => (
                          <button
                            key={each.category_id}
                            className={`filterButtons2 ${selectedCategory === each.category_id
                              ? "active"
                              : ""
                              }`}
                            onClick={() =>
                              handleCategoryClick(each.category_id)
                            }
                          >
                            {each?.category_name}
                          </button>
                        ))
                      ) : (
                        <p>No Categories Found</p>
                      )}
                    </div>

                    <button
                      className="arrowButton"
                      onClick={() => scroll("right")}
                    >
                      <FaAngleRight />
                    </button>
                  </div>
                </div>
              </div>
            )}
          </div>
        </section>
        <div className="horizontal-divider-ct"></div>
        <section className="filterSection2">
          <div className="autoScrollContainer">
            <div className="autoScrollTrack">
              <div className="categoryItem">LED Strips</div>
              <div className="categoryItem">Table & Floor Lamps</div>
              <div className="categoryItem">Wall Lights</div>
              <div className="categoryItem">Ceiling Lights</div>
              <div className="categoryItem">Artificial Plants & Flowers</div>
              <div className="categoryItem">Vases & Decorative Accents</div>
              <div className="categoryItem">Beds</div>
              <div className="categoryItem">Clocks & Mirrors</div>
              <div className="categoryItem">Wall Art & Paintings</div>
              <div className="categoryItem">Headboards & Bed Frames</div>
              <div className="categoryItem">Sofa Chairs & Ottomans</div>
              <div className="categoryItem">Sofas</div>
              <div className="categoryItem">Sofas</div>

              {/* Duplicate items for seamless scrolling */}
              <div className="categoryItem">LED Strips</div>
              <div className="categoryItem">Table & Floor Lamps</div>
              <div className="categoryItem">Wall Lights</div>
              <div className="categoryItem">Ceiling Lights</div>
              <div className="categoryItem">Artificial Plants & Flowers</div>
              <div className="categoryItem">Vases & Decorative Accents</div>
              <div className="categoryItem">Beds</div>
              <div className="categoryItem">Clocks & Mirrors</div>
              <div className="categoryItem">Wall Art & Paintings</div>
              <div className="categoryItem">Headboards & Bed Frames</div>
              <div className="categoryItem">Sofa Chairs & Ottomans</div>
              <div className="categoryItem">Sofas</div>
              <div className="categoryItem">Sofas</div>
            </div>
          </div>
        </section>
      </div>
      <div className="main-content-section">
        <section className="pt-0">
          <div className="container fil-con filRe-con fil-pn">
            <div className="row">
              <div className="col-md-3 col-sm-4 padTB">
                <div className="filter-div2">
                  <div className="srch-div">
                    <div className="d-flex mb-4">
                      {" "}
                      <div>
                        <h6 className="fil-txt text-dark m-0">Filter</h6>
                      </div>
                      <div className="px-3 d-flex align-items-center text-dark slider-icon">
                        <PiSlidersHorizontalBold />
                      </div>
                    </div>
                  </div>
                  <div className="type-Div">
                    <div className="s-anlge"

                      onClick={() => setSearchOpen((prev) => !prev)}
                      style={{ cursor: "pointer", userSelect: "none" }}
                    >
                      <div className="srch-txt">search</div>
                      <div className={`dn-anfle ${isSearchOpen ? "open" : ""}`}>
                        <TfiAngleDown className="ang-dn" />
                      </div>
                    </div>
                    {isSearchOpen && (
                      <div className="search-tags-container">
                        <div className="search-input-wrapper">
                          <input
                            type="text"
                            placeholder="Search product"
                            className="search-input"
                            value={searchTerm}
                            onChange={(e) => setSearchTerm(e.target.value)}
                            onKeyDown={(e) => {
                              if (e.key === "Enter") {
                                e.preventDefault();
                                if (searchTerm.trim() !== "") {
                                  handleAddTag();
                                }
                              }
                            }}
                          />
                          <span className="search-icon">
                            <CiSearch />
                          </span>
                        </div>

                        {/* <div className="tags-wrapper">
                        <div className="tag">
                          Flower Decor{" "}
                          <span className="tag-close">
                            <IoClose />
                          </span>
                        </div>
                        <div className="tag">
                          Kitchen Dining{" "}
                          <span className="tag-close">
                            <IoClose />
                          </span>
                        </div>
                        <div className="tag">
                          Home Decor{" "}
                          <span className="tag-close">
                            <IoClose />
                          </span>
                        </div>
                        <div className="tag">
                          Garden{" "}
                          <span className="tag-close">
                            <IoClose />
                          </span>
                        </div>
                        <div className="tag">
                          Outdoor{" "}
                          <span className="tag-close">
                            <IoClose />
                          </span>
                        </div>
                      </div> */}

                        <div className="tags-wrapper">
                          {tags.map((tag, idx) => (
                            <div
                              key={idx}
                              className="tag"
                              style={{ cursor: "pointer" }}
                            >
                              <span
                                onClick={() => {
                                  setSearchTerm(tag);
                                  handleAddTag(tag);
                                }}
                              >
                                {tag}
                              </span>
                              <span
                                className="tag-close"
                                onClick={(e) => {
                                  e.stopPropagation();
                                  handleRemoveTag(tag);
                                }}
                                style={{ cursor: "pointer" }}
                              >
                                <IoClose />
                              </span>
                            </div>
                          ))}
                        </div>

                      </div>
                    )}
                  </div>
                  <div className="type-Div type-pgn">
                    {/* <div className="filter-section">
                      <div className="filter-header">
                        <span className="filter-title">Furniture & Chairs</span>
                        <span className="filter-arrow">
                          <TfiAngleDown className="ang-dn" />
                        </span>
                      </div>
                      <div className="filter-options-ct">
                        <div>
                          {" "}
                          <label className="filter-option-ct">
                            <input type="checkbox" />
                            <span className="custom-checkbox-ct"></span>
                            <span className="option-label-ct bold">
                              Office Essentials &Desks
                            </span>
                          </label>
                        </div>
                        <div>
                          <label className="filter-option-ct">
                            <input type="checkbox" />
                            <span className="custom-checkbox-ct"></span>
                            <span className="option-label-ct">Sofas</span>
                          </label>
                        </div>
                        <div>
                          {" "}
                          <label className="filter-option-ct">
                            <input type="checkbox" />
                            <span className="custom-checkbox-ct"></span>
                            <span className="option-label-ct">Recliners</span>
                          </label>
                        </div>
                        <div>
                          <label className="filter-option-ct">
                            <input type="checkbox" />
                            <span className="custom-checkbox-ct"></span>
                            <span className="option-label-ct">Study Desks</span>
                          </label>
                        </div>
                        <div>
                          <label className="filter-option-ct">
                            <input type="checkbox" />
                            <span className="custom-checkbox-ct"></span>
                            <span className="option-label-ct">Planters</span>
                          </label>
                        </div>
                      </div>
                    </div> */}
                    {shopCat === "room" && (
                      <div className="filter-section">
                        <div
                          className="filter-header"
                          onClick={() => setRoomOpen((prev) => !prev)}
                          style={{ cursor: "pointer", userSelect: "none" }}
                        >
                          <span className="filter-title">
                            Product Categories
                          </span>
                          <span
                            className={`filter-arrow ${isRoomOpen ? "open" : ""
                              }`}
                          >
                            <TfiAngleDown className="ang-dn" />
                          </span>
                        </div>

                        {isRoomOpen && (
                          <div className="filter-options-ct">
                            {(showAllCategories
                              ? categories
                              : categories.slice(0, initialLimit)
                            ).map((cat) => (
                              <div key={cat.category_id}>
                                <label className="filter-option-ct">
                                  <input
                                    type="checkbox"
                                    checked={selectedCategories.includes(
                                      cat.category_id
                                    )}
                                    onChange={() => {
                                      setSelectedCategories((prev) =>
                                        prev.includes(cat.category_id)
                                          ? prev.filter(
                                            (id) => id !== cat.category_id
                                          )
                                          : [...prev, cat.category_id]
                                      );
                                    }}
                                  />
                                  <span className="custom-checkbox-ct"></span>
                                  <span className="option-label-ct bold">
                                    {cat.category_name}
                                  </span>
                                </label>
                              </div>
                            ))}

                            {categories.length > initialLimit && (
                              <button
                                className="see-more-btn"
                                onClick={() =>
                                  setShowAllCategories((prev) => !prev)
                                }
                                style={{ marginTop: "8px", cursor: "pointer" }}
                              >
                                {showAllCategories ? "See Less" : "See More"}
                              </button>
                            )}
                          </div>
                        )}
                      </div>
                    )}

                    {shopCat === "category" && (
                      <div className="filter-section">
                        <div
                          className="filter-header"
                          onClick={() => setCategoryOpen((prev) => !prev)}
                          style={{ cursor: "pointer", userSelect: "none" }}
                        >
                          <span className="filter-title">Room Types</span>
                          <span
                            className={`filter-arrow ${isCategoryOpen ? "open" : ""
                              }`}
                          >
                            <TfiAngleDown className="ang-dn" />
                          </span>
                        </div>

                        {isCategoryOpen && (
                          <div className="filter-options-ct">
                            {(showAllRooms
                              ? rooms
                              : rooms.slice(0, initialLimit)
                            ).map((room) => (
                              <div key={room.section_id}>
                                <label className="filter-option-ct">
                                  <input
                                    type="checkbox"
                                    checked={selectedRoom === room.section_id}
                                    onChange={() =>
                                      setSelectedRoom((prev) =>
                                        prev === room.section_id
                                          ? null
                                          : room.section_id
                                      )
                                    }
                                  />
                                  <span className="custom-checkbox-ct"></span>
                                  <span className="option-label-ct">
                                    {room.enter_section}
                                  </span>
                                </label>
                              </div>
                            ))}

                            {rooms.length > initialLimit && (
                              <button
                                className="see-more-btn"
                                onClick={() => setShowAllRooms((prev) => !prev)}
                                style={{ marginTop: "8px", cursor: "pointer" }}
                              >
                                {showAllRooms ? "See Less" : "See More"}
                              </button>
                            )}
                          </div>
                        )}
                      </div>
                    )}
                  </div>
                  <div className="type-Div type-pgn">
                    <div className="filter-section">
                      <div className="filter-header"

                        onClick={() => setDiscountOpen((prev) => !prev)}
                        style={{ cursor: "pointer", userSelect: "none" }}

                      >
                        <span className="filter-title">On Discount</span>
                        <span className={`filter-arrow ${isDiscountOpen ? "open" : ""}`}>
                          <TfiAngleDown className="ang-dn" />
                        </span>
                      </div>
                      {/* <div className="filter-options-ct">
                        <div>
                          {" "}
                          <label className="filter-option-ct">
                            <input type="checkbox" checked={selectedDiscounts.includes(5)}
                              onChange={() =>
                                setSelectedDiscounts((prev) =>
                                  prev.includes(5)
                                    ? prev.filter((d) => d !== 5)
                                    : [...prev, 5]
                                )
                              } />
                            <span className="custom-checkbox-ct"></span>
                            <span className="option-label-ct bold">
                              05 % Off
                            </span>
                          </label>
                        </div>
                        <div>
                          {" "}
                          <label className="filter-option-ct">
                            <input type="checkbox" checked={selectedDiscounts.includes(5)}
                              onChange={() =>
                                setSelectedDiscounts((prev) =>
                                  prev.includes(5)
                                    ? prev.filter((d) => d !== 5)
                                    : [...prev, 5]
                                )
                              } />
                            <span className="custom-checkbox-ct"></span>
                            <span className="option-label-ct">10 % Off</span>
                          </label>
                        </div>
                        <div>
                          <label className="filter-option-ct">
                            <input type="checkbox" checked={selectedDiscounts.includes(5)}
                              onChange={() =>
                                setSelectedDiscounts((prev) =>
                                  prev.includes(5)
                                    ? prev.filter((d) => d !== 5)
                                    : [...prev, 5]
                                )
                              } />
                            <span className="custom-checkbox-ct"></span>
                            <span className="option-label-ct">20 % Off</span>
                          </label>
                        </div>
                        <div>
                          <label className="filter-option-ct">
                            <input type="checkbox" checked={selectedDiscounts.includes(5)}
                              onChange={() =>
                                setSelectedDiscounts((prev) =>
                                  prev.includes(5)
                                    ? prev.filter((d) => d !== 5)
                                    : [...prev, 5]
                                )
                              } />
                            <span className="custom-checkbox-ct"></span>
                            <span className="option-label-ct">30 % Off</span>
                          </label>
                        </div>
                      </div> */}
                      {isDiscountOpen && (
                        <div className="filter-options-ct">
                          {[5, 10, 20, 30].map((discount) => (
                            <div key={discount}>
                              <label className="filter-option-ct">
                                <input
                                  type="checkbox"
                                  checked={selectedDiscounts.includes(discount)}
                                  onChange={() =>
                                    setSelectedDiscounts((prev) =>
                                      prev.includes(discount)
                                        ? prev.filter((d) => d !== discount)
                                        : [...prev, discount]
                                    )
                                  }
                                />
                                <span className="custom-checkbox-ct"></span>
                                <span className="option-label-ct bold">
                                  {discount} % Off
                                </span>
                              </label>
                            </div>
                          ))}
                        </div>
                      )}
                    </div>
                  </div>
                  {/* <div className="type-Div">
                    <div className="filter-section">
                      <div className="filter-header pb-3">
                        <span className="filter-title">Colour</span>
                        <span className="filter-arrow">
                          <TfiAngleDown className="ang-dn" />
                        </span>
                      </div>
                      <div className="color-swatches">
                        <div className="swatch1">
                          <div className="swatch swatch-black"></div>
                          <div className="swatch swatch-red"></div>
                          <div className="swatch swatch-rose"></div>
                          <div className="swatch swatch-purple-dark"></div>
                          <div className="swatch swatch-blue"></div>
                          <div className="swatch swatch-lavender"></div>
                        </div>
                        <div className="swatch2">
                          <div className="swatch swatch-black"></div>
                          <div className="swatch swatch-red"></div>
                          <div className="swatch swatch-rose"></div>
                          <div className="swatch swatch-purple-dark"></div>
                          <div className="swatch swatch-blue"></div>
                          <div className="swatch swatch-lavender"></div>
                        </div>
                      </div>

                      <div>
                        {" "}
                        <label className="filter-option-ct pb-2">
                          <input type="checkbox" />
                          <span className="custom-checkbox-ct"></span>
                          <span className="option-label-ct bold">
                            Multi Colour
                          </span>
                        </label>
                      </div>
                    </div>
                  </div> */}
                  <div className="quest-gaps mda-btm">
                    <div
                      name="cars"
                      id="cars"
                      className="sel-inp border-none mda-price mda-txt"
                    >
                      Price Filter
                    </div>
                  </div>
                  {/* <Slider className="progressLine" /> */}
                  <div className=" d-flex justify-content-between pdng-slider border-bottom">
                    {/* <div className="from-txt">
                      <span className="price-range-txt mr-2">₹10</span>
                      From
                    </div>
                    <div className="from-txt ">
                      To
                      <span className="price-range-txt  ml-2">₹1000</span>
                    </div> */}
                    <Slider
                      className="progressLine"
                      value={priceRange}
                      min={0}
                      max={10000}
                      onChange={(e, newValue) => setPriceRange(newValue)}
                      valueLabelDisplay="auto"
                    />
                  </div>
                  <div className="text-center">
                    <button
                      className="sub-qt-btn-filters"
                      type="submit"
                      onClick={handleApplyFilters}
                    >
                      APPLY FILTERS
                    </button>
                  </div>
                </div>

                <div className="filter-div2 mt-3 pdng-halff">
                  <div className="text-center">
                    <div>
                      <img src="assets/images/Frame 30.png" alt="" />
                    </div>
                    <div className="bag-text col-grey">
                      You have not added any products to your favorite
                    </div>
                  </div>
                </div>
              </div>
              <div className="col-md-9 col-sm-8 ">
                <div className="row filtersBy">
                  {/* {products.length > 0 ? (
                    products.map((item, index) => ( */}
                  {currentItems && currentItems.length > 0 ? (
                    currentItems.map((item, index) => (
                      <div className="col-md-3 col-sm-6" key={index}>
                        <div className="text-center box-product box-rsnve spill-crds rustic-crds ">
                          {/* <button
                            className="d-flex justify-content-end heart-sty heart-mdle-n "
                            type="button"
                            onClick={() => handleAddToWishlist(item)}
                          >
                            <GoHeart className="wishlist-icn" />
                          </button> */}
                          <button
                            className="d-flex justify-content-end heart-sty rightP heart-mdle wishListButton"
                            type="button"
                            onClick={() => handleAddToWishlist(item)}
                            aria-label={
                              wishlisted.includes(item.product_id)
                                ? "Remove from wishlist"
                                : "Add to wishlist"
                            }
                          >
                            {wishlisted.includes(item.product_id) ? (
                              <GoHeartFill
                                className="wishlist-icn"
                                style={{ color: "red" }}
                              />
                            ) : (
                              <GoHeart className="wishlist-icn" />
                            )}
                          </button>

                          <Link
                            to={`/productpage?productId=${item.product_id}`}
                          >
                            <div className="filProImg-1">
                              <img
                                src={`${envImgUrl}/Uploads/products/${item.image_1}`}
                                alt={item?.product_alttext}
                                className=""
                              />
                            </div>
                          </Link>
                          <div className="ele-types">
                            <div className="nameStars">
                              <div className="pro-text pro-ree pro-des pr-mbl ">
                                <Link
                                  to={`/productpage?productId=${item.product_id}`}
                                >
                                  {item?.product_title}
                                </Link>
                              </div>
                              <div className="str-coll str-mbl ratingStarsOuter">
                                <ReactStars
                                  count={5}
                                  // size={13}
                                  activeColor="#FBBC04"
                                  value={Number(item?.average_rating)}
                                  edit={false}
                                />
                              </div>
                            </div>
                            <div className="nameStars">
                              <div className="btn-start">
                                <button
                                  className="cart-btn cart-rp"
                                  type="button"
                                  onClick={() => handleAddToCart(item)}
                                >
                                  <HiOutlineShoppingCart />
                                </button>
                              </div>
                              <div className="pri-doll pri-pnkl">
                                <span className="stricked-price">
                                  ₹{item?.product_mrp}
                                </span>
                                ₹{item?.product_offerprice}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    ))
                  ) : (
                    <div className="container">
                      <div className="row">
                        <div className="result-container conditionImg">
                          <img src="assets/images/noDataFound.png" alt="" />
                        </div>
                      </div>
                    </div>
                  )}
                </div>
              </div>
            </div>
          </div>
        </section>

        {products.length > 0 && (
          <div className="productPagination page-bg-btn-fil">
            <div className="pgn-fltr prev-flt" onClick={handlePrev}>
              Preview
            </div>
            <div className="numbers-main num-mn">
              {(() => {
                const pageButtons = [];
                const visiblePages = 2;
                for (let i = 1; i <= totalPages; i++) {
                  if (
                    i === 1 ||
                    i === totalPages ||
                    (i >= currentPage - visiblePages &&
                      i <= currentPage + visiblePages)
                  ) {
                    pageButtons.push(
                      <button
                        key={i}
                        className={`page-btns ${currentPage === i ? "grn-btn" : ""
                          }`}
                        onClick={() => handlePageChange(i)}
                      >
                        {i}
                      </button>
                    );
                  } else if (
                    (i === currentPage - visiblePages - 1 &&
                      currentPage - visiblePages > 2) ||
                    (i === currentPage + visiblePages + 1 &&
                      currentPage + visiblePages < totalPages - 1)
                  ) {
                    pageButtons.push(
                      <button
                        key={`ellipsis-${i}`}
                        className="page-btns"
                        disabled
                      >
                        ...
                      </button>
                    );
                  }
                }
                return pageButtons;
              })()}
            </div>
            <div className="pgn-fltr nxt-flt" onClick={handleNext}>
              Next
            </div>
          </div>
        )}
      </div>
      <Sonner />
    </>
  );
};

export default EcommerceFilter;
