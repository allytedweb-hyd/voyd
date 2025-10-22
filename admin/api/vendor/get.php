<?php
ini_set('display_errors', 1);
ini_set('display_startup_error', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization');

include "../../includes/db.php";

$vendorClass = $_GET['vendorClass'];

$query = mysqli_query($conn, "SELECT * FROM vendor tbl1, vendor_management tbl2 WHERE  tbl1.vendor_class= '" . $vendorClass . "' && tbl1.vendor_id = tbl2.vendor_id && tbl1.status=2 && tbl2.status=1");



$list_of_vendors = [];

while ($data = mysqli_fetch_array($query)) {
    $list_of_vendors[] = $data;
}
$result = ['status' => true, 'response' => $list_of_vendors];

echo json_encode($result);
