<?php
include '../connect.php';
  $event_id=$_GET['update_id'];
  $sql="Select * from `events` where event_id='$event_id'";
  $result=mysqli_query($con,$sql);
  $row=mysqli_fetch_assoc($result);
  $title=$row['title'];
  $event_date=$row['event_date'];
  $description=$row['description'];

if(isset($_POST['submit'])){
  $event_date=$_POST['event_date'];
  $title=$_POST['title'];
  $description=$_POST['description'];

  $sql="update `news` set event_date='$event_date', title='$title', 
  description='$description' where event$event_id='$event_id'";
  $result=mysqli_query($con,$sql);
  if ($result) {
    echo '<script>
        alert("News updated");
        window.location.href = "updatedelete.php";
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
  <meta name="viewport" description="width=device-width, initial-scale=1.0">
  <title>Update News</title>
  <link rel="stylesheet" href="updatenews.css?version=10">
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
            <h1>Update</h1>
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

      <div class="boxcontainer">
        <form action="" method="POST">
          <br>
        <center><label for="title">Title:</label></center>
        <center><input type="text" id="title" name="title" 
                placeholder="Enter the title" required 
                autocomplete="off" value="<?php echo $title; ?>">
            <br><br><br>
                <label for="description">description:</label><br>
                <textarea id="description" name="description" 
                placeholder="Enter the description" required
                autocomplete="off"><?php echo $description; ?></textarea>
            <br><br></center>
                <label for="event_date" style="margin-left: 7.5%;">Event_date:</label>
                <input type="date" id="event_date" name="event_date" 
                placeholder="Enter the worker id" required
                autocomplete="off" value="<?php echo $event_date; ?>">
            <br><br><br>
        <center><input type="submit"value="Update" name="submit" class="submit-button"></center>
        </form>
    </div>

    <script src="dashboard.js"></script>
    <script src="../sidebar.js"></script>

    </body>
</html>
