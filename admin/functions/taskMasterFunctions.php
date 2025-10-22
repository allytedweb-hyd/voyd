<?php

require_once './includes/db.php';
include './utils/alerts.php';

function addTask()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Enter_Task = mysqli_real_escape_string($conn, $_POST['task']);

    $getTask = mysqli_query($conn, "SELECT * FROM task_master WHERE task_name= '" . $Enter_Task . "' && status = 1");
    $res  = mysqli_num_rows($getTask);

    if ($res >= 1) {
        showToast('Warning', 'Task Already exists', 'warning');
    } else {

        $addTask = mysqli_query($conn, "INSERT into task_master set task_name='" . $Enter_Task . "',created_by='" . $_SESSION['admin_id'] . "',updated_by=0,created_At ='" . $dateFormat . "',updated_At=0,status=1");

        if ($addTask === true) {
            showToast('Success', 'Details added successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='taskMaster.php'
            },'1000');</script>";
        } else {
            showToast('Error', 'Task Added Failed', 'error');
        }
    }
}


function editTask()
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Enter_Task = mysqli_real_escape_string($conn, $_POST['task']);
    $getId = mysqli_real_escape_string($conn, $_POST['taskId']);

    $getTask = mysqli_query($conn, "SELECT * FROM task_master WHERE task_name= '" . $Enter_Task . "' && status = 1");
    $res  = mysqli_num_rows($getTask);

    if ($res >= 2) {
        showToast('Warning', 'Task Already exists', 'warning');
    } else {

        $editTask = mysqli_query($conn, "UPDATE task_master set task_name='" . $Enter_Task . "',updated_by='" . $_SESSION['Adminname'] . "',updated_At='" . $dateFormat . "',status=1 where task_id	='" . $getId . "'");

        if ($editTask === true) {
            showToast('Success', 'Updated Successfully', 'success');
            echo "<script>setTimeout(()=>{location.href='taskMaster.php'
        },'1000');</script>";
        } else {
            showToast('Error', 'Failed to update Task', 'error');
        }
    }
}

function deleteTask($id)
{
    $getId = $id;

    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $deleteTask = mysqli_query($conn, "UPDATE task_master SET status=0,updated_by='" . $_SESSION['admin_id'] . "',updated_At='" . $dateFormat . "'where task_id='" . $getId . "'");
    if ($deleteTask === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='taskMaster.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to delete Task', 'error');
        echo "<script>setTimeout(()=>{location.href='taskMaster.php'
        },'1000');</script>";
    }
}
