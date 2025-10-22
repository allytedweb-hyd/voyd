<?php

ini_set('display_errors', 1);
ini_set('display_startup_error', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin");

include "../../includes/db.php";

// Query to get Banner image details
$query = mysqli_query($conn, "SELECT * FROM shopBanners WHERE status=1 ");

// to calculate num of rows in database
$count = mysqli_num_rows($query);

// empty array to store the response
$shopBanners = [];

// based on count push each row into empty array
if ($count >= 1) {
    while ($bannerData = mysqli_fetch_array($query)) {
        $shopBanners[] = $bannerData;
    }
    $result = ["status" => true, "response" => $shopBanners];
} else {
    $result = ["status" => false, "response" => "No Data Found"];
}

// sending response in JSON format
echo json_encode($result);
