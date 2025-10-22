<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



include 'includes/db.php';
include 'includes/header.php';
include 'utils/alerts.php';

$id = $_GET['id'];

 global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteCustomer = mysqli_query($conn, "UPDATE customer set status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "' where customer_id='" . $id . "'");

  if ($deleteCustomer) {
        showToast('Success', 'Customer deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='customer.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Customer', 'error');
        echo "<script>setTimeout(()=>{location.href='customer.php'
        },'1000');</script>";
    }


    ?>

