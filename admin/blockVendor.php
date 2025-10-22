<?php 
include 'includes/db.php';

if(isset($_POST['id'])){
    $date = date_default_timezone_set('Asia/Kolkata');
    $dateFormat = date('Y-m-d H:i:s');

    $Popup = $_POST['reason'];


    $update = mysqli_query($conn, "UPDATE vendor SET status=4,block_reason='".$Popup."' where vendor_id='".$_POST['id']."'");
    if($update==true)
    {
        showToast('Success', 'Reason Added Successfully', 'success');
    }
    else{
        echo "<script>alert('failed to update')</script>";
    }

}

?>