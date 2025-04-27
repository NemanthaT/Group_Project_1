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

// Get the selected section from session
$section = isset($_SESSION['knowledgebase_category']) ? $_SESSION['knowledgebase_category'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knowledge Base History | EDSA Lanka Consultancy</title>
    <link rel="stylesheet" href="../dashboard/dashboard.css">
    <link rel="stylesheet" href="../sidebar.css">
    <link rel="stylesheet" href="updateknowlgebase.css">
</head>
<body>
    <!-- Sidebar Toggle Button (for mobile) -->
    <button class="sidebar-toggle" id="sidebarToggle">☰</button>
    
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
                    <button>
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
            </li>
            <li>
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
                    <h2>Knowledge Base History</h2>
                    <p>Manage and track all knowledge base entries</p>
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

            <!-- Knowledge Base Table -->
            <div class="dashboard-grid">
                <div class="dashboard-card" style="grid-column: span 2;">
                    <div class="table-container">
                        <table class="table" id="knowledgeTable">
                            <thead>
                                <tr>
                                    <th class="hidden">Knowledge Base ID</th>
                                    <th class="hidden">Worker ID</th>
                                    <th>Title</th>
                                    <th>Date Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Only show entries for the selected section
                                $sql = "SELECT * FROM knowledgebase";
                                if ($section) {
                                    $sql .= " WHERE section = '" . mysqli_real_escape_string($conn, $section) . "'";
                                }
                                $result = mysqli_query($conn, $sql);
                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<tr data-id="' . $row['id'] . '">
                                            <td class="hidden">' . $row['id'] . '</td>
                                            <td class="hidden">' . $row['worker_id'] . '</td>
                                            <td>' . $row['title'] . '</td>
                                            <td>' . $row['created_at'] . '</td>
                                            <td>
                                                <button class="action-btn update-btn"><a href="update.php?update_id=' . $row['id'] . '&section=' . urlencode($section) . '">Update</a></button>
                                                <button class="action-btn delete-btn delete-row-btn" data-id="' . $row['id'] . '">Delete</button>
                                            </td>
                                        </tr>';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
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

        // AJAX delete functionality
        document.querySelectorAll('.delete-row-btn').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                if (!confirm('Are you sure you want to delete this entry?')) return;
                var row = btn.closest('tr');
                var id = btn.getAttribute('data-id');
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'delete.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        if (xhr.responseText.trim() === 'success') {
                            row.style.display = 'none';
                        } else {
                            alert('Failed to delete entry.');
                        }
                    }
                };
                xhr.send('delete_id=' + encodeURIComponent(id));
            });
        });
    </script>
</body>
</html>