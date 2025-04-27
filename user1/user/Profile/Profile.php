<?php
include '../session/session.php';
include '../../connect/connect.php'; // Make sure this file sets up $conn

// Get the logged-in client's email from the session
$email = $_SESSION['email'] ?? null;
if (!$email) {
    die("No client email in session.");
}

// Fetch client data
$stmt = $conn->prepare("SELECT full_name, email, phone, address, status FROM clients WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($full_name, $client_email, $phone, $address, $status);

$stmt->fetch();

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
    <div class="space"></div><br>
    <div class="profile-container">
    <h1> Profile Details</h1>
    <div class="profile-section">
<br>
        <div class="profile-field">
            <br>
            <label>Full Name</label>
            <div class="value" id="business_name_display"><?= htmlspecialchars($full_name) ?></div>
        </div>
        <div class="profile-field">
            <label>Email</label>
            <div class="value" id="business_email_display"><?= htmlspecialchars($client_email) ?></div>
        </div>
        <div class="profile-field">
            <label>Phone Number</label>
            <div class="value" id="business_phone_display"><?= htmlspecialchars($phone) ?></div>
        </div>
        <div class="profile-field">
            <label>Address</label>
            <div class="value" id="business_address_display"><?= htmlspecialchars($address) ?></div>
        </div>
        <div class="profile-field">
            <label>Status</label>
            <div class="value" id="status_display"><?= htmlspecialchars($status) ?></div>
        </div>
    </div>
    <!-- <div class="action-buttons">
        <button class="action-button edit-button">Edit Profile</button>
    </div> -->
</div>
        </div>


    </div>
    <script src="script.js"></script>
</body>
</html>