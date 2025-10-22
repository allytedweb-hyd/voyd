<?php
include './includes/header.php';
include './includes/db.php';
include './functions/employeeFunctions.php';

$getId = $_GET['id'];

deleteEmployee($getId);

?>
