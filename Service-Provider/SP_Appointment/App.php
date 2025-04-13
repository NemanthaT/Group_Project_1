<?php
include '../Session/Session.php';
include '../connection.php';

// Initialize message variable
$message = "";

// Check if the form is submitted to update the status
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['appointment_id'], $_POST['status'])) {
    $appointmentId = intval($_POST['appointment_id']); // Ensure it's an integer
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

    // Redirect to avoid form resubmission
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit;
}


// Query to retrieve appointments data
$providerId = $_SESSION['provider_id']; 
$sql = "SELECT appointment_id, provider_id, client_id, appointment_date, status, created_at FROM appointments WHERE provider_id = ? ORDER BY appointment_date ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $providerId);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
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
                <li><a href="../SP_Dashboard/SPDash.php"><button><img src="../images/dashboard.png">Dashboard</button></a></li>
                <li><a href="../SP_Appointment/App.php"><button><img src="../images/appointment.png">Appointment</button></a></li>
                <li><a href="../SP_Message/Message.php"><button><img src="../images/message.png">Message</button></a></li>
                <li><a href="../SP_Projects/Project.php"><button><img src="../images/project.png">Project</button></a></li>
                <li><a href="../SP_Bill/Bill.php"><button><img src="../images/bill.png">Bill</button></a></li>
                <li><a href="../SP_Forum/Forum.php"><button><img src="../images/forum.png">Forum</button></a></li>
                <li><a href="../SP_KnowledgeBase/KB.php"><button><img src="../images/knowledgebase.png">KnowledgeBase</button></a></li>
            </ul>
        </div>       
    <!-- Navbar -->
        <header>
            <nav class="navbar">
            <div class="calendar-icon">
                    <a href="#" id="calendarToggle"><img src="../images/calendar.png" alt="Calendar"></a>
            <!-- Calendar Dropdown -->
                 <!-- Calendar Dropdown -->
                 <div id="calendarDropdown" class="calendar-dropdown">
                    <h3>Calendar</h3>
                    <div class="calendar-header">
                        <button id="prevMonth">&lt;</button>
                        <span id="currentMonth">March 2025</span>
                        <button id="nextMonth">&gt;</button>
                    </div>
                    <div class="calendar-grid">
                        <div class="weekdays">
                            <div>Mon</div>
                            <div>Tue</div>
                            <div>Wed</div>
                            <div>Thu</div>
                            <div>Fri</div>
                            <div>Sat</div>
                            <div>Sun</div>
                        </div>
                        <div id="daysGrid" class="days"></div>
                    </div>
                </div>
                </div>
                <div class="notification">
                    <a href="#"><img src="../images/notification.png" alt="Notifications"></a>
                </div>
                <div class="profile">
                    <a href="../SP_Profile/Profile.php"><img src="../images/user.png" alt="Profile"></a>
                </div>
                    <a href="../../Login/Logout.php" class="logout">Logout</a>                
            </nav>
        </header>
        <!-- Main Content -->
            <div class="main-content">
                <div class="appointment-section">
                    <center><h2>Appointments</h2></center>
                <!-- Search and Filter Controls -->
                    <div class="appointment-controls">
                        <input type="text" id="clientFilter" placeholder="Search by Client ID/Appointment ID">
                        <input type="date" id="appointmentDateFilter" placeholder="Filter by Appointment Date">
                        <select id="statusSort">
                            <option value="">Sort by Status</option>
                            <option value="pending">Pending</option>
                            <option value="scheduled">Scheduled</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="rejected">Rejected</option>
                        </select>
                        <button class="search-button" onclick="filterAndSortAppointments()">Search</button>
                        <button class="clear-button" onclick="clearFilters()">Clear</button>
                    </div>
                    <div class="table-container"> 
                    <table class="appointment-table">
                        <thead>
                            <tr>
                                <th>Appointment ID</th>
                                <th>Appointment Date</th>
                                <th>Status</th>
                                <th>Details</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="appointment-tbody">
                            <?php
                            if ($result && $result->num_rows > 0) {
                                $result->data_seek(0); // Reset the result pointer
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['appointment_id']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['appointment_date']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                                    echo "<td>
                                            <a href='ViewApp.php?id=" . htmlspecialchars($row['appointment_id']) . "' class='view-btn'>View</a>
                                          </td>";
                                    echo "<td>";
                                    // Dynamic actions based on status
                                    $status = strtolower($row['status']); 
                                    if ($status === 'pending') {
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
                                    } elseif ($status === 'scheduled') {
                                        echo "<form method='POST' style='display: inline;'>
                                                <input type='hidden' name='appointment_id' value='" . htmlspecialchars($row['appointment_id']) . "'>
                                                <input type='hidden' name='status' value='Cancelled'>
                                                <button type='submit' class='reject-btn'>Cancel</button>
                                              </form>";
                                    } elseif ($status === 'rejected' || $status === 'cancelled' || $status === 'completed') {
                                        echo "<span class='status-text " . $status . "'>" . ucfirst($status) . "</span>";
                                    }
                                    echo "</td>";
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
    </div>   
<script src="App.js"></script>
</body>
</html>