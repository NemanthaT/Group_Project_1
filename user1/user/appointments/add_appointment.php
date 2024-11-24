<?php
// Database connection and session
include '../session/session.php';
include '../../connect/connect.php';

// Set header to return JSON response
header('Content-Type: application/json');

// Function to send JSON response
function sendResponse($success, $message) {
    echo json_encode([
        'success' => $success,
        'message' => $message
    ]);
    exit;
}

// Check connection
if ($conn->connect_error) {
    sendResponse(false, "Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate session
    if (!isset($_SESSION['client_id'])) {
        sendResponse(false, "User not logged in");
    }

    // Validate required fields
    if (empty($_POST['appointmentDate']) || empty($_POST['serviceSelect'])) {
        sendResponse(false, "Required fields are missing");
    }

    try {
        $client_id = $_SESSION['client_id']; // Using client_id consistently
        $appointment_date = $_POST['appointmentDate'];
        $message = $_POST['additionalMessage'] ?? ''; // Making message optional
        $status = "pending";
        $service_type = $_POST['serviceSelect'];

        // Validate appointment date
        $current_date = new DateTime();
        $appointment_datetime = new DateTime($appointment_date);
        
        if ($appointment_datetime < $current_date) {
            sendResponse(false, "Cannot book appointment for past dates");
        }

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO appointments (client_id, appointment_date, status, message, service_type) VALUES (?, ?, ?, ?, ?)");
        
        if (!$stmt) {
            sendResponse(false, "Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("issss", $client_id, $appointment_date, $status, $message, $service_type);

        // Execute the statement
        if ($stmt->execute()) {
            sendResponse(true, "New appointment booked successfully");
        } else {
            sendResponse(false, "Error booking appointment: " . $stmt->error);
        }

        $stmt->close();
    } catch (Exception $e) {
        sendResponse(false, "Error: " . $e->getMessage());
    } finally {
        $conn->close();
    }
} else {
    sendResponse(false, "Invalid request method");
}
?>