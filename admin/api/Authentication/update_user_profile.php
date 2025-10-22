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


$json = file_get_contents('php://input');
$data = json_decode($json);

@$first_name = $data->first_name;
@$last_name = $data->last_name;
@$mobile = $data->customer_mobile;
@$profile_image = $data->profile_img;
@$email = $data->customer_email;
@$permanent_address = $data->address;
@$delivery_address = $data->delivery_address;
@$place = $data->place;
@$street = $data->street;
@$city = $data->city;
@$state = $data->state;
$folderPath = "../../Uploads/customer/";
/* if (!empty($profile_image)) {
    @$image_parts = explode(";base64,", $profile_image);
    @$image_type_aux = explode("image/", $image_parts[0]);
    @$image_base64 = base64_decode($image_parts[1]);
    @$fileProfile = uniqid() . '.png';
    @$file = $folderPath . $fileProfile;
    @$move = file_put_contents($file, $image_base64);
} */

$customerId = $response['loginid'];


$getUser = mysqli_query($conn, "SELECT * FROM customer WHERE customer_id='" . $customerId . "' AND status=1");
$fetchUser = mysqli_fetch_array($getUser);
// $fileProfile = $fetchUser['profile_img']; 
if (mysqli_num_rows($getUser) < 1) {
    http_response_code(404);
    $Cusresponse = ['status' => false, 'response' => 'User Not Found'];
    echo json_encode($Cusresponse);
    exit();
}



// if (!empty($profile_image)) {
//     $image_parts = explode(";base64,", $profile_image);
//     if (count($image_parts) === 2) {
//         $image_base64 = base64_decode($image_parts[1]);
//         $fileProfile = uniqid() . '.png';
//         $file = $folderPath . $fileProfile;
//         file_put_contents($file, $image_base64);
//     }
// }

$existingProfile = $fetchUser['profile_img']; 
$fileProfile = $existingProfile; 

if (!empty($profile_image) && strpos($profile_image, 'data:image/') === 0) {
    $image_parts = explode(";base64,", $profile_image);
    if (count($image_parts) === 2) {
        $image_base64 = base64_decode($image_parts[1]);
        $fileProfile = uniqid() . '.png';  // filename only, NOT the base64 string
        $file = $folderPath . $fileProfile;
        $saved = file_put_contents($file, $image_base64);
        if ($saved === false) {
            http_response_code(500);
            echo json_encode(['status' => false, 'response' => 'Failed to save profile image']);
            exit();
        }
    }
}

// Then save $fileProfile (filename) into DB — NOT $profile_image (base64 string)








// $updateCustomerDetails = mysqli_query($conn, 'UPDATE customer SET first_name="' . $first_name . '", last_name="' . $last_name . '", profile_img="' . $fileProfile . '", customer_email="' . $email . '", customer_mobile="' . $mobile . '", address="' . $permanent_address . '", delivery_address="' . $delivery_address . '",  place="' . $place . '",
//   street="' . $street . '",
//   city="' . $city . '",
//   state="' . $state . '" WHERE customer_id ="' . $customerId . '" AND status=1');

// if ($updateCustomerDetails) {
//     http_response_code(200);
//     $Cusresponse = ['status' => true, 'response' => "Details Updated Successfully"];
// } else {
//     http_response_code(401);
//     $Cusresponse = ['status' => false, 'response' => 'Failed To Update'];
// }
// echo json_encode($Cusresponse);

$stmt = $conn->prepare('UPDATE customer SET first_name=?, last_name=?, profile_img=?, customer_email=?, customer_mobile=?, address=?, delivery_address=?, place=?, street=?, city=?, state=? WHERE customer_id=? AND status=1');

if (!$stmt) {
    http_response_code(500);
    echo json_encode(['status' => false, 'response' => 'Database error: ' . $conn->error]);
    exit();
}

$stmt->bind_param(
    'ssssssssssss',
    $first_name,
    $last_name,
    $fileProfile,
    $email,
    $mobile,
    $permanent_address,
    $delivery_address,
    $place,
    $street,
    $city,
    $state,
    $customerId
);

$exec = $stmt->execute();

if ($exec) {
    http_response_code(200);
    echo json_encode(['status' => true, 'response' => "Details Updated Successfully"]);
} else {
    http_response_code(500);
    echo json_encode(['status' => false, 'response' => 'Failed To Update: ' . $stmt->error]);
}

$stmt->close();
exit();

