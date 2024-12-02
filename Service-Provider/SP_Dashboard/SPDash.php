<?php
include '../Session/Session.php';
include '../connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka Consultancy</title>
    <link rel="stylesheet" href="SPDash.css">
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

        <!-- Main Content Wrapper -->
        <div class="main-wrapper">
            <!-- Navbar -->
            <header>
                <nav class="navbar">       
                        <a href="../Home/Homepage/HP.html">Home</a>
                        <a href="#"><img src="../images/notification.png" alt="Notifications"></a>
                    <div class="profile">
                        <a href="../SP_Profile/Profile.php"><img src="../images/user.png" alt="Profile"></a>
                    </div>
                    <a href="../../Login/Logout.php" class="logout">Logout</a>
                </nav>
            </header>

            <!-- Main Content -->
            <div class="main-content">
                <div class="dashboard">
                    <div class="left-section">
                    <div class="card">
                        <h3>Projects</h3>
                            <p>Assigned Projects : 14</p>
                            <p>Ongoing Projects : 8</p>
                            <p>Completed Projects : 6</p>
                    </div>
                    <div class="card">
                        <h3>Appointments</h3>
                            <p>No.of Appointments : 9</p>
                            <p>Scheduled : 5</p>
                            <p>Rejected : 2</p>
                            <p>Cancelled : 2</p>
                        </div>
                    </div>
                    <div class="right-section">
                        <div class="card clock-card">
                            <h3>Current Time</h3>
                            <div id="time">Loading...</div>
                        </div>
                        <div class="calendar">
                            <div class="calendar-header">
                                <button onclick="prevMonth()">‹</button>
                                <h2 id="monthYear"></h2>
                                <button onclick="nextMonth()">›</button>
                            </div>
                            <div class="days">
                                <div class="day">Sun</div>
                                <div class="day">Mon</div>
                                <div class="day">Tue</div>
                                <div class="day">Wed</div>
                                <div class="day">Thu</div>
                                <div class="day">Fri</div>
                                <div class="day">Sat</div>
                            </div>
                            <div class="days" id="dates"></div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <script src="calendar.js"></script>
</body>
</html>
