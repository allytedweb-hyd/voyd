<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization');

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
    header("HTTP/1.1 200 OK");
    die();
}



include "../../includes/db.php";
include './authToken.php';
$json = file_get_contents('php://input');
$data = json_decode($json);


if (empty($data->type)) {

    $headers = apache_request_headers();


    if (!isset($headers['Authorization'])) {
        http_response_code(401);
        echo json_encode(['status' => false, 'message' => 'unauthorized']);
        exit();
    }

    @$token = str_replace('Bearer ', '', $headers['Authorization']);
    if (empty($token)) {
        http_response_code(401);
        echo json_encode(['status' => false, 'message' => 'Unauthorized Access']);
        exit();
    }

    $response = verifyAuthToken($token);
    if (!$response['status']) {
        http_response_code(401);
        echo json_encode(['status' => false, 'message' => 'Unauthorized Access']);
        exit();
    }

    $customerId = $response['loginid'];
}




if (!empty($data)) {

    $otp = $data->otp;
    @$email = $data->email;


    if (empty($data->type)) {
        $result = mysqli_query($conn, "SELECT * FROM customer WHERE customer_id  = '$customerId' AND status=1");
    } else {
        $result = mysqli_query($conn, "SELECT * FROM customer WHERE customer_email  = '$email' AND status=1");
    }
    $getDetails = mysqli_fetch_assoc($result);

    $current_time = time();
    $expiry_time = $getDetails['otp_expires'];
    $generated_otp = $getDetails['otp'];

    if ($current_time > $expiry_time) {
        http_response_code(400);
        echo json_encode(["status" => false, "message" => "OTP expired"]);
        exit();
    }

    if ($generated_otp != $otp) {
        http_response_code(400);
        echo json_encode(["status" => false, "message" => "Invalid OTP"]);
        exit();
    }

    if ($result) {
        echo json_encode(["status" => true, "message" => "OTP verified"]);
    } else {
        echo json_encode(["status" => false, "message" => "Invalid or expired OTP"]);
    }
}
