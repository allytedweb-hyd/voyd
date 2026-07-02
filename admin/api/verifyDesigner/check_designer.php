<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin, authorization");
header("Access-Control-Allow-Methods: POST, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

include "../../includes/db.php";

$json = file_get_contents('php://input');
$data = json_decode($json);

$shopName       = $data->shopName;
$designerName   = $data->designerName;
$designerMobile = $data->designerMobile;

// Check if designer mobile exists in defaulters table
$query = mysqli_query($conn, "SELECT * FROM designer_defaulters 
                              WHERE mobile = '$designerMobile' 
                              AND status = 1");

$fetch = mysqli_fetch_array($query);

if ($fetch) {
    // Designer found in defaulters list
    echo json_encode([
        'status'      => true,
        'isDefaulter' => true,
        'message'     => 'This designer is flagged as a defaulter.'
    ]);
} else {
    // Designer not in defaulters list - safe
    echo json_encode([
        'status'      => true,
        'isDefaulter' => false,
        'message'     => 'Designer is not a defaulter.'
    ]);
}
