<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



include './includes/db.php';
include './includes/header.php';
include './utils/alerts.php';
include './utils/imageValidation.php';


function addVendorManagement()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $vendorName = mysqli_real_escape_string($conn, $_POST['vendor_name']);



    $vendorImage = $_FILES['vendor_image'];
    $vendorDescription = mysqli_real_escape_string($conn, $_POST['vendorDescription']);
    $projectsDone = mysqli_real_escape_string($conn, $_POST['projects_done']);
    $noOfClients = mysqli_real_escape_string($conn, $_POST['no_of_clients']);
    $vendorPavilion = mysqli_real_escape_string($conn, $_POST['vendor_pavilion']);
    $vendorAwards = mysqli_real_escape_string($conn, $_POST['vendor_awards']);
    $noOfSpaces = mysqli_real_escape_string($conn, $_POST['no_of_spaces']);
    $noOfWorkers = mysqli_real_escape_string($conn, $_POST['no_of_workers']);
    $projectImageOne = $_FILES['project_image_one'];
    $projectImageTwo = $_FILES['project_image_two'];
    $vendorExploreCity = mysqli_real_escape_string($conn, $_POST['vendor_explore_city']);
    $vendorLocationOne = mysqli_real_escape_string($conn, $_POST['vendor_location_one']);
    $vendorLocationTwo = mysqli_real_escape_string($conn, $_POST['vendor_location_two']);
    $vendorLocationThree = mysqli_real_escape_string($conn, $_POST['vendor_location_three']);
    $materialNameOne = mysqli_real_escape_string($conn, $_POST['material_name_one']);
    $materialImageOne = $_FILES['material_image_one'];
    $materialPriceeOne = mysqli_real_escape_string($conn, $_POST['material_price_one']);
    $materialNameTwo = mysqli_real_escape_string($conn, $_POST['material_name_two']);
    $materialImageTwo = $_FILES['material_image_two'];
    $materialPriceTwo = mysqli_real_escape_string($conn, $_POST['material_price_two']);
    $materialNameThree = mysqli_real_escape_string($conn, $_POST['material_name_three']);
    $materialImageThree = $_FILES['material_image_three'];
    $materialPriceThree = mysqli_real_escape_string($conn, $_POST['material_price_three']);
    $materialNameFour = mysqli_real_escape_string($conn, $_POST['material_name_four']);
    $materialImageFour = $_FILES['material_image_four'];
    $materialPriceFour = mysqli_real_escape_string($conn, $_POST['material_price_four']);
    $materialNameFive = mysqli_real_escape_string($conn, $_POST['material_name_five']);
    $materialImageFive = $_FILES['material_image_five'];
    $materialPriceFive = mysqli_real_escape_string($conn, $_POST['material_price_five']);
    $materialNameSix = mysqli_real_escape_string($conn, $_POST['material_name_six']);
    $materialImageSix = $_FILES['material_image_six'];
    $materialPriceSix = mysqli_real_escape_string($conn, $_POST['material_price_six']);

