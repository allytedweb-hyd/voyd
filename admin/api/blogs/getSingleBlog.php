<?php
ini_set('display_errors', 1);
ini_set('display_startup_error', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin");

include '../../includes/db.php';
$id = $_GET['blogId'];

$query = mysqli_query($conn, "SELECT * FROM blog WHERE blog_id='" . $id . "' && status=2 ");


$data = mysqli_fetch_array($query);
if ($data) {

    $result = ['status' => true, 'response' => $data];
}



echo json_encode($result);
