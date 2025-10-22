<?php

require_once './includes/db.php';
include './utils/alerts.php';

function addAddon()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $QuestionnaireId = mysqli_real_escape_string($conn, $_POST['questionnaire']);
    $CustomerId = mysqli_real_escape_string($conn, $_POST['customer']);
    $CustomerName = mysqli_real_escape_string($conn, $_POST['project']);
    $ProjectName = mysqli_real_escape_string($conn, $_POST['name']);
    $ProjectClass = mysqli_real_escape_string($conn, $_POST['class']);
    $VendorName = mysqli_real_escape_string($conn, $_POST['Vendorname']);
    $ItemName = mysqli_real_escape_string($conn, $_POST['itemname']);
    $ItemCode = mysqli_real_escape_string($conn, $_POST['code']);
    $Quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $itemCost = mysqli_real_escape_string($conn, $_POST['itemCost']);

    $addAddon = mysqli_query($conn, "INSERT into quotation_addon set que_id='" . $QuestionnaireId . "',customer_id='" . $CustomerId . "',customer_name='" . $CustomerName . "',project_name='" . $ProjectName . "',project_class='" . $ProjectClass . "',vendor_name='" . $VendorName . "',item_name='" . $ItemName . "',item_code='" . $ItemCode . "',quantity='" . $Quantity . "',item_cost='" . $itemCost . "',created_by='" . $_SESSION['admin_id'] . "',updated_by=0,created_At ='" . $dateFormat . "',updated_At=0,status=1");

    if ($addAddon === true) {
        showToast('Success', 'Details added successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='assignedUserProjects.php'
            },'1000');</script>";
    } else {
        showToast('Error', 'Quotation Added Failed', 'error');
    }
}


function editAddon()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $QuestionnaireId = mysqli_real_escape_string($conn, $_POST['questionnaire']);
    $CustomerId = mysqli_real_escape_string($conn, $_POST['customer']);
    $CustomerName = mysqli_real_escape_string($conn, $_POST['project']);
    $ProjectName = mysqli_real_escape_string($conn, $_POST['name']);
    $ProjectClass = mysqli_real_escape_string($conn, $_POST['class']);
    $VendorName = mysqli_real_escape_string($conn, $_POST['Vendorname']);
    $ItemName = mysqli_real_escape_string($conn, $_POST['itemname']);
    $ItemCode = mysqli_real_escape_string($conn, $_POST['code']);
    $Quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $getId = mysqli_real_escape_string($conn, $_POST['addonId']);
    $itemCost = mysqli_real_escape_string($conn, $_POST['itemCost']);


    $editAddon = mysqli_query($conn, "UPDATE quotation_addon set que_id='" . $QuestionnaireId . "',customer_id='" . $CustomerId . "',customer_name='" . $CustomerName . "',project_name='" . $ProjectName . "',project_class='" . $ProjectClass . "',vendor_name='" . $VendorName . "',item_name='" . $ItemName . "',item_code='" . $ItemCode . "',quantity='" . $Quantity . "',item_cost='" . $itemCost . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where addon_id	='" . $getId . "'");

    if ($editAddon === true) {
        showToast('Success', 'Updated Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='assignedUserProjects.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to update Quotation', 'error');
    }
}


function deleteAddon($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteAddon = mysqli_query($conn, "UPDATE quotation_addon SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where addon_id='" . $getId . "'");
    if ($deleteAddon === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='assignedUserProjects.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Quotation', 'error');
        echo "<script>setTimeout(()=>{location.href='assignedUserProjects.php'
        },'1000');</script>";
    }
}