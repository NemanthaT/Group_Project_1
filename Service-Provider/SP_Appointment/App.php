<?php
session_start();

// Prevent caching of the page
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

require_once('../connection.php');

// Check if the form is submitted to update the status
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['appointment_id']) && isset($_POST['status'])) {
        $appointmentId = $_POST['appointment_id'];
        $status = $_POST['status'];

        // Update the appointment status in the database
        $stmt = $conn->prepare("UPDATE appointments SET status = ? WHERE appointment_id = ?");
        $stmt->bind_param("si", $status, $appointmentId);

        if ($stmt->execute()) {
            $message = "Appointment status updated successfully!";
        } else {
            $message = "Failed to update appointment status.";
        }

        $stmt->close();

        // Redirect to the same page after the POST request to avoid resubmission
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit;
    } else {
        $message = "Invalid request.";
    }
}

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
                    <a href="../Home/Homepage/HP.html">Home</a>
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
                        <tbody>
    <?php
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['appointment_id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['client_id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['appointment_date']) . "</td>";
            echo "<td>" . htmlspecialchars($row['status']) . "</td>";
            echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
            echo "<td>";

            // Dynamic actions based on status
            if ($row['status'] === 'Pending') {
                echo "<form method='POST' style='display: inline;'>
                        <input type='hidden' name='appointment_id' value='" . htmlspecialchars($row['appointment_id']) . "'>
                        <input type='hidden' name='status' value='Scheduled'>
                        <button type='submit' class='accept-btn'>Accept</button>
                      </form>";
                echo "<form method='POST' style='display: inline;'>
                        <input type='hidden' name='appointment_id' value='" . htmlspecialchars($row['appointment_id']) . "'>
                        <input type='hidden' name='status' value='Rejected'>
                        <button type='submit' class='reject-btn'>Reject</button>
                      </form>";
            } elseif ($row['status'] === 'Scheduled') {
                echo "<form method='POST' style='display: inline;'>
                        <input type='hidden' name='appointment_id' value='" . htmlspecialchars($row['appointment_id']) . "'>
                        <input type='hidden' name='status' value='Cancelled'>
                        <button type='submit' class='reject-btn'>Cancel</button>
                      </form>";
            } elseif ($row['status'] === 'Rejected') {
                echo "<span class='status-text rejected'>Rejected</span>";
            } elseif ($row['status'] === 'Cancelled') {
                echo "<span class='status-text cancelled'>Cancelled</span>";
            }

            echo "</td>";
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
</body>
</html