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
    echo json_encode(['status' => false, 'message' => 'Login to like the review']);
    exit();
}

$userId = intval($response['loginid']);
$data = json_decode(file_get_contents("php://input"));

if (!isset($data->review_id)) {
    echo json_encode(['status' => false, 'message' => 'Review ID is required']);
    exit();
}

$reviewId = intval($data->review_id);
$liked = false;


$check = mysqli_query($conn, "SELECT like_id FROM review_likes WHERE review_id='$reviewId' AND user_id='$userId'");
if (mysqli_num_rows($check) > 0) {

    mysqli_query($conn, "DELETE FROM review_likes WHERE review_id='$reviewId' AND user_id='$userId'");
    $message = "Review Unliked";
    $liked = false;
} else {

    $insert = mysqli_query($conn, "INSERT INTO review_likes (review_id, user_id) VALUES ('$reviewId', '$userId')");
    if ($insert) {
        $message = "Review liked";
        $liked = true;
    } else {
        echo json_encode(['status' => false, 'message' => 'Failed to like review']);
        exit();
    }
}


$countLikesQuery = mysqli_query($conn, "SELECT COUNT(*) as totalLikes FROM review_likes WHERE review_id='$reviewId'");
$totalLikes = 0;
if ($countLikesQuery) {
    $row = mysqli_fetch_assoc($countLikesQuery);
    $totalLikes = intval($row['totalLikes']);
}

echo json_encode([
    'status' => true,
    'message' => $message,
    'liked' => $liked,
    'totalLikes' => $totalLikes
]);
