<?php
session_start();

if (!isset($_SESSION['username'])) {
    // Redirect to the login page if the session is not active
    header("Location: ../Login/Login.php");
    exit();
}

// Prevent caching of the page
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

require_once('../connection.php');

$username = $_SESSION['username'] ?? 'Guest';
$email = $_SESSION['email'] ?? 'guest@example.com';

// Query to retrieve appointments data
$sql = "SELECT appointment_id, provider_id, client_id, appointment_date, status, created_at FROM appointments";
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
                <li><a href="../SP_Dashboard/SPDash.php"><button><img src="../images/dashboard.jpg">Dashboard</button></a></li>
                <li><a href="../Appointment/App.php"><button><img src="../images/appointment.png">Appointment</button></a></li>
                <li><a href="../Message/Message.html"><button><img src="../images/message.jpg">Message</button></a></li>
                <li><a href="../SP_Projects/Project.html"><button><img src="../images/project.png">Project</button></a></li>
                <li><a href="../SP_Bill/Bill.html"><button><img src="../images/bill.png">Bill</button></a></li>
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
                        <a href="../SP_Profile/Profile.html"><img src="../images/user.png" alt="Profile"></a>
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
                                <th>Actions</th>
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
                                    echo "<td class='status'>" . htmlspecialchars($row['status']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                                    echo "<td class='actions'>
                                            <button class='accept-btn' onclick='updateAction(this, \"Accepted\")'>Accept</button>
                                            <button class='reject-btn' onclick='updateAction(this, \"Rejected\")'>Reject</button>
                                          </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>No appointments found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="App.js"></script>
    <script>
        // Function to handle action updates
        function updateAction(button, actionText) {
            const actionCell = button.closest('td'); // Get the Actions cell
            actionCell.innerHTML = `<span>${actionText}</span>`; // Replace buttons with text
        }

        // Function to filter appointments
        function filterAppointments() {
            const filterValue = document.getElementById("clientFilter").value.toLowerCase();
            const rows = document.querySelectorAll("#appointment-tbody tr");

            rows.forEach(row => {
                const clientID = row.querySelector(".client-id").textContent.toLowerCase();
                const appointmentID = row.querySelector(".appointment-id").textContent.toLowerCase();

                if (clientID.includes(filterValue) || appointmentID.includes(filterValue)) {
                    row.style.display = ""; // Show row
                } else {
                    row.style.display = "none"; // Hide row
                }
            });
        }
    </script>
</body>
</html>
