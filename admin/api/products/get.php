<?php
ini_set('display_errors', 1);
ini_set('display_startup_error', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin");

include "../../includes/db.php";

// @$limit = $_GET['limit'];
// @$offset = $_GET['offset'];

// @$productSubCategory = $_GET['subCategory'];
// if (!empty($productSubCategory)) {
//     $query = mysqli_query($conn, "SELECT * FROM products WHERE sub_category = '" . $productSubCategory . "' && status=1");
// } else {

//     $query = mysqli_query($conn, "SELECT * FROM products WHERE status=1 LIMIT $limit OFFSET $offset");
// }

// $count = mysqli_num_rows($query);
// $products = [];
// if ($count >= 1) {
//     while ($data = mysqli_fetch_array($query)) {
//         $products[] = $data;
//     }
//     $result = ['status' => true, 'response' => $products];
// } else {
//     $result = ['status' => false, 'response' => "Data not found"];
// }

// echo json_encode($result);


//////////////// new Filters //////////////////

$limit = 16;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;
@$categories = $_GET['category'];
@$productTag = $_GET['productTag'];
@$subcategories = $_GET['subCategory'];
@$minPrice = $_GET['minPrice'];
@$maxPrice = $_GET['maxPrice'];
@$brands = $_GET['brand'];
@$material = $_GET['material'];
@$priority = $_GET['productPriority'];
@$color = $_GET['color'];
@$where_clauses = array();
@$order_by_clause = "";

if (!empty($categories)) {
    $category_clause = "product_category IN ($categories)";
    $where_clauses[] = $category_clause;
}
if (!empty($productTag)) {
    if ($productTag == 'New Arrival') {
        $escapedProductTag = mysqli_real_escape_string($conn, $productTag);
        $product_tag_clause = "productTag = '$escapedProductTag'";
        $where_clauses[] = $product_tag_clause;
    } else if ($productTag == 'Recommended') {
        $escapedProductTag = mysqli_real_escape_string($conn, $productTag);
        $product_tag_clause = "average_rating > 3 ";
        $where_clauses[] = $product_tag_clause;
    } else if ($productTag == 'mostSearched') {
        $order_by_clause = "ORDER BY search_count DESC";
    }
    else if ($productTag == 'Popular') {
     
        $where_clauses[] = "productPriority = 'Popular'";
     
    }

}
if (!empty($subcategories)) {
    $sub_category_clause = "sub_category IN ($subcategories)";
    $where_clauses[] = $sub_category_clause;
}
if (!empty($minPrice) && !empty($maxPrice)) {
    $min_max_clause = "product_offerprice BETWEEN ($minPrice) AND ($maxPrice)";
    $where_clauses[] = $min_max_clause;
}
if (!empty($brands)) {
    $brands_clause = "product_brand IN ($brands)";
    $where_clauses[] = $brands_clause;
}
if (!empty($material)) {
    $material_clause = "product_material IN ($material)";
    $where_clauses[] = $material_clause;
}
if (!empty($color)) {
    $color_clause = "product_color IN ($color)";
    $where_clauses[] = $color_clause;
}
if (!empty($priority)) {
    $escapedPriority = mysqli_real_escape_string($conn, $priority);
    $priority_clause = "productPriority = '$escapedPriority'";
    $where_clauses[] = $priority_clause;
}

$where_clause = "";
if (!empty($where_clauses)) {
    $where_clause = "WHERE status = 1 AND " . implode(" AND ", $where_clauses);
} else {
    $where_clause = "WHERE status = 1";
}
/* $total_records = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM products $where_clause"));
$query = "SELECT * FROM products $where_clause LIMIT $start, $limit"; */
$total_records = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM products $where_clause"));

$query = "SELECT * FROM products $where_clause $order_by_clause ";


$result = mysqli_query($conn, $query);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
$res = ['response' => $data, 'total' => $total_records];
// Return filtered data to the front-end
echo json_encode($res);
