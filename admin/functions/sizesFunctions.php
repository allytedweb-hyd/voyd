<?php

require_once './includes/db.php';
include './utils/alerts.php';

function addSizes()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Enter_sizes = mysqli_real_escape_string($conn, $_POST['sizes']);

    $getDimension = mysqli_query($conn, "SELECT * FROM sizes WHERE enter_size= '" . $Enter_sizes . "' && status = 1");
    $res  = mysqli_num_rows($getDimension);

    if ($res >= 1) {
        showToast('Warning', 'Dimension Already Exists', 'warning');
    } else {

        $addSizes = mysqli_query($conn, "INSERT into sizes set enter_size='" . $Enter_sizes . "',created_by='" . $_SESSION['admin_id'] . "',updated_by=0,created_At ='" . $dateFormat . "',updated_At=0,status=1");

        if ($addSizes === true) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='sizes.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Dimensions Added Failed', 'error');
        }
    }
}


function editSizes()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Enter_sizes = mysqli_real_escape_string($conn, $_POST['sizes']);
    $getId = mysqli_real_escape_string($conn, $_POST['sizesId']);

    $getDimension = mysqli_query($conn, "SELECT * FROM sizes WHERE enter_size= '" . $Enter_sizes . "' && status = 1");
    $res  = mysqli_num_rows($getDimension);

    if ($res >= 2) {
        showToast('Warning', 'Dimension Already Exists', 'warning');
    } else {

        $editSizes = mysqli_query($conn, "UPDATE sizes set enter_size='" . $Enter_sizes . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where sizes_id='" . $getId . "'");

        if ($editSizes === true) {
            showToast('Success', 'Updated Successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='sizes.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Failed to update Dimensions', 'error');
        }
    }
}

function deleteSize($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteSize = mysqli_query($conn, "UPDATE sizes SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where sizes_id='" . $getId . "'");
    if ($deleteSize === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='sizes.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Dimensions', 'error');
        echo "<script>setTimeout(()=>{location.href='sizes.php'
        },'1000');</script>";
    }
}
