<?php

require_once './includes/db.php';
include './utils/alerts.php';

function addMaterial()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Enter_material = mysqli_real_escape_string($conn, $_POST['material']);

    $getMaterials = mysqli_query($conn, "SELECT * FROM material WHERE material_name= '" . $Enter_material . "' && status = 1");
    $res  = mysqli_num_rows($getMaterials);

    if ($res >= 1) {
        showToast('Warning', 'Material Already exists', 'warning');
    } else {

        $addMaterial = mysqli_query($conn, "INSERT into material set material_name='" . $Enter_material . "',created_by='" . $_SESSION['admin_id'] . "',updated_by=0,created_At ='" . $dateFormat . "',updated_At=0,status=1");

        if ($addMaterial === true) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='material.php'
            },'1000');</script>";
        } else {
            showToast('Error', 'Material Added Failed', 'error');
        }
    }
}


function editMaterial()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Enter_material = mysqli_real_escape_string($conn, $_POST['material']);
    $getId = mysqli_real_escape_string($conn, $_POST['materialId']);

    $getMaterials = mysqli_query($conn, "SELECT * FROM material WHERE material_name= '" . $Enter_material . "' && status = 1");
    $res  = mysqli_num_rows($getMaterials);

    if ($res >= 2) {
        showToast('Warning', 'Material Already exists', 'warning');
    } else {

        $editMaterial = mysqli_query($conn, "UPDATE material set material_name='" . $Enter_material . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where material_id	='" . $getId . "'");

        if ($editMaterial === true) {
            showToast('Success', 'Updated Successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='material.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Failed to update Material', 'error');
        }
    }
}

function deleteMaterial($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteMaterial = mysqli_query($conn, "UPDATE material SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where material_id='" . $getId . "'");
    if ($deleteMaterial === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='material.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Material', 'error');
        echo "<script>setTimeout(()=>{location.href='material.php'
        },'1000');</script>";
    }
}
