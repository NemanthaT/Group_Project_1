<?php
session_start();
include '../../connect/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointmentId = $_POST['appointment_id'] ?? null;

    if ($appointmentId) {
        // Update the appointment status in the database
        $stmt = $conn->prepare("UPDATE appointments SET status = 'Deleted' WHERE appointment_id = ?");
        $stmt->bind_param("i", $appointmentId);

        if ($stmt->execute()) {
            $_SESSION['success'] = 'Appointment cancelled successfully.';
        } else {
            $_SESSION['error'] = 'Failed to cancel the appointment. Please try again.';
        }

        $stmt->close();
    } else {
        $_SESSION['error'] = 'Invalid appointment ID.';
    }

    // Redirect back to the previous page
    header("Location: appointment.php"); // Adjust this to the correct page
    exit();
}
?>
