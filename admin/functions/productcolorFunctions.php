<?php

// session_start();
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


include './includes/db.php';
include './utils/alerts.php';
include './utils/imageValidation.php';

function addProductcolors()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $image = $_FILES['image'];
    $image2 = $_FILES['image2'];
    $image3 = $_FILES['image3'];
    $image4 = $_FILES['image4'];
    $image5 = $_FILES['image5'];
  
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
$oldImage2 = mysqli_real_escape_string($conn, $_POST['oldImage2']);
$oldImage3 = mysqli_real_escape_string($conn, $_POST['oldImage3']);
$oldImage4 = mysqli_real_escape_string($conn, $_POST['oldImage4']);
$oldImage5 = mysqli_real_escape_string($conn, $_POST['oldImage5']);


    $alt_text1 = mysqli_real_escape_string($conn, $_POST['alttext']);
    $alt_text2 = mysqli_real_escape_string($conn, $_POST['alttext2']);
    $alt_text3 = mysqli_real_escape_string($conn, $_POST['alttext3']);
    $alt_text4 = mysqli_real_escape_string($conn, $_POST['alttext4']);
    $alt_text5 = mysqli_real_escape_string($conn, $_POST['alttext5']);
    $size = mysqli_real_escape_string($conn, $_POST['size']);
    $material = mysqli_real_escape_string($conn, $_POST['material']);
    $qantity = mysqli_real_escape_string($conn, $_POST['qantity']);
  
    $color = mysqli_real_escape_string($conn, $_POST['color']);
    $product = mysqli_real_escape_string($conn, $_POST['product']);

    $path = './Uploads/products/';
 


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
    
    if (isset($image2) && isset($image2['tmp_name']) && is_uploaded_file($image2['tmp_name'])) {
        $uploadImage2 = validateImage($path, $image2);
        if ($uploadImage2 === false) {
            showToast('Error', 'Image Upload Failed', 'error');
            return;
        } else {
            if (!empty($oldImage2) && file_exists($path . $oldImage2)) {
                unlink($path . $oldImage2);
            }
        }
    } else {
        $uploadImage2 = $oldImage2;
    }
    
    if (isset($image3) && isset($image3['tmp_name']) && is_uploaded_file($image3['tmp_name'])) {
        $uploadImage3 = validateImage($path, $image3);
        if ($uploadImage3 === false) {
            showToast('Error', 'Image Upload Failed', 'error');
            return;
        } else {
            if (!empty($oldImage3) && file_exists($path . $oldImage3)) {
                unlink($path . $oldImage3);
            }
        }
    } else {
        $uploadImage3 = $oldImage3;
    }
    
    if (isset($image4) && isset($image4['tmp_name']) && is_uploaded_file($image4['tmp_name'])) {
        $uploadImage4 = validateImage($path, $image4);
        if ($uploadImage4 === false) {
            showToast('Error', 'Image Upload Failed', 'error');
            return;
        } else {
            if (!empty($oldImage4) && file_exists($path . $oldImage4)) {
                unlink($path . $oldImage4);
            }
        }
    } else {
        $uploadImage4 = $oldImage4;
    }
    
    if (isset($image5) && isset($image5['tmp_name']) && is_uploaded_file($image5['tmp_name'])) {
        $uploadImage5 = validateImage($path, $image5);
        if ($uploadImage5 === false) {
            showToast('Error', 'Image Upload Failed', 'error');
            return;
        } else {
            if (!empty($oldImage5) && file_exists($path . $oldImage5)) {
                unlink($path . $oldImage5);
            }
        }
    } else {
        $uploadImage5 = $oldImage5;
    }
    
  
    
        $addproductcolor = mysqli_query($conn, "INSERT into product_colors set image1='" . $uploadImage . "',image2='" . $uploadImage2 . "',image3='" . $uploadImage3 . "',image4='" . $uploadImage4 . "',
 image5='" . $uploadImage5 . "',
       product_color='".$color."',product_name='".$product."',alttext1='".$alt_text1."',  alttext2 = '$alt_text2',
        alttext3 = '$alt_text3',
        alttext4 = '$alt_text4',
        product_quantity = '$qantity',
        product_material = '$material',
        product_size = '$size',
        alttext5 = '$alt_text5',updated_by=0,updated_at=0,status=1");

        if ($addproductcolor === true) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='product_colors.php'
            },'1000');</script>";
        } else {
            showToast('Error', 'Product colors Added Failed', 'error');
        }
    }



