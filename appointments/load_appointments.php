<?php
session_start();
header('Content-Type: application/json');
include '../connect/connect.php';
$client_id=1;

function getUserAppointments($client_id) {
    global $conn;
    
    $sql = "SELECT * FROM appointments 
            WHERE client_id = ? 
            ORDER BY created_at DESC";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $client_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $appointments = [];
    while($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }
    
    return $appointments;
}

try {

    // $client_id = $_SESSION['user_id'] ?? null;
     $client_id = 1;
    if (!$client_id) {
        throw new Exception('User not logged in');
    }
    
    // $appointments = getUserAppointments($client_id);
    $appointments = getUserAppointments(1);

    echo json_encode($appointments);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>