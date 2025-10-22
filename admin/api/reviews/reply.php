<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization');

include '../Authentication/authToken.php';
include "../../includes/db.php";


if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("HTTP/1.1 200 OK");
    exit();
}


$headers = apache_request_headers();
if (!isset($headers['Authorization'])) {
    http_response_code(401);
    echo json_encode(['status' => false, 'message' => 'Unauthorized']);
    exit();
}

$token = str_replace('Bearer ', '', $headers['Authorization']);
$response = verifyAuthToken($token);
if (!$response['status']) {
    http_response_code(401);
    echo json_encode(['status' => false, 'message' => 'Invalid token']);
    exit();
}

$userId = intval($response['loginid']);
$data = json_decode(file_get_contents("php://input"));


if (!isset($data->reviewId) || !isset($data->replyContent)) {
    echo json_encode(['status' => false, 'message' => 'Missing required fields']);
    exit();
}

$reviewId = intval($data->reviewId);
$replyContent = mysqli_real_escape_string($conn, $data->replyContent);

date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d H:i:s');

$checkQuery = "SELECT reply_id FROM review_replies WHERE review_id = '$reviewId' AND user_id = '$userId' LIMIT 1";

$checkResult = mysqli_query($conn, $checkQuery);

if (mysqli_num_rows($checkResult) > 0) {
    echo json_encode([
        'status' => false,
        'message' => 'You have already replied to this review'
    ]);
    exit();
}



$query = "INSERT INTO review_replies (review_id, user_id, content, created_at) VALUES ('$reviewId', '$userId', '$replyContent','$date')";
if (mysqli_query($conn, $query)) {
    $replyId = mysqli_insert_id($conn); 
    echo json_encode([
        'status' => true,
        'message' => 'Reply submitted',
        'reply_id' => $replyId
    ]);
} else {
    echo json_encode(['status' => false, 'message' => 'Failed to submit reply']);
}
