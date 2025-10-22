<?php
ini_set('display_errors', 1);
ini_set('display_startup_error', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin");

include "../../includes/db.php";

$query = mysqli_query($conn, "SELECT * FROM services WHERE status=1");
$ourServices = [];

while ($data = mysqli_fetch_array($query)) {
    $ourServices[] = $data;
}
$result = ['status' => true, 'response' => $ourServices];
echo json_encode($result);
