<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/unitMaterFunctions.php';

$getId = $_GET['id'];

deleteUnit($getId);

?>
