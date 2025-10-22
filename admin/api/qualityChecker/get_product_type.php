<?php
ini_set('display_errors', 1);
ini_set('display_startup_error', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization');

include "../../includes/db.php";

$product = $_GET['product'];

$getProducts = mysqli_query($conn, 'SELECT * FROM product_type_master WHERE product="' . $product . '" && status=1');
$all_products = [];

while ($data = mysqli_fetch_assoc($getProducts)) {
    $all_products[] = $data;
}
if ($getProducts) {
    $result = ['status' => true, 'response' => $all_products];
} else {
    $result = ['status' => false, 'response' => "No Data Found"];
}
echo json_encode($result);
