<?php

require_once './includes/db.php';
include './utils/alerts.php';
include './utils/imageValidation.php';





function addProduct()
{

    


    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $image = $_FILES['image'];
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $product = mysqli_real_escape_string($conn, $_POST['product']);
    $alt_text = mysqli_real_escape_string($conn, $_POST['alt_text']);

      $path = './Uploads/productmaster/';
      if (isset($image) && isset($image['tmp_name']) && is_uploaded_file($image['tmp_name'])) {
        $uploadImage = validateImage($path, $image);
    
        if ($uploadImage === false) {
            showToast('Error', 'Image Upload Failed', 'error');
            return; 
        } else {
            
            if (!empty($oldImage) && file_exists($path . $oldImage)) {
                unlink($path . $oldImage);
            }
        }
    } else {
        $uploadImage = $oldImage;
    }

        

    $getMaterials = mysqli_query($conn, "SELECT * FROM product_master WHERE product_master= '" . $product . "' && status = 1");
    $res  = mysqli_num_rows($getMaterials);

    if ($res >= 1) {
     
        showToast('Warning', 'Product Already exists', 'warning');
        return $uploadImage;
  
    } else {

        $addMaterial = mysqli_query($conn, "INSERT into product_master set product_master='" . $product . "', product_img='".$uploadImage."',alt_text='".$alt_text."',updated_by=0,created_at =0,status=1");

        if ($addMaterial === true) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='productmaster.php'
            },'1000');</script>";
        } else {
            showToast('Error', 'Product Added Failed', 'error');
        }
    }
}



function editProductmaster()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

     $image = $_FILES['image'];
    $product = mysqli_real_escape_string($conn, $_POST['product']);
    $alt_text = mysqli_real_escape_string($conn, $_POST['alt_text']);
    $getId = mysqli_real_escape_string($conn, $_POST['materialId']);
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
     $path = './Uploads/productmaster/';


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


    $getMaterials = mysqli_query($conn, "SELECT * FROM product_master WHERE product_master= '" . $product . "' && status = 1");
    $res  = mysqli_num_rows($getMaterials);

    if ($res >= 2) {
        showToast('Warning', 'Product Already exists', 'warning');
    } else {

        $editMaterial = mysqli_query($conn, "UPDATE product_master set product_master='" . $product . "',product_img='".$uploadImage."',alt_text='".$alt_text."',updated_by='" . $_SESSION['Adminname'] . "',updated_at='" . $dateFormat . "',status=1 where product_master_id	='" . $getId . "'");

        if ($editMaterial === true) {
            showToast('Success', 'Updated Successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='productmaster.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Failed to update Product', 'error');
        }
    }
}

// function deleteProductmaster($id)
// {
//     $getId = $id;

//     global $conn;

//     $date = date_default_timezone_set('Asia/Kolkata');
//     $dateFormat = date('Y-m-d H:i:s');

//     $deleteMaterial = mysqli_query($conn, "UPDATE product_master SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_at='" . $dateFormat . "'where product_master_id='" . $getId . "'");
//     if ($deleteMaterial === true) {
//         showToast('Success', 'Deleted Successfully', 'success');
//         echo "<script>setTimeout(()=>{location.href='productmaster.php'
//         },'1000');</script>";
//     } else {
//         showToast('Error', 'Failed to delete Product', 'error');
//         echo "<script>setTimeout(()=>{location.href='productmaster.php'
//         },'1000');</script>";
//     }
// }


function deleteProductmaster($id)
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

  
    $getProductQuery = mysqli_query($conn, "SELECT product_master FROM product_master WHERE product_master_id = '$id' AND status = 1");
    $row = mysqli_fetch_assoc($getProductQuery);
    $productName = $row['product_master'];

   
    $productTypes = mysqli_query($conn, "SELECT product_type FROM product_type_master WHERE product = '$productName' AND status = 1");

    while ($typeRow = mysqli_fetch_assoc($productTypes)) {
        $productType = $typeRow['product_type'];

       
        mysqli_query($conn, "UPDATE subtype_master SET status = 0, updated_by='" . $_SESSION['admin_id'] . "', updated_at = '$dateFormat' WHERE product_type = '$productType'");
    }

   
    mysqli_query($conn, "UPDATE product_type_master SET status = 0, updated_by='" . $_SESSION['admin_id'] . "', updated_at = '$dateFormat' WHERE product = '$productName'");


    $deleteProduct = mysqli_query($conn, "UPDATE product_master SET status = 0, updated_by='" . $_SESSION['admin_id'] . "', updated_at = '$dateFormat' WHERE product_master_id = '$id'");

    if ($deleteProduct === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='productmaster.php'}, 1000);</script>";
    } else {
        showToast('Error', 'Failed to delete Product and related data', 'error');
        echo "<script>setTimeout(()=>{location.href='productmaster.php'}, 3000);</script>";
    }
}



