<?php
session_start(); 
include '../connect/connect.php'; //connect to database

// Define a constant for the homepage URL
define('HOMEPAGE_URL', '../Home/Homepage/HP.html');

    session_unset();
    session_destroy();
    header("Location: " . HOMEPAGE_URL);
    exit();
?>