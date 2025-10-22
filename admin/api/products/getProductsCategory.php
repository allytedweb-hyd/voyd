<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin");

include "../../includes/db.php";

@$limit = $_GET['limit'];
@$offset = $_GET['offset'];

$productCat = $_GET['productCat'];


$query =  mysqli_query($conn, "SELECT * FROM products WHERE productTag='" . $productCat . "' && status=1 ORDER BY product_id DESC Limit $limit");
$count = mysqli_num_rows($query);
$products = [];
if ($count >= 1) {
    while ($data = mysqli_fetch_assoc($query)) {
        $products[] = $data;
    }
    $result = ['status' => true, 'response' => $products];
} else {
    $result = ['status' => false, 'response' => $products];
}

echo json_encode($result);
