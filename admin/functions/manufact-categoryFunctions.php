<?php

require_once './includes/db.php';
include './utils/alerts.php';

function addCategory()
{
    "<script>alert('add function triggered')</script>";
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Select_Product = mysqli_real_escape_string($conn, $_POST['productType']);
    $Enter_category = mysqli_real_escape_string($conn, $_POST['category']);

    $getCategory = mysqli_query($conn, 'SELECT * FROM manufacturer_category WHERE select_product="' . $Select_Product . '" &&  category_name = "' . $Enter_category . '" && status=1');
    $count = mysqli_num_rows($getCategory);

    if ($count >= 1) {
        echo showToast('Warning', 'Category Already Exists', 'warning');
    } else {

        $addCategory = mysqli_query($conn, "INSERT into manufacturer_category set select_product='" . $Select_Product . "',category_name='" . $Enter_category . "',created_by='" . $_SESSION['admin_id'] . "',updated_by=0,created_At ='" . $dateFormat . "',updated_At=0,status=1");

        if ($addCategory === true) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='manufacturer-category.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Category Added Failed', 'error');
        }
    }
}


function editCategory()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Select_Product = mysqli_real_escape_string($conn, $_POST['productType']);
    $Enter_category = mysqli_real_escape_string($conn, $_POST['category']);
    $getId = mysqli_real_escape_string($conn, $_POST['categoryId']);

    $getCategory = mysqli_query($conn, 'SELECT * FROM manufacturer_category WHERE select_product="' . $Select_Product . '" &&  category_name = "' . $Enter_category . '" && status=1');
    $count = mysqli_num_rows($getCategory);

    if ($count >= 2) {
        echo showToast('Warning', 'Category Already Exists', 'warning');
    } else {
        $editCategory = mysqli_query($conn, "UPDATE manufacturer_category set select_product='" . $Select_Product . "',category_name='" . $Enter_category . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where mcategory_id	='" . $getId . "'");

        if ($editCategory === true) {
            showToast('Success', 'Updated Successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='manufacturer-category.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Failed to update Category', 'error');
        }
    }
}

function deleteCategory($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteCategory = mysqli_query($conn, "UPDATE manufacturer_category SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where mcategory_id='" . $getId . "'");
    if ($deleteCategory === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='manufacturer-category.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Category', 'error');
        echo "<script>setTimeout(()=>{location.href='manufacturer-category.php'
        },'1000');</script>";
    }
}