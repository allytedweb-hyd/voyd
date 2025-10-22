<?php
require_once './includes/db.php';
include './utils/alerts.php';
include './utils/imageValidation.php';

function addTestimonials()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Testimonial_Name = mysqli_real_escape_string($conn, $_POST['name']);
    $Designation = mysqli_real_escape_string($conn, $_POST['designation']);
    $image = $_FILES['image'];
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $Description = mysqli_real_escape_string($conn, $_POST['description']);
    $path = './Uploads/testimonials/';
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



        $addTestimonials = mysqli_query($conn, "INSERT into testimonials set testimonial_name='" . $Testimonial_Name . "',testimonial_image='" . $uploadImage . "',testimonial_alttext='" . $alt_text . "',rating	='" . $Designation . "',testimonial_description='" . $Description . "',created_by='" . $_SESSION['admin_id'] . "',updated_by=0,created_At='" . $dateFormat . "',updated_At=0,status=1");

        if ($addTestimonials === true) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='testimonials.php'
            },'1000');</script>";
        } else {
            showToast('Error', 'Testimonials Added Failed', 'error');
        }
    }


function editTestimonials()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Testimonial_Name = mysqli_real_escape_string($conn, $_POST['name']);
    $Designation = mysqli_real_escape_string($conn, $_POST['designation']);
    $image = $_FILES['image'];
    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $Description = mysqli_real_escape_string($conn, $_POST['description']);
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $getId = mysqli_real_escape_string($conn, $_POST['testimonialId']);
    $path = './Uploads/testimonials/';


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


    $editTestimonials = mysqli_query($conn, "UPDATE testimonials set testimonial_name='" . $Testimonial_Name . "',testimonial_image='" . $uploadImage . "',testimonial_alttext='" . $alt_text . "',rating	='" . $Designation . "',testimonial_description='" . $Description . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where testimonial_id='" . $getId . "'");

    if ($editTestimonials === true) {
        showToast('Success', 'Updated Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='testimonials.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to update Testimonials', 'error');
    }
}

function deleteTestimonial($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');
   
    $deleteTestimonial = mysqli_query($conn, "UPDATE testimonials SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where testimonial_id='" . $getId . "'");
    if ($deleteTestimonial === true) {
        showToast('Success', ' Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='testimonials.php'
        },'1500');</script>";
    } else {
        showToast('Error', 'Failed to delete Testimonial', 'error');
        echo "<script>setTimeout(()=>{location.href='testimonials.php'
        },'1000');</script>";
    }
}


?>
