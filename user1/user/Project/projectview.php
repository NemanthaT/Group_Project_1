
<?php
include '../session/session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka - Appointment Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="../images/logo.png" alt="EDSA Lanka Consultancy Logo">
            </div>
            
            <ul class="menu">
                <li>
                    <a href="../Dashboard/Dashboard.php">
                        <button >
                            <img src="../images/dashboard.png" alt="Dashboard">
                            Dashboard
                        </button>
                    </a>
                </li>
                <li>
                    <a href="../appointments/appointment.php">
                        <button >
                            <img src="../images/appointment.png" alt="Appointment">
                            Appointment
                        </button>
                    </a>
                    </li>
                <li>
                    <a href="../Project/project.php">
                        <button class="active">
                            <img src="../images/project.png" alt="project">
                            Projects
                        </button>
                    </a>
                </li>                
                <li>
                    <a href="../bill/bill.php">
                        <button >
                        <img src="../images/bill.png" alt="Bill">
                        Bill
                        </button>
                    </a>
                </li>
                <li>
                    <a href="../forum/forum.php">
                    <button>
                        <img src="../images/forum.png" alt="Forum">
                        Forum
                    </button>
                    </a>
                </li>
                <li><a href="../Message/Message.php">
                    <button>
                        <img src="../images/Message.png" alt="Message">
                        Message
                    </button></a>
                </li>
                <!-- <li>
                    <a href="../reports/reports.php">
                        <button >
                            <img src="../images/reports.png" alt="Reports">
                            Reports
                        </button>
                    </a>
                </li> -->
            </ul>
        </div>

        <!-- Main Content Area -->
        <div class="main-wrapper">
            <!-- Navbar -->
            <div class="navbar">
                <a href="#">Home</a>
                <a href="#">
                    <img src="../images/notification.png" alt="Notifications">
                </a>
                <div class="profile">
                <a href="../profile/profile.php">
                <img src="../images/user.png" alt="Profile">
                    </a>
                </div>
                <a href="../../../Login/Logout.php" class="logout">Logout</a>
            </div>

    <div class=".main-container">
        <div class="space"></div>
        <div class="controls header card1">
            <h1>Financial consultancy for board of directers</h1>
        </div>
        <div class="row margin">
        <div class="row-container">
            <h2>Project Details</h2>
            <hr><br>
            <p><strong>Project Name:</strong> Financial consultancy for board of directers</p>
            <p><strong>Project ID:</strong> 001</p>
            <p><strong>Service Provider Name :</strong> Rama Crish</p>
            <p><strong>Service Provider Content Details :</strong> 0711234561</p>    
        </div>
        <div class="row-container">
            <h2>Project Progress </h2>
            <hr><br>
            <p><strong>Project Start Date:</strong> 2021-09-01</p>
            <p><strong>updated Date:</strong> 2021-09-30</p>
            <div class="row">
            <p ><strong>Project Status : </strong> <p class="green"> Ongoing </p></p>
            </div>
            <p><strong>Project pashe :</strong> Requirement Gathering</p>
    </div>
    </div>
    <div class="controls">
        <h1>Documents</h1>

        <div class="box">

            <h2>Agreement</h2>
            <br>
            <div class="row center">
                <img class="pdf" src="img/pdf.png" alt="">
                <h3> Agrement.pdf</h3>
            </div>
        </div> <div class="box">

<h2>Proposal</h2>
<br>
<div class="row center">
    <img class="pdf" src="img/pdf.png" alt="">
    <h3> Proposal.pdf</h3>
</div>
</div>
    </div>
    <div class="controls">
        <h1>Report</h1>
        <div class="box">
        <h2>Report</h2>
            <br>
                <div class="row center">
                    <img class="pdf" src="img/pdf.png" alt="">
                    <h3> Report.pdf</h3>
                </div>
        </div>

    </div>

    </div>
</div>
    <script src="script.js"></script>
</body>
</html>