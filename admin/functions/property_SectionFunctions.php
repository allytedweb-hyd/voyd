<?php

require_once './includes/db.php';
include './utils/alerts.php';
include './utils/imageValidation.php';


function addPropertySection()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    // $Select_property = mysqli_real_escape_string($conn, $_POST['property']);
    // $select_PropertType = mysqli_real_escape_string($conn, $_POST['propertyType']);
    $Enter_PropertSection = mysqli_real_escape_string($conn, $_POST['propertySection']);
    $alt_text = mysqli_real_escape_string($conn, $_POST['alt_text']);
    $image = $_FILES['image'];
    $path = './Uploads/propertyblock/';

    $uploadImage = validateImage($path, $image);
    if ($uploadImage === false) {
        showToast('Error', 'Image Upload Failed', 'error');
        return;
    }

    $getProperty = mysqli_query($conn, 'SELECT * FROM property_sections WHERE enter_section="' . $Enter_PropertSection . '" && status=1 ');
    $count = mysqli_num_rows($getProperty);


    if ($count >= 1) {

        echo showToast('Warning', 'Property Block Already Exists', 'warning');
    } else {

        $addPropertySection = mysqli_query($conn, "INSERT into property_sections set alt_text='".$alt_text."',image='".$uploadImage."',enter_section='" . $Enter_PropertSection . "',created_by='" . $_SESSION['admin_id'] . "',updated_by=0,created_At ='" . $dateFormat . "',updated_At=0,status=1");

        if ($addPropertySection === true) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='propertySections.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Property Blocks Added Failed', 'error');
        }
    }
}



function editPropertySection()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    // $Select_property = mysqli_real_escape_string($conn, $_POST['property']);
    // $select_PropertType = mysqli_real_escape_string($conn, $_POST['propertyType']);
    $Enter_PropertSection = mysqli_real_escape_string($conn, $_POST['propertySection']);
    $getId = mysqli_real_escape_string($conn, $_POST['propertySectionId']);
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $alt_text = mysqli_real_escape_string($conn, $_POST['alt_text']);
    $image = $_FILES['image'];

    $path = './Uploads/propertyblock/';


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

    $getProperty = mysqli_query($conn, 'SELECT * FROM property_sections WHERE enter_section="' . $Enter_PropertSection . '" && status=1 ');
    $count = mysqli_num_rows($getProperty);

    if ($count >= 2) {

        echo showToast('Warning', 'Property Block Already Exists', 'warning');
    } else {

        $editPropertySection = mysqli_query($conn, "UPDATE property_sections set alt_text='".$alt_text."',image='".$uploadImage."',enter_section='" . $Enter_PropertSection . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where section_id='" . $getId . "'");

        if ($editPropertySection === true) {
            showToast('Success', 'Updated Successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='propertySections.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Failed to update Property Blocks', 'error');
        }
    }
}

function deletePropertySection($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deletePropertySection = mysqli_query($conn, "UPDATE property_sections SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where section_id='" . $getId . "'");
    if ($deletePropertySection === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='propertySections.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Property Block', 'error');
        echo "<script>setTimeout(()=>{location.href='propertySections.php'
        },'1000');</script>";
    }
}
