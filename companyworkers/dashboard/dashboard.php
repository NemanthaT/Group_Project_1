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

// AJAX endpoint for metrics by date
if (isset($_GET['fetch_metrics_by_date']) && isset($_GET['date'])) {
    $date = mysqli_real_escape_string($conn, $_GET['date']);
    $appointments_count = 0;
    $news_count = 0;
    $contactforums_count = 0;

    // Appointments (service requests) count
    $q1 = mysqli_query($conn, "SELECT COUNT(*) AS cnt FROM appointments WHERE DATE(appointment_date) = '$date'");
    if ($row = mysqli_fetch_assoc($q1)) $appointments_count = (int)$row['cnt'];

    // News count
    $q2 = mysqli_query($conn, "SELECT COUNT(*) AS cnt FROM news WHERE DATE(created_at) = '$date'");
    if ($row = mysqli_fetch_assoc($q2)) $news_count = (int)$row['cnt'];

    // Contactforms count (fix table name if needed)
    $q3 = mysqli_query($conn, "SELECT COUNT(*) AS cnt FROM contactforms WHERE DATE(created_at) = '$date'");
    if ($row = mysqli_fetch_assoc($q3)) $contactforums_count = (int)$row['cnt'];

    // Debug: Uncomment to see output in browser
    // error_log("Date: $date, Appointments: $appointments_count, News: $news_count, Contactforms: $contactforums_count");

    echo json_encode([
        'appointments' => $appointments_count,
        'news' => $news_count,
        'contactforums' => $contactforums_count
    ]);
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
            <a href="../servicerequest/servicerequest.php">
                <div class="menu-item">
                    <span class="menu-icon">👥</span>
                    <span>Service Request</span>
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
        <div class="metrics-container" id="metrics-container">
            <div class="metric-card">
                <div class="metric-header">
                    <div class="metric-icon sr-bg">SR</div>
                    <div>Service Requests</div>
                </div>
                <div class="metric-data">
                    <span class="metric-number" id="metric-appointments">0</span>
                    <span class="metric-change" id="metric-appointments-change"></span>
                </div>
                <div class="metric-footer" id="metric-appointments-footer">Selected date</div>
            </div>
            <div class="metric-card">
                <div class="metric-header">
                    <div class="metric-icon cf-bg">CF</div>
                    <div>Contact Forums</div>
                </div>
                <div class="metric-data">
                    <span class="metric-number" id="metric-contactforums">0</span>
                    <span class="metric-change" id="metric-contactforums-change"></span>
                </div>
                <div class="metric-footer" id="metric-contactforums-footer">Selected date</div>
            </div>
            <div class="metric-card">
                <div class="metric-header">
                    <div class="metric-icon nw-bg">NW</div>
                    <div>News</div>
                </div>
                <div class="metric-data">
                    <span class="metric-number" id="metric-news">0</span>
                    <span class="metric-change" id="metric-news-change"></span>
                </div>
                <div class="metric-footer" id="metric-news-footer">Selected date</div>
            </div>
        </div>

        <!-- Dashboard Grid -->
        <div class="dashboard-grid">
            <!-- Calendar -->
            <div class="dashboard-card">
                <h3 class="section-title">Calendar</h3>
                <div class="calendar-container">
                    <div style="display:flex;align-items:center;justify-content:space-between;">
                        <button id="calendar-prev" style="background:none;border:none;font-size:1.3rem;cursor:pointer;">&#8592;</button>
                        <div class="calendar-month" id="calendar-month">April 2025</div>
                        <button id="calendar-next" style="background:none;border:none;font-size:1.3rem;cursor:pointer;">&#8594;</button>
                    </div>
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
        // --- Metrics AJAX update ---
        function fetchMetricsByDate(dateStr) {
            // Show loading indicator
            document.getElementById('metric-appointments').textContent = '...';
            document.getElementById('metric-contactforums').textContent = '...';
            document.getElementById('metric-news').textContent = '...';

            fetch('dashboard.php?fetch_metrics_by_date=1&date=' + encodeURIComponent(dateStr))
                .then(res => {
                    if (!res.ok) throw new Error('Network response was not ok');
                    return res.json();
                })
                .then(data => {
                    // Debug: log the data
                    console.log('Metrics for', dateStr, data);

                    document.getElementById('metric-appointments').textContent = data.appointments;
                    document.getElementById('metric-contactforums').textContent = data.contactforums;
                    document.getElementById('metric-news').textContent = data.news;
                    document.getElementById('metric-appointments-change').textContent = '';
                    document.getElementById('metric-contactforums-change').textContent = '';
                    document.getElementById('metric-news-change').textContent = '';
                    document.getElementById('metric-appointments-footer').textContent = 'Selected date: ' + dateStr;
                    document.getElementById('metric-contactforums-footer').textContent = 'Selected date: ' + dateStr;
                    document.getElementById('metric-news-footer').textContent = 'Selected date: ' + dateStr;
                })
                .catch(err => {
                    // Debug: log the error
                    console.error('Error fetching metrics:', err);
                    document.getElementById('metric-appointments').textContent = '!';
                    document.getElementById('metric-contactforums').textContent = '!';
                    document.getElementById('metric-news').textContent = '!';
                });
        }

        // --- Calendar navigation and rendering for all months/years ---
        let calendarYear, calendarMonth;
        let selectedDayElement = null;
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date();
            calendarYear = today.getFullYear();
            calendarMonth = today.getMonth();
            renderCalendar(calendarYear, calendarMonth);

            // Fetch metrics for today on load
            fetchMetricsByDate(today.toISOString().slice(0,10));

            document.getElementById('calendar-prev').onclick = function() {
                calendarMonth--;
                if (calendarMonth < 0) {
                    calendarMonth = 11;
                    calendarYear--;
                }
                renderCalendar(calendarYear, calendarMonth);
            };
            document.getElementById('calendar-next').onclick = function() {
                calendarMonth++;
                if (calendarMonth > 11) {
                    calendarMonth = 0;
                    calendarYear++;
                }
                renderCalendar(calendarYear, calendarMonth);
            };
        });

        function renderCalendar(year, month) {
            const monthNames = ["January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"];
            document.getElementById('calendar-month').textContent = `${monthNames[month]} ${year}`;
            const firstDay = new Date(year, month, 1);
            const lastDay = new Date(year, month + 1, 0);
            const daysContainer = document.getElementById('calendar-days');
            daysContainer.innerHTML = '';

            // Add empty cells for days before the first of the month
            for (let i = 0; i < firstDay.getDay(); i++) {
                const emptyDay = document.createElement('div');
                emptyDay.className = 'calendar-day empty';
                daysContainer.appendChild(emptyDay);
            }

            // Add days of the month
            const today = new Date();
            for (let i = 1; i <= lastDay.getDate(); i++) {
                const dayElement = document.createElement('div');
                dayElement.className = 'calendar-day';
                if (
                    year === today.getFullYear() &&
                    month === today.getMonth() &&
                    i === today.getDate()
                ) {
                    dayElement.classList.add('today');
                }
                dayElement.textContent = i;
                dayElement.tabIndex = 0; // Make focusable for accessibility

                // Add click event to fetch metrics for this date and highlight selection
                dayElement.onclick = function() {
                    // Remove previous selection
                    if (selectedDayElement) {
                        selectedDayElement.classList.remove('selected');
                    }
                    dayElement.classList.add('selected');
                    selectedDayElement = dayElement;

                    const mm = (month+1).toString().padStart(2,'0');
                    const dd = i.toString().padStart(2,'0');
                    const dateStr = `${year}-${mm}-${dd}`;
                    // Debug: log the selected date
                    console.log('Selected date:', dateStr);
                    fetchMetricsByDate(dateStr);
                };

                daysContainer.appendChild(dayElement);
            }

            // Clear selection highlight when month changes
            selectedDayElement = null;
        }

        function updateDateTime() {
            const now = new Date();
            const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            
            document.getElementById('current-date').textContent = `${days[now.getDay()]}, ${months[now.getMonth()]} ${now.getDate()}, ${now.getFullYear()}`;
            document.getElementById('current-time').textContent = now.toLocaleTimeString();
        }
    </script>
    <style>
        /* Add this style for selected calendar day */
        .calendar-day.selected {
            background-color: #10b981 !important;
            color: #fff !important;
            font-weight: bold;
        }
    </style>
</body>
</html>