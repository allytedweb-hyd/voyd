<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/productMaterFunctions.php';

$getId = $_GET['id'];

deleteProductmaster($getId);

?>
