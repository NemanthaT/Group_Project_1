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
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Service Requests | EDSA Lanka Consultancy</title>
  <link rel="stylesheet" href="../dashboard/dashboard.css">
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
          <span class="user-name"><?php echo htmlspecialchars($username); ?></span>
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
          <a href="../dashboard/dashboard.php">
            <img src="../images/dashboard.png" alt="Dashboard">
            <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="servicerequest.php" class="active">
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
          <h1>Service Requests</h1>
          <p>Manage and assign service requests to service providers</p>
        </div>
        <div class="date-display">
          <div class="current-date" id="currentDate"></div>
          <div class="current-time" id="currentTime"></div>
        </div>
      </div>

      <!-- Main Content -->
      <div class="dashboard-content">
        <section class="stats-section">
          <h2>Service Requests List</h2>
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
                    
                    
                    $status = $row['status'];
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
        </section>
      </div>
    </div>
  </div>

  <script>
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
