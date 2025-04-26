<?php
include '../Session/Session.php';
include '../connection.php';
include '../Common template/SP_common.php';

// Ensure session is started and provider is logged in
if (!isset($_SESSION['provider_id'])) {
    die("Unauthorized access. Please log in as a provider.");
}

$providerId = $_SESSION['provider_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        // Create a new thread
        if ($action === 'create') {
            $title = $_POST['title'];
            $message = $_POST['message'];
            $category = $_POST['category'];

            if (!empty($providerId) && !empty($title) && !empty($message) && !empty($category)) {
                $createdBy = 'ServiceProvider';
                $stmt = $conn->prepare("INSERT INTO forums (title, content, created_by, user_id, category, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
                $stmt->bind_param("sssiss", $title, $message, $createdBy, $providerId, $category);
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
        // Redirect to avoid form resubmission
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Fetch all forum threads created by the logged-in provider
$stmt = $conn->prepare("SELECT * FROM forums WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $providerId);
$stmt->execute();
$result = $stmt->get_result();
$threads = $result->fetch_all(MYSQLI_ASSOC);

// Fetch thread details for modal form if editing/viewing
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
    <link rel="stylesheet" href="../Common template/SP_common.css">
    <link rel="stylesheet" href="Forum.css">
</head>
<body>
        <div class="main-content">
            <div class="forum-section">
                <center><h2>Forum</h2></center>
                <div class="filter-group search-group">
                    <input type="text" id="searchInput" placeholder="Search forum topics">
                    <button class="search-button" id="searchButton" onclick="searchTopics()">Search</button>
                    <button class="clear-button" id="clearButton" onclick="clearSearch()">Clear</button>
                    <button class="search-button"onclick="openCreateThreadModal()">+ Create Thread</button>
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
                                    <p>Started by <span class="username">Service Provider <?= htmlspecialchars($thread['created_by'] ?? 'Unknown') ?></span> - <?= $thread['replies'] ?? 0 ?> replies</p>
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
    </div>   <!--this is the </div> of container in the common file, don't remove it-->
<script src="Forum.js"></script>
<script src="../Common template/Calendar.js"></script>
</body>
</html>