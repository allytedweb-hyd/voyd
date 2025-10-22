import { environmentUrl } from "../env/enviroment";

////////////////// get blogs //////////////
export const getBlogs = async (limit, offset) => {
    const apiUrl = `${environmentUrl}/blogs/get.php?limit=${limit}&offset=${offset}`;
    const options = {
        method: "GET",
    };
    let response;
    try {
        let data = await fetch(apiUrl, options);
        const fetchedData = await data.json();
        response = fetchedData;
    } catch (e) {
        console.log("errorr", e);
        response = { status: false, message: "Something Went Wrong....." };
    }
    return response;
};

////////////// Add to cart ///////////
export const addToCart = async (eachProduct, saleInfo = null) => {
    console.log("Product details for cart:", eachProduct);
    const data = {
        productId: eachProduct?.product_id,
        productImg: eachProduct?.image_1 || eachProduct?.product_img,
        quantity: 1,
        availableQuantity: eachProduct.product_quantity,
        productName: eachProduct?.product_title,
        productDes: eachProduct?.product_description,
        productMrp: eachProduct?.product_mrp || eachProduct?.product_price,
        offerPrice:
            eachProduct?.product_offerprice || eachProduct?.product_offer_price,
        category: eachProduct?.sub_category || eachProduct?.product_category,
        superSale: saleInfo,
    };
    const apiUrl = `${environmentUrl}/cart/addToCart.php`;
    const options = {
        method: "POST",
        body: JSON.stringify(data),
        headers: { Authorization: "Bearer " + localStorage.getItem("token") },
    };
    let cartRes;
    try {
        const response = await fetch(apiUrl, options);
        const fetchData = await response.json();
        cartRes = fetchData;
    } catch (e) {
        console.log("add to cart error", e);
        cartRes = { status: false, message: "Something Went Wrong " };
    }
    return cartRes;
};

// ////////// get cart items //////////////
export const getCartItems = async () => {
    const apiUrl = `${environmentUrl}/cart/getCartItems.php`;
    const options = {
        method: "GET",
        headers: { Authorization: "Bearer " + localStorage.getItem("token") },
    };
    let cartRes;
    try {
        const cartData = await fetch(apiUrl, options);
        const cartFetch = await cartData.json();
        cartRes = cartFetch;
    } catch (e) {
        console.log("error", e);
        cartRes = { status: false, message: "Something went wrong" };
    }
    return cartRes;
};

//////////////// Add to Wishlist ///////////////
export const addToWishlist = async (eachProduct) => {
    console.log("Product details for wishlist:", eachProduct);
    // return;
    let data = {
        // productId: eachProduct?.product_id,
        // productImg: eachProduct?.image_1,
        // productImgAlt: eachProduct?.alttext_1,
        // quantity: eachProduct?.product_quantity,
        // productName: eachProduct?.product_title,
        // productDes: eachProduct?.product_description,
        // productMrp: eachProduct?.product_mrp,
        // offerPrice: eachProduct?.product_offerprice,
        // category: eachProduct?.sub_category,
        productId: eachProduct?.product_id,
        productImg: eachProduct?.image_1 || eachProduct?.product_img || "",
        productImgAlt: eachProduct?.alttext_1 || "",
        quantity: Number(eachProduct?.product_quantity) || 1,
        productName: eachProduct?.product_title || "",
        productMrp: Number(eachProduct?.product_mrp) || 0,
        offerPrice:
            Number(
                eachProduct?.product_offerprice ||
                    eachProduct?.product_offer_price
            ) || 0,
        category:
            eachProduct?.sub_category || eachProduct?.product_category || "",
    };
    const apiUrl = `${environmentUrl}/wishlist/addItemsToWishlist.php`;
    const options = {
        method: "POST",
        body: JSON.stringify(data),
        headers: { Authorization: "Bearer " + localStorage.getItem("token") },
    };
    let wishlistRes;
    try {
        const response = await (await fetch(apiUrl, options)).json();
        wishlistRes = response;
    } catch (e) {
        wishlistRes = { status: false, message: "Something went wrong" };
    }
    return wishlistRes;
};

////////////// //  get wishlist items
export const getWishlistItems = async () => {
    const apiUrl = `${environmentUrl}/wishlist/getWishlist.php`;
    const options = {
        method: "GET",
        headers: { Authorization: "Bearer " + localStorage.getItem("token") },
    };
    let wishlistRes;
    try {
        const wishlistData = await fetch(apiUrl, options);
        const wishlistFetch = await wishlistData.json();
        wishlistRes = wishlistFetch;
    } catch (e) {
        console.log(" get wishlist block error", e);
        wishlistRes = { status: false, message: "Something went wrong" };
    }
    return wishlistRes;
};

export const getProductsOnCategory = async () => {
    const categoryParams = window.location.search;
    console.log("products page category params", categoryParams);
    const apiUrl = `${environmentUrl}/products/get.php${categoryParams}`;
    const options = {
        method: "GET",
    };
    let productRes;
    try {
        const productsFetch = await (await fetch(apiUrl, options)).json();
        productRes = productsFetch;
    } catch (e) {
        console.log("get product method error", e);
        productRes = { status: false, message: "Something went wrong" };
    }
    return productRes;
};

export const getOurServices = async () => {
    const url = `${environmentUrl}/services/get.php`;
    const options = {
        method: "GET",
    };
    let response;
    try {
        const servicesfetch = await (await fetch(url, options)).json();
        response = servicesfetch;
    } catch (e) {
        console.log("error in our services", e);
    }
    return response;
};

