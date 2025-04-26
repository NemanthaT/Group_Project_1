<?php
session_start(); 
require_once ('../config/config.php'); //connect to database

// Define a constant for the homepage URL
define('HOMEPAGE_URL', '../Home/Homepage/HP.php');

    $userType = $_SESSION['userType'] ?? null; // Get user type from session
    $email = $_SESSION['email'] ?? null; // Get email from session

    $sql = "UPDATE $userType SET last_logout = NOW() WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo "Error updating last login: " . mysqli_error($conn);
    }
    else{
        session_unset();
        session_destroy();
        header("Location: " . HOMEPAGE_URL);
        exit();
    }

    
?>