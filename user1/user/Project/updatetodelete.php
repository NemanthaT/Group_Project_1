

<?php
session_start();
include '../../connect/connect.php';
$project_id = $_GET['project_id'] ;

        $stmt = $conn->prepare("UPDATE projects SET project_status = 'delete' WHERE project_id = ?");
        $stmt->bind_param("i", $project_id);

        if ($stmt->execute()) {
            $_SESSION['success'] = 'Appointment cancelled successfully.';
        } else {
            $_SESSION['error'] = 'Failed to cancel the appointment. Please try again.';
        }

        $stmt->close();
    
    header("Location: project.php");
    exit();

?>
