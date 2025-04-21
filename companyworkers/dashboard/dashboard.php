<?php
session_start();
include '../../config/config.php'; // Database connection

// Fetch the logged-in user's name
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT full_name FROM companyworkers WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
    $fullName = $user['full_name'] ?? 'User';
} else {
    header("Location: ../../Login/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka Consultancy</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="../sidebar.css">
    <script src="dashboard.js"></script>
</head>
<body>
    <!-- Sidebar Toggle Button (for mobile) -->
    <button class="sidebar-toggle" id="sidebarToggle">
        ☰
    </button>
    
    <!-- Overlay for mobile -->
    <div class="overlay" id="overlay"></div>
    
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <div style="width: 40px; height: 40px; background-color: #4f46e5; display: flex; align-items: center; justify-content: center; color: white; border-radius: 5px; margin-right: 15px;">E</div>
            <span>EDSA Lanka</span>
        </div>
        <div class="sidebar-menu">
            <a href="dashboard.html">
                <div class="menu-item active">
                    <span class="menu-icon">📊</span>
                    <span>Dashboard</span>
                </div>
            </a>
            <a href="../acceptclient/acceptclient.php">
                <div class="menu-item">
                    <span class="menu-icon">👥</span>
                    <span>Accept Clients</span>
                </div>
            </a>
            <a href="../contactforums/contactforum.php">
                <div class="menu-item">
                    <span class="menu-icon">💬</span>
                    <span>Contact Forums</span>
                </div>
            </a>
            <a href="../updateknowlgebase/initial.php">
                <div class="menu-item">
                    <span class="menu-icon">📚</span>
                    <span>Knowledge Base</span>
                </div>
            </a>
            <a href="../updatenews/initial.php">
                <div class="menu-item">
                    <span class="menu-icon">📰</span>
                    <span>Update News</span>
                </div>
            </a>
        </div>
    </div>

    <!-- Header -->
    <header>
        <div class="logo-text">EDSA Lanka Consultancy</div>
        <div class="user-area">
          <p>Dashboard</p>
            <div class="notification">
                🔔
                <span class="notification-count">3</span>
            </div>
            <div class="user-profile">
                <div style="width: 40px; height: 40px; background-color: #64748b; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white;">
                    <?php echo strtoupper(substr($fullName, 0, 1)); ?>
                </div>
                <span><?php echo htmlspecialchars($fullName); ?></span>
            </div>
            <form action="../../Login/Logout.php" method="post" style="display:inline;">
                <button class="logout-btn" type="submit">Logout</button>
            </form>
        </div>
    </header>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Welcome Banner -->
        <div class="welcome-banner">
            <div class="welcome-text">
                <h2>Welcome Back, <?php echo htmlspecialchars($fullName); ?></h2>
                <p>Here's an overview of your dashboard at EDSA Lanka Consultancy</p>
            </div>
        </div>

        <!-- Key Metrics -->
        <h3 class="section-title">Key Metrics</h3>
        <div class="metrics-container">
            <div class="metric-card">
                <div class="metric-header">
                    <div class="metric-icon sr-bg">SR</div>
                    <div>Service Requests</div>
                </div>
                <div class="metric-data">
                    <span class="metric-number">24</span>
                    <span class="metric-change">↑12%</span>
                </div>
                <div class="metric-footer">Last 7 days</div>
            </div>
            <div class="metric-card">
                <div class="metric-header">
                    <div class="metric-icon cf-bg">CF</div>
                    <div>Contact Forums</div>
                </div>
                <div class="metric-data">
                    <span class="metric-number">17</span>
                    <span class="metric-change">↑8%</span>
                </div>
                <div class="metric-footer">Last 7 days</div>
            </div>
            <div class="metric-card">
                <div class="metric-header">
                    <div class="metric-icon nw-bg">NW</div>
                    <div>News</div>
                </div>
                <div class="metric-data">
                    <span class="metric-number">9</span>
                    <span class="metric-change">↑15%</span>
                </div>
                <div class="metric-footer">Last 7 days</div>
            </div>
        </div>

        <!-- Dashboard Grid -->
        <div class="dashboard-grid">
            <!-- Calendar -->
            <div class="dashboard-card">
                <h3 class="section-title">Calendar</h3>
                <div class="calendar-container">
                    <div class="calendar-month" id="calendar-month">April 2025</div>
                    <div class="calendar-grid">
                        <div class="calendar-weekdays">
                            <div>Sun</div>
                            <div>Mon</div>
                            <div>Tue</div>
                            <div>Wed</div>
                            <div>Thu</div>
                            <div>Fri</div>
                            <div>Sat</div>
                        </div>
                        <div class="calendar-days" id="calendar-days"></div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="dashboard-card">
                <h3 class="section-title">Recent Activity</h3>
                <div class="activity-feed">
                    <div class="activity-item">
                        <div class="activity-icon activity-bg-blue">
                            ✓
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">New service request from ABC Corporation</div>
                            <div class="activity-time">2 hours ago</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon activity-bg-green">
                            💬
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">New contact forum submission from John Smith</div>
                            <div class="activity-time">4 hours ago</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon activity-bg-purple">
                            📰
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">New news article published: Industry Updates</div>
                            <div class="activity-time">Yesterday</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initializeCalendar();
            updateDateTime();
            setInterval(updateDateTime, 1000);
        });

        function initializeCalendar() {
            const now = new Date();
            const monthNames = ["January", "February", "March", "April", "May", "June",
                              "July", "August", "September", "October", "November", "December"];
            
            document.getElementById('calendar-month').textContent = `${monthNames[now.getMonth()]} ${now.getFullYear()}`;
            
            const firstDay = new Date(now.getFullYear(), now.getMonth(), 1);
            const lastDay = new Date(now.getFullYear(), now.getMonth() + 1, 0);
            const daysContainer = document.getElementById('calendar-days');
            daysContainer.innerHTML = '';

            // Add empty cells for days before the first of the month
            for (let i = 0; i < firstDay.getDay(); i++) {
                const emptyDay = document.createElement('div');
                emptyDay.className = 'calendar-day empty';
                daysContainer.appendChild(emptyDay);
            }

            // Add days of the month
            for (let i = 1; i <= lastDay.getDate(); i++) {
                const dayElement = document.createElement('div');
                dayElement.className = 'calendar-day';
                if (i === now.getDate()) {
                    dayElement.classList.add('today');
                }
                dayElement.textContent = i;
                daysContainer.appendChild(dayElement);
            }
        }

        function updateDateTime() {
            const now = new Date();
            const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            
            document.getElementById('current-date').textContent = `${days[now.getDay()]}, ${months[now.getMonth()]} ${now.getDate()}, ${now.getFullYear()}`;
            document.getElementById('current-time').textContent = now.toLocaleTimeString();
        }
    </script>
</body>
</html>