<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/vendorFunctions.php';

$getId = $_GET['id'];

deleteVendor($getId);

?>
