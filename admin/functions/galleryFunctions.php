<?php

// session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include './includes/db.php';
include './utils/alerts.php';
include './utils/imageValidation.php';

function addGallery()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $image = $_FILES['image'];
    $image2 = $_FILES['image2'];
    $image3 = $_FILES['image3'];
    $image4 = $_FILES['image4'];
    $image5 = $_FILES['image5'];
    $image6 = $_FILES['image6'];
    $image7 = $_FILES['image7'];
    $image8 = $_FILES['image8'];
    $image9 = $_FILES['image9'];
    $image10 = $_FILES['image10'];
    $profileimage = $_FILES['profile_img'];
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
$oldImage2 = mysqli_real_escape_string($conn, $_POST['oldImage2']);
$oldImage3 = mysqli_real_escape_string($conn, $_POST['oldImage3']);
$oldImage4 = mysqli_real_escape_string($conn, $_POST['oldImage4']);
$oldImage5 = mysqli_real_escape_string($conn, $_POST['oldImage5']);
$oldImage6 = mysqli_real_escape_string($conn, $_POST['oldImage6']);
$oldImage7 = mysqli_real_escape_string($conn, $_POST['oldImage7']);
$oldImage8 = mysqli_real_escape_string($conn, $_POST['oldImage8']);
$oldImage9 = mysqli_real_escape_string($conn, $_POST['oldImage9']);
$oldImage10 = mysqli_real_escape_string($conn, $_POST['oldImage10']);
$oldImage11 = mysqli_real_escape_string($conn, $_POST['oldImage11']);

    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $profilealttext = mysqli_real_escape_string($conn, $_POST['profilealttext']);
    $Category = mysqli_real_escape_string($conn, $_POST['category']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $rating = mysqli_real_escape_string($conn, $_POST['rating']);
    $cus_name = mysqli_real_escape_string($conn, $_POST['cus_name']);
    $cus_status = mysqli_real_escape_string($conn, $_POST['cus_status']);
    $flat = mysqli_real_escape_string($conn, $_POST['flat']);
    $path = './Uploads/gallery/';
    // $uploadImage = validateImage($path, $image);
    // $uploadImage2 = validateImage($path, $image2);
    // $uploadImage3 = validateImage($path, $image3);
    // $uploadImage4 = validateImage($path, $image4);
    // $uploadImage5 = validateImage($path, $image5);
    // $uploadImage6 = validateImage($path, $image6);
    // $uploadImage7 = validateImage($path, $image7);
    // $uploadImage8 = validateImage($path, $image8);
    // $uploadImage9 = validateImage($path, $image9);
    // $uploadImage10 = validateImage($path, $image10);
    // $uploadImage11 = validateImage($path, $profileimage);
    // if ($uploadImage && $uploadImage2 && $uploadImage3 && $uploadImage4 && $uploadImage5 && $uploadImage6 && $uploadImage7 && $uploadImage8 && $uploadImage9 && $uploadImage10 && $uploadImage11 === false) {
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
    
    if (isset($image6) && isset($image6['tmp_name']) && is_uploaded_file($image6['tmp_name'])) {
        $uploadImage6 = validateImage($path, $image6);
        if ($uploadImage6 === false) {
            showToast('Error', 'Image Upload Failed', 'error');
            return;
        } else {
            if (!empty($oldImage6) && file_exists($path . $oldImage6)) {
                unlink($path . $oldImage6);
            }
        }
    } else {
        $uploadImage6 = $oldImage6;
    }
    
    if (isset($image7) && isset($image7['tmp_name']) && is_uploaded_file($image7['tmp_name'])) {
        $uploadImage7 = validateImage($path, $image7);
        if ($uploadImage7 === false) {
            showToast('Error', 'Image Upload Failed', 'error');
            return;
        } else {
            if (!empty($oldImage7) && file_exists($path . $oldImage7)) {
                unlink($path . $oldImage7);
            }
        }
    } else {
        $uploadImage7 = $oldImage7;
    }
    
    if (isset($image8) && isset($image8['tmp_name']) && is_uploaded_file($image8['tmp_name'])) {
        $uploadImage8 = validateImage($path, $image8);
        if ($uploadImage8 === false) {
            showToast('Error', 'Image Upload Failed', 'error');
            return;
        } else {
            if (!empty($oldImage8) && file_exists($path . $oldImage8)) {
                unlink($path . $oldImage8);
            }
        }
    } else {
        $uploadImage8 = $oldImage8;
    }
    
    if (isset($image9) && isset($image9['tmp_name']) && is_uploaded_file($image9['tmp_name'])) {
        $uploadImage9 = validateImage($path, $image9);
        if ($uploadImage9 === false) {
            showToast('Error', 'Image Upload Failed', 'error');
            return;
        } else {
            if (!empty($oldImage9) && file_exists($path . $oldImage9)) {
                unlink($path . $oldImage9);
            }
        }
    } else {
        $uploadImage9 = $oldImage9;
    }
    
    if (isset($image10) && isset($image10['tmp_name']) && is_uploaded_file($image10['tmp_name'])) {
        $uploadImage10 = validateImage($path, $image10);
        if ($uploadImage10 === false) {
            showToast('Error', 'Image Upload Failed', 'error');
            return;
        } else {
            if (!empty($oldImage10) && file_exists($path . $oldImage10)) {
                unlink($path . $oldImage10);
            }
        }
    } else {
        $uploadImage10 = $oldImage10;
    }
    
    if (isset($profileimage) && isset($profileimage['tmp_name']) && is_uploaded_file($profileimage['tmp_name'])) {
        $uploadImage11 = validateImage($path, $profileimage);
        if ($uploadImage11 === false) {
            showToast('Error', 'Profile Image Upload Failed', 'error');
            return;
        } else {
            if (!empty($oldImage11) && file_exists($path . $oldImage11)) {
                unlink($path . $oldImage11);
            }
        }
    } else {
        $uploadImage11 = $oldImage11;
    }
    






        $addGallery = mysqli_query($conn, "INSERT into gallery set gallery_image='" . $uploadImage . "',
           gallery_image2='" . $uploadImage2 . "',gallery_image3='" . $uploadImage3 . "',gallery_image4='" . $uploadImage4 . "',
    gallery_image5='" . $uploadImage5 . "',gallery_image6='" . $uploadImage6 . "',gallery_image7='" . $uploadImage7 . "',
    gallery_image8='" . $uploadImage8 . "',gallery_image9='" . $uploadImage9 . "',gallery_image10='" . $uploadImage10 . "',profile_img_alt_text='".$profilealttext."',
        profile_img='".$uploadImage11."',price='".$price."',rating='".$rating."',customer_name='".$cus_name."',customer_status='".$cus_status."',flat='".$flat."',
        gallery_alttext='" . $alt_text . "',gallery_category='" . $Category . "',created_by='" . $_SESSION['admin_id'] . "',updated_by=0,created_At='" . $dateFormat . "',updated_At=0,status=1");

        if ($addGallery === true) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='gallery.php'
            },'1000');</script>";
        } else {
            showToast('Error', 'Gallery Added Failed', 'error');
        }
    }



