<?php

// session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include './includes/db.php';

include './utils/alerts.php';
include './utils/imageValidation.php';

function addBanners()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Banner_title = mysqli_real_escape_string($conn, $_POST['title']);
    $image = $_FILES['image'];
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $Description = mysqli_real_escape_string($conn, $_POST['description']);
    $Offerprice = mysqli_real_escape_string($conn, $_POST['offer']);
    $Offer_description = mysqli_real_escape_string($conn, $_POST['offer_description']);
    $path = './Uploads/banners/';
    // $uploadImage = validateImage($path, $image);
    // if ($uploadImage === false) {
    //     showToast('Error', 'Image Upload Failed', 'error');
    // } else {

    if (isset($image) && isset($image['tmp_name']) && is_uploaded_file($image['tmp_name'])) {
        $uploadImage = validateImage($path, $image);
    
        if ($uploadImage === false) {
            showToast('Error', 'Image Upload Failed', 'error');
            return; 
        } else {
            
            if (!empty($oldImage) && file_exists($path . $oldImage)) {
                unlink($path . $oldImage);
            }
        }
    } else {
        $uploadImage = $oldImage;
    }



        $addBanners = mysqli_query($conn, "INSERT into banner set banner_title='" . $Banner_title . "',banner_image='" . $uploadImage . "',banner_alttext='" . $alt_text . "',banner_description='" . $Description . "',offer_price='" . $Offerprice . "',offer_description='" . $Offer_description . "',created_by='" . $_SESSION['Adminname'] . "',updated_by=0,created_At='" . $dateFormat . "',updated_At=0,status=1");

        if ($addBanners === true) {
            showToast('Success', 'Details added successfully', 'success');
            echo"<script>setTimeout(()=>{
                location.href='manage-banners.php'
            },'1000');</script>";
        } else {
            showToast('Error', 'Banners Added Failed', 'error');
        }
    }


function editBanners()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Banner_title = mysqli_real_escape_string($conn, $_POST['title']);
    $image = $_FILES['image'];
    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $Description = mysqli_real_escape_string($conn, $_POST['description']);
    $Offerprice = mysqli_real_escape_string($conn, $_POST['offer']);
    $Offer_description = mysqli_real_escape_string($conn, $_POST['offer_description']);
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $getId = mysqli_real_escape_string($conn, $_POST['bannerId']);
    $path = './Uploads/banners/';


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


    $editBanners = mysqli_query($conn, "UPDATE banner set banner_title='" . $Banner_title . "',banner_image='" . $uploadImage . "',banner_alttext='" . $alt_text . "',banner_description='" . $Description . "',offer_price='" . $Offerprice . "',offer_description='" . $Offer_description . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where banner_id='" . $getId . "'");

    if ($editBanners === true) {
        showToast('Success', 'Updated Successfully', 'success');
        echo "<script>setTimeout(()=>{
            location.href='manage-banners.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to update Banners', 'error');
    }
}

function deleteBanners($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteBanners = mysqli_query($conn, "UPDATE banner SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where banner_id='" . $getId . "'");
    if ($deleteBanners === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{
            location.href='manage-banners.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Banners', 'error');
        echo "<script>setTimeout(()=>{
            location.href='manage-banners.php'
        },'1000');</script>";
    }
}
