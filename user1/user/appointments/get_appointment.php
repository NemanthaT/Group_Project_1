<?php
include '../session/session.php';
include '../../connect/connect.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    try {
        $appointmentId = $_GET['id'];
        $clientId = $_SESSION['client_id'];

        $stmt = $conn->prepare("SELECT a.*, p.provider_name 
                               FROM appointments a 
                               LEFT JOIN providers p ON a.provider_id = p.provider_id 
                               WHERE a.appointment_id = ? AND a.client_id = ?");
        $stmt->bind_param("ii", $appointmentId, $clientId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $appointment = $result->fetch_assoc();
            echo json_encode([
                'success' => true,
                'appointment' => $appointment
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => "Appointment not found"
            ]);
        }

        $stmt->close();
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => "Error: " . $e->getMessage()
        ]);
    }
    
    $conn->close();
}
?>