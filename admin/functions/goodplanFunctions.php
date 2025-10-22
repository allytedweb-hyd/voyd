<?php

include './includes/db.php';
include './utils/alerts.php';
include './utils/imageValidation.php';

date_default_timezone_set('Asia/Kolkata');


function addGoodplan()
{
    global $conn;

    $dateFormat = date('Y-m-d H:i:s');
    // $path = './Uploads/goodplans/';

    $maker_classification = mysqli_real_escape_string($conn, $_POST['maker_classification']);
    $material_classification = mysqli_real_escape_string($conn, $_POST['material_classification']);
    $maker_text = mysqli_real_escape_string($conn, $_POST['maker_text']);
    $maker_icon = mysqli_real_escape_string($conn, $_POST['maker_icon']);
    $material_icon = mysqli_real_escape_string($conn, $_POST['material_icon']);
    $material_text = mysqli_real_escape_string($conn, $_POST['material_text']);
    $project_cost = mysqli_real_escape_string($conn, $_POST['project_cost']);

   
    // $maker_icon = validateImage($path, $_FILES['maker_icon']);
    // if ($maker_icon === false) {
    //     showToast('Error', 'Maker Icon Upload Failed', 'error');
    //     return;
    // }

    
    // $material_icon = validateImage($path, $_FILES['material_icon']);
    // if ($material_icon === false) {
    //     showToast('Error', 'Material Icon Upload Failed', 'error');
    //     return;
    // }


    $getplans = mysqli_query($conn,"SELECT * FROM good_plans WHERE status=1 AND (maker_classification='".$maker_classification."' AND material_classification='".$material_classification."')");


    $plancount = mysqli_num_rows($getplans);

    if( $plancount>0){

        showToast('Error', 'Combination Already Exists', 'error');

}

    else{

    


    $query = "INSERT INTO good_plans SET 
        maker_classification='$maker_classification',
        maker_icon='$maker_icon',
        maker_text='$maker_text',
        material_classification='$material_classification',
        material_icon='$material_icon',
        material_text='$material_text',
        project_cost='$project_cost',
        created_at='0',
        updated_at='0',
        updated_by=0,
       
        
        status=1";

    $result = mysqli_query($conn, $query);

    if ($result) {
        showToast('Success', 'Details added successfully', 'success');
        echo "<script>setTimeout(() => { location.href='good_plans.php'; }, 1000);</script>";
    } else {
        showToast('Error', 'Failed to Add Good Plan', 'error');
    }
}
}


function editGoodplan()
{
    global $conn;

    $dateFormat = date('Y-m-d H:i:s');
    // $path = './Uploads/goodplans/';

    $galleryId = mysqli_real_escape_string($conn, $_POST['galleryId']);
    $maker_classification = mysqli_real_escape_string($conn, $_POST['maker_classification']);
    $material_classification = mysqli_real_escape_string($conn, $_POST['material_classification']);
    $maker_text = mysqli_real_escape_string($conn, $_POST['maker_text']);
    $material_text = mysqli_real_escape_string($conn, $_POST['material_text']);
    $project_cost = mysqli_real_escape_string($conn, $_POST['project_cost']);
       
     $maker_icon = mysqli_real_escape_string($conn, $_POST['maker_icon']);
    $material_icon = mysqli_real_escape_string($conn, $_POST['material_icon']);

    // $old_maker_icon = mysqli_real_escape_string($conn, $_POST['oldImage']);
    // $old_material_icon = mysqli_real_escape_string($conn, $_POST['oldImage1']);

    
    // if (isset($_FILES['maker_icon']) && $_FILES['maker_icon']['error'] === 0) {
    //     $maker_icon = validateImage($path, $_FILES['maker_icon']);
    //     if ($maker_icon === false) {
    //         showToast('Error', 'Maker Icon Upload Failed', 'error');
    //         return;
    //     } else {
    //         if (file_exists($path . $old_maker_icon)) unlink($path . $old_maker_icon);
    //     }
    // } else {
    //     $maker_icon = $old_maker_icon;
    // }

    
    // if (isset($_FILES['material_icon']) && $_FILES['material_icon']['error'] === 0) {
    //     $material_icon = validateImage($path, $_FILES['material_icon']);
    //     if ($material_icon === false) {
    //         showToast('Error', 'Material Icon Upload Failed', 'error');
    //         return;
    //     } else {
    //         if (file_exists($path . $old_material_icon)) unlink($path . $old_material_icon);
    //     }
    // } else {
    //     $material_icon = $old_material_icon;
    // }


      $getplans = mysqli_query($conn,"SELECT * FROM good_plans WHERE status=1 AND (maker_classification='".$maker_classification."' AND material_classification='".$material_classification."')");


    $plancount = mysqli_num_rows($getplans);

    if( $plancount>1){

        showToast('Error', 'Combination Already Exists', 'error');

}

    else{




    $update = "UPDATE good_plans SET 
        maker_classification='$maker_classification',
        maker_icon='$maker_icon',
        maker_text='$maker_text',
        material_classification='$material_classification',
        material_icon='$material_icon',
        material_text='$material_text',
        project_cost='$project_cost',
        updated_at='$dateFormat',
        updated_by='" . $_SESSION['Adminname'] . "'
        WHERE good_plan_id='$galleryId'";

    $result = mysqli_query($conn, $update);

    if ($result) {
        showToast('Success', 'Updated Successfully', 'success');
        echo "<script>setTimeout(() => { location.href='good_plans.php'; }, 1000);</script>";
    } else {
        showToast('Error', 'Failed to Update Good Plan', 'error');
    }
}
}


function deleteGoodplan($id)
{
    global $conn;

    $dateFormat = date('Y-m-d H:i:s');
    $id = mysqli_real_escape_string($conn, $id);

    $query = "UPDATE good_plans SET 
        status=0, 
        updated_by='" . $_SESSION['admin_id'] . "',
        updated_at='$dateFormat'
        WHERE good_plan_id='$id'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        showToast('Success', 'Deleted Successfully', 'success');
        echo "<script>setTimeout(() => { location.href='good_plans.php'; }, 1000);</script>";
    } else {
        showToast('Error', 'Failed to Delete Good Plan', 'error');
    }
}