//     $oldImage1 = mysqli_real_escape_string($conn, $_POST['oldImage1']);
// $oldImage2 = mysqli_real_escape_string($conn, $_POST['oldImage2']);
// $oldImage3 = mysqli_real_escape_string($conn, $_POST['oldImage3']);
// $oldImage4 = mysqli_real_escape_string($conn, $_POST['oldImage4']);
// $oldImage5 = mysqli_real_escape_string($conn, $_POST['oldImage5']);
// $oldImage6 = mysqli_real_escape_string($conn, $_POST['oldImage6']);
// $oldImage7 = mysqli_real_escape_string($conn, $_POST['oldImage7']);
// $oldImage8 = mysqli_real_escape_string($conn, $_POST['oldImage8']);
// $oldImage9 = mysqli_real_escape_string($conn, $_POST['oldImage9']);


    $path = $_SERVER['DOCUMENT_ROOT'] . '/mr.Interior/admin/Uploads/vendor-management';
    // $path = '../Uploads/vendor-management/';


    // $uploadVendorImage = ValidateImage($path, $vendorImage);
    // $uploadprojectImageOne = ValidateImage($path, $projectImageOne);
    // $uploadprojectImageTwo = ValidateImage($path, $projectImageTwo);
    // $uploadMaterialImageOne = ValidateImage($path, $materialImageOne);
    // $uploadMaterialImageTwo = ValidateImage($path, $materialImageTwo);
    // $uploadMaterialImageThree = ValidateImage($path, $materialImageThree);
    // $uploadMaterialImageFour = ValidateImage($path, $materialImageFour);
    // $uploadMaterialImageFive = ValidateImage($path, $materialImageFive);
    // $uploadMaterialImageSix = ValidateImage($path, $materialImageSix);

    // if (!$uploadVendorImage || !$uploadprojectImageOne || !$uploadprojectImageTwo || !$uploadMaterialImageOne || !$uploadMaterialImageTwo || !$uploadMaterialImageThree || !$uploadMaterialImageFour || !$uploadMaterialImageFive || !$uploadMaterialImageSix) {
    //     showToast('Error', 'Image upload failed.', 'error');
    //     return;
    // }


 
if (isset($vendorImage) && $vendorImage['error'] === 0) {
    $uploadVendorImage = validateImage($path, $vendorImage);
    if ($uploadVendorImage === false) {
        showToast('Error', 'Vendor Image Upload Failed', 'error');
        return;
    } 
}
//     else {
//         if (!empty($oldImage1) && file_exists($path . $oldImage1)) {
//             unlink($path . $oldImage1);
//         }
//     }
// } else {
//     $uploadVendorImage = $oldImage1;
// }


if (isset($projectImageOne) && $projectImageOne['error'] === 0) {
    $uploadprojectImageOne = validateImage($path, $projectImageOne);
    if ($uploadprojectImageOne === false) {
        showToast('Error', 'Project Image One Upload Failed', 'error');
        return;
    } 
}
//     else {
//         if (!empty($oldImage2) && file_exists($path . $oldImage2)) {
//             unlink($path . $oldImage2);
//         }
//     }
// } else {
//     $uploadprojectImageOne = $oldImage2;
// }


if (isset($projectImageTwo) && $projectImageTwo['error'] === 0) {
    $uploadprojectImageTwo = validateImage($path, $projectImageTwo);
    if ($uploadprojectImageTwo === false) {
        showToast('Error', 'Project Image Two Upload Failed', 'error');
        return;
    } 
    }
//     else {
//         if (!empty($oldImage3) && file_exists($path . $oldImage3)) {
//             unlink($path . $oldImage3);
//         }
//     }
// } else {
//     $uploadprojectImageTwo = $oldImage3;
// }


if (isset($materialImageOne) && $materialImageOne['error'] === 0) {
    $uploadMaterialImageOne = validateImage($path, $materialImageOne);
    if ($uploadMaterialImageOne === false) {
        showToast('Error', 'Material Image One Upload Failed', 'error');
        return;
    } 
    }
//     else {
//         if (!empty($oldImage4) && file_exists($path . $oldImage4)) {
//             unlink($path . $oldImage4);
//         }
//     }
// } else {
//     $uploadMaterialImageOne = $oldImage4;
// }


if (isset($materialImageTwo) && $materialImageTwo['error'] === 0) {
    $uploadMaterialImageTwo = validateImage($path, $materialImageTwo);
    if ($uploadMaterialImageTwo === false) {
        showToast('Error', 'Material Image Two Upload Failed', 'error');
        return;
    } 
    }
//     else {
//         if (!empty($oldImage5) && file_exists($path . $oldImage5)) {
//             unlink($path . $oldImage5);
//         }
//     }
// } else {
//     $uploadMaterialImageTwo = $oldImage5;
// }


