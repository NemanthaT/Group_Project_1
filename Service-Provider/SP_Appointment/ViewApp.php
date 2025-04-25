<?php
include '../Session/Session.php';
include '../connection.php';

// Check if appointment ID is provided
if (isset($_GET['id'])) {
    $appointment_id = $_GET['id'];
    
    // Fetch appointment details with client name
    $query = "SELECT a.appointment_id, a.client_id, a.appointment_date, a.status, a.created_at, a.service_type, a.message, c.full_name 
              FROM appointments a
              LEFT JOIN clients c ON a.client_id = c.client_id
              WHERE a.appointment_id = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $appointment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $appointment = $result->fetch_assoc();
    } else {
        echo "<script>alert('Appointment not found!'); window.location.href='App.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('No appointment ID provided!'); window.location.href='App.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka Consultancy</title>
    <?php include '../Common template/SP_common.php'; ?>
    <link rel="stylesheet" href="../Common template/SP_common.css">
    <link rel="stylesheet" href="App.css">
</head>
<body> 
        <div class="main-content">
            <div class="appointment-section">
                <div class="appointment-header">
                <div class="back-link">
                    <a href="App.php">← Back to Appointments</a>
                </div>
                    <div class="appointment-title">Appointment ID <?php echo htmlspecialchars($appointment['appointment_id']); ?></div>
                    <div class="status-badge status-<?php echo strtolower($appointment['status']); ?>">
                        <?php echo htmlspecialchars($appointment['status']); ?>
                    </div>
                </div>
                <div class="appointment-info">
<<<<<<< HEAD
 
                    <br>
=======
>>>>>>> 46029a9be75fff547bf5c00c49cf5ed405dd1e0d
                    <div class="detail-row">
                        <div class="detail-label">Client ID:</div>
                        <div class="detail-value"><?php echo htmlspecialchars($appointment['client_id']); ?></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Client Name:</div>
                        <div class="detail-value"><?php echo htmlspecialchars($appointment['full_name'] ?? 'Not specified'); ?></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Appointment Date:</div>
                        <div class="detail-value"><?php echo htmlspecialchars($appointment['appointment_date']); ?></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Created At:</div>
                        <div class="detail-value"><?php echo htmlspecialchars($appointment['created_at']); ?></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Service Type:</div>
                        <div class="detail-value"><?php echo htmlspecialchars($appointment['service_type']); ?></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Message:</div>
                        <div class="detail-value"><?php echo htmlspecialchars($appointment['message'] ?? 'Not specified'); ?></div>
                    </div>
                </div>
                <button class="chat-button" onclick="window.location.href='../SP_Message/Message.php?client_id=<?php echo htmlspecialchars($appointment['client_id']); ?>'">Chat</button>
            </div>                   
        </div>
    </div>  <!--this is the </div> of container in the common file, don't remove it-->
<script src="App.js"></script>
<script src="../Common template/Calendar.js"></script>
</body>
</html>