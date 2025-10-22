<?php
require_once './includes/db.php';
include './utils/alerts.php';
include './utils/imageValidation.php';

function addChooseus()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Choose_title = mysqli_real_escape_string($conn, $_POST['title']);
    $image = $_FILES['image'];
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $Description = mysqli_real_escape_string($conn, $_POST['description']);
    $path = './Uploads/whychooseUs/';
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



        $getChooseUs = mysqli_query($conn, "SELECT * FROM why_chooseUs WHERE status =1");
        $count = mysqli_num_rows($getChooseUs);

        if ($count < 4) {

            $addChooseus = mysqli_query($conn, "INSERT into why_chooseUs set choose_title='" . $Choose_title . "',choose_image	='" . $uploadImage . "',alt_text='" . $alt_text . "',description='" . $Description . "',created_by='" . $_SESSION['admin_id'] . "',updated_by=0,created_At='" . $dateFormat . "',updated_At=0,status=1");

            if ($addChooseus === true) {
                showToast('Success', 'Details added successfully', 'success');
                echo "<script>setTimeout(()=>{location.href='whyChooseus.php'
                },'1000');</script>";
            } else {
                showToast('Error', 'Added Failed Choose Us', 'error');
            }
        } else {

            showToast("Warning", "Only four are allowed", "warning");
        }
    }



function editChooseus()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Choose_title = mysqli_real_escape_string($conn, $_POST['title']);
    $image = $_FILES['image'];
    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $Description = mysqli_real_escape_string($conn, $_POST['description']);
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $getId = mysqli_real_escape_string($conn, $_POST['chooseId']);
    $path = './Uploads/whychooseUs/';


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


    $editChooseus = mysqli_query($conn, "UPDATE why_chooseUs set choose_title='" . $Choose_title . "',choose_image	='" . $uploadImage . "',alt_text='" . $alt_text . "',description='" . $Description . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where choose_id='" . $getId . "'");

    if ($editChooseus === true) {
        showToast('Success', 'Updated Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='whyChooseus.php'
        },'1000');</script>";
        } else {
        showToast('Error', 'Failed to update Choose Us', 'error');
    }
}

function deleteChooseus($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteChooseus = mysqli_query($conn, "UPDATE why_chooseUs SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where choose_id='" . $getId . "'");
    if ($deleteChooseus === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='whyChooseus.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Choose Us', 'error');
        echo "<script>setTimeout(()=>{
            location.href='whyChooseus.php'
        },'1000');</script>";
    }
}
