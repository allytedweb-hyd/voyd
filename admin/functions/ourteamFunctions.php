<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include './includes/db.php';

include './utils/alerts.php';
include './utils/imageValidation.php';


function addOurteam() 
{
  
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Name = mysqli_real_escape_string($conn,$_POST['name']);
    $Designation = mysqli_real_escape_string($conn, $_POST['designation']);
    // $Facebook = mysqli_real_escape_string($conn, $_POST['facebook']);
    // $Twitter = mysqli_real_escape_string($conn, $_POST['twitter']);
    // $Instagram = mysqli_real_escape_string($conn, $_POST['instagram']);
    // $Mail = mysqli_real_escape_string($conn, $_POST['mail']);
    $image = $_FILES['image'];
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $alt_text = mysqli_real_escape_string($conn,$_POST['alttext']);
    $Description = mysqli_real_escape_string($conn, $_POST['description']);
    $path = './Uploads/ourteam/';
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


        $addOurteam = mysqli_query($conn, "INSERT into ourteam set ourteam_name='" . $Name . "',team_designation='" . $Designation . "',team_image='" . $uploadImage . "',team_alttext='" . $alt_text . "',team_description='" . $Description . "',created_by='" . $_SESSION['admin_id'] . "',updated_by=0,created_At='" . $dateFormat . "',updated_At=0,status=1");

        if ($addOurteam === true) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='ourteam.php'
            },'1000');</script>";
        } else {
            showToast('Error', 'Team Added Failed', 'error');
        }
    }



function editOurteam()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Name = mysqli_real_escape_string($conn,$_POST['name']);
    $Designation = mysqli_real_escape_string($conn, $_POST['designation']);
    // $Facebook = mysqli_real_escape_string($conn, $_POST['facebook']);
    // $Twitter = mysqli_real_escape_string($conn, $_POST['twitter']);
    // $Instagram = mysqli_real_escape_string($conn, $_POST['instagram']);
    // $Mail = mysqli_real_escape_string($conn, $_POST['mail']);
    $image = $_FILES['image'];
    $alt_text = mysqli_real_escape_string($conn,$_POST['alttext']);
    $Description = mysqli_real_escape_string($conn, $_POST['description']);
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $getId = mysqli_real_escape_string($conn, $_POST['teamId']);
    $path = './Uploads/ourteam/';


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


    $editOurteam = mysqli_query($conn, "UPDATE ourteam set ourteam_name='" . $Name . "',team_designation='" . $Designation . "',team_image='" . $uploadImage . "',team_alttext='" . $alt_text . "',team_description='" . $Description . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where ourteam_id='" . $getId . "'");

    if ($editOurteam === true) {
        showToast('Success', 'Updated Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='ourteam.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to update Team', 'error');
    }
}

function deleteOurteam($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');
   
    $deleteOurteam = mysqli_query($conn, "UPDATE ourteam SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where ourteam_id='" . $getId . "'");
    if ($deleteOurteam === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='ourteam.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Ourteam', 'error');
        echo "<script>setTimeout(()=>{location.href='ourteam.php'
        },'1000');</script>";
    }
}


?>