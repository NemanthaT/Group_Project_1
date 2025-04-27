<?php
session_start();
require_once('../../../config/config.php');

$username = $_SESSION['username'];
$email = $_SESSION['email'];

if (!isset($_SESSION['username'])) { // if not logged in
    header("Location: ../../../login/login.php");
    exit;
}

// Get total earnings
$sql = "SELECT SUM(Amount) FROM bills where 
        status = 'paid' AND MONTH(paid_on) = MONTH(CURDATE()) 
        AND YEAR(paid_on) = YEAR(CURDATE())";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$totalEarnings = $row["SUM(Amount)"] ?? 0;

// Calculate annual earnings
$sql = "SELECT SUM(Amount) FROM bills where 
        status = 'paid' AND YEAR(paid_on) = YEAR(CURDATE())";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$annualEarnings = $row["SUM(Amount)"] ?? 0;

// Get user counts
$sql = "SELECT COUNT(*) FROM clients";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$clients = $row["COUNT(*)"];

$sql = "SELECT COUNT(*) FROM serviceproviders";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$serviceProviders = $row["COUNT(*)"];

$sql = "SELECT COUNT(*) FROM companyworkers";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$employees = $row["COUNT(*)"];

// Get pending requests
$sql = "SELECT COUNT(*) FROM providerrequests WHERE status = 'set'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$pendingRequests = $row["COUNT(*)"];

// Get total forums and their counts
$sql = "SELECT COUNT(*) FROM forums";
$result = $conn->query($sql);
$row1 = $result->fetch_assoc();

// Get time difference between last login and provider request and count the number of requests
$sql = "SELECT COUNT(*) FROM providerrequests WHERE createdAt > (SELECT last_logout FROM admins WHERE email = '$email')";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$pendingRN = $row["COUNT(*)"];
// Get the new forum count
$sql = "SELECT COUNT(*) FROM forums WHERE created_at > (SELECT last_logout FROM admins WHERE email = '$email')";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$newForumCount = $row["COUNT(*)"];
//Get the new paid bill count
$sql = "SELECT COUNT(*) FROM bills WHERE paid_on > (SELECT last_logout FROM admins WHERE email = '$email') AND status = 'paid'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$newPaidBillCount = $row["COUNT(*)"];
// Get the new registerd clients count
$sql = "SELECT COUNT(*) FROM clients WHERE created_at > (SELECT last_logout FROM admins WHERE email = '$email')";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$newRegisteredClientsCount = $row["COUNT(*)"];
// Get the new registerd service providers count
$sql = "SELECT COUNT(*) FROM serviceproviders WHERE created_at > (SELECT last_logout FROM admins WHERE email = '$email')";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$newRegisteredServiceProvidersCount = $row["COUNT(*)"];

