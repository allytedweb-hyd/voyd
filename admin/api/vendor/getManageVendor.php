<?php
ini_set('display_errors', 1);
ini_set('display_startup_error', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization');

include "../../includes/db.php";

$vendorId = $_GET['id'];


$getVendor = mysqli_query($conn, 'SELECT * FROM vendor_management WHERE vendor_id = "' . $vendorId . '" AND status=1');
$result = mysqli_fetch_assoc($getVendor);
if ($result) {
    $response = ['status' => true, 'response' => $result];
} else {
    $response = ['status' => false, 'response' => 'No Data Found'];
}

echo json_encode($response);
