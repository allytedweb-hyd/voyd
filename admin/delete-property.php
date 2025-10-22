<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/propertyFunctions.php';

$getId = $_GET['id'];

deleteProperty($getId);

?>
