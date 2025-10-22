<?php
include './includes/header.php';
include './includes/db.php';
include './functions/goodplanFunctions.php';

$getId = $_GET['id'];

deleteGoodplan($getId);

?>
