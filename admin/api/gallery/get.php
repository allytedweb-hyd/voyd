<?php
ini_set('display_errors', 1);
ini_set('display_startup_error', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin");

include "../../includes/db.php";
$category = $_GET['projectCategory'];

$query = mysqli_query($conn, "SELECT * FROM gallery WHERE gallery_category = '" . $category . "' && status=1");
$count = mysqli_num_rows($query);

$galleryCatQuery = mysqli_query($conn, "SELECT * FROM gallery_category WHERE gcategory_id  = '" . $category . "' && status=1");
$galleryCatData = mysqli_fetch_array($galleryCatQuery);

$previousProjects = [];
if ($query) {
    while ($data = mysqli_fetch_array($query)) {
        $previousProjects[] = $data;
    }
    $result = ['status' => true, 'response' => [
        'previousProjectsCat' => $galleryCatData,
        'prevProjects' => $previousProjects
    ]];
} else {
    $result = ['status' => false, 'response' => "No Data Found"];
}
echo json_encode($result);
