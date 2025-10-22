<?php
include './includes/header.php';
include './includes/db.php';
include './functions/breadcrumbFunctions.php';

$getId = $_GET['id'];

deleteBreadcrumb($getId);

?>
