<?php
include '../Session/Session.php';
include '../connection.php';
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
                <li><a href="../Message/Message.php"><button><img src="../images/message.png">Message</button></a></li>
                <li><a href="../SP_Projects/Project.php"><button><img src="../images/project.png">Project</button></a></li>
                <li><a href="../SP_Bill/Bill.php"><button><img src="../images/bill.png">Bill</button></a></li>
                <li><a href="../SP_Forum/Forum.php"><button><img src="../images/forum.png">Forum</button></a></li>
                <li><a href="../SP_KnowledgeBase/KB.php"><button><img src="../images/knowledgebase.png">KnowledgeBase</button></a></li>
            </ul>
        </div>

        <!-- Main Content Wrapper -->
        <div class="main-wrapper">
            <!-- Navbar -->
            <header>
                <nav class="navbar">       
                        <a href="../Home/Homepage/HP.html">Home</a>
                    <div class="notification">   
                        <a href="#"><img src="../images/notification.png" alt="Notifications"></a>
                    </div> 
                    <div class="profile">
                        <a href="../SP_Profile/Profile.html"><img src="../images/user.png" alt="Profile"></a>
                    </div>
                    <a href="../../Login/Logout.php" class="logout">Logout</a>
                </nav>
            </header>

            <!-- Main Content (Message Table) -->
        <div class="main-content">
        <div class="message-section">
    <h2>Message</h2>
    <div class="message-controls">
        <input type="text" placeholder="Provider ID/Topic">
        <button class="search-button">Search</button>
    </div>
    
    <table class="message-table">
        <thead>
            <tr>
                <th>Client ID</th>
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
        <h3>Chat with Client</h3>
        <div class="chat-window" id="chat-window">
            <!-- Chat messages will be displayed here -->
        </div>
        <div class="chat-input-section">
            <textarea id="chat-input" placeholder="Type your message..."></textarea>
            <button id="send-chat" class="send-chat">Send</button>
        </div>
    </div>
</div>

    <script src="Message.js"></script>
</body>
</html>