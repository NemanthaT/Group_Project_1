<?php
    session_start(); 
    require_once('../config/config.php');

    $username = $_SESSION['username'];
    $email = $_SESSION['email'];

    if (!isset($_SESSION['username'])) { // if not logged in
        header("Location: login.php");
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="dashboard.css">
    </head>
    <body>
        <div class="dashboard">
            <div class="backgroundimage">
                <img src="Image/background.jpg" alt="background">
            </div>
            <div class="card" onclick="redirectTo('Users/clients.php')">
                <div class="icon"></div>
                <p>Users</p>
            </div>
            <div class="card">
                <div class="icon"></div>
                <p>Service Provider Requests</p>
            </div>
            <div class="card" onclick="redirectTo('Forums/forums.php')">
                <div class="icon"></div>
                <p>Forums</p>
            </div>
            <div class="card">
                <div class="icon"></div>
                <p>Financial Reports</p>
            </div>
            <div class="card">
                <div class="icon"></div>
                <p>Appointments</p>
            </div>
            <div class="card">
                <div class="icon"></div>
                <p>Manage Employees</p>
            </div>
        </div>
        <script src="../js/common.js"></script>
    </body>
</html>