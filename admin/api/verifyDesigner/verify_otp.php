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

$mobile = $data->mobile;
$otp    = $data->otp;

// Check OTP in DB - must match and not be expired
$now   = date('Y-m-d H:i:s');
$query = mysqli_query($conn, "SELECT * FROM verify_designer_otp 
                              WHERE mobile = '$mobile' 
                              AND otp = '$otp' 
                              AND expires_at >= '$now'");

$fetch = mysqli_fetch_array($query);

if ($fetch) {
    // OTP matched - delete it so it can't be reused
    mysqli_query($conn, "DELETE FROM verify_designer_otp WHERE mobile = '$mobile'");
    echo json_encode(['status' => true, 'message' => 'OTP verified successfully']);
} else {
    echo json_encode(['status' => false, 'message' => 'Incorrect or expired OTP. Please try again.']);
}
