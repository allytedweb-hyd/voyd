<?php
ini_set('display_errors', 1);
ini_set('display_startup_error', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin");

include "../../includes/db.php";

// $interiorEle = $_GET['interiorElement'];
// $propertyBlock = $_GET['propertyBlock'];

// $query = mysqli_query($conn, "SELECT * FROM interior_elements WHERE element_category='" . $propertyBlock . "' && element_name='" . $interiorEle . "' && status=1");
// $count = mysqli_num_rows($query);
// $InteriorElementsData = [];
// if ($count >= 1) {
//     while ($data = mysqli_fetch_assoc($query)) {
//         $InteriorElementsData[] = $data;
//     }
//     $result = ['status' => true, 'response' => $InteriorElementsData];
// } else {
//     $result = ['status' => false, 'response' => "Data not found"];
// }

// echo json_encode($result);


// interior elements filtering// 
$limit = 15;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;
@$propertyBlock = $_GET['propertyBlock'];
@$interiorEle = $_GET['interiorElement'];
@$minPrice = $_GET['minPrice'];
@$maxPrice = $_GET['maxPrice'];
@$design = $_GET['design'];
@$material = $_GET['material'];
@$classification = $_GET['classification'];





// @$where_clauses = array();
// if (!empty($propertyBlock)) {
//     $property_block_clause = "tbl2.element_category IN ($propertyBlock)";
//     $where_clauses[] = $property_block_clause;
// }

// if (!empty($interiorEle)) {
//     $interiorEle_clause = "tbl2.element_name IN ($interiorEle)";
//     $where_clauses[] = $interiorEle_clause;
// }
// if (!empty($classification)) {
//     $classification_clause = "tbl2.material_classification  = '" . $classification . "'";
//     $where_clauses[] = $classification_clause;
// }
// if (!empty($minPrice) && !empty($maxPrice)) {
//     $min_max_clause = "tbl2.maximum_price BETWEEN ($minPrice) AND ($maxPrice)";
//     $where_clauses[] = $min_max_clause;
// }

// if (!empty($design)) {
//     $design_clause = "tbl2.product_design IN ($design)";
//     $where_clauses[] = $design_clause;
// }

// if (!empty($material)) {
//     $material_clause = "tbl2.material IN ($material)";
//     $where_clauses[] = $material_clause;
// }

// $where_clause = "";
// if (!empty($where_clauses)) {
//     $where_clause = "WHERE tbl2.status = 1 AND tbl1.element_id = tbl2.element_name AND " . implode(" AND ", $where_clauses);
// } else {
//     $where_clause = "WHERE tbl2.status = 1 AND tbl1.element_id = tbl2.element_name AND ";
// }


// $total_records = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM element_master tbl1, interior_elements tbl2 $where_clause"));
// $query = "SELECT * FROM element_master tbl1, interior_elements tbl2  $where_clause LIMIT $start, $limit";

// $result = mysqli_query($conn, $query);

// $data = array();
// while ($row = mysqli_fetch_assoc($result)) {
//     $data[] = $row;
// }
// $res = ["status" => true, 'response' => $data, 'total' => $total_records];
// echo json_encode($res);

$where_clauses = ["tbl2.status = 1"]; // base clause

if (!empty($propertyBlock)) {
    $where_clauses[] = "tbl2.element_category IN ($propertyBlock)";
}

if (!empty($interiorEle)) {
    $where_clauses[] = "tbl2.element_name IN ($interiorEle)";
}

if (!empty($classification)) {
    $where_clauses[] = "tbl2.material_classification = '" . mysqli_real_escape_string($conn, $classification) . "'";
}

if (!empty($minPrice) && !empty($maxPrice)) {
    $where_clauses[] = "tbl2.maximum_price BETWEEN $minPrice AND $maxPrice";
}

if (!empty($design)) {
    $where_clauses[] = "tbl2.product_design = '" . mysqli_real_escape_string($conn, $design) . "'";
}

if (!empty($material)) {
    $where_clauses[] = "tbl2.material IN ($material)";
}

$where_sql = "WHERE " . implode(" AND ", $where_clauses);


$base_query = "
    FROM interior_elements tbl2
    LEFT JOIN element_master em ON tbl2.element_name = em.element_id
    LEFT JOIN property_sections ps ON tbl2.element_category = ps.section_id
    LEFT JOIN material m ON tbl2.material = m.material_id 
";


$count_sql = "SELECT COUNT(*) AS total $base_query $where_sql";
$count_result = mysqli_query($conn, $count_sql);
$total_records = mysqli_fetch_assoc($count_result)['total'];


$data_sql = "
    SELECT 
        tbl2.*,
        em.element_name AS element_name_display,
        ps.enter_section AS property_block_name,
        m.material_name AS material_name_display
    $base_query
    $where_sql
    LIMIT $start, $limit
";

$data_result = mysqli_query($conn, $data_sql);

$data = [];
while ($row = mysqli_fetch_assoc($data_result)) {
    $data[] = $row;
}

$response = [
    "status" => true,
    "total" => $total_records,
    "response" => $data
];

echo json_encode($response);
