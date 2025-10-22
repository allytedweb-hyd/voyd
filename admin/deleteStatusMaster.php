<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/statusMasterFunctions.php';

$getId = $_GET['id'];

deleteStatusMaster($getId);