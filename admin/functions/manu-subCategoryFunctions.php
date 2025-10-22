<?php

require_once './includes/db.php';
include './utils/alerts.php';

function addSubCategory()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Select_Product = mysqli_real_escape_string($conn, $_POST['productType']);
    $Select_category = mysqli_real_escape_string($conn, $_POST['category']);
    $Enter_subCategory = mysqli_real_escape_string($conn, $_POST['subcategory']);

    $getSubcategory = mysqli_query($conn, 'SELECT * FROM manufacturer_subCategory WHERE select_product="' . $Select_Product . '" &&  select_category = "' . $Select_category . '"&&  sub_category = "' . $Enter_subCategory . '" && status=1');
    $count = mysqli_num_rows($getSubcategory);

    if ($count >= 1) {
        echo showToast('Warning', 'Sub Category Already Exists', 'warning');
    } else {

        $addSubCategory = mysqli_query($conn, "INSERT into manufacturer_subCategory set select_product='" . $Select_Product . "',select_category='" . $Select_category . "',sub_category='" . $Enter_subCategory . "',created_by='" . $_SESSION['admin_id'] . "',updated_by=0,created_At ='" . $dateFormat . "',updated_At=0,status=1");

        if ($addSubCategory === true) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='manufacturerSubCategory.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Sub-Category Added Failed', 'error');
        }
    }
}


function editSubCategory()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Select_Product = mysqli_real_escape_string($conn, $_POST['productType']);
    $Select_category = mysqli_real_escape_string($conn, $_POST['category']);
    $Enter_subCategory = mysqli_real_escape_string($conn, $_POST['subcategory']);
    $getId = mysqli_real_escape_string($conn, $_POST['subcategoryId']);

    $getSubcategory = mysqli_query($conn, 'SELECT * FROM manufacturer_subCategory WHERE select_product="' . $Select_Product . '" &&  select_category = "' . $Select_category . '"&&  sub_category = "' . $Enter_subCategory . '" && status=1');
    $count = mysqli_num_rows($getSubcategory);

    if ($count >= 1) {
        echo showToast('Warning', 'Sub Category Already Exists', 'warning');
    } else {

        $editSubCategory = mysqli_query($conn, "UPDATE manufacturer_subCategory set select_product='" . $Select_Product . "',select_category='" . $Select_category . "',sub_category='" . $Enter_subCategory . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where mSubcategory_id	='" . $getId . "'");

        if ($editSubCategory === true) {
            showToast('Success', 'Updated Successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='manufacturerSubCategory.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Failed to update Sub-Category', 'error');
        }
    }
}

function deleteSubCategory($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteSubCategory = mysqli_query($conn, "UPDATE manufacturer_subCategory SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where mSubcategory_id='" . $getId . "'");
    if ($deleteSubCategory === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='manufacturerSubCategory.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Sub-Category', 'error');
        echo "<script>setTimeout(()=>{location.href='manufacturerSubCategory.php'
        },'1000');</script>";
    }
}
