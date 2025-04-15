<?php
include '../Session/Session.php';
include '../connection.php';

$providerId = $_SESSION['provider_id']; 
$sql = "SELECT project_id, client_id, provider_id, project_name, project_description, project_phase, project_status, created_date FROM projects WHERE provider_id = '$providerId' ORDER BY created_date DESC";
$result = $conn->query($sql);
if ($result === false) {
    die("Error: " . $conn->error);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka Consultancy</title>
    <link rel="stylesheet" href="Project.css">
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

            <!-- Main Content (Forum Page) -->
            <div class="main-content">
                <div class="project-section">
                    <center><h2>Project</h2></center>
                
                    <div class="filter-group search-group">
    <select id="status-filter">
        <option value="all">All Projects</option>
        <option value="paid">Ongoing</option>
        <option value="unpaid">Completed</option>
    </select>
    <input type="text" placeholder="Search client ID or service..." id="search">
    <button class="search-button">Search</button>
    <a href="AddProject.php">
        <button class="search-button">+ Projects</button>
    </a>
</div>

<!-- Bills Grid -->
<div class="bills-grid">
<!-- Bill Card 1 -->
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="bill-card">
                <div class="bill-header">
                    <span class="payment-id">PROJECT</span>
                    <span class="status <?php echo strtolower($row['project_status']); ?>">
                        <?php echo ucfirst($row['project_status']); ?>
                    </span>
                </div>
                <div class="bill-content">
                    <div class="bill-info">
                        <p><strong>Service:</strong> <?php echo htmlspecialchars($row['project_name']); ?></p>
                        <p><strong>Description:</strong> <?php echo htmlspecialchars($row['project_description']); ?></p>
                        <p><strong>Date:</strong> <?php echo htmlspecialchars($row['created_date']); ?></p>
                        <p><strong>Project ID:</strong> <?php echo htmlspecialchars($row['project_id']); ?></p>
                    </div>
                    <a href="EditProject.php?project_id=<?php echo $row['project_id']; ?>">
                        <button class="pay-button green" >View</button>
                    </a>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No projects found.</p>
    <?php endif; ?>

</div>
            </div>    

</body>
</html>
