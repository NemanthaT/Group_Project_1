<?php
session_start(); 
include '../connect/connect.php'; //connect to database

    session_unset();
    session_destroy();
    header("Location: ../Home/Homepage/HP.html");
    exit();
?>