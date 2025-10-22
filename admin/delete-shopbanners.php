<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/shop-bannerFunctions.php';

$getId = $_GET['id'];

deleteShopbanners($getId);

?>