if (isset($materialImageThree) && $materialImageThree['error'] === 0) {
    $uploadMaterialImageThree = validateImage($path, $materialImageThree);
    if ($uploadMaterialImageThree === false) {
        showToast('Error', 'Material Image Three Upload Failed', 'error');
        return;
    } 
    }
//     else {
//         if (!empty($oldImage6) && file_exists($path . $oldImage6)) {
//             unlink($path . $oldImage6);
//         }
//     }
// } else {
//     $uploadMaterialImageThree = $oldImage6;
// }


if (isset($materialImageFour) && $materialImageFour['error'] === 0) {
    $uploadMaterialImageFour = validateImage($path, $materialImageFour);
    if ($uploadMaterialImageFour === false) {
        showToast('Error', 'Material Image Four Upload Failed', 'error');
        return;
    } 
    }
//     else {
//         if (!empty($oldImage7) && file_exists($path . $oldImage7)) {
//             unlink($path . $oldImage7);
//         }
//     }
// } else {
//     $uploadMaterialImageFour = $oldImage7;
// }


if (isset($materialImageFive) && $materialImageFive['error'] === 0) {
    $uploadMaterialImageFive = validateImage($path, $materialImageFive);
    if ($uploadMaterialImageFive === false) {
        showToast('Error', 'Material Image Five Upload Failed', 'error');
        return;
    } 
    }
//     else {
//         if (!empty($oldImage8) && file_exists($path . $oldImage8)) {
//             unlink($path . $oldImage8);
//         }
//     }
// } else {
//     $uploadMaterialImageFive = $oldImage8;
// }


if (isset($materialImageSix) && $materialImageSix['error'] === 0) {
    $uploadMaterialImageSix = validateImage($path, $materialImageSix);
    if ($uploadMaterialImageSix === false) {
        showToast('Error', 'Material Image Six Upload Failed', 'error');
        return;
    }
    }
//      else {
//         if (!empty($oldImage9) && file_exists($path . $oldImage9)) {
//             unlink($path . $oldImage9);
//         }
//     }
// } else {
//     $uploadMaterialImageSix = $oldImage9;
// }




    



    $getNameById = mysqli_query($conn, "SELECT * FROM vendor WHERE vendor_id='" . $vendorName . "'");
    $resultByID = mysqli_fetch_array($getNameById);
    $vendorNameById = $resultByID['vendor_firstname'] . " " . $resultByID['vendor_lastname'];


    $duplicateEntry = mysqli_query($conn, "SELECT * FROM vendor_management WHERE vendor_id ='" . $vendorName . "' AND status=1");
    $duplicateCount = mysqli_num_rows($duplicateEntry);
    if ($duplicateCount > 0) {
        showToast('Oops', 'Data Already Exists ', 'warning');
        echo "<script>
         setTimeout(function() {
        window.location.href = 'manage-vendor-list.php';
    }, 1500);
    </script>";
    } else {


        $query = mysqli_query($conn, "INSERT INTO vendor_management SET vendor_id='" . $vendorName . "',vendor_full_name='" . $vendorNameById . "',vendor_image='" . $uploadVendorImage . "',vendor_description='" . $vendorDescription . "',projects_done='" . $projectsDone . "',no_of_clients='" . $noOfClients . "',pavilion='" . $vendorPavilion . "',awards='" . $vendorAwards . "',spaces='" . $noOfSpaces . "',workers='" . $noOfWorkers . "',project_img_one='" . $uploadprojectImageOne . "',project_img_two='" . $uploadprojectImageTwo . "',explore_city='" . $vendorExploreCity . "', preffered_location_one='" . $vendorLocationOne . "', preffered_location_two='" . $vendorLocationTwo . "', preffered_location_three='" . $vendorLocationThree . "', material_img_one='" . $uploadMaterialImageOne . "', material_name_one='" . $materialNameOne . "', material_price_one='" . $materialPriceeOne . "', material_img_two='" . $uploadMaterialImageTwo . "',material_name_two='" . $materialNameTwo . "',material_price_two='" . $materialPriceTwo . "', material_img_three='" . $uploadMaterialImageThree . "',material_name_three='" . $materialNameThree . "',material_price_three='" . $materialPriceThree . "', material_img_four='" . $uploadMaterialImageFour . "', material_name_four='" . $materialNameFour . "',material_price_four='" . $materialPriceFour . "', material_img_five='" . $uploadMaterialImageFive . "',material_name_five='" . $materialNameFive . "',material_price_five='" . $materialPriceFive . "',material_img_six='" . $uploadMaterialImageSix . "', material_name_six='" . $materialNameSix . "', material_price_six='" . $materialPriceSix . "',updated_by=0, status=1");

        // echo $query;

        // $addVendor = mysqli_query($conn, $query);

        if ($query) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>
         setTimeout(function() {
        window.location.href = 'manage-vendor-list.php';
    }, 1500);
    </script>";
        } else {
            showToast('Error', 'Failed to add ', 'error');
        }
    }
}

