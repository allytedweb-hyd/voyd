<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/taskMasterFunctions.php';

$getId = $_GET['id'];

deleteTask($getId);

?>