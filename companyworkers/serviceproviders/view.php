<?php
session_start();

// Check if user is logged in and is a company worker
if (!isset($_SESSION['userType']) || $_SESSION['userType'] !== 'companyworkers') {
    header("Location: ../../Login/login.php");
    exit();
}

require_once '../connect.php';

// Get the logged in user's details
$email = $_SESSION['email'];
$query = "SELECT * FROM companyworkers WHERE email = '$email'";
$result = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($result);
$fullName = $user['full_name'];
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
                    <button class="active">
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

    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard-grid">
            <div class="dashboard-card" style="grid-column: span 2;">
                <!-- Add Filter Controls -->
                <div class="filter-controls">
                    <form method="GET" class="filter-form">
                        <select name="speciality" class="filter-select">
                            <option value="">All Specialities</option>
                            <option value="Training" <?php echo isset($_GET['speciality']) && ($_GET['speciality'] == 'Training' || $_GET['speciality'] == 'Trainer') ? 'selected' : ''; ?>>Trainer/Training</option>
                            <option value="Research" <?php echo isset($_GET['speciality']) && ($_GET['speciality'] == 'Research' || $_GET['speciality'] == 'Researcher') ? 'selected' : ''; ?>>Researcher/Research</option>
                            <option value="Consultant" <?php echo isset($_GET['speciality']) && $_GET['speciality'] == 'Consultant' ? 'selected' : ''; ?>>Consultant</option>
                        </select>
                        
                        <select name="field" class="filter-select">
                            <option value="">All Fields</option>
                            <option value="Development Finance" <?php echo isset($_GET['field']) && $_GET['field'] == 'Development Finance' ? 'selected' : ''; ?>>Development Finance</option>
                            <option value="Micro Finance" <?php echo isset($_GET['field']) && $_GET['field'] == 'Micro Finance' ? 'selected' : ''; ?>>Micro Finance</option>
                            <option value="Organizational Development" <?php echo isset($_GET['field']) && $_GET['field'] == 'Organizational Development' ? 'selected' : ''; ?>>Organizational Development</option>
                            <option value="SME Development" <?php echo isset($_GET['field']) && $_GET['field'] == 'SME Development' ? 'selected' : ''; ?>>SME Development</option>
                            <option value="Gender Finance" <?php echo isset($_GET['field']) && $_GET['field'] == 'Gender Finance' ? 'selected' : ''; ?>>Gender Finance</option>
                            <option value="Institutional Development" <?php echo isset($_GET['field']) && $_GET['field'] == 'Institutional Development' ? 'selected' : ''; ?>>Institutional Development</option>
                            <option value="Community Development" <?php echo isset($_GET['field']) && $_GET['field'] == 'Community Development' ? 'selected' : ''; ?>>Community Development</option>
                            <option value="Strategic and Operational Planning" <?php echo isset($_GET['field']) && $_GET['field'] == 'Strategic and Operational Planning' ? 'selected' : ''; ?>>Strategic and Operational Planning</option>
                        </select>
                        
                        <button type="submit" class="filter-button">Filter</button>
                        <a href="view.php" class="reset-button">Reset</a>
                    </form>
                </div>

                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Field</th>
                                <th>Speciality</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once '../connect.php';
                            $query = "SELECT * FROM serviceproviders WHERE status='set'";
                            
                            $conditions = array();
                            
                            // Modified filter conditions
                            if (!empty($_GET['speciality'])) {
                                $speciality = mysqli_real_escape_string($con, $_GET['speciality']);
                                if ($speciality == 'Training') {
                                    $conditions[] = "(speciality = 'Training' OR speciality = 'Trainer')";
                                } elseif ($speciality == 'Research') {
                                    $conditions[] = "(speciality = 'Research' OR speciality = 'Researcher')";
                                } else {
                                    $conditions[] = "speciality = '$speciality'";
                                }
                            }
                            if (!empty($_GET['field'])) {
                                $field = mysqli_real_escape_string($con, $_GET['field']);
                                $conditions[] = "field = '$field'";
                            }
                            
                            // Combine all conditions
                            if (!empty($conditions)) {
                                $query .= " AND " . implode(" AND ", $conditions);
                            }
                            
                            $result = mysqli_query($con, $query);
                            
                            if ($result && mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['full_name']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['field']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['speciality']) . "</td>";
                                    echo "<td><button class='view-btn'><a href='details.php?id=" . $row['provider_id'] . "'>View</a></button></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6' style='text-align: center;'>No service providers found</td></tr>";
                            }
                            mysqli_close($con);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
