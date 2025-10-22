<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once './includes/db.php';
include './utils/alerts.php';
include './utils/imageValidation.php';


function addProducts()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $ProductTitle = mysqli_real_escape_string($conn, $_POST['title']);
    $room = mysqli_real_escape_string($conn, $_POST['room']);
    $Category = mysqli_real_escape_string($conn, $_POST['category']);
    $SubCategory = mysqli_real_escape_string($conn, $_POST['subcategory']);
    $ProductBrand = mysqli_real_escape_string($conn, $_POST['brand']);
    $Size = mysqli_real_escape_string($conn, $_POST['size']);
    $Color = mysqli_real_escape_string($conn, $_POST['color']);
    $Quantity = mysqli_real_escape_string($conn, $_POST['qantity']);
    $Material = mysqli_real_escape_string($conn, $_POST['material']);
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
    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $alt_text1 = mysqli_real_escape_string($conn, $_POST['alt1']);
    $alt_text2 = mysqli_real_escape_string($conn, $_POST['alt2']);
    $alt_text3 = mysqli_real_escape_string($conn, $_POST['alt3']);
    $alt_text5 = mysqli_real_escape_string($conn, $_POST['alt5']);
    $MRP = mysqli_real_escape_string($conn, $_POST['mrp']);
    $OfferPrice = mysqli_escape_string($conn, $_POST['offer']);
    $ProductPriority = mysqli_escape_string($conn, $_POST['product_priority']);
    $ProductTag = mysqli_escape_string($conn, $_POST['product_tag']);
    $GST = mysqli_escape_string($conn, $_POST['gst']);
    $Other = mysqli_escape_string($conn, $_POST['other']);
    $availability = mysqli_escape_string($conn, $_POST['availability']);
    $sku = mysqli_escape_string($conn, $_POST['sku']);
    $add_info = mysqli_escape_string($conn, $_POST['add_info']);
    $courier = mysqli_escape_string($conn, $_POST['courier']);
    $shipping = mysqli_escape_string($conn, $_POST['shipping']);
    $ground_shipping = mysqli_escape_string($conn, $_POST['ground_shipping']);
    $global_export = mysqli_escape_string($conn, $_POST['global_export']);
    $specification = mysqli_escape_string($conn, $_POST['specification']);
    $Description = mysqli_real_escape_string($conn, $_POST['description']);

        $feature_texts = $_POST['feature_text'] ?? [];
    $feature_icons = $_FILES['feature_icon'] ?? null;

    $path = './Uploads/products/';  // Make sure this folder exists & writable

    $features = []; // Will store array of ['text'=>..., 'icon'=>...]

    // Loop through all features
    foreach ($feature_texts as $index => $text) {
        $text = mysqli_real_escape_string($conn, trim($text));

        // Default icon filename empty
        $iconFileName = '';

        // Check if there is an uploaded file for this feature
        if ($feature_icons && isset($feature_icons['tmp_name'][$index]) && is_uploaded_file($feature_icons['tmp_name'][$index])) {
            // Prepare single file array to send to validateImage
            $singleFile = [
                'name' => $feature_icons['name'][$index],
                'type' => $feature_icons['type'][$index],
                'tmp_name' => $feature_icons['tmp_name'][$index],
                'error' => $feature_icons['error'][$index],
                'size' => $feature_icons['size'][$index],
            ];

            $iconFileName = validateImage($path, $singleFile);

            if ($iconFileName === false) {
                showToast('Error', 'Feature icon upload failed', 'error');
                return; // stop processing
            }
        }

        $features[] = [
            'text' => $text,
            'icon' => $iconFileName
        ];
    }

    // Convert $features to JSON string for DB storage
    $ProductFeatures = mysqli_real_escape_string($conn, json_encode($features));
    
    $path = './Uploads/products/';
    // $uploadImage = validateImage($path, $image);
    // $uploadImage1 = validateImage($path, $image1);
    // $uploadImage2 = validateImage($path, $image2);
    // $uploadImage3 = validateImage($path, $image3);
    // $uploadImage5 = validateImage($path, $image5);
    // if (($uploadImage === false) || ($uploadImage1 === false) || ($uploadImage2 === false) || ($uploadImage3 === false) || ($uploadImage5 === false)) {
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

    if (isset($image5) && isset($image5['tmp_name']) && is_uploaded_file($image5['tmp_name'])) {
        $uploadImage5 = validateImage($path, $image5);
    
        if ($uploadImage5 === false) {
            showToast('Error', 'Image Upload Failed', 'error');
            return; 
        } else {
            
            if (!empty($uploadImage5) && file_exists($path . $oldImage5)) {
                unlink($path . $oldImage5);
            }
        }
    } else {
        $uploadImage5 = $oldImage5;
    }



    


        $addProducts = mysqli_query($conn, "INSERT into products set product_title ='" . $ProductTitle . "',room ='" . $room . "',product_category ='" . $Category . "',sub_category ='" . $SubCategory . "',product_brand ='" . $ProductBrand . "',product_color ='" . $Color . "',product_quantity ='" . $Quantity . "',product_material ='" . $Material . "',image_4 ='" . $uploadImage . "',product_alttext='" . $alt_text . "',image_1 ='" . $uploadImage2 . "',alttext_1='" . $alt_text1 . "',image_2 ='" . $uploadImage3 . "',alttext_2='" . $alt_text2 . "',image_3 ='" . $uploadImage4 . "',alttext_3='" . $alt_text3 . "',image_5 ='" . $uploadImage5 . "',img_alt_text5='" . $alt_text5 . "',product_mrp='" . $MRP . "',product_offerprice='" . $OfferPrice . "',productPriority='" . $ProductPriority . "', productTag='" . $ProductTag . "',product_size='" . $Size . "',gst='" . $GST . "',other='" . $Other . "',availability='" . $availability . "',sku='" . $sku . "',courier='".$courier."',shipping='".$shipping."',ground_shipping='".$ground_shipping."',global_export='".$global_export."',additional_info='" . $add_info . "',specification='" . $specification . "',product_description ='" . $Description . "',product_features='".$ProductFeatures."',created_by='" . $_SESSION['Adminname'] . "',updated_by=0,created_At='" . $dateFormat . "',updated_At=0,status=1");

        if ($addProducts === true) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='products.php'
            },'1000');</script>";
        } else {
            showToast('Error', 'Products Added Failed', 'error');
        }
    }


