<?php

require_once './includes/db.php';
include './utils/alerts.php';

function addAttributes()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Select_Product = mysqli_real_escape_string($conn, $_POST['productType']);
    $Select_category = mysqli_real_escape_string($conn, $_POST['category']);
    $select_Subcategory = mysqli_real_escape_string($conn, $_POST['subcategory']);
    $Enter_attributes = mysqli_real_escape_string($conn, $_POST['attribute']);

    $getAttributes = mysqli_query($conn, 'SELECT * FROM attributes WHERE product_type="' . $Select_Product . '" &&  category = "' . $Select_category . '"&&  sub_category = "' . $select_Subcategory . '"&&  attributes = "' . $Enter_attributes . '"  && status=1');
    $count = mysqli_num_rows($getAttributes);

    if ($count >= 1) {
        echo showToast('Warning', 'Attributes Already Exists', 'warning');
    } else {

        $addAttributes = mysqli_query($conn, "INSERT into attributes set product_type='" . $Select_Product . "',category='" . $Select_category . "',sub_category='" . $select_Subcategory . "',attributes='" . $Enter_attributes . "',created_by='" . $_SESSION['admin_id'] . "',updated_by=0,created_At ='" . $dateFormat . "',updated_At=0,status=1");

        if ($addAttributes === true) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='attributes.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Attributes Added Failed', 'error');
        }
    }
}


function editAttributes()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Select_Product = mysqli_real_escape_string($conn, $_POST['productType']);
    $Select_category = mysqli_real_escape_string($conn, $_POST['category']);
    $select_Subcategory = mysqli_real_escape_string($conn, $_POST['subcategory']);
    $Enter_attributes = mysqli_real_escape_string($conn, $_POST['attribute']);
    $getId = mysqli_real_escape_string($conn, $_POST['attributesId']);

    $getAttributes = mysqli_query($conn, 'SELECT * FROM attributes WHERE product_type="' . $Select_Product . '" &&  category = "' . $Select_category . '"&&  sub_category = "' . $select_Subcategory . '"&&  attributes = "' . $Enter_attributes . '"  && status=1');
    $count = mysqli_num_rows($getAttributes);

    if ($count >= 1) {
        echo showToast('Warning', 'Attributes Already Exists', 'warning');
    } else {

        $editAttributes = mysqli_query($conn, "UPDATE attributes set product_type='" . $Select_Product . "',category='" . $Select_category . "',sub_category='" . $select_Subcategory . "',attributes='" . $Enter_attributes . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where attribute_id='" . $getId . "'");

        if ($editAttributes === true) {
            showToast('Success', 'Updated Successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='attributes.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Failed to Update Attributes', 'error');
        }
    }
}

function deleteAttributes($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteAttributes = mysqli_query($conn, "UPDATE attributes SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where attribute_id='" . $getId . "'");
    if ($deleteAttributes === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='attributes.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Attributes', 'error');
        echo "<script>setTimeout(()=>{location.href='attributes.php'
        },'1000');</script>";
    }
}
