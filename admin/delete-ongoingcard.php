<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/ongoingcardFunctions.php';

$getId = $_GET['id'];

deleteOngoingcard($getId);

?>
