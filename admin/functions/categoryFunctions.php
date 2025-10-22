<?php
require_once './includes/db.php';
include './utils/alerts.php';
include './utils/imageValidation.php';
function addCategory()
{
    global $conn;
    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');
    $Enter_category = mysqli_real_escape_string($conn, $_POST['category']);
    $offer = mysqli_real_escape_string($conn, $_POST['offer']);
    $image = $_FILES['CategoryImage'];
    $image3 = $_FILES['bannerimage2'];
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $oldImage2 = mysqli_real_escape_string($conn, $_POST['oldImage2']);
    $Alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $Alt_text2 = mysqli_real_escape_string($conn, $_POST['alttext2']);
    $path = './Uploads/category/';
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
    if (isset($image3) && isset($image3['tmp_name']) && is_uploaded_file($image3['tmp_name'])) {
        $uploadImage3 = validateImage($path, $image3);
        if ($uploadImage3 === false) {
            showToast('Error', 'Image Upload Failed', 'error');
            return;
        } else {
            if (!empty($oldImage2) && file_exists($path . $oldImage2)) {
                unlink($path . $oldImage2);
            }
        }
    } else {
        $uploadImage3 = $oldImage2;
    }
        $getCategory = mysqli_query($conn, "SELECT * FROM category WHERE category_name= '" . $Enter_category . "' && status = 1");
        $res  = mysqli_num_rows($getCategory);
        if ($res >= 1) {
            showToast('Warning', 'Category Already Exists', icon: 'warning');
        } else {
            $addCategory = mysqli_query($conn, "INSERT into category set category_name='" . $Enter_category . "',category_image='" . $uploadImage . "',alt_text='" . $Alt_text . "',offer='".$offer."',banner_image='" . $uploadImage3 . "',alt_text2='".$Alt_text2."',created_by='" . $_SESSION['Adminname'] . "',updated_by=0,created_At ='" . $dateFormat . "',updated_At=0,status=1");
            if ($addCategory === true) {
                showToast('Success', 'Details added successfully', 'success');
                echo "<script>setTimeout(()=>{location.href='category.php'
                },'1000');</script>";
                exit();
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
    $offer = mysqli_real_escape_string($conn, $_POST['offer']);
    $image = $_FILES['CategoryImage'];
    $image2 = $_FILES['bannerimage'];
    $Alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $Alt_text2 = mysqli_real_escape_string($conn, $_POST['alttext2']);
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldCategoryImage']);
    $oldImage2 = mysqli_real_escape_string($conn, $_POST['oldBannerimage']);

    $getId = mysqli_real_escape_string($conn, $_POST['categoryId']);
    $path = './Uploads/category/';
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
    if (isset($image2) && $image2['error'] === 0) {
        $uploadImage2 = validateImage($path, $image2);
        if ($uploadImage2 === false) {
            showToast('Error', 'Image Upload Failed', 'error');
        } else {
            unlink($path . $oldImage2);
        }
    } else {
        $uploadImage2 = $oldImage2;
    }
    $getCategory = mysqli_query($conn, "SELECT * FROM category WHERE category_name= '" . $Enter_category . "' && status = 1");
    $res  = mysqli_num_rows($getCategory);
    if ($res >= 2) {
        showToast('Warning', 'Category Already Exists', 'warning');
    } else {
        $editCategory = mysqli_query($conn, "UPDATE category set category_name='" . $Enter_category . "',category_image='" . $uploadImage . "',alt_text='" . $Alt_text . "',offer='".$offer."',banner_image='" . $uploadImage2 . "',alt_text2='".$Alt_text2."',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where category_id  ='" . $getId . "'");
        if ($editCategory === true) {
            showToast('Success', 'Updated Successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='category.php'
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
    $deleteCategory = mysqli_query($conn, "UPDATE category SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where category_id='" . $getId . "'");
    if ($deleteCategory === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='category.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Category', 'error');
        echo "<script>setTimeout(()=>{
            location.href='category.php'
        },'1000');</script>";
    }
}