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
            <!--<div class="backgroundimage">
                <img src="Image/background.jpg" alt="background">
            </div>-->

            <!--Left side of the dashboard-->
            <div id="contentLeft">
                <div class="card" onclick="redirectTo('Users/users.php')">
                    <div class="icon"></div>
                    <div>
                        <?php
                            $sql = "SELECT COUNT(*) FROM clients";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            echo "<table>";
                            echo "<tr><th>Clients: <th>" . "<td>" . $row["COUNT(*)"] . "</td></tr>";

                            $sql = "SELECT COUNT(*) FROM serviceproviders";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            echo "<tr><th>Service Providers: <th>" . "<td>" . $row["COUNT(*)"] . "</td></tr>";

                            $sql = "SELECT COUNT(*) FROM companyworkers";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            echo "<tr><th>Employees: <th>" . "<td>" . $row["COUNT(*)"] . "</td></tr>";
                            echo "</table>";
                        ?>
                    </div>
                </div>
                <div class="card">
                    <div class="icon"></div>
                    <div><p>Time</p></div>
                </div>
                <div class="card" onclick="redirectTo('Forums/forums.php')">
                    <div class="icon"></div>
                    <div><p>Service Provider Requests</p></div>
                </div>
                <div class="card">
                    <div class="icon"></div>
                    <div><p>Employees</p></div>
                </div>
            </div>

            <!--Right side of the dashboard-->
            <div id="contentRight">
                <div class="calendar">
                    <div class="calendar-header">
                        <button onclick="prevMonth()">‹</button>
                        <h2 id="monthYear"></h2>
                        <button onclick="nextMonth()">›</button>
                    </div>
                    <div class="days">
                        <div class="day">Sun</div>
                        <div class="day">Mon</div>
                        <div class="day">Tue</div>
                        <div class="day">Wed</div>
                        <div class="day">Thu</div>
                        <div class="day">Fri</div>
                        <div class="day">Sat</div>
                    </div>
                    <div class="days" id="dates"></div>
                </div>
            </div>
        </div>
        <script src="../js/common.js"></script>
        <!--<script src="admin.js"></script>-->
    </body>
</html>