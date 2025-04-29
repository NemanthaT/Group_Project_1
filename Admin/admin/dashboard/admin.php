<?php
    session_start(); 
    require_once('../../../config/config.php');

    $username = $_SESSION['username'];
    $email = $_SESSION['email'];

    if (!isset($_SESSION['username'])) { 
        header("Location: ../../../login/login.php");
        exit;
    }

    $_SESSION['pR'] = NULL;
    $_SESSION['nF'] = NULL;
    $_SESSION['nPB'] = NULL;
    $_SESSION['nRC'] = NULL;
    $_SESSION['nRSP'] = NULL;

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>EDSA Lanka Consultancy</title>
        <link rel="stylesheet" href="adminstyles.css">
        <link rel="stylesheet" href="../../css/common.css">
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="sidebar">
                <div class="logo">
                    <img src="../../Images/logo.png" alt="EDSA Lanka Consultancy">
                </div>
                <nav>
                    <ul>
                        <li class="dropDown" id="dD1" ><a href="dashboard2.php" target="Dashboard">&#9875 Dashboard</a></li>
                        <li class="dropDown" id="dD2" ><a href="../Users/users.php" target="Dashboard">&#128113 Users</a></li>
                        <li class="dropDown" id="dD3" ><a href="../ManageEmployees/manEmp.php" target="Dashboard">&#9997 Manage Employees</a></li>
                        <li class="dropDown" id="dD4" ><a href="../Requests/requests.php" target="Dashboard"><span style="color:green">&#129159</span> Provider Requests</a></li>
                        <li class="dropDown" id="dD5" ><a href="../Forums/forums.php" target="Dashboard">&#128195 Forums</a></li>
                        <li class="dropDown" id="dD6" ><a href="../Reports/reports.php" target="Dashboard">&#128203 Billing Reports</a></li>
                    </ul>
                </nav>
            </div>
            <div class="content">
                <div class="header">
                    <header>
                        <div class="user-info">
                            <p>Hi, <?php echo $username ?>!! 👋</p>
                            <button name="submit" type="submit"><a href="../../../Login/Logout.php" class="logoutbutton">Logout</a></button>
                        </div>
                    </header>
                </div>
                <div class="frame">
                    <div id=frame>
                        <iframe src="dashboard2.php" name="Dashboard" title="Dashboard"></iframe>
                    </div>

                    </div>
                </div>

            </div>
        </div>
        </div>
        <footer>
            <center><p>&copy; 2024 EDSA Lanka Consultancy</p></center>
        </footer>
        <script src="admin.js"></script>
    </body>
</html>