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
  <div class="sidebar">
        <div class="logo">
            <img src="../images/logo.png" alt="EDSA Lanka Consultancy Logo">
            </div>
            
            <ul class="menu">
                <li>
                    <a href="../Dashboard/Dashboard.php">
                        <button >
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
                        <button class="active">
                        <span class="menu-icon">💬</span>
                        Conact Forum
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
            </ul>
        </div>

    <!-- Header -->
    <div class="main-wrapper">
            <!-- Navbar -->
            <div class="navbar">
                <div class="profile">
                <a href="#">
                    <div class="profile-name"><?php echo htmlspecialchars($fullName); ?></div>
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
            <h2>Contact Forums</h2>
            <p>View and manage all contact forum submissions here.</p>
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
  </div>
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