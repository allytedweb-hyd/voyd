<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once './includes/db.php';
include './utils/alerts.php';
include './utils/imageValidation.php';

function addBrands()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Brand_category = mysqli_real_escape_string($conn, $_POST['category']);
    $Brand_Title = mysqli_real_escape_string($conn, $_POST['title']);
    $image = $_FILES['image'];
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $path = './Uploads/brands/';
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




            $addBrands = mysqli_query($conn, "INSERT into brands set brand_category='" . $Brand_category . "',brand_title='" . $Brand_Title . "',brand_image='" . $uploadImage . "',brand_alttext='" . $alt_text . "',created_by='" . $_SESSION['Adminname'] . "',updated_by=0,created_At='" . $dateFormat . "',updated_At=0,status=1");

            if ($addBrands === true) {
                showToast('Success', 'Details added successfully', 'success');
                echo "<script>setTimeout(()=>{location.href='brands.php'
            },'1000');</script>";
            } else {
                showToast('Error', 'Brands Added Failed', 'error');
            }
        }
    



function editBrands()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Brand_category = mysqli_real_escape_string($conn, $_POST['category']);
    $Brand_Title = mysqli_real_escape_string($conn, $_POST['title']);
    $image = $_FILES['image'];
    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $getId = mysqli_real_escape_string($conn, $_POST['brandId']);
    $path = './Uploads/brands/';


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

    $getBrands = mysqli_query($conn, 'SELECT * FROM brands WHERE brand_category= "' . $Brand_category . '" && status = 1');
    $res  = mysqli_num_rows($getBrands);

    if ($res >= 2) {
        showToast('Warning', 'Brand Already Exists', 'warning');
    } else {


        $editBrands = mysqli_query($conn, "UPDATE brands set brand_category='" . $Brand_category . "',brand_title='" . $Brand_Title . "',brand_image='" . $uploadImage . "',brand_alttext='" . $alt_text . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where brand_id='" . $getId . "'");

        if ($editBrands === true) {
            showToast('Success', 'Updated Successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='brands.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Failed to update Brands', 'error');
        }
    }
}


function deleteBrands($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteBrands = mysqli_query($conn, "UPDATE brands SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where brand_id='" . $getId . "'");
    if ($deleteBrands === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='brands.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Brands', 'error');
        echo "<script>setTimeout(()=>{
            location.href='brands.php'
        },'1000');</script>";
    }
}
