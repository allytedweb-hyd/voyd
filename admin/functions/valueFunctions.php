<?php

require_once './includes/db.php';
include './utils/alerts.php';

function addValues()
{

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Select_Product = mysqli_real_escape_string($conn, $_POST['productType']);
    $Select_Category = mysqli_real_escape_string($conn, $_POST['category']);
    $Select_Subcategory = mysqli_real_escape_string($conn, $_POST['subcategory']);
    $Select_Attributes = mysqli_real_escape_string($conn, $_POST['attribute']);
    $Enter_Values = mysqli_real_escape_string($conn, $_POST['values']);

    $getValues = mysqli_query($conn, 'SELECT * FROM value_master WHERE product="' . $Select_Product . '" &&  category = "' . $Select_Category . '"&&  subcategory = "' . $Select_Subcategory . '"&&  attributes = "' . $Select_Attributes . '"&&  enter_values = "' . $Enter_Values . '"  && status=1');
    $count = mysqli_num_rows($getValues);

    if ($count >= 1) {
        echo showToast('Warning', 'Values Already Exists', 'warning');
    } else {

        $addValues = mysqli_query($conn, "INSERT into value_master set product='" . $Select_Product . "',category='" . $Select_Category . "',subcategory='" . $Select_Subcategory . "',attributes='" . $Select_Attributes . "',enter_values='" . $Enter_Values . "',created_by='" . $_SESSION['Adminname'] . "',updated_by=0,created_At='" . $dateFormat . "',updated_At=0,status=1");

        if ($addValues === True) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='values.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Value Added Failed', 'error');
        }
    }
}

function editValues()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Select_Product = mysqli_real_escape_string($conn, $_POST['productType']);
    $Select_Category = mysqli_real_escape_string($conn, $_POST['category']);
    $Select_Subcategory = mysqli_real_escape_string($conn, $_POST['subcategory']);
    $Select_Attributes = mysqli_real_escape_string($conn, $_POST['attribute']);
    $Enter_Values = mysqli_real_escape_string($conn, $_POST['values']);
    $getId = mysqli_real_escape_string($conn, $_POST['valuesId']);

    $getValues = mysqli_query($conn, 'SELECT * From value_master WHERE product="' . $Select_Product . '" && category="' . $Select_Category . '" && subcategory="' . $Select_Subcategory . '" && attributes="' . $Select_Attributes . '" && enter_values="' . $Enter_Values . '" && status=1');
    $Count = mysqli_num_rows($getValues);

    if ($Count >= 2) {
        showToast('Warning', 'Values Already Exists', 'warning');
    } else {
        $editValues = mysqli_query($conn, "UPDATE value_master set product='" . $Select_Product . "',category='" . $Select_Category . "',subcategory='" . $Select_Subcategory . "',attributes='" . $Select_Attributes . "',enter_values='" . $Enter_Values . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where values_id='" . $getId . "'");

        if ($editValues === True) {
            showToast('Success', 'Updated Successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='values.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Value Updated Failed', 'error');
        }
    }
}

function deleteValues($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteVendor = mysqli_query($conn, "UPDATE value_master SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where values_id='" . $getId . "'");
    if ($deleteVendor === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='values.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Value', 'error');
        echo "<script>setTimeout(()=>{location.href='values.php'
        },'1000');</script>";
    }
}
