<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/materialFunctions.php';

$getId = $_GET['id'];

deleteMaterial($getId);

?>
