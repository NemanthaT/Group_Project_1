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
        <title>EDSA Lanka Consultancy</title>
        <link rel="stylesheet" href="adminstyles.css">
    </head>
    <body>
        <div class="container">
            <div class="sidebar">
                <div class="logo">
                    <img src="../Images/logo.png" alt="EDSA Lanka Consultancy">
                </div>
                <nav>
                    <ul>
                        <li class="dropDown"><a href="dashboard.html" target="Dashboard">Dashboard</a></li>
                        <li class="dropDown"><a href="#" target="Dashboard">Knowledge Base</a>
                            <ul class="dropDownContent">
                            </ul>
                        </li>
                        <li class="dropDown"><a href="#">People</a></li>
                    </ul>
                </nav>
            </div>
            <div class="content">
                <div class="header">
                    <header>
                        <div class="user-info">
                            <p>Hi,<?php echo $username ?> </p>
                            <button name="submit" type="submit"><a href="../login/logout.php" class="logoutbutton">Logout</a></button>
                        </div>
                    </header>
                </div>
                <div class="frame">
                    <iframe src="dashboard.html" name="Dashboard" title="Dashboard"></iframe>
                </div>
            </div>
        </div>
        <footer>
            <center><p>&copy; 2024 EDSA Lanka Consultancy</p></center>
        </footer>
    </body>
</html>