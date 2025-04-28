<?php
session_start(); // Start session at the beginning of the file
include '../../connect/connect.php';

// Get appointment ID from URL
$appointment_id = isset($_GET['appointment_id']) ? $_GET['appointment_id'] : null;

if (!isset($appointment_id) || empty($appointment_id)) {
    header("Location: appointment.php?error=invalid_appointment_id");
    exit;
}

// Fetch appointment details
$stmt = $conn->prepare(
    "SELECT a.appointment_id, a.service_type, DATE(a.appointment_date) AS appointment_date, 
            a.field_name, a.message, a.status, 
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
$stmt->bind_result($id, $service, $date, $field_name, $message, $status, $provider_id, $provider_name, $provider_phone);

if ($stmt->fetch()) {
    // Data is now in variables
    // Ensure $provider_id is set, even if NULL
    $provider_id = $provider_id ?? null;
} else {
    die("Appointment not found.");
}

$stmt->close();

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $appointmentDate = $_POST['editAppointmentDate'];
        $serviceType = $_POST['editServiceSelect'];
        $fieldName = $_POST['fieldName'];
        $message = $_POST['editAdditionalMessage'] ?? '';
        $status = "Pending";
        $clientId = $_SESSION['client_id'];

        // Validate appointment date is not in the past
        $current_date = new DateTime();
        $appointment_datetime = new DateTime($appointmentDate);

        if ($appointment_datetime < $current_date) {
            $_SESSION['error'] = "Cannot update appointment to past dates";
            header('Location: appointment.php');
            exit;
        }

        // Prepare the UPDATE query
        $updateStmt = $conn->prepare("UPDATE appointments 
            SET appointment_date = ?, 
                service_type = ?,
                field_name = ?, 
                message = ?, 
                status = ? 
            WHERE appointment_id = ? 
              AND client_id = ?");
        
        // Correctly bind the parameters
        $updateStmt->bind_param(
            "sssssii", 
            $appointmentDate, 
            $serviceType,
            $fieldName,    
            $message,        
            $status,         
            $appointment_id,  
            $clientId        
        );

        // Execute update and handle success/failure
        if ($updateStmt->execute()) {
            $_SESSION['success'] = 'Appointment updated successfully.';
            header('Location: appointment.php');
            exit;
        } else {
            $_SESSION['error'] = "Error updating appointment: " . $conn->error;
            header('Location: update_appointment.php?appointment_id=' . $appointment_id);
            exit;
        }

        $updateStmt->close();

    } catch (Exception $e) {
        $_SESSION['error'] = "Exception: " . $e->getMessage();
        header('Location: update_appointment.php?appointment_id=' . $appointment_id);
        exit;
    }
}
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
    <script src="script.js"></script>

    <div class="container">
        <!-- Sidebar -->
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
                    <!-- <img src="../images/notification.png" alt="Notifications"> -->
                </a>
                <div class="profile">
                    <a href="../profile/profile.php">
                        <img src="../images/user.png" alt="Profile">
                    </a>
                </div>
                <a href="../../../Login/Logout.php" class="logout">Logout</a>
            </div>

            <!-- Appointment Content -->
            <div class="space"></div>
            <div class="main-container">
                <?php if(isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?php 
                        echo $_SESSION['error']; 
                        unset($_SESSION['error']);
                    ?>
                </div>
                <?php endif; ?>

                <?php if(isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?php 
                        echo $_SESSION['success']; 
                        unset($_SESSION['success']);
                    ?>
                </div>
                <?php endif; ?>

                    <h2>Edit Appointment</h2>
                    <form id="appointmentForm" action="update_appointment.php?appointment_id=<?php echo $id; ?>" method="POST">
                        <input type="hidden" name="appointment_id" value="<?php echo $id; ?>">
                        
                        <div class="form-group">
                            <label for="editServiceSelect">Select a Service</label>
                            <select id="editServiceSelect" name="editServiceSelect" required>
                                <option value="">Choose a Service</option>
                                <option value="Consulting" <?php echo ($service == 'Consulting') ? 'selected' : ''; ?>>Consulting</option>
                                <option value="Training" <?php echo ($service == 'Training') ? 'selected' : ''; ?>>Training</option>
                                <option value="Researching" <?php echo ($service == 'Researching') ? 'selected' : ''; ?>>Researching</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="fieldName">Field Name</label>
                            <select id="fieldName" name="fieldName" required>
                                <option value="">Choose a Field</option>
                                <option value="Development Finance" <?php echo ($field_name == 'Development Finance') ? 'selected' : ''; ?>>Development Finance</option>
                                <option value="Micro Finance" <?php echo ($field_name == 'Micro Finance') ? 'selected' : ''; ?>>Micro Finance</option>
                                <option value="Gender Finance" <?php echo ($field_name == 'Gender Finance') ? 'selected' : ''; ?>>Gender Finance</option>
                                <option value="SME Development" <?php echo ($field_name == 'SME Development') ? 'selected' : ''; ?>>SME Development</option>
                                <option value="Strategic and Operations Planning" <?php echo ($field_name == 'Strategic and Operations Planning') ? 'selected' : ''; ?>>Strategic and Operations Planning</option>
                                <option value="Institutional Development" <?php echo ($field_name == 'Institutional Development') ? 'selected' : ''; ?>>Institutional Development</option>
                                <option value="Community Development" <?php echo ($field_name == 'Community Development') ? 'selected' : ''; ?>>Community Development</option>
                                <option value="Organizational Development" <?php echo ($field_name == 'Organizational Development') ? 'selected' : ''; ?>>Organizational Development</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="editAppointmentDate">Select a Date</label>
                            <input type="date" id="editAppointmentDate" name="editAppointmentDate" value="<?php echo $date; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="editAdditionalMessage">Additional Message</label>
                            <textarea id="editAdditionalMessage" name="editAdditionalMessage" rows="4"><?php echo $message; ?></textarea>
                        </div>
                        
                        <button type="submit" id="editSaveappointmentbtn" class="btn">Save</button>
                    </form>
                </div>
            </div>
        </div>
</body>
</html>
