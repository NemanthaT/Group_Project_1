
<?php
include '../session/session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka - Appointment Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="../images/logo.png" alt="EDSA Lanka Consultancy Logo">
            </div>
            
            <ul class="menu">
                <li>
                    <a href="../Dashboard/Dashboard.php">
                        <button class="active">
                            <img src="../images/dashboard.png" alt="Dashboard">
                            Dashboard
                        </button>
                    </a>
                </li>
                <li>
                    <a href="../appointments/appointment.php">
                        <button >
                            <img src="../images/appointment.png" alt="Appointment">
                            Appointment
                        </button>
                    </a>
                    </li>
                <li>
                    <a href="../Project/project.php">
                        <button >
                            <img src="../images/project.png" alt="project">
                            Projects
                        </button>
                    </a>
                </li>                <li>
                    <a href="../bill/bill.php">
                        <button >
                        <img src="../images/bill.png" alt="Bill">
                        Bill
                        </button>
                    </a>
                </li>
                <li>
                    <a href="">
                    <button>
                        <img src="../images/forum.png" alt="Forum">
                        Forum
                    </button>
                    </a>
                </li>
                <li>
                    <!-- <a href="">
                    <button>
                        <img src="../images/knowledgebase.png" alt="Knowledge Base">
                        Knowledge Base
                    </button>
                    </a>
                </li> -->
                <!-- <li>
                    <a href="../reports/reports.php">
                        <button >
                            <img src="../images/reports.png" alt="Reports">
                            Reports
                        </button>
                    </a>
                </li> -->
            </ul>
        </div>

        <!-- Main Content Area -->
        <div class="main-wrapper">
            <!-- Navbar -->
            <div class="navbar">
                <a href="#">Home</a>
                <a href="#">
                    <img src="../images/notification.png" alt="Notifications">
                </a>
                <div class="profile">
                <a href="../profile/profile.php">
                <img src="../images/user.png" alt="Profile">
                    </a>
                </div>
                <a href="../../Login/Logout.php" class="logout">Logout</a>
            </div>

    <div class=".main-container">
        <div class="space"></div>

        <div class="controls card1">
            <h1>Welcome To EDSA Lanka</h1>
            <h3>HI !  Safran Zahim ..</h3>
        </div>

   <div class="dashboard">
        <div class="appointments-panel card">
                <div class="card-header">
                    <h2>Upcoming Appointments</h2>
                    <span class="icon">📅</span>
                </div>
                <div class="list-item">
                    <div class="appointment-details">
                        <strong>Project Kickoff</strong>
                        <span class="appointment-time">12 Dec, 10:00 AM</span>
                    </div>
                    <span class="status-badge status-upcoming">Upcoming</span>
                </div>
                <div class="list-item">
                    <div class="appointment-details">
                        <strong>Client Meeting</strong>
                        <span class="appointment-time">15 Dec, 2:00 PM</span>
                    </div>
                    <span class="status-badge status-pending">Pending</span>
                </div>
                <div class="list-item">
                    <div class="appointment-details">
                        <strong>Design Review</strong>
                        <span class="appointment-time">18 Dec, 11:30 AM</span>
                    </div>
                    <span class="status-badge status-upcoming">Upcoming</span>
                </div>
                <div class="list-item">
                    <div class="appointment-details">
                        <strong>Budget Discussion</strong>
                        <span class="appointment-time">20 Dec, 9:00 AM</span>
                    </div>
                    <span class="status-badge status-upcoming">Upcoming</span>
                </div>
        </div>

        <div class="main-content">
            <div class="card">
                <div class="card-header">
                    <h2>Upcoming Projects</h2>
                    <span class="icon">📋</span>
                </div>
                <div class="list-item">
                    <span>Web Redesign</span>
                    <span class="status-badge status-upcoming">Upcoming</span>
                </div>
                <div class="list-item">
                    <span>Mobile App</span>
                    <span class="status-badge status-pending">Pending</span>
                </div>
                <div class="list-item">
                    <span>E-commerce Platform</span>
                    <span class="status-badge status-overdue">Overdue</span>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2>Pending Payments</h2>
                    <span class="icon">💰</span>
                </div>
                <div class="list-item">
                    <span>Client A</span>
                    <span>$5,000</span>
                    <span class="status-badge status-pending">Pending</span>
                </div>
                <div class="list-item">
                    <span>Client B</span>
                    <span>$3,500</span>
                    <span class="status-badge status-upcoming">Due Soon</span>
                </div>
                <div class="list-item">
                    <span>Client C</span>
                    <span>$2,200</span>
                    <span class="status-badge status-overdue">Overdue</span>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2>Notifications</h2>
                    <span class="icon">🔔</span>
                </div>
                <div class="list-item">
                    <div class="appointment-details">
                        <strong>New Project Proposal</strong>
                        <span class="appointment-time">Client D submitted a new proposal</span>
                    </div>
                    <span class="status-badge status-upcoming">New</span>
                </div>
                <div class="list-item">
                    <div class="appointment-details">
                        <strong>Payment Reminder</strong>
                        <span class="appointment-time">Reminder sent to Client B</span>
                    </div>
                    <span class="status-badge status-pending">Sent</span>
                </div>
                <div class="list-item">
                    <div class="appointment-details">
                        <strong>Deadline Extension</strong>
                        <span class="appointment-time">Mobile App project extension request</span>
                    </div>
                    <span class="status-badge status-overdue">Pending</span>
                </div>
            </div>
        </div>
    </div>


    </div>
    </div>
    <script src="script.js"></script>
</body>
</html>