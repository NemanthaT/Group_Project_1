<?php
session_start();
include '../../connect/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointmentId = $_POST['appointment_id'] ?? null;

    if ($appointmentId) {
        $stmt = $conn->prepare("UPDATE appointments SET status = 'Cancelled' WHERE appointment_id = ?");
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

    header("Location: appointment.php");
    exit();
}
?>
