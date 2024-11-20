<?php
session_start();
require_once('../connection.php');

// Check if user session is active
/*
if (!isset($_SESSION['username']) || !isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}
*/

$username = $_SESSION['username'] ?? 'Guest';
$email = $_SESSION['email'] ?? 'guest@example.com';

// Query to retrieve appointments data
$sql = "SELECT appointment_id, provider_id, client_id, appointment_date, status FROM appointments";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka Consultancy - Appointments</title>
    <link rel="stylesheet" href="App.css">
</head>
<body>
    <div class="backgroundimage"></div>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <img src="../images/logo.png" alt="EDSA Lanka Consultancy Logo">
            </div>
            <ul class="menu">
                <li><a href=""><button>Dashboard</button></a></li>
                <li><a href=""><button>Appointment</button></a></li>
                <li><a href=""><button>Message</button></a></li>
                <li><a href="#"><button>Forum</button></a></li>
                <li><a href="#"><button>KnowledgeBase</button></a></li>
            </ul>
        </div>
        <!-- Navbar -->
        <header>
            <nav class="navbar">
                <div class="profile">
                    <a href=""><img src="../images/user.png" alt="Profile"></a>
                </div> 
                <a href="" class="logout">Logout</a>
            </nav>
        </header>

        <!-- Main Content (Appointments Table) -->
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
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="appointment-tbody">
                        <?php
                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td class='appointment-id'>" . htmlspecialchars($row['appointment_id']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['provider_id']) . "</td>";
                                echo "<td class='client-id'>" . htmlspecialchars($row['client_id']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['appointment_date']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No appointments found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="App.js"></script>
</body>
</html>
