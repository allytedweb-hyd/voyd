<?php

// session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include './includes/db.php';
include './utils/alerts.php';
include './utils/imageValidation.php';

function addGuide()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $image = $_FILES['image'];
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $pdf = $_FILES['pdf'];
    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $desc = mysqli_real_escape_string($conn, $_POST['desc']);
  
    $path = './Uploads/guides/';
    // $uploadImage = validateImage($path, $image);

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


    $uploadImage2 = validatePdf($path, $pdf);
    if ( $uploadImage2 === false) {
        showToast('Error', 'PDF Upload Failed', 'error');
    } else {

       

        $addGuide = mysqli_query($conn, "INSERT into guides set pdf='".$uploadImage2."',image='" . $uploadImage . "',title='".$title."',description='".$desc."',
        img_alt_text='" . $alt_text . "',updated_by=0,created_at='" . $dateFormat . "',updated_at=0,status=1");

        if ($addGuide === true) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='guides.php'
            },'1000');</script>";
        } else {
            showToast('Error', 'Guide Added Failed', 'error');
        }
    }
}


function editGuide()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

   $image = $_FILES['image'];
    $pdf = $_FILES['pdf'];
    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $desc = mysqli_real_escape_string($conn, $_POST['desc']);
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $oldImage2 = mysqli_real_escape_string($conn, $_POST['oldPdf']);

  

    $getId = mysqli_real_escape_string($conn, $_POST['galleryId']);
    $path = './Uploads/guides/';


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


      if (isset($pdf) && $pdf['error'] === 0) {
        $uploadImage2 = validatePdf($path, $pdf);
        if ($uploadImage2 === false) {
            showToast('Error', 'Image Upload Failed', 'error');
        } else {
            unlink($path . $oldImage2);
        }
    } else {
        $uploadImage2 = $oldImage2;
    }


    $editGallery = mysqli_query($conn, "UPDATE guides set pdf='".$uploadImage2."',image='" . $uploadImage . "',title='".$title."',description='".$desc."',
        img_alt_text='" . $alt_text . "',updated_by='" . $_SESSION['Adminname'] . "',updated_at='" . $dateFormat . "',status=1 where guide_id='" . $getId . "'");

    if ($editGallery === true) {
        showToast('Success', 'Updated Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='guides.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to update Guide', 'error');
    }
}

function deleteGuide($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteGuide = mysqli_query($conn, "UPDATE guides SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where guide_id='" . $getId . "'");
    if ($deleteGuide === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='guides.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Guide', 'error');
        echo "<script>setTimeout(()=>{location.href='guides.php'
        },'1000');</script>";
    }
}