if ($_SESSION['pR']!== 'none' && $pendingRN > 0) {
    $_SESSION['pR'] = $pendingRN;
}
else{
    $_SESSION['pR'] = 0;
}
if ($_SESSION['nF']!== 'none' && $newForumCount > 0) {
    $_SESSION['nF'] = $newForumCount;
}
else{
    $_SESSION['nF'] = 0;
}
if ($_SESSION['nPB']!== 'none' && $newPaidBillCount > 0) {
    $_SESSION['nPB'] = $newPaidBillCount;
}
else{
    $_SESSION['nPB'] = 0;
}
if ($_SESSION['nRC']!== 'none' && $newRegisteredClientsCount > 0) {
    $_SESSION['nRC'] = $newRegisteredClientsCount;
}
else{
    $_SESSION['nRC'] = 0;
}
if ($_SESSION['nRSP']!== 'none' && $newRegisteredServiceProvidersCount > 0) {
    $_SESSION['nRSP'] = $newRegisteredServiceProvidersCount;
}
else{
    $_SESSION['nRSP'] = 0;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="dashboard2.css">
    <link rel="stylesheet" href="../../css/preloader.css">
    <script src="../../js/preloader.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Segoe+UI:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div id="preloader">
        <div class="spinner"></div>
    </div>

    <!-- Top Navigation -->
    <!--<div class="top-nav">
            <div class="search-bar">
                <input type="text" placeholder="Search for...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="profile-info">
                <div class="notification">
                    <i class="fas fa-bell"></i>
                    <span class="badge">7</span>
                </div>
                <div class="notification">
                    <i class="fas fa-envelope"></i>
                    <span class="badge">3</span>
                </div>
                <span><?php //echo $username; ?></span>
                <img src="../../Images/profile-placeholder.png" alt="Profile">
            </div>
        </div>-->

    <div class="dashboard">
        <div id="dashboard-header">
            <h1>Dashboard</h1>
        </div>

        <!-- Stat Cards -->
        <div class="stat-cards">
            <div class="stat-card card-blue">
                <div class="stat-info">
                    <h3>Earnings (Monthly)</h3>
                    <p>Rs.<?php echo number_format($totalEarnings); ?>.00</p>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-calendar"></i>
                </div>
            </div>

            <div class="stat-card card-green">
                <div class="stat-info">
                    <h3>Earnings (Annual)</h3>
                    <p>Rs.<?php echo number_format($annualEarnings); ?>.00</p>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>

            <div class="stat-card card-teal">
                <div class="stat-info">
                    <h3>Forums</h3>
                    <p>Total: <?php echo $row1['COUNT(*)']; ?></p>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-book"></i>
                </div>
            </div>

            <div class="stat-card card-yellow">
                <div class="stat-info">
                    <h3>Pending Requests</h3>
                    <p><?php echo $pendingRequests; ?></p>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-comments"></i>
                </div>
            </div>
        </div>
        <div id="downContent">
            <div id="charts">
                <div class="chart-card">
                    <div class="chart-header">
                        <h2>User Statistics</h2>
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="chart-content">
                        <div class="users-stats">
                            <?php
                            $sql = "SELECT COUNT(*) FROM clients";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            $clients = $row["COUNT(*)"];

                            $sql = "SELECT COUNT(*) FROM serviceproviders";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            $serviceProviders = $row["COUNT(*)"];

                            $sql = "SELECT COUNT(*) FROM companyworkers";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            $employees = $row["COUNT(*)"];

                            $data = [
                                "clients" => $clients,
                                "serviceProviders" => $serviceProviders,
                                "employees" => $employees
                            ];

                            // Pass the data to JavaScript
                            echo "<script>const chartData = " . json_encode($data) . ";</script>";
                            ?>
                            <div class="users-table">
                                <div class="user-stat-row">
                                    <div class="user-stat-label">Clients</div>
                                    <div class="user-stat-value"><?php echo $clients; ?></div>
                                </div>
                                <div class="user-stat-row">
                                    <div class="user-stat-label">Service Providers</div>
                                    <div class="user-stat-value"><?php echo $serviceProviders; ?></div>
                                </div>
                                <div class="user-stat-row">
                                    <div class="user-stat-label">Employees</div>
                                    <div class="user-stat-value"><?php echo $employees; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="users-chart-container">
                            <canvas id="usersChart"></canvas>
                        </div>
                    </div>
                </div>

               <!-- Charts-->

                <div class="chart-card">
                    <div class="chart-header">
                        <h2>Earnings Overview</h2>
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <div class="chart-content">
                        <canvas id="earningsChart"></canvas>
                    </div>
                </div>
            </div>
            <div id="notifications">
                <div class="chart-header">
                    <h2>Notifications</h2>
                    <i class="fas fa-bell"></i>
                </div>
                <div class="notContent">
                    <?php
                        if($_SESSION['pR'] > 0) {
                            echo "<p id=\"notice\"><a href=\"../Requests/requests.php\" ><i class=\"fas fa-address-book\"></i>  You have ". $_SESSION['pR'] . " new provider Requests.<a/></p>";
                        }
                        if($_SESSION['nF'] > 0) {
                            echo "<p id=\"notice\"><a href=\"../Forums/forums.php\" ><i class=\"fas fa-book\"></i>  " . $_SESSION['nF'] . " new forums.<a/></p>";
                        }
                        if($_SESSION['nPB'] > 0) {
                            echo "<p id=\"notice\"><a href=\"../Reports/reports.php\" ><i class=\"fas fa-money-bill-wave\"></i>  ". $_SESSION['nPB'] ." new paid bills.<a/></p>";
                        }
                        if($_SESSION['nRC'] > 0) {
                            echo "<p id=\"notice\"><a href=\"../Users/clients/clients.php\" ><i class=\"fas fa-user\"></i>  " . $_SESSION['nRC'] . " new registered clients.<a/></p>";
                        }
                        if($_SESSION['nRSP'] > 0) {
                            echo "<p id=\"notice\"><a href=\"../Users/providers/serviceproviders.php\" ><i class=\"fas fa-user\"></i>  " . $_SESSION['nRSP'] . " new registered service providers.<a/></p>";
                        }
                        if($_SESSION['pR'] == 0 && $_SESSION['nF'] == 0 && $_SESSION['nPB'] == 0 && $_SESSION['nRC'] == 0 && $_SESSION['nRSP'] == 0) {
                            echo "<p id=\"notice\" class=\"noNoti\"><i class=\"fas fa-bell-slash\"></i>  No new notifications.</p>";
                        }
                    ?>
                </div>
            </div>
        </div>
        <!--    
                <div class="chart-card">
                    <div class="chart-header">
                        <h2>Revenue Sources</h2>
                        <div class="chart-actions">
                            <i class="fas fa-ellipsis-v"></i>
                        </div>
                    </div>
                    <div class="chart-content donut-chart-container">
                        <canvas id="revenueSourcesChart"></canvas>
                    </div>
                    <div class="chart-footer">
                        <div class="chart-legend">
                            <span style="color: #4e73df;">⬤ Direct</span>
                            <span style="color: #1cc88a;">⬤ Social</span>
                            <span style="color: #36b9cc;">⬤ Referral</span>
                        </div>
                    </div>
                </div>
            </div>-->
    </div>

    <script>
        // Earnings Chart
        /*
        /*const revenueCtx = document.getElementById('revenueSourcesChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'doughnut',
            data: {
                labels: ["Direct", "Social", "Referral"],
                datasets: [{
                    data: [55, 30, 15],
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }]
            },
            options: {
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                    }
                }
            }
        });*/
    </script>
    <script src="dashboard.js"></script>
</body>

</html>