function editProductcolors()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $image = $_FILES['image'];
    $image2 = $_FILES['image2'];
    $image3 = $_FILES['image3'];
    $image4 = $_FILES['image4'];
    $image5 = $_FILES['image5'];
  
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
$oldImage2 = mysqli_real_escape_string($conn, $_POST['oldImage2']);
$oldImage3 = mysqli_real_escape_string($conn, $_POST['oldImage3']);
$oldImage4 = mysqli_real_escape_string($conn, $_POST['oldImage4']);
$oldImage5 = mysqli_real_escape_string($conn, $_POST['oldImage5']);

  $size = mysqli_real_escape_string($conn, $_POST['size']);
    $material = mysqli_real_escape_string($conn, $_POST['material']);
    $qantity = mysqli_real_escape_string($conn, $_POST['qantity']);

    $alt_text1 = mysqli_real_escape_string($conn, $_POST['alttext']);
    $alt_text2 = mysqli_real_escape_string($conn, $_POST['alttext2']);
    $alt_text3 = mysqli_real_escape_string($conn, $_POST['alttext3']);
    $alt_text4 = mysqli_real_escape_string($conn, $_POST['alttext4']);
    $alt_text5 = mysqli_real_escape_string($conn, $_POST['alttext5']);
  
    $color = mysqli_real_escape_string($conn, $_POST['color']);
    $product = mysqli_real_escape_string($conn, $_POST['product']);

    $getId = mysqli_real_escape_string($conn, $_POST['productcolorId']);
    $path = './Uploads/products/';


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

    if (isset($image2) && $image2['error'] === 0) {
        $uploadImage2 = validateImage($path, $image2);
        if ($uploadImage2 === false) {
            showToast('Error', 'Image Upload Failed', 'error');
        } else {
            unlink($path . $oldImage2);
        }
    } else {
        $uploadImage2 = $oldImage2;
    }

     if (isset($image3) && $image3['error'] === 0) {
        $uploadImage3 = validateImage($path, $image3);
        if ($uploadImage3 === false) {
            showToast('Error', 'Image Upload Failed', 'error');
        } else {
            unlink($path . $oldImage3);
        }
    } else {
        $uploadImage3 = $oldImage3;
    }

     if (isset($image4) && $image4['error'] === 0) {
        $uploadImage4 = validateImage($path, $image4);
        if ($uploadImage4 === false) {
            showToast('Error', 'Image Upload Failed', 'error');
        } else {
            unlink($path . $oldImage4);
        }
    } else {
        $uploadImage4 = $oldImage4;
    }

     if (isset($image5) && $image5['error'] === 0) {
        $uploadImage5 = validateImage($path, $image5);
        if ($uploadImage5 === false) {
            showToast('Error', 'Image Upload Failed', 'error');
        } else {
            unlink($path . $oldImage5);
        }
    } else {
        $uploadImage5 = $oldImage5;
    }

 

    $editproductcolor = mysqli_query($conn, "UPDATE product_colors set image1='" . $uploadImage . "',image2='" . $uploadImage2 . "',image3='" . $uploadImage3 . "',image4='" . $uploadImage4 . "',
 image5='" . $uploadImage5 . "',
       product_color='".$color."',product_name='".$product."',alttext1='".$alt_text1."',alttext2 = '".$alt_text2."',
        alttext3 = '".$alt_text3."',
        alttext4 = '".$alt_text4."',
             product_quantity = '$qantity',
        product_material = '$material',
        product_size = '$size',
        alttext5 = '".$alt_text5."',updated_by='" . $_SESSION['Adminname'] . "',updated_at='" . $dateFormat . "' where product_color_id='" . $getId . "'");

    if ($editproductcolor === true) {
        showToast('Success', 'Updated Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='product_colors.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to update ', 'error');
    }
}

function deleteProductcolors($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteGallery = mysqli_query($conn, "UPDATE product_colors SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_at='" . $dateFormat . "'where product_color_id='" . $getId . "'");
    if ($deleteGallery === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='product_colors.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete ', 'error');
        echo "<script>setTimeout(()=>{location.href='product_colors.php'
        },'1000');</script>";
    }
}
