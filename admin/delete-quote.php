<?php
include 'includes/db.php';
include 'utils/alerts.php';

$id = $_GET['id'];

 global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteQuote = mysqli_query($conn, "UPDATE request_quote set status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "' where quote_id='" . $id . "'");

    if ($deleteQuote === true) {
        showToast('Success', 'Quote Deleted Successfully', 'success');
        echo "<script>window.location.href='quote_form.php'</script>";
    } else {
        showToast('Error', 'Failed to delete Quote', 'error');
        echo "<script>window.location.href='quote_form.php'</script>";
    }
