<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization');

include "../../includes/db.php";

// $headers = apache_request_headers();
// $token = isset($headers['Authorization']) ? $headers['Authorization'] : '';

// if (!$token) {
//     http_response_code(401);
//     echo json_encode(['status' => false, 'message' => 'Unauthorized: Token missing']);
//     exit;
// }


// $status = verifyAuthToken($token);
// if ($status['status'] == false) {
//     http_response_code(401);
//     echo json_encode(['status' => false, 'message' => 'Unauthorized: Invalid token']);
//     exit;
// }


$uid = isset($_GET['uid']) ? intval($_GET['uid']) : 0;
if (!$uid) {
    http_response_code(400);
    echo json_encode(['status' => false, 'message' => 'Invalid UID']);
    exit;
}


$sql = "SELECT false_ceiling, elec_light, sanitary, wardrobes, wall_putty, painting FROM quotation WHERE que_id = $uid AND approve_status='approved'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    http_response_code(404);
    echo json_encode(["status" => false, "message" => "Project not found"]);
}
?>
