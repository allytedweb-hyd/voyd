<?php

require_once './includes/db.php';
include './utils/alerts.php';

function addProperty()
{
    "<script>alert('add function triggered')</script>";
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Enter_Property = mysqli_real_escape_string($conn, $_POST['property']);

    $getProperty = mysqli_query($conn, "SELECT * FROM property WHERE enter_property= '" . $Enter_Property . "' && status = 1");
    $res  = mysqli_num_rows($getProperty);

    if ($res >= 1) {
        showToast('Warning', 'Property Already exists', 'warning');
    } else {

        $addProperty = mysqli_query($conn, "INSERT into property set enter_property='" . $Enter_Property . "',created_by='" . $_SESSION['admin_id'] . "',updated_by=0,created_At ='" . $dateFormat . "',updated_At=0,status=1");

        if ($addProperty === true) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='property.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Property Added Failed', 'error');
        }
    }
}


function editProperty()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Enter_Property = mysqli_real_escape_string($conn, $_POST['property']);
    $getId = mysqli_real_escape_string($conn, $_POST['propertyId']);


    $getProperty = mysqli_query($conn, "SELECT * FROM property WHERE enter_property= '" . $Enter_Property . "' && status = 1");
    $res  = mysqli_num_rows($getProperty);

    if ($res >= 2) {
        showToast('Warning', 'Property Already exists', 'warning');
    } else {

        $editProperty = mysqli_query($conn, "UPDATE property set enter_property='" . $Enter_Property . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where property_id='" . $getId . "'");

        if ($editProperty === true) {
            showToast('Success', 'Updated Successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='property.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Failed to update Property', 'error');
        }
    }
}

function deleteProperty($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteProperty = mysqli_query($conn, "UPDATE property SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where property_id='" . $getId . "'");
    if ($deleteProperty === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='property.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Property', 'error');
        echo "<script>setTimeout(()=>{location.href='property.php'
        },'1000');</script>";
    }
}
