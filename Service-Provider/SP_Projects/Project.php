<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka Consultancy</title>
    <link rel="stylesheet" href="Project.css">
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
                        <a href="#">Home</a>
                    <div class="notification">   
                        <a href="#"><img src="../images/notification.png" alt="Notifications"></a>
                    </div> 
                    <div class="profile">
                        <a href="#"><img src="../images/user.png" alt="Profile"></a>
                    </div>
                    <a href="../../Login/Logout.php" class="logout">Logout</a>
                </nav>
            </header>

            <!-- Main Content -->
            <div class="main-content">
            <div class="main-container">
            <div class="space"></div>

            <div class="controls card1">
                <h1>Project Management</h1>
            </div>

            <!-- Project Assignment Section -->
            <div class="controls">
                <h2>Assign New Project</h2>
                <form class="project-assignment-form" action="process_project_assignment.php" method="POST">
                    <div class="form-group">
                        <label for="project-name">Project Name</label>
                        <input type="text" id="project-name" name="project-name" required>
                    </div>

                    <div class="form-group">
                        <label for="client-name">Client Name</label>
                        <input type="text" id="client-name" name="client-name" required>
                    </div>

                    <div class="form-group">
                        <label for="service-provider">Service Provider</label>
                        <select id="service-provider" name="service-provider" required>
                            <option value="">Select Service Provider</option>
                            <option value="rama-crish">Rama Crish</option>
                            <option value="john-doe">John Doe</option>
                            <option value="jane-smith">Jane Smith</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="project-start-date">Project Start Date</label>
                        <input type="date" id="project-start-date" name="project-start-date" required>
                    </div>

                    <div class="form-group">
                        <label for="project-status">Project Status</label>
                        <select id="project-status" name="project-status" required>
                            <option value="ongoing">Ongoing</option>
                            <option value="planning">Planning</option>
                            <option value="completed">Completed</option>
                            <option value="paused">Paused</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="project-description">Project Description</label>
                        <textarea id="project-description" name="project-description" rows="4" required></textarea>
                    </div>

                    <button type="submit" class="pay-button">Assign Project</button>
                </form>
            </div>

            <!-- Existing Projects Section -->
            <div class="controls">
                <h2>Existing Projects</h2>
                <div class="project-grid">
                    <!-- Project Card Template -->
                    <div class="project-card">
                        <div class="project-header">
                            <span class="project-id">P001</span>
                            <span class="status green">Ongoing</span>
                        </div>
                        <div class="project-content">
                            <div class="project-info">
                                <h2><strong>Financial Consultancy</strong></h2>
                                <p>Specialized service for financial decision-making and strategy.</p>
                            </div>
                            <a href="project-details.php?id=P001">
                                <button class="pay-button">Manage</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </div>
            </div>
            </div>
    <script src="#"></script>
</body>
</html>
