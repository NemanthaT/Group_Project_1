<?php
include '../Session/Session.php';
include '../connection.php';
include '../Common template/SP_common.php';

if (!isset($_SESSION['provider_id'])) {
    die("Unauthorized access. Please log in as a provider.");
}

$providerId = $_SESSION['provider_id'];

$stmt = $conn->prepare("SELECT full_name FROM serviceproviders WHERE provider_id = ?");
$stmt->bind_param("i", $providerId);
$stmt->execute();
$result = $stmt->get_result();
$provider = $result->fetch_assoc();
$fullName = $provider['full_name'] ?? 'Unknown Provider';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        if ($action === 'create') {
            $title = $_POST['title'];
            $message = $_POST['message'];
            $category = $_POST['category'];

            if (!empty($providerId) && !empty($title) && !empty($message) && !empty($category)) {
                $stmt = $conn->prepare("INSERT INTO forums (provider_id, title, category, content, created_at) VALUES (?, ?, ?, ?, NOW())");
                $stmt->bind_param("isss", $providerId, $title, $category, $message);
                $stmt->execute();
            }
        }

        if ($action === 'update') {
            $forumId = $_POST['forum_id'];
            $title = isset($_POST['title']) ? $_POST['title'] : '';
            $content = isset($_POST['content']) ? $_POST['content'] : '';
            $category = isset($_POST['category']) ? $_POST['category'] : '';

            $stmt = $conn->prepare("UPDATE forums SET title = ?, content = ?, category = ? WHERE forum_id = ?");
            $stmt->bind_param("sssi", $title, $content, $category, $forumId);
            $stmt->execute();
        }

        if ($action === 'delete') {
            $forumId = $_POST['forum_id'];

            $stmt = $conn->prepare("DELETE FROM forums WHERE forum_id = ?");
            $stmt->bind_param("i", $forumId);
            $stmt->execute();
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

$stmt = $conn->prepare("SELECT f.forum_id, f.title, f.content, f.provider_id, f.created_at, f.category, sp.full_name 
                        FROM forums f 
                        JOIN serviceproviders sp ON f.provider_id = sp.provider_id 
                        WHERE f.provider_id = ? 
                        ORDER BY f.created_at DESC");
$stmt->bind_param("i", $providerId);
$stmt->execute();
$result = $stmt->get_result();
$threads = $result->fetch_all(MYSQLI_ASSOC);

$modalThread = null;
if (isset($_GET['forum_id'])) {
    $forumId = $_GET['forum_id'];
    $stmt = $conn->prepare("SELECT forum_id, title, content, created_by, provider_id, created_at, category FROM forums WHERE forum_id = ?");
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
                <button class="search-button" onclick="openCreateThreadModal()">+ Create Thread</button>
            </div>

            <div class="forum-categories">
                <h3>Categories</h3>
                <ul id="category-list">
                    <li><button onclick="filterByCategory('Gender Finance')">Gender Finance</button></li>
                    <li><button onclick="filterByCategory('Micro Business')">Micro Business</button></li>
                    <li><button onclick="filterByCategory('SME Development')">SME Development</button></li>
                    <li><button onclick="filterByCategory('Community Development')">Community Development</button></li>
                    <li><button onclick="filterByCategory('Off-Topic')">Off-Topic</button></li>
                </ul>
            </div>    

            <div class="modal-overlay" id="createThreadModalOverlay" style="display: none;"></div>
            <div class="modal create-thread-modal" id="createThreadModal" style="display: none;">
                <h3>Create a New Thread</h3>
                <form action="" method="POST" onsubmit="return validateCreateThreadForm(event)">
                    <input type="hidden" name="action" value="create">
                    <label for="newThreadTitle">Title:</label>
                    <input type="text" id="newThreadTitle" name="title" class="input-field" placeholder="Enter thread title" maxlength="100" required>

                    <label for="newThreadCategory">Category:</label>
                    <select id="newThreadCategory" name="category" class="input-field" required>
                        <option value="Gender Finance">Gender Finance</option>
                        <option value="Micro Business">Micro Business</option>
                        <option value="SME Development">SME Development</option>
                        <option value="Community Development">Community Development</option>
                        <option value="Off-Topic">Off-Topic</option>
                    </select>

                    <label for="newThreadMessage">Message:</label>
                    <textarea id="newThreadMessage" name="message" class="input-field" rows="5" placeholder="Enter your message" maxlength="1000" required></textarea>

                    <button type="submit" class="submit-btn">Create</button>
                    <button type="button" onclick="closeCreateThreadModal()" class="cancel-btn">Cancel</button>
                </form>
            </div>

            <div class="modal-overlay" id="updateThreadModalOverlay" style="display: none;"></div>
            <div class="modal update-thread-modal" id="updateThreadModal" style="display: none;">
                <h3>Update Thread</h3>
                <form action="" method="POST" onsubmit="return validateUpdateThreadForm(event)">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="forum_id" id="updateThreadForumId">
                    <label for="updateThreadTitle">Title:</label>
                    <input type="text" id="updateThreadTitle" name="title" class="input-field" placeholder="Enter thread title" maxlength="100" required>
                    <label for="updateThreadCategory">Category:</label>
                    <select id="updateThreadCategory" name="category" class="input-field" required>
                        <option value="Gender Finance">Gender Finance</option>
                        <option value="Micro Business">Micro Business</option>
                        <option value="SME Development">SME Development</option>
                        <option value="Community Development">Community Development</option>
                        <option value="Off-Topic">Off-Topic</option>
                    </select>
                    <label for="updateThreadMessage">Message:</label>
                    <textarea id="updateThreadMessage" name="content" class="input-field" rows="5" placeholder="Enter your message" maxlength="1000" required></textarea>
                    <button type="submit" class="submit-btn">Update</button>
                    <button type="button" onclick="closeUpdateThreadModal()" class="cancel-btn">Cancel</button>
                </form>
            </div>

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

            <div class="forum-threads">
                <h3>Recent Threads</h3> 
                <ul id="thread-list">
                    <?php if (empty($threads)): ?>
                        <li class="no-threads">
                            <p>No threads found. Be the first to create a thread!</p>
                        </li>
                    <?php else: ?>
                        <?php foreach ($threads as $thread): ?>
                            <li data-category="<?= htmlspecialchars($thread['category'] ?? 'Gender Finance') ?>" id="thread-<?= $thread['forum_id'] ?>">
                                <h4><?= htmlspecialchars($thread['title']) ?></h4>
                                <p>Started by <span class="username"><?= htmlspecialchars($thread['full_name'] ?? 'Unknown') ?></span> - <?= $thread['replies'] ?? 0 ?> replies</p>
                                <div class="button-container">
                                    <button class="view-btn" onclick="viewThread('<?= htmlspecialchars(addslashes($thread['title'])) ?>', '<?= htmlspecialchars(addslashes($thread['content'])) ?>', <?= $thread['views'] ?? 0 ?>, <?= $thread['replies'] ?? 0 ?>)">View</button> 
                                    <form action="" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this thread?')">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="forum_id" value="<?= $thread['forum_id'] ?>">
                                        <button type="submit" class="delete-btn">Delete</button>
                                    </form>
                                    <button class="update-btn" onclick="openUpdateThreadModal(<?= $thread['forum_id'] ?>, '<?= htmlspecialchars(addslashes($thread['title'])) ?>', '<?= htmlspecialchars(addslashes($thread['content'])) ?>', '<?= htmlspecialchars(addslashes($thread['category'])) ?>')">Update</button>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
    <script src="Forum.js"></script>
    <script src="../Common template/Calendar.js"></script>
</body>
</html>