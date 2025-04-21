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
  <title>Consultants | EDSA Lanka Consultancy</title>
  <link rel="stylesheet" href="../dashboard/dashboard.css">
  <link rel="stylesheet" href="servicerequest.css">
</head>
<body>
  <div class="container">
    <!-- Header -->
    <header class="main-header">
      <div class="navbar">
        <div class="controls card1">
          <h1>Consultants</h1>
        </div>
        <div class="profile">
          <p>Hi, <?php echo $username ?>!! 👋</p>
          <a href="../SP_Profile/Profile.html">
            <img src="../images/user.png" alt="Profile">
          </a>
        </div>
        <a href="../../Login/Logout.php" class="logout">Logout</a>
      </div>
    </header>

    <!-- Sidebar -->
    <aside class="sidebar">
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
    </aside>

    <!-- Main Content Area -->
    <div class="main-wrapper">
      <div class="welcome-banner">
        <div class="welcome-text">
          <h1>Consultants</h1>
          <p>Select consultants to assign to service requests</p>
        </div>
        <div class="date-display">
          <div class="current-date" id="currentDate"></div>
          <div class="current-time" id="currentTime"></div>
        </div>
      </div>

      <div class="dashboard-content">
        <div style="text-align: right;">
          <input type="submit" value="Assign" name="submit" class="submit-button">
        </div>

        <div class="table-container">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col" style="width: 25%;">Full Name</th>
                <th scope="col" style="width: 10%;">Phone Number</th>
                <th scope="col" style="width: 25%;">Address</th>
                <th scope="col" style="width: 10%;">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT * FROM serviceproviders WHERE speciality = 'Consultant'";
              $result = mysqli_query($conn, $sql);
              if ($result) {
                  while ($row = mysqli_fetch_assoc($result)) {
                      $full_name = $row['full_name'];
                      $phone = $row['phone'];
                      $address = $row['address'];
                      $unique_id = uniqid(); // Generate a unique ID for the checkbox
                      echo '<tr>
                          <th scope="row">' . $full_name . '</th>
                          <td>' . $phone . '</td>
                          <td>' . $address . '</td>
                          <td>
                              <label for="' . $unique_id . '" class="checkbox-label">
                                  <input type="checkbox" id="' . $unique_id . '" name="action[]" value="' . $full_name . '" class="hidden-checkbox">
                                  <span class="custom-checkbox"></span>
                              </label>
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

  <script src="../sidebar.js"></script>
  <script>
    // Add the datetime update script from dashboard.php
  </script>
</body>
</html>