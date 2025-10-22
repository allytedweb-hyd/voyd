<?php
include 'includes/db.php'; 

header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    
    $query = mysqli_query($conn, "SELECT icon FROM classification WHERE classification_id = $id AND status = 1");

    if ($query && mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $icon = $row['icon'];

     
        if (!empty($icon)) {
            echo json_encode([
                'success' => true,
                'image_name' => $icon  
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Image not found']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid ID']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID missing']);
}
?>
