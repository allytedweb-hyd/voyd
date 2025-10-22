<?php

// session_start();
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


include './includes/db.php';

include './utils/alerts.php';
include './utils/imageValidation.php';

function addElements()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Element_name = mysqli_real_escape_string($conn, $_POST['Name']);
    $Model_name = mysqli_real_escape_string($conn, $_POST['model']);
    $Design = mysqli_real_escape_string($conn, $_POST['design']);
    $material_classification = mysqli_real_escape_string($conn, $_POST['material_classification']);
    $image = $_FILES['image'];
    $image1 = $_FILES['image1'];
    $image2 = $_FILES['image2'];
    $image3 = $_FILES['image3'];
    $image4 = $_FILES['image4'];
    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $alt_text1 = mysqli_real_escape_string($conn, $_POST['alt1']);
    $alt_text2 = mysqli_real_escape_string($conn, $_POST['alt2']);
    $alt_text3 = mysqli_real_escape_string($conn, $_POST['alt3']);
    $alt_text4 = mysqli_real_escape_string($conn, $_POST['alt4']);
    $Category = mysqli_real_escape_string($conn, $_POST['category']);
    $Material = mysqli_real_escape_string($conn, $_POST['material']);
    $Costper_sqft = mysqli_real_escape_string($conn, $_POST['cost']);
    $Length = mysqli_real_escape_string($conn, $_POST['length']);
    $Width = mysqli_real_escape_string($conn, $_POST['width']);
    $Height = mysqli_real_escape_string($conn, $_POST['heigth']);
    $squnits = mysqli_real_escape_string($conn, $_POST['squnits']);
    $unit = mysqli_real_escape_string($conn, $_POST['unit']);
    $product_classification = mysqli_real_escape_string($conn, $_POST['product_classification']);
    $Minimum_price = mysqli_real_escape_string($conn, $_POST['min_price']);
    $Maximum_price = mysqli_real_escape_string($conn, $_POST['max_price']);
    $Description = mysqli_real_escape_string($conn, $_POST['description']);
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $oldImage1 = mysqli_real_escape_string($conn, $_POST['oldImage1']);
    $oldImage2 = mysqli_real_escape_string($conn, $_POST['oldImage2']);
    $oldImage3 = mysqli_real_escape_string($conn, $_POST['oldImage3']);
    $oldImage4 = mysqli_real_escape_string($conn, $_POST['oldImage4']);
    $path = './Uploads/elements/';
    // $uploadImage = validateImage($path, $image);
    // $uploadImage1 = validateImage($path, $image1);
    // $uploadImage2 = validateImage($path, $image2);
    // $uploadImage3 = validateImage($path, $image3);
    // $uploadImage4 = validateImage($path, $image4);
   

    // if (($uploadImage === false) || ($uploadImage1 === false) || ($uploadImage2 === false) || ($uploadImage3 === false) || ($uploadImage4 === false)) {
    //     showToast('Error', 'Image Upload Failed', 'error');
    // } else {

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

    if (isset($image1) && isset($image1['tmp_name']) && is_uploaded_file($image1['tmp_name'])) {
        $uploadImage1 = validateImage($path, $image1);
    
        if ($uploadImage1 === false) {
            showToast('Error', 'Image Upload Failed', 'error');
            return; 
        } else {
            
            if (!empty($uploadImage1) && file_exists($path . $oldImage1)) {
                unlink($path . $oldImage1);
            }
        }
    } else {
        $uploadImage1 = $oldImage1;
    }


    if (isset($image2) && isset($image2['tmp_name']) && is_uploaded_file($image2['tmp_name'])) {
        $uploadImage2 = validateImage($path, $image2);
    
        if ($uploadImage2 === false) {
            showToast('Error', 'Image Upload Failed', 'error');
            return; 
        } else {
            
            if (!empty($uploadImage2) && file_exists($path . $oldImage2)) {
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
            
            if (!empty($uploadImage3) && file_exists($path . $oldImage3)) {
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
            
            if (!empty($uploadImage4) && file_exists($path . $oldImage4)) {
                unlink($path . $oldImage4);
            }
        }
    } else {
        $uploadImage4 = $oldImage4;
    }



        $addElements = mysqli_query($conn, "INSERT into interior_elements set element_name='" . $Element_name . "',material_classification='".$material_classification."',model='" . $Model_name . "',squnits='".$squnits."',product_design ='" . $Design . "',element_image='" . $uploadImage . "',element_alttext='" . $alt_text . "',image_1='" . $uploadImage1 . "',alttext_1='" . $alt_text1 . "',image_2='" . $uploadImage2 . "',alttext_2='" . $alt_text2 . "',image_3='" . $uploadImage3 . "',alttext_3='" . $alt_text3 . "',image_4='" . $uploadImage4 . "',alttext_4='" . $alt_text4 . "',element_category='" . $Category . "',material='" . $Material . "',length='" . $Length . "',width='" . $Width . "',height='" . $Height . "',units='" . $unit . "',product_classification='".$product_classification."',cost_per_sqft='" . $Costper_sqft . "',minimum_price='" . $Minimum_price . "',maximum_price='" . $Maximum_price . "',element_description='" . $Description . "',created_by='" . $_SESSION['admin_id'] . "',updated_by=0,created_At='" . $dateFormat . "',updated_At=0,status=1");

        if ($addElements === true) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>
            setTimeout(function() {
                window.location.href = 'interior-elements.php';
            }, 1000);
        </script>";
        } else {
            showToast('Error', 'Elements Added Failed', 'error');
        }
    }


