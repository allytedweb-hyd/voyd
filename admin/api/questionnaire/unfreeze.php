<?php
include '../../includes/db.php';




ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] == "OPTIONS") {
    header("HTTP/1.1 200 OK");
    exit();
}

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->queId)) {
    echo json_encode(['status' => false, 'message' => 'Missing queId']);
    exit();
}

$queId = mysqli_real_escape_string($conn, $data->queId);

try {
    $update_status = mysqli_query($conn,
        "UPDATE questionnaire AS tbl1
         JOIN quotation AS tbl2 ON tbl1.que_id = tbl2.que_id
         SET tbl1.freeze = ''
         WHERE tbl1.que_id = '$queId'
         AND tbl1.status = 1 AND tbl2.status = 1"
    );

    if ($update_status) {
        echo json_encode(["status" => true, "message" => "Questionnaire unfreezed successfully"]);
    } else {
        echo json_encode(["status" => false, "message" => "Failed to update."]);
    }
} catch (Exception $e) {
    echo json_encode(["status" => false, "message" => "Error occurred", "error" => $e->getMessage()]);
}
