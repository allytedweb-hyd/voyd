<?php

require_once './includes/db.php';
include './utils/alerts.php';

function addBrand()
{
    "<script>alert('add function triggered')</script>";
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Enter_Brand = mysqli_real_escape_string($conn, $_POST['brand']);

    $getBrands = mysqli_query($conn, 'SELECT * FROM brand_master WHERE enter_brand= "' . $Enter_Brand . '" && status = 1');
    $res  = mysqli_num_rows($getBrands);

    if ($res >= 1) {
        showToast('Warning', 'Brand Already Exists', 'warning');
    } else {

        $addBrand = mysqli_query($conn, "INSERT into brand_master set enter_brand='" . $Enter_Brand . "',created_by='" . $_SESSION['admin_id'] . "',updated_by=0,created_At ='" . $dateFormat . "',updated_At=0,status=1");

        if ($addBrand === true) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='brandsmaster.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Brand Category Added Failed', 'error');
        }
    }
}


function editBrand()
{
    global $conn;

    $date = date_default_timezone_set(timezoneId: 'Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Enter_Brand = mysqli_real_escape_string($conn, $_POST['brand']);
    $getId = mysqli_real_escape_string($conn, $_POST['brandId']);

    $getBrands = mysqli_query($conn, 'SELECT * FROM brand_master WHERE enter_brand= "' . $Enter_Brand . '" && status = 1');
    $res  = mysqli_num_rows($getBrands);

    if ($res >= 2) {
        showToast('Warning', 'Brand Already Exists', 'warning');
    } else {
        $editBrand = mysqli_query($conn, "UPDATE brand_master set enter_brand='" . $Enter_Brand . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where brand_id	='" . $getId . "'");

        if ($editBrand === true) {
            showToast('Success', 'Updated Successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='brandsmaster.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Failed to update Brand Category', 'error');
        }
    }
}

function deleteBrand($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteBrand = mysqli_query($conn, "UPDATE brand_master SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where brand_id='" . $getId . "'");
    if ($deleteBrand === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='brandsmaster.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Brand Category', 'error');
        echo "<script>setTimeout(()=>{location.href='brandsmaster.php'
        },'1000');</script>";
    }
}
