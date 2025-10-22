<?php

require_once './includes/db.php';
include './utils/alerts.php';

function addElementMaster()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Enter_Element = mysqli_real_escape_string($conn, $_POST['element']);
    $property_block = mysqli_real_escape_string($conn, $_POST['property_block']);

    $getEle = mysqli_query($conn, 'SELECT * FROM element_master WHERE property_block="' . $property_block . '" &&  element_name = "' . $Enter_Element . '" && status=1');
    $count = mysqli_num_rows($getEle);

    if ($count >= 1) {
        echo showToast('Warning', 'Interior Element Already Exists', 'warning');
    } else {

        $addElements = mysqli_query($conn, "INSERT INTO element_master SET element_name='" . $Enter_Element . "',property_block='" . $property_block . "',created_by='" . $_SESSION['admin_id'] . "', updated_by=0, created_At ='" . $dateFormat . "',updated_At=0,status=1");

        if ($addElements === true) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='element-master.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Interior Elements Added Failed', 'error');
        }
    }
}


function editElementMaster()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $property_block = mysqli_real_escape_string($conn, $_POST['property_block']);
    $Enter_Element = mysqli_real_escape_string($conn, $_POST['element']);
    $getId = mysqli_real_escape_string($conn, $_POST['elementId']);

    $getEle = mysqli_query($conn, 'SELECT * FROM element_master WHERE property_block="' . $property_block . '" &&  element_name = "' . $Enter_Element . '" && status=1');
    $count = mysqli_num_rows($getEle);

    if ($count >= 2) {
        echo showToast('Warning', 'Interior Element Already Exists', 'warning');
    } else {

        $editElement = mysqli_query($conn, "UPDATE element_master set element_name='" . $Enter_Element . "',property_block='" . $property_block . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where element_id	='" . $getId . "'");

        if ($editElement === true) {
            showToast('Success', 'Updated Successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='element-master.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Failed to update Interior Elements', 'error');
        }
    }
}

function deleteElementMaster($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteElement = mysqli_query($conn, "UPDATE element_master SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where element_id='" . $getId . "'");
    if ($deleteElement === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='element-master.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Interior Elements', 'error');
        echo "<script>setTimeout(()=>{
            location.href='element-master.php'
        },'1000');</script>";
    }
}
