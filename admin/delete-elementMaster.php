<?php
include './includes/header.php';
include './includes/db.php';
include './functions/element_masterFunctions.php';

$getId = $_GET['id'];

deleteElementMaster($getId);

?>
