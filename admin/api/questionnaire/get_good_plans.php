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

$getPlans = mysqli_query($conn, "SELECT 
    d.* ,
    c1.classification AS material_class,
    c2.classification AS makers_class
FROM 
    good_plans d
LEFT JOIN 
    classification c1 ON d.material_classification = c1.classification_id 
LEFT JOIN 
    classification c2 ON d.maker_classification = c2.classification_id 
    WHERE 
    d.status = 1;");
$classification = [];
while ($result = mysqli_fetch_assoc($getPlans)) {
    $classification[] = $result;
}
if ($getPlans) {
    echo json_encode(['status' => true, 'response' => $classification]);
} else {
    echo json_encode(['status' => false, 'response' => "Data not found"]);
}
