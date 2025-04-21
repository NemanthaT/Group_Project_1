<?php
  session_start(); 
  require_once '../../config/config.php';

  $username = $_SESSION['username'];
  $email = $_SESSION['email'];

  if (!isset($_SESSION['username'])) { // if not logged in
      header("Location: ../../Login/Login.php");
      exit;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Training | EDSA Lanka Consultancy</title>
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
      <a href="../acceptclient/acceptclient.php">
        <div class="menu-item">
          <span class="menu-icon">👥</span>
          <span>Accept Clients</span>
        </div>
      </a>
      <a href="servicerequest.php">
        <div class="menu-item">
          <span class="menu-icon">📝</span>
          <span>Service Requests</span>
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
      <p>Training</p>
      <div class="notification">
        🔔
        <span class="notification-count">3</span>
      </div>
      <div class="user-profile">
        <div style="width: 40px; height: 40px; background-color: #64748b; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white;">
          <?php echo strtoupper(substr($username, 0, 1)); ?>
        </div>
        <span><?php echo htmlspecialchars($username); ?></span>
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
        <h2>Training</h2>
        <p>Select trainers to assign to service requests</p>
      </div>
      <div class="date-time" style="text-align:right;">
        <div id="currentDate"></div>
        <div id="currentTime"></div>
      </div>
    </div>
    <div style="text-align: right;">
      <input type="submit" value="Assign" name="submit" class="submit-button">
    </div>
    <div class="table-container">
      <table class="table table-hover">
        <thead>
          <tr>
            <th style="width: 25%;">Full Name</th>
            <th style="width: 10%;">Phone Number</th>
            <th style="width: 25%;">Address</th>
            <th style="width: 10%;">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT * FROM serviceproviders WHERE speciality = 'training'";
          $result = mysqli_query($conn, $sql);
          if ($result) {
              while ($row = mysqli_fetch_assoc($result)) {
                  $full_name = $row['full_name'];
                  $phone = $row['phone'];
                  $address = $row['address'];
                  $unique_id = uniqid();
                  echo '<tr>
                      <th scope="row">' . $full_name . '</th>
                      <td>' . $phone . '</td>
                      <td>' . $address . '</td>
                      <td>
                          <label for="' . $unique_id . '" class="checkbox-label">
                              <input type="checkbox" id="' . $unique_id . '" name="action[]" value="' . $full_name . '" class="hidden-checkbox">
                              <span class="custom-checkbox"></span>
                          </label>
                      </td>
                  </tr>';
              }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <script src="../sidebar.js"></script>
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