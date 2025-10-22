<?php
ini_set('display_errors', 1);
ini_set('display_startup_error', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization');

include "../../includes/db.php";

// $headers = apache_request_headers();
// $token = $headers['Authorization'];

// if(!$token){
//     http_response_code(401);
//     echo json_encode(['status' => false, 'message' => 'unauthorized']);
//     exit;
// }

// if($token){
//     $status = verifyAuthToken($token);
//     if($status['status'] == false){
//         http_response_code(401);
//         echo json_encode(['status' => false, 'message' => 'unauthorized']);
//         exit;
//     }



// }

$getTestimonials = mysqli_query($conn, "SELECT * FROM vendor_testimonials WHERE status=1");

$data = [];
while ($row = mysqli_fetch_array($getTestimonials)) {
    $data[] = $row;
}

if ($data) {
    $response = ['status' => true, 'response' => $data];
} else {
    $response = ['status' => false, 'response' => 'No Data Found'];
}

echo json_encode($response);
