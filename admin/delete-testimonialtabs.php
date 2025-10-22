<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/testimonialtabsFunctions.php';

$getId = $_GET['id'];

deleteTestimonialtab($getId);

?>
