<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include './includes/db.php';
include './utils/alerts.php';
include './utils/imageValidation.php';

function addManufacturer() 
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Name = mysqli_real_escape_string($conn, $_POST['name']);
    $MobileNumber = mysqli_real_escape_string($conn, $_POST['Phone']);
    $Email = mysqli_real_escape_string($conn, $_POST['email']);
    $ContactNumber = mysqli_real_escape_string($conn, $_POST['Phone1']);
    $AadharNumber = mysqli_real_escape_string($conn, $_POST['aadhar']);
    $WebsiteUrl = mysqli_real_escape_string($conn, $_POST['website']);
    $StoreLocation = mysqli_real_escape_string($conn, $_POST['location']);
    $GstNumber = mysqli_real_escape_string($conn, $_POST['gstnumber']);
    $ProductType = mysqli_real_escape_string($conn, $_POST['productType']);
    $Class = mysqli_real_escape_string($conn, $_POST['class']);
    $Characteristics = mysqli_real_escape_string($conn, $_POST['characteristics']);
    $Attributes = mysqli_real_escape_string($conn, $_POST['attributes']);
    $Select_value = mysqli_real_escape_string($conn, $_POST['values']);
    $Address = mysqli_real_escape_string($conn, $_POST['address']);

    $addManufacturer = mysqli_query($conn, "INSERT into manufacturer set manufacturer_name='" . $Name . "',manufacturer_number='" . $MobileNumber . "',manufacturer_email='" . $Email . "',contact_number='" . $ContactNumber . "',manufacturer_aadhar='" . $AadharNumber . "',website_url='" . $WebsiteUrl . "',store_location='" . $StoreLocation . "',gst_number='" . $GstNumber . "',product_type='" . $ProductType . "',class='" . $Class . "',characteristics='" . $Characteristics . "',attributes='" . $Attributes . "',select_value='" . $Select_value . "',address='" . $Address . "',created_by='" . $_SESSION['admin_id'] . "',updated_by=0,created_At ='" . $dateFormat . "',updated_At=0,status=1");

    if ($addManufacturer === true) {
        showToast('Success', 'Details added successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='manufacturer.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Manufacturer Added Failed', 'error');
    }

    
}

function editManufacturer()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Name = mysqli_real_escape_string($conn, $_POST['name']);
    $MobileNumber = mysqli_real_escape_string($conn, $_POST['Phone']);
    $Email = mysqli_real_escape_string($conn, $_POST['email']);
    $ContactNumber = mysqli_real_escape_string($conn, $_POST['Phone1']);
    $AadharNumber = mysqli_real_escape_string($conn, $_POST['aadhar']);
    $WebsiteUrl = mysqli_real_escape_string($conn, $_POST['website']);
    $StoreLocation = mysqli_real_escape_string($conn, $_POST['location']);
    $GstNumber = mysqli_real_escape_string($conn, $_POST['gstnumber']);
    $ProductType = mysqli_real_escape_string($conn, $_POST['productType']);
    $Class = mysqli_real_escape_string($conn, $_POST['class']);
    $Characteristics = mysqli_real_escape_string($conn, $_POST['characteristics']);
    $Attributes = mysqli_real_escape_string($conn, $_POST['attributes']);
    $Select_value = mysqli_real_escape_string($conn, $_POST['values']);
    $Address = mysqli_real_escape_string($conn, $_POST['address']);
    $getId = mysqli_real_escape_string($conn, $_POST['manufacturerId']);
   

    $editManufacturer = mysqli_query($conn, "UPDATE manufacturer set manufacturer_name='" . $Name . "',manufacturer_number='" . $MobileNumber . "',manufacturer_email='" . $Email . "',contact_number='" . $ContactNumber . "',manufacturer_aadhar='" . $AadharNumber . "',website_url='" . $WebsiteUrl . "',store_location='" . $StoreLocation . "',gst_number='" . $GstNumber . "',product_type='" . $ProductType . "',class='" . $Class . "',characteristics='" . $Characteristics . "',attributes='" . $Attributes . "',select_value='" . $Select_value . "',address='" . $Address . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where manufacturer_id	='" . $getId . "'");

    if ($editManufacturer === true) {
        showToast('Success', 'Updated Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='manufacturer.php'
        },'1000');</script>";

    } else {
        showToast('Error', 'Failed to update Manufacturer', 'error');
    }
}

function deleteManufacturer($id)
{
     $getId = $id;

     global $conn;

     $date = date_default_timezone_set('Asia/Kolkata');
     $dateFormat = date('Y-m-d H:i:s');

     $deleteManufacturer = mysqli_query($conn, "UPDATE manufacturer SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where manufacturer_id='" . $getId . "'");
     if ($deleteManufacturer === true) {
         showToast('Success', 'Deleted Successfully', 'success');
         echo "<script>setTimeout(()=>{location.href='manufacturer.php'
         },'1000');</script>";
     } else {
         showToast('Error', 'Failed to delete Manufacturer', 'error');
         echo "<script>setTimeout(()=>{location.href='manufacturer.php'
         },'1000');</script>";
     }
}

?>