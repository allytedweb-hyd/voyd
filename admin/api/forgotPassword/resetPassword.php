<?php

ini_set('display_errors', 1);
ini_set('display_startup_error', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin");

include "../../includes/db.php";

$json = file_get_contents('php://input');
$customerData = json_decode($json);

$newPassword = $customerData->conPassword;
$id = $customerData->customerId;




$query = mysqli_query($conn, "UPDATE customer SET password ='" . $newPassword . "' WHERE customer_id='" . $id . "' && status=1");

if ($query) {
    $result = ['status' => true, 'response' => "Password Changed Successfully"];
} else {
    $result = ['status' => false, 'response' => "Failed To Change Password"];
}

echo json_encode($result);
