<?php
ini_set('display_errors', 1);
ini_set('display_startup_error', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization');

include "../../includes/db.php";

$data = json_decode(file_get_contents('php://input'));

$name = $data->name;
$email = $data->email;
$mobile = $data->mobileNum;
$city = $data->city;
$locality = $data->locality;
$whoAmI = $data->whoAmI;
$message = $data->message;

$generate_lead = mysqli_query($conn, "INSERT INTO leads SET name='" . $name . "', email='" . $email . "', number='" . $mobile . "',city='" . $city . "', location='" . $locality . "', subject='" . $whoAmI . "', message='" . $message . "', query_through='vendor consultation', status=1");

if ($generate_lead) {
    echo json_encode(['status' => true, 'message' => 'Thank you. Assistance will be provided shortly.']);
} else {
    echo json_encode(['status' => false, 'message' => 'Something went wrong. Please try again.']);
}
