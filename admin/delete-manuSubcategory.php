<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/manu-subCategoryFunctions.php';

$getId = $_GET['id'];

deleteSubCategory($getId);

?>