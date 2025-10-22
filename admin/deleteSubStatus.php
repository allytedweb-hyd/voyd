<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/subStatusMasterFunction.php';

$getId = $_GET['id'];

deleteStatusMaster($getId);
