<?php

require_once './includes/db.php';
include './utils/alerts.php';

function addPropertyType()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    // $Select_property = mysqli_real_escape_string($conn, $_POST['property']);
    $Enter_PropertyType = mysqli_real_escape_string($conn, $_POST['propertyType']);

    $getProperty = mysqli_query($conn, "SELECT * FROM property_type WHERE property_Type= '" . $Enter_PropertyType . "' && status = 1");
    $res  = mysqli_num_rows($getProperty);

    if ($res >= 1) {
        showToast('Warning', 'Property Type Already Exists', 'warning');
    } else {

        $addPropertyType = mysqli_query($conn, "INSERT into property_type set property_Type='" . $Enter_PropertyType . "',created_by='" . $_SESSION['admin_id'] . "',updated_by=0,created_At ='" . $dateFormat . "',updated_At=0,status=1");

        if ($addPropertyType === true) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='propertyType.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Property Type Added Failed', 'error');
        }
    }
}


function editPropertyType()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    // $Select_property = mysqli_real_escape_string($conn, $_POST['property']);
    $Enter_PropertyType = mysqli_real_escape_string($conn, $_POST['propertyType']);
    $getId = mysqli_real_escape_string($conn, $_POST['propertyTypeId']);

    $getProperty = mysqli_query($conn, "SELECT * FROM property_type WHERE property_Type= '" . $Enter_PropertyType . "' && status = 1");
    $res  = mysqli_num_rows($getProperty);

    if ($res >= 2) {
        showToast('Warning', 'Property Type Already Exists', 'warning');
    } else {

        $editPropertyType = mysqli_query($conn, "UPDATE property_type set property_Type='" . $Enter_PropertyType . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where propertyType_id='" . $getId . "'");

        if ($editPropertyType === true) {
            showToast('Success', 'Updated Successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='propertyType.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Failed to update Property Type', 'error');
        }
    }
}

function deletePropertyType($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deletePropertyType = mysqli_query($conn, "UPDATE property_type SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where propertyType_id='" . $getId . "'");
    if ($deletePropertyType === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='propertyType.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Property Type', 'error');
        echo "<script>setTimeout(()=>{location.href='propertyType.php'
        },'1000');</script>";
    }
}
