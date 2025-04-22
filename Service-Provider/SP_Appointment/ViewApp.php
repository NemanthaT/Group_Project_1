<?php
include '../Session/Session.php';
include '../connection.php';

// Check if appointment ID is provided
if (isset($_GET['id'])) {
    $appointment_id = $_GET['id'];
    
    // Fetch appointment details
    $query = "SELECT appointment_id, provider_id, client_id, appointment_date, status, created_at, service_type, message 
              FROM appointments 
              WHERE appointment_id = ?";
    
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
                    <div class="appointment-title">Appointment ID <?php echo htmlspecialchars($appointment['appointment_id']); ?></div>
                    <div class="status-badge status-<?php echo strtolower($appointment['status']); ?>">
                        <?php echo htmlspecialchars($appointment['status']); ?>
                    </div>
                </div>
                <div class="appointment-info">
                    <div class="detail-row">
                        <div class="detail-label">Provider ID:</div>
                        <div class="detail-value"><?php echo htmlspecialchars($appointment['provider_id']); ?></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Client ID:</div>
                        <div class="detail-value"><?php echo htmlspecialchars($appointment['client_id']); ?></div>
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
                <button class="back-button" onclick="window.location.href='App.php'">Back to Appointments</button>
            </div>                   
        </div>
    </div>  <!--this is the </div> of container in the common file, don't remove it-->
<script src="App.js"></script>
</body>
</html>