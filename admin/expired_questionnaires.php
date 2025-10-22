<?php
include "./includes/db.php"; 


date_default_timezone_set('Asia/Kolkata'); 


$oneMonthAgo = date('Y-m-d H:i:s', strtotime('-1 month'));


$sql = "UPDATE questionnaire 
        SET status = 0 
        WHERE created_At < '$oneMonthAgo' AND status = 1";

if (mysqli_query($conn, $sql)) {
    echo " Success: Old records deactivated.\n";
} else {
    echo " Error: " . mysqli_error($conn);
}
?>


<!-- include "./includes/db.php"; 

date_default_timezone_set('Asia/Kolkata'); 

$oneDayAgo = date('Y-m-d H:i:s', strtotime('-1 day'));

$sql = "UPDATE questionnaire 
        SET status = 0 
        WHERE created_At < '$oneDayAgo' AND status = 1";

if (mysqli_query($conn, $sql)) {
    echo "Success: Records older than 1 day deactivated.\n";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?> -->
