<?php
    session_start(); 
    require_once('../../config/config.php');

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
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div class="dashboard">
            <!--<div class="backgroundimage">
                <img src="Image/background.jpg" alt="background">
            </div>-->

            <!--Left side of the dashboard-->
            <div class="bg">
                <!--blur Background image-->  
            </div>
            <div id="contentLeft">
                <div class="card">
                    <div><p>Users</p></div>
                    <div>
                        <?php
                            $sql = "SELECT COUNT(*) FROM clients";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            $clients = $row["COUNT(*)"];
                            echo "<table>";
                            echo "<tr><th>Clients: <th>" . "<td>" . $clients . "</td></tr>";

                            $sql = "SELECT COUNT(*) FROM serviceproviders";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            $serviceProviders = $row["COUNT(*)"];
                            echo "<tr><th>Service Providers: <th>" . "<td>" . $serviceProviders. "</td></tr>";

                            $sql = "SELECT COUNT(*) FROM companyworkers";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            $employees = $row["COUNT(*)"];
                            echo "<tr><th>Employees: <th>" . "<td>" . $employees . "</td></tr>";
                            echo "</table>";

                            $data = [
                                "clients" => $clients,
                                "serviceProviders" => $serviceProviders,
                                "employees" => $employees
                            ];
                        
                            // Pass the data to JavaScript
                            echo "<script>const chartData = " . json_encode($data) . ";</script>";
                        ?>
                    </div>
                    <div class="charts">
                        <canvas id="usersChart" width="300px" height="210px">
                            <script>
                                // Get the data passed from PHP
                                console.log(chartData);

                                // Prepare data for the chart
                                const labels = ["Clients", "Service Providers", "Employees"];
                                const data = [chartData.clients, chartData.serviceProviders, chartData.employees];

                                // Create the chart
                                const ctx = document.getElementById('usersChart').getContext('2d');
                                new Chart(ctx, {
                                    type: 'pie', // Chart type: 'bar', 'line', 'pie', etc.
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: '',
                                            data: data,
                                            backgroundColor: [
                                                'rgba(255, 99, 132)',
                                                'rgba(54, 162, 235)',
                                                'rgba(75, 192, 192)'
                                            ],
                                            borderColor: [
                                                'rgba(255, 255, 255, 1)',
                                                'rgba(255, 255, 255, 1)',
                                                'rgba(255, 255, 255, 1)'
                                            ],
                                            borderWidth: 1
                                        }]
                                    },
                                    /*options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }*/
                                });
                            </script>
                        </canvas>
                    </div>
                </div>
                <div class="card">
                    <div class="iconClock">
                        <img src="../../Images/clock.png" alt="clock">
                    </div>
                    <div id="time"></div>
                </div>

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

                <div class="card" id="sR">
                    <div><p>Service Requests</p></div>
                    <div>
                    <?php
                            $sql = "SELECT COUNT(*) FROM servicerequests WHERE status = 'Pending'";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            echo "<table>";
                            echo "<tr><th>Pending: <th>" . "<td>" . $row["COUNT(*)"] . "</td></tr>";
                            
                            $sql = "SELECT COUNT(*) FROM servicerequests WHERE status = 'Finished'";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            echo "<tr><th>Accepted: <th>" . "<td>" . $row["COUNT(*)"] . "</td></tr>";
                            echo "</table>";
                        ?>
                    </div>
                </div>
                <div class="card" id="tE">
                    <div><p>Total Earnings</p></div>
                    <div>
                        <?php
                            $sql = "SELECT SUM(amount) FROM payments";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            echo "<table>";
                            echo "<tr><th>Amount: <th>" . "<td>" . $row["SUM(amount)"] . "</td></tr>";
                            echo "</table>";
                        ?>
                    </div>    
                </div>
                <div class="card" id="fo">
                    <div><p>Forums</p></div>
                    <div>
                        <?php
                            $sql = "SELECT COUNT(*) FROM forums";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            echo "<table>";
                            echo "<tr><th>Forums: <th>" . "<td>" . $row["COUNT(*)"] . "</td></tr>";
                            echo "<tr><th>By clients: </th> <td>10</td></tr>";
                            echo "<tr><th>By SP's: </th> <td>10</td></tr>";
                            echo "</table>";
                        ?>
                    </div>    
                <div>
            <!--</div>-->

            <!--Right side of the dashboard-->
            <!--<div id="contentRight">-->
            </div>
        </div>
        <script src="../../js/common.js"></script>
    </body>
</html>