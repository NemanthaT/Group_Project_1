<?php
include("../connect.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Request Count</title>
    <link rel="stylesheet" href="servicerequest.css">
    <link rel="stylesheet" href="../sidebar.css?version=2">
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
            <a href="../servicerequest.php">
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
                Contact Forum
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
            <h1>Service Requests</h1>
          </div>
          <a href="#">Home</a>
          <div class="profile">
            <a href="../SP_Profile/Profile.html">
              <img src="../images/user.png" alt="Profile">
            </a>
          </div>
          <a href="../../Login/Logout.php" class="logout">Logout</a>
        </div>

        <div class="main-container">

            <?php
            $sql = "SELECT appointment_id, appointment_date, created_at, service_type FROM appointments";
            $result = $con->query($sql);

            // Generate cards
            if ($result->num_rows > 0) {
            echo '<div class="card-container">';
              while ($row = $result->fetch_assoc()) {
              echo '
              <div class="card">
                  <!-- Update link dynamically if needed -->
                  <h3>New Appointment</h3>
                  <p>Appointment ID - ' . $row["appointment_id"] . '</p>
                  <p>Date: ' . $row["appointment_date"] . '</p>
                  <p>Time: ' . $row["created_at"] . '</p>
                  <p>Type - ' . $row["service_type"] . '</p>
                  <center>
                      <button>
                          <a href="assign.php?check_id=<?php echo $appointment_id; ?>">Check</a>
                      </button>
                  </center>
              </div>';
              }
              echo '</div>';
            } else {
            echo "No appointments found.";
            }
            ?>
        
      </div>

      </div>
    </div>

    <script src="dashboard.js"></script>
    <script src="../sidebar.js"></script>

  </body>
</html>
