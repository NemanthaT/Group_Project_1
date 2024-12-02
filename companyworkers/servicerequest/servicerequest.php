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

        <div class="table-container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col" style="width: 15%;">Appointment ID</th>
                <th scope="col" style="width: 15%;">Client ID</th>
                <th scope="col" style="width: 15%;">Date</th>
                <th scope="col" style="width: 25%;">Type</th>
                <th scope="col" style="width: 15%;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM appointments";
            $result = mysqli_query($con, $sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $appointment_id = $row['appointment_id'];
                    $client_id = $row['client_id'];
                    $appointment_date = $row['appointment_date'];
                    $service_type = $row['service_type'];
                    echo '<tr>
                        <th scope="row">' . $appointment_id . '</th>
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

        
          </div>
      </div>
    </div>

    <script src="dashboard.js"></script>
    <script src="../sidebar.js"></script>

  </body>
</html>
