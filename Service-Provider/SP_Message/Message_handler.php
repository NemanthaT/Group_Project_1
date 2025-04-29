<?php
include '../Session/Session.php';
include '../connection.php';

if (!isset($_SESSION['provider_id'])) {
    echo "Unauthorized";
    exit;
}

$providerId = $_SESSION['provider_id'];
$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($action === 'create_chat') {
    $clientId = intval($_POST['client_id']);
    $topic = trim($_POST['topic']);
    $message = trim($_POST['message']);

    if (empty($clientId) || empty($topic) || empty($message)) {
        echo "Invalid input";
        exit;
    }

    $query = "SELECT client_id FROM clients WHERE client_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $clientId);
    $stmt->execute();
    if ($stmt->get_result()->num_rows === 0) {
        echo "Client does not exist";
        $stmt->close();
        exit;
    }
    $stmt->close();

    $query = "SELECT thread_id FROM chat_threads WHERE provider_id = ? AND client_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $providerId, $clientId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "Chat thread already exists for this client";
        $stmt->close();
        exit;
    }
    $stmt->close();

    $conn->begin_transaction();
    try {
        $query = "INSERT INTO chat_threads (provider_id, client_id, topic) 
                  VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iis", $providerId, $clientId, $topic);
        $stmt->execute();
        $threadId = $conn->insert_id;
        $stmt->close();

        $query = "INSERT INTO chat_messages (thread_id, sender_id, sender_type, message_text, status) 
                  VALUES (?, ?, 'provider', ?, 'unseen')";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iis", $threadId, $providerId, $message);
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

    if (empty($threadId) || empty($message)) {
        echo "Invalid input";
        exit;
    }

    $query = "SELECT thread_id FROM chat_threads WHERE thread_id = ? AND provider_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $threadId, $providerId);
    $stmt->execute();
    if ($stmt->get_result()->num_rows === 0) {
        echo "Unauthorized thread";
        $stmt->close();
        exit;
    }
    $stmt->close();

    $query = "INSERT INTO chat_messages (thread_id, sender_id, sender_type, message_text, status) 
              VALUES (?, ?, 'provider', ?, 'unseen')";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iis", $threadId, $providerId, $message);
    $stmt->execute();
    $stmt->close();

    echo "Message sent";
} elseif ($action === 'fetch_messages') {
    $threadId = intval($_POST['thread_id']);

    $query = "SELECT thread_id FROM chat_threads WHERE thread_id = ? AND provider_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $threadId, $providerId);
    $stmt->execute();
    if ($stmt->get_result()->num_rows === 0) {
        echo "Unauthorized thread";
        $stmt->close();
        exit;
    }
    $stmt->close();

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

    $query = "UPDATE chat_messages 
              SET status = 'seen' 
              WHERE thread_id = ? AND sender_type = 'client' AND status = 'unseen'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $threadId);
    $stmt->execute();
    $stmt->close();

    foreach ($messages as $message) {
        $sender = $message['sender_type'] === 'provider' ? 'You' : 'Client';
        $class = $message['sender_type'] === 'provider' ? 'sent' : 'received';
        echo "<p class='$class'>$sender: " . htmlspecialchars($message['message_text']) . 
             "<br><small>" . $message['sent_at'] . "</small></p>";
    }
} elseif ($action === 'fetch_threads') {
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

    foreach ($threads as $thread) {
        $lastMessage = htmlspecialchars($thread['last_message'] ?? 'No messages yet');
        $status = htmlspecialchars($thread['status'] ?? 'Unseen');
        echo "<tr>" .
             "<td>" . htmlspecialchars($thread['full_name']) . "</td>" .
             "<td>" . htmlspecialchars($thread['topic']) . "</td>" .
             "<td>" . $lastMessage . "</td>" .
             "<td>" . $status . "</td>" .
             "<td><button class=\"chat-button\" data-thread-id=\"" . $thread['thread_id'] . "\" data-client-id=\"" . $thread['client_id'] . "\" data-client-name=\"" . htmlspecialchars($thread['full_name']) . "\">Chat</button></td>" .
             "</tr>";
    }
}
?>