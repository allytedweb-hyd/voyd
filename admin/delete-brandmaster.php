<?php
include './includes/header.php';
include './includes/db.php';
include './functions/master_brandFunctions.php';

$getId = $_GET['id'];

deleteBrand($getId);

?>
