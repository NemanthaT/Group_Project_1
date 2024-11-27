
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
                    <a href="">
                    <button>
                        <img src="../images/knowledgebase.png" alt="Knowledge Base">
                        Knowledge Base
                    </button>
                    </a>
                </li>
                <li>
                    <a href="../reports/reports.php">
                        <button >
                            <img src="../images/reports.png" alt="Reports">
                            Reports
                        </button>
                    </a>
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
        <div class="controls">

                <!-- Add/Edit Appointment Overlay -->
                <div id="EditAppointmentOverlay" class="overlay">
                    <div class="overlay-content">
                        <span class="close-btn">&times;</span>
                        <h2  >View Appointment</h2>
                        <form id="appointmentForm">
                            <div class="form-group">
                                <label for="appointmentid">Appointment ID</label>
                                <input type="text" id="appointmentid" name="appointmentid" required>
                            </div>
                            <div class="form-group">
                                <label for="serviceSelect">Select a Service</label>
                                <select id="serviceSelect" name="serviceSelect" required>
                                    <option value="">Choose a Service</option>
                                    <option value="Consulting">Consulting</option>
                                    <option value="Training">Training</option>
                                    <option value="Researching">Researching</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="appointmentDate">Select a Date</label>
                                <input type="date" id="appointmentDate" name="appointmentDate" required>
                            </div>
                            <div class="form-group">
                                <label for="additionalMessage">Additional Message</label>
                                <textarea id="additionalMessage" name="additionalMessage" rows="4"></textarea>
                            </div>
                            <button type="submit" id="Saveappointmentbtn" class="btn"></button>
                        </form>
                    </div>
                </div>


        </div>

    </div>
    <script src="script.js"></script>
</body>
</html>