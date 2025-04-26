<?php
include '../session/session.php';
include '../../connect/connect.php';

$appointment_id = $_GET['appointment_id'];

// Fetch appointment and provider details in one query
$stmt = $conn->prepare(
    "SELECT a.appointment_id, a.service_type, DATE(a.appointment_date) AS appointment_date, a.message, a.status, 
            p.provider_id, p.full_name, p.phone 
    FROM appointments a 
    LEFT JOIN serviceproviders p ON a.provider_id = p.provider_id 
    WHERE a.appointment_id = ?"
);

// Check if prepare succeeded
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("i", $appointment_id);
$stmt->execute();
$stmt->bind_result($id, $service, $date, $message, $status, $provider_id, $provider_name, $provider_phone);

if ($stmt->fetch()) {
    // Data is now in variables
    // Ensure $provider_id is set, even if NULL
    $provider_id = $provider_id ?? null;
} else {
    die("Appointment not found.");
}
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
                    <button>
                        <img src="../images/dashboard.png" alt="Dashboard">
                        Dashboard
                    </button>
                </a>
            </li>
            <li>
                <a href="../appointments/appointment.php">
                    <button class="active">
                        <img src="../images/appointment.png" alt="Appointment">
                        Appointment
                    </button>
                </a>
            </li>
            <li>
                <a href="../Project/project.php">
                    <button>
                        <img src="../images/project.png" alt="project">
                        Projects
                    </button>
                </a>
            </li>
            <li>
                <a href="../bill/bill.php">
                    <button>
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
            <li>
                <a href="../Message/Message.php">
                    <button>
                        <img src="../images/Message.png" alt="Message">
                        Message
                    </button>
                </a>
            </li>
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

        <div class="space"></div>
        <div style="max-width: 800px; margin: 40px auto; background-color: #ffffff; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); padding: 30px;">
            <h2 style="color: #2c3e50; text-align: center; margin-bottom: 30px; font-size: 28px; border-bottom: 2px solid #eaeaea; padding-bottom: 15px;">Appointment Details</h2>
            
            <table style="width: 100%; border-collapse: collapse; margin: 20px 0; border-radius: 8px; overflow: hidden;">
                <tr>
                    <th style="padding: 15px; text-align: left; border: 1px solid #e9ecef; background-color: #f8f9fa; color: #495057; font-weight: 600;">Service</th>
                    <td style="padding: 15px; border: 1px solid #e9ecef; color: #495057;"><?= htmlspecialchars($service) ?></td>
                </tr>
                <tr style="background-color: #f8f9fa;">
                    <th style="padding: 15px; text-align: left; border: 1px solid #e9ecef; color: #495057; font-weight: 600;">Appointment Date</th>
                    <td style="padding: 15px; border: 1px solid #e9ecef; color: #495057;"><?= htmlspecialchars($date) ?></td>
                </tr>
                <tr>
                    <th style="padding: 15px; text-align: left; border: 1px solid #e9ecef; background-color: #f8f9fa; color: #495057; font-weight: 600;">Message</th>
                    <td style="padding: 15px; border: 1px solid #e9ecef; color: #495057;"><?= htmlspecialchars($message) ?></td>
                </tr>
                <tr style="background-color: #f8f9fa;">
                    <th style="padding: 15px; text-align: left; border: 1px solid #e9ecef; color: #495057; font-weight: 600;">Status</th>
                    <td style="padding: 15px; border: 1px solid #e9ecef; color: #495057;">
                        <span style="background-color: #dff0d8; color: #3c763d; padding: 5px 10px; border-radius: 4px; font-size: 14px;"><?= htmlspecialchars($status) ?></span>
                    </td>
                </tr>
                <tr>
                    <th style="padding: 15px; text-align: left; border: 1px solid #e9ecef; background-color: #f8f9fa; color: #495057; font-weight: 600;">Provider Name</th>
                    <td style="padding: 15px; border: 1px solid #e9ecef; color: #495057;"><?= htmlspecialchars($provider_name ?? 'Not Assigned') ?></td>
                </tr>
                <tr style="background-color: #f8f9fa;">
                    <th style="padding: 15px; text-align: left; border: 1px solid #e9ecef; color: #495057; font-weight: 600;">Provider Phone</th>
                    <td style="padding: 15px; border: 1px solid #e9ecef; color: #495057;"><?= htmlspecialchars($provider_phone ?? 'N/A') ?></td>
                </tr>
            </table>
            
            <div style="text-align: center; margin-top: 40px;">
                <?php if (isset($provider_id) && $provider_id): ?>
                    <a href="../Message/Message.php?provider_id=<?= htmlspecialchars($provider_id) ?>" style="display: inline-block; background-color: #28a745; color: white; text-decoration: none; padding: 12px 30px; border-radius: 50px; font-size: 16px; font-weight: 500; transition: all 0.3s ease; box-shadow: 0 4px 6px rgba(40, 167, 69, 0.2);">Chat with Provider</a>
                <?php endif; ?>
            </div>
            
            <div style="margin-top: 40px; text-align: center; color: #6c757d; font-size: 14px; border-top: 1px solid #eaeaea; padding-top: 20px;">
                <p>If you need to reschedule or cancel this appointment, please contact us at least 24 hours in advance.</p>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>