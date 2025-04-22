<?php
    include '../session/session.php';
    include '../../connect/connect.php';
if (!isset($_SESSION['client_id'])) {
    echo "Unauthorized";
    exit;
}

$clientId = $_SESSION['client_id'];
$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($action === 'create_chat') {
    $providerId = intval($_POST['provider_id']);
    $topic = trim($_POST['topic']);
    $message = trim($_POST['message']);

    // Validate inputs
    if (empty($providerId) || empty($topic) || empty($message)) {
        echo "Invalid input";
        exit;
    }

    // Check if provider exists
    $query = "SELECT provider_id FROM providers WHERE provider_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $providerId);
    $stmt->execute();
    if ($stmt->get_result()->num_rows === 0) {
        echo "Provider does not exist";
        $stmt->close();
        exit;
    }
    $stmt->close();

    // Start transaction
    $conn->begin_transaction();
    try {
        // Create or get existing thread
        $query = "INSERT INTO chat_threads (provider_id, client_id, topic) 
                  VALUES (?, ?, ?) 
                  ON DUPLICATE KEY UPDATE thread_id = LAST_INSERT_ID(thread_id)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iis", $providerId, $clientId, $topic);
        $stmt->execute();
        $threadId = $conn->insert_id;
        $stmt->close();

        // Insert first message
        $query = "INSERT INTO chat_messages (thread_id, sender_id, sender_type, message_text, status) 
                  VALUES (?, ?, 'client', ?, 'unseen')";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iis", $threadId, $clientId, $message);
        $stmt->execute();
        $stmt->close();

        $conn->commit();
        echo "Chat created successfully";
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
} elseif ($action === 'send_message') {
    $threadId = intval($_POST['thread_id']);
    $message = trim($_POST['message']);

    // Validate inputs
    if (empty($threadId) || empty($message)) {
        echo "Invalid input";
        exit;
    }

    // Verify thread belongs to client
    $query = "SELECT thread_id FROM chat_threads WHERE thread_id = ? AND client_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $threadId, $clientId);
    $stmt->execute();
    if ($stmt->get_result()->num_rows === 0) {
        echo "Unauthorized thread";
        $stmt->close();
        exit;
    }
    $stmt->close();

    // Insert message
    $query = "INSERT INTO chat_messages (thread_id, sender_id, sender_type, message_text, status) 
              VALUES (?, ?, 'client', ?, 'unseen')";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iis", $threadId, $clientId, $message);
    $stmt->execute();
    $stmt->close();

    echo "Message sent";
} elseif ($action === 'fetch_messages') {
    $threadId = intval($_POST['thread_id']);

    // Verify thread belongs to client
    $query = "SELECT thread_id FROM chat_threads WHERE thread_id = ? AND client_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $threadId, $clientId);
    $stmt->execute();
    if ($stmt->get_result()->num_rows === 0) {
        echo "Unauthorized thread";
        $stmt->close();
        exit;
    }
    $stmt->close();

    // Fetch messages
    $query = "SELECT message_id, sender_id, sender_type, message_text, sent_at, status 
              FROM chat_messages 
              WHERE thread_id = ? 
              ORDER BY sent_at ASC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $threadId);
    $stmt->execute();
    $result = $stmt->get_result();
    $messages = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    // Update status to seen for provider messages
    $query = "UPDATE chat_messages 
              SET status = 'seen' 
              WHERE thread_id = ? AND sender_type = 'provider' AND status = 'unseen'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $threadId);
    $stmt->execute();
    $stmt->close();

    // Output messages as HTML
    foreach ($messages as $message) {
        $sender = $message['sender_type'] === 'client' ? 'You' : 'Provider';
        $class = $message['sender_type'] === 'client' ? 'sent' : 'received';
        echo "<p class='$class'>$sender: " . htmlspecialchars($message['message_text']) . 
             "<br><small>" . $message['sent_at'] . "</small></p>";
    }
}
?>