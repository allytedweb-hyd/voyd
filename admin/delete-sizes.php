<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/sizesFunctions.php';

$getId = $_GET['id'];

deleteSize($getId);

?>
