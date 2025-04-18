<?php 
include '../Session/Session.php';
include '../connection.php';

// Check if provider is logged in
if (!isset($_SESSION['provider_id'])) {
    echo "Unauthorized. Please log in.";
    exit;
}

$providerId = $_SESSION['provider_id']; // Logged-in provider's ID

// Handle CRUD operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // Delete a case study
        if ($action === 'delete') {
            $paperId = $_POST['paper_id'];

            $stmt = $conn->prepare("DELETE FROM researchpapers WHERE paper_id = ? AND provider_id = ?");
            $stmt->bind_param("ii", $paperId, $providerId);
            $stmt->execute();
        }

        // Redirect back to avoid form resubmission issues
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Fetch all published case studies for the logged-in provider
$stmt = $conn->prepare("SELECT * FROM researchpapers WHERE provider_id = ? ORDER BY published_at DESC");
$stmt->bind_param("i", $providerId);
$stmt->execute();
$result = $stmt->get_result();
$caseStudies = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka Consultancy</title>
    <link rel="stylesheet" href="KB.css">
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
                            <button id="prevMonth"><</button>
                            <span id="currentMonth">March 2025</span>
                            <button id="nextMonth">></button>
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
            <div class="KB-section">
                <h2>Case Studies and Knowledge Resources</h2>

                <!-- Button to Create Case Study -->
                <div class="case-study-actions">
                    <a href="createKB.php" class="create-btn">Create Case Study</a>
                </div>

                <!-- Published Case Studies Section -->
                <div class="published-case-studies">
                    <h3>Published Case Studies</h3>
                    <div class="search-bar">
                        <input type="text" id="searchInput" placeholder="Search case studies...">
                        <button type="button" id="searchButton" onclick="searchCaseStudies()">Search</button>
                        <button type="button" id="clearButton" class="clear-btn" onclick="clearSearch()">Clear</button>
                    </div>
                </div>        
                <div class="published-case-studies-container">
                    <?php foreach ($caseStudies as $case): ?>
                        <div class="case-study-card" id="case-<?php echo $case['paper_id']; ?>">
                            <!-- Display only the title -->
                            <h4><?php echo htmlspecialchars($case['title']); ?></h4>

                            <!-- Buttons for actions -->
                            <div class="case-study-buttons">
                                <a href="ViewKB.php?paper_id=<?php echo $case['paper_id']; ?>" class="view-btn">View</a>
                                <form method="POST" style="display:inline;" onsubmit="return confirmDelete(<?php echo $case['paper_id']; ?>);">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="paper_id" value="<?php echo $case['paper_id']; ?>">
                                    <button type="submit" class="delete-btn">Delete</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="KB.js"></script>        
</body>
</html>