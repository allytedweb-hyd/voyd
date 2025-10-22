<?php
include './includes/header.php';
include './includes/db.php';
include './functions/colorFunctions.php';

$getId = $_GET['id'];

deleteColor($getId);

?>
