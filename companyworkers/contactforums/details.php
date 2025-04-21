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


$contact_id = isset($_GET['contact_id']) ? intval($_GET['contact_id']) : 0;
$form = null;
if ($contact_id > 0) {
    $sql = "SELECT cf.contact_id, cf.client_id, cf.subject, cf.message, cf.created_at, c.full_name 
            FROM contactforms cf 
            LEFT JOIN clients c ON cf.client_id = c.client_id 
            WHERE cf.contact_id = $contact_id";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $form = $result->fetch_assoc();
    }
}

// Dummy user for header (replace with session logic as in dashboard.php)
$fullName = "Company Worker";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Form Details</title>
  <link rel="stylesheet" href="contactforums.css?version=3">
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
          <span class="menu-icon">📝</span>
          <span>Service Requests</span>
        </div>
      </a>
      <a href="contactforum.php">
        <div class="menu-item active">
          <span class="menu-icon">💬</span>
          <span>Contact Forms</span>
        </div>
      </a>
      <a href="../updateevents/updateevents.php">
        <div class="menu-item">
          <span class="menu-icon">📅</span>
          <span>Update Events</span>
        </div>
      </a>
      <a href="../updateknowlgebase/initial.php">
        <div class="menu-item">
          <span class="menu-icon">📚</span>
          <span>Update Knowledge Base</span>
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
  <header>
    <div class="logo-text">EDSA Lanka Consultancy</div>
    <div class="user-area">
          <p>Details</p>
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
        <h2>Contact Form Details</h2>
        <p>View and reply to the selected contact form.</p>
      </div>
    </div>
    <?php if ($form): ?>
    <div class="details-container">
      <div class="form-header">
        <div class="form-field">
          <label for="contact_id">Contact ID</label>
          <input type="text" id="contact_id" name="contact_id" value="<?php echo htmlspecialchars($form['contact_id']); ?>" readonly>
        </div>
        <div class="form-field">
          <label for="Client_ID">Client Name</label>
          <input type="text" id="Client_ID" name="Client_ID" value="<?php echo htmlspecialchars($form['full_name'] ?? 'Unknown'); ?>" readonly>
        </div>
        <div class="form-field">
          <label for="Date">Date</label>
          <input type="text" id="Date" name="Date" value="<?php echo htmlspecialchars(substr($form['created_at'], 0, 10)); ?>" readonly>
        </div>
      </div>

      <div class="message-section">
        <div class="message-box">
          <label for="message">Customer Message</label>
          <textarea id="message" name="message" readonly><?php echo htmlspecialchars($form['message']); ?></textarea>
        </div>
        
        <div class="reply-box">
          <label for="reply">Your Reply</label>
          <textarea id="reply" name="reply" placeholder="Type your reply here..." required></textarea>
        </div>
      </div>

      <div class="button-section">
        <button type="submit" class="submit-button" name="submit">Send Reply</button>
      </div>
    </div>
    <?php else: ?>
      <div class="error-message">
        <p>No contact form found.</p>
        <a href="contactforum.php" class="back-button">Back to Contact Forms</a>
      </div>
    <?php endif; $conn->close(); ?>
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
  </script>
</body>
</html>