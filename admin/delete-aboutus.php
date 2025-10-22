<?php
include './includes/header.php';
include './includes/db.php';
include './functions/aboutFunctions.php';

$getId = $_GET['id'];

deleteAbout($getId);

?>
