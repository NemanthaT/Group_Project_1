<?php
include("../connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update News</title>
  <link rel="stylesheet" href="updatenews.css?version=10">
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

    <script src="dashboard.js"></script>
    <script src="../sidebar.js"></script>

    </body>
</html>