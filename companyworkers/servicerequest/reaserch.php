<?php
include("../connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="servicerequest.css">
  <link rel="stylesheet" href="../sidebar.css">
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
          <a href="../servicerequest/servicerequest.html">
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
        <a href="#">Home</a>
        <a href="#">
          <img src="../images/notification.png" alt="Notifications">
        </a>
        <div class="profile">
          <a href="../SP_Profile/Profile.html">
            <img src="../images/user.png" alt="Profile">
          </a>
        </div>
        <a href="../../Login/Logout.php" class="logout">Logout</a>
      </div>
      <div class="main-container">

      <div style="text-align: right;">
        <input type="submit" value="Assign" name="submit" class="submit-button" onclick="window.location.href='assign.html';">
      </div>
      
      <div class="table-container">
      <table class="table table-hover">
        <thead>
        <tr>
    <th scope="col" style="width: 25%;">Full Name</th>
    <th scope="col" style="width: 10%;">Phone Number</th>
    <th scope="col" style="width: 25%;">Address</th>
    <th scope="col" style="width: 25%;">Speciality</th>
    <th scope="col" style="width: 10%;">Action</th>
</tr>
</thead>
<tbody>
    <?php
    $sql = "SELECT * FROM serviceproviders WHERE speciality = 'Research'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $full_name = $row['full_name'];
            $phone = $row['phone'];
            $address = $row['address'];
            $speciality = $row['speciality'];
            $unique_id = uniqid(); // Generate a unique ID for the checkbox
            echo '<tr>
                <th scope="row">' . $full_name . '</th>
                <td>' . $phone . '</td>
                <td>' . $address . '</td>
                <td>' . $speciality . '</td>
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
      </div>
  </div>
  </div>
  </div>

  <script src="../sidebar.js"></script>

</body>
</html>