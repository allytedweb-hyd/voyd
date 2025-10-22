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
    echo json_encode(['status' => false, 'message' => 'Please login to review this product']);
    exit();
}



$json = file_get_contents('php://input');
$regData = json_decode($json);

$customerId = $response['loginid'];
$rating = $regData->customerRating;
$productId = $regData->productId;
$reviewTitle = $regData->customerReviewTitle;
$reviewContent = $regData->customerReviewContent;


$checkReview = mysqli_query($conn, "SELECT * FROM customer_reviews WHERE customer_name='" . $customerId . "' AND product_title='" . $productId . "' AND status=1");
if (mysqli_num_rows($checkReview) > 0) {
    $response = ['status' => false, 'message' => "You have already submitted a review for this product"];
    echo json_encode($response);
    exit();
}

date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d H:i:s');


$insertQuery = mysqli_query($conn, "INSERT INTO customer_reviews SET customer_name='" . $customerId . "',product_title='" . $productId . "', review_title='" . $reviewTitle . "', rating='" . $rating . "',review_content='" . $reviewContent . "',created_at='" . $date . "',updated_at='" . $date . "',status=1");
if ($insertQuery) {
    $response = ['status' => true, 'message' => "Review submitted successfully"];
} else {
    $response = ['status' => false, 'message' => 'Unable to submit Review'];
}
echo json_encode($response);
