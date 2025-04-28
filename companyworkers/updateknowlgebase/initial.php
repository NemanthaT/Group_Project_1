<?php
session_start();
include '../../config/config.php';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../../Login/login.php");
    exit;
}

// Get user details
$username = $_SESSION['username'];
$query = "SELECT full_name FROM companyworkers WHERE username = '" . mysqli_real_escape_string($conn, $username) . "'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
$fullName = $user['full_name'] ?? 'User';

if (!isset($_SESSION['username'])) {
    header("Location: ../../Login/Login.php");
    exit;
}

// Handle category selection and store in session
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['category'])) {
    $_SESSION['knowledgebase_category'] = $_POST['category'];
    header("Location: initialnew.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knowledge Base | EDSA Lanka Consultancy</title>
    <link rel="stylesheet" href="../dashboard/dashboard.css">
    <link rel="stylesheet" href="../sidebar.css">
    <link rel="stylesheet" href="updateknowlgebase.css">
</head>
    <!-- Sidebar Toggle Button (for mobile) -->
    <button class="sidebar-toggle" id="sidebarToggle">
        ☰
    </button>
    
    <!-- Overlay for mobile -->
    <div class="overlay" id="overlay"></div>
    
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <img src="../images/logo.png" alt="EDSA Lanka Consultancy Logo">
            </div>
            
            <ul class="menu">
                <li>
                    <a href="../Dashboard/Dashboard.php">
                        <button >
                        <span class="menu-icon">📊</span>
                            Dashboard
                        </button>
                    </a>
                </li>
                <li>
                    <a href="../servicerequest/servicerequest.php">
                        <button >
                        <span class="menu-icon">🔧</span>
                            Service Requests
                        </button>
                    </a>
                    </li>
                <li>
                    <a href="../acceptclient/acceptclient.php">
                        <button >
                        <span class="menu-icon">👥</span>
                            Client Accept
                        </button>
                    </a>
                </li>                <li>
                    <a href="../contactforums/contactforum.php">
                        <button >
                        <span class="menu-icon">💬</span>
                        Contact Forum
                        </button>
                    </a>
                </li>
                <li>
                    <a href="../updateknowlgebase/initial.php">
                    <button class="active">
                    <span class="menu-icon">📚</span>
                    Update Knowldgebase
                    </button>
                    </a>
                </li>
                <li><a href="../updatenews/initial.php">
                    <button>
                    <span class="menu-icon">📰</span>
                    Update News
                    </button></a>
                </li>
                <li><a href="../serviceproviders/view.php">
                    <button >
                    <span class="menu-icon">🛠️</span>
                    Service Providers
                    </button></a>
                </li>
            </ul>
        </div>

    <!-- Header -->
    <div class="main-wrapper">
            <!-- Navbar -->
            <div class="navbar">
                <div class="profile">
                <a href="../myaccount/acc.php">
                <img src="../images/user.png" alt="Profile">
                    </a>
                </div>
                <a href="../../Login/Logout.php" class="logout">Logout</a>
            </div>
        

    <div class=".main-container">
        <div class="space"></div>

        <div class="controls card1">
        <div class="welcome-banner">
            <div class="welcome-text">
                <h2>Knowledge Base Management</h2>
                <p>Select a category to manage knowledge base content</p>
            </div>
                <div class="date-time" style="text-align:right;">
                <div id="currentDate"></div>
                <div id="currentTime"></div>
            </div>
        </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Welcome Banner -->

        <!-- Hidden form for category selection -->
        <form id="categoryForm" method="POST" style="display:none;">
            <input type="hidden" name="category" id="categoryInput" value="">
        </form>

        <!-- Knowledge Base Categories -->
        <div class="dashboard-grid">
            <div class="dashboard-card">
                <h3 class="section-title">Training Resources</h3>
                <a href="javascript:void(0);" class="category-link" onclick="selectCategory('training')">
                    <div class="category-card">
                        <div class="category-icon">📚</div>
                        <div class="category-details">
                            <h4>Training Materials</h4>
                            <p>Manage training documents and resources</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="dashboard-card">
                <h3 class="section-title">Consulting Resources</h3>
                <a href="javascript:void(0);" class="category-link" onclick="selectCategory('consultant')">
                    <div class="category-card">
                        <div class="category-icon">💼</div>
                        <div class="category-details">
                            <h4>Consulting Materials</h4>
                            <p>Manage consulting documents and guides</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    </div>
    <script>
        // Mobile sidebar toggle
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('overlay').style.display = 
                document.getElementById('overlay').style.display === 'block' ? 'none' : 'block';
        });

        document.getElementById('overlay').addEventListener('click', function() {
            document.getElementById('sidebar').classList.remove('active');
            this.style.display = 'none';
        });

        function selectCategory(category) {
            document.getElementById('categoryInput').value = category;
            document.getElementById('categoryForm').submit();
        }
    </script>
</body>
</html>
