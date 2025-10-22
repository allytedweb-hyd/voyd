<?php 
// session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once './includes/db.php';
include './utils/alerts.php';
include './utils/imageValidation.php';

function addVendor()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $FirstName = mysqli_real_escape_string($conn,$_POST['FirstName']);
    $LastName = mysqli_real_escape_string($conn,$_POST['LastName']);
    $Email = mysqli_real_escape_string($conn,$_POST['email']);
    $Mobile = mysqli_real_escape_string($conn,$_POST['Phone']);
    $GST_Number = mysqli_real_escape_string($conn,$_POST['gstno']);
    $Company_Type = mysqli_real_escape_string($conn,$_POST['company']);
    $companyname = mysqli_real_escape_string($conn,$_POST['companyname']);
    $Class = mysqli_real_escape_string($conn,$_POST['class']);
    $Aadhar = mysqli_real_escape_string($conn,$_POST['aadhar']);
    $Pancard = mysqli_real_escape_string($conn,$_POST['pancard']);
    // $Country = mysqli_real_escape_string($conn,$_POST['country']);
    $State = mysqli_real_escape_string($conn,$_POST['state']);
    $City = mysqli_real_escape_string($conn,$_POST['city']);
    $Locality = mysqli_real_escape_string($conn,$_POST['locality']);
    $Address = mysqli_real_escape_string($conn,$_POST['address']);
    

        $addVendor = mysqli_query($conn, "INSERT into vendor set vendor_firstname='" . $FirstName . "',vendor_lastname='" . $LastName . "',vendor_email='" . $Email . "',vendor_mobile='" . $Mobile . "',vendor_gst='" . $GST_Number . "',vendor_company='" . $Company_Type . "',vendor_class='" . $Class . "',vendor_aadhar='" . $Aadhar . "',vendor_pancard='" . $Pancard . "',company_name='" . $companyname . "',vendor_state='" . $State . "',vendor_city='" . $City . "',vendor_locality='" . $Locality . "',vendor_address='" . $Address . "',created_by='" . $_SESSION['Adminname'] . "',updated_by=0,updated_At=0,status=2");

        if ($addVendor === true) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='vendor.php'
            },'1000');</script>";
        } else {
            showToast('Error', 'Vendor Added Failed', 'error');
        }
    }



function editVendor()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $FirstName = mysqli_real_escape_string($conn,$_POST['FirstName']);
    $LastName = mysqli_real_escape_string($conn,$_POST['LastName']);
    $Email = mysqli_real_escape_string($conn,$_POST['email']);
    $Mobile = mysqli_real_escape_string($conn,$_POST['Phone']);
    $GST_Number = mysqli_real_escape_string($conn,$_POST['gstno']);
    $Company_Type = mysqli_real_escape_string($conn,$_POST['company']);
    $Class = mysqli_real_escape_string($conn,$_POST['class']);
    $Aadhar = mysqli_real_escape_string($conn,$_POST['aadhar']);
    $Pancard = mysqli_real_escape_string($conn,$_POST['pancard']);
    // $Country = mysqli_real_escape_string($conn,$_POST['country']);
    $State = mysqli_real_escape_string($conn,$_POST['state']);
    $companyname = mysqli_real_escape_string($conn,$_POST['companyname']);
    $City = mysqli_real_escape_string($conn,$_POST['city']);
    $Locality = mysqli_real_escape_string($conn,$_POST['locality']);
    $Address = mysqli_real_escape_string($conn,$_POST['address']);
    $getId = mysqli_real_escape_string($conn, $_POST['vendorId']);

    $editVendor = mysqli_query($conn, "UPDATE vendor set vendor_firstname='" . $FirstName . "',vendor_lastname='" . $LastName . "',vendor_email='" . $Email . "',vendor_mobile='" . $Mobile . "',vendor_gst='" . $GST_Number . "',vendor_company='" . $Company_Type . "',vendor_class='" . $Class . "',vendor_aadhar='" . $Aadhar . "',vendor_pancard='" . $Pancard . "',company_name='" . $companyname . "',vendor_state='" . $State . "',vendor_city='" . $City . "',vendor_locality='" . $Locality . "',vendor_address='" . $Address . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "' where vendor_id='" . $getId . "'");

    if ($editVendor === true) {
        showToast('Success', 'Updated Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='vendor.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to update Vendor', 'error');
    }

}

function deleteVendor($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');
   
    $deleteVendor = mysqli_query($conn, "UPDATE vendor SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "' where vendor_id='" . $getId . "'");

     $deleteVendorManagement = mysqli_query($conn, "
        UPDATE vendor_management 
        SET status = 0, 
            updated_by = '" . $_SESSION['admin_id'] . "', 
            updated_at = '" . $dateFormat . "' 
        WHERE vendor_id = '" . $getId . "'"
    );


    if ($deleteVendor || $deleteVendorManagement === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='vendor.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Vendor', 'error');
        echo "<script>setTimeout(()=>{location.href='vendor.php'
        },'1000');</script>";
    }
}

?>