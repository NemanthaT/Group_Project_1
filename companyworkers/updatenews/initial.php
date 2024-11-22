<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update News</title>
  <link rel="stylesheet" href="updatenews.css?version=9">
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
          <li><a href="../updatenews/initial.php">Update News</a></li><br>
          <li><a href="../updateevents/updateevents.php">Update Events</a></li><br>
          <li><a href="../updateknowlgebase/initial.php">Update knowlgdebase</a></li><br>
          <li><a href="../dashboard/dashboard.html">dashboard</a></li><br>
        </ul>
      </div>

        <!-- Content -->

      <div class="content">
        <div class="header">
          <header class="header">
            <h1 class="logo">Update News</h1>
            <nav class="nav">
              <ul class = "nav-links">
                <li><a href="#">Logout</a></li>
                <li><a href="#">Profile</a></li>
              </ul>
            </nav>
          </header>
        </div>
    </div>

    <div class="container" style="position: absolute; top: 100px;">
        <div class="boxes">
            <a href="new.php" style="text-decoration: none; color: inherit;">
                <div class="new">
                    Enter to add News
                </div>
            </a>
    
            <a href="updatedelete.php" style="text-decoration: none; color: inherit;">
                <div class="new">
                    Update or delete News
                </div>
            </a>
        </div>
    </div>
    

    <script src="dashboard.js"></script>
    <script src="../sidebar.js"></script>

    </body>
</html>
