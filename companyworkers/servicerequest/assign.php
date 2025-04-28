<?php
  session_start();
  require_once '../../config/config.php';
  
  if (!isset($_SESSION['username'])) {
    header("Location: ../../Login/Login.php");
    exit;
  }
  
  $username = $_SESSION['username'];
  $query = "SELECT full_name FROM companyworkers WHERE username = '$username'";
  $result = mysqli_query($conn, $query);
  $user = mysqli_fetch_assoc($result);
  $fullName = $user['full_name'] ?? 'User';

  include '../connect.php';
  $appointment_id = $_GET['update_id'];
  $sql = "SELECT a.*, c.full_name as client_name, c.phone 
      FROM `appointments` a
      JOIN `clients` c ON a.client_id = c.client_id
      WHERE a.appointment_id='$appointment_id'";
  $result = mysqli_query($con, $sql);
  if (!$result) {
    die("Query failed: " . mysqli_error($con));
  }
  $row = mysqli_fetch_assoc($result);
  $client_id = $row['client_id'];
  $appointment_date = $row['appointment_date'];
  $service_type = $row['service_type'];
  $field_name = $row['field_name'];
  $message = $row['message'];
  $client_name = $row['client_name'];
  $client_phone = $row['phone'];

  if (isset($_POST['submit'])) {
    $provider_id = $_POST['assign_person'];
    $reply_message = $_POST['reply_message']; // Add this line to capture the value
    $sql = "UPDATE `appointments` SET 
            provider_id='$provider_id', 
            reply_note='$reply_message',
            status='Assigned' 
            WHERE appointment_id='$appointment_id'";
    $result = mysqli_query($con, $sql);
    if ($result) {
      echo '<script>
        alert("Service provider assigned successfully");
        window.location.href = "servicerequest.php";
        </script>';
      exit;
    } else {
      echo '<script>alert("Nothing changed");</script>';
    }
  }
  
  // Handle rejection
  if (isset($_POST['reject'])) {
    $reject_reason = $_POST['reject_reason'];
    $sql = "UPDATE `appointments` SET 
            status='Rejected',
            reply_note='$reject_reason' 
            WHERE appointment_id='$appointment_id'";
    $result = mysqli_query($con, $sql);
    if ($result) {
      echo '<script>
        alert("Appointment rejected");
        window.location.href = "servicerequest.php";
        </script>';
      exit;
    } else {
      echo '<script>alert("Error rejecting appointment");</script>';
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assign Service Provider | EDSA Lanka Consultancy</title>
  <link rel="stylesheet" href="assign.css">
  <link rel="stylesheet" href="../sidebar.css">
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
                        <button>
                        <span class="menu-icon">📊</span>
                            Dashboard
                        </button>
                    </a>
                </li>
                <li>
                    <a href="../servicerequest/servicerequest.php">
                        <button class="active" >
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
                        <button >
                        <span class="menu-icon">💬</span>
                        Contact Forum
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
                    <span class="menu-icon">🛠️</span>
                    Update News
                    </button></a>
                </li>
                <li><a href="../serviceproviders/view.php">
                    <button >
                    <span class="menu-icon">🛠️</span>
                    Service Providers
                    </button></a>
                </li>
            </ul>
        </div>

    <!-- Header -->
    <div class="main-wrapper">
            <!-- Navbar -->
            <div class="navbar">
                <div class="profile">
                <a href="../myaccount/acc.php">
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
            <h2>Assign Service Provider</h2>
            <p>Review request details and assign appropriate service provider</p>
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
    <div class="dashboard-content">
      <form action="" method="POST">
        <div class="form-container">
          <div class="left">
            <div class="form-top">
              <div class="info-field" style="display: none;">
                <span class="label" type = "hidden">Appointment ID:</span>
                <span class="value" type = "hidden"><?php echo $appointment_id; ?></span>
              </div>
            </div>
            <div class="right" style="display: none;">
              <div class="info-field">
                <span class="label">Client ID:</span>
                <span class="value"><?php echo $client_id; ?></span>
              </div>
            </div>
            <div class="left">
              <br>
              <div class="info-field">
                <span class="label">Client Name:</span>
                <span class="value"><?php echo $client_name; ?></span>
              </div>
              <div class="info-field">
                <span class="label">Contact Phone:</span>
                <span class="value"><?php echo $client_phone; ?></span>
              </div>
              <div class="info-field">
                <span class="label">Company Name:</span>
                <span class="value"></span>
              </div>
              <div class="info-field">
                <span class="label">Date:</span>
                <span class="value"><?php echo $appointment_date; ?></span>
              </div>
              <div class="info-field">
                <span class="label">Type:</span>
                <span class="value"><?php echo $service_type; ?></span>
              </div>
              <div class="info-field">
                <span class="label">Filed:</span>
                <span class="value"><?php echo $field_name; ?></span>
              </div>
            </div>
          </div>
        </div>

        <div class="reply-section">
          <label for="message">Message:</label>
          <textarea id="message" name="message" readonly><?php echo $message; ?></textarea>
        </div>

        <div class="reply-section">
          <label for="message">Reply message</label>
          <textarea id="reply_message" name="reply_message" readonly>Your appointment has been approved. Our service provider will contact you soon.</textarea>
        </div>
        <!-- Map service type to provider speciality -->
        <?php
          function mapServiceToSpeciality($service_type) {
            $mapping = [
              'Training' => 'Training',
              'Consulting' => 'Consultant', 
              'Researching' => 'Researcher'
            ];
            return $mapping[$service_type] ?? '';
          }

          $required_speciality = mapServiceToSpeciality($service_type);
          
          // Modified query to filter by speciality
          $providers_query = "SELECT provider_id, full_name 
                            FROM serviceproviders 
                            WHERE speciality = '$required_speciality' AND field = '$field_name'";
          $providers_result = mysqli_query($con, $providers_query);
          if (!$providers_result) {
            die("Providers query failed: " . mysqli_error($con));
          }
        ?>
        <label for="assign-person">Assign To:</label><br />
        <select id="assign-person" name="assign_person" required style="width: 50%; padding: 10px;">
          <option value="">Select a person</option>
          <?php while ($provider = mysqli_fetch_assoc($providers_result)) { ?>
            <option value="<?php echo $provider['provider_id']; ?>">
              <?php echo $provider['full_name']; ?>
            </option>
          <?php } ?>
        </select><br /><br />

        <div class="submit-section">
          <input type="submit" value="Submit" name="submit" class="submit-button">
          <button type="button" class="reject-button" onclick="showRejectPopup()">Reject</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Rejection Popup Modal -->
  <div id="rejectModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeRejectPopup()">&times;</span>
      <h3>Rejection Reason</h3>
      <form id="rejectForm" method="POST" action="">
        <textarea id="reject_reason" name="reject_reason" placeholder="Enter reason for rejection" required></textarea>
        <input type="submit" name="reject" value="Confirm Rejection">
      </form>
    </div>
  </div>

  <script src="service.js"></script>
  
  <style>
  </style>
</body>
</html>
