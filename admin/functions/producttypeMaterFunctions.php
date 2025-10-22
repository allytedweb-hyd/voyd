<?php

require_once './includes/db.php';
include './utils/alerts.php';

function addProducttypemaster()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $producttype = mysqli_real_escape_string($conn, $_POST['producttype']);
    $product = mysqli_real_escape_string($conn, $_POST['product']);

    $getMaterials = mysqli_query($conn, "SELECT * FROM product_type_master 
                   WHERE product_type = '$producttype' 
                   AND product = '$product' 
                   AND status = 1");
    $res  = mysqli_num_rows($getMaterials);

    if ($res >= 1) {
        showToast('Warning', 'Product Type Already exists', 'warning');
    } else {

        $addMaterial = mysqli_query($conn, "INSERT into product_type_master set product_type='" . $producttype . "',product='".$product."',updated_by=0,created_at =0,status=1");

        if ($addMaterial === true) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='producttypemaster.php'
            },'1000');</script>";
        } else {
            showToast('Error', 'Product Type Added Failed', 'error');
        }
    }
}


function editProducttypemaster()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $producttype = mysqli_real_escape_string($conn, $_POST['producttype']);
    $product = mysqli_real_escape_string($conn, $_POST['product']);
    $getId = mysqli_real_escape_string($conn, $_POST['materialId']);

    $getMaterials = mysqli_query($conn, "SELECT * FROM product_type_master 
                   WHERE product_type = '$producttype' 
                   AND product = '$product' 
                   AND status = 1");
    $res  = mysqli_num_rows($getMaterials);

    if ($res >= 2) {
        showToast('Warning', 'Product Already exists', 'warning');
    } else {

        $editMaterial = mysqli_query($conn, "UPDATE product_type_master set product_type='" . $producttype . "',product='".$product."',updated_by='" . $_SESSION['Adminname'] . "',updated_at='" . $dateFormat . "',status=1 where product_type_id	='" . $getId . "'");

        if ($editMaterial === true) {
            showToast('Success', 'Updated Successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='producttypemaster.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Failed to update Product Type' , 'error');
        }
    }
}

// function deleteProducttypemaster($id)
// {
//     $getId = $id;

//     global $conn;

//     $date = date_default_timezone_set('Asia/Kolkata');
//     $dateFormat = date('Y-m-d H:i:s');

//     $deleteMaterial = mysqli_query($conn, "UPDATE product_type_master SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_at='" . $dateFormat . "'where product_type_id='" . $getId . "'");
//     if ($deleteMaterial === true) {
//         showToast('Success', 'Deleted Successfully', 'success');
//         echo "<script>setTimeout(()=>{location.href='producttypemaster.php'
//         },'1000');</script>";
//     } else {
//         showToast('Error', 'Failed to delete Product Type', 'error');
//         echo "<script>setTimeout(()=>{location.href='producttypemaster.php'
//         },'1000');</script>";
//     }
// }


function deleteProducttypemaster($id)
{
    global $conn;
    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

  
    $typeQuery = mysqli_query($conn, "SELECT product_type FROM product_type_master WHERE product_type_id = '$id'");
    $row = mysqli_fetch_assoc($typeQuery);
    $productType = $row['product_type'];

   
    mysqli_query($conn, "UPDATE subtype_master SET status = 0, updated_by='" . $_SESSION['admin_id'] . "', updated_at = '$dateFormat' WHERE product_type = '$productType'");

    
    $deleteMaterial = mysqli_query($conn, "UPDATE product_type_master SET status = 0, updated_by='" . $_SESSION['admin_id'] . "', updated_at = '$dateFormat' WHERE product_type_id = '$id'");

    if ($deleteMaterial === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='producttypemaster.php'}, 1000);</script>";
    } else {
        showToast('Error', 'Failed to delete Product Type', 'error');
        echo "<script>setTimeout(()=>{location.href='producttypemaster.php'}, 1000);</script>";
    }
}



