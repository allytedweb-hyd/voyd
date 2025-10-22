<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include './includes/db.php';
include 'utils/alerts.php';


function assignProject($que_id)
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $assignedProjectUser = mysqli_real_escape_string($conn, $_POST['projectUser']);
    $assignedVendor = mysqli_real_escape_string($conn, $_POST['vendor']);
    $projectDeadline = mysqli_real_escape_string($conn, $_POST['endDate']);
    $startDate = mysqli_real_escape_string($conn, $_POST['startDate']);
    

    $updateProject = mysqli_query($conn, "UPDATE questionnaire tbl1, quotation tbl2 SET tbl2.assigned_project_user = '" . $assignedProjectUser . "', tbl2.assigned_vendor='" . $assignedVendor . "', tbl2.deadline='" . $projectDeadline . "',tbl2.startdate='" . $startDate . "',tbl2.createdBy = '" . $_SESSION['Adminname'] . "' WHERE tbl1.que_id = tbl2.que_id AND tbl1.que_id='" . $que_id . "' AND tbl1.status=1");
    if ($updateProject === true) {
        showToast('Success', 'Project Assigned Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='questionnaire_form.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to Assign Project', 'error');
    }
}



function assignManager($que_id)
{
    global $conn;

    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $assignedProjectUser = mysqli_real_escape_string($conn, $_POST['projectUser']);
    // $assignedVendor = mysqli_real_escape_string($conn, $_POST['vendor']);
    // $projectDeadline = mysqli_real_escape_string($conn, $_POST['endDate']);
    // $startDate = mysqli_real_escape_string($conn, $_POST['startDate']);
    

    $updateProject = mysqli_query($conn, "UPDATE questionnaire tbl1, quotation tbl2 SET tbl2.manager_id = '" . $assignedProjectUser . "', tbl2.createdBy = '" . $_SESSION['Adminname'] . "' WHERE tbl1.que_id = tbl2.que_id AND tbl1.que_id='" . $que_id . "' AND tbl1.status=1");
    if ($updateProject === true) {
        showToast('Success', 'Project Assigned Successfully', 'success');
        echo "<script>setTimeout(()=>{location.href='admin_assign_projects.php'
        },'1000');</script>";
    } else {
        showToast('Error', 'Failed to Assign Project', 'error');
    }
}