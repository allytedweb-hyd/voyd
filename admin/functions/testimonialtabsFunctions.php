<?php
require_once './includes/db.php';
include './utils/alerts.php';
include './utils/imageValidation.php';

function addTestimonialtabs()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Testimonial_Name = mysqli_real_escape_string($conn, $_POST['testimonialname']);
    $Tab = mysqli_real_escape_string($conn, $_POST['tab']);
    $image1 = $_FILES['image1'];
    $image2 = $_FILES['image2'];
    $image3 = $_FILES['image3'];
    $image4 = $_FILES['image4'];
    $oldImage1 = mysqli_real_escape_string($conn, $_POST['oldImage1']);
    $oldImage2 = mysqli_real_escape_string($conn, $_POST['oldImage2']);
    $oldImage3 = mysqli_real_escape_string($conn, $_POST['oldImage3']);
    $oldImage4 = mysqli_real_escape_string($conn, $_POST['oldImage4']);

    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $Description = mysqli_real_escape_string($conn, $_POST['description']);
    $path = './Uploads/testimonialtabs/';
    // $uploadImage1 = validateImage($path, $image1);
    // $uploadImage2 = validateImage($path, $image2);
    // $uploadImage3 = validateImage($path, $image3);
    // $uploadImage4 = validateImage($path, $image4);
    // if ($uploadImage1 && $uploadImage2 && $uploadImage3 && $uploadImage4  === false) {
    //     showToast('Error', 'Image Upload Failed', 'error');
    // } else {

    if (isset($image1) && isset($image1['tmp_name']) && is_uploaded_file($image1['tmp_name'])) {
        $uploadImage1 = validateImage($path, $image1);
    
        if ($uploadImage1 === false) {
            showToast('Error', 'Image Upload Failed', 'error');
            return; 
        } else {
            
            if (!empty($oldImage1) && file_exists($path . $oldImage1)) {
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



        $gettestimonial = mysqli_query($conn,"SELECT * FROM testimonial_tabs WHERE user_name='".$Testimonial_Name."' && status=1");
    
        $count = mysqli_num_rows($gettestimonial);


        if($count < 4){


        $addTestimonials = mysqli_query($conn, "INSERT into testimonial_tabs set user_name='" . $Testimonial_Name . "',tab_name='" . $Tab . "',image1='" . $uploadImage1 . "',image2='" . $uploadImage2 . "',image3='" . $uploadImage3 . "',icon='".$uploadImage4."',img_alt_text='" . $alt_text . "',description='" . $Description . "',updated_by=0,created_at='" . $dateFormat . "',updated_at=0,status=1");

        if ($addTestimonials === true) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='testimonialtabs.php'
            },'1000');</script>";
        } else {
            showToast('Error', 'Testimonial Tab Added Failed', 'error');
        }

    }

    else{

          showToast('Error', 'Already 4 Tabs are added', 'error');
       

    }

    }


function editTestimonialtabs()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Testimonial_Name = mysqli_real_escape_string($conn, $_POST['testimonialname']);
    $Tab = mysqli_real_escape_string($conn, $_POST['tab']);
    $image1 = $_FILES['image1'];
    $image2 = $_FILES['image2'];
    $image3 = $_FILES['image3'];
    $image4 = $_FILES['icon'];
    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $Description = mysqli_real_escape_string($conn, $_POST['description']);
    $oldImage1 = mysqli_real_escape_string($conn, $_POST['oldImage1']);
    $oldImage2 = mysqli_real_escape_string($conn, $_POST['oldImage2']);
    $oldImage3 = mysqli_real_escape_string($conn, $_POST['oldImage3']);
    $oldImage4 = mysqli_real_escape_string($conn, $_POST['oldImage4']);
    $getId = mysqli_real_escape_string($conn, $_POST['testimonialId']);
    $path = './Uploads/testimonialtabs/';


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


     $gettestimonial = mysqli_query($conn,"SELECT * FROM testimonial_tabs WHERE user_name='".$Testimonial_Name."' && status=1");
    
        $count = mysqli_num_rows($gettestimonial);


        if($count < 5){


    $editTestimonials = mysqli_query($conn, "UPDATE testimonial_tabs set user_name='" . $Testimonial_Name . "',tab_name='" . $Tab . "',image1='" . $uploadImage1 . "',image2='" . $uploadImage2 . "',image3='" . $uploadImage3 . "',icon='".$uploadImage4."',img_alt_text='" . $alt_text . "',description='" . $Description . "',updated_by='" . $_SESSION['Adminname'] . "',updated_at='" . $dateFormat . "',status=1 where tab_id='" . $getId . "'");

    if ($editTestimonials === true) {
        showToast('Success', 'Updated Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='testimonialtabs.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to update Testimonial Tab', 'error');
    }

     }

    else{

          showToast('Error', 'Already 4 Tabs are added', 'error');
            echo "<script>setTimeout(()=>{location.href='testimonialtabs.php'
            },'3000');</script>";

    }

}

function deleteTestimonialtab($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');
   
    $deleteTestimonial = mysqli_query($conn, "UPDATE testimonial_tabs SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_at='" . $dateFormat . "'where tab_id='" . $getId . "'");
    if ($deleteTestimonial === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='testimonialtabs.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Testimonial Tab', 'error');
        echo "<script>setTimeout(()=>{location.href='testimonialtabs.php'
        },'1000');</script>";
    }
}


?>
