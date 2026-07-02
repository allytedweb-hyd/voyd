<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin, authorization");
header("Access-Control-Allow-Methods: POST, OPTIONS");

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

include "../../includes/db.php";

// Read incoming data from React
$json = file_get_contents('php://input');
$data = json_decode($json);

$name   = $data->name;
$mobile = $data->mobile;

// Generate a random 4-digit OTP
$otp = rand(1000, 9999);

// Store OTP in database against this mobile number
// First delete any old OTP for this mobile
mysqli_query($conn, "DELETE FROM verify_designer_otp WHERE mobile = '$mobile'");

// Insert new OTP (expires in 10 minutes)
$expiry = date('Y-m-d H:i:s', strtotime('+10 minutes'));
$insert = mysqli_query($conn, "INSERT INTO verify_designer_otp (name, mobile, otp, expires_at) 
                               VALUES ('$name', '$mobile', '$otp', '$expiry')");

if (!$insert) {
    echo json_encode(['status' => false, 'message' => 'Failed to save OTP. Please try again.']);
    exit();
}

// Send OTP via Fast2SMS API
$apiKey  = "BXf9D6bykv3WpKHxJF8TraNqQteVRj7d14SPzl0";
$url     = "https://www.fast2sms.com/dev/bulkV2?authorization=" . $apiKey 
           . "&variables_values=" . $otp 
           . "&route=otp" 
           . "&numbers=" . $mobile;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
curl_close($ch);

$smsResult = json_decode($response);

if ($smsResult && $smsResult->return === true) {
    echo json_encode(['status' => true, 'message' => 'OTP sent successfully']);
} else {
    echo json_encode(['status' => false, 'message' => 'Failed to send OTP. Please try again.']);
}
