<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// CORS Headers
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === "OPTIONS") {
    http_response_code(200);
    exit();
}

include '../Authentication/authToken.php';
include "../../includes/db.php";

// Get headers
$headers = apache_request_headers();
if (!isset($headers['Authorization'])) {
    http_response_code(401);
    echo json_encode(['status' => false, 'message' => 'Unauthorized']);
    exit();
}

$token = str_replace('Bearer ', '', $headers['Authorization']);
if (empty($token)) {
    http_response_code(401);
    echo json_encode(['status' => false, 'message' => 'Unauthorized Access']);
    exit();
}

// Verify JWT token
$response = verifyAuthToken($token);
if (!$response['status']) {
    http_response_code(401);
    echo json_encode(['status' => false, 'message' => 'Please login to add items to wishlist']);
    exit();
}

// Get POST body data
$data = json_decode(file_get_contents("php://input"));
if (!$data || !isset($data->productId)) {
    http_response_code(400);
    echo json_encode(['status' => false, 'message' => 'Invalid input']);
    exit();
}

// Extract and sanitize data
$id = mysqli_real_escape_string($conn, $response['loginid']);
$product_id = mysqli_real_escape_string($conn, $data->productId);
$product_img = mysqli_real_escape_string($conn, $data->productImg ?? '');
$product_img_alt = mysqli_real_escape_string($conn, $data->productImgAlt ?? '');
$product_name = mysqli_real_escape_string($conn, $data->productName ?? '');
$product_mrp = mysqli_real_escape_string($conn, $data->productMrp ?? 0);
$offer_price = mysqli_real_escape_string($conn, $data->offerPrice ?? 0);
$productQty = mysqli_real_escape_string($conn, $data->quantity ?? 1);
$category = mysqli_real_escape_string($conn, $data->category ?? '');

// Check if item already exists in wishlist
$checkWishlist = mysqli_query($conn, "
    SELECT * FROM wishlist 
    WHERE customer_id = '$id' AND product_id = '$product_id' AND status = 1
");

if (mysqli_num_rows($checkWishlist) > 0) {
    // Remove from wishlist
    $removeQuery = mysqli_query($conn, "
        DELETE FROM wishlist 
        WHERE customer_id = '$id' AND product_id = '$product_id'
    ");

    if ($removeQuery) {
        http_response_code(200);
        echo json_encode(['status' => true, 'response' => 'Product removed from wishlist']);
    } else {
        http_response_code(500);
        echo json_encode(['status' => false, 'response' => 'Failed to remove from wishlist']);
    }
    exit();
}

// Optionally remove from cart
$checkCart = mysqli_query($conn, "
    SELECT * FROM cart 
    WHERE customer_id = '$id' AND product_id = '$product_id' AND status = 1
");
if (mysqli_num_rows($checkCart) > 0) {
    mysqli_query($conn, "
        DELETE FROM cart 
        WHERE customer_id = '$id' AND product_id = '$product_id'
    ");
}

// Insert into wishlist
$insertQuery = mysqli_query($conn, "
    INSERT INTO wishlist SET 
        customer_id = '$id',
        product_id = '$product_id',
        product_img = '$product_img',
        img_alt_text = '$product_img_alt',
        product_title = '$product_name',
        product_category = '$category',
        product_price = '$product_mrp',
        product_offer_price = '$offer_price',
        product_quantity = '$productQty',
        status = 1
");

if ($insertQuery) {
    http_response_code(200);
    echo json_encode(['status' => true, 'response' => 'Product added to wishlist']);
} else {
    http_response_code(500);
    echo json_encode(['status' => false, 'response' => 'Failed to add to wishlist']);
}
?>
