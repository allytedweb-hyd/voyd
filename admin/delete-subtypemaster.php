<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/subtypeMaterFunctions.php';

$getId = $_GET['id'];

deleteSubtypemaster($getId);

?>
