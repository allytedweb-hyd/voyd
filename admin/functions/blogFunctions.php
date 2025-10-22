<?php

// session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include './includes/db.php';

include './utils/alerts.php';
include './utils/imageValidation.php';

function addBlog()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Blog_title = mysqli_real_escape_string($conn, $_POST['title']);
    $Date = mysqli_real_escape_string($conn, $_POST['date']);
    $comments = mysqli_real_escape_string($conn, $_POST['comments']);
    $link = mysqli_real_escape_string($conn, $_POST['link']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);

    $image = $_FILES['image'];
    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $Description = mysqli_real_escape_string($conn, $_POST['description']);
    $path = './Uploads/blog/';
    // $uploadImage = validateImage($path, $image);
    // if ($uploadImage === false) {
    //     $_SESSION['old_inputs'] = $_POST;
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


        $addBanners = mysqli_query($conn, "INSERT into blog set blog_title='" . $Blog_title . "',link='" . $link . "',blog_date='" . $Date . "',blog_image='" . $uploadImage . "',blog_alttext='" . $alt_text . "',comments='" . $comments . "',author='" . $author . "',blog_description='" . $Description . "',updated_by='" . $_SESSION['Adminname'] . "',created_At='" . $dateFormat . "',updated_At='" . $dateFormat . "',status=1");

        if ($addBanners === true) {
            unset($_SESSION['old_inputs']);
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='blog.php'
            },'1000');</script>";
        } else {
            $_SESSION['old_inputs'] = $_POST;
            showToast('Error', 'Blog Added Failed', 'error');
        }
    }


function editBlog()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Blog_title = mysqli_real_escape_string($conn, $_POST['title']);
    $Date = mysqli_real_escape_string($conn, $_POST['date']);
    $comments = mysqli_real_escape_string($conn, $_POST['comments']);
    $link = mysqli_real_escape_string($conn, $_POST['link']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $image = $_FILES['image'];
    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $Description = mysqli_real_escape_string($conn, $_POST['description']);
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $getId = mysqli_real_escape_string($conn, $_POST['blogId']);
    $path = './Uploads/blog/';


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


    $editBlog = mysqli_query($conn, "UPDATE blog set blog_title='" . $Blog_title . "',blog_date='" . $Date . "',link='" . $link . "',blog_image='" . $uploadImage . "',blog_alttext='" . $alt_text . "',comments='" . $comments . "',author='" . $author . "',blog_description='" . $Description . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "' where blog_id='" . $getId . "'");

    if ($editBlog === true) {
        showToast('Success', 'Updated Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='blog.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to update Blog', 'error');
    }
}

function deleteBlog($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteBlog = mysqli_query($conn, "UPDATE blog SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where blog_id='" . $getId . "'");
    if ($deleteBlog === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='blog.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Blog', 'error');
        echo "<script>setTimeout(()=>{
            location.href='blog.php'
        },'1000');</script>";
    }
}
