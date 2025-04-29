<?php
include '../Session/Session.php';
include '../connection.php';
include '../Common template/SP_common.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['appointment_id'], $_POST['status'])) {
    $appointmentId = intval($_POST['appointment_id']); 
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE appointments SET status = ? WHERE appointment_id = ?");
    $stmt->bind_param("si", $status, $appointmentId);

    if ($stmt->execute()) {
        $message = "Appointment status updated successfully!";
    } else {
        $message = "Failed to update appointment status.";
    }

    $stmt->close();

    header("Location: " . $_SERVER['REQUEST_URI']);
    exit;
}

$providerId = $_SESSION['provider_id'];
$sql = "SELECT a.appointment_id, a.provider_id, a.client_id, DATE(a.appointment_date) AS appointment_date, a.status, a.created_at, c.full_name 
        FROM appointments a 
        JOIN clients c ON a.client_id = c.client_id 
        WHERE a.provider_id = ? 
        ORDER BY a.appointment_date ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $providerId);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka Consultancy</title>
    <link rel="stylesheet" href="../Common template/SP_common.css">
    <link rel="stylesheet" href="App.css">
</head>
<body>        
    <div class="main-content">
        <div class="appointment-section">
            <center><h2>Appointments</h2></center>
            <div class="appointment-controls">
                <input type="date" id="appointmentDateFilter" placeholder="Filter by Appointment Date" onchange="filterAndSortAppointments()">
                    <select id="statusSort" onchange="filterAndSortAppointments()">
                        <option value="">Sort by Status</option>
                        <option value="assigned">Assigned</option>
                        <option value="scheduled">Scheduled</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="rejected">Rejected</option>
                        </select>
                        <button class="clear-button" onclick="clearFilters()">Clear</button>
            </div>
            <div class="table-container">
                <table class="appointment-table">
                    <thead>
                        <tr>
                            <th>Client Name</th>
                            <th>Appointment Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="appointment-tbody">
                    <?php
                    if ($result && $result->num_rows > 0) {
                    $result->data_seek(0);
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr onclick=\"window.location='ViewApp.php?id=" . htmlspecialchars($row['appointment_id']) . "'\">";
                        echo "<td>" . htmlspecialchars($row['full_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['appointment_date']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                        echo "<td onclick=\"event.stopPropagation();\">"; 

                    $status = strtolower($row['status']);
                        if ($status === 'assigned') {
                            echo "<form method='POST' style='display: inline;' onsubmit=\"return confirm('Are you sure you want to accept this appointment?');\">";
                            echo "<input type='hidden' name='appointment_id' value='" . htmlspecialchars($row['appointment_id']) . "'>";
                            echo "<input type='hidden' name='status' value='Scheduled'>";
                            echo "<button type='submit' class='accept-btn'>Accept</button>";
                            echo "</form>";

                            echo "<form method='POST' style='display: inline;' onsubmit=\"return confirm('Are you sure you want to reject this appointment?');\">";
                            echo "<input type='hidden' name='appointment_id' value='" . htmlspecialchars($row['appointment_id']) . "'>";
                            echo "<input type='hidden' name='status' value='Rejected'>";
                            echo "<button type='submit' class='reject-btn'>Reject</button>";
                            echo "</form>";
                        } elseif ($status === 'scheduled') {
                            echo "<form method='POST' style='display: inline;' onsubmit=\"return confirm('Are you sure you want to cancel this appointment?');\">";
                            echo "<input type='hidden' name='appointment_id' value='" . htmlspecialchars($row['appointment_id']) . "'>";
                            echo "<input type='hidden' name='status' value='Cancelled'>";
                            echo "<button type='submit' class='cancel-btn'>Cancel</button>";
                            echo "</form>";

                        } elseif ($status === 'rejected' || $status === 'cancelled' || $status === 'completed') {
                            echo "<span class='status-text " . $status . "'>" . ucfirst($status) . "</span>";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                    } else {
                        echo "<tr><td colspan='4'>No appointments found</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>                  
    </div>   
</div>  
<script src="App.js"></script>
<script src="../Common template/Calendar.js"></script>
</body>
</html>