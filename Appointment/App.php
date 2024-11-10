<?php
session_start(); 
require_once('../connection.php');

// Check if user session is active
/* Uncomment the following for security
if (!isset($_SESSION['username']) || !isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}
*/

$username = $_SESSION['username'] ?? 'Guest'; // For debugging without session
$email = $_SESSION['email'] ?? 'guest@example.com'; // Default value for debugging

// Query to retrieve appointments data
$sql = "SELECT appointment_id, provider_id, client_id, appointment_date, status FROM appointments";
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
    <!-- Background Image -->
    <div class="backgroundimage"></div>

    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <img src="../images/logo.png" alt="EDSA Lanka Consultancy Logo">
            </div>
            <ul class="menu">
                <li><button>Dashboard</button></li>
                <li><button>Appointment</button></li>
                <li><button>Message</button></li>
                <li><button>Forum</button></li>
                <li><button>Bill</button></li>
            </ul>
            <div class="profile">
                <button>Profile</button>
            </div>
        </div>

        <!-- Navbar -->
        <header>
            <nav class="navbar">
                <span>Hi, <?php echo htmlspecialchars($username); ?></span>
                <a href="logout.php" class="logout">Logout</a>
            </nav>
        </header>

        <!-- Main Content (Appointments Table) -->
        <div class="main-content">
            <div class="appointment-section">
                <h2>Appointment</h2>
                <div class="appointment-controls">
                    <button class="new-appointment">New Appointment</button>
                    <input type="text" placeholder="AP_ID">
                    <input type="text" placeholder="Service">
                    <button class="search-button">Search</button>
                </div>
                <table class="appointment-table">
                    <thead>
                        <tr>
                            <th>Appointment ID</th>
                            <th>Provider ID</th>
                            <th>Client ID</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="appointment-tbody">
                        <?php
                        // Check if there are results and display them
                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['appointment_id']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['provider_id']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['client_id']) . "</td>";
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
