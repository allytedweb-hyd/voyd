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
@$proType = $_GET['proType'];


// $query = mysqli_query($conn, "SELECT * FROM products WHERE status=1 AND productPriority='" . $proType . "' LIMIT $limit OFFSET $offset");

// $products = [];
// while ($data = mysqli_fetch_array($query)) {
//     $products[] = $data;
// }

$query = mysqli_query($conn, "
    SELECT 
        p.*, 
        c.category_name 
    FROM 
        products p
    LEFT JOIN 
        category c ON p.product_category = c.category_id
    WHERE 
        p.status = 1 AND p.productPriority = '$proType'
    LIMIT $limit OFFSET $offset
");

$products = [];

while ($data = mysqli_fetch_assoc($query)) {
   
    $data['product_category'] = $data['category_name'];
    unset($data['category_name']); 
    $products[] = $data;
}


$result = ['status' => true, 'response' => $products];


echo json_encode($result);
