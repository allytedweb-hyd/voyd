<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include './includes/db.php';
include './utils/alerts.php';
include './utils/imageValidation.php';


function addAbout()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $founderName = mysqli_real_escape_string($conn, $_POST['founderName']);
    $founderImageAlt = mysqli_real_escape_string($conn, $_POST['founderImageAlt']);
    $Description = mysqli_real_escape_string($conn, $_POST['description']);
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);

    $getQuery = mysqli_query($conn, "SELECT * FROM aboutus WHERE  status=1");
    $count = mysqli_num_rows($getQuery);
    $result = mysqli_fetch_array($getQuery);

    $path = './Uploads/aboutus/';
    $image = $_FILES['founderImage'];
    // $uploadImage = validateImage($path, $founderImage);
    if ($count > 0) {
        showToast('Warning', 'Founder data already exists, please update instead', 'warning');
    } else {
        // if ($uploadImage === false) {
        //     showToast('Error', 'Image upload failed', 'error');
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

            $addAbout = mysqli_query($conn, "INSERT into aboutus set founder_name='" . $founderName . "', founder_image='" . $uploadImage . "',founder_img_alttext='" . $founderImageAlt . "', founder_description='" . $Description . "',created_by='" . $_SESSION['admin_id'] . "',updated_by='" . $_SESSION['Adminname'] . "',created_At='" . $dateFormat . "',updated_At='" . $dateFormat . "',status=1");

            if ($addAbout === true) {
                showToast('Success', 'Details added successfully', 'success');
                echo "<script>setTimeout(()=>{location.href='aboutus.php'
            },'1000');</script>";
            } else {
                showToast('Error', 'About Added Failed', 'error');
            }
        }
    }


function editAbout()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $founderName = mysqli_real_escape_string($conn, $_POST['founderName']);
    $founderImageAlt = mysqli_real_escape_string($conn, $_POST['founderImageAlt']);
    $Description = mysqli_real_escape_string($conn, $_POST['description']);
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $getId = mysqli_real_escape_string($conn, $_POST['aboutId']);
    $image = $_FILES['founderImage'];
    $path = './Uploads/aboutus/';


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

    // $getQuery = mysqli_query($conn, "SELECT * FROM aboutus WHERE founder_description='" . $Description . "' && status=1");
    // $result = mysqli_fetch_array($getQuery);
    // if ($result['founder_description'] >= 1) {
    //     showToast('Warning', 'you cannot enter content of same category multiple times', 'warning');
    // } else {
        $editAbout = mysqli_query($conn, "UPDATE aboutus set founder_description='" . $Description . "',founder_name='" . $founderName . "', founder_image='" . $uploadImage . "',founder_img_alttext='" . $founderImageAlt . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where about_id='" . $getId . "'");

        if ($editAbout === true) {
            showToast('Success', 'Updated Successfully', 'success');
            echo "<script>setTimeout(()=>{
            location.href='aboutus.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Failed to update Aboutus', 'error');
        }
    // }
}

function deleteAbout($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteAbout = mysqli_query($conn, "UPDATE aboutus SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where about_id='" . $getId . "'");
    if ($deleteAbout === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{
            location.href='aboutus.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete About', 'error');
        echo "<script>setTimeout(()=>{
            location.href='aboutus.php'
        },'1000');</script>";
    }
}
