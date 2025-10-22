<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include './includes/db.php';
include './utils/alerts.php';
include './utils/imageValidation.php';

function addEmployee()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Name = mysqli_real_escape_string($conn, $_POST['name']);
    $Department = mysqli_real_escape_string($conn, $_POST['department']);
    $Mobile_Number = mysqli_real_escape_string($conn, $_POST['number']);
    $Email = mysqli_real_escape_string($conn, $_POST['email']);
    $image = $_FILES['image'];
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $conpassword = mysqli_real_escape_string($conn, $_POST['conPassword']);
    $secure_pass = password_hash($password, PASSWORD_BCRYPT);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    $path = './Uploads/adminRoles/';
    $uploadImage = validateImage($path, $image);

    $getRole = mysqli_query($conn, "SELECT * FROM admin_roles WHERE role='" . $Department . "' && status=1");
    $fetchRole = mysqli_fetch_array($getRole);
    $roleId = $fetchRole['role_id'];

    $emailCheck = mysqli_query($conn, "SELECT * FROM login_admin WHERE username = '" . $Email . "' && status=1");
    $count = mysqli_num_rows($emailCheck);



    // if ($uploadImage === false) {
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



        if ($count >= 1) {

            showToast('Warning', 'Email Already Exists, Please register using Another mail', 'warning');
        } else {
            if ($password === $conpassword) {
                $addEmployee = mysqli_query($conn, "INSERT INTO login_admin SET role_id='" . $Department . "', admin_name='" . $Name . "', admin_designation='" . $Department . "', mobile_number='" . $Mobile_Number . "', address='" . $address . "',  profile_pic='" . $uploadImage . "', img_alt='" . $alt_text . "', username='" . $Email . "', password='" . $password . "',conform_password='" . $conpassword . "',updated_by=0,created_At='" . $dateFormat . "',status=1");

                if ($addEmployee === true) {
                    showToast('Success', 'Details added successfully', 'success');
                    echo "<script>setTimeout(()=>{
                location.href='employee.php'
            },'1000');</script>";
                } else {
                    showToast('Error', 'Employee Added Failed', 'error');
                }
            } else {
                showToast('Warning', 'password did not match with confirm password', 'warning');
            }
        }
    }


function editEmployee()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

   $Name = mysqli_real_escape_string($conn, $_POST['name']);
   $roleId = mysqli_real_escape_string($conn, $_POST['department']);
    // $Department = mysqli_real_escape_string($conn, $_POST['department']);
    $Mobile_Number = mysqli_real_escape_string($conn, $_POST['number']);
    $Email = mysqli_real_escape_string($conn, $_POST['email']);
    $image = $_FILES['image'];
    $alt_text = mysqli_real_escape_string($conn, $_POST['alttext']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $conpassword = mysqli_real_escape_string($conn, $_POST['conPassword']);
    $secure_pass = password_hash($password, PASSWORD_BCRYPT);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $getId = mysqli_real_escape_string($conn, $_POST['employeeId']);
    $path = './Uploads/adminRoles/';

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

    $editEmployee = mysqli_query($conn, "UPDATE login_admin SET role_id='" . $roleId . "', admin_name='" . $Name . "', admin_designation='".$roleId."',  mobile_number='" . $Mobile_Number . "', address='" . $address . "',  profile_pic='" . $uploadImage . "', img_alt='" . $alt_text . "', username='" . $Email . "', password='" . $password . "', conform_password='" . $conpassword . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "' where id='" . $getId . "'");

    if ($editEmployee === true) {
        showToast('Success', 'Updated Successfully', 'success');
        echo "<script>setTimeout(()=>{
            location.href='employee.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to update Employee', 'error');
    }
}

function deleteEmployee($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteEmployee = mysqli_query($conn, "UPDATE login_admin SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where id='" . $getId . "'");
    if ($deleteEmployee === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{
            location.href='employee.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Employee', 'error');
        echo "<script>setTimeout(()=>{
            location.href='employee.php'
        },'1000');</script>";
    }
}