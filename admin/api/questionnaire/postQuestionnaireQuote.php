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

$data = json_decode(file_get_contents("php://input"));

$id = $response['loginid'];
$queId = $_GET['queId'];
$quote_data = json_encode($data);






$query = mysqli_query($conn, "INSERT INTO quotation SET customer_id = '" . $id . "', que_id='" . $queId . "', quote_data='" . $quote_data . "', status=1");

if ($query) {
    $update_Questionnaire = mysqli_query($conn, "UPDATE questionnaire tbl1, quotation tbl2  SET tbl1.project_status ='submitted' WHERE tbl1.que_id = '" . $queId . "' && tbl1.customer_id = '" . $id . "' && tbl1.status = 1 && tbl2.status=1");

    http_response_code(200);
    $result = ['status' => true, 'response' => "Inserted Successfully"];
} else {
    $result = ['status' => false, 'response' => "Failed To Insert"];
}


echo json_encode($result);
