<?php
include './includes/header.php';
include './includes/db.php';
include './functions/contactFunctions.php';

$getId = $_GET['id'];

deleteContact($getId);

?>
