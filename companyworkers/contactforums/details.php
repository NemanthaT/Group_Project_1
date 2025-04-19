<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "edsalanka";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Service Request Count</title>
  <link rel="stylesheet" href="contactforums.css?version=3">
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
            <h1>Contact Form Details</h1>
        </div>
        <div class="profile">
          <a href="../SP_Profile/Profile.html">
            <img src="../images/user.png" alt="Profile">
          </a>
        </div>
        <a href="../../Login/Logout.php" class="logout">Logout</a>
      </div>
      <div class="main-container">
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
    </div>
  </div>

  <script src="../sidebar.js"></script>

</body>
</html>