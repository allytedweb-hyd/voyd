<?php
ini_set('display_errors', 1);
ini_set('display_startup_error', 1);
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
    echo json_encode(['status' => false, 'message' => 'unauthorized']);
    exit();
}

@$token = str_replace('Bearer ', '', $headers['Authorization']);
if (empty($token)) {
    http_response_code(401);
    echo json_encode(['status' => false, 'message' => 'Unauthorized Access']);
    exit();
}

$response = verifyAuthToken($token);
if (!$response['status']) {
    http_response_code(401);
    echo json_encode(['status' => false, 'message' => 'Unauthorized Access']);
    exit();
}

$id = $response['loginid'];
$query = mysqli_query($conn, "SELECT * FROM cart WHERE customer_id = '" . $id . "' && status=1");
$count = mysqli_num_rows($query);
$totalsum = mysqli_query($conn, "SELECT SUM(total_price) AS totalVal FROM cart WHERE customer_id = '" . $id . "' && status=1");
$total = mysqli_fetch_array($totalsum);




$cartItems = [];
if ($count >= 1) {
    while ($data = mysqli_fetch_array($query)) {
        $cartItems[] = $data;
    }
    $result = ['status' => true, 'response' => $cartItems, 'cartItemsCount' => $count, "cartTotalValue" => $total];
} else {
    $result = ['status' => false, 'response' => "No Data Found", 'cartItemsCount' => $count];
}
echo json_encode($result);
