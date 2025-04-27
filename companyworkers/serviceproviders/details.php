<?php
session_start();

// Check if user is logged in and is a company worker
if (!isset($_SESSION['userType']) || $_SESSION['userType'] !== 'companyworkers') {
    header("Location: ../../Login/login.php");
    exit();
}

require_once '../connect.php';

// Get the provider ID from URL
$provider_id = isset($_GET['id']) ? $_GET['id'] : 0;

// Get service provider details
$query = "SELECT * FROM serviceproviders WHERE provider_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $provider_id);
$stmt->execute();
$result = $stmt->get_result();
$provider = $result->fetch_assoc();

// Get logged in user's details for the header
$email = $_SESSION['email'];
$query = "SELECT full_name FROM companyworkers WHERE email = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$fullName = $user['full_name'];

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka Consultancy</title>
    <link rel="stylesheet" href="../dashboard/dashboard.css">
    <link rel="stylesheet" href="../sidebar.css">
    <link rel="stylesheet" href="view.css">
    <script src="dashboard.js"></script>
</head>
<body>
    <!-- Sidebar Toggle Button (for mobile) -->
    <button class="sidebar-toggle" id="sidebarToggle">
        ☰
    </button>
    
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
                    <button class="active">
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
                <h2>Welcome Back, <?php echo htmlspecialchars($fullName); ?></h2>
                <p>Here's an overview of your dashboard at EDSA Lanka Consultancy</p>
            </div>
                <div class="date-time" style="text-align:right;">
                <div id="currentDate"></div>
                <div id="currentTime"></div>
            </div>
        </div>
        </div>
    </div>
    <!-- Header and Sidebar code remains same -->
    <div class="main-content">
        <div class="provider-details-card">
            <div class="card-header">
                <h2>Service Provider Details</h2>
                <a href="view.php" class="back-button">Back to List</a>
            </div>
            
            <div class="details-grid">
                <div class="details-section personal-info">
                    <h3>Personal Information</h3>
                    <div class="detail-item">
                        <label>Username:</label>
                        <span><?php echo htmlspecialchars($provider['username']); ?></span>
                    </div>
                    <div class="detail-item">
                        <label>Full Name:</label>
                        <span><?php echo htmlspecialchars($provider['full_name']); ?></span>
                    </div>
                    <div class="detail-item">
                        <label>Gender:</label>
                        <span><?php echo htmlspecialchars($provider['gender']); ?></span>
                    </div>
                    <div class="detail-item">
                        <label>Email:</label>
                        <span><?php echo htmlspecialchars($provider['email']); ?></span>
                    </div>
                    <div class="detail-item">
                        <label>Phone:</label>
                        <span><?php echo htmlspecialchars($provider['phone']); ?></span>
                    </div>
                    <div class="detail-item">
                        <label>Address:</label>
                        <span><?php echo htmlspecialchars($provider['address']); ?></span>
                    </div>
                </div>

                <div class="details-section professional-info">
                    <h3>Professional Information</h3>
                    <div class="detail-item">
                        <label>Field:</label>
                        <span><?php echo htmlspecialchars($provider['field']); ?></span>
                    </div>
                    <div class="detail-item">
                        <label>Speciality:</label>
                        <span><?php echo htmlspecialchars($provider['speciality']); ?></span>
                    </div>
                    <div class="detail-item full-width">
                        <label>Introduction:</label>
                        <span><?php echo htmlspecialchars($provider['introduction']); ?></span>
                    </div>
                    <div class="detail-item full-width">
                        <label>Service Description:</label>
                        <span><?php echo htmlspecialchars($provider['service_description']); ?></span>
                    </div>
                </div>

                <div class="details-section achievements">
                    <h3>Achievements</h3>
                    <div class="detail-item full-width">
                        <label>Certifications:</label>
                        <span><?php echo htmlspecialchars($provider['certifications']); ?></span>
                    </div>
                    <div class="detail-item full-width">
                        <label>Awards:</label>
                        <span><?php echo htmlspecialchars($provider['awards']); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
