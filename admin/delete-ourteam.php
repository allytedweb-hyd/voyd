<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/ourteamFunctions.php';

$getId = $_GET['id'];

deleteOurteam($getId);

?>
