<?php
include '../../connect/connect.php';

// Query to get upcoming appointments
$sql = "SELECT a.appointment_date, a.status, a.service_type, c.full_name AS client_name
FROM appointments a
JOIN clients c ON a.client_id = c.client_id
WHERE a.appointment_date >= NOW() 
AND a.status != 'Deleted'
ORDER BY a.appointment_date ASC
LIMIT 4";

$result = $conn->query($sql);

// Check if query was successful
if ($result === false) {
    echo "Error: " . $conn->error;
} else {
    // Now it's safe to check num_rows
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Format date
            $appointment_date = date("d M, g:i A", strtotime($row["appointment_date"]));
            
            echo '<div class="list-item">
                    <div class="appointment-details">
                        <strong>' . htmlspecialchars($row["service_type"]) . '</strong>
                        <span class="appointment-time">' . $appointment_date . '</span>
                    </div>
                    <span class="status-badge status-' . strtolower($row["status"]) . '">' . 
                        ucfirst(strtolower($row["status"])) . '</span>
                  </div>';
        }
    } else {
        echo '<div class="list-item">No appointments found</div>';
    }
}

$conn->close();
?>

