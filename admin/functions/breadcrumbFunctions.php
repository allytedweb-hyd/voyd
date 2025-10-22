<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once './includes/db.php';
include './utils/alerts.php';
include './utils/imageValidation.php';

function addBreadcrumb()
{
    echo "<srcipt>alert('clicked')</srcipt>";
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $breadcrumbPage = mysqli_real_escape_string($conn, $_POST['breadcrumbPage']);
    $breadcrumbTitle = mysqli_real_escape_string($conn, $_POST['BreadcrumbTitle']);
    $image = $_FILES['BreadcrumbImage'];
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $path = './Uploads/breadcrumbs/';
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





        $getBreadcrumbData = mysqli_query($conn, "SELECT * FROM breadcrumbs WHERE status=1");
        $fetchData = mysqli_fetch_row($getBreadcrumbData);
        if ($fetchData['page_name'] >= 1) {
            showToast('Warning', 'Only one Banner is allowed for page, try again by edit option or by delete option and re-upload image ', 'warning');
        } else {

            $addBreadcrumbs = mysqli_query($conn, "INSERT into breadcrumbs set page_name='" . $breadcrumbPage . "',breadcrumb_title='" . $breadcrumbTitle . "',breadcrumb_image='" . $uploadImage . "',alt_text='" . $alt_text . "',created_by='" . $_SESSION['Adminname'] . "',updated_by=0,created_At='" . $dateFormat . "',updated_At=0,status=1");

            if ($addBreadcrumbs === true) {
                showToast('Success', 'Details added successfully', 'success');
                echo "<script>setTimeout(()=>{location.href='breadcrumb.php'
                },'1000');</script>";
            } else {
                showToast('Error', 'Failed To Add Breadcrumb', 'error');
            }
        }
    }



function editBreadcrumb()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $breadcrumbPage = mysqli_real_escape_string($conn, $_POST['breadcrumbPage']);
    $breadcrumbTitle = mysqli_real_escape_string($conn, $_POST['BreadcrumbTitle']);
    $image = $_FILES['BreadcrumbImage'];
    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $getId = mysqli_real_escape_string($conn, $_POST['breadcrumbId']);
    $path = './Uploads/breadcrumbs/';


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


    $editBreadcrumb = mysqli_query($conn, "UPDATE breadcrumbs set page_name='" . $breadcrumbPage . "',breadcrumb_title='" . $breadcrumbTitle . "',breadcrumb_image='" . $uploadImage . "',alt_text='" . $alt_text . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where breadcrumb_id='" . $getId . "'");

    if ($editBreadcrumb === true) {
        showToast('Success', 'Updated Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='breadcrumb.php'
        },'1000');</script>";
        } else {
        showToast('Error', 'Failed to update Breadcrumb', 'error');
    }
}


function deleteBreadcrumb($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteBreadcrumb = mysqli_query($conn, "UPDATE breadcrumbs SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where brand_id='" . $getId . "'");
    if ($deleteBreadcrumb === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='breadcrumb.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete', 'error');
        echo "<script>setTimeout(()=>{
            location.href='breadcrumb.php'
        },'1000');</script>";
    }
}
