<?php

require_once './includes/db.php';
include './utils/alerts.php';

function addSupersale()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $offer = mysqli_real_escape_string($conn, $_POST['offer']);
    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
    $star_time = mysqli_real_escape_string($conn, $_POST['star_time']);
    $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);
    $end_time = mysqli_real_escape_string($conn, $_POST['end_time']);


    $start_datetime = $start_date . ' ' . $star_time;
    $end_datetime = $end_date . ' ' . $end_time;

    if (strtotime($start_datetime) >= strtotime($end_datetime)) {
        showToast('Error', 'End time must be after start time', 'error');
        return;
    }
    
    $conflictQuery = mysqli_query($conn, "SELECT * FROM super_sale WHERE status = 1 AND (
        ('$start_datetime' < CONCAT(end_date, ' ', end_time)) AND
        ('$end_datetime' > CONCAT(start_date, ' ', start_time))
    )");

if (mysqli_num_rows($conflictQuery) > 0) {
    showToast('Warning', 'Sale timing overlaps with an existing Super Sale', 'warning');
    return;
}

 

  
   
        $addColor = mysqli_query($conn, "INSERT INTO super_sale set offer='".$offer."',start_date='" . $start_date . "',start_time='" . $star_time . "',end_date='" . $end_date . "',end_time='" . $end_time . "', updated_by='" . $_SESSION['Adminname'] . "',updated_at='" . $dateFormat . "',status=1");

        if ($addColor === true) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='super_sale.php'
            },'1000');</script>";
        } else {
            showToast('Error', 'Failed to add color', 'error');
        }
    }



function editSupersale()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $offer = mysqli_real_escape_string($conn, $_POST['offer']);
    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
    $star_time = mysqli_real_escape_string($conn, $_POST['star_time']);
    $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);
    $end_time = mysqli_real_escape_string($conn, $_POST['end_time']);

    $getId = mysqli_real_escape_string($conn, $_POST['saleId']);


    $start_datetime = $start_date . ' ' . $star_time;
    $end_datetime = $end_date . ' ' . $end_time;

    if (strtotime($start_datetime) >= strtotime($end_datetime)) {
        showToast('Error', 'End time must be after start time', 'error');
        return;
    }
    
    $conflictQuery = mysqli_query($conn, "SELECT * FROM super_sale WHERE status = 1 AND super_sale_id != '$getId' AND (
        ('$start_datetime' < CONCAT(end_date, ' ', end_time)) AND
        ('$end_datetime' > CONCAT(start_date, ' ', start_time))
    )");
    

if (mysqli_num_rows($conflictQuery) > 0) {
    showToast('Warning', 'Sale timing overlaps with an existing Super Sale', 'warning');
    return;
}

  
        $editColor = mysqli_query($conn, "UPDATE super_sale set offer='".$offer."',start_date='" . $start_date . "',start_time='" . $star_time . "',end_date='" . $end_date . "',end_time='" . $end_time . "',updated_by='" . $_SESSION['Adminname'] . "',updated_at='" . $dateFormat . "' where super_sale_id='" . $getId . "'");

        if ($editColor === true) {
            showToast('Success', 'Updated Successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='super_sale.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Failed to update ', 'error');
        }
    }


function deleteSupersale($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteColor = mysqli_query($conn, "UPDATE super_sale SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_at='" . $dateFormat . "'where super_sale_id='" . $getId . "'");
    if ($deleteColor === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='super_sale.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete', 'error');
        echo "<script>setTimeout(()=>{
            location.href='super_sale.php'
        },'1000');</script>";
    }
}
