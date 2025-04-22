<?php
include '../Session/Session.php';
include '../connection.php';
$sp_email=$_SESSION['email'];
$sql= "SELECT PROVIDER_ID fROM serviceproviders WHERE email= ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $sp_email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$providerId = $row['PROVIDER_ID'];
$_SESSION['provider_id'] = $providerId; 
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka Consultancy</title>
    <?php include '../Common template/SP_common.php'; ?>
    <link rel="stylesheet" href="../Common template/SP_common.css">
    <link rel="stylesheet" href="SPDash.css">
</head>
<body> 
        <div class="main-content">
            <div class="dashboard-section">
            <!-- Left Section (Wider) -->
                <div class="left-section">
                <!-- Four Cards in One Row -->
                    <div class="cards-row">
                        <div class="card">
                            <h3>Projects</h3>
                            <p>Assigned Projects: 14</p>
                            <p>Ongoing Projects: 8</p>
                            <p>Completed Projects: 6</p>
                        </div>

                        <div class="card">
                            <h3>Appointments</h3>
                            <p>No. of Appointments: 9</p>
                            <p>Scheduled: 5</p>
                            <p>Rejected: 2</p>
                            <p>Cancelled: 2</p>
                        </div>

                        <div class="card">
                            <h3>Transactions</h3>
                            <p>Total Transactions: 23</p>
                            <p>Pending: 4</p>
                            <p>Completed: 19</p>
                        </div>

                        <div class="card">
                            <h3>Payments</h3>
                            <p>Recent Payments: 6</p>
                            <p>Upcoming: 2</p>
                            <p>Overdue: 1</p>
                        </div>
                    </div>

                    <!-- Appointment History -->
                    <div class="card appointment-history">
                        <h3>Appointment History</h3>
                        <p>John Doe - 12th Feb - Completed</p>
                        <p>Jane Smith - 14th Feb - Pending</p>
                        <p>Robert Brown - 15th Feb - Cancelled</p>
                    </div>
                </div>

                <!-- Right Section (Narrower) -->
                <div class="right-section">
                    <!-- Clock -->
                    <div class="card clock-card">
                        <h3>Current Time</h3>
                    <div id="time">Loading...</div>
                    </div>

                    <!-- Payment History -->
                    <div class="card payment-history">
                        <h3>Payment History</h3>
                        <p>Electric Bill - $221 - Completed</p>
                        <p>Water Bill - $189 - Completed</p>
                        <p>Internet Bill - $75 - Pending</p>
                    </div>
                </div>
            </div>
        </div>
    </div>   <!--this is the </div> of container in the common file, don't remove it-->
<script src="SPDash.js"></script>
<script src="../Common template/Calendar.js"></script>
</body>
</html>