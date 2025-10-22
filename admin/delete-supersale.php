<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/supersaleFunctions.php';

$getId = $_GET['id'];

deleteSupersale($getId);

?>
