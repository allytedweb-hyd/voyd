<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/manufacturerFunctions.php';

$getId = $_GET['id'];

deleteManufacturer($getId);

?>
