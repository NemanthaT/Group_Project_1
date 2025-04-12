<?php
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
  $message = $row['message'];
  $client_name = $row['client_name'];
  $client_phone = $row['phone'];

  if (isset($_POST['submit'])) {
    $provider_id = $_POST['assign_person']; // Changed from provider_id to assign_person
    
    // Update both the provider_id and status
    $sql = "UPDATE `appointments` SET 
            provider_id='$provider_id', 
            status='Assigned' 
            WHERE appointment_id='$appointment_id'";
            
    $result = mysqli_query($con, $sql);
    if ($result) {
      echo '<script>
        alert("News updated");
        window.location.href = "servicerequest.php";
        </script>';
      exit;
    } else {
      echo '<script>alert("Nothing changed");</script>';
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" service_type="width=device-width, initial-scale=1.0">
    <title>Service Request Count</title>
    <link rel="stylesheet" href="assign.css">
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
            <a href="servicerequest.php">
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
          <div class="controls card1"></div>
          <div class="profile">
            <a href="../SP_Profile/Profile.html">
              <img src="../images/user.png" alt="Profile">
            </a>
          </div>
          <a href="../../Login/Logout.php" class="logout">Logout</a>
        </div>
        <div class="main-container">
          <form action="" method="POST">
            <br>
            <div class="form-container">
              <div class="left">
                <div class="form-top">
                  <div class="info-field">
                    <span class="label">Appointment ID:</span>
                    <span class="value"><?php echo $appointment_id; ?></span>
                  </div>
                </div>
                <div class="right">
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
                </div>
              </div>
            </div>

            <div class="reply-section">
              <label for="message">Message:</label>
              <textarea id="message" name="message" readonly><?php echo $message; ?></textarea>
            </div>

            <!-- Assign Person Section -->
            <?php
              // Fetch service providers from database
              $providers_query = "SELECT provider_id, full_name FROM serviceproviders";
              $providers_result = mysqli_query($con, $providers_query);
              if (!$providers_result) {
                die("Providers query failed: " . mysqli_error($con));
              }
            ?>
            <label for="assign-person">Assign To:</label><br />
            <select id="assign-person" name="assign_person" required style="width: 50%; padding: 10px;">
              <option value="">Select a person</option>
              <?php while ($provider = mysqli_fetch_assoc($providers_result)) { ?>
                <!-- Populate dropdown with provider names -->
                <option value="<?php echo $provider['provider_id']; ?>">
                  <?php echo $provider['full_name']; ?>
                </option>
              <?php } ?>
            </select><br /><br />

            <div class="submit-section">
              <input type="submit" value="Submit" name="submit" class="submit-button">
            </div>
          </form>
        </div>
      </div>
    </div>

    <script src="../sidebar.js"></script>
  </body>
</html>