function editProducts()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $ProductTitle = mysqli_real_escape_string($conn, $_POST['title']);
    $room = mysqli_real_escape_string($conn, $_POST['room']);
    $Category = mysqli_real_escape_string($conn, $_POST['category']);
    $SubCategory = mysqli_real_escape_string($conn, $_POST['subcategory']);
    $ProductBrand = mysqli_real_escape_string($conn, $_POST['brand']);
    $Size = mysqli_real_escape_string($conn, $_POST['size']);
    $Color = mysqli_real_escape_string($conn, $_POST['color']);
    $Quantity = mysqli_real_escape_string($conn, $_POST['qantity']);
    $Material = mysqli_real_escape_string($conn, $_POST['material']);
    $image = $_FILES['image'];
    $image1 = $_FILES['image1'];
    $image2 = $_FILES['image2'];
    $image3 = $_FILES['image3'];
    $image5 = $_FILES['image5'];
    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $alt_text1 = mysqli_real_escape_string($conn, $_POST['alt1']);
    $alt_text2 = mysqli_real_escape_string($conn, $_POST['alt2']);
    $alt_text3 = mysqli_real_escape_string($conn, $_POST['alt3']);
    $alt_text5 = mysqli_real_escape_string($conn, $_POST['alt5']);
    $MRP = mysqli_real_escape_string($conn, $_POST['mrp']);
    $OfferPrice = mysqli_escape_string($conn, $_POST['offer']);
    $ProductPriority = mysqli_escape_string($conn, $_POST['product_priority']);
    $ProductTag = mysqli_escape_string($conn, $_POST['product_tag']);
    $GST = mysqli_escape_string($conn, $_POST['gst']);
    $Other = mysqli_escape_string($conn, $_POST['other']);
    $availability = mysqli_escape_string($conn, $_POST['availability']);
    $sku = mysqli_escape_string($conn, $_POST['sku']);
    $add_info = mysqli_escape_string($conn, $_POST['add_info']);
      $courier = mysqli_escape_string($conn, $_POST['courier']);
    $shipping = mysqli_escape_string($conn, $_POST['shipping']);
    $ground_shipping = mysqli_escape_string($conn, $_POST['ground_shipping']);
    $global_export = mysqli_escape_string($conn, $_POST['global_export']);
    $specification = mysqli_escape_string($conn, $_POST['specification']);
    $Description = mysqli_real_escape_string($conn, $_POST['description']);
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $oldImage1 = mysqli_real_escape_string($conn, $_POST['oldImage1']);
    $oldImage2 = mysqli_real_escape_string($conn, $_POST['oldImage2']);
    $oldImage3 = mysqli_real_escape_string($conn, $_POST['oldImage3']);
    $oldImage5 = mysqli_real_escape_string($conn, $_POST['oldImage5']);
    $getId = mysqli_real_escape_string($conn, $_POST['productId']);
    $path = './Uploads/products/';

  
