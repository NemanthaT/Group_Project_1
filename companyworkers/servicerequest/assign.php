<?php
include '../connect.php';
  $appointment_id=$_GET['update_id'];
  $sql="Select * from `appointments` where appointment_id='$appointment_id'";
  $result=mysqli_query($con,$sql);
  $row=mysqli_fetch_assoc($result);
  $client_id=$row['client_id'];
  $appointment_date=$row['appointment_date'];
  $service_type=$row['service_type'];
  $message=$row['message'];
  


if(isset($_POST['submit'])){
  $client_id=$_POST['client_id'];
  $appointment_date=$_POST['appointment_date'];
  $service_type=$_POST['service_type'];
  $message=$row['message'];


  $sql="update `appointments` set client_id='$client_id', appointment_date='$appointment_date', 
  service_type='$service_type' where appointment_id='$appointment_id'";
  $result=mysqli_query($con,$sql);
  if ($result) {
    echo '<script>
        alert("News updated");
        window.location.href = "servicerequest.php";
    </script>';
    exit;
}

  else{
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
  <!-- <link rel="stylesheet" href="../sidebar.css"> -->
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
        <div class="controls card1">
            <h1>Assign</h1>
        </div>
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
              
              <div class="info-field">
              <span class="label">Client ID:</span>
              <span class="value"><?php echo $client_id; ?></span>
              </div>
              
              <div class="info-field">
              <span class="label">Company Name:</span>
              <span class="value"></span>
              </div>
              
              <div class="info-field">
              <span class="label">Contact Phone:</span>
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
          
          <div class="right">
              <label for="message">Message:</label>
              <textarea id="message" name="message" readonly><?php echo $message; ?></textarea>
          </div>
          </div>

          <div class="reply-section">
          <label for="reply">Reply:</label>
          <textarea id="reply" name="reply" placeholder="Enter your reply here" required></textarea>
          </div>

          <div class="assignment-section">
          <label for="assign-person">Assign To:</label>
          <select id="assign-person" name="assign_person" required>
              <option value="">Select a person</option>
              <?php
              // Fetch staff from database
              $staff_query = "SELECT staff_id, staff_name FROM staff";
              $staff_result = mysqli_query($con, $staff_query);
              while($staff = mysqli_fetch_assoc($staff_result)) {
              echo "<option value='".$staff['staff_id']."'>".$staff['staff_name']."</option>";
              }
              ?> 
          </select>
          </div>

          <div class="down">
          <div class="scrollable-panel">
              <a href="consulting.php">Consulting</a>
              <a href="reaserch.php">Research</a>
              <a href="training.php">Training</a>
          </div>
            <div class="names">
              Assigned Names
            </div>
            </div>

            <div class="submit-section">
              <input type="submit" value="Submit" name="submit" class="submit-button">
            </div>
            <div class="submit-section">
              <input type="submit" value="Submit" name="submit" class="submit-button">
            </div>
            </form>
          </div>

  <script src="../sidebar.js"></script>

</body>
</html>