<?php
include './includes/header.php';
include './includes/db.php';
include './functions/manufact-categoryFunctions.php';

$getId = $_GET['id'];

deleteCategory($getId);

?>
