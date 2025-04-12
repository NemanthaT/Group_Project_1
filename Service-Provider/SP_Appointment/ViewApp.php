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
    <style>
    .appointment-details {
        padding: 20px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        width: 100%; /* Ensure it spans the full width of the main content */
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
    }
    
    .appointment-header {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        margin-bottom: 30px;
    }
    
    .appointment-title {
        font-size: 28px; /* Bigger font */
        font-weight: bold;
        color: #333;
        text-align: center;
        margin-top: 20px;
    }
    
    .status-badge {
        position: absolute;
        right: 20px;
        top: 0;
        padding: 8px 15px;
        border-radius: 4px;
        font-size: 20px;
        font-weight: bold;
        color: white;
    }
    
    .appointment-info, .client-details {
        width: 80%;
        font-size: 18px; /* Bigger font */
    }
    
    .appointment-info {
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }
    
    .client-details {
        margin-top: 20px;
    }
    
    .detail-row {
        display: flex;
        margin-bottom: 25px;
        font-size: 18px; /* Bigger font */
    }
    
    .detail-label {
        font-weight: bold;
        width: 180px;
        margin-bottom: 5px;
    }
    
    .detail-value {
        flex: 1;
        margin-bottom: 5px;
    }
    
    .back-button {
        background-color: #18A0FB;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        margin-top: auto;
        align-self: center;
        text-align: center; /* Ensures text inside is centered */
    }
    
    .back-button:hover {
        background-color:rgb(6, 66, 231);
    }
    
    .status-pending {
        background-color: #FFC107;
    }
    
    .status-scheduled {
        background-color: #2196F3;
    }
    
    .status-completed {
        background-color: #4CAF50;
    }
    
    .status-rejected {
        background-color: #F44336;
    }
    
    .status-cancelled {
        background-color: #9E9E9E;
    }
</style>

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
       
    <div class="appointment-details">
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