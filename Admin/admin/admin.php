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
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="sidebar">
                <div class="logo">
                    <img src="../Images/logo.png" alt="EDSA Lanka Consultancy">
                </div>
                <nav>
                    <ul>
                        <li class="dropDown"><a href="dashboard.php" target="Dashboard">Dashboard</a></li>
                        <li class="dropDown"><a href="Users/users.php" target="Dashboard">Users</a></li>
                        <li class="dropDown"><a href="Users/users.php" target="Dashboard">Service Provider Requests</a></li>
                        <li class="dropDown"><a href="Forums/forums.php" target="Dashboard">Forums</a></li>
                        <li class="dropDown"><a href="Users/users.php" target="Dashboard">Financial Reports</a></li>
                        <li class="dropDown"><a href="Users/users.php" target="Dashboard">Appointments</a></li>
                        <li class="dropDown"><a href="ManageEmployees/manEmp.php" target="Dashboard">Manage Employees</a></li>
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
                    <iframe src="dashboard.php" name="Dashboard" title="Dashboard"></iframe>
                </div>
            </div>
            <div class="right" id="arrow"></div>
                    <div id="content">
                        <div class="calendar">
                            <div class="calendar-header">
                                <button id="prev-month">&#9664; October</button>
                                <span id="month-year">November 2024</span>
                                <button id="next-month">December &#9654;</button>
                            </div>
                            <div class="calendar-body">
                                <div class="calendar-weekdays">
                                    <span>Mon</span><span>Tue</span><span>Wed</span>
                                    <span>Thu</span><span>Fri</span><span>Sat</span><span>Sun</span>
                                </div>
                                <div id="calendar-days" class="calendar-days"></div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <footer>
            <center><p>&copy; 2024 EDSA Lanka Consultancy</p></center>
        </footer>
        <script src="admin.js"></script>
    </body>
</html>