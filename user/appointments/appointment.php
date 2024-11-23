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
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <img src="../images/logo.png" alt="EDSA Lanka Consultancy Logo">
            </div>
            
            <ul class="menu">
                <li><a href="../Dashboard/Dashboard.php">
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

            <!-- Appointment Content -->
            <div class="main-container">
                <header>
                    <h1>Appointment Management</h1>
                </header>

                <div class="search-container">
                    <div>
                        <input type="text" id="searchInput" class="searchInput" placeholder="Appointment ID.">
                        <button id="Search" class="btn">Search</button>
                    </div>
                    <div>
                        <button id="addAppointmentBtn" class="btn">Add Appointment</button>
                    </div>
                </div>

                <table class="appointment-table">
                    <thead>
                        <tr>
                            <th>Appointment ID</th>
                            <th>Service</th>
                            <th>Appointment Date</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="appointmentList">
                        <?php
                            include '../../connect/connect.php';
                            $sql = "SELECT * FROM appointments";
                            $result = $conn->query($sql);
        
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['appointment_id'] . "</td>";
                                    echo "<td>" . $row['service_type'] . "</td>";
                                    echo "<td>" . $row['appointment_date'] . "</td>";
                                    echo "<td>" . $row['status'] . "</td>";
                                    echo "<td>" . $row['created_at'] . "</td>";
                                    echo "<td>";
                                    echo "<button class='btn edit-btn'>Edit</button>";
                                    echo "<button class='btn cancel-btn'>Cancel</button>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            }
                        
                        ?>
                </tbody>
                </table>

                <!-- Add Appointment Overlay -->
                <div id="addAppointmentOverlay" class="overlay">
                    <div class="overlay-content">
                        <span class="close-btn">&times;</span>
                        <h2>Add New Appointment</h2>
                        <form id="appointmentForm">
                            <div class="form-group">
                                <label for="serviceSelect">Select a Service</label>
                                <select id="serviceSelect" name="serviceSelect"  required>
                                    <option value="">Choose a Service</option>
                                    <option value="Consulting">Consulting</option>
                                    <option value="training">Training</option>
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
                            <button type="submit" id = "Bookappointmentbtn"class="btn">Book Appointment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>