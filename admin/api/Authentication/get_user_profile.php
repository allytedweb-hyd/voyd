<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

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



include "../../includes/db.php";
include './authToken.php';



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

$customerId = $response['loginid'];
$getUser = mysqli_query($conn, "SELECT * FROM customer WHERE customer_id='" . $customerId . "' AND status=1");
// $fetchUser = mysqli_fetch_array($getUser);
$fetchUser = mysqli_fetch_assoc($getUser);
if ($getUser) {
    http_response_code(200);
    $response = ['status' => true, 'response' => $fetchUser];
} else {
    http_response_code(404);
    $response = ['status' => false, 'response' => 'No Data Found'];
}

echo json_encode($response);
