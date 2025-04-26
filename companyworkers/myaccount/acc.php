<?php
session_start();
require_once('../connect.php');

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: ../../Login/login.php");
    exit;
}

// Get logged in user email 
$email = $_SESSION['email'];

// Get worker details from database
$sql = "SELECT * FROM companyworkers WHERE email = '$email'";
$result = mysqli_query($con, $sql);
$worker = mysqli_fetch_assoc($result);

// Store values for use in HTML
$fullName = $worker['full_name'];
$username = $worker['username']; 
$role = $worker['role'];
$address = $worker['address'];
$phoneNo = $worker['phoneNo'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Forum Details</title>
    <link rel="stylesheet" href="../sidebar.css">
    <link rel="stylesheet" href="acc.css">
    <link rel="stylesheet" href="../dashboard/dashboard.css">
    <script src="send.js"></script>

</head>
<body>
    <?php if (!empty($composerWarning)): ?>
        <div style="background: #fff3cd; color: #856404; padding: 10px 20px; border: 1px solid #ffeeba; margin: 20px; border-radius: 5px;">
            <?php echo htmlspecialchars($composerWarning); ?>
        </div>
    <?php endif; ?>
    <!-- Sidebar Toggle Button -->
    <button class="sidebar-toggle" id="sidebarToggle">☰</button>
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
                        <button>
                        <span class="menu-icon">👥</span>
                            Client Accept
                        </button>
                    </a>
                </li>                <li>
                    <a href="../contactforums/contactforum.php">
                        <button class="active">
                        <span class="menu-icon">💬</span>
                        Conact Forum
                        </button>
                    </a>
                </li>
                <li>
                    <a href="../updateknowlgebase/initial.php">
                    <button>
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
                    <span class="menu-icon">📰</span>
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
                <a href="#">
                    <div class="profile-name"><?php echo htmlspecialchars($fullName); ?></div>
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
            <h2>Contact Forums</h2>
            <p>View and manage all contact forum submissions here.</p>
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
        <div class="account-details">
            <h2>👤 My Account Details</h2>
            <div class="details-grid">
                <div class="detail-item">
                    <label>Full Name</label>
                    <span><?php echo htmlspecialchars($fullName); ?></span>
                </div>
                <div class="detail-item">
                    <label>Username</label>
                    <span><?php echo htmlspecialchars($username); ?></span>
                </div>
                <div class="detail-item">
                    <label>Email</label>
                    <span><?php echo htmlspecialchars($email); ?></span>
                </div>
                <div class="detail-item">
                    <label>Role</label>
                    <span><?php echo htmlspecialchars($role); ?></span>
                </div>
                <div class="detail-item">
                    <label>Address</label>
                    <span><?php echo htmlspecialchars($address); ?></span>
                </div>
                <div class="detail-item">
                    <label>Phone Number</label>
                    <span><?php echo htmlspecialchars($phoneNo); ?></span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>