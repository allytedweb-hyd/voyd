<?php

require_once './includes/db.php';
include './utils/alerts.php';
include './utils/imageValidation.php';

function addSubCategory()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Select_category = mysqli_real_escape_string($conn, $_POST['category']);
    $Enter_subCategory = mysqli_real_escape_string($conn, $_POST['subcategory']);
    $image = $_FILES['Image'];
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $Alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $path = './Uploads/subcategory/';
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


        $getSubcategory = mysqli_query($conn, "SELECT * FROM subcategory WHERE category='".$Select_category."' && sub_category= '" . $Enter_subCategory . "' && status = 1");
        $res  = mysqli_num_rows($getSubcategory);

        if ($res > 0) {
            showToast('Warning', 'Sub-Category Already Exists', 'warning');
        } else {


            $addSubCategory = mysqli_query($conn, "INSERT into subcategory set category='" . $Select_category . "',sub_category='" . $Enter_subCategory . "',scategory_image='" . $uploadImage . "',alt_text='" . $Alt_text . "',created_by='" . $_SESSION['admin_id'] . "',updated_by=0,created_At ='" . $dateFormat . "',updated_At=0,status=1");

            if ($addSubCategory === true) {
                showToast('Success', 'Details added successfully', 'success');
                echo "<script>setTimeout(()=>{location.href='subcategory.php'
                },'1000');</script>";
            } else {
                showToast('Error', 'Sub-Category Added Failed', 'error');
            }
        }
    }



function editSubCategory()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Select_category = mysqli_real_escape_string($conn, $_POST['category']);
    $Enter_subCategory = mysqli_real_escape_string($conn, $_POST['subcategory']);
    $image = $_FILES['Image'];
    $Alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $getId = mysqli_real_escape_string($conn, $_POST['subcategoryId']);
    $path = './Uploads/subcategory/';

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

    $getSubcategory = mysqli_query($conn, "SELECT * FROM subcategory WHERE category='".$Select_category."' && sub_category= '" . $Enter_subCategory . "' && status = 1");
    $res  = mysqli_num_rows($getSubcategory);

    if ($res > 1) {
        showToast('Warning', 'Sub-Category Already Exists', 'warning');
    } else {

        $editSubCategory = mysqli_query($conn, "UPDATE subcategory set category='" . $Select_category . "',sub_category='" . $Enter_subCategory . "',scategory_image='" . $uploadImage . "',alt_text='" . $Alt_text . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where subcategory_id	='" . $getId . "'");

        if ($editSubCategory === true) {
            showToast('Success', 'Updated Successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='subcategory.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Failed to update Sub-Category', 'error');
        }
    }
}

function deleteSubCategory($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteSubCategory = mysqli_query($conn, "UPDATE subcategory SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where subcategory_id='" . $getId . "'");
    if ($deleteSubCategory === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='subcategory.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Sub-Category', 'error');
        echo "<script>setTimeout(()=>{location.href='subcategory.php'
        },'1000');</script>";
    }
}
