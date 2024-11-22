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
  <link rel="stylesheet" href="updateevents.css?version=8">
  <link rel="stylesheet" href="../sidebar.css">
</head>
<body>
    <div class="sidebar">
        <button class="sidebar-toggle" onclick="toggleSidebar()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;☰</button> <!-- Toggle Button -->
    
        <div>
          <img src="../logo.png" alt="logo" width="150" height="10" class="logo">
        </div>
        
        <ul>
          <br><br><br><br>
          <li><a href="../servicerequest/servicerequest.html">Service Request</a></li><br>
          <li><a href="../contactforums/contactforum.html">Contact Forum</a></li><br>
          <li><a href="../updatenews/updatenews.php">Update News</a></li><br>
          <li><a href="../updateevents/updateevents.php">Update Events</a></li><br>
          <li><a href="../updateknowlgebase/initial.php">Update knowlgdebase</a></li><br>
          <li><a href="../dashboard/dashboard.html">dashboard</a></li><br>
        </ul>
      </div>

      <!-- Content -->

      <div class="content">
        <div class="header">
          <header class="header">
            <h1 class="logo">Update Events</h1>
            <nav class="nav">
              <ul class = "nav-links">
                <li><a href="#">Logout</a></li>
                <li><a href="#">Profile</a></li>
              </ul>
            </nav>
          </header>
        </div>
    </div>

    <div class="container">
        <form action="" method="POST">
          <br>
        <center><label for="title">Title:</label></center>
        <center><input type="text" id="title" name="title" placeholder="Enter the title" required>
            <br><br><br>
            <div class="content-bottom">
            <center><label for="description">Description</label>
              <textarea name ="description" id="description" placeholder="Enter description Here"></textarea></center> 
              <br><br>        
              <label for="worker_id">Worker_ID:</label>
              <input type="number" id="worker_id" name="worker_id" placeholder="Worker ID" required>

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
