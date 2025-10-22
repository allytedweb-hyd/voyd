<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/googlereviewsFunctions.php';

$getId = $_GET['id'];

deleteGooglereview($getId);

?>