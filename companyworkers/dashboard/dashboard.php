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

// Helper for relative time
function timeAgo($datetime) {
    $timestamp = strtotime($datetime);
    $diff = time() - $timestamp;
    if ($diff < 60) return $diff . " seconds ago";
    if ($diff < 3600) return floor($diff/60) . " minutes ago";
    if ($diff < 86400) return floor($diff/3600) . " hours ago";
    return date("Y-m-d", $timestamp);
}

// Function to render recent activity HTML
function renderRecentActivity($conn) {
    $recent_appointments = [];
    $res1 = mysqli_query($conn, "SELECT message, appointment_date, created_at FROM appointments WHERE message IS NOT NULL AND message != '' ORDER BY created_at DESC LIMIT 10");
    while ($row = mysqli_fetch_assoc($res1)) {
        $recent_appointments[] = [
            'type' => 'Service Request',
            'icon' => '📊',
            'message' => $row['message'],
            'time' => $row['created_at']
        ];
    }

    $recent_contactforms = [];
    $res2 = mysqli_query($conn, "SELECT reason, created_at FROM contactforums WHERE reason IS NOT NULL AND reason != '' ORDER BY created_at DESC LIMIT 10");
    while ($row = mysqli_fetch_assoc($res2)) {
        $recent_contactforms[] = [
            'type' => 'Contact Forum',
            'icon' => '💬',
            'message' => $row['reason'],
            'time' => $row['created_at']
        ];
    }

    $recent_clients = [];
    $res3 = mysqli_query($conn, "SELECT full_name, email, created_at FROM clients WHERE status = 'set' ORDER BY created_at DESC LIMIT 10");
    while ($row = mysqli_fetch_assoc($res3)) {
        $recent_clients[] = [
            'type' => 'Accepted Client',
            'icon' => '🧑‍💼',
            'message' => $row['full_name'] . ' (' . $row['email'] . ')',
            'time' => $row['created_at']
        ];
    }

    $recent_cf_replies = [];
    $res4 = mysqli_query($conn, "SHOW COLUMNS FROM contactforum_replies LIKE 'message'");
    if (mysqli_num_rows($res4) > 0) {
        $res4data = mysqli_query($conn, "SELECT message, created_at FROM contactforum_replies WHERE message IS NOT NULL AND message != '' ORDER BY created_at DESC LIMIT 10");
        while ($row = mysqli_fetch_assoc($res4data)) {
            $recent_cf_replies[] = [
                'type' => 'Contact Forum Reply',
                'icon' => '✉️',
                'message' => $row['message'],
                'time' => $row['created_at']
            ];
        }
    }

    $recent = array_merge($recent_appointments, $recent_contactforms, $recent_clients, $recent_cf_replies);
    usort($recent, function($a, $b) {
        return strtotime($b['time']) - strtotime($a['time']);
    });
    $recent = array_slice($recent, 0, 8);

    foreach ($recent as $item) {
        $colorClass = 'activity-bg-blue';
        if ($item['type'] === 'Contact Forum' || $item['type'] === 'Contact Forum Reply') {
            $colorClass = 'activity-bg-green';
        } elseif ($item['type'] === 'Accepted Client') {
            $colorClass = 'activity-bg-purple';
        }
        ?>
        <div class="activity-item">
            <div class="activity-icon <?php echo $colorClass; ?>">
                <?php echo $item['icon']; ?>
            </div>
            <div class="activity-content">
                <div class="activity-title"><?php echo htmlspecialchars($item['type']); ?>: <?php echo htmlspecialchars($item['message']); ?></div>
                <div class="activity-time"><?php echo timeAgo($item['time']); ?></div>
            </div>
        </div>
        <?php
    }
}

// AJAX endpoint for metrics by date
if (isset($_GET['fetch_metrics_by_date']) && isset($_GET['date'])) {
    $date = mysqli_real_escape_string($conn, $_GET['date']);
    $appointments_count = 0;
    $accepted_clients_count = 0;
    $contactforums_count = 0;

    // Appointments (service requests) count - use created_at instead of appointment_date
    $q1 = mysqli_query($conn, "SELECT COUNT(*) AS cnt FROM appointments WHERE DATE(created_at) = '$date'");
    if ($row = mysqli_fetch_assoc($q1)) $appointments_count = (int)$row['cnt'];

    // Accepted clients count (clients created on this date and status is 'set')
    $q2 = mysqli_query($conn, "SELECT COUNT(*) AS cnt FROM clients WHERE DATE(created_at) = '$date' AND status = 'set'");
    if ($row = mysqli_fetch_assoc($q2)) $accepted_clients_count = (int)$row['cnt'];

    // Contactforums count
    $q3 = mysqli_query($conn, "SELECT COUNT(*) AS cnt FROM contactforums WHERE DATE(created_at) = '$date'");
    if ($row = mysqli_fetch_assoc($q3)) $contactforums_count = (int)$row['cnt'];

    echo json_encode([
        'appointments' => $appointments_count,
        'accepted_clients' => $accepted_clients_count,
        'contactforums' => $contactforums_count
    ]);
    exit;
}

// AJAX endpoint for recent activity
if (isset($_GET['fetch_recent_activity'])) {
    ob_start();
    renderRecentActivity($conn);
    $html = ob_get_clean();
    echo $html;
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
    <div class="sidebar">
        <div class="logo">
            <img src="../images/logo.png" alt="EDSA Lanka Consultancy Logo">
            </div>
            
            <ul class="menu">
                <li>
                    <a href="../Dashboard/Dashboard.php">
                        <button class="active">
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
                    <button>
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
                    <button>
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
                <h2>Welcome Back, <?php echo htmlspecialchars($fullName); ?></h2>
                <p>Here's an overview of your dashboard at EDSA Lanka Consultancy</p>
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
            <a href="../contactforums/contactforum.php" style="text-decoration:none;color:black;">
                <div class="metric-header">
                    <div class="metric-icon cf-bg">CF</div>
                    <div>Contact Forums</div>
                </div>
                <div class="metric-data">
                    <span class="metric-number" id="metric-contactforums">0</span>
                    <span class="metric-change" id="metric-contactforums-change"></span>
                </div>
                <div class="metric-footer" id="metric-contactforums-footer">Selected date</div>
            </a>
            </div>
            <div class="metric-card">
                <div class="metric-header">
                    <div class="metric-icon nw-bg">AC</div>
                    <div>Accepted Clients</div>
                </div>
                <div class="metric-data">
                    <span class="metric-number" id="metric-acceptedclients">0</span>
                    <span class="metric-change" id="metric-acceptedclients-change"></span>
                </div>
                <div class="metric-footer" id="metric-acceptedclients-footer">Selected date</div>
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
                <h3 class="section-title">Notifications</h3>
                <div class="activity-feed">
                    <?php renderRecentActivity($conn); ?>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
</html>