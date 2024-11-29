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

        // Validate appointment date is not in the past
        $current_date = new DateTime();
        $appointment_datetime = new DateTime($appointmentDate);

        if ($appointment_datetime < $current_date) {
            $_SESSION['error'] = "Cannot update appointment to past dates";
            header('Location: appointment.php');
            exit;
        }

        $updateStmt = $conn->prepare("UPDATE appointments 
        SET appointment_date = ?, 
            service_type = ?, 
            message = ? 
        WHERE appointment_id = ? 
        AND client_id = ?");
        $updateStmt->bind_param("sssii", 
        $appointmentDate,  // appointment_date
        $serviceType,      // service_type
        $message,          // message
        $appointmentId,    // appointment_id
        $clientId          // client_id
        );
        // Debugging: Print out the variables
echo "Appointment Date: " . $appointmentDate . "<br>";
echo "Service Type: " . $serviceType . "<br>";
echo "Message: " . $message . "<br>";

        // Execute update and handle success/failure
        if ($updateStmt->execute()) {
            $_SESSION['success'] = 'appointment updated';  // Success message
        } else {
            $_SESSION['error'] = "Error updating appointment";
        }

        // header('Location: appointment.php');
        // exit;

    } catch (Exception $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
        header('Location: appointment.php');
        exit;
    }
} else {
    $_SESSION['error'] = "Invalid request method";
    header('Location: appointment.php');
    exit;
}
