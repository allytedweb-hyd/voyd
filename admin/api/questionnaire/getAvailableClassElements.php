<?php
ini_set('display_errors', 1);
ini_set('display_startup_error', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin");

include "../../includes/db.php";

$classification = isset($_GET['classification']) ? $_GET['classification'] : '';

if (empty($classification)) {
    echo json_encode([
        "status" => false,
        "message" => "Classification parameter is required."
    ]);
    exit;
}

// Escape classification to prevent SQL injection
$classification_safe = mysqli_real_escape_string($conn, $classification);

// Base WHERE clause: active elements with classification filter
$where_sql = "WHERE tbl2.status = 1 AND tbl2.material_classification = '$classification_safe'";

$base_query = "
    FROM interior_elements tbl2
    LEFT JOIN element_master em ON tbl2.element_name = em.element_id
    LEFT JOIN property_sections ps ON tbl2.element_category = ps.section_id
    LEFT JOIN material m ON tbl2.material = m.material_id
";

// Fetch all matching records (no limit)
$data_sql = "
    SELECT 
        tbl2.*,
        em.element_name AS element_name_display,
        ps.enter_section AS property_block_name,
        m.material_name AS material_name_display
    $base_query
    $where_sql
";

$data_result = mysqli_query($conn, $data_sql);

$data = [];
while ($row = mysqli_fetch_assoc($data_result)) {
    $data[] = $row;
}

$response = [
    "status" => true,
    "total" => count($data),
    "response" => $data
];

echo json_encode($response);
