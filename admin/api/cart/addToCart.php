<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization');

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    header("HTTP/1.1 200 OK");
    die();
}

include '../Authentication/authToken.php';
include "../../includes/db.php";

$headers = apache_request_headers();

// if (!isset($headers['Authorization'])) {
//     http_response_code(401);
//     echo json_encode(['status' => false, 'message' => 'Unauthorized']);
//     exit();
// }

// $token = str_replace('Bearer ', '', $headers['Authorization']);
// $response = verifyAuthToken($token);

// if (!$response['status']) {
//     http_response_code(401);
//     echo json_encode(['status' => false, 'message' => 'Unauthorized']);
//     exit();
// }

if (!isset($headers['Authorization'])) {
    http_response_code(401);
    echo json_encode(['status' => false, 'message' => 'Log in to add items to your cart']);
    exit();
}

$token = str_replace('Bearer ', '', $headers['Authorization']);
$response = verifyAuthToken($token);


if (!isset($response['status']) || $response['status'] === false) {
    http_response_code(401);
    echo json_encode([
        'status' => false,
        'message' => 'Log in to add items to your cart'
    ]);
    exit();
}







// Input
$data = json_decode(file_get_contents("php://input"));

$id = $response['loginid'];
$product_id = $data->productId;
$product_img = $data->productImg;
$quantity = intval($data->quantity);
$stockAvailability = intval($data->availableQuantity);
$product_name = $data->productName;
$product_mrp = $data->productMrp;
$offer_price = $data->offerPrice;
$category = $data->category;

// Cap quantity by stock
if ($quantity > $stockAvailability) {
    echo json_encode([
        'status' => false,
        'response' => "Quantity exceeds available stock",
        'availableStock' => $stockAvailability
    ]);
    exit();
}

$totalPrice = $quantity * intval($offer_price);

// Check if product is already in cart
$getProductInCart = mysqli_query($conn, "
    SELECT * FROM cart 
    WHERE product_id = '$product_id' AND customer_id = '$id' AND status = 1
");

if (mysqli_num_rows($getProductInCart) > 0) {
    // Product already in cart
    $cartTotals = mysqli_fetch_assoc(mysqli_query($conn, "
        SELECT SUM(total_price) as totalBill, SUM(product_quantity) as totalItems 
        FROM cart WHERE customer_id = '$id' AND status = 1
    "));

    echo json_encode([
        'status' => false,
        'response' => 'Product already in cart',
        'cartTotal' => $cartTotals['totalBill'] ?? 0,
        'cartItems' => $cartTotals['totalItems'] ?? 0
    ]);
    exit();
}

// Insert into cart
$insert = mysqli_query($conn, "
    INSERT INTO cart SET 
        customer_id = '$id',
        product_id = '$product_id',
        offer_price = '$offer_price',
        product_title = '$product_name',
        product_img = '$product_img',
        product_quantity = '$quantity',
        available_stock = '$stockAvailability',
        product_category = '$category',
        product_price = '$product_mrp',
        total_price = '$totalPrice',
        status = 1
");

if ($insert) {
    // Remove from wishlist if present
    mysqli_query($conn, "
        DELETE FROM wishlist 
        WHERE customer_id = '$id' AND product_id = '$product_id' AND status = 1
    ");

    $cartTotals = mysqli_fetch_assoc(mysqli_query($conn, "
        SELECT SUM(total_price) as totalBill, SUM(product_quantity) as totalItems 
        FROM cart WHERE customer_id = '$id' AND status = 1
    "));

    echo json_encode([
        'status' => true,
        'response' => "Product added to cart successfully",
        'cartTotal' => $cartTotals['totalBill'] ?? 0,
        'cartItems' => $cartTotals['totalItems'] ?? 0
    ]);
} else {
    echo json_encode([
        'status' => false,
        'response' => "Failed to add product to cart"
    ]);
}




/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization');

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
    header("HTTP/1.1 200 OK");
    die();
}

include '../Authentication/authToken.php';
include "../../includes/db.php";

$headers = apache_request_headers();

if (!isset($headers['Authorization'])) {
    http_response_code(401);
    echo json_encode(['status' => false, 'message' => 'Unauthorized']);
    exit();
}

$token = str_replace('Bearer ', '', $headers['Authorization']);
if (empty($token)) {
    http_response_code(401);
    echo json_encode(['status' => false, 'message' => 'Unauthorized']);
    exit();
}

$response = verifyAuthToken($token);
if (!$response['status']) {
    http_response_code(401);
    echo json_encode(['status' => false, 'message' => 'Unauthorized']);
    exit();
}

$data = json_decode(file_get_contents("php://input"));
$id = $response['loginid'];
$product_id = $data->productId ?? null;

if (!$product_id) {
    echo json_encode(['status' => false, 'message' => 'Missing product ID']);
    exit();
}


$productQuery = mysqli_query($conn, "SELECT * FROM products WHERE product_id = '$product_id'");
if (!$productQuery || mysqli_num_rows($productQuery) === 0) {
    echo json_encode(['status' => false, 'message' => 'Product not found']);
    exit();
}
$product = mysqli_fetch_assoc($productQuery);


$quantity = 1;
$product_img = $product['product_image'] ?? '';
$stockAvailability = $product['available_stock'] ?? 0;
$product_name = $product['product_title'] ?? '';
$product_mrp = $product['product_mrp'] ?? 0;
$offer_price = $product['product_offerprice'] ?? 0;
$category = $product['category_name'] ?? 'General';
$totalPrice = $quantity * intval($offer_price);


$getProducts = mysqli_query($conn, "SELECT * FROM cart WHERE product_id = '$product_id' AND customer_id = '$id' AND status = 1");

if (mysqli_num_rows($getProducts) >= 1) {
    $cartTotalsQuery = mysqli_query($conn, "SELECT SUM(total_price) as totalBill, SUM(product_quantity) as totalItems FROM cart WHERE customer_id = '$id' AND status = 1");
    $cartTotals = mysqli_fetch_assoc($cartTotalsQuery);

    $totalBill = $cartTotals['totalBill'] ?? 0;
    $totalItems = $cartTotals['totalItems'] ?? 0;

    $result = [
        'status' => "warning",
        'response' => 'Product Already Added To Cart',
        'cartTotal' => $totalBill,
        'cartItems' => $totalItems
    ];
} else {
    $query = mysqli_query($conn, "
        INSERT INTO cart 
        SET 
            customer_id = '$id',
            product_id = '$product_id',
            offer_price = '$offer_price',
            product_title = '$product_name',
            product_image = '$product_img',
            product_quantity = '$quantity',
            available_stock = '$stockAvailability',
            product_category = '$category',
            product_price = '$product_mrp',
            total_price = '$totalPrice',
            status = 1
    ");

    if ($query) {
        $deleteWishlist = mysqli_query($conn, "DELETE FROM wishlist WHERE customer_id = '$id' AND product_id = '$product_id' AND status = 1");

        $cartTotalsQuery = mysqli_query($conn, "SELECT SUM(total_price) as totalBill, SUM(product_quantity) as totalItems FROM cart WHERE customer_id = '$id' AND status = 1");
        $cartTotals = mysqli_fetch_assoc($cartTotalsQuery);

        $totalBill = $cartTotals['totalBill'] ?? 0;
        $totalItems = $cartTotals['totalItems'] ?? 0;

        $result = [
            'status' => true,
            'response' => "Successfully Added To Cart and Removed From Wishlist",
            'cartTotal' => $totalBill,
            'cartItems' => $totalItems
        ];
    } else {
        $result = ['status' => false, 'response' => "Failed To Add"];
    }
}

echo json_encode($result);*/
