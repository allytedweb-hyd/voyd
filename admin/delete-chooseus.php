<?php
include './includes/header.php';
include './includes/db.php';
include './functions/chooseusFunctions.php';

$getId = $_GET['id'];

deleteChooseus($getId);

?>
