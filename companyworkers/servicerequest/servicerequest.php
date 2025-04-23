<?php
session_start(); 
require_once '../../config/config.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../../Login/Login.php");
    exit;
}
$username = $_SESSION['username'];
$email = $_SESSION['email'] ?? '';
$query = "SELECT full_name FROM companyworkers WHERE username = '$username'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
$fullName = $user['full_name'] ?? 'User';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Service Requests | EDSA Lanka Consultancy</title>
  <link rel="stylesheet" href="servicerequest.css">
  <link rel="stylesheet" href="../sidebar.css">
  <link rel="stylesheet" href="../dashboard/dashboard.css">
</head>
<body>
  <!-- Sidebar Toggle Button (for mobile) -->
  <button class="sidebar-toggle" id="sidebarToggle">☰</button>
  <div class="overlay" id="overlay"></div>

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <div class="sidebar-logo">
      <div style="width: 40px; height: 40px; background-color: #4f46e5; display: flex; align-items: center; justify-content: center; color: white; border-radius: 5px; margin-right: 15px;">E</div>
      <span>EDSA Lanka</span>
    </div>
    <div class="sidebar-menu">
      <a href="../dashboard/dashboard.php">
        <div class="menu-item">
          <span class="menu-icon">📊</span>
          <span>Dashboard</span>
        </div>
      </a>
      <a href="servicerequest.php">
        <div class="menu-item active">
          <span class="menu-icon">🔧</span>
          <span>Service Requests</span>
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
          <span class="menu-icon">📝</span>
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
      <p>Service Requests</p>
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
    <div class="welcome-banner" style="margin-bottom: 30px;">
      <div class="welcome-text">
        <h2>Service Requests</h2>
        <p>Manage and assign service requests to service providers</p>
      </div>
      <div class="date-time" style="text-align:right;">
        <div id="currentDate"></div>
        <div id="currentTime"></div>
      </div>
    </div>
    <h3 class="section-title">Service Requests List</h3>
    <div class="table-container">
      <table class="table">
        <thead>
          <tr>
            <th>Appointment ID</th>
            <th>Client ID</th>
            <th>Date</th>
            <th>Type</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT * FROM appointments WHERE status = 'Pending'";
          $result = mysqli_query($conn, $sql);
          if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
              $appointment_id = $row['appointment_id'];
              $client_id = $row['client_id'];
              $appointment_date = $row['appointment_date'];
              $service_type = $row['service_type'];
              echo '<tr>
                <td>' . $appointment_id . '</td>
                <td>' . $client_id . '</td>
                <td>' . $appointment_date . '</td>
                <td>' . $service_type . '</td>
                <td>
                  <button><a href="assign.php?update_id=' . $appointment_id . '">Check</a></button>
                </td>
              </tr>';
            }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <script>
    // Sidebar toggle for mobile
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    sidebarToggle.addEventListener('click', function() {
      sidebar.classList.toggle('open');
      overlay.style.display = sidebar.classList.contains('open') ? 'block' : 'none';
    });
    overlay.addEventListener('click', function() {
      sidebar.classList.remove('open');
      overlay.style.display = 'none';
    });

    // Date/time display
    function updateDateTime() {
      const now = new Date();
      const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
      document.getElementById('currentDate').textContent = now.toLocaleDateString('en-US', options);
      document.getElementById('currentTime').textContent = now.toLocaleTimeString('en-US', {
        hour: '2-digit',
        minute: '2-digit'
      });
    }
    document.addEventListener('DOMContentLoaded', function() {
      updateDateTime();
      setInterval(updateDateTime, 60000);
    });
  </script>
</body>
</html>