<?php
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

