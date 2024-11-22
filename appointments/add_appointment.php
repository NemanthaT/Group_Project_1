<?php
session_start();
header('Content-Type: application/json');
include '../connect/connect.php';

function insertAppointment($provider_id, $client_id, $service_type, $appointment_date, $message) {
    global $conn;
    
    $status = 'Pending';
    $sql = "INSERT INTO appointments 
            (provider_id, client_id, service_type, appointment_date, message, status) 
            VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissss", $provider_id, $client_id, $service_type, $appointment_date, $message, $status);
    
    return $stmt->execute();
}

try {
    $client_id = $_SESSION['user_id'] ?? null;
    $provider_id = 1; // Default or dynamically selected

    if (!$client_id) {
        throw new Exception('User not logged in');
    }

    $service_type = $_POST['serviceSelect'] ?? '';
    $appointment_date = $_POST['appointmentDate'] ?? '';
    $message = $_POST['additionalMessage'] ?? '';

    if (empty($service_type) || empty($appointment_date)) {
        throw new Exception('Service and date are required');
    }

    $result = insertAppointment($provider_id, $client_id, $service_type, $appointment_date, $message);

    echo json_encode(['success' => $result]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>