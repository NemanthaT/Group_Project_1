<?php
session_start();
require_once('../../config/config.php'); // Include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST'  && isset($_POST['sC'])) {
    header('Location: Sign_UpC.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'  && isset($_POST['sP'])) {
    header('Location: Sign_UpP.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'  && isset($_POST['back'])) {
    header('Location: ../login.php');
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
        <form action="" method="post">
                <div class="form-header">
                    <h2>Select Option</h2>
                </div>
                <div class="form-group1">
                    <div class="client">
                    <center>
                        <p>Client</p>
                        <span style='font-size:100px;'>&#128100;</span>
                        <button name="sC" type="submit">Signup</button>
                    </center>

                    </div>
                    <div class="provider">
                    <center>
                        <p>Service Provider</p>
                        <span style='font-size:100px;'>&#128100;</span>
                        <button name="sP" type="submit">Signup</button>
                    </center>

                    </div>
                </div>
                <div class="form-footer">
                    <button name="back" type="submit" class="bBtn">Back</button>
                </div>
        </form>                                                                                         
    </div>
    <footer class="footer">
        <p>&copy; 2024 EDSA Lanka Consultancy</p>
    </footer>
    </body>
</html>
