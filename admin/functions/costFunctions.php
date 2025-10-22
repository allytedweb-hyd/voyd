<?php

require_once './includes/db.php';
include './utils/alerts.php';

// function addCost()
// {
//     global $conn;
//     date_default_timezone_set('Asia/Kolkata');
//     $dateFormat = date('Y-m-d H:i:s');

//     $classification = mysqli_real_escape_string($conn, $_POST['classification']);
//     $maker_min = mysqli_real_escape_string($conn, $_POST['maker_min']);
//     $maker_max = mysqli_real_escape_string($conn, $_POST['maker_max']);
//     $material_min = mysqli_real_escape_string($conn, $_POST['material_min']);
//     $material_max = mysqli_real_escape_string($conn, $_POST['material_max']);

//     $query = "
//         INSERT INTO total_cost 
//         (classifications, maker_min, maker_max, material_min, material_max, created_at, updated_at, updated_by, status) 
//         VALUES (
//             '$classification',
//             '$maker_min',
//             '$maker_max',
//             '$material_min',
//             '$material_max',
//             '$dateFormat',
//             0,
//             0,
//             1
//         )
//     ";

//     $addCost = mysqli_query($conn, $query);

//     if ($addCost === true) {
//         showToast('Success', 'Details added successfully', 'success');
//         echo "<script>setTimeout(() => { location.href = 'total_cost.php'; }, 1000);</script>";
//     } else {
//         showToast('Error', 'Failed to add cost: " . mysqli_error($conn) . "', 'error');
//     }
// }




function addCost()
{
    global $conn;
    date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $classification = mysqli_real_escape_string($conn, $_POST['classification']);
    $maker_min = mysqli_real_escape_string($conn, $_POST['maker_min']);
    $maker_max = mysqli_real_escape_string($conn, $_POST['maker_max']);
    $material_min = mysqli_real_escape_string($conn, $_POST['material_min']);
    $material_max = mysqli_real_escape_string($conn, $_POST['material_max']);
   
    $checkQuery = mysqli_query($conn,"SELECT * FROM total_cost WHERE classifications='".$classification."' AND status = 1");
   
    $count = mysqli_num_rows($checkQuery);

    if ($count > 0) {
        showToast('Error', 'A record already exists. You can only add one.', 'error');
        echo "<script>setTimeout(() => { location.href = 'total_cost.php'; }, 2000);</script>";
        return;
    }

    


    $query = "
        INSERT INTO total_cost 
        (classifications, maker_min, maker_max, material_min, material_max, created_at, updated_at, updated_by, status) 
        VALUES (
            '$classification',
            '$maker_min',
            '$maker_max',
            '$material_min',
            '$material_max',
            '$dateFormat',
            0,
            0,
            1
        )
    ";

    $addCost = mysqli_query($conn, $query);

    if ($addCost === true) {
        showToast('Success', 'Details added successfully', 'success');
        echo "<script>setTimeout(() => { location.href = 'total_cost.php'; }, 1000);</script>";
    } else {
        showToast('Error', 'Failed to add cost: " . mysqli_error($conn) . "', 'error');
    }
}



function editCost()
{
    global $conn;
    date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $costId = mysqli_real_escape_string($conn, $_POST['cost_id']); 
    $classification = mysqli_real_escape_string($conn, $_POST['classification']);
    $maker_min = mysqli_real_escape_string($conn, $_POST['maker_min']);
    $maker_max = mysqli_real_escape_string($conn, $_POST['maker_max']);
    $material_min = mysqli_real_escape_string($conn, $_POST['material_min']);
    $material_max = mysqli_real_escape_string($conn, $_POST['material_max']);

    $updateQuery = "
        UPDATE total_cost SET 
            classifications = '$classification',
            maker_min = '$maker_min',
            maker_max = '$maker_max',
            material_min = '$material_min',
            material_max = '$material_max',
            updated_at = '$dateFormat',
            updated_by = '" . $_SESSION['Adminname'] . "'
        WHERE total_cost_id = '$costId'
    ";

    $result = mysqli_query($conn, $updateQuery);

    if ($result === true) {
        showToast('Success', 'Updated Successfully', 'success');
        echo "<script>setTimeout(() => { location.href = 'total_cost.php'; }, 1000);</script>";
    } else {
        showToast('Error', 'Failed to update cost: " . mysqli_error($conn) . "', 'error');
    }
}
function deleteCost($id)
{
    global $conn;
    date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $costId = mysqli_real_escape_string($conn, $id);

    $deleteQuery = "
        UPDATE total_cost SET 
            status = 0,
            updated_at = '$dateFormat',
            updated_by = '" . $_SESSION['admin_id'] . "'
        WHERE total_cost_id = '$costId'
    ";

    $result = mysqli_query($conn, $deleteQuery);

    if ($result === true) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(() => { location.href = 'total_cost.php'; }, 1000);</script>";
    } else {
        showToast('Error', 'Failed to delete cost: " . mysqli_error($conn) . "', 'error');
    }
}

?>