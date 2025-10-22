<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/serviceFunctions.php';

$getId = $_GET['id'];

deleteService($getId);

?>
