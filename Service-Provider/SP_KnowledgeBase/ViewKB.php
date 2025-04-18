<?php 
include '../Session/Session.php';
include '../connection.php';

// Check if provider is logged in
if (!isset($_SESSION['provider_id'])) {
    echo "Unauthorized. Please log in.";
    exit;
}

$providerId = $_SESSION['provider_id']; // Logged-in provider's ID

// Fetch case study details
$modalCase = null;
if (isset($_GET['paper_id'])) {
    $paperId = $_GET['paper_id'];
    $stmt = $conn->prepare("SELECT * FROM researchpapers WHERE paper_id = ? AND provider_id = ?");
    $stmt->bind_param("ii", $paperId, $providerId);
    $stmt->execute();
    $result = $stmt->get_result();
    $modalCase = $result->fetch_assoc();
    $stmt->close();
}

if (!$modalCase) {
    echo "Case study not found.";
    exit;
}

// Handle case study update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'update') {
        $paperId = $_POST['paper_id'];
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';

        $stmt = $conn->prepare("UPDATE researchpapers SET title = ?, content = ? WHERE paper_id = ? AND provider_id = ?");
        $stmt->bind_param("ssii", $title, $description, $paperId, $providerId);
        $stmt->execute();
        header("Location: KB.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Case Study - EDSA Lanka Consultancy</title>
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
                <h2>View Case Study</h2>

                <!-- Form for Viewing/Updating Case Study -->
                <div class="case-study-form">
                    <h3>View/Update Case Study</h3>
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="paper_id" id="paper_id" value="<?php echo $modalCase['paper_id']; ?>">

                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($modalCase['title']); ?>" readonly>

                        <label for="description">Description:</label>
                        <textarea id="description" name="description" rows="5" readonly><?php echo htmlspecialchars($modalCase['content']); ?></textarea>

                        <button type="button" onclick="toggleEdit()">Edit</button>
                        <button type="submit">Update Case Study</button>
                        <a href="KB.php" class="cancel-btn">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="KB.js"></script>        
</body>
</html>