<?php
ini_set('display_errors', 1);
ini_set('display_startup_error', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin");

include "../../includes/db.php";

$category = $_GET['brandCategory'];

$query = mysqli_query($conn, "SELECT * FROM brands WHERE brand_category='" . $category . "' && status=1");
$count = mysqli_num_rows($query);
$brandsData = [];
if ($count >= 1) {
    while ($data = mysqli_fetch_array($query)) {
        $brandsData[] = $data;
    }
    $result = ['status' => true, 'response' => $brandsData];
} else {
    $result = ['status' => false, 'response' => "Data not found"];
}

echo json_encode($result);
