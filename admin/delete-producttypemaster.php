<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/producttypeMaterFunctions.php';

$getId = $_GET['id'];

deleteProducttypemaster($getId);

?>
