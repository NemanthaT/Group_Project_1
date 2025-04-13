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
  <title>Dashboard | EDSA Lanka Consultancy</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../sidebar.css">
  <link rel="stylesheet" href="dashboard.css">
  <style>
    /* Add this style block to make the content black */
    .main-header, .sidebar {
      color: black;
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Updated Header -->
    <header class="main-header">
      <div class="logo-section">
        <img src="../images/logo.png" alt="EDSA Lanka Logo">
        <h1>EDSA Lanka Consultancy</h1>
      </div>
      <div class="header-right">
        <img src="../images/notification.png" alt="Notifications" class="notification-icon">
        <img src="../images/user.png" alt="Profile" class="profile-icon">
        <a href="../../Login/Logout.php" class="logout-btn">Logout</a>
      </div>
    </header>

    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="logo">
        <img src="../images/logo.png" alt="EDSA Lanka Logo">
      </div>
      <ul class="menu">
        <li>
          <a href="../dashboard/dashboard.php">
            <button class="active">
              <img src="../images/dashboard.png" alt="Dashboard">
              Dashboard
            </button>
          </a>
        </li>
        <li>
          <a href="../servicerequest/servicerequest.php">
            <button>
              <img src="../images/service.jpg" alt="Service Requests">
              Service Requests
            </button>
          </a>
        </li>
        <li>
          <a href="../contactforums/contactforum.html">
            <button>
              <img src="../images/contact forms.jpg" alt="Contact Forums">
              Contact Forums
            </button>
          </a>
        </li>
        <li>
          <a href="../updateevents/updateevents.php">
            <button>
              <img src="../images/events.jpg" alt="Update Events">
              Update Events
            </button>
          </a>
        </li>
        <li>
          <a href="../updateknowlgebase/initial.php">
            <button>
              <img src="../images/knowlegdebase.jpg" alt="Knowledge Base">
              Knowledge Base
            </button>
          </a>
        </li>
        <li>
          <a href="../updatenews/initial.php">
            <button>
              <img src="../images/news.jpg" alt="Update News">
              Update News
            </button>
          </a>
        </li>
      </ul>
    </aside>

    <!-- Main Content Area -->
    <div class="main-wrapper">
      <div class="main-container">

        <div class="controls card1">
          <h1>Welcome To EDSA Lanka</h1>
          <h3>Welcome Back, <?php echo htmlspecialchars($fullName); ?>!</h3>
        </div>

        <!-- Dashboard Content -->
        <section class="dashboard-container">
          <!-- Quick Stats -->
          <div class="stats-grid">
            <div class="stat-card service-requests">
              <div class="card-icon">
                <i class="fas fa-concierge-bell"></i>
              </div>
              <div class="card-content">
                <h3>Service Requests</h3>
                <p id="dateDisplay2" class="card-date"></p>
                <div class="counter-display">
                  <div id="counter2_digit1" class="digit">0</div>
                  <div id="counter2_digit2" class="digit">0</div>
                </div>
              </div>
            </div>
            <div class="stat-card contact-forums">
              <div class="card-icon">
                <i class="fas fa-comments"></i>
              </div>
              <div class="card-content">
                <h3>Contact Forums</h3>
                <p id="dateDisplay3" class="card-date"></p>
                <div class="counter-display">
                  <div id="counter3_digit1" class="digit">0</div>
                  <div id="counter3_digit2" class="digit">0</div>
                </div>
              </div>
            </div>
            <div class="stat-card events">
              <div class="card-icon">
                <i class="fas fa-calendar-check"></i>
              </div>
              <div class="card-content">
                <h3>Events</h3>
                <p id="dateDisplay4" class="card-date"></p>
                <div class="counter-display">
                  <div id="counter4_digit1" class="digit">0</div>
                  <div id="counter4_digit2" class="digit">0</div>
                </div>
              </div>
            </div>
            <div class="stat-card news">
              <div class="card-icon">
                <i class="fas fa-newspaper"></i>
              </div>
              <div class="card-content">
                <h3>News</h3>
                <p id="dateDisplay5" class="card-date"></p>
                <div class="counter-display">
                  <div id="counter5_digit1" class="digit">0</div>
                  <div id="counter5_digit2" class="digit">0</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Calendar Widget -->
          <div class="widget calendar-widget">
            <div class="widget-header">
              <h3><i class="fas fa-calendar-alt"></i> Calendar</h3>
            </div>
            <div class="widget-content">
              <div class="calendar-nav">
                <button onclick="prevMonth()" class="calendar-nav-btn"><i class="fas fa-chevron-left"></i></button>
                <h4 id="monthYear"></h4>
                <button onclick="nextMonth()" class="calendar-nav-btn"><i class="fas fa-chevron-right"></i></button>
              </div>
              <div class="calendar-grid">
                <div class="weekdays">
                  <div>Sun</div>
                  <div>Mon</div>
                  <div>Tue</div>
                  <div>Wed</div>
                  <div>Thu</div>
                  <div>Fri</div>
                  <div>Sat</div>
                </div>
                <div id="dates" class="calendar-dates"></div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>

  <script src="dashboard.js"></script>
</body>
</html>