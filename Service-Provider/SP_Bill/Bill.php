<?php
include '../Session/Session.php';
include '../connection.php';

// Get filters from GET parameters
$status = isset($_GET['status']) ? $_GET['status'] : 'all';
$project_id = isset($_GET['project_id']) ? trim($_GET['project_id']) : '';

// Build the query dynamically
$query = "SELECT * FROM bills WHERE 1=1";
$params = [];
$types = "";

// Filter by status if not 'all'
if ($status !== 'all' && ($status === 'paid' || $status === 'unpaid')) {
    $query .= " AND status = ?";
    $params[] = $status;
    $types .= "s";
}

// Filter by project_id if provided
if ($project_id !== '') {
    $query .= " AND project_id = ?";
    $params[] = $project_id;
    $types .= "i";
}

// Prepare and execute the statement
$stmt = $conn->prepare($query);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

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
                 <?php   
                    // Display cards
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $statusClass = strtolower($row['status']) === 'paid' ? 'paid' : 'unpaid';
                            echo '<div class="bill-card">';
                            echo    '<div class="bill-header">';
                            echo        '<span class="payment-id">PAY' . str_pad($row['bill_id'], 3, '0', STR_PAD_LEFT) . '</span>';
                            echo        '<span class="status ' . $statusClass . '">' . ucfirst($row['status']) . '</span>';
                            echo    '</div>';
                            echo    '<div class="bill-content">';
                            echo        '<div class="bill-info">';
                            echo            '<p><strong>Service:</strong> ' . htmlspecialchars($row['Description']) . '</p>';
                            echo            '<p><strong>Amount:</strong> Rs ' . htmlspecialchars($row['Amount']) . '</p>';
                            echo            '<p><strong>Date:</strong> ' . htmlspecialchars($row['Bill_Date']) . '</p>';
                            echo            '<p><strong>Project ID:</strong> ' . htmlspecialchars($row['project_id']) . '</p>';
                            echo        '</div>';
                            echo        '<a href="Viewbill.php?bill_id=' . $row['bill_id'] . '">';
                            echo            '<button class="pay-button green">View</button>';
                            echo        '</a>';
                            echo    '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo "<p>No bills found.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script src="Bill.js"></script>
</body>
</html>