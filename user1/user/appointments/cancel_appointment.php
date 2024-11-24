<?php
include '../session/session.php';
include '../../connect/connect.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (!isset($data['appointmentId'])) {
            throw new Exception("Appointment ID not provided");
        }

        $appointmentId = $data['appointmentId'];
        $clientId = $_SESSION['client_id'];

        // Check if appointment exists and can be cancelled
        $checkStmt = $conn->prepare("SELECT status, provider_id 
                                   FROM appointments 
                                   WHERE appointment_id = ? AND client_id = ?");
        $checkStmt->bind_param("ii", $appointmentId, $clientId);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception("Appointment not found or unauthorized");
        }

        $appointment = $result->fetch_assoc();
        
        // Validate cancellation conditions
        if ($appointment['provider_id'] === null) {
            throw new Exception("Cannot cancel appointment without provider assignment");
        }

        if ($appointment['status'] === 'cancelled') {
            throw new Exception("Appointment is already cancelled");
        }

        // Update status to cancelled
        $updateStmt = $conn->prepare("UPDATE appointments 
                                    SET status = 'cancelled' 
                                    WHERE appointment_id = ? AND client_id = ?");
        $updateStmt->bind_param("ii", $appointmentId, $clientId);
        
        if ($updateStmt->execute()) {
            echo json_encode([
                'success' => true,
                'message' => "Appointment cancelled successfully"
            ]);
        } else {
            throw new Exception("Error cancelling appointment");
        }

            $updateStmt->close();
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    ?>