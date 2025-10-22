<?php
ini_set('display_errors', 1);
ini_set('display_startup_error', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin");

include "../../includes/db.php";



$json = file_get_contents('php://input');
$regData = json_decode($json);

// customer Queries
$customerName = $regData->name;
$customerEmail = $regData->email;
$querySub = $regData->subject;
$customerMbl = $regData->mobileNum;
$cusQuery = $regData->customerQuery;


$insertQuery = mysqli_query($conn, "INSERT INTO queries SET contact_name='" . $customerName . "', contact_email='" . $customerEmail . "', contact_number='" . $customerMbl . "',contact_subject='" . $querySub . "',contact_message='" . $cusQuery . "',status=1");
if ($insertQuery) {
    $response = ['status' => true, 'statusText' => "Thank you. Assistance will be provided shortly."];
} else {
    $response = ['status' => false, 'statusText' => 'Failed to submit'];
}
echo json_encode($response);
