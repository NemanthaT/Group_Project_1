<?php
  session_start(); 
  require_once '../../config/config.php';

  $username = $_SESSION['username'];
  $email = $_SESSION['email'];

  if (!isset($_SESSION['username'])) { // if not logged in
      header("Location: ../../Login/Login.php");
      exit;
  }

  // Use correct primary key
  $id = $_GET['update_id'];
  $sql = "SELECT * FROM `knowledgebase` WHERE id='$id'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $worker_id = $row['worker_id'];
  $title = $row['title'];
  $content = $row['content'];

  if(isset($_POST['submit'])){
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);

    $sql = "UPDATE `knowledgebase` SET title='$title', content='$content' WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    if($result){
      echo '<script>
      alert("Knowledgebase updated");
      window.location.href = "updatedelete.php";
      </script>';
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
    <title>Update Knowledge Base Entry | EDSA Lanka Consultancy</title>
    <link rel="stylesheet" href="../dashboard/dashboard.css">
    <link rel="stylesheet" href="../sidebar.css">
    <link rel="stylesheet" href="updateknowlgebase.css">
</head>
<body>
    <!-- Sidebar Toggle Button (for mobile) -->
    <button class="sidebar-toggle" id="sidebarToggle">☰</button>
    
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
                    <button class="active">
                    <span class="menu-icon">📚</span>
                    Update Knowldgebase
                    </button>
                    </a>
                </li>
                <li><a href="../updatenews/initial.php">
                    <button>
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
                <h2>Update Knowledge Base Entry</h2>
                <p>Edit existing knowledge base content</p>
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

        <!-- Form Card -->
        <div class="dashboard-grid">
            <div class="dashboard-card" style="grid-column: span 2;">
                <form action="" method="POST" class="knowledge-form">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <select id="title" name="title" required size="5" style="overflow-y:auto; height:120px;">
                            <option value="">Select a title</option>
                            <option value="development finance" <?php if($title == 'development finance') echo 'selected'; ?>>Development Finance</option>
                            <option value="micro finance" <?php if($title == 'micro finance') echo 'selected'; ?>>Micro Finance</option>
                            <option value="organizational development" <?php if($title == 'organizational development') echo 'selected'; ?>>Organizational Development</option>
                            <option value="sme development" <?php if($title == 'sme development') echo 'selected'; ?>>SME Development</option>
                            <option value="gender finance" <?php if($title == 'gender finance') echo 'selected'; ?>>Gender Finance</option>
                            <option value="institutional development" <?php if($title == 'institutional development') echo 'selected'; ?>>Institutional Development</option>
                            <option value="community development" <?php if($title == 'community development') echo 'selected'; ?>>Community Development</option>
                            <option value="strategic and operational planning" <?php if($title == 'strategic and operational planning') echo 'selected'; ?>>Strategic and Operational Planning</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea id="content" name="content" 
                                placeholder="Enter the Content" required><?php echo htmlspecialchars($content); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="worker_id"></label>
                        <input type="hidden" id="worker_id" name="worker_id" 
                               value="<?php echo htmlspecialchars($worker_id); ?>" readonly>
                    </div>

                    <div class="form-actions">
                        <button type="submit" name="submit" class="submit-button">Update Entry</button>
                    </div>
                </form>
            </div>
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
