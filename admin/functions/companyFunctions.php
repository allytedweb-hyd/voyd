<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once './includes/db.php';
include './utils/alerts.php';
include './utils/imageValidation.php';

function addCompanies()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $image = $_FILES['image'];
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $path = './Uploads/companies/';
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



        $addCompanies = mysqli_query($conn, "INSERT into top_companies set company_image='" . $uploadImage . "',company_alttext='" . $alt_text . "',updated_by=0,updated_At=0,created_At='" . $dateFormat . "',status=1");

        if ($addCompanies === true) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='topcompanies.php'
            },'1000');</script>";
        } else {
            showToast('Error', 'Company Added Failed', 'error');
        }
    }



function editCompanies()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $image = $_FILES['image'];
    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $getId = mysqli_real_escape_string($conn, $_POST['companyId']);
    $path = './Uploads/companies/';


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


    $editCompanies = mysqli_query($conn, "UPDATE top_companies set company_image='" . $uploadImage . "',company_alttext='" . $alt_text . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where company_id='" . $getId . "'");

    if ($editCompanies === true) {
        showToast('Success', 'Updated Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='topcompanies.php'
        },'1000');</script>";
        } else {
        showToast('Error', 'Failed to update Company', 'error');
    }
}


function deleteCompanies($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');
   
    $deleteCompanies = mysqli_query($conn, "UPDATE top_companies SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where company_id='" . $getId . "'");
    if ($deleteCompanies === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='topcompanies.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Company', 'error');
        echo "<script>setTimeout(()=>{
            location.href='topcompanies.php'
        },'1000');</script>";
    }
}

?>