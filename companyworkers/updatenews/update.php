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
    } else {
      echo '<script>alert("Nothing changed");</script>';
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update News | EDSA Lanka Consultancy</title>
    <link rel="stylesheet" href="../dashboard/dashboard.css">
    <link rel="stylesheet" href="../sidebar.css">
    <link rel="stylesheet" href="updatenews.css">
</head>
<body>
    <!-- Sidebar Toggle Button (for mobile) -->
    <button class="sidebar-toggle" id="sidebarToggle">
        ☰
    </button>
    
    <!-- Overlay for mobile -->
    <div class="overlay" id="overlay"></div>
    
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <img src="../images/logo.png" alt="EDSA Lanka Consultancy Logo">
            </div>
            
            <ul class="menu">
                <li>
                    <a href="../Dashboard/Dashboard.php">
                        <button >
                        <span class="menu-icon">📊</span>
                            Dashboard
                        </button>
                    </a>
                </li>
                <li>
                    <a href="../servicerequest/servicerequest.php">
                        <button >
                        <span class="menu-icon">🔧</span>
                            Service Requests
                        </button>
                    </a>
                    </li>
                <li>
                    <a href="../acceptclient/acceptclient.php">
                        <button >
                        <span class="menu-icon">👥</span>
                            Client Accept
                        </button>
                    </a>
                </li>                <li>
                    <a href="../contactforums/contactforum.php">
                        <button >
                        <span class="menu-icon">💬</span>
                        Contact Forum
                        </button>
                    </a>
                </li>
                <li>
                    <a href="../updateknowlgebase/initial.php">
                    <button >
                    <span class="menu-icon">📚</span>
                    Update Knowldgebase
                    </button >
                    </a>
                </li>
                <li><a href="../updatenews/initial.php">
                    <button class="active">
                    <span class="menu-icon">📰</span>
                    Update News
                    </button></a>
                </li>
                <li><a href="../serviceproviders/view.php">
                    <button >
                    <span class="menu-icon">🛠️</span>
                    Service Providers
                    </button></a>
                </li>
            </ul>
        </div>

    <!-- Header -->
    <div class="main-wrapper">
            <!-- Navbar -->
            <div class="navbar">
                <div class="profile">
                <a href="../myaccount/acc.php">
                <img src="../images/user.png" alt="Profile">
                    </a>
                </div>
                <a href="../../Login/Logout.php" class="logout">Logout</a>
            </div>
        

    <div class=".main-container">
        <div class="space"></div>

        <div class="controls card1">
        <div class="welcome-banner">
            <div class="welcome-text">
                <h2>Update News</h2>
                <p>Edit existing news article</p>
            </div>
                <div class="date-time" style="text-align:right;">
                <div id="currentDate"></div>
                <div id="currentTime"></div>
            </div>
        </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">

        <!-- Form Content -->
        <div class="dashboard-grid">
            <div class="dashboard-card" style="grid-column: span 2;">
                <form action="" method="POST" class="news-form">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" 
                               placeholder="Enter the title" required 
                               value="<?php echo htmlspecialchars($title); ?>">
                    </div>

                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea id="content" name="content" 
                                placeholder="Enter the Content" required><?php echo htmlspecialchars($conntent); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="worker_id"></label>
                        <input type="hidden" id="worker_id" name="worker_id" 
                               placeholder="Enter the worker id" required
                               value="<?php echo htmlspecialchars($worker_id); ?>">
                    </div>

                    <div class="form-actions">
                        <button type="submit" name="submit" class="submit-button">Update News</button>
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
