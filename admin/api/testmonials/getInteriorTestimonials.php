<?php
ini_set('display_errors', 1);
ini_set('display_startup_error', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin");

include "../../includes/db.php";

$userId = $_GET['userId'];


if (!empty($userId)) {



    $query = mysqli_query($conn, "SELECT * FROM testimonial_tabs WHERE user_name='" . $userId . "' && status=1");
    $count = mysqli_num_rows($query);
    $testimonialsData = [];
    if ($query) {
        while ($data = mysqli_fetch_array($query)) {
            $testimonialsData[] = $data;
        }
        $result = ['status' => true, 'response' => $testimonialsData];
    } else {
        $result = ['status' => false, 'response' => "Data not found"];
    }
} else {
    $result = ['status' => false, 'response' => "Invalid user id"];
}
echo json_encode($result);
