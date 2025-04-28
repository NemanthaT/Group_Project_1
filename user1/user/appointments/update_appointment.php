<?php
session_start(); // Start session at the beginning of the file
include '../../connect/connect.php';


$appointmentId = $_GET['appointment_id'];


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
    <script src="script.js"></script>

    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <img src="../images/logo.png" alt="EDSA Lanka Consultancy Logo">
            </div>
            <ul class="menu">
                <li>
                    <a href="../Dashboard/Dashboard.php">
                        <button>
                            <img src="../images/dashboard.png" alt="Dashboard">
                            Dashboard
                        </button>
                    </a>
                </li>
                <li>
                    <a href="../appointments/appointment.php">
                        <button class="active">
                            <img src="../images/appointment.png" alt="Appointment">
                            Appointment
                        </button>
                    </a>
                </li>
                <li>
                    <a href="../Project/project.php">
                        <button>
                            <img src="../images/project.png" alt="project">
                            Projects
                        </button>
                    </a>
                </li>
                <li>
                    <a href="../bill/bill.php">
                        <button>
                            <img src="../images/bill.png" alt="Bill">
                            Bill
                        </button>
                    </a>
                </li>
                <li>
                    <a href="../forum/forum.php">
                        <button>
                            <img src="../images/forum.png" alt="Forum">
                            Forum
                        </button>
                    </a>
                </li>
                <li>
                    <a href="../Message/Message.php">
                        <button>
                            <img src="../images/Message.png" alt="Message">
                            Message
                        </button>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content Area -->
        <div class="main-wrapper">
            <!-- Navbar -->
            <div class="navbar">
                <a href="#">
                    <!-- <img src="../images/notification.png" alt="Notifications"> -->
                </a>
                <div class="profile">
                    <a href="../profile/profile.php">
                        <img src="../images/user.png" alt="Profile">
                    </a>
                </div>
                <a href="../../../Login/Logout.php" class="logout">Logout</a>
            </div>

            <!-- Appointment Content -->
            <div class="space"></div>
            <div class="main-container">
                <div class="search-container">
                    <div> 

                <div class="overlay-content">
                    <h2>Edit Appointment</h2>
                    <form id="appointmentForm" action="update_appointment.php" method="POST">
                        <!-- <div class="form-group">
                            <label for="editAppointmentid">Appointment ID</label>
                            <input type="text" id="editAppointmentid" name="editAppointmentid" readonly required>
                        </div> -->
                        <div class="form-group">
                            <label for="editServiceSelect">Select a Service</label>
                            <select id="editServiceSelect" name="editServiceSelect" required>
                                <option value="">Choose a Service</option>
                                <option value="Consulting">Consulting</option>
                                <option value="Training">Training</option>
                                <option value="Researching">Researching</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editAppointmentDate">Select a Date</label>
                            <input type="date" id="editAppointmentDate" name="editAppointmentDate" required>
                        </div>
                        <div class="form-group">
                            <label for="editAdditionalMessage">Additional Message</label>
                            <textarea id="editAdditionalMessage" name="editAdditionalMessage" rows="4"></textarea>
                        </div>
                        <button type="submit" id="editSaveappointmentbtn" class="btn">Save</button>
                    </form>
                </div>
            </div>


            </div>
        </div>
    </div>


</body>
</html>
