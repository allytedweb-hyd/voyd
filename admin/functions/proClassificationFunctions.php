<?php

require_once './includes/db.php';
include './utils/alerts.php';
include './utils/imageValidation.php';

function addClassification()
{
    "<script>alert('add function triggered')</script>";
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Enter_Classification = mysqli_real_escape_string($conn, $_POST['classification']);
    $image = $_FILES['icon'];
    $path = './Uploads/classifications/';

      $uploadImage = validateImage($path, $image);
    if ($uploadImage === false) {
        showToast('Error', 'Image Upload Failed', 'error');
    } else {

    $getProduct = mysqli_query($conn, "SELECT * FROM classification WHERE classification= '" . $Enter_Classification . "' && status = 1");
    $res  = mysqli_num_rows($getProduct);



    if ($res >= 1) {
        showToast('Warning', 'CLassification Already exists', 'warning');
    } else {

        $addClassification = mysqli_query($conn, "INSERT into classification set classification='" . $Enter_Classification . "',icon= '" . $uploadImage . "',created_by='" . $_SESSION['admin_id'] . "',updated_by=0,created_At ='" . $dateFormat . "',updated_At=0,status=1");

        if ($addClassification === true) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='productClassification.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'CLassification Added Failed', 'error');
        }
    }
}
}

function editClassification()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Enter_Classification = mysqli_real_escape_string($conn, $_POST['classification']);
    $getId = mysqli_real_escape_string($conn, $_POST['classificationId']);
     $image = $_FILES['icon'];
     $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);

     $path = './Uploads/classifications/';

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

    $getProduct = mysqli_query($conn, "SELECT * FROM classification WHERE classification= '" . $Enter_Classification . "' && status = 1");
    $res  = mysqli_num_rows($getProduct);

    if ($res >= 2) {
        showToast('Warning', 'CLassification Already exists', 'warning');
    } else {

        $editClassification = mysqli_query($conn, "UPDATE classification set classification='" . $Enter_Classification . "',icon= '" . $uploadImage . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where classification_id	='" . $getId . "'");

        if ($editClassification === true) {
            showToast('Success', 'Updated Successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='productClassification.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Failed to update Category', 'error');
        }
    }
}

function deleteClassification($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteClassification = mysqli_query($conn, "UPDATE classification SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where classification_id='" . $getId . "'");
    if ($deleteClassification === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='productClassification.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Classification', 'error');
        echo "<script>setTimeout(()=>{location.href='productClassification.php'
        },'1000');</script>";
    }
}
