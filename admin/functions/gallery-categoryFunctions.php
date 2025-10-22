<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once './includes/db.php';
include './utils/alerts.php';
include './utils/imageValidation.php';


function addCategory()
{
    // "<script>alert('add function triggered')</script>";
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Enter_category = mysqli_real_escape_string($conn, $_POST['category']);
    $image = $_FILES['image'];
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $path = './Uploads/galleryMaster/';
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



        
        $query = "SELECT * FROM gallery_category WHERE category_name = '" . $Enter_category . "' && status=1";
        $galleryData = mysqli_query($conn, $query);
        $dataRes = mysqli_fetch_array($galleryData);
        $count = mysqli_num_rows($galleryData);


        //  $dataRes['category_name'];

        if ($count >= 1) {
            showToast('Warning', 'Category Already Exists', 'warning');
        } else {

            $addCategory = mysqli_query($conn, "INSERT into gallery_category set category_name='" . $Enter_category . "',category_banner='" . $uploadImage . "',banner_alt_text='" . $alt_text . "',created_by='" . $_SESSION['admin_id'] . "',updated_by=0,created_At ='" . $dateFormat . "',updated_At=0,status=1");

            if ($addCategory === true) {
                showToast('Success', 'Details added successfully', 'success');
                echo "<script>setTimeout(()=>{location.href='gallery-category.php'
                },'1000');</script>";
            } else {
                showToast('Error', 'Category Added Failed', 'error');
            }
        }
    }



function editCategory()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Enter_category = mysqli_real_escape_string($conn, $_POST['category']);
    $image = $_FILES['image'];
    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $getId = mysqli_real_escape_string($conn, $_POST['gcategoryId']);



    // $getId = mysqli_real_escape_string($conn, $_POST['categoryId']);
    $path = './Uploads/galleryMaster/';

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

    $query = "SELECT * FROM gallery_category WHERE category_name = '" . $Enter_category . "' && status=1";
    $galleryData = mysqli_query($conn, $query);
    $dataRes = mysqli_fetch_array($galleryData);
    $count = mysqli_num_rows($galleryData);


    //  $dataRes['category_name'];

    if ($count >= 2) {
        showToast('Warning', 'Category Already Exists', 'warning');
    } else {


        $editCategory = mysqli_query($conn, "UPDATE gallery_category set category_name='" . $Enter_category . "',category_banner='" . $uploadImage . "',banner_alt_text='" . $alt_text . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where gcategory_id	='" . $getId . "'");

        if ($editCategory === true) {
            showToast('Success', 'Updated Successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='gallery-category.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Failed to update Category', 'error');
        }
    }
}

function deleteCategory($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteCategory = mysqli_query($conn, "UPDATE gallery_category SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where gcategory_id='" . $getId . "'");
    if ($deleteCategory === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='gallery-category.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Category', 'error');
        echo "<script>setTimeout(()=>{location.href='gallery-category.php'
        },'1000');</script>";
    }
}
