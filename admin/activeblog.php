<?php 
include 'includes/db.php';

header('Content-Type: application/json');

if (isset($_POST['id'])) {
    $id = $_POST['id'];

  
    $getblogs = mysqli_query($conn, "SELECT COUNT(*) AS total FROM blog WHERE status = 2");
    $blogcount = mysqli_fetch_assoc($getblogs)['total'];

    if ($blogcount >= 3) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Only 3 blogs can be active at a time.'
        ]);
        exit;
    }

    
    $update = mysqli_query($conn, "UPDATE blog SET status = 2 WHERE blog_id = '$id'");

    if ($update) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Blog activated successfully.'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to activate blog.'
        ]);
    }
}
?>
