<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin");

// include "../../includes/db.php";

// $productId = isset($_GET['productId']) ? mysqli_real_escape_string($conn, $_GET['productId']) : '';

// if (!$productId) {
//     echo json_encode(['status' => false, 'message' => 'No productId provided']);
//     exit;
// }

// $sql = "
//     SELECT 
//         cr.*, 
       
//         c.first_name AS customer_first_name,
//         c.last_name AS customer_last_name,
//         c.customer_email AS customer_email
//     FROM customer_reviews cr
//     LEFT JOIN customer c 
//         ON cr.customer_name = c.customer_id
//     WHERE cr.product_title = '$productId'
//       AND cr.status = 1
//     ORDER BY cr.cus_review_id DESC
// ";

// $reviews = mysqli_query($conn, $sql);

// $result = [];
// while ($data = mysqli_fetch_assoc($reviews)) {
//     $result[] = $data;
// }

// if (empty($result)) {
//     echo json_encode(['status' => false, 'response' => 'No reviews found']);
//     exit;
// } else {
//     echo json_encode(['status' => true, 'response' => $result]);
//     exit;
// }




ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin");

include "../../includes/db.php";

$productId = isset($_GET['productId']) ? mysqli_real_escape_string($conn, $_GET['productId']) : '';
$userId = isset($_GET['userId']) ? mysqli_real_escape_string($conn, $_GET['userId']) : '';

if (!$productId) {
    echo json_encode(['status' => false, 'message' => 'No productId provided']);
    exit;
}

$reviews = [];
$reviewQuery = mysqli_query($conn, "
    SELECT cr.*, c.first_name AS customer_first_name, c.last_name AS customer_last_name
    FROM customer_reviews cr
    LEFT JOIN customer c ON cr.customer_name = c.customer_id
    WHERE cr.product_title='$productId' AND cr.status=1
    ORDER BY cr.cus_review_id DESC
");

if (!$reviewQuery) {
    echo json_encode(['status' => false, 'message' => 'Database query error: ' . mysqli_error($conn)]);
    exit;
}

while ($row = mysqli_fetch_assoc($reviewQuery)) {
    $reviewId = $row['cus_review_id'];

    // Get total likes count for this review
    $likeRes = mysqli_query($conn, "SELECT COUNT(*) AS total_likes FROM review_likes WHERE review_id='$reviewId'");
    $likeCount = 0;
    if ($likeRes) {
        $likeCount = (int)mysqli_fetch_assoc($likeRes)['total_likes'];
    }

    // Check if the current user liked this review
    $likedByUser = 0;
    if ($userId) {
        $userLikeRes = mysqli_query($conn, "SELECT COUNT(*) AS liked FROM review_likes WHERE review_id='$reviewId' AND user_id='$userId'");
        if ($userLikeRes) {
            $likedByUser = (int)mysqli_fetch_assoc($userLikeRes)['liked'];
        }
    }

    // Get replies with user names for this review
    $replyRes = mysqli_query($conn, "
        SELECT r.reply_id, r.content, r.created_at, 
               CONCAT(c.first_name, ' ', c.last_name) AS user_name
        FROM review_replies r
        LEFT JOIN customer c ON r.user_id = c.customer_id
        WHERE r.review_id='$reviewId'
        ORDER BY r.created_at ASC
    ");

    $replies = [];
    if ($replyRes) {
        while ($reply = mysqli_fetch_assoc($replyRes)) {
            $replies[] = $reply;
        }
    }

    $row['likes'] = $likeCount;
    $row['likedByUser'] = $likedByUser;  
    $row['replies'] = $replies;

    $reviews[] = $row;
}

echo json_encode([
    'status' => true,
    'response' => $reviews
]);



