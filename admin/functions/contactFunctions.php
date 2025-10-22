<?php

require_once './includes/db.php';
include './utils/alerts.php';

function addContact()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Address = mysqli_real_escape_string($conn, $_POST['address']);
    $Mobile_Number = mysqli_real_escape_string($conn, $_POST['number']);
    $Alternate_Number = mysqli_real_escape_string($conn, $_POST['altnumber']);
    $Timings = mysqli_real_escape_string($conn, $_POST['timings']);
    
    $addContact = mysqli_query($conn, "INSERT into contact set contact_address='" . $Address . "',contact_number='" . $Mobile_Number . "',alternate_number='" . $Alternate_Number . "',working_hours='" . $Timings . "',created_by='" . $_SESSION['Adminname'] . "',updated_by=0,created_At ='" . $dateFormat . "',updated_At=0,status=1");

    if ($addContact === true) {
        showToast('Success', 'Details added successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='contact.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Contact Added Failed', 'error');
    }
}

function editContact()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Address = mysqli_real_escape_string($conn, $_POST['address']);
    $Mobile_Number = mysqli_real_escape_string($conn, $_POST['number']);
    $Alternate_Number = mysqli_real_escape_string($conn, $_POST['altnumber']);
    $Timings = mysqli_real_escape_string($conn, $_POST['timings']);
    $getId = mysqli_real_escape_string($conn, $_POST['contactId']);
   

    $editContact = mysqli_query($conn, "UPDATE contact set contact_address='" . $Address . "',contact_number='" . $Mobile_Number . "',alternate_number='" . $Alternate_Number . "',working_hours='" . $Timings . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where contactus_id='" . $getId . "'");

    if ($editContact === true) {
        showToast('Success', 'Updated Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='contact.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to update Contact', 'error');
    }
}

function deleteContact($id)
{
     $getId = $id;

     global $conn;
     
     $date = date_default_timezone_set('Asia/Kolkata');
     $dateFormat = date('Y-m-d H:i:s');
   
    $deleteContact = mysqli_query($conn, "UPDATE contact SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where contactus_id='" . $getId . "'");
    if ($deleteContact === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='contact.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Contact', 'error');
        echo "<script>setTimeout(()=>{
            location.href='contact.php'
        },'1000');</script>";
    }
}
?>