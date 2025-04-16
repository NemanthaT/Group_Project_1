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
            <div class="bill-section">
                <center><h2>Bill</h2></center>
                <div class="filter-group search-group">
                    <select id="status-filter">
                        <option value="all">All Bills</option>
                        <option value="paid">Paid</option>
                        <option value="unpaid">Unpaid</option>
                    </select>
                    <input type="text" placeholder="Project ID" id="search">
                    <button class="search-button" id="search-btn">Search</button>
                    <button class="clear-button" id="clear-filters">Clear</button>
                    <div class="add-bill-button">
                        <a href="CreateBill.php"><button class="search-button">+ Add Bill</button></a>
                    </div>
                </div>
                <div class="bills-grid">
                    <!-- Bill Card 1 -->
                    <div class="bill-card">
                        <div class="bill-header">
                            <span class="payment-id">PAY001</span>
                            <span class="status unpaid">Unpaid</span>
                        </div>
                        <div class="bill-content">
                            <div class="bill-info">
                                <p><strong>Service:</strong> Financial consultancy for board of directers(stage 2)</p>
                                <p><strong>Amount:</strong> Rs 21,850</p>
                                <p><strong>Date:</strong> 2024-11-21</p>
                                <p><strong>Project ID:</strong> 001</p>
                            </div>
                            <a href="Viewbill.php">
                                <button class="pay-button green">View</button>
                            </a>
                        </div>
                    </div>
                
                    <!-- Bill Card 2 -->
                    <div class="bill-card">
                        <div class="bill-header">
                            <span class="payment-id">PAY002</span>
                            <span class="status paid">Paid</span>
                        </div>
                        <div class="bill-content">
                            <div class="bill-info">
                                <p><strong>Service:</strong> Social Media Marketing Strategy</p>
                                <p><strong>Amount:</strong> Rs 15,500</p>
                                <p><strong>Date:</strong> 2024-11-25</p>
                                <p><strong>Project ID:</strong> 002</p>
                            </div>
                            <a href="Viewbill.php">
                                <button class="pay-button green">View</button>
                            </a>
                        </div>
                    </div>
                </div>    
                <div class="bills-grid">
                    <!-- Bill Card 3 -->
                    <div class="bill-card">
                        <div class="bill-header">
                            <span class="payment-id">PAY003</span>
                            <span class="status paid">Paid</span>
                        </div>
                        <div class="bill-content">
                            <div class="bill-info">
                                <p><strong>Service:</strong> Corporate Leadership Training</p>
                                <p><strong>Amount:</strong> Rs 30,000</p>
                                <p><strong>Date:</strong> 2024-10-10</p>
                                <p><strong>Project ID:</strong> 004</p>
                            </div>
                            <a href="Viewbill.php">
                                <button class="pay-button green">View</button>
                            </a>
                        </div>
                    </div>

                    <!-- Bill Card 4 -->
                    <div class="bill-card">
                        <div class="bill-header">
                            <span class="payment-id">PAY004</span>
                            <span class="status unpaid">Unpaid</span>
                        </div>
                        <div class="bill-content">
                            <div class="bill-info">
                                <p><strong>Service:</strong> Contract Review and Drafting</p>
                                <p><strong>Amount:</strong> Rs 18,750</p>
                                <p><strong>Date:</strong> 2024-11-29</p>
                                <p><strong>Project ID:</strong> 006</p>
                            </div>
                            <a href="Viewbill.php">
                                <button class="pay-button green">View</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="Bill.js"></script>
</body>
</html>