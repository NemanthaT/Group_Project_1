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
                        <a href="../SP_Profile/Profile.html"><img src="../images/user.png" alt="Profile"></a>
                    </div>
                    <a href="../../Login/Logout.php" class="logout">Logout</a>
                </nav>
            </header>

            <!-- Main Content (Forum Page) -->
            <div class="main-content">
                <div class="forum-section">
                    <h2>Forum</h2>

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
    </div>

    <script src="Forum.js"></script>
</body>
</html>