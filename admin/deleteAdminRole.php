<?php
include 'includes/header.php';
include 'includes/db.php';
include './functions/adminRolesFunction.php';

$getId = $_GET['id'];

deleteRole($getId);
