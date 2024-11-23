<?php 
include '../session/session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <img src="../images/logo.png" alt="EDSA Lanka Consultancy Logo">
            </div>
            
            <ul class="menu">
                <li><a href="../Dashboard/Dashboard.php">
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
                    <a href="../bill/bill.php">
                    <button>
                        <img src="../images/bill.jpg" alt="Bill">
                        Bill
                    </button>
                    </a>
                </li>
                <li>
                    <button>
                        <img src="../images/forum.png" alt="Forum">
                        Forum
                    </button>
                </li>
                <li>
                    <button>
                        <img src="../images/knowledgebase.png" alt="Knowledge Base">
                        Knowledge Base
                    </button>
                <li>
                    <a href="../reports/reports.php">
                        <button>
                            <img src="../images/reports.png" alt="Reports">
                            Reports
                        </button>
                    </a>
                </li>
                <li>
                    <a href="../settings/settings.php">
                        <button>
                            <img src="../images/settings.png" alt="Settings">
                            Settings
                        </button>
                    </a>
                </li>
                </li>
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
                    <a href="../SP_Profile/Profile.html">
                        <img src="../images/user.png" alt="Profile">
                    </a>
                </div>
                <a href="../../Login/Logout.php" class="logout">Logout</a>
            </div>


</body>
</html>