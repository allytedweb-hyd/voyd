<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include './includes/db.php';

include './utils/alerts.php';
include './utils/imageValidation.php';

function addRole()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $role = mysqli_real_escape_string($conn, strtolower($_POST['role']));

    $getRole = mysqli_query($conn, "SELECT * FROM admin_roles WHERE role = '" . $role . "' && status=1");
    $fetchRole = mysqli_fetch_array($getRole);

    if ($fetchRole >= 1) {
        showToast('warning', 'Role Already Exists', 'warning');
    } else {
        $addrole = mysqli_query($conn, "INSERT INTO admin_roles SET role='" . $role . "', status=1");

        if ($addrole) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{
                location.href='adminRoles.php'
            },'1000');</script>";
        } else {
            showToast('Error', 'Failed to add Role', 'error');
        }
    }
}

function editRole()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $roleId = mysqli_real_escape_string($conn, $_POST['roleId']);

    $editRole = mysqli_query($conn, "UPDATE admin_roles SET role='" . $role . "', updated_by='" . $_SESSION['Adminname'] . "' WHERE role_id='" . $roleId . "' && status=1");

    if ($editRole) {
        showToast('Success', 'Updated Successfully', 'success');
        echo "<script>setTimeout(()=>{
            location.href='adminRoles.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to update Role', 'error');
    }
}

function deleteRole($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteEmployee = mysqli_query($conn, "UPDATE admin_roles SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_date='" . $dateFormat . "'where role_id='" . $getId . "'");
    if ($deleteEmployee === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{
            location.href='adminRoles.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete', 'error');
        echo "<script>setTimeout(()=>{
            location.href='employee.php'
        },'1000');</script>";
    }
}
