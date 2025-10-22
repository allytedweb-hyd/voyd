<?php
include './includes/header.php';
include './includes/db.php';
include './functions/manageVendorFunction.php';

$getId = $_GET['id'];

deleteVendorManagement($getId);

?>
