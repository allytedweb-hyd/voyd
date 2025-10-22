<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/valueFunctions.php';

$getId = $_GET['id'];

deleteValues($getId);

?>
