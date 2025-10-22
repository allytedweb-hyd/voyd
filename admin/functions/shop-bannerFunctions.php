<?php
require_once './includes/db.php';
include './utils/alerts.php';
include './utils/imageValidation.php';

function addShopbanners()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $image = $_FILES['image'];
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $path = './Uploads/shopbanners/';
    // $uploadImage = validateImage($path, $image);
    // if (!$uploadImage) {
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



        $addShopbanners = mysqli_query($conn, "INSERT into shopBanners set bnr_img='" . $uploadImage . "',bnr_alt_text='" . $alt_text . "',created_by='" . $_SESSION['admin_id'] . "',updated_by=0,created_At='" . $dateFormat . "',updated_At=0,status=1");

        if ($addShopbanners) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='shop-banners.php'
            },'1000');</script>";
        } else {
            showToast('Error', 'Banners Added Failed', 'error');
        }
    }


function editShopbanners()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $image = $_FILES['image'];
    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $getId = mysqli_real_escape_string($conn, $_POST['sbannerId']);
    $path = './Uploads/shopbanners/';


    if (isset($image) && $image['error'] === 0) {
        $uploadImage = validateImage($path, $image);
        if (!$uploadImage) {
            showToast('Error', 'Image Upload Failed', 'error');
        } else {
            unlink($path . $oldImage);
        }
    } else {
        $uploadImage = $oldImage;
    }


    $editShopbanners = mysqli_query($conn, "UPDATE shopBanners set bnr_img='" . $uploadImage . "',bnr_alt_text='" . $alt_text . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where bnr_id='" . $getId . "'");

    if ($editShopbanners) {
        showToast('Success', 'Updated Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='shop-banners.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to update Banners', 'error');
    }
}

function deleteShopbanners($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteShopbanners = mysqli_query($conn, "UPDATE shopBanners SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where bnr_id='" . $getId . "'");
    if ($deleteShopbanners) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='shop-banners.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Banners', 'error');
        echo "<script>setTimeout(()=>{location.href='shop-banners.php'
        },'1000');</script>";
    }
}