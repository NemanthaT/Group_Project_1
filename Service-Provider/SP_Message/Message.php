<?php
include '../Session/Session.php';
include '../connection.php';
include '../Common template/SP_common.php';

// Check if provider is logged in
if (!isset($_SESSION['provider_id'])) {
    echo "Unauthorized. Please log in.";
    exit;
}

$providerId = $_SESSION['provider_id'];

// Fetch chat threads for the provider with client name
$query = "SELECT t.thread_id, t.client_id, c.full_name, t.topic, 
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
          JOIN clients c ON t.client_id = c.client_id
          WHERE t.provider_id = ?
          ORDER BY (SELECT MAX(m.sent_at) 
                    FROM chat_messages m 
                    WHERE m.thread_id = t.thread_id) DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $providerId);
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
    <link rel="stylesheet" href="Message.css">
</head>
<body>
    <div class="main-content">
        <div class="message-section">
            <h2>Messages</h2>
            <div class="split-container">
                <!-- Left Panel: Thread List -->
                <div class="thread-panel">
                    <div class="message-controls">
                        <input type="text" placeholder="Client Name/Topic" id="search-input">
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
                                    <label for="client-id">Client ID:</label>
                                    <input type="text" id="client-id" name="client-id" required>
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
                                <th>Client Name</th>
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
                                    <td><button class="chat-button" data-thread-id="<?php echo $thread['thread_id']; ?>" data-client-id="<?php echo $thread['client_id']; ?>" data-client-name="<?php echo htmlspecialchars($thread['full_name']); ?>">Chat</button></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Right Panel: Chat Window -->
                <div class="chat-panel" id="chat-panel" style="display: none;">
                    <div class="chat-header">
                        <h3>Chat with <span id="chat-client-name"></span></h3>
                        <button class="close-chat-panel" title="Close">×</button>
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
    <script src="Message.js"></script>
    <script src="../Common template/Calendar.js"></script>
</body>
</html>