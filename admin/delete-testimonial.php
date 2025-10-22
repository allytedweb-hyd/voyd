<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/testimonialFunctions.php';

$getId = $_GET['id'];

deleteTestimonial($getId);

?>
