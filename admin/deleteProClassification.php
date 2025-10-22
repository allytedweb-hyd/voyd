<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/proClassificationFunctions.php';

$getId = $_GET['id'];

deleteClassification($getId);

?>
