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
            <h1>Choose Account Type</h1>
        </div>
        <div class="forms">
            <form action="" class="client" id="cl" method="post">
                <div onclick="window.location.href='Sign_UpC.php'">
                    <center>
                        <h2>Client</h2>
                        <span style='font-size:200px;'>&#128129;</span><br>
                        <!--<button name="sC" type="submit">Signup</button>-->
                    </center>

                </div>
            </form>
            <form action="" class="provider" id="prov" method="post">
                <div onclick="window.location.href='Sign_UpP.php'">
                    <center>
                        <h2>Service Provider</h2>
                        <span style='font-size:200px;'>&#129333;</span><br>
                        <!--<button name="sP" type="submit">Signup</button>-->
                    </center>

                </div>
            </form>
        </div>
        <div class="form-footer">
            <!--<button onclick="window.location.href='../login.php'" class="bBtn">Back</button>-->
            <center><p class="backLink">&#11164; <a href="../login.php">Back to login</a></p></center>
        </div>
                                                                                                 
    </div>
    <footer class="footer">
        <p>&copy; 2024 EDSA Lanka Consultancy</p>
    </footer>
    </body>
</html>
