<?php
  session_start(); 
  require_once '../../config/config.php';

  $username = $_SESSION['username'];
  $email = $_SESSION['email'];

  if (!isset($_SESSION['username'])) {
      header("Location: ../../Login/Login.php");
      exit;
  }

  if(isset($_POST['submit'])){
      $worker_id=$_POST['worker_id'];
      $title=$_POST['title'];
      $content=$_POST['content'];

      $sql="INSERT INTO `knowledgebase` (worker_id,title,content) VALUES ('$worker_id','$title','$content')";
      $result=mysqli_query($conn,$sql);
      if($result){
          echo '<script>alert("Knowledgebase updated");</script>';
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
    <title>Add Knowledge Base Entry | EDSA Lanka Consultancy</title>
    <link rel="stylesheet" href="../dashboard/dashboard.css">
    <link rel="stylesheet" href="../sidebar.css">
    <link rel="stylesheet" href="updateknowlgebase.css">
</head>
<body>
    <!-- Sidebar Toggle Button (for mobile) -->
    <button class="sidebar-toggle" id="sidebarToggle">
        ☰
    </button>
    
    <!-- Overlay for mobile -->
    <div class="overlay" id="overlay"></div>
    
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <div style="width: 40px; height: 40px; background-color: #4f46e5; display: flex; align-items: center; justify-content: center; color: white; border-radius: 5px; margin-right: 15px;">E</div>
            <span>EDSA Lanka</span>
        </div>
        <div class="sidebar-menu">
            <a href="../dashboard/dashboard.php">
                <div class="menu-item">
                    <span class="menu-icon">📊</span>
                    <span>Dashboard</span>
                </div>
            </a>
            <a href="../servicerequest/servicerequest.php">
                <div class="menu-item">
                    <span class="menu-icon">🔧</span>
                    <span>Service Requests</span>
                </div>
            </a>
            <a href="../acceptclient/acceptclient.php">
                <div class="menu-item">
                    <span class="menu-icon">👥</span>
                    <span>Accept Clients</span>
                </div>
            </a>
            <a href="../contactforums/contactforum.html">
                <div class="menu-item">
                    <span class="menu-icon">📝</span>
                    <span>Contact Forms</span>
                </div>
            </a>
            <a href="../updateknowlgebase/initial.php">
                <div class="menu-item">
                    <span class="menu-icon">📖</span>
                    <span>Update Knowledge Base</span>
                </div>
            </a>
            <a href="../updatenews/initial.php">
                <div class="menu-item">
                    <span class="menu-icon">📰</span>
                    <span>Update News</span>
                </div>
            </a>
        </div>
    </div>

    <!-- Header -->
    <header>
        <div class="logo-text">EDSA Lanka Consultancy</div>
        <div class="user-area">
            <div class="notification">
                🔔
                <span class="notification-count">3</span>
            </div>
            <div class="user-profile">
                <div style="width: 40px; height: 40px; background-color: #64748b; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white;">
                    <?php echo strtoupper(substr($username, 0, 1)); ?>
                </div>
                <span><?php echo htmlspecialchars($username); ?></span>
            </div>
            <a href="../../Login/Logout.php" class="logout-btn">Logout</a>
        </div>
    </header>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Welcome Banner -->
        <div class="welcome-banner">
            <div class="welcome-text">
                <h2>Add New Knowledge Base Entry</h2>
                <p>Create a new entry in the knowledge base</p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="dashboard-grid">
            <div class="dashboard-card" style="grid-column: span 2;">
                <form action="" method="POST" class="knowledge-form">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" placeholder="Enter the title" required>
                    </div>

                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea id="content" name="content" placeholder="Enter the Content" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="worker_id">Worker ID</label>
                        <input type="number" id="worker_id" name="worker_id" placeholder="Enter the worker id" required>
                    </div>

                    <div class="form-actions">
                        <button type="submit" name="submit" class="submit-button">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Mobile sidebar toggle
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('overlay').style.display = 
                document.getElementById('overlay').style.display === 'block' ? 'none' : 'block';
        });

        document.getElementById('overlay').addEventListener('click', function() {
            document.getElementById('sidebar').classList.remove('active');
            this.style.display = 'none';
        });
    </script>
</body>
</html>
