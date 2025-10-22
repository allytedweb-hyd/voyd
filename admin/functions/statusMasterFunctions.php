<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include './includes/db.php';

include './utils/alerts.php';
include './utils/imageValidation.php';

function addStatus()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $statusmaster = mysqli_real_escape_string($conn, $_POST['status']);

    $getRole = mysqli_query($conn, "SELECT * FROM tbl_status_master WHERE status_master = '" . $statusmaster . "' && status=1");
    $fetchRole = mysqli_fetch_array($getRole);

    if ($fetchRole >= 1) {
        showToast('warning', 'Status Already Exists', 'warning');
    } else {
        $addrole = mysqli_query($conn, "INSERT INTO tbl_status_master SET status_master = '" . $statusmaster . "', created_by='" . $_SESSION['Adminname'] . "', status=1");

        if ($addrole) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{
                location.href='statusMasters.php'
            },'1000');</script>";
        } else {
            showToast('Error', 'Failed to add Status', 'error');
        }
    }
}

function editStatusMaster()
{
    global $conn;
    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $statusMaster = mysqli_real_escape_string($conn, $_POST['status']);
    $statusMasterId = mysqli_real_escape_string($conn, $_POST['statusMasterId']);

    $query = "UPDATE tbl_status_master SET status_master='" . $statusMaster . "', created_by='" . $_SESSION['Adminname'] . "', updated_date='" . $dateFormat . "' WHERE status_id='" . $statusMasterId . "' && status=1";


    $editRole = mysqli_query($conn, $query);


    if ($editRole) {
        showToast('Success', 'Updated Successfully', 'success');
        echo "<script>setTimeout(()=>{
            location.href='statusMasters.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to update', 'error');
    }
}

function deleteStatusMaster($id)
{
    $getId = $id;
    global $conn;
    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');
    $deleteEmployee = mysqli_query($conn, "UPDATE tbl_status_master SET status=0,created_by='" . $_SESSION['Adminname'] . "',updated_date='" . $dateFormat . "' WHERE status_id ='" . $getId . "'");
    if ($deleteEmployee === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{
            location.href='adminRoles.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete', 'error');
        echo "<script>setTimeout(()=>{
            location.href='employee.php'
        },'1000');</script>";
    }
}
