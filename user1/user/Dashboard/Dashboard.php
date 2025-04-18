
<?php
    include '../session/session.php';
    $email = $_SESSION['email'];

    $sql= "SELECT client_id FROM clients WHERE email= ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $clientId = $row['client_id'];
    $_SESSION['client_id'] = $clientId;
    $stmt->close();


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
                    <a href="">
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

        <div class="controls card1">
            <h1>Welcome To EDSA Lanka</h1>
            <h3>HI !  Safran Zahim ..</h3>
        </div>

   <div class="dashboard">
        <div class="appointments-panel card">
            <div class="card-header">
            <h2>Upcoming Appointments</h2>
                 <span class="icon">📅</span>
            </div>
            <?php include 'get_appointments.php'; ?>
        </div>


        <div class="main-content">
            <div class="card">
                <div class="card-header">
                    <h2>Upcoming Projects</h2>
                    <span class="icon">📋</span>
                </div>
                <?php include 'get_project.php'; ?>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2>Pending Payments</h2>
                    <span class="icon">💰</span>
                </div>
                <div class="list-item">
                    <span>Training Session Payment</span>
                    <span>Rs.5,000</span>
                    <span class="status-badge status-pending">Pending</span>
                </div>
                <div class="list-item">
                    <span>Subscription for Monthly Sessions</span>
                    <span>Rs.3,500</span>
                    <span class="status-badge status-upcoming">Due Soon</span>
                </div>
                <div class="list-item">
                    <span>Payment for Personal Finance Session</span>
                    <span>Rs.2,200</span>
                    <span class="status-badge status-overdue">Overdue</span>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2>Notifications</h2>
                    <span class="icon">🔔</span>
                </div>
                <div class="list-item">
                    <div class="appointment-details">
                        <strong>Payment Due Reminder</strong>
                        <span class="appointment-time">Your monthly payment of Rs.6,000 is due in 3 days. Please ensure timely payment.</span>
                    </div>
                    <span class="status-badge status-upcoming">New</span>
                </div>
                <div class="list-item">
                    <div class="appointment-details">
                        <strong>Transaction Confirmation</strong>
                        <span class="appointment-time">Your recent transaction of Rs.4,000 to Mr.Rama Crish has been successfully processed.</span>
                    </div>
                    <span class="status-badge status-pending">Seen</span>
                </div>
                <div class="list-item">
                    <div class="appointment-details">
                        <strong>Agreement Uploaded</strong>
                        <span class="appointment-time">Your agreement has been successfully uploaded. Please review the document and let us know if you have any questions or need further assistance.</span>
                    </div>
                    <span class="status-badge status-overdue">Pending</span>
                </div>
            </div>
        </div>
    </div>


    </div>
    </div>
    <script src="script.js"></script>
</body>
</html>