<?php
require_once './includes/db.php';
include './utils/alerts.php';
include './utils/imageValidation.php';

function addServices()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Service_title = mysqli_real_escape_string($conn, $_POST['title']);
    $Sub_title = mysqli_real_escape_string($conn, $_POST['subtitle']);
    $image = $_FILES['image'];
    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $Description = mysqli_real_escape_string($conn, $_POST['description']);
    $path = './Uploads/services/';
    $uploadImage = validateImage($path, $image);
    if ($uploadImage === false) {
        showToast('Error', 'Image Upload Failed', 'error');
    } else {

        $getServices = mysqli_query($conn, "SELECT * FROM services WHERE service_title = '" . $Service_title . "' && status=1");
        $servicesRes = mysqli_fetch_array($getServices);
        $count = mysqli_num_rows($getServices);
        if ($count >= 1) {
            showToast('Warning', 'Service already exists', 'warning');
        } else {

            $addServices = mysqli_query($conn, "INSERT into services set service_title='" . $Service_title . "',service_subtitle='" . $Sub_title . "',service_image='" . $uploadImage . "',service_alttext='" . $alt_text . "',service_description='" . $Description . "',created_by='" . $_SESSION['admin_id'] . "',updated_by=0,created_At='" . $dateFormat . "',updated_At=0,status=1");

            if ($addServices === true) {
                showToast('Success', 'Details added successfully', 'success');
                echo "<script>setTimeout(()=>{location.href='services.php'
            },'1000');</script>";
            } else {
                showToast('Error', 'Services Added Failed', 'error');
            }
        }
    }
}

function editServices()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Service_title = mysqli_real_escape_string($conn, $_POST['title']);
    $Sub_title = mysqli_real_escape_string($conn, $_POST['subtitle']);
    $image = $_FILES['image'];
    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $Description = mysqli_real_escape_string($conn, $_POST['description']);
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $getId = mysqli_real_escape_string($conn, $_POST['serviceId']);
    $path = './Uploads/services/';


    if (isset($image) && $image['error'] === 0) {
        $uploadImage = validateImage($path, $image);
        if ($uploadImage === false) {
            showToast('Error', 'Image Upload Failed', 'error');
        } else {
            unlink($path . $oldImage);
        }
    } else {
        $uploadImage = $oldImage;
    }


    $editServices = mysqli_query($conn, "UPDATE services set service_title='" . $Service_title . "',service_subtitle='" . $Sub_title . "',service_image='" . $uploadImage . "',service_alttext='" . $alt_text . "',service_description='" . $Description . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where service_id='" . $getId . "'");

    if ($editServices === true) {
        showToast('Success', 'Updated Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='services.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to update Services', 'error');
    }
}

function deleteService($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteService = mysqli_query($conn, "UPDATE services SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where service_id='" . $getId . "'");
    if ($deleteService === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='services.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Service', 'error');
        echo "<script>setTimeout(()=>{location.href='services.php'
        },'1000');</script>";
    }
}