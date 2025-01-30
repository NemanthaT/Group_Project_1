
<?php
include '../session/session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka - Appointment Management</title>
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
                        <button >
                            <img src="../images/dashboard.png" alt="Dashboard">
                            Dashboard
                        </button>
                    </a>
                </li>
                <li>
                    <a href="../appointments/appointment.php">
                        <button >
                            <img src="../images/appointment.png" alt="Appointment">
                            Appointment
                        </button>
                    </a>
                    </li>
                <li>
                    <a href="../Project/project.php">
                        <button >
                            <img src="../images/project.png" alt="project">
                            Projects
                        </button>
                    </a>
                </li>
                <li>
                    <a href="../bill/bill.php">
                        <button >
                        <img src="../images/bill.png" alt="Bill">
                        Bill
                        </button>
                    </a>
                </li>
                <li>
                    <a href="../forum/forum.php">
                    <button class="active">
                        <img src="../images/forum.png" alt="Forum">
                        Forum
                    </button>
                    </a>
                </li>
                <li><a href="../Message/Message.php">
                    <button>
                        <img src="../images/Message.png" alt="Message">
                        Message
                    </button></a>
                </li>
                <!-- <li>
                    <a href="../reports/reports.php">
                        <button >
                            <img src="../images/reports.png" alt="Reports">
                            Reports
                        </button>
                    </a>
                </li> --> 
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

    <div class=".main-container">
        <div class="space"></div>

        <div class="controls card1">
            <h1>Message</h1>            
        </div>

        <div class="message-section">
    <h2>Message</h2>
    <div class="message-controls">
        <input type="text" placeholder="Provider ID/Topic">
        <button class="search-button">Search</button>
        <button class="create-chat-button">Create Chat</button>
    </div>

    <!-- Create Chat Modal -->
    <div id="create-chat-modal" class="modal">
    <div class="modal-content">
        <button class="close-create-chat-modal" title="Close">&times;</button>
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
                <th>Provider ID</th>
                <th>Topic</th>
                <th>Message</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="message-tbody">
            <!-- Rows will be added dynamically -->
        </tbody>
    </table>
</div>

<!-- Chat Modal -->
<div id="chat-modal" class="modal">
    <div class="modal-content">
        <button class="close-chat-modal" title="Close">&times;</button>
        <h3>Chat with Provider</h3>
        <div class="chat-window" id="chat-window">
            <!-- Chat messages will be displayed here -->
        </div>
        <div class="chat-input-section">
            <textarea id="chat-input" placeholder="Type your message..."></textarea>
            <button id="send-chat" class="send-chat">Send</button>
        </div>
    </div>
</div>

    <script src="script.js"></script>
</body>
</html>