<?php
include '../connect.php';

if (isset($_GET['check_id'])) {
    $appointment_id = mysqli_real_escape_string($con, $_GET['check_id']);
} else {
    echo "No appointment ID provided.";
    exit;
}

// Fetch the appointment details
$sql = "SELECT * FROM `appointments` WHERE `appointment_id` = '$appointment_id'";
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $client_id = $row['client_id'];
    $appointment_date = $row['appointment_date'];
    $status = $row['status'];
    $service_type = $row['service_type'];
    $message = $row['message'];
} else {
    echo '<script>alert("No appointment found with the provided ID.");</script>';
    exit;
}

if (isset($_POST['submit'])) {
    $client_id = mysqli_real_escape_string($con, $_POST['client_id']);
    $appointment_date = mysqli_real_escape_string($con, $_POST['appointment_date']);
    $status = mysqli_real_escape_string($con, $_POST['status']);
    $message = mysqli_real_escape_string($con, $_POST['message']);
    $reply = mysqli_real_escape_string($con, $_POST['reply']); // New field

    $sql = "UPDATE `appointments` SET 
                client_id='$client_id', 
                appointment_date='$appointment_date', 
                status='$status', 
                message='$message',
                reply='$reply'
            WHERE appointment_id='$appointment_id'";

    if (mysqli_query($con, $sql)) {
        echo '<script>
            alert("Appointment updated successfully.");
            window.location.href = "updatedelete.php";
        </script>';
        exit;
    } else {
        echo '<script>alert("Update failed: ' . mysqli_error($con) . '");</script>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Service Request Count</title>
  <link rel="stylesheet" href="servicerequest.css?version=3">
  <link rel="stylesheet" href="../sidebar.css?version=3">
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
            <h1>Assign</h1>
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
        <form action="" method="POST">
        <br>
        <div class="form-container">
            <div class="left">
                <div class="form-top">
                    <label for="Appointment_ID">Appointment ID:</label>
                    <input type="text" id="Appointment_ID" name="Appointment_ID" placeholder="Appointment ID" 
                    required readonly value="<?php echo $appointment_id; ?>"><br><br>
                    <label for="Client_ID">Client ID:</label>
                    <input type="text" id="Client_ID" name="Client_ID" placeholder="Client ID" 
                    required readonly value="<?php echo $client_id; ?>"><br><br>
                    <label for="Date">Date:</label>
                    <input type="text" id="Date" name="Date" placeholder="Date" 
                    required readonly value="<?php echo $appointment_date; ?>"><br><br>
                    <label for="Status">Status:</label>
                    <input type="text" id="Status" name="Status" placeholder="Status" 
                    required readonly value="<?php echo $status; ?>"><br><br>
                    <label for="Type">Type:</label>
                    <input type="text" id="Type" name="Type" placeholder="Type" 
                    requiredreadonly value="<?php echo $service_type; ?>"><br><br>
                </div>
            </div>
            <div class="right">
                <center><label for="message">Message:</label><br>
                <textarea id="message" name="message" placeholder="customer message" 
                required readonly><?php echo $message; ?></textarea>
            </div>
        </div>
           
            </center>
            <center><label for="reply">reply:</label><br>
            <textarea id="reply" name="reply" placeholder="customer reply" required></textarea>
            <br><br></center>
            <div class="down">
            <div class="scrollable-panel">
                <a href="consulting.php">Consulting</a>
                <a href="reaserch.php">Reaserch</a>
                <a href="training.php">Training</a>
            </div>
            <div class="names">
                Assigned Names
            </div>
        </div>
            <br><br><br>
            <center><input type="submit"value="submit" name="submit" class="submit-button"></center>
            </div>
        </div>
    </div>
    

  <script src="../sidebar.js"></script>

</body>
</html>