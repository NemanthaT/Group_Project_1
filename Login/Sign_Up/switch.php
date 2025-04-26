<?php
session_start();
require_once('../../config/config.php'); // Include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST'  && isset($_POST['sC'])) {
    header('Location: Sign_UpC.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'  && isset($_POST['sP'])) {
    header('Location: Sign_UpP.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka Consultancy - Sign Up</title>
    <link rel="stylesheet" href="switch.css">
</head>
<body>
    <div class="blurry-background"></div>
    
    <div class="container">
        <div class="form-header">
            <h1>Choose Your Account Type</h1>
        </div>
        
        <div class="forms">
            <div class="account-option" onclick="window.location.href='Sign_UpC.php'">
                <h2>Client</h2>
                <div class="icon-container">👤</div>
                <p class="option-description">Looking for professional services? Sign up as a client to find the best service providers.</p>
            </div>
            
            <div class="account-option" onclick="window.location.href='Sign_UpP.php'">
                <h2>Service Provider</h2>
                <div class="icon-container">🧑‍💼</div>
                <p class="option-description">Offer your professional services and connect with potential clients looking for your expertise.</p>
            </div>
        </div>
        
        <div class="form-footer">
            <a href="../login.php" class="back-link">Back to login</a>
        </div>
    </div>
    
    <footer>
        <p>&copy; 2024 EDSA Lanka Consultancy</p>
    </footer>
</body>
</html>