function editVendorManagement()
{

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $vendorName = mysqli_real_escape_string($conn, $_POST['vendor_name']);
    $vendorImage = $_FILES['vendor_image'];
    $vendorDescription = mysqli_real_escape_string($conn, $_POST['vendorDescription']);
    $vendorExploreCity = mysqli_real_escape_string($conn, $_POST['vendor_explore_city']);
    $projectsDone = mysqli_real_escape_string($conn, $_POST['projects_done']);
    $noOfClients = mysqli_real_escape_string($conn, $_POST['no_of_clients']);
    $vendorPavilion = mysqli_real_escape_string($conn, $_POST['vendor_pavilion']);
    $vendorAwards = mysqli_real_escape_string($conn, $_POST['vendor_awards']);
    $noOfSpaces = mysqli_real_escape_string($conn, $_POST['no_of_spaces']);
    $noOfWorkers = mysqli_real_escape_string($conn, $_POST['no_of_workers']);
    $projectImageOne = $_FILES['project_image_one'];
    $projectImageTwo = $_FILES['project_image_two'];
    $vendorExploreCity = mysqli_real_escape_string($conn, $_POST['vendor_explore_city']);
    $vendorLocationOne = mysqli_real_escape_string($conn, $_POST['vendor_location_one']);
    $vendorLocationTwo = mysqli_real_escape_string($conn, $_POST['vendor_location_two']);
    $vendorLocationThree = mysqli_real_escape_string($conn, $_POST['vendor_location_three']);
    $materialNameOne = mysqli_real_escape_string($conn, $_POST['material_name_one']);
    $materialImageOne = $_FILES['material_image_one'];
    $materialPriceeOne = mysqli_real_escape_string($conn, $_POST['material_price_one']);
    $materialNameTwo = mysqli_real_escape_string($conn, $_POST['material_name_two']);
    $materialImageTwo = $_FILES['material_image_two'];
    $materialPriceTwo = mysqli_real_escape_string($conn, $_POST['material_price_two']);
    $materialNameThree = mysqli_real_escape_string($conn, $_POST['material_name_three']);
    $materialImageThree = $_FILES['material_image_three'];
    $materialPriceThree = mysqli_real_escape_string($conn, $_POST['material_price_three']);
    $materialNameFour = mysqli_real_escape_string($conn, $_POST['material_name_four']);
    $materialImageFour = $_FILES['material_image_four'];
    $materialPriceFour = mysqli_real_escape_string($conn, $_POST['material_price_four']);
    $materialNameFive = mysqli_real_escape_string($conn, $_POST['material_name_five']);
    $materialImageFive = $_FILES['material_image_five'];
    $materialPriceFive = mysqli_real_escape_string($conn, $_POST['material_price_five']);
    $materialNameSix = mysqli_real_escape_string($conn, $_POST['material_name_six']);
    $materialImageSix = $_FILES['material_image_six'];
    $materialPriceSix = mysqli_real_escape_string($conn, $_POST['material_price_six']);

    $oldImage1 = mysqli_real_escape_string($conn, $_POST['oldImage1']);
    $oldImage2 = mysqli_real_escape_string($conn, $_POST['oldImage2']);
    $oldImage3 = mysqli_real_escape_string($conn, $_POST['oldImage3']);
    $oldImage4 = mysqli_real_escape_string($conn, $_POST['oldImage4']);
    $oldImage5 = mysqli_real_escape_string($conn, $_POST['oldImage5']);
    $oldImage6 = mysqli_real_escape_string($conn, $_POST['oldImage6']);
    $oldImage7 = mysqli_real_escape_string($conn, $_POST['oldImage7']);
    $oldImage8 = mysqli_real_escape_string($conn, $_POST['oldImage8']);
    $oldImage9 = mysqli_real_escape_string($conn, $_POST['oldImage9']);
    $getId = mysqli_real_escape_string($conn, $_POST['vendor_image_id']);


    $path = $_SERVER['DOCUMENT_ROOT'] . '/mr.Interior/admin/Uploads/vendor-management';
    // $path = '../Uploads/vendor-management/';


    if (isset($vendorImage) && $vendorImage['error'] === 0) {
        $uploadVendorImage = validateImage($path, $vendorImage);
        if ($uploadVendorImage === false) {
            showToast('Error', 'Image Upload Failed', 'error');
        } else {
            unlink($path . $oldImage1);
        }
    } else {
        $uploadVendorImage = $oldImage1;
    }


    if (isset($projectImageOne) && $projectImageOne['error'] === 0) {
        $uploadProjectImageOne = validateImage($path, $projectImageOne);
        if ($uploadProjectImageOne === false) {
            showToast('Error', 'Image Upload Failed', 'error');
        } else {
            unlink($path . $oldImage2);
        }
    } else {
        $uploadProjectImageOne = $oldImage2;
    }


    if (isset($projectImageTwo) && $projectImageTwo['error'] === 0) {
        $uploadProjectImageTwo = validateImage($path, $projectImageTwo);
        if ($uploadProjectImageTwo === false) {
            showToast('Error', 'Project Image 2 Upload Failed', 'error');
        } else {
            unlink($path . $oldImage3);
        }
    } else {
        $uploadProjectImageTwo = $oldImage3;
    }


    if (isset($materialImageOne) && $materialImageOne['error'] === 0) {
        $uploadMaterialImageOne = validateImage($path, $materialImageOne);
        if ($uploadMaterialImageOne === false) {
            showToast('Error', 'Image Upload Failed', 'error');
        } else {
            unlink($path . $oldImage4);
        }
    } else {
        $uploadMaterialImageOne = $oldImage4;
    }


    if (isset($materialImageTwo) && $materialImageTwo['error'] === 0) {
        $uploadMaterialImageTwo = validateImage($path, $materialImageTwo);
        if ($uploadMaterialImageTwo === false) {
            showToast('Error', 'Image Upload Failed', 'error');
        } else {
            unlink($path . $oldImage5);
        }
    } else {
        $uploadMaterialImageTwo = $oldImage5;
    }


    if (isset($materialImageThree) && $materialImageThree['error'] === 0) {
        $uploadMaterialImageThree = validateImage($path, $materialImageThree);
        if ($uploadMaterialImageThree === false) {
            showToast('Error', 'Image Upload Failed', 'error');
        } else {
            unlink($path . $oldImage6);
        }
    } else {
        $uploadMaterialImageThree = $oldImage6;
    }


    if (isset($materialImageFour) && $materialImageFour['error'] === 0) {
        $uploadMaterialImageFour = validateImage($path, $materialImageFour);
        if ($uploadMaterialImageFour === false) {
            showToast('Error', 'Image Upload Failed', 'error');
        } else {
            unlink($path . $oldImage7);
        }
    } else {
        $uploadMaterialImageFour = $oldImage7;
    }


    if (isset($materialImageFive) && $materialImageFive['error'] === 0) {
        $uploadMaterialImageFive = validateImage($path, $materialImageFive);
        if ($uploadMaterialImageFive === false) {
            showToast('Error', 'Image Upload Failed', 'error');
        } else {
            unlink($path . $oldImage8);
        }
    } else {
        $uploadMaterialImageFive = $oldImage8;
    }


    if (isset($materialImageSix) && $materialImageSix['error'] === 0) {
        $uploadMaterialImageSix = validateImage($path, $materialImageSix);
        if ($uploadMaterialImageSix === false) {
            showToast('Error', 'Image Upload Failed', 'error');
        } else {
            unlink($path . $oldImage9);
        }
    } else {
        $uploadMaterialImageSix = $oldImage9;
    }


    $getNameById = mysqli_query($conn, "SELECT * FROM vendor WHERE vendor_id='" . $vendorName . "'");
    $resultByID = mysqli_fetch_array($getNameById);
    $vendorNameById = $resultByID['vendor_firstname'] . " " . $resultByID['vendor_lastname'];

    $query = mysqli_query($conn, "
UPDATE vendor_management SET 
    vendor_id='" . $vendorName . "',
    vendor_full_name='" . $vendorNameById . "',
    vendor_image='" . $uploadVendorImage . "',
    vendor_description='" . $vendorDescription . "',
    projects_done='" . $projectsDone . "',
    no_of_clients='" . $noOfClients . "',
    pavilion='" . $vendorPavilion . "',
    awards='" . $vendorAwards . "',
    explore_city='" . $vendorExploreCity . "',
    spaces='" . $noOfSpaces . "',
    workers='" . $noOfWorkers . "',
    project_img_one='" . $uploadProjectImageOne . "',
    project_img_two='" . $uploadProjectImageTwo . "',
    preffered_location_one='" . $vendorLocationOne . "',
    preffered_location_two='" . $vendorLocationTwo . "',
    preffered_location_three='" . $vendorLocationThree . "',
    material_img_one='" . $uploadMaterialImageOne . "',
    material_name_one='" . $materialNameOne . "',
    material_price_one='" . $materialPriceeOne . "',
    material_img_two='" . $uploadMaterialImageTwo . "',
    material_name_two='" . $materialNameTwo . "',
    material_price_two='" . $materialPriceTwo . "',
    material_img_three='" . $uploadMaterialImageThree . "',
    material_name_three='" . $materialNameThree . "',
    material_price_three='" . $materialPriceThree . "',
    material_img_four='" . $uploadMaterialImageFour . "',
    material_name_four='" . $materialNameFour . "',
    material_price_four='" . $materialPriceFour . "',
    material_img_five='" . $uploadMaterialImageFive . "',
    material_name_five='" . $materialNameFive . "',
    material_price_five='" . $materialPriceFive . "',
    material_img_six='" . $uploadMaterialImageSix . "',
    material_name_six='" . $materialNameSix . "',
    material_price_six='" . $materialPriceSix . "',
    updated_by='" . $_SESSION['Adminname'] . "'  
WHERE id='" . $getId . "' AND status=1");



    // echo $query;

    // $addVendor = mysqli_query($conn, $query);

    if ($query) {
        showToast('Success', 'Updated Successfully', 'success');
        echo "<script>
                window.location.href='manage-vendor-list.php'
          </script>";
    } else {
        showToast('Error', 'Failed to Update ', 'error');
        echo "<script>
                window.location.href='manage-vendor-list.php'
          </script>";
    }
}


function deleteVendorManagement($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteVendorManagement = mysqli_query($conn, "UPDATE vendor_management SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_at='" . $dateFormat . "'where id='" . $getId . "'");
    if ($deleteVendorManagement === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{
            location.href='manage-vendor-list.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete', 'error');
        echo "<script>setTimeout(()=>{
            location.href='manage-vendor-list.php'
        },'1000');</script>";
    }
}
