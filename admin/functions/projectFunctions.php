<?php
require_once './includes/db.php';
include './utils/alerts.php';
include './utils/imageValidation.php';

function addProjects()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Project_title = mysqli_real_escape_string($conn, $_POST['title']);
    $image = $_FILES['image'];
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $Description = mysqli_real_escape_string($conn, $_POST['description']);
    $path = './Uploads/projects/';
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



        $getProjects = mysqli_query($conn, "SELECT * FROM projects WHERE status=1");
        $count = mysqli_num_rows($getProjects);
        if ($count < 5) {

            $addProjects = mysqli_query($conn, "INSERT into projects set project_title='" . $Project_title . "',project_image	='" . $uploadImage . "',project_alttext='" . $alt_text . "',project_description='" . $Description . "',created_by='" . $_SESSION['admin_id'] . "',updated_by=0,created_At='" . $dateFormat . "',updated_At=0,status=1");

            if ($addProjects === true) {
                showToast('Success', 'Details added successfully', 'success');
                echo "<script>setTimeout(()=>{location.href='projects.php'
                },'1000');</script>";
            } else {
                showToast('Error', 'Projects Added Failed', 'error');
            }
        } else {
            showToast('Warning', 'Only 5 Images are allowed', 'warning');
        }
    }



function editProjects()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Project_title = mysqli_real_escape_string($conn, $_POST['title']);
    $image = $_FILES['image'];
    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $Description = mysqli_real_escape_string($conn, $_POST['description']);
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $getId = mysqli_real_escape_string($conn, $_POST['projectId']);
    $path = './Uploads/projects/';


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


    $editProjects = mysqli_query($conn, "UPDATE projects set project_title='" . $Project_title . "',project_image	='" . $uploadImage . "',project_alttext='" . $alt_text . "',project_description='" . $Description . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where project_id='" . $getId . "'");

    if ($editProjects === true) {
        showToast('Success', 'Updated Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='projects.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to update Projects', 'error');
    }
}

function deleteProject($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteProject = mysqli_query($conn, "UPDATE projects SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where project_id='" . $getId . "'");
    if ($deleteProject === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='projects.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Project', 'error');
        echo "<script>setTimeout(()=>{location.href='projects.php'
        },'1000');</script>";
    }
}
