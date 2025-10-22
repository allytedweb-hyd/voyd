<?php
include "../../includes/db.php";
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

$productId = isset($_GET['productId']) ? mysqli_real_escape_string($conn, $_GET['productId']) : '';

if (!$productId) {
    echo json_encode(['status' => false, 'message' => 'Missing productId']);
    exit;
}

$sql = "SELECT * FROM product_colors WHERE product_name = '$productId' AND status = 1";
$query = mysqli_query($conn, $sql);

$colorVariants = [];

while ($row = mysqli_fetch_assoc($query)) {
    $colorVariants[] = [
        'product_color_id' => $row['product_color_id'],
        'product_color' => $row['product_color'],
        'images' => array_filter([
            $row['image1'],
            $row['image2'],
            $row['image3'],
            $row['image4'],
            $row['image5']
        ])
    ];
}

if (!empty($colorVariants)) {
    echo json_encode(['status' => true, 'colors' => $colorVariants]);
} else {
    echo json_encode(['status' => false, 'message' => 'No color variants found']);
}
