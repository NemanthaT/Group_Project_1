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
            <div class="create-bill-section">
                <div class="back-link">
                    <a href="Bill.php">← Back to Bills</a>
                </div>
                
                <h2>Add Bill</h2>
                
                <form action="process_bill.php" method="POST" class="simple-form">
                    <div class="form-field">
                        <label for="project_id">Project ID</label>
                        <input type="text" id="project_id" name="project_id" placeholder="Enter project ID" required>
                    </div>
                    
                    <div class="form-field">
                        <label for="service">Service</label>
                        <input type="text" id="service" name="service" placeholder="Enter service name" required>
                    </div>
                    
                    <div class="form-field">
                        <label for="amount">Amount (Rs)</label>
                        <input type="number" id="amount" name="amount" placeholder="Enter amount" min="1" step="0.01" required>
                    </div>
                    
                    <div class="form-field">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" placeholder="Describe the bill" rows="4" required></textarea>
                    </div>
                    
                    <div class="form-field">
                        <label for="bill_date">Bill Date</label>
                        <input type="date" id="bill_date" name="bill_date" required>
                    </div>
                    
                    <div class="form-field">
                        <label for="payment_status">Payment Status</label>
                        <select id="payment_status" name="payment_status" required>
                            <option value="">Select status</option>
                            <option value="paid">Paid</option>
                            <option value="unpaid">Unpaid</option>
                        </select>
                    </div>
                    
                    <div class="form-actions">
                        <button type="button" class="cancel-button" onclick="window.location.href='Bill.php'">Cancel</button>
                        <button type="submit" class="submit-button">Add Bill</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>