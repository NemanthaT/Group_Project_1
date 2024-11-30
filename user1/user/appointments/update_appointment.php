<?php
session_start(); // Start session at the beginning of the file
include '../../connect/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editAppointmentid'])) {
    // Check if user is logged in
    if (!isset($_SESSION['client_id'])) {
        $_SESSION['error'] = "User not logged in";
        header('Location: appointment.php');
        exit;
    }

    try {
        $appointmentId = $_POST['editAppointmentid'];
        $appointmentDate = $_POST['editAppointmentDate'];
        $serviceType = $_POST['editServiceSelect'];
        $message = $_POST['editAdditionalMessage'] ?? '';
        $clientId = $_SESSION['client_id'];
        $status = "Pending";

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
                message = ?, 
                status = ? 
            WHERE appointment_id = ? 
              AND client_id = ?");
        
        // Correctly bind the parameters
        $updateStmt->bind_param(
            "ssssii", 
            $appointmentDate, // appointment_date (string)
            $serviceType,     // service_type (string)
            $message,         // message (string)
            $status,          // status (string)
            $appointmentId,   // appointment_id (integer)
            $clientId         // client_id (integer)
        );

        // Execute update and handle success/failure
        if ($updateStmt->execute()) {
            $_SESSION['success'] = 'Appointment updated successfully.';  // Success message
        } else {
            $_SESSION['error'] = "Error updating appointment.";
        }

        $updateStmt->close(); // Close statement
        $conn->close();       // Close connection

        header('Location: appointment.php');
        exit;

    } catch (Exception $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
        header('Location: appointment.php');
        exit;
    }
} else {
    $_SESSION['error'] = "Invalid request method.";
    header('Location: appointment.php');
    exit;
}
