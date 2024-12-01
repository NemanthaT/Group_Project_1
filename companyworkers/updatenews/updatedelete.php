<?php
include("../connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update News</title>
  <link rel="stylesheet" href="updatenews.css?version=11">
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
          <a href="../servicerequest/servicerequest.html">
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
        <a href="#">Home</a>
        <a href="#">
          <img src="../images/notification.png" alt="Notifications">
        </a>
        <div class="profile">
          <a href="../SP_Profile/Profile.html">
            <img src="../images/user.png" alt="Profile">
          </a>
        </div>
        <a href="../../Login/Logout.php" class="logout">Logout</a>
      </div>
      <ass="main-container">
    <div class="container" style="position: absolute; top: 100px;">
    <div class="table-container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col" style="width: 15%;">News_ID</th>
                <th scope="col" style="width: 15%;">Worker_ID</th>
                <th scope="col" style="width: 25%;">Title</th>
                <th scope="col" style="width: 20%;">Date Created</th>
                <th scope="col" style="width: 20%;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM news";
            $result = mysqli_query($con, $sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $news_id = $row['news_id'];
                    $worker_id = $row['worker_id'];
                    $title = $row['title'];
                    $date_created = $row['created_at'];
                    echo '<tr>
                        <th scope="row">' . $news_id . '</th>
                        <td>' . $worker_id . '</td>
                        <td>' . $title . '</td>
                        <td>' . $date_created . '</td>
                        <td>
                            <button><a href="update.php?update_id=' . $news_id . '">Update</a></button>
                            <button><a href="delete.php?delete_id=' . $news_id . '">Delete</a></button>
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


    <script src="dashboard.js"></script>
    <script src="../sidebar.js"></script>

    </body>
</html>