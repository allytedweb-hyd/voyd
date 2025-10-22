<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === "OPTIONS") {
    header("HTTP/1.1 200 OK");
    exit();
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
    echo json_encode(['status' => false, 'message' => 'Unauthorized Access']);
    exit();
}

$response = verifyAuthToken($token);
// if (!$response['status']) {
//     http_response_code(401);
//     echo json_encode(['status' => false, 'message' => 'Invalid Token']);
//     exit();
// }
if (!$response['status']) {
    http_response_code(401);
    echo json_encode(['status' => false, 'message' => 'Please login to add items to wishlist']);
    exit();
}


$data = json_decode(file_get_contents("php://input"));

$id = $response['loginid'];
$product_id = $data->productId ?? null;
$product_img = $data->productImg ?? '';
$product_img_alt = $data->alttext_1 ?? '';
$product_name = $data->productName ?? '';
$product_mrp = $data->productMrp ?? 0;
$offer_price = $data->offerPrice ?? 0;
$productQty = $data->quantity ?? 0;
$category = $data->category ?? '';

$checkWishlist = mysqli_query($conn, "
    SELECT * FROM wishlist 
    WHERE customer_id = '$id' AND product_id = '$product_id' AND status = 1
");

if (mysqli_num_rows($checkWishlist) > 0) {
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

$checkCart = mysqli_query($conn, "
    SELECT * FROM cart 
    WHERE customer_id = '$id' AND product_id = '$product_id' AND status = 1
");
if (mysqli_num_rows($checkCart) > 0) {
    $deleteCart = mysqli_query($conn, "
        DELETE FROM cart 
        WHERE customer_id = '$id' AND product_id = '$product_id'
    ");
}

$query = mysqli_query($conn, "
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

if ($query) {
    http_response_code(200);
    echo json_encode(['status' => true, 'response' => 'Product added to wishlist']);
} else {
    http_response_code(500);
    echo json_encode(['status' => false, 'response' => 'Failed to add to wishlist']);
}
