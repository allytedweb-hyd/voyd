<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/guideFunctions.php';

$getId = $_GET['id'];

deleteGuide($getId);

?>