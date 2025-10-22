<?php

// session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include './includes/db.php';

include './utils/alerts.php';
include './utils/imageValidation.php';

function addVendortestimonial()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Name = mysqli_real_escape_string($conn, $_POST['name']);
    $testimonial_name = mysqli_real_escape_string($conn, $_POST['testimonial_name']);
   
    $image = $_FILES['image'];
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    
    $Description = mysqli_real_escape_string($conn, $_POST['description']);
    $path = './Uploads/vendortestimonials/';
    // $uploadImage = validateImage($path, $image);
    // if ($uploadImage === false) {
    //     showToast('Error', 'Image Upload Failed', 'error');
    // } else {.

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

        $addBanners = mysqli_query($conn, "INSERT into vendor_testimonials set name='" . $Name . "',testimonial_name='" . $testimonial_name . "',image='" . $uploadImage . "',content='" . $Description . "',updated_by=0,created_at='" . $dateFormat . "',updated_at=0,status=1");

        if ($addBanners === true) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='vendor_testimonials.php'
            },'1000');</script>";
        } else {
            showToast('Error', 'Testimonial Added Failed', 'error');
        }
    }


function editVendortestimonial()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Name = mysqli_real_escape_string($conn, $_POST['name']);
     $testimonial_name = mysqli_real_escape_string($conn, $_POST['testimonial_name']);
    
    $image = $_FILES['image'];
   
    $Description = mysqli_real_escape_string($conn, $_POST['description']);
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $getId = mysqli_real_escape_string($conn, $_POST['blogId']);
    $path = './Uploads/vendortestimonials/';


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


    $editBlog = mysqli_query($conn, "UPDATE vendor_testimonials set name='" . $Name . "',testimonial_name='" . $testimonial_name . "',image='" . $uploadImage . "',content='" . $Description . "',updated_by='" . $_SESSION['Adminname'] . "',updated_at='" . $dateFormat . "',status=1 where vendor_testimonial_id='" . $getId . "'");

    if ($editBlog === true) {
        showToast('Success', 'Updated Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='vendor_testimonials.php'
        },'1000');</script>";   
     } else {
        showToast('Error', 'Failed to update Testimonial', 'error');
    }
}

function deleteVendortestimonial($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');
   
    $deleteBlog = mysqli_query($conn, "UPDATE vendor_testimonials SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_at='" . $dateFormat . "'where vendor_testimonial_id='" . $getId . "'");
    if ($deleteBlog === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='vendor_testimonials.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Testimonial', 'error');
        echo "<script>setTimeout(()=>{
            location.href='vendor_testimonials.php'
        },'1000');</script>";
    }
}

?>