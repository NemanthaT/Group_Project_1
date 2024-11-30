<?php
    session_start(); 
    require_once('../../config/config.php');

    $username = $_SESSION['username'];
    $email = $_SESSION['email'];

    if (!isset($_SESSION['username'])) { // if not logged in
        header("Location: ../../login/login.php");
        exit;
    }
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="users.css">
        <link rel="stylesheet" href="../../css/common.css">
    </head>
    <body>
        <div class="main">
            <div class="bg">
                <!--blur Background image-->  
            </div>
            <div class="header">
                <h1>Users</h1>
            </div>
            <div class="dashboard">
                <div class="card" onclick="redirectTo('clients.php')">
                    <div class="icon"></div>
                    <p>Clients</p>
                </div>
                <div class="card" onclick="redirectTo('serviceProviders.php')">
                    <div class="icon"></div>
                    <p>Service Providers</p>
                </div>
                <!--<div class="card" onclick="redirectTo('companyWorkers.php')">
                    <div class="icon"></div>
                    <p>Company Workers</p>
                </div>-->
            </div>
        </div>
        <script src="../../js/common.js"></script>
    </body>
</html>