function editElements()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Element_name = mysqli_real_escape_string($conn, $_POST['Name']);
    $Model_name = mysqli_real_escape_string($conn, $_POST['model']);
    $Design = mysqli_real_escape_string($conn, $_POST['design']);
    $image = $_FILES['image'];
    $image1 = $_FILES['image1'];
    $image2 = $_FILES['image2'];
    $image3 = $_FILES['image3'];
    $image4 = $_FILES['image4'];
    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $alt_text1 = mysqli_real_escape_string($conn, $_POST['alt1']);
    $alt_text2 = mysqli_real_escape_string($conn, $_POST['alt2']);
    $alt_text3 = mysqli_real_escape_string($conn, $_POST['alt3']);
    $alt_text4 = mysqli_real_escape_string($conn, $_POST['alt4']);
    $Category = mysqli_real_escape_string($conn, $_POST['category']);
    $Material = mysqli_real_escape_string($conn, $_POST['material']);
    $Costper_sqft = mysqli_real_escape_string($conn, $_POST['cost']);
        $squnits = mysqli_real_escape_string($conn, $_POST['squnits']);

    $material_classification = mysqli_real_escape_string($conn, $_POST['material_classification']);
    $Length = mysqli_real_escape_string($conn, $_POST['length']);
    $Width = mysqli_real_escape_string($conn, $_POST['width']);
    $Height = mysqli_real_escape_string($conn, $_POST['height']);
    $unit = mysqli_real_escape_string($conn, $_POST['unit']);
     $product_classification = mysqli_real_escape_string($conn, $_POST['product_classification']);
    $Minimum_price = mysqli_real_escape_string($conn, $_POST['min_price']);
    $Maximum_price = mysqli_real_escape_string($conn, $_POST['max_price']);
    $Description = mysqli_real_escape_string($conn, $_POST['description']);
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $oldImage1 = mysqli_real_escape_string($conn, $_POST['oldImage1']);
    $oldImage2 = mysqli_real_escape_string($conn, $_POST['oldImage2']);
    $oldImage3 = mysqli_real_escape_string($conn, $_POST['oldImage3']);
    $oldImage4 = mysqli_real_escape_string($conn, $_POST['oldImage4']);
    $getId = mysqli_real_escape_string($conn, $_POST['elementId']);
    $path = './Uploads/elements/';


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

    if (isset($image1) && $image1['error'] === 0) {
        $uploadImage1 = validateImage($path, $image1);
        if ($uploadImage1 === false) {
            showToast('Error', 'Image Upload Failed', 'error');
        } else {
            unlink($path . $oldImage1);
        }
    } else {
        $uploadImage1 = $oldImage1;
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
        $uploadImage3 = validateImage($path, $image);
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


    $editElements = mysqli_query($conn, "UPDATE interior_elements set element_name='" . $Element_name . "',squnits='".$squnits."',material_classification='".$material_classification."',model='" . $Model_name . "',product_design ='" . $Design . "',element_image='" . $uploadImage . "',element_alttext='" . $alt_text . "',image_1='" . $uploadImage1 . "',alttext_1='" . $alt_text1 . "',image_2='" . $uploadImage2 . "',alttext_2='" . $alt_text2 . "',image_3='" . $uploadImage3 . "',alttext_3='" . $alt_text3 . "',image_4='" . $uploadImage4 . "',alttext_4='" . $alt_text4 . "',element_category='" . $Category . "',material='" . $Material . "',length='" . $Length . "',width='" . $Width . "',height='" . $Height . "',units='" . $unit . "', product_classification='".$product_classification."',cost_per_sqft='" . $Costper_sqft . "',minimum_price='" . $Minimum_price . "',maximum_price='" . $Maximum_price . "',element_description='" . $Description . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where element_id='" . $getId . "'");

    if ($editElements === true) {
        showToast('Success', 'Updated Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='interior-elements.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to update Elements', 'error');
    }
}

function deleteElements($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteElements = mysqli_query($conn, "UPDATE interior_elements SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where element_id='" . $getId . "'");
    if ($deleteElements === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='interior-elements.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Elements', 'error');
        echo "<script>setTimeout(()=>{location.href='interior-elements.php'
        },'1000');</script>";
    }
}
