<?php

ini_set('display_errors', 1);
ini_set('display_startup_error', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin");

include "../../includes/db.php";

$shopCategory = $_GET['category'];

$getCategory = mysqli_query($conn, "SELECT * FROM category WHERE category_id ='" . $shopCategory . "' && status=1");

// Query to get Banner image details
$query = mysqli_query($conn, "SELECT * FROM subcategory WHERE category='" . $shopCategory . "' && status=1 ");

// to calculate num of rows in database
$count = mysqli_num_rows($query);

// empty array to store the response
$shopSubCategories = [];
$response = mysqli_fetch_assoc($getCategory);
$result = ["status" => true, "response" => $shopSubCategories, "category" => $response];
// based on count push each row into empty array
if ($count >= 1) {
    while ($subCategoriesData = mysqli_fetch_assoc($query)) {
        $shopSubCategories[] = $subCategoriesData;
    }
    $result = ["status" => true, "response" => $shopSubCategories, "category" => $response];
} else {
    $result = ["status" => false, "response" => $shopSubCategories, "category" => $response];
}

// sending response in JSON format
echo json_encode($result);
