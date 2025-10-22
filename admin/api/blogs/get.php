<?php
ini_set('display_errors', 1);
ini_set('display_startup_error', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin");

include "../../includes/db.php";
@$limit = $_GET['limit'];
@$offset = $_GET['offset'];
if (!empty($limit) && !empty($offset)) {
    $query = mysqli_query($conn, "SELECT * FROM blog WHERE status=2 LIMIT $limit OFFSET $offset");
} else {

    $query = mysqli_query($conn, "SELECT * FROM blog WHERE status=2");
}
$count = mysqli_num_rows($query);
$blogData = [];

while ($data = mysqli_fetch_array($query)) {
    $blogData[] = $data;
}
$result = ['status' => true, 'response' => $blogData];


echo json_encode($result);
