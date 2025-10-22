<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/productcolorFunctions.php';

$getId = $_GET['id'];

deleteProductcolors($getId);

?>
