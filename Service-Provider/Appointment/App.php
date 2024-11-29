<?php
session_start();
require_once('../connection.php');

$username = $_SESSION['username'] ?? 'Guest';
$email = $_SESSION['email'] ?? 'guest@example.com';

// Query to retrieve appointments data
$sql = "SELECT appointment_id, provider_id, client_id, appointment_date, status, created_at, service_type, message FROM appointments";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka Consultancy</title>
    <link rel="stylesheet" href="App.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <img src="../images/logo.png" alt="EDSA Lanka Consultancy Logo">
            </div>
            <ul class="menu">
                <li><a href="../SP_Dashboard/SPDash.html"><button><img src="../images/dashboard.jpg">Dashboard</button></a></li>
                <li><a href="../Appointment/App.php"><button><img src="../images/appointment.png">Appointment</button></a></li>
                <li><a href="../Message/Message.html"><button><img src="../images/message.jpg">Message</button></a></li>
                <li><a href="../SP_Forum/Forum.html"><button><img src="../images/forum.png">Forum</button></a></li>
                <li><a href="../SP_KnowledgeBase/KB.php"><button><img src="../images/knowledgebase.png">KnowledgeBase</button></a></li>
            </ul>
        </div>

        <!-- Main Content Wrapper -->
        <div class="main-wrapper">
            <!-- Navbar -->
            <header>
                <nav class="navbar">       
                    <a href="#">Home</a>
                    <div class="notification">   
                        <a href="#"><img src="../images/notification.png" alt="Notifications"></a>
                    </div> 
                    <div class="profile">
                        <a href="../SP"><img src="../images/user.png" alt="Profile"></a>
                    </div>
                    <a href="../Login/Logout.php" class="logout">Logout</a>
                </nav>
            </header>

            <!-- Main Content -->
            <div class="main-content">
                <div class="appointment-section">
                    <h2>Appointments</h2>
                    <div class="appointment-controls">
                        <input type="text" id="clientFilter" placeholder="Search by Client ID">
                        <button class="search-button" onclick="filterAppointments()">Search</button>
                    </div>
                    <table class="appointment-table">
                        <thead>
                            <tr>
                                <th>Appointment ID</th>
                                <th>Client ID</th>
                                <th>Appointment Date</th>                           
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody id="appointment-tbody">
                            <?php
                            if ($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td class='appointment-id'>" . htmlspecialchars($row['appointment_id']) . "</td>";                                   
                                    echo "<td class='client-id'>" . htmlspecialchars($row['client_id']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['appointment_date']) . "</td>";                                   
                                    echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['message']) . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8'>No appointments found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="App.js"></script>
</body>
</html>