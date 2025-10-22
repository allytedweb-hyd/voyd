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


$jsonData = json_decode(file_get_contents('php://input'));



if (!empty($jsonData)) {
    $queId = $jsonData->queId;
    $makers_classification = $jsonData->makers_classification;
    $material_classification = $jsonData->material_classification;



    $updateClassification = mysqli_query($conn, "UPDATE questionnaire SET manufacturer_classification='" . $makers_classification . "', product_classification='" . $material_classification . "' WHERE que_id='" . $queId . "' && customer_id='" . $id . "' && status=1");
    if ($updateClassification) {
        http_response_code(200);
        $response = ['status' => true, 'response' => "Updated Successfully"];
    } else {
        $response = ['status' => false, 'response' => "Failed To Update"];
    }

    echo json_encode($response);
}