function editGallery()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $image = $_FILES['image'];
    $image2 = $_FILES['image2'];
    $image3 = $_FILES['image3'];
    $image4 = $_FILES['image4'];
    $image5 = $_FILES['image5'];
    $image6 = $_FILES['image6'];
    $image7 = $_FILES['image7'];
    $image8 = $_FILES['image8'];
    $image9 = $_FILES['image9'];
    $image10 = $_FILES['image10'];
    $profileimage = $_FILES['profile_img'];
    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $profilealttext = mysqli_real_escape_string($conn, $_POST['profilealttext']);
    $Category = mysqli_real_escape_string($conn, $_POST['category']);
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $oldImage2 = mysqli_real_escape_string($conn, $_POST['oldImage2']);
    $oldImage3 = mysqli_real_escape_string($conn, $_POST['oldImage3']);
    $oldImage4 = mysqli_real_escape_string($conn, $_POST['oldImage4']);
    $oldImage5 = mysqli_real_escape_string($conn, $_POST['oldImage5']);
    $oldImage6 = mysqli_real_escape_string($conn, $_POST['oldImage6']);
    $oldImage7 = mysqli_real_escape_string($conn, $_POST['oldImage7']);
    $oldImage8 = mysqli_real_escape_string($conn, $_POST['oldImage8']);
    $oldImage9 = mysqli_real_escape_string($conn, $_POST['oldImage9']);
    $oldImage10 = mysqli_real_escape_string($conn, $_POST['oldImage10']);
    $oldImage11 = mysqli_real_escape_string($conn, $_POST['oldProfile_img']);

    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $rating = mysqli_real_escape_string($conn, $_POST['rating']);
    $cus_name = mysqli_real_escape_string($conn, $_POST['cus_name']);
    $cus_status = mysqli_real_escape_string($conn, $_POST['cus_status']);
    $flat = mysqli_real_escape_string($conn, $_POST['flat']);

    $getId = mysqli_real_escape_string($conn, $_POST['galleryId']);
    $path = './Uploads/gallery/';


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

     if (isset($image6) && $image6['error'] === 0) {
        $uploadImage6 = validateImage($path, $image6);
        if ($uploadImage6 === false) {
            showToast('Error', 'Image Upload Failed', 'error');
        } else {
            unlink($path . $oldImage6);
        }
    } else {
        $uploadImage6 = $oldImage6;
    }

     if (isset($image7) && $image7['error'] === 0) {
        $uploadImage7 = validateImage($path, $image7);
        if ($uploadImage7 === false) {
            showToast('Error', 'Image Upload Failed', 'error');
        } else {
            unlink($path . $oldImage7);
        }
    } else {
        $uploadImage7 = $oldImage7;
    }

     if (isset($image8) && $image8['error'] === 0) {
        $uploadImage8 = validateImage($path, $image8);
        if ($uploadImage8 === false) {
            showToast('Error', 'Image Upload Failed', 'error');
        } else {
            unlink($path . $oldImage8);
        }
    } else {
        $uploadImage8 = $oldImage8;
    }

     if (isset($image9) && $image9['error'] === 0) {
        $uploadImage9 = validateImage($path, $image9);
        if ($uploadImage9 === false) {
            showToast('Error', 'Image Upload Failed', 'error');
        } else {
            unlink($path . $oldImage9);
        }
    } else {
        $uploadImage9 = $oldImage9;
    }

     if (isset($image10) && $image10['error'] === 0) {
        $uploadImage10 = validateImage($path, $image10);
        if ($uploadImage10 === false) {
            showToast('Error', 'Image Upload Failed', 'error');
        } else {
            unlink($path . $oldImage10);
        }
    } else {
        $uploadImage10 = $oldImage10;
    }


      if (isset($profileimage) && $profileimage['error'] === 0) {
        $uploadImage11 = validateImage($path, $profileimage);
        if ($uploadImage11 === false) {
            showToast('Error', 'Image Upload Failed', 'error');
        } else {
            unlink($path . $oldImage11);
        }
    } else {
        $uploadImage11 = $oldImage11;
    }


    $editGallery = mysqli_query($conn, "UPDATE gallery set gallery_image='" . $uploadImage . "',
    gallery_image2='" . $uploadImage2 . "',gallery_image3='" . $uploadImage3 . "',gallery_image4='" . $uploadImage4 . "',
    gallery_image5='" . $uploadImage5 . "',gallery_image6='" . $uploadImage6 . "',gallery_image7='" . $uploadImage7 . "',
    gallery_image8='" . $uploadImage8 . "',gallery_image9='" . $uploadImage9 . "',gallery_image10='" . $uploadImage10 . "',profile_img_alt_text='".$profilealttext."',
    profile_img='" . $uploadImage11 . "',price='".$price."',rating='".$rating."',customer_name='".$cus_name."',customer_status='".$cus_status."',flat='".$flat."',
    gallery_alttext='" . $alt_text . "',gallery_category='" . $Category . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where gallery_id='" . $getId . "'");

    if ($editGallery === true) {
        showToast('Success', 'Updated Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='gallery.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to update Gallery', 'error');
    }
}

function deleteGallery($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteGallery = mysqli_query($conn, "UPDATE gallery SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where gallery_id='" . $getId . "'");
    if ($deleteGallery === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='gallery.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Gallery', 'error');
        echo "<script>setTimeout(()=>{location.href='gallery.php'
        },'1000');</script>";
    }
}
