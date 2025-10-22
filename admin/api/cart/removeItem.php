<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization');

$method = $_SERVER['REQUEST_METHOD'];
if ($method === "OPTIONS") {
    header("HTTP/1.1 200 OK");
    exit();
}

include '../Authentication/authToken.php';
include "../../includes/db.php";

// Get Authorization Token
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
if (!$response['status']) {
    http_response_code(401);
    echo json_encode(['status' => false, 'message' => 'Invalid Token']);
    exit();
}

// Get Customer ID and Product ID
$customerId = $response['loginid'];
$data = json_decode(file_get_contents("php://input"));
$productId = $data->productId ?? null;

if (!$productId) {
    http_response_code(400);
    echo json_encode(['status' => false, 'message' => 'Product ID is required']);
    exit();
}

// Delete item from cart
$query = mysqli_query($conn, "
    DELETE FROM cart 
    WHERE customer_id = '$customerId' AND product_id = '$productId'
");

if ($query && mysqli_affected_rows($conn) > 0) {
    http_response_code(200);
    echo json_encode(['status' => true, 'response' => 'Item successfully removed from cart']);
} else {
    http_response_code(404);
    echo json_encode(['status' => false, 'response' => 'Item not found or already removed']);
}
