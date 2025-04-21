<?php
  session_start(); 
  require_once '../../config/config.php';

  $username = $_SESSION['username'];
  $email = $_SESSION['email'];

  if (!isset($_SESSION['username'])) { // if not logged in
      header("Location: ../../Login/Login.php");
      exit;
  }
  $news_id=$_GET['update_id'];
  $sql="Select * from `news` where news_id='$news_id'";
  $result=mysqli_query($conn,$sql);
  $row=mysqli_fetch_assoc($result);
  $worker_id=$row['worker_id'];
  $title=$row['title'];
  $conntent=$row['content'];

if(isset($_POST['submit'])){
  $worker_id=$_POST['worker_id'];
  $title=$_POST['title'];
  $conntent=$_POST['content'];

  $sql="update `news` set worker_id='$worker_id', title='$title', 
  content='$conntent' where news_id='$news_id'";
  $result=mysqli_query($conn,$sql);
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Update News | EDSA Lanka Consultancy</title>
  <link rel="stylesheet" href="../dashboard/dashboard.css">
  <link rel="stylesheet" href="updatenews.css">
</head>
<body>
  <div class="container">
    <!-- Header -->
    <header class="main-header">
      <div class="logo-section">
        <img src="../images/logo.png" alt="EDSA Lanka Logo">
        <h1>EDSA Lanka Consultancy</h1>
      </div>
      <div class="header-right">
        <div class="user-profile">
          <img src="../images/user.png" alt="Profile" class="profile-icon">
          <span class="user-name"><?php echo htmlspecialchars($username); ?></span>
        </div>
        <a href="../../Login/Logout.php" class="logout-btn">Logout</a>
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
    </aside>

    <!-- Main Content Area -->
    <div class="main-wrapper">
      <div class="welcome-banner">
        <div class="welcome-text">
          <h1>Update News</h1>
          <p>Edit existing news article</p>
        </div>
      </div>

      <div class="dashboard-content">
        <div class="boxcontainer">
          <form action="" method="POST" class="news-form">
            <br>
            <center><label for="title">Title:</label></center>
            <center><input type="text" id="title" name="title" 
                    placeholder="Enter the title" required 
                    autocomplete="off" value="<?php echo $title; ?>">
                <br><br><br>
                    <label for="content">Content:</label><br>
                    <textarea id="content" name="content" 
                    placeholder="Enter the Content" required
                    autocomplete="off"><?php echo $conntent; ?></textarea>
                <br><br></center>
                    <label for="worker_id" style="margin-left: 7.5%;">Worker_ID:</label>
                    <input type="number" id="worker_id" name="worker_id" 
                    placeholder="Enter the worker id" required
                    autocomplete="off" value="<?php echo $worker_id; ?>">
                <br><br><br>
            <center><input type="submit"value="Update" name="submit" class="submit-button"></center>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
