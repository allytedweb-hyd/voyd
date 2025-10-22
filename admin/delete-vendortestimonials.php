<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/vendortestimonialFunctions.php';

$getId = $_GET['id'];

deleteVendortestimonial($getId);

?>
