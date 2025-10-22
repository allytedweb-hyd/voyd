<?php
include './includes/header.php';
include './includes/db.php';
include './functions/brandFunctions.php';

$getId = $_GET['id'];

deleteBrands($getId);

?>
