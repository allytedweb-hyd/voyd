<?php

use function GuzzleHttp\default_ca_bundle;

require_once './includes/db.php';
include './utils/alerts.php';

function addProductType()
{

    global $conn;

    $date = date_default_timezone_set('Asia/kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Enter_productType = mysqli_real_escape_string($conn, $_POST['ProductType']);

    $getProduct = mysqli_query($conn, "SELECT * FROM product_type WHERE enter_productType= '" . $Enter_productType . "' && status = 1");
    $res  = mysqli_num_rows($getProduct);

    if ($res >= 1) {
        showToast('Warning', 'Product Type Already Exists', 'warning');
    } else {

        $addProductType = mysqli_query($conn, "INSERT into product_type set enter_productType='" . $Enter_productType . "',created_by='" . $_SESSION['admin_id'] . "',updated_by=0,created_At ='" . $dateFormat . "',updated_At=0,status=1");

        if ($addProductType === True) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='product-type.php'
        },'1000');</script>";
        } else {
            showToast('Failed', 'product Type Added Failed', 'error');
        }
    }
}


function editProductType()
{

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Enter_productType = mysqli_real_escape_string($conn, $_POST['ProductType']);
    $getId = mysqli_real_escape_string($conn, $_POST['product-typeId']);

    $getProduct = mysqli_query($conn, "SELECT * FROM product_type WHERE enter_productType= '" . $Enter_productType . "' && status = 1");
    $res  = mysqli_num_rows($getProduct);

    if ($res >= 2) {
        showToast('Warning', 'Product Type Already Exists', 'warning');
    } else {

        $editProductType = mysqli_query($conn, "UPDATE product_type set enter_productType='" . $Enter_productType . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where productType_id	='" . $getId . "'");

        if ($editProductType === True) {
            showToast('Success', 'Updated Successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='product-type.php'
        },'1000');</script>";
        } else {
            showToast('Failed', 'Failed To Update Product Type', 'error');
        }
    }
}


function deleteProductType($id)
{

    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteProductType = mysqli_query($conn, "UPDATE product_type set status=0, updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where productType_id='" . $getId . "'");

    if ($deleteProductType === True) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='product-type.php'
        },'1000');</script>";
    } else {
        showToast('Failed', 'Failed To Delete Product Type', 'error');
        echo "<script>setTimeout(()=>{location.href='product-type.php'
        },'1000');</script>";
    }
}
