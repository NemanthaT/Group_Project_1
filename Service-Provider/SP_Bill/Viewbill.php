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
    <link rel="stylesheet" href="Bill.css">
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

            <!-- Main Content -->
            <div class="main-content">
                <div class="view-bill-section">
                    <center><h2>View Bill</h2></center>
                    <div class="boxcontent"> 
    <div class="invoice-header">
        <div class="company-info">
            <h1>EDSA Lanka Consultancy</h1>
            <p>No. 45, Lotus Road<br>Colombo 01, Sri Lanka</p>
            <p>Tel: +94 11 234 5678</p>
        </div>
        <div class="invoice-details">
            <h2>INVOICE</h2>
            <p>Invoice Number: SD-2024-1127</p>
            <p>Date: November 27, 2024</p>
            <p>Due Date: December 15, 2024</p>
        </div>
    </div>

    <div class="bill-to">
        <h3>Bill To:</h3>
        <p>Priyantha Gunawardena<br>
        456 Galle Road<br>
        Ratmalana, Western Province 10380</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th style="width:20%">Amount (LKR)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Advance</td>
                <td>19,000</td>
            </tr>
        </tbody>
    </table>

    <div class="total-section">
        <p>Subtotal: 19,000 LKR</p>
        <p>VAT (15%): 2,850 LKR</p>
        <strong>Total Due: 21,850 LKR</strong>
    </div>
    <div>
        <button class="pay-button">Edit</button>
    </div>
    </div>
            </div>
                </div>    
         
    <script src="#"></script>
</body>
</html