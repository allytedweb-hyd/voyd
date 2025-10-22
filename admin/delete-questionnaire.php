<?php
include 'includes/header.php';
include 'includes/db.php';
include './utils/alerts.php';

$id = $_GET['id'];

 global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteQuestionnaire = mysqli_query($conn, "UPDATE questionnaire SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "' WHERE que_id='" . $id . "'");

    if ($deleteQuestionnaire === true) {
        showToast('Success', 'Quote Deleted Successfully', 'success');
        echo "<script>window.location.href='questionnaire_form.php'</script>";
    } else {
        showToast('Error', 'Failed to delete Quote', 'error');
        echo "<script>window.location.href='questionnaire_form.php'</script>";
    }
