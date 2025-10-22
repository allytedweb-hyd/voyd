<?php
header('Content-Type: application/json');
include 'includes/db.php';

if (isset($_POST['maker_classification']) && isset($_POST['material_classification'])) {
    $maker = $_POST['maker_classification'];
    $material = $_POST['material_classification'];

   
    $stmtMaker = $conn->prepare("SELECT maker_min, maker_max FROM total_cost WHERE classifications = ?");
    $stmtMaker->bind_param("s", $maker);
    $stmtMaker->execute();
    $resultMaker = $stmtMaker->get_result();
    $makerData = $resultMaker->fetch_assoc();

   
    $stmtMaterial = $conn->prepare("SELECT material_min, material_max FROM total_cost WHERE classifications = ?");
    $stmtMaterial->bind_param("s", $material);
    $stmtMaterial->execute();
    $resultMaterial = $stmtMaterial->get_result();
    $materialData = $resultMaterial->fetch_assoc();

    if ($makerData && $materialData) {
      
        $min_price = $makerData['maker_min'] * $materialData['material_min'];
        $max_price = $makerData['maker_max'] * $materialData['material_max'];

        
        $cost_per_sqft = (($min_price + $max_price) / 2);

        echo json_encode([
            'success' => true,
            'cost_per_sqft' => round($cost_per_sqft, 2),
            'min_price' => round($min_price, 2),
            'max_price' => round($max_price, 2)
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'error' => 'Classification data not found'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'error' => 'Missing parameters'
    ]);
}
?>
