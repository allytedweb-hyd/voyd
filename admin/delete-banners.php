<?php
include './includes/header.php';
include './includes/db.php';
include './functions/bannerFunctions.php';

$getId = $_GET['id'];

deleteBanners($getId);

?>