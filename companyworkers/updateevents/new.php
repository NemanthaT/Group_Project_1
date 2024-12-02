<?php
include '../connect.php';
if(isset($_POST['submit'])){
  $worker_id=$_POST['worker_id'];
  $title=$_POST['title'];
  $description=$_POST['description'];
  $event_date=$_POST['event_date'];


  $sql="INSERT INTO `events` (worker_id,title,description,event_date) VALUES ('$worker_id','$title','$description','$event_date')";
  $result=mysqli_query($con,$sql);
  if($result){
    echo '<script>alert("events updated");</script>';
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Events</title>
  <link rel="stylesheet" href="updateevents.css?version=9">
  <link rel="stylesheet" href="../sidebar.css">
</head>
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
            <h1>Update Events</h1>
        </div>
        <div class="profile">
          <a href="../SP_Profile/Profile.html">
            <img src="../images/user.png" alt="Profile">
          </a>
        </div>
        <a href="../../Login/Logout.php" class="logout">Logout</a>
      </div>
      <div class="main-container">
    
    <div class="boxcontainer">
        <form action="" method="POST">
          <br>
        <center><label for="title">Title:</label></center>
        <center><input type="text" id="title" name="title" placeholder="Enter the title" required>
            <br><br><br>
            <div class="content-bottom">
            <center><label for="description">Description</label>
              <textarea name ="description" id="description" placeholder="Enter description Here"></textarea></center> 
              <br><br>        
              <label for="worker_id">Name:</label>
              <input type="text" id="worker_id" name="worker_id" placeholder="Name" required>

              <label for="date">Event-Date:</label>
              <input type="date" id="date" name="date" required>
            </div>

            <br><br>
          <center><input type="submit"value="submit" name="submit" class="submit-button"></center>
        </form>
    </div>

    <script src="dashboard.js"></script>
    <script src="../sidebar.js"></script>

    </body>
</html>
