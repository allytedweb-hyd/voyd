<?php
include 'includes/db.php';
include 'includes/header.php';

include './utils/alerts.php';



$id = $_GET['id'];

 global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteContact = mysqli_query($conn, "UPDATE designers SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_at='" . $dateFormat . "' WHERE designer_id='" . $id . "'");

    if ($deleteContact === true) {
        showToast('Success', 'Designer Deleted Successfully', 'success');
        echo "<script>window.location.href='designers.php'</script>";
    } else {
        showToast('Error', 'Failed to delete Designer', 'error');
        echo "<script>window.location.href='designers.php'</script>";
    }
