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
    <title>DashBoard</title>
    <link rel="stylesheet" href="../sidebar.css?version=1">
    <link rel="stylesheet" href="dashboard.css?version=8">
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
                Contact Form
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
            <h1>DashBoard</h1>
        </div>
          <div class="profile">
            <p>Hi, <?php echo $username ?>!! 👋</p>
            <a href="../SP_Profile/Profile.html">
              <img src="../images/user.png" alt="Profile">
            </a>
          </div>
          <a href="../../Login/Logout.php" class="logout">Logout</a>
        </div>

        <!-- Main Content Area -->
        <div class="main-container">
          <div class="box1">
            <div class="box2">
              <div class="box3 glass-effect-2">
                <!-- Counter Display with Date -->
                <div class="counter">
                  <p id="dateDisplay2" data-name="Service Request">Service Request</p>
                  <div class="flip-counter" id="counter2">
                    <div id="counter2_digit1">0</div>
                    <div id="counter2_digit2">0</div>
                  </div>
                </div>
              </div>
              
              
              <div class="box3 glass-effect-2">
                <!-- Counter Display with Date -->
                <div class="counter">
                  <p id="dateDisplay3" data-name="Contact Forums">Contact Forums</p>
                  <div class="flip-counter" id="counter3">
                    <div id="counter3_digit1">0</div>
                    <div id="counter3_digit2">0</div>
                  </div>
                </div>
              </div>

  
              <div class="box3 glass-effect-2">
                <div class="counter">
                  <p id="dateDisplay4" data-name="Events">Events</p>
                  <div class="flip-counter" id="counter4">
                    <div id="counter4_digit1">0</div>
                    <div id="counter4_digit2">0</div>
                  </div>
                </div>
              </div>
  
              <div class="box3 glass-effect-2">
                <div class="counter ">
                  <p id="dateDisplay5" data-name="News">News</p>
                  <div class="flip-counter" id="counter5">
                    <div id="counter5_digit1">0</div>
                    <div id="counter5_digit2">0</div>
                  </div>
                </div>
              </div>
            </div>
              
            <div class="box2">
              <div class="box4 glass-effect-4">
              <div class="time glass-effect-3">
                <div id="clock">Loading...</div>
              </div>

              <div id="date-display" class="digital-date glass-effect-3">
                <!-- Date will be displayed here dynamically -->
              </div>
              </div>
              

              <div class="calendar">
                <div class="calendar-header">
                  <button onclick="prevMonth()">‹</button>
                  <h2 id="monthYear"></h2>
                  <button onclick="nextMonth()">›</button>
                </div>
                <div class="days">
                  <div class="day glass-effect">Sun</div>
                  <div class="day glass-effect">Mon</div>
                  <div class="day glass-effect">Tue</div>
                  <div class="day glass-effect">Wed</div>
                  <div class="day glass-effect">Thu</div>
                  <div class="day glass-effect">Fri</div>
                  <div class="day glass-effect">Sat</div>
                </div>
                <div class="days glass-effect" id="dates"></div>
              </div>
            
              <!-- Counter Section (5 counters with customizable names) -->
              <div class="box3 glass-effect-2">
              <div id="counter-section">
                <div class="counter">
                  <p id="dateDisplay1" data-name="knowldgedebase">Knowldgedebase</p>
                  <div class="flip-counter" id="counter1">
                    <div id="counter1_digit1">0</div>
                    <div id="counter1_digit2">0</div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    </div>
    <script src="dashboard.js?version=6"></script>
    <script src="../sidebar.js"></script>
  </body>
</html>
