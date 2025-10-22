<?php
include './includes/header.php';
include './includes/db.php';
include './functions/elementFunctios.php';

$getId = $_GET['id'];

deleteElements($getId);

?>
