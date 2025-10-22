<?php

use function PHPSTORM_META\type;

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

$data = json_decode(file_get_contents("php://input"));

$id = $response['loginid'];
$queId = $_GET['queId'];

$query = mysqli_query($conn, "SELECT * FROM questionnaire tbl1, quotation tbl2 WHERE tbl1.que_id=tbl2.que_id AND tbl1.customer_id='" . $id . "' AND tbl1.status=1 AND tbl2.status=1 AND tbl1.que_id = '" . $queId . "'");
$data = mysqli_fetch_assoc($query);

$quote_data = $data['quote_data'];
$quote_data_cleaned = preg_replace('/\s+/', ' ', $quote_data);


$quote_data_array = json_decode($quote_data_cleaned, true);
if (json_last_error() === JSON_ERROR_NONE) {
    $data['quote_data'] = $quote_data_array;
} else {

    $data['quote_data'] = null;
}

// $data2 = json_decode(json_encode($quote_data));

// $data2 = json_encode($quote_data);

// echo $quote_data;
// exit;

if ($data) {
    $status = ["status" => true, "response" => $data];
} else {
    $status = ["status" => false, "response" => "no data found"];
}


echo json_encode($status);
