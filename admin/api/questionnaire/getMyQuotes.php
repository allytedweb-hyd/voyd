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

$quotationType = $_GET['quoteCat'];
if ($quotationType == 0) {
    $query = mysqli_query($conn, "SELECT * FROM questionnaire tbl1, quotation tbl2 WHERE tbl1.que_id=tbl2.que_id AND tbl1.customer_id='" . $id . "' AND tbl1.project_status='submitted' AND tbl1.freeze='' AND tbl1.status=1 AND tbl2.status=1  ORDER BY tbl1.que_id DESC");
} else {
    $query = mysqli_query($conn, " SELECT * FROM questionnaire WHERE project_status='pending' AND status=1 AND customer_id='" . $id . "' ORDER BY que_id DESC");
}


$quoteData = [];
while ($data = mysqli_fetch_array($query)) {
    $quoteData[] = $data;
}
$result = ['status' => true, 'response' => $quoteData];


echo json_encode($result);
