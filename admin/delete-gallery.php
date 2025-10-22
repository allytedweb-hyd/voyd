<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/galleryFunctions.php';

$getId = $_GET['id'];

deleteGallery($getId);

?>