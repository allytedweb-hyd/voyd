<?php
include './includes/header.php';
include './includes/db.php';
include './functions/costFunctions.php';

$getId = $_GET['id'];

deleteCost($getId);

?>
