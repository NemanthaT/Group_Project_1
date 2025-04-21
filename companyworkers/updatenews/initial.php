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
  <title>News Management | EDSA Lanka Consultancy</title>
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
          <h1>News Management</h1>
          <p>Choose an option to manage news content</p>
        </div>
      </div>

      <div class="dashboard-content">
        <div class="boxes">
            <a href="new.php" style="text-decoration: none; color: inherit;">
            <div class="new glass-effect">
                  <img src="../images/new.jpg" alt="new" class="icon">
                    <p>Enter to add new news</p>
            </div>
            </a>
            <a href="updatedelete.php" style="text-decoration: none; color: inherit;">
            <div class="new glass-effect">
                  <div class="updelete">
                  <img src="../images/update.jpg" alt="new" class="icon1">
                  <img src="../images/delete.jpg" alt="new" class="icon1">
                  </div>
                  <p>Update or delete news</p>
                </div>
            </a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
