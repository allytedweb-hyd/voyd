<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/promocodeFunctions.php';

$getId = $_GET['id'];

deletePromocode($getId);

?>