export const getColorMaster = async () => {
    const apiUrl = `${environmentUrl}/masters/getColors.php`;
    const options = {
        method: "GET",
    };
    let colorRes;
    try {
        const colorFetch = await (await fetch(apiUrl, options)).json();
        colorRes = colorFetch;
    } catch (e) {
        console.log("error in color master", e);
    }
    return colorRes;
};

export const getProductCategoryMaster = async () => {
    const apiUrl = `${environmentUrl}/masters/getType.php`;
    const options = {
        method: "GET",
    };
    let productCategoryRes;
    try {
        const productCatFetch = await (await fetch(apiUrl, options)).json();
        productCategoryRes = productCatFetch;
    } catch (e) {
        console.log("error in product category master", e);
    }
    return productCategoryRes;
};

export const getMaterialMaster = async () => {
    const apiUrl = `${environmentUrl}/masters/getMaterial.php`;
    const options = {
        method: "GET",
    };
    let materialMasterRes;
    try {
        const materialFetch = await (await fetch(apiUrl, options)).json();
        materialMasterRes = materialFetch;
    } catch (e) {
        console.log("material master error is", e);
    }
    return materialMasterRes;
};

export const getBrandsMaster = async () => {
    const apiUrl = `${environmentUrl}/masters/getBrands.php`;
    const options = {
        method: "GET",
    };
    let brandsRes;
    try {
        const brandsFetch = await (await fetch(apiUrl, options)).json();
        brandsRes = brandsFetch;
    } catch (e) {
        console.log("error for brands master", e);
    }
    return brandsRes;
};

// indian currency format
export const formatCurrency = (currencyString) => {
    // let firstHalf = currencyString.substring(0, currencyString.length);
    // let secondHalf = currencyString.substring(
    //   currencyString.length - 2,
    //   currencyString.length
    // );
    return parseInt(currencyString).toLocaleString("en-IN", {
        currency: "INR",
        maximumFractionDigits: 0,
    });
};

export const shopCategoryProducts = async (category, limit, offset) => {
    const apiUrl = `${environmentUrl}/products/getProductsCategory.php?productCat=${category}&limit=${limit}&offset=${offset}`;
    const options = {
        method: "GET",
    };
    let productRes;
    try {
        const productsFetch = await (await fetch(apiUrl, options)).json();
        productRes = productsFetch;
    } catch (e) {
        console.log("get product method error", e);
        productRes = { status: false, message: "Something went wrong" };
    }
    return productRes;
};
export function timeCalculator(dateString) {
    const now = new Date();
    const past = new Date(dateString);
    const diffMs = now - past;

    const seconds = Math.floor(diffMs / 1000);
    const minutes = Math.floor(diffMs / (1000 * 60));
    const hours = Math.floor(diffMs / (1000 * 60 * 60));
    const days = Math.floor(diffMs / (1000 * 60 * 60 * 24));
    const months = Math.floor(days / 30);

    if (seconds < 60) {
        return "Just now";
    } else if (minutes < 60) {
        return `${minutes} min${minutes > 1 ? "s" : ""} ago`;
    } else if (hours < 24) {
        return `${hours} hr${hours > 1 ? "s" : ""} ago`;
    } else if (days <= 7) {
        return `${days} day${days > 1 ? "s" : ""} ago`;
    } else if (days <= 90) {
        return `${months} month${months > 1 ? "s" : ""} ago`;
    } else {
        // older than ~3 months → show date
        return past.toLocaleDateString("en-GB", {
            day: "2-digit",
            month: "short",
            year: "numeric",
        });
    }
}

export function timeCal(timestamp) {
    if (!timestamp) return "";

    const now = new Date();
    const created = new Date(timestamp.replace(" ", "T"));

    const diffMs = now - created;

    const seconds = Math.floor(diffMs / 1000);
    const minutes = Math.floor(diffMs / (1000 * 60));
    const hours = Math.floor(diffMs / (1000 * 60 * 60));
    const days = Math.floor(diffMs / (1000 * 60 * 60 * 24));

    if (seconds < 60) return "Just now";
    if (minutes < 60) return `${minutes} minute${minutes > 1 ? "s" : ""} ago`;
    if (hours < 24) return `${hours} hour${hours > 1 ? "s" : ""} ago`;
    if (days === 1) return "Yesterday";
    if (days < 7) return `${days} day${days > 1 ? "s" : ""} ago`;

    return created.toLocaleDateString(undefined, {
        year: "numeric",
        month: "short",
        day: "numeric",
    });
}

export async function saveRecentlyViewed(product, customerId = null) {
    const existing = JSON.parse(localStorage.getItem("recentViewed")) || [];

    // Remove if already exists
    const filtered = existing.filter((p) => p.id !== product.id);

    // Add current product at start
    const updated = [product, ...filtered];

    // Keep only latest 10
    localStorage.setItem("recentViewed", JSON.stringify(updated.slice(0, 10)));
    if (customerId) {
        const apiUrl = `${environmentUrl}/products/save-recent-viewed.php?customer_id=${customerId}`;
        const options = {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                customer_id: customerId,
                products: updated.map((item) => item.id),
            }),
        };
        const response = await (await fetch(apiUrl, options)).json();

        if (response?.status) {
            return response;
        }
    }
}
