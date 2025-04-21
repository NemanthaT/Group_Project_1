<?php
include '../Session/Session.php';
include '../connection.php';

// Check if provider is logged in
if (!isset($_SESSION['provider_id'])) {
    echo "Unauthorized. Please log in.";
    exit;
}

$providerId = $_SESSION['provider_id'];

// Fetch chat threads for the provider
$query = "SELECT t.thread_id, t.client_id, t.topic, 
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
    <link rel="stylesheet" href="Message.css">
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
                <li><a href="Message.php"><button><img src="../images/message.png">Message</button></a></li>
                <li><a href="../SP_Projects/Project.php"><button><img src="../images/project.png">Project</button></a></li>
                <li><a href="../SP_Bill/Bill.php"><button><img src="../images/bill.png">Bill</button></a></li>
                <li><a href="../SP_Forum/Forum.php"><button><img src="../images/forum.png">Forum</button></a></li>
                <li><a href="../SP_KnowledgeBase/KB.php"><button><img src="../images/knowledgebase.png">KnowledgeBase</button></a></li>
            </ul>
        </div>

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

        <!-- Main Content (Message Table) -->
        <div class="main-content">
            <div class="message-section">
                <h2>Message</h2>
                <div class="message-controls">
                    <input type="text" placeholder="Client ID/Topic" id="search-input">
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
                            <th>Client ID</th>
                            <th>Topic</th>
                            <th>Last Message</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="message-tbody">
                        <?php foreach ($threads as $thread): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($thread['client_id']); ?></td>
                                <td><?php echo htmlspecialchars($thread['topic']); ?></td>
                                <td><?php echo htmlspecialchars($thread['last_message'] ?? 'No messages yet'); ?></td>
                                <td><?php echo htmlspecialchars($thread['status'] ?? 'Unseen'); ?></td>
                                <td><button class="chat-button" data-thread-id="<?php echo $thread['thread_id']; ?>" data-client-id="<?php echo $thread['client_id']; ?>">Chat</button></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Chat Modal -->
            <div id="chat-modal" class="modal">
                <div class="modal-content">
                    <button class="close-chat-modal" title="Close">×</button>
                    <h3>Chat with Client <span id="chat-client-id"></span></h3>
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
</body>
</html>