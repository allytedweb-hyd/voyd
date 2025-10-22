<?php
include './includes/header.php';
include './includes/db.php';
include './functions/quoteAddonFunctions.php';

$getId = $_GET['id'];

deleteAddon($getId);

?>
