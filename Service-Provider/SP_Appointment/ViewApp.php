<?php
include '../Session/Session.php';
include '../connection.php';

// Check if appointment ID is provided
if (isset($_GET['id'])) {
    $appointment_id = $_GET['id'];
    
    // Fetch appointment details
    $query = "SELECT appointment_id, provider_id, client_id, appointment_date, status, created_at, service_type, message 
              FROM appointments 
              WHERE appointment_id = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $appointment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $appointment = $result->fetch_assoc();
    } else {
        echo "<script>alert('Appointment not found!'); window.location.href='App.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('No appointment ID provided!'); window.location.href='App.php';</script>";
    exit;
}
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
        <div class="main-content">
       
    <div class="appointment-section">
        <div class="appointment-header">
            <div class="appointment-title">Appointment ID <?php echo htmlspecialchars($appointment['appointment_id']); ?></div>
            <div class="status-badge status-<?php echo strtolower($appointment['status']); ?>">
                <?php echo htmlspecialchars($appointment['status']); ?>
            </div>
        </div>
        
        <div class="appointment-info">
            <div class="detail-row">
                <div class="detail-label">Provider ID:</div>
                <div class="detail-value"><?php echo htmlspecialchars($appointment['provider_id']); ?></div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Client ID:</div>
                <div class="detail-value"><?php echo htmlspecialchars($appointment['client_id']); ?></div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Appointment Date:</div>
                <div class="detail-value"><?php echo htmlspecialchars($appointment['appointment_date']); ?></div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Created At:</div>
                <div class="detail-value"><?php echo htmlspecialchars($appointment['created_at']); ?></div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Service Type:</div>
                <div class="detail-value"><?php echo htmlspecialchars($appointment['service_type']); ?></div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Message:</div>
                <div class="detail-value"><?php echo htmlspecialchars($appointment['message'] ?? 'Not specified'); ?></div>
            </div>
        </div>
        <button class="back-button" onclick="window.location.href='App.php'">Back to Appointments</button>
    </div>                   
                </div>
            </div>
        </div>
    </div>
<script src="App.js"></script>
</body>
</html>