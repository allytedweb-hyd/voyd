<?php 
include 'includes/db.php';

$update = mysqli_query($conn, "UPDATE blog SET status=1 where blog_id='".$_POST['id']."' ");
if($update==true)
{
    echo "<script>alert('updated successfully')</script>";
    echo "<script>window.location.href='blog.php'</script>";
}
else{
    echo "<script>alert('failed to update')</script>";
}

?>