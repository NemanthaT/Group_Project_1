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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Knowledgebase</title>
  <link rel="stylesheet" href="updateknowlgebase.css?version=12">
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
            <h1>KnowledgeBase</h1>
      </div>
        <div class="profile">
         <p>Hi, <?php echo $username ?>!! 👋</p>
          <a href="../SP_Profile/Profile.html">
            <img src="../images/user.png" alt="Profile">
          </a>
        </div>
        <a href="../../Login/Logout.php" class="logout">Logout</a>
      </div>
      <div class="main-container">
      <div class="boxcontainer">
        <div class="boxes">
            <a href="new.php" style="text-decoration: none; color: inherit;">
                <div class="new glass-effect">
                  <img src="../images/new.jpg" alt="new" class="icon">
                    <p>Add New</p>
                </div>
            </a>
            <a href="updatedelete.php" style="text-decoration: none; color: inherit;">
                <div class="new glass-effect">
                  <div class="updelete">
                  <img src="../images/update.jpg" alt="new" class="icon1">
                  <img src="../images/delete.jpg" alt="new" class="icon1">
                  </div>
                  <p>Update or Delete</p>
                </div>
            </a>
        </div>
      </div>
    </div>
  </div>
</div>

    

    <script src="dashboard.js"></script>
    <script src="../sidebar.js"></script>

    </body>
</html>
