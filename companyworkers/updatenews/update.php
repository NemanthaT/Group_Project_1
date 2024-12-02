<?php
include '../connect.php';
  $news_id=$_GET['update_id'];
  $sql="Select * from `news` where news_id='$news_id'";
  $result=mysqli_query($con,$sql);
  $row=mysqli_fetch_assoc($result);
  $worker_id=$row['worker_id'];
  $title=$row['title'];
  $content=$row['content'];

if(isset($_POST['submit'])){
  $worker_id=$_POST['worker_id'];
  $title=$_POST['title'];
  $content=$_POST['content'];

  $sql="update `news` set worker_id='$worker_id', title='$title', 
  content='$content' where news_id='$news_id'";
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <label for="content">Content:</label><br>
                <textarea id="content" name="content" 
                placeholder="Enter the Content" required
                autocomplete="off"><?php echo $content; ?></textarea>
            <br><br></center>
                <label for="worker_id" style="margin-left: 7.5%;">Worker_ID:</label>
                <input type="number" id="worker_id" name="worker_id" 
                placeholder="Enter the worker id" required
                autocomplete="off" value="<?php echo $worker_id; ?>">
            <br><br><br>
        <center><input type="submit"value="Update" name="submit" class="submit-button"></center>
        </form>
    </div>

    <script src="dashboard.js"></script>
    <script src="../sidebar.js"></script>

    </body>
</html>
