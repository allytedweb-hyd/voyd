<?php
include "../../includes/db.php";
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

$customerId = $_GET['customer_id'] ?? null;

if (!$customerId) {
    echo json_encode(['status' => false, 'message' => 'Missing customer_id']);
    exit;
}

// Get the list of product IDs
$sql = "SELECT product_ids FROM recent_views WHERE customer_id = '$customerId'";
$res = mysqli_query($conn, $sql);

if ($row = mysqli_fetch_assoc($res)) {
    $idsString = $row['product_ids'];

    if (!$idsString) {
        echo json_encode(['status' => true, 'products' => []]);
        exit;
    }

    $idsArray = explode(',', $idsString);
    $ids = array_map('intval', $idsArray);
    $idsList = implode(',', $ids);

    // Now fetch product details
    $sqlProducts = "SELECT * FROM products WHERE id IN ($idsList) AND status = 1";
    $resultProducts = mysqli_query($conn, $sqlProducts);

    $products = [];
    while ($product = mysqli_fetch_assoc($resultProducts)) {
        $products[] = $product;
    }

    echo json_encode([
        'status' => true,
        'products' => $products
    ]);
} else {
    echo json_encode(['status' => true, 'products' => []]);
}
