<?php

ini_set('display_errors', 1);
ini_set('display_startup_error', 1);
error_reporting(E_ALL);


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
include '../../vendor/autoload.php';
include './authToken.php';

$postdata = file_get_contents("php://input");
$jsondecode_data = json_decode($postdata);



if (!empty($jsondecode_data)) {
    if (!empty($jsondecode_data->userId) && !empty($jsondecode_data->userPassword)) {
        $email = mysqli_real_escape_string($conn, $jsondecode_data->userId);
        $password = $jsondecode_data->userPassword;
    }

    if (!empty($jsondecode_data->email_verified)) {
        $google_id = $jsondecode_data->sub;
        $google_email = $jsondecode_data->email;
        $query = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM customer WHERE (google_id='" . $google_id . "' || customer_email='" . $google_email . "')AND status='1'"));
        $id = $query['google_id'] ?? '';
        $email = $query['customer_email'] ?? '';
        if ($id === $google_id || $email === $google_email) {
            $tokenData = generateAuthToken($query['customer_id']);

            if ($tokenData['status']) {
                http_response_code(200);
                echo json_encode([
                    'status' => true,
                    'message' => 'Logged in Successfully',
                    'userData' => $query,
                    'token' => $tokenData['token']
                ]);
                exit();
            } else {
                http_response_code(500);
                echo json_encode(['status' => false, 'message' => 'Token generation failed']);
                exit();
            }
        } else {
            http_response_code(404);
            echo json_encode(['status' => false, 'message' => 'User not found, Please Signup with google']);
            exit();
        }
    }


    $query = "SELECT * FROM customer WHERE (customer_email='$email') AND status='1'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);


        if (password_verify($password, $user['password'])) {
            unset($user['password']);
            $tokenData = generateAuthToken($user['customer_id']);

            if ($tokenData['status']) {
                http_response_code(200);
                echo json_encode([
                    'status' => true,
                    'message' => 'Logged in Successfully',
                    'userData' => $user,
                    'token' => $tokenData['token']
                ]);
                exit();
            } else {
                http_response_code(500);
                echo json_encode(['status' => false, 'message' => 'Token generation failed']);
                exit();
            }
        } else {
            http_response_code(401);
            echo json_encode(['status' => false, 'message' => 'Invalid password']);
            exit();
        }
    } else {
        http_response_code(404);
        echo json_encode(['status' => false, 'message' => 'User not found']);
        exit();
    }
} else {
    http_response_code(400);
    echo json_encode(['status' => false, 'message' => 'Missing user ID or password']);
    exit();
}
