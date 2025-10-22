<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Allow CORS, adjust as needed

include_once '../config/database.php';

$productColorId = isset($_GET['productColorId']) ? intval($_GET['productColorId']) : 0;

if ($productColorId <= 0) {
    echo json_encode([
        "status" => false,
        "message" => "Invalid product color ID"
    ]);
    exit;
}

$database = new Database();
$db = $database->getConnection();

$query = "SELECT image1, image2, image3, image4, image5 FROM product_colors WHERE product_color_id = ? LIMIT 1";

$stmt = $db->prepare($query);
$stmt->bind_param("i", $productColorId);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Filter out empty image paths
    $images = array_filter([
        $row['image1'],
        $row['image2'],
        $row['image3'],
        $row['image4'],
        $row['image5'],
    ], fn($img) => !empty($img));

    echo json_encode([
        "status" => true,
        "response" => $images
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "No images found for this color"
    ]);
}

$stmt->close();
$db->close();
?>
