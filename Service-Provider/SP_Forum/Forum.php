<?php
// Debug information - remove after fixing
error_reporting(E_ALL);
ini_set('display_errors', 1);
// End debug information

include '../Session/Session.php';
include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // Replace with the actual logged-in provider ID
        $providerId = 1; // You should retrieve this dynamically based on the logged-in user.

        // Create a new thread
        if ($action === 'create') {
            $title = $_POST['title'];
            $category = $_POST['category'];
            $message = $_POST['message'];

            // Ensure providerId and other fields are valid
            if (!empty($providerId) && !empty($title) && !empty($message) && !empty($category)) {
                $stmt = $conn->prepare("INSERT INTO forums (title, content, created_by, user_id, category, created_at, views, replies) VALUES (?, ?, ?, ?, ?, NOW(), 0, 0)");
                $stmt->bind_param("ssiss", $title, $message, $providerId, $providerId, $category);
                $stmt->execute();
            }
        }

        // Update an existing thread
        if ($action === 'update') {
            $forumId = $_POST['forum_id'];
            $title = isset($_POST['title']) ? $_POST['title'] : '';
            $content = isset($_POST['content']) ? $_POST['content'] : '';

            $stmt = $conn->prepare("UPDATE forums SET title = ?, content = ? WHERE forum_id = ?");
            $stmt->bind_param("ssi", $title, $content, $forumId);
            $stmt->execute();
        }

        // Delete a thread
        if ($action === 'delete') {
            $forumId = $_POST['forum_id'];

            $stmt = $conn->prepare("DELETE FROM forums WHERE forum_id = ?");
            $stmt->bind_param("i", $forumId);
            $stmt->execute();
        }

        // Redirect back to avoid form resubmission issues
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Fetch all forum threads
$result = $conn->query("SELECT * FROM forums ORDER BY created_at DESC");
if ($result) {
    $threads = $result->fetch_all(MYSQLI_ASSOC);
} else {
    // Handle database query error
    $threads = [];
    echo "Error fetching threads: " . $conn->error;
}

// If the thread ID is set in the URL, fetch details for the modal form
$modalThread = null;
if (isset($_GET['forum_id'])) {
    $forumId = $_GET['forum_id'];
    $stmt = $conn->prepare("SELECT * FROM forums WHERE forum_id = ?");
    $stmt->bind_param("i", $forumId);
    $stmt->execute();
    $result = $stmt->get_result();
    $modalThread = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka Consultancy</title>
    <link rel="stylesheet" href="Forum.css">
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
            <div class="forum-section">
                <center><h2>Forum</h2></center>

                <!-- Button to Open "Create New Thread" Modal -->
                <button type="button" onclick="openCreateThreadModal()">+ Create Thread</button>

                <!-- Modal for Creating New Thread -->
                <div class="modal-overlay" id="createThreadModalOverlay" style="display: none;"></div>
                <div class="modal create-thread-modal" id="createThreadModal" style="display: none;">
                    <h3>Create a New Thread</h3>
                    <form action="" method="POST">
                        <input type="hidden" name="action" value="create">
                        <label for="newThreadTitle">Title:</label>
                        <input type="text" id="newThreadTitle" name="title" class="input-field" placeholder="Enter thread title">

                        <label for="newThreadCategory">Category:</label>
                        <select id="newThreadCategory" name="category" class="input-field">
                            <option value="General Discussions">General Discussions</option>
                            <option value="Technical Support">Technical Support</option>
                            <option value="Product/Service Feedback">Product/Service Feedback</option>
                            <option value="How-to Guides">How-to Guides</option>
                            <option value="Off-Topic">Off-Topic</option>
                        </select>

                        <label for="newThreadMessage">Message:</label>
                        <textarea id="newThreadMessage" name="message" class="input-field" rows="5" placeholder="Enter your message"></textarea>

                        <button type="submit" class="submit-btn">Create</button>
                        <button type="button" onclick="closeCreateThreadModal()" class="cancel-btn">Cancel</button>
                    </form>
                </div>

                <!-- Thread View Modal -->
                <div class="modal-overlay" id="modalOverlay" style="display: none;"></div>
                <div class="modal view-thread-modal" id="modalForm" style="display: none;">
                    <h3>Thread Details</h3>
                    <div class="thread-details">
                        <h4 id="modalTitle"></h4>
                        <p id="modalContent"></p>
                        <div class="thread-meta">
                            <span id="modalViews"></span> | <span id="modalReplies"></span>
                        </div>
                    </div>
                    <button type="button" onclick="closeModal()" class="cancel-btn">Close</button>
                </div>

                <!-- Forum Search -->
                <div class="forum-search">
                    <input type="text" id="search-input" placeholder="Search forum topics">
                    <button onclick="searchTopics()">Search</button>
                </div>

                <!-- Forum Categories -->
                <div class="forum-categories">
                    <h3>Categories</h3>
                    <ul id="category-list">
                        <li><button onclick="filterByCategory('General Discussions')">General Discussions</button></li>
                        <li><button onclick="filterByCategory('Technical Support')">Technical Support</button></li>
                        <li><button onclick="filterByCategory('Product/Service Feedback')">Product/Service Feedback</button></li>
                        <li><button onclick="filterByCategory('How-to Guides')">How-to Guides</button></li>
                        <li><button onclick="filterByCategory('Off-Topic')">Off-Topic</button></li>
                    </ul>
                </div>

                <!-- Forum Threads -->
                <div class="forum-threads">
                    <h3>Recent Threads</h3>
                    <ul id="thread-list">
                        <?php if (empty($threads)): ?>
                            <li class="no-threads">
                                <p>No threads found. Be the first to create a thread!</p>
                            </li>
                        <?php else: ?>
                            <?php foreach ($threads as $thread): ?>
                                <li data-category="<?= htmlspecialchars($thread['category'] ?? 'General Discussions') ?>" id="thread-<?= $thread['forum_id'] ?>">
                                    <h4><?= htmlspecialchars($thread['title']) ?></h4>
                                    <p>Started by <span class="username">User <?= htmlspecialchars($thread['created_by'] ?? 'Unknown') ?></span> - <?= $thread['replies'] ?? 0 ?> replies</p>
                                    <div class="button-container">
                                        <button class="view-btn" onclick="viewThread('<?= htmlspecialchars(addslashes($thread['title'])) ?>', '<?= htmlspecialchars(addslashes($thread['content'])) ?>', <?= $thread['views'] ?? 0 ?>, <?= $thread['replies'] ?? 0 ?>)">View</button>
                                        <form action="" method="POST" style="display: inline;">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="forum_id" value="<?= $thread['forum_id'] ?>">
                                            <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this thread?')">Delete</button>
                                        </form>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="Forum.js"></script>
</body>
</html>
