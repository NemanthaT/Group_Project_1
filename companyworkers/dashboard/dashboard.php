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
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Dashboard | EDSA Lanka Consultancy</title>
  <link rel="stylesheet" href="dashboard.css">
</head>
<body>
  <div class="container">
    <!-- Header -->
    <header class="main-header">
      <div class="logo-section">
        <img src="../images/logo.png" alt="EDSA Lanka Logo">
        <h1>EDSA Lanka Consultancy</h1>
      </div>
      <div class="header-right">
        <div class="notification-wrapper">
          <img src="../images/notification.png" alt="Notifications" class="notification-icon">
          <span class="notification-badge">3</span>
        </div>
        <div class="user-profile">
          <img src="../images/user.png" alt="Profile" class="profile-icon">
          <span class="user-name"><?php echo htmlspecialchars($fullName); ?></span>
        </div>
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
          <a href="../dashboard/dashboard.php" class="active">
            <img src="../images/dashboard.png" alt="Dashboard">
            <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="../acceptclient/acceptclient.php">
            <img src="../images/client.png" alt="Accept Clients">
            <span>Accept Clients</span>
          </a>
        </li>
        <li>
          <a href="../servicerequest/servicerequest.php">
            <img src="../images/service.jpg" alt="Service Requests">
            <span>Service Requests</span>
          </a>
        </li>
        <li>
          <a href="../contactforums/contactforum.html">
            <img src="../images/contact.png" alt="Contact Forums">
            <span>Contact Forums</span>
          </a>
        </li>
        <li>
          <a href="../updateknowlgebase/initial.php">
            <img src="../images/knowledge.png" alt="Knowledge Base">
            <span>Knowledge Base</span>
          </a>
        </li>
        <li>
          <a href="../updatenews/initial.php">
            <img src="../images/news.jpg" alt="Update News">
            <span>Update News</span>
          </a>
        </li>
      </ul>
    </aside>

    <!-- Main Content Area -->
    <div class="main-wrapper">
      <div class="welcome-banner">
        <div class="welcome-text">
          <h1>Welcome Back, <span class="user-highlight"><?php echo htmlspecialchars($fullName); ?></span></h1>
          <p>Here's an overview of your dashboard at EDSA Lanka Consultancy</p>
        </div>
        <div class="date-display">
          <div class="current-date" id="currentDate"></div>
          <div class="current-time" id="currentTime"></div>
        </div>
      </div>

      <!-- Dashboard Content -->
      <div class="dashboard-content">
        <!-- Stats Section -->
        <section class="stats-section">
          <h2>Key Metrics</h2>
          <div class="stats-grid">
            <div class="stat-card service-requests">
              <div class="card-icon">
                <span class="icon-text">SR</span>
              </div>
              <div class="card-content">
                <h3>Service Requests</h3>
                <div class="stat-details">
                  <div class="counter-value" id="serviceRequests">24</div>
                  <div class="stat-trend positive">
                    <span class="trend-arrow">↑</span>
                    <span class="trend-value">12%</span>
                  </div>
                </div>
                <div class="stat-period">Last 7 days</div>
              </div>
            </div>
            
            <div class="stat-card contact-forums">
              <div class="card-icon">
                <span class="icon-text">CF</span>
              </div>
              <div class="card-content">
                <h3>Contact Forums</h3>
                <div class="stat-details">
                  <div class="counter-value" id="contactForums">17</div>
                  <div class="stat-trend positive">
                    <span class="trend-arrow">↑</span>
                    <span class="trend-value">8%</span>
                  </div>
                </div>
                <div class="stat-period">Last 7 days</div>
              </div>
            </div>
            
            <div class="stat-card news">
              <div class="card-icon">
                <span class="icon-text">NW</span>
              </div>
              <div class="card-content">
                <h3>News</h3>
                <div class="stat-details">
                  <div class="counter-value" id="news">9</div>
                  <div class="stat-trend positive">
                    <span class="trend-arrow">↑</span>
                    <span class="trend-value">15%</span>
                  </div>
                </div>
                <div class="stat-period">Last 7 days</div>
              </div>
            </div>
          </div>
        </section>
        
        <!-- Calendar and Activity Section -->
        <div class="secondary-content">
          <!-- Calendar Widget -->
          <section class="calendar-section">
            <h2>Calendar</h2>
            <div class="calendar-widget">
              <div class="calendar-nav">
                <button id="prevMonth">←</button>
                <h4 id="monthYear"></h4>
                <button id="nextMonth">→</button>
              </div>
              <div class="weekdays">
                <div>Sun</div>
                <div>Mon</div>
                <div>Tue</div>
                <div>Wed</div>
                <div>Thu</div>
                <div>Fri</div>
                <div>Sat</div>
              </div>
              <div id="calendarDates" class="calendar-dates"></div>
            </div>
          </section>
          
          <!-- Recent Activity -->
          <section class="activity-section">
            <h2>Recent Activity</h2>
            <div class="activity-list">
              <div class="activity-item">
                <div class="activity-icon service-icon"></div>
                <div class="activity-details">
                  <p class="activity-text">New service request from <strong>ABC Corporation</strong></p>
                  <p class="activity-time">2 hours ago</p>
                </div>
              </div>
              
              <div class="activity-item">
                <div class="activity-icon forum-icon"></div>
                <div class="activity-details">
                  <p class="activity-text">New contact forum submission from <strong>John Smith</strong></p>
                  <p class="activity-time">4 hours ago</p>
                </div>
              </div>
              
              <div class="activity-item">
                <div class="activity-icon news-icon"></div>
                <div class="activity-details">
                  <p class="activity-text">New news article published: <strong>Industry Updates</strong></p>
                  <p class="activity-time">Yesterday</p>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Display current date and time
    function updateDateTime() {
      const now = new Date();
      
      // Format date: Monday, April 19, 2025
      const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
      document.getElementById('currentDate').textContent = now.toLocaleDateString('en-US', options);
      
      // Format time: 10:30 AM
      document.getElementById('currentTime').textContent = now.toLocaleTimeString('en-US', {
        hour: '2-digit',
        minute: '2-digit'
      });
    }
    
    // Calendar functionality
    function renderCalendar() {
      const today = new Date();
      let currentMonth = today.getMonth();
      let currentYear = today.getFullYear();
      
      function updateCalendar() {
        const monthNames = ["January", "February", "March", "April", "May", "June", "July", 
                           "August", "September", "October", "November", "December"];
        
        document.getElementById('monthYear').textContent = `${monthNames[currentMonth]} ${currentYear}`;
        
        const firstDay = new Date(currentYear, currentMonth, 1).getDay();
        const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
        
        const calendarDates = document.getElementById('calendarDates');
        calendarDates.innerHTML = '';
        
        // Previous month's days
        const prevMonthDays = new Date(currentYear, currentMonth, 0).getDate();
        for (let i = firstDay - 1; i >= 0; i--) {
          const dateEl = document.createElement('div');
          dateEl.className = 'date other-month';
          dateEl.textContent = prevMonthDays - i;
          calendarDates.appendChild(dateEl);
        }
        
        // Current month's days
        for (let i = 1; i <= daysInMonth; i++) {
          const dateEl = document.createElement('div');
          dateEl.className = 'date';
          if (i === today.getDate() && currentMonth === today.getMonth() && currentYear === today.getFullYear()) {
            dateEl.classList.add('today');
          }
          dateEl.textContent = i;
          calendarDates.appendChild(dateEl);
        }
        
        // Calculate remaining cells for next month
        const totalCells = 42; // 6 rows × 7 days
        const remainingCells = totalCells - (firstDay + daysInMonth);
        for (let i = 1; i <= remainingCells; i++) {
          const dateEl = document.createElement('div');
          dateEl.className = 'date other-month';
          dateEl.textContent = i;
          calendarDates.appendChild(dateEl);
        }
      }
      
      document.getElementById('prevMonth').addEventListener('click', function() {
        currentMonth--;
        if (currentMonth < 0) {
          currentMonth = 11;
          currentYear--;
        }
        updateCalendar();
      });
      
      document.getElementById('nextMonth').addEventListener('click', function() {
        currentMonth++;
        if (currentMonth > 11) {
          currentMonth = 0;
          currentYear++;
        }
        updateCalendar();
      });
      
      updateCalendar();
    }
    
    // Initialize calendar and date/time
    document.addEventListener('DOMContentLoaded', function() {
      updateDateTime();
      setInterval(updateDateTime, 60000); // Update time every minute
      renderCalendar();
    });
  </script>
</body>
</html>