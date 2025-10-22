<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/productFunctions.php';

$getId = $_GET['id'];

deleteProduct($getId);

?>
