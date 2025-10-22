<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/propertyTypeFunctions.php';

$getId = $_GET['id'];

deletePropertyType($getId);

?>
