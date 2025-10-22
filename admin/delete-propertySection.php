<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/property_SectionFunctions.php';

$getId = $_GET['id'];

deletePropertySection($getId);

?>
