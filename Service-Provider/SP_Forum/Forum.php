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
    <form>
        <label for="newThreadTitle">Title:</label>
        <input type="text" id="newThreadTitle" class="input-field" placeholder="Enter thread title">

        <label for="newThreadCategory">Category:</label>
        <select id="newThreadCategory" class="input-field">
            <option value="General Discussions">General Discussions</option>
            <option value="Technical Support">Technical Support</option>
            <option value="Product/Service Feedback">Product/Service Feedback</option>
            <option value="How-to Guides">How-to Guides</option>
            <option value="Off-Topic">Off-Topic</option>
        </select>

        <label for="newThreadMessage">Message:</label>
        <textarea id="newThreadMessage" class="input-field" rows="5" placeholder="Enter your message"></textarea>

        <button type="button" onclick="submitNewThread()" class="submit-btn">Create</button>
        <button type="button" onclick="closeCreateThreadModal()" class="cancel-btn">Cancel</button>
    </form>
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
                            <li data-category="General Discussions" id="thread-1">
                                <h4>How to use our service effectively?</h4>
                                <p>Started by <span class="username">User123</span> - 10 replies</p>
                                <div class="button-container">
                <button class="view-btn" onclick="viewThread('How to use our service effectively?', 'This is a detailed description of the thread content.', 123, 10)">View</button>
                <!-- <button class="reply-btn" onclick="deleteThread('thread-1')">Reply</button> -->
                <button class="delete-btn" onclick="deleteThread('thread-1')">Delete</button>
            </div>
                            </li>
                            <li data-category="Technical Support" id="thread-2">
            <h4>Common issues and troubleshooting</h4>
            <p>Started by <span class="username">SupportTeam</span> - 5 replies</p>
            <button class="view-btn" onclick="viewThread('Common issues and troubleshooting', 'This thread discusses common troubleshooting steps.', 98, 5)">View</button>
            <button class="delete-btn" onclick="deleteThread('thread-2')">Delete</button>
        </li>
        <li data-category="Product/Service Feedback" id="thread-3">
            <h4>Feedback on our new feature</h4>
            <p>Started by <span class="username">User456</span> - 2 replies</p>
            <button class="view-btn" onclick="viewThread('Feedback on our new feature', 'Share your thoughts on our latest update.', 55, 2)">View</button>
            <button class="delete-btn" onclick="deleteThread('thread-3')">Delete</button>
        </li>
        <li data-category="How-to Guides" id="thread-4">
            <h4>Step-by-step guide for account setup</h4>
            <p>Started by <span class="username">Admin</span> - 8 replies</p>
            <button class="view-btn" onclick="viewThread('Step-by-step guide for account setup', 'A detailed guide to help you set up your account.', 200, 8)">View</button>
            <button class="delete-btn" onclick="deleteThread('thread-4')">Delete</button>
        </li>
        <li data-category="Off-Topic" id="thread-5">
            <h4>Weekend plans discussion</h4>
            <p>Started by <span class="username">User789</span> - 15 replies</p>
            <button class="view-btn" onclick="viewThread('Weekend plans discussion', 'Share your weekend plans!', 80, 15)">View</button>
            <button class="delete-btn" onclick="deleteThread('thread-5')">Delete</button>
        </li>
        <li data-category="Technical Support" id="thread-6">
            <h4>Issue with file uploads</h4>
            <p>Started by <span class="username">User321</span> - 3 replies</p>
            <button class="view-btn" onclick="viewThread('Issue with file uploads', 'Discuss problems related to uploading files.', 45, 3)">View</button>
            <button class="delete-btn" onclick="deleteThread('thread-6')">Delete</button>
        </li>
        <li data-category="General Discussions" id="thread-7">
            <h4>Tips for using the platform effectively</h4>
            <p>Started by <span class="username">User654</span> - 12 replies</p>
            <button class="view-btn" onclick="viewThread('Tips for using the platform effectively', 'Share your best practices for our platform.', 112, 12)">View</button>
            <button class="delete-btn" onclick="deleteThread('thread-7')">Delete</button>
        </li>
                        </ul>
                    </div>

<!-- Modal for Viewing Thread -->
<div class="modal-overlay" id="modalOverlay" style="display: none;"></div>
<div class="modal view-thread-modal" id="modalForm" style="display: none;">
    <h3>View Thread</h3>
    <form>
        <label for="modalTitle">Title:</label>
        <input type="text" id="modalTitle" class="input-field" readonly>

        <label for="modalContent">Content:</label>
        <textarea id="modalContent" class="input-field" rows="5" readonly></textarea>

        <label for="modalViews">Number of Views:</label>
        <input type="text" id="modalViews" class="input-field" readonly>

        <label for="modalReplies">Number of Replies:</label>
        <input type="text" id="modalReplies" class="input-field" readonly>

        <button type="button" onclick="closeModal()" class="close-btn">Close</button>
    </form>
</div>
                </div>
            </div>
        </div>
    </div>

    <script src="Forum.js"></script>
</body>
</html>
