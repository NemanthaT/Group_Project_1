<?php
include '../session/session.php';
include '../../connect/connect.php';

// Check if client is logged in
if (!isset($_SESSION['client_id'])) {
    echo "Unauthorized. Please log in.";
    exit;
}

$clientId = $_SESSION['client_id'];

// Fetch chat threads for the client with provider name
$query = "SELECT t.thread_id, t.provider_id, s.full_name, t.topic, 
                 (SELECT m.message_text 
                  FROM chat_messages m 
                  WHERE m.thread_id = t.thread_id 
                  ORDER BY m.sent_at DESC 
                  LIMIT 1) AS last_message,
                 (SELECT m.status 
                  FROM chat_messages m 
                  WHERE m.thread_id = t.thread_id 
                  ORDER BY m.sent_at DESC 
                  LIMIT 1) AS status
          FROM chat_threads t
          JOIN serviceproviders s ON t.provider_id = s.provider_id
          WHERE t.client_id = ?
          ORDER BY (SELECT MAX(m.sent_at) 
                    FROM chat_messages m 
                    WHERE m.thread_id = t.thread_id) DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $clientId);
$stmt->execute();
$result = $stmt->get_result();
$threads = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka Consultancy</title>
    <link rel="stylesheet" href="../Common template/SP_common.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="../images/logo.png" alt="EDSA Lanka Consultancy Logo">
        </div>
        <ul class="menu">
            <li>
                <a href="../Dashboard/Dashboard.php">
                    <button>
                        <img src="../images/dashboard.png" alt="Dashboard">
                        Dashboard
                    </button>
                </a>
            </li>
            <li>
                <a href="../appointments/appointment.php">
                    <button>
                        <img src="../images/appointment.png" alt="Appointment">
                        Appointment
                    </button>
                </a>
            </li>
            <li>
                <a href="../Project/project.php">
                    <button>
                        <img src="../images/project.png" alt="project">
                        Projects
                    </button>
                </a>
            </li>
            <li>
                <a href="../bill/bill.php">
                    <button>
                        <img src="../images/bill.png" alt="Bill">
                        Bill
                    </button>
                </a>
            </li>
            <li>
                <a href="">
                    <button>
                        <img src="../images/forum.png" alt="Forum">
                        Forum
                    </button>
                </a>
            </li>
            <li>
                <a href="../Message/Message.php">
                    <button class="active">
                        <img src="../images/Message.png" alt="Message">
                        Message
                    </button>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content Area -->
    <div class="main-wrapper">
        <!-- Navbar -->
        <div class="navbar">
            <a href="#">
                <img src="../images/notification.png" alt="Notifications">
            </a>
            <div class="profile">
                <a href="../profile/profile.php">
                    <img src="../images/user.png" alt="Profile">
                </a>
            </div>
            <a href="../../../Login/Logout.php" class="logout">Logout</a>
        </div>

        <div class="main-content">
            <br><br><br><br><br><br><br>
            <div class="message-section">
                <h2>Messages</h2>
                <div class="split-container">
                    <!-- Left Panel: Thread List -->
                    <div class="thread-panel">
                        <div class="message-controls">
                            <input type="text" placeholder="Provider Name/Topic" id="search-input">
                            <button class="search-button">Search</button>
                            <button class="clear-button" id="clear-button">Clear</button>
                            <button class="create-chat-button">Create Chat</button>
                        </div>

                        <!-- Create Chat Modal -->
                        <div id="create-chat-modal" class="modal">
                            <div class="modal-content">
                                <button class="close-create-chat-modal" title="Close">×</button>
                                <h3>Create New Chat</h3>
                                <form id="create-chat-form">
                                    <div class="form-section">
                                        <label for="provider-id">Provider ID:</label>
                                        <input type="text" id="provider-id" name="provider-id" required>
                                    </div>
                                    <div class="form-section">
                                        <label for="topic">Topic:</label>
                                        <input type="text" id="topic" name="topic" required>
                                    </div>
                                    <div class="form-section">
                                        <label for="message">Message:</label>
                                        <textarea id="message" name="message" required></textarea>
                                    </div>
                                    <div class="form-footer">
                                        <button type="submit" class="create-chat-button">Create</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <table class="message-table">
                            <thead>
                                <tr>
                                    <th>Provider Name</th>
                                    <th>Topic</th>
                                    <th>Last Message</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="message-tbody">
                                <?php foreach ($threads as $thread): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($thread['full_name']); ?></td>
                                        <td><?php echo htmlspecialchars($thread['topic']); ?></td>
                                        <td><?php echo htmlspecialchars($thread['last_message'] ?? 'No messages yet'); ?></td>
                                        <td><?php echo htmlspecialchars($thread['status'] ?? 'Unseen'); ?></td>
                                        <td><button class="chat-button" data-thread-id="<?php echo $thread['thread_id']; ?>" data-provider-id="<?php echo $thread['provider_id']; ?>">Chat</button></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Right Panel: Chat Window -->
                    <div class="chat-panel" id="chat-modal" style="display: none;">
                        <div class="chat-header">
                            <h3>Chat with Provider <span id="chat-provider-id"></span></h3>
                            <button class="close-chat-modal" title="Close">×</button>
                        </div>
                        <div class="chat-window" id="chat-window">
                            <!-- Chat messages will be displayed here -->
                        </div>
                        <div class="chat-input-section">
                            <textarea id="chat-input" placeholder="Type your message..."></textarea>
                            <button id="send-chat" class="send-chat">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>