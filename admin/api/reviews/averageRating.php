<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin");

include "../../includes/db.php";

$productId = isset($_GET['productId']) ? mysqli_real_escape_string($conn, $_GET['productId']) : '';

if (!$productId) {
    echo json_encode(['status' => false, 'message' => 'No productId provided']);
    exit;
}

// Get average rating
$avgQuery = mysqli_query($conn, "
    SELECT ROUND(AVG(rating), 1) AS avg_rating
    FROM customer_reviews
    WHERE product_title = '$productId'
");

$avgData = mysqli_fetch_assoc($avgQuery);
$avgRating = $avgData['avg_rating'] ?? 0.0;

// Get rating breakdown
$breakdownQuery = mysqli_query($conn, "
    SELECT 
        rating, 
        COUNT(*) AS total
    FROM customer_reviews
    WHERE product_title = '$productId'
    GROUP BY rating
    ORDER BY rating DESC
");

$totalReviews = 0;
$ratingsCount = [
    5 => 0,
    4 => 0,
    3 => 0,
    2 => 0,
    1 => 0
];

// Calculate total reviews and individual counts
while ($row = mysqli_fetch_assoc($breakdownQuery)) {
    $ratingsCount[(int)$row['rating']] = (int)$row['total'];
    $totalReviews += (int)$row['total'];
}

// Calculate percentages
$ratingsPercentage = [];
foreach ($ratingsCount as $stars => $count) {
    $ratingsPercentage[$stars] = $totalReviews > 0
        ? round(($count / $totalReviews) * 100, 2)
        : 0;
}

$result = [
    'status' => true,
    'data' => [
        'average_rating' => (float)$avgRating,
        'total_reviews' => $totalReviews,
        'ratings_breakdown' => $ratingsPercentage
    ]
];

echo json_encode($result);
