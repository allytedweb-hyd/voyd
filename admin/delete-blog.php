<?php
include './includes/header.php';
include './includes/db.php';
include './functions/blogFunctions.php';

$getId = $_GET['id'];

deleteBlog($getId);

?>
