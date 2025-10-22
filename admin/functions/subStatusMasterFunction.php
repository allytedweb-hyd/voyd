<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include './includes/db.php';

include './utils/alerts.php';
include './utils/imageValidation.php';

function addSubStatus()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $statusMaster = mysqli_real_escape_string($conn, $_POST['status_master']);
    $subStatusMaster = mysqli_real_escape_string($conn, $_POST['sub_status']);



    $addrole = mysqli_query($conn, "INSERT INTO tbl_subStatus_master SET status_master = '" . $statusMaster . "', sub_status_master='" . $subStatusMaster . "',created_by='" . $_SESSION['Adminname'] . "', status=1");

    if ($addrole) {
        showToast('Success', 'Details added successfully', 'success');
        echo "<script>setTimeout(()=>{
                location.href='subStatusMaster.php'
            },'1000');</script>";
    } else {
        showToast('Error', 'Failed to add Sub-Status', 'error');
    }
}


function editSubStatusMaster()
{
    global $conn;
    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $statusMaster = mysqli_real_escape_string($conn, $_POST['status_master']);
    $substatusMaster = mysqli_real_escape_string($conn, $_POST['sub_status']);
    $statusMasterId = mysqli_real_escape_string($conn, $_POST['statusMasterId']);

    $query = "UPDATE tbl_subStatus_master SET status_master='" . $statusMaster . "', sub_status_master='" . $substatusMaster . "', created_by='" . $_SESSION['Adminname'] . "', updated_date='" . $dateFormat . "' WHERE sub_status_id='" . $statusMasterId . "' && status=1";


    $editRole = mysqli_query($conn, $query);

    if ($editRole) {
        showToast('Success', 'Updated Successfully', 'success');
        echo "<script>setTimeout(()=>{
            location.href='subStatusMaster.php'
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
    $deleteEmployee = mysqli_query($conn, "UPDATE tbl_subStatus_master SET status=0,created_by='" . $_SESSION['Adminname'] . "',updated_date='" . $dateFormat . "' WHERE sub_status_id ='" . $getId . "'");
    if ($deleteEmployee === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{
            location.href='subStatusMaster.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete', 'error');
        echo "<script>setTimeout(()=>{
            location.href='subStatusMaster.php'
        },'1000');</script>";
    }
}
