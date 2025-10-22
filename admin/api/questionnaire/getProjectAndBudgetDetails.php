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

include '../Authentication/authToken.php';
include "../../includes/db.php";


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

$id = $response['loginid'];
@$queId = $_GET['queId'];

if (!empty($queId)) {
    $projectBudgetData = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM questionnaire WHERE customer_id='" . $id . "' && que_id = '" . $queId . "' && status=1"));
} else {
    $projectBudgetData = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM questionnaire WHERE customer_id='" . $id . "' && status=1 ORDER BY que_id DESC"));
}

if (!empty($projectBudgetData['selected_rooms'])) {
    $selectedRoomsJson = $projectBudgetData['selected_rooms'];
    $selectedRooms = json_decode($selectedRoomsJson, true);


    $roomIds = array_map(function ($room) {
        return "'" . $room['id'] . "'";
    }, $selectedRooms);

    $idList = implode(',', $roomIds);


    $query = "SELECT * FROM property_sections WHERE section_id IN ($idList) AND status=1";
    $resultQuery = mysqli_query($conn, $query);

    $selectedRoomsArr = [];
    while ($row = mysqli_fetch_assoc($resultQuery)) {
        $selectedRoomsArr[] = $row;
    }
}

$result = ['status' => true, 'response' => $projectBudgetData, 'selectedRooms' => $selectedRoomsArr];


echo json_encode($result);
