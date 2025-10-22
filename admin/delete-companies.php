<?php
include './includes/header.php';
include './includes/db.php';
include './functions/companyFunctions.php';

$getId = $_GET['id'];

deleteCompanies($getId);

?>
