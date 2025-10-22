<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin");

include "../../includes/db.php";


$query = mysqli_query($conn, "SELECT * FROM subcategory WHERE status = 1");


$count = mysqli_num_rows($query);


$shopSubCategories = [];


if ($count >= 1) {
    while ($row = mysqli_fetch_assoc($query)) {
        $shopSubCategories[] = $row;
    }
    $result = ["status" => true, "response" => $shopSubCategories];
} else {
    $result = ["status" => false, "response" => []];
}


echo json_encode($result);
