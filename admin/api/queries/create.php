<?php
ini_set('display_errors', 1);
ini_set('display_startup_error', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin");

include "../../includes/db.php";

$json = file_get_contents('php://input');
$customerQueriesData = json_decode($json);

$name = $customerQueriesData->name;
$email = $customerQueriesData->email;
$subject = $customerQueriesData->subject;
$mobileNum = $customerQueriesData->mobileNum;
$customerQuery = $customerQueriesData->customerQuery;



$query = mysqli_query($conn, "INSERT INTO contact_us SET contact_name='" . $name . "',contact_email='" . $email . "', contact_number='" . $mobileNum . "',contact_subject='" . $subject . "',contact_message='" . $customerQuery . "',status=1");

if ($query) {
    $result = ['status' => true, 'response' => "Thank for Reaching us"];
} else {
    $result = ['status' => false, 'response' => "something went wrong"];
}

echo json_encode($result);
