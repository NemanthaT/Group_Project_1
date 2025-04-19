<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "edsalanka";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

// Fetch contact forms with client names, latest first
$sql = "SELECT cf.contact_id, cf.client_id, cf.subject, cf.created_at, c.full_name 
        FROM contactforms cf 
        LEFT JOIN clients c ON cf.client_id = c.client_id 
        ORDER BY cf.created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Service Request Count</title>
  <link rel="stylesheet" href="contactforums.css?version=1">
  <link rel="stylesheet" href="../sidebar.css?version=1">
</head>
<body>
  <div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="logo">
        <img src="../images/logo.png" alt="EDSA Lanka Consultancy Logo">
      </div> 

      <ul class="menu">
        <li>
          <a href="../dashboard/dashboard.php">
            <button>
              <img src="../images/dashboard.png" alt="Dashboard">
              Dashboard
            </button>
          </a>
        </li>
        <li>
          <a href="../servicerequest/servicerequest.php">
            <button>
              <img src="../images/service.jpg" alt="servicerequest">
              Service Requests
            </button>
          </a>
        </li>
        <li>
          <a href="../contactforums/contactforum.html">
            <button>
              <img src="../images/contact forms.jpg" alt="contactforms">
              Contact Forms
            </button>
          </a>
        </li>
        <li>
          <a href="../updateevents/updateevents.php">
            <button>
              <img src="../images/events.jpg" alt="events">
              Update Events
            </button>
          </a>
        </li>
        <li>
          <a href="../updateknowlgebase/initial.php">
          <button>
            <img src="../images/knowlegdebase.jpg" alt="knowldgedebase">
            Update Knowledge Base
          </button>
          </a>  
        </li>
        <li>
          <a href="../updatenews/initial.php">
          <button>
            <img src="../images/news.jpg" alt="News">
            Update News
          </button>
          </a>
        </li>
      </ul>
    </div>

    <div class="main-wrapper">
      <!-- Navbar -->
      <div class="navbar">
        <div class="controls card1">
          <h1>Contact Forms</h1>
      </div>
        <div class="profile">
          <a href="../SP_Profile/Profile.html">
            <img src="../images/user.png" alt="Profile">
          </a>
        </div>
        <a href="../../Login/Logout.php" class="logout">Logout</a>
      </div>
      <div class="main-container">
        <?php
        if ($result && $result->num_rows > 0) {
          $count = 0;
          echo '<div class="card-container">';
          while($row = $result->fetch_assoc()) {
            if ($count > 0 && $count % 4 == 0) {
              echo '</div><div class="card-container">';
            }
            ?>
            <div class="card">
              <a href="details.html">
                <h3>Contact Form</h3>
                <p>Contact Form ID - <?php echo htmlspecialchars($row['contact_id']); ?></p>
                <p>Client Name - <?php echo htmlspecialchars($row['full_name'] ?? 'Unknown'); ?></p>
                <p>Date: <?php echo htmlspecialchars(substr($row['created_at'], 0, 10)); ?></p>
                <p>Subject - <?php echo htmlspecialchars($row['subject']); ?></p>
              </a>
            </div>
            <?php
            $count++;
          }
          echo '</div>';
        } else {
          echo "<p>No contact forms found.</p>";
        }
        $conn->close();
        ?>
      </div>
    </div>
  </div>
  <script src="../sidebar.js"></script>
</body>
</html>