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
            <h2>Select Option</h2>
        </div>
        <div class="forms">
            <form action="" class="client" method="post">
                <div >
                    <center>
                        <h2>Client</h2>
                        <span style='font-size:100px;'>&#128129;</span><br>
                        <button name="sC" type="submit">Signup</button>
                    </center>

                </div>
            </form>
            <form action="" class="provider" method="post">
                <div >
                    <center>
                        <h2>Service Provider</h2>
                        <span style='font-size:100px;'>&#129333;</span><br>
                        <button name="sP" type="submit">Signup</button>
                    </center>

                </div>
            </form>
        </div>
        <div class="form-footer">
            <button onclick="window.location.href='../login.php'" class="bBtn">Back</button>
        </div>
                                                                                                 
    </div>
    <footer class="footer">
        <p>&copy; 2024 EDSA Lanka Consultancy</p>
    </footer>
    </body>
</html>
