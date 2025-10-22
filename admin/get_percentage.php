<?php
include 'includes/db.php';

if (isset($_POST['task_field'])) {
    $task = mysqli_real_escape_string($conn, $_POST['task_field']);
    $allowedFields = ['false_ceiling','elec_light','sanitary','wardrobes','wall_putty','painting'];

    if (!in_array($task, $allowedFields)) {
        echo 0;
        exit;
    }

    $query = mysqli_query($conn,
        "SELECT T2.$task
         FROM questionnaire T1
         JOIN quotation T2 ON T1.que_id = T2.que_id
         WHERE T1.status = 1
         LIMIT 1"
    );

    if ($result = mysqli_fetch_assoc($query)) {
        echo floatval($result[$task]); // return only the number
    } else {
        echo 0;
    }
}
?>
