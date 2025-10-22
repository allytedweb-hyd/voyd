<?php

require_once './includes/db.php';
include './utils/alerts.php';

function addPromocode()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $promo = mysqli_real_escape_string($conn, $_POST['promo']);

    $getMaterials = mysqli_query($conn, "SELECT * FROM promocode_master WHERE promocode= '" . $promo . "' && status = 1");
    $res  = mysqli_num_rows($getMaterials);

    if ($res >= 1) {
        showToast('Warning', 'Promo Code Already exists', 'warning');
    } else {

        $addMaterial = mysqli_query($conn, "INSERT into promocode_master set promocode='" . $promo . "',updated_by=0,created_at =0,status=1");

        if ($addMaterial === true) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='promocode.php'
            },'1000');</script>";
        } else {
            showToast('Error', 'Promo Code Added Failed', 'error');
        }
    }
}


function editPromocode()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $promo = mysqli_real_escape_string($conn, $_POST['promo']);
    $getId = mysqli_real_escape_string($conn, $_POST['promoId']);

    $getMaterials = mysqli_query($conn, "SELECT * FROM promocode_master WHERE promocode= '" . $promo . "' && status = 1");
    $res  = mysqli_num_rows($getMaterials);

    if ($res >= 2) {
        showToast('Warning', 'Promo Code Already exists', 'warning');
    } else {

        $editMaterial = mysqli_query($conn, "UPDATE promocode_master set promocode='" . $promo . "',updated_by='" . $_SESSION['Adminname'] . "',updated_at='" . $dateFormat . "',status=1 where promocode_id	='" . $getId . "'");

        if ($editMaterial === true) {
            showToast('Success', 'Updated Successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='promocode.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Failed to update Promo Code', 'error');
        }
    }
}

function deletePromocode($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteMaterial = mysqli_query($conn, "UPDATE promocode_master SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_at='" . $dateFormat . "'where promocode_id='" . $getId . "'");
    if ($deleteMaterial === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='promocode.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Promo Code', 'error');
        echo "<script>setTimeout(()=>{location.href='promocode.php'
        },'1000');</script>";
    }
}
