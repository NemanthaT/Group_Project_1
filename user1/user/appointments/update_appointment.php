<?php
include '../session/session.php';
include '../../connect/connect.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['appointmentId'])) {
    if (!isset($_SESSION['client_id'])) {
        echo json_encode(['success' => false, 'message' => "User not logged in"]);
        exit;
    }

    try {
        $appointmentId = $_POST['appointmentId'];
        $appointmentDate = $_POST['appointmentDate'];
        $serviceType = $_POST['serviceSelect'];
        $message = $_POST['additionalMessage'] ?? '';
        $clientId = $_SESSION['client_id'];

        // Check if appointment exists and belongs to client
        $checkStmt = $conn->prepare("SELECT provider_id FROM appointments WHERE appointment_id = ? AND client_id = ?");
        $checkStmt->bind_param("ii", $appointmentId, $clientId);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows === 0) {
            echo json_encode(['success' => false, 'message' => "Appointment not found or unauthorized"]);
            exit;
        }

        $appointment = $result->fetch_assoc();
        
        // Check if provider is assigned
        if ($appointment['provider_id'] !== null) {
            echo json_encode(['success' => false, 'message' => "Cannot edit appointment after provider assignment"]);
            exit;
        }

        // Validate appointment date
        $current_date = new DateTime();
        $appointment_datetime = new DateTime($appointmentDate);
        
        if ($appointment_datetime < $current_date) {
            echo json_encode(['success' => false, 'message' => "Cannot update appointment to past dates"]);
            exit;
        }

        // Update appointment
        $updateStmt = $conn->prepare("UPDATE appointments 
                                    SET appointment_date = ?, 
                                        service_type = ?, 
                                        message = ? 
                                    WHERE appointment_id = ? 
                                    AND client_id = ?");
        $updateStmt->bind_param("sssii", $appointmentDate, $serviceType, $message, $appointmentId, $clientId);
        
        if ($updateStmt->execute()) {
            echo json_encode(['success' => true, 'message' => "Appointment updated successfully"]);
        } else {
            echo json_encode(['success' => false, 'message' => "Error updating appointment"]);
        }

        $updateStmt->close();
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => "Error: " . $e->getMessage()]);
    }
    
    $conn->close();
}
?>