<?php
include './includes/header.php';
include './includes/db.php';
include './functions/attributeFunctions.php';

$getId = $_GET['id'];

deleteAttributes($getId);

?>
