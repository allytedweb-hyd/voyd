<?php

// session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include './includes/db.php';

include './utils/alerts.php';
include './utils/imageValidation.php';

function addOngoingcard()
{
    global $conn;
    date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $main_heading = mysqli_real_escape_string($conn, $_POST['main_heading']);
    $sub_heading = mysqli_real_escape_string($conn, $_POST['sub_heading']);
    $img_alt_text = mysqli_real_escape_string($conn, $_POST['img_alt_text']);
    $offer = mysqli_real_escape_string($conn, $_POST['offer']);
    $promo = mysqli_real_escape_string($conn, $_POST['promo']);
    $image = $_FILES['image'];
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $path = './Uploads/ongoing/';
    // $uploadImage = validateImage($path, $image);

    // if ($uploadImage === false) {
    //     showToast('Error', 'Image Upload Failed', 'error');
    //     return;
    // }

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

    $getongoing = mysqli_query($conn, "SELECT * FROM ongoing_card WHERE status=1");
    $count = mysqli_num_rows($getongoing);

    if($count>0){

        showToast('Error', 'Offer Information Already Exists. Only One Record Is Allowed', 'error');
    }
    else{

    $sql = "INSERT INTO ongoing_card 
        (main_heading, sub_heading, image, img_alt_text, offer, promo, updated_by, created_at, updated_at, status)
        VALUES (
            '$main_heading', '$sub_heading', '$uploadImage', '$img_alt_text',
            '$offer', '$promo', 0,
            '$dateFormat', 0, 1
        )";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        showToast('Success', 'Details added successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='ongoingcard.php'},1000);</script>";
    } else {
        showToast('Error', 'On Going Card Add Failed', 'error');
    }
}

}


function editOngoingcard()
{
    global $conn;
    date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $id = mysqli_real_escape_string($conn, $_POST['ongoingcard_id']);
    $main_heading = mysqli_real_escape_string($conn, $_POST['main_heading']);
    $sub_heading = mysqli_real_escape_string($conn, $_POST['sub_heading']);
    $img_alt_text = mysqli_real_escape_string($conn, $_POST['img_alt_text']);
    $offer = mysqli_real_escape_string($conn, $_POST['offer']);
    $promo = mysqli_real_escape_string($conn, $_POST['promo']);
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $image = $_FILES['image'];
    $path = './Uploads/ongoing/';

    if (isset($image) && $image['error'] === 0) {
        $uploadImage = validateImage($path, $image);
        if ($uploadImage === false) {
            showToast('Error', 'Image Upload Failed', 'error');
            return;
        } else {
            if (file_exists($path . $oldImage)) {
                unlink($path . $oldImage);
            }
        }
    } else {
        $uploadImage = $oldImage;
    }

    $sql = "UPDATE ongoing_card SET 
        main_heading = '$main_heading',
        sub_heading = '$sub_heading',
        image = '$uploadImage',
        img_alt_text = '$img_alt_text',
        offer = '$offer',
        promo = '$promo',
        updated_by = '{$_SESSION['Adminname']}',
        updated_at = '$dateFormat',
        status = 1
        WHERE ongoingcard_id = '$id'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        showToast('Success', 'Updated Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='ongoingcard.php'},1000);</script>";
    } else {
        showToast('Error', 'Failed to update On Going Card', 'error');
    }
}


function deleteOngoingcard($id)
{
    global $conn;
    date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $sql = "UPDATE ongoing_card SET 
        status = 0,
        updated_by = '{$_SESSION['Adminname']}',
        updated_at = '$dateFormat'
        WHERE ongoingcard_id = '$id'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        showToast('Success', 'Deleted Successfully', 'success');
    } else {
        showToast('Error', 'Failed to delete On Going Card', 'error');
    }

    echo "<script>setTimeout(()=>{location.href='ongoingcard.php'},1000);</script>";
}


?>