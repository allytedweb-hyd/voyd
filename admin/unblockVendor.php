<?php 
include 'includes/db.php';

$update = mysqli_query($conn, "UPDATE vendor SET status=5,block_reason='' where vendor_id='".$_POST['id']."' ");
if($update==true)
{
    echo "<script>alert('updated successfully')</script>";
    echo "<script>window.location.href='vendor.php'</script>";
}
else{
    echo "<script>alert('failed to update')</script>";
}

?>