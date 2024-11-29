
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
                        <button class="active">
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
                        <button >
                            <img src="../images/project.png" alt="project">
                            Projects
                        </button>
                    </a>
                </li>                <li>
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
                <!-- <li>
                    <button>
                        <img src="../images/knowledgebase.png" alt="Knowledge Base">
                        Knowledge Base
                    </button>
                </li> -->
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
                <a href="../../Login/Logout.php" class="logout">Logout</a>
            </div>

    <div class=".main-container">
        <div class="space"></div>

        <div class="controls card1">
            <h1>Welcome To EDSA Lanka</h1>
            <h3>HI !  Safran Zahim ..</h3>
        </div>
        <div class="controls ">
            
        </div>
            <!-- project Grid -->
            <div class="project-grid">
            <!-- project Card 1 -->
            <div class="project-card">
                <div class="project-header">
                    <span class="project-id">P001</span>
                    <span class="status green">Ongoing</span>
                </div>
                <div class="project-content">
                    <div class="project-info">
                        <h2><strong>Financial consultancy for board of directers</strong></h2> <br />
                        <p>Financial Consultancy Program is a specialized service aimed at helping individuals or organizations make informed financial decisions, manage their finances more effectively, and achieve financial goals. Financial consultants or advisors provide expert advice on a range of financial matters, from budgeting and investment strategies to tax planning, risk management, and long-term financial planning.</p>
                    </div>
                    <a href="projectview.php">
                    <button class="pay-button" >view</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>