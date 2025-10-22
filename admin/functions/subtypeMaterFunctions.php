<?php

require_once './includes/db.php';
include './utils/alerts.php';

function addSubtypemaster()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $subtype = mysqli_real_escape_string($conn, $_POST['subtype']);
    $product = mysqli_real_escape_string($conn, $_POST['product']);
    $producttype = mysqli_real_escape_string($conn, $_POST['producttype']);
    $recommend = mysqli_real_escape_string($conn, $_POST['recommend']);
    $strongly_recommend = mysqli_real_escape_string($conn, $_POST['strongly_recommend']);

    $getMaterials = mysqli_query($conn, "SELECT * FROM subtype_master 
                   WHERE sub_type = '$subtype' 
                   AND product_type = '$producttype' 
                   AND status = 1");
    $res  = mysqli_num_rows($getMaterials);

    if ($res >= 1) {
        showToast('Warning', 'Sub Type Already exists', 'warning');
    } else {

        $addMaterial = mysqli_query($conn, "INSERT into subtype_master set sub_type='" . $subtype . "',product='" . $product . "',product_type='".$producttype."',recommend='".$recommend."',updated_by=0,created_at =0,status=1");

        if ($addMaterial === true) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='subtypemaster.php'
            },'1000');</script>";
        } else {
            showToast('Error', 'Sub Type Added Failed', 'error');
        }
    }
}


function editSubtypemaster()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $subtype = mysqli_real_escape_string($conn, $_POST['subtype']);
    $product = mysqli_real_escape_string($conn, $_POST['product']);
    $producttype = mysqli_real_escape_string($conn, $_POST['producttype']);
    $recommend = mysqli_real_escape_string($conn, $_POST['recommend']);
    $strongly_recommend = mysqli_real_escape_string($conn, $_POST['strongly_recommend']);
    $getId = mysqli_real_escape_string($conn, $_POST['materialId']);

    $getMaterials = mysqli_query($conn, "SELECT * FROM subtype_master 
                   WHERE sub_type = '$subtype' 
                   AND product_type = '$producttype' 
                   AND status = 1");
    $res  = mysqli_num_rows($getMaterials);

    if ($res >= 2) {
        showToast('Warning', 'Sub Type Already exists', 'warning');
    } else {

        $editMaterial = mysqli_query($conn, "UPDATE subtype_master set sub_type='" . $subtype . "',product='" . $product . "',product_type='".$producttype."',recommend='".$recommend."',updated_by='" . $_SESSION['Adminname'] . "',updated_at='" . $dateFormat . "',status=1 where subtype_id	='" . $getId . "'");

        if ($editMaterial === true) {
            showToast('Success', 'Updated Successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='subtypemaster.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Failed to update Sub Type' , 'error');
        }
    }
}

function deleteSubtypemaster($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteMaterial = mysqli_query($conn, "UPDATE subtype_master SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_at='" . $dateFormat . "'where subtype_id='" . $getId . "'");
    if ($deleteMaterial === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='subtypemaster.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Sub Type', 'error');
        echo "<script>setTimeout(()=>{location.href='subtypemaster.php'
        },'1000');</script>";
    }
}
