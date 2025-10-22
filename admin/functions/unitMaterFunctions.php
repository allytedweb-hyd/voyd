<?php

require_once './includes/db.php';
include './utils/alerts.php';

function addUnit()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $unit = mysqli_real_escape_string($conn, $_POST['unit']);

    $getMaterials = mysqli_query($conn, "SELECT * FROM units WHERE unit_master= '" . $unit . "' && status = 1");
    $res  = mysqli_num_rows($getMaterials);

    if ($res >= 1) {
        showToast('Warning', 'Unit Already exists', 'warning');
    } else {

        $addMaterial = mysqli_query($conn, "INSERT into units set unit_master='" . $unit . "',updated_by=0,created_at ='" . $dateFormat . "',status=1");

        if ($addMaterial === true) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='unitmaster.php'
            },'1000');</script>";
        } else {
            showToast('Error', 'Unit Added Failed', 'error');
        }
    }
}


function editUnit()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $unit = mysqli_real_escape_string($conn, $_POST['unit']);
    $getId = mysqli_real_escape_string($conn, $_POST['materialId']);

    $getMaterials = mysqli_query($conn, "SELECT * FROM units WHERE unit_master= '" . $unit . "' && status = 1");
    $res  = mysqli_num_rows($getMaterials);

    if ($res >= 2) {
        showToast('Warning', 'Unit Already exists', 'warning');
    } else {

        $editMaterial = mysqli_query($conn, "UPDATE units set unit_master='" . $unit . "',updated_by='" . $_SESSION['Adminname'] . "',updated_at='" . $dateFormat . "',status=1 where unit_id	='" . $getId . "'");

        if ($editMaterial === true) {
            showToast('Success', 'Updated Successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='unitmaster.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Failed to update Unit', 'error');
        }
    }
}

function deleteUnit($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteMaterial = mysqli_query($conn, "UPDATE units SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_at='" . $dateFormat . "'where unit_id='" . $getId . "'");
    if ($deleteMaterial === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='unitmaster.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Unit', 'error');
        echo "<script>setTimeout(()=>{location.href='unitmaster.php'
        },'1000');</script>";
    }
}
