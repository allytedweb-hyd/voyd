<?php
session_start(); 

include './includes/db.php';

header('Content-Type: application/json'); 

if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = intval($_POST['id']);
    $status = intval($_POST['status']);

   
    $adminName = isset($_SESSION['Adminname']) ? $_SESSION['Adminname'] : 'System';

    $query = "UPDATE login_admin SET status = $status, updated_by = '$adminName' WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Missing parameters']);
}
?>