$featureIcons = $_FILES['feature_icon'];
$featureTexts = $_POST['feature_text'];
$oldFeatureIcons = $_POST['old_feature_icon'];

$features = [];
$featurePath = './Uploads/products/';

if (!empty($featureTexts)) {
    foreach ($featureTexts as $index => $text) {
        $iconFile = $featureIcons['name'][$index];
        $tmpName = $featureIcons['tmp_name'][$index];
        $oldIcon = $oldFeatureIcons[$index];

   
        if (!empty($iconFile) && is_uploaded_file($tmpName)) {
            $newIconName = time() . '_' . basename($iconFile);
            $targetPath = $featurePath . $newIconName;

            if (move_uploaded_file($tmpName, $targetPath)) {
              
                if (!empty($oldIcon) && file_exists($featurePath . $oldIcon)) {
                    unlink($featurePath . $oldIcon);
                }
                $iconToUse = $newIconName;
            } else {
              
                $iconToUse = $oldIcon;
            }
        } else {
           
            $iconToUse = $oldIcon;
        }

       
        if (!empty(trim($text))) {
            $features[] = [
                'icon' => $iconToUse,
                'text' => $text
            ];
        }
    }
}


$ProductFeatures = mysqli_real_escape_string($conn, json_encode($features));


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
        $uploadImage3 = validateImage($path, $image3);
        if ($uploadImage3 === false) {
            showToast('Error', 'Image Upload Failed', 'error');
        } else {
            unlink($path . $oldImage3);
        }
    } else {
        $uploadImage3 = $oldImage3;
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


    $editProducts = mysqli_query($conn, "UPDATE products set product_title ='" . $ProductTitle . "',room ='" . $room . "',product_category ='" . $Category . "',sub_category ='" . $SubCategory . "',product_brand ='" . $ProductBrand . "',product_color ='" . $Color . "',product_quantity ='" . $Quantity . "',product_material ='" . $Material . "',image_4 ='" . $uploadImage . "',product_alttext='" . $alt_text . "',image_1 ='" . $uploadImage1 . "',alttext_1='" . $alt_text1 . "',image_2 ='" . $uploadImage2 . "',alttext_2='" . $alt_text2 . "',image_3 ='" . $uploadImage3 . "',alttext_3='" . $alt_text3 . "',image_5 ='" . $uploadImage5 . "',img_alt_text5='" . $alt_text5 . "',product_mrp='" . $MRP . "',product_offerprice='" . $OfferPrice . "',productPriority='" . $ProductPriority . "', productTag='" . $ProductTag . "',product_size='" . $Size . "',gst='" . $GST . "',other='" . $Other . "',courier='".$courier."',shipping='".$shipping."',ground_shipping='".$ground_shipping."',global_export='".$global_export."',availability='" . $availability . "',sku='" . $sku . "',additional_info='" . $add_info . "',specification='" . $specification . "',product_description ='" . $Description . "',product_features='".$ProductFeatures."',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where product_id='" . $getId . "'");

    if ($editProducts === true) {
        showToast('Success', 'Updated Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='products.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to update Products', 'error');
    }
}

function deleteProduct($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteProduct = mysqli_query($conn, "UPDATE products SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where product_id='" . $getId . "'");
    if ($deleteProduct === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='products.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Product', 'error');
        echo "<script>setTimeout(()=>{location.href='products.php'
        },'1000');</script>";
    }
}
