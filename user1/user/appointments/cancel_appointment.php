<?php
<<<<<<< HEAD
session_start();
include '../../connect/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointmentId = $_POST['appointment_id'] ?? null;

    if ($appointmentId) {
        // Update the appointment status in the database
        $stmt = $conn->prepare("UPDATE appointments SET status = 'cancelled' WHERE appointment_id = ?");
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
=======
session_start(); // Start session at the beginning of the file
include '../../connect/connect.php';

    try {
        $appointmentId = $_POST['editAppointmentid'];
        $clientId = $_SESSION['client_id'];
        $status = "Canceled";


        $updateStmt = $conn->prepare("UPDATE appointments 
        SET  status = ?
        WHERE appointment_id = ? 
        AND client_id = ?");

        $updateStmt->bind_param("sis",
        $status,         // status
        $appointmentId,    // appointment_id
        $clientId            // client_id
        );


        // Execute update and handle success/failure
        if ($updateStmt->execute()) {
            $_SESSION['success'] = 'appointment Canceled';  // Success message
        } else {
            $_SESSION['error'] = "Error updating appointment";
        }

        header('Location: appointment.php');
        exit;

    } catch (Exception $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
        header('Location: appointment.php');
        exit;
    }

>>>>>>> 144f7277929f1003207f7d6ecc0124e700a51a54
