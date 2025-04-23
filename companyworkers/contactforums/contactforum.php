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

// Fetch contact forums, latest first
$sql = "SELECT * FROM contactforums ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Forums</title>
  <link rel="stylesheet" href="contactforums.css?version=1">
  <link rel="stylesheet" href="../sidebar.css?version=1">
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
      <a href="../servicerequest/servicerequest.php">
        <div class="menu-item">
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
      <a href="contactforum.php">
        <div class="menu-item active">
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
    <div class="welcome-banner" style="margin-bottom: 30px;">
      <div class="welcome-text">
        <h2>Contact Forums</h2>
        <p>View and manage all contact forum submissions here.</p>
      </div>
    </div>
    <h3 class="section-title">All Contact Forums</h3>
    <?php
    if ($result && $result->num_rows > 0) {
      echo '<div class="card-container">';
      $count = 0;
      while($row = $result->fetch_assoc()) {
        if ($count > 0 && $count % 4 == 0) {
          echo '</div><div class="card-container">';
        }
        ?>
        <div class="card">
          <a href="details.php?id=<?php echo urlencode($row['cf_id']); ?>">
            <h3>Contact Forum #<?php echo htmlspecialchars($row['cf_id']); ?></h3>
            <p><strong>Full Name:</strong> <?php echo htmlspecialchars($row['full_name']); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($row['phone_number']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
            <p><strong>Date:</strong> <?php echo htmlspecialchars(substr($row['created_at'], 0, 10)); ?></p>
          </a>
        </div>
        <?php
        $count++;
      }
      echo '</div>';
    } else {
      echo '<div class="no-forms"><p>No contact forums found</p></div>';
    }
    ?>
  </div>
  <script src="../sidebar.js"></script>
  <script>
    // Sidebar toggle for mobile
    const sidebarToggle = document.getElementByid('sidebarToggle');
    const sidebar = document.getElementByid('sidebar');
    const overlay = document.getElementByid('overlay');
    sidebarToggle.addEventListener('click', function() {
      sidebar.classList.toggle('open');
      overlay.style.display = sidebar.classList.contains('open') ? 'block' : 'none';
    });
    overlay.addEventListener('click', function() {
      sidebar.classList.remove('open');
      overlay.style.display = 'none';
    });
  </script>
</body>
</html>