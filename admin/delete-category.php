<?php
include './includes/header.php';
include './includes/db.php';
include './functions/categoryFunctions.php';

$getId = $_GET['id'];

deleteCategory($getId);

?>
