<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/subcategoryFunctions.php';

$getId = $_GET['id'];

deleteSubCategory($getId);

?>