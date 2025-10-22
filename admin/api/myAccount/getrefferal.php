<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

ini_set('display_errors', 1);
error_reporting(E_ALL);

include '../../includes/db.php';
include '../Authentication/authToken.php';


$headers = apache_request_headers();
$authHeader = $headers['Authorization'] ?? '';

if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
    http_response_code(401);
    echo json_encode(["status" => false, "message" => "Unauthorized: Missing or invalid token"]);
    exit;
}

$token = str_replace('Bearer ', '', $authHeader);
$response = verifyAuthToken($token);

if (!$response['status'] || empty($response['loginid'])) {
    http_response_code(401);
    echo json_encode(["status" => false, "message" => "Unauthorized: Invalid token"]);
    exit;
}

$customerId = $response['loginid'];


$stmt1 = $conn->prepare("SELECT refferal_code FROM customer WHERE customer_id = ? LIMIT 1");
$stmt1->bind_param("i", $customerId);
$stmt1->execute();
$result1 = $stmt1->get_result();

if ($result1->num_rows === 0) {
    http_response_code(404);
    echo json_encode(["status" => false, "message" => "User not found"]);
    exit;
}

$user = $result1->fetch_assoc();
$refferalCode = $user['refferal_code'];
$stmt1->close();


$query = "
    SELECT 
        c.customer_id,
        c.first_name,
        c.last_name,
        c.customer_email,
        c.customer_mobile,
        q.freeze AS status,
        q.que_id,
        q.project_type,
        q.property,
        q.property_type,
        q.project_status,
        q.created_At AS questionnaire_created,
        qt.quotation_id,
        qt.quote_data,
        qt.project_status AS quotation_project_status,
        qt.created_date AS quotation_created
    FROM customer c
    LEFT JOIN questionnaire q ON c.customer_id = q.customer_id
    LEFT JOIN quotation qt ON q.que_id = qt.que_id
    WHERE c.refered_by = ? AND c.refferal_code != ? AND q.freeze = 'freezed'
";

$stmt2 = $conn->prepare($query);
$stmt2->bind_param("ss", $refferalCode, $refferalCode);
$stmt2->execute();
$result2 = $stmt2->get_result();

$referralData = [];

while ($row = $result2->fetch_assoc()) {
    $referralData[] = $row;
    
}

$stmt2->close();
$conn->close();


if (count($referralData) > 0) {
    http_response_code(200);
    echo json_encode([
        "status" => true,
        "refferal_code" => $refferalCode,
        "data" => $referralData
    ]);
} else {
    http_response_code(404);
    echo json_encode([
        "status" => false,
        "message" => "No referred customer data found"
    ]);
}
