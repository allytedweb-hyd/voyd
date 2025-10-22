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
include "../../includes/db.php";

$data = json_decode(file_get_contents("php://input"), true);

$customerId = $data['customer_id'] ?? null;
$products = $data['products'] ?? [];

if (!$customerId || empty($products)) {
    echo json_encode(['status' => false, 'message' => 'Missing data']);
    exit;
}

$productList = implode(',', array_map('intval', $products));

$sql = "INSERT INTO recent_views (customer_id, product_ids, updated_at)
        VALUES ('$customerId', '$productList', NOW())
        ON DUPLICATE KEY UPDATE 
            product_ids = '$productList',
            updated_at = NOW()";

mysqli_query($conn, $sql);

echo json_encode(['status' => true, 'message' => 'Saved']);
