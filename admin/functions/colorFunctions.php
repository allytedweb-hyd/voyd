<?php

require_once './includes/db.php';
include './utils/alerts.php';

function addColor()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Enter_color = mysqli_real_escape_string($conn, $_POST['color']);
    $color_shade = mysqli_real_escape_string($conn, $_POST['colorShade']);


    $getColor = mysqli_query($conn, "SELECT * FROM colors WHERE color_code= '" . $Enter_color . "' && status = 1");
    $res  = mysqli_num_rows($getColor);

    if ($res >= 1) {
        showToast('Warning', 'Colour Already exists', 'warning');
    } else {
        $addColor = mysqli_query($conn, "INSERT INTO colors set color_code='" . $Enter_color . "',color_shade='" . $color_shade . "', created_by='" . $_SESSION['admin_id'] . "',updated_by=0, created_At ='" . $dateFormat . "',updated_At=0,status=1");

        if ($addColor === true) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='color.php'
            },'1000');</script>";
        } else {
            showToast('Error', 'Failed to add color', 'error');
        }
    }
}


function editColor()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Enter_color = mysqli_real_escape_string($conn, $_POST['color']);
    $color_shade = mysqli_real_escape_string($conn, $_POST['colorShade']);

    $getId = mysqli_real_escape_string($conn, $_POST['colorId']);


    $getColor = mysqli_query($conn, "SELECT * FROM colors WHERE color_code= '" . $Enter_color . "' && status = 1");
    $res  = mysqli_num_rows($getColor);

    if ($res >= 2) {
        showToast('Warning', 'Colour Already exists', 'warning');
    } else {
        $editColor = mysqli_query($conn, "UPDATE colors set color_code='" . $Enter_color . "',color_shade='" . $color_shade . "' ,updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where color_id='" . $getId . "'");

        if ($editColor === true) {
            showToast('Success', 'Updated Successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='color.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Failed to update Color', 'error');
        }
    }
}

function deleteColor($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteColor = mysqli_query($conn, "UPDATE colors SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where color_id='" . $getId . "'");
    if ($deleteColor === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='color.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Color', 'error');
        echo "<script>setTimeout(()=>{
            location.href='color.php'
        },'1000');</script>";
    }
}
