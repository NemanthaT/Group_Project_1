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
  <link rel="stylesheet" href="updateknowlgebase.css?version=14">
  <link rel="stylesheet" href="../sidebar.css">
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
            <h1>Past Updates</h1>
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
      <div class="table-container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col" style="width: 15%;">Knowldgebase_ID</th>
                <th scope="col" style="width: 15%;">Worker_ID</th>
                <th scope="col" style="width: 25%;">Title</th>
                <th scope="col" style="width: 20%;">Date Created</th>
                <th scope="col" style="width: 20%;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM knowledgebase";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $kb_id = $row['kb_id'];
                    $worker_id = $row['worker_id'];
                    $title = $row['title'];
                    $date_created = $row['created_at'];
                    echo '<tr>
                        <th scope="row">' . $kb_id . '</th>
                        <td>' . $worker_id . '</td>
                        <td>' . $title . '</td>
                        <td>' . $date_created . '</td>
                        <td>
                            <button><a href="update.php?update_id=' . $kb_id . '">Update</a></button>
                            <button><a href="delete.php?delete_id=' . $kb_id . '">Delete</a></button>
                        </td>
                    </tr>';
                }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  </div>
  </div>

    <script src="dashboard.js"></script>
    <script src="../sidebar.js"></script>

    </body>
</html>