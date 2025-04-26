
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
                    <!-- <img src="../images/notification.png" alt="Notifications"> -->
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
            <h1>Forum</h1>
        </div>
        <div class="controls">
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
                            <li data-category="General Discussions">
                                <h4>How to use our service effectively?</h4>
                                <p>Started by <span class="username">User123</span> - 10 replies</p>
                            </li>
                            <li data-category="Technical Support">
                                <h4>Common issues and troubleshooting</h4>
                                <p>Started by <span class="username">SupportTeam</span> - 5 replies</p>
                            </li>
                        </ul>
                    </div>

                    <!-- New Thread Form -->
                    <div class="new-thread">
                        <h3>Create a New Thread</h3>
                        <form>
                            <div class="form-group">
                                <label for="thread-title">Title</label>
                                <input type="text" id="thread-title" placeholder="Enter thread title">
                            </div>
                            <div class="form-group">
                                <label for="thread-category">Category</label>
                                <select id="thread-category">
                                    <option value="General Discussions">General Discussions</option>
                                    <option value="Technical Support">Technical Support</option>
                                    <option value="Product/Service Feedback">Product/Service Feedback</option>
                                    <option value="How-to Guides">How-to Guides</option>
                                    <option value="Off-Topic">Off-Topic</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="thread-message">Message</label>
                                <textarea id="thread-message" rows="5" placeholder="Enter your message"></textarea>
                            </div>
                            <button type="button" onclick="addThread()">Post Thread</button>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    <script src="script.js"></script>
</body>
</html>