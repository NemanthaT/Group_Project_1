<?php
include '../../connect/connect.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (!isset($_SESSION['client_id'])) {
            throw new Exception("User not logged in.");
        }

        if (empty($_POST['appointmentDate']) || empty($_POST['serviceSelect'])) {
            throw new Exception("Appointment date and service type are required.");
        }

        $client_id = $_SESSION['client_id'];
        $appointment_date = $_POST['appointmentDate'];
        $message = $_POST['additionalMessage'] ?? '';
        $status = "pending";
        $service_type = $_POST['serviceSelect'];
        

        $current_date = new DateTime();
        $appointment_datetime = new DateTime($appointment_date);

        if ($appointment_datetime < $current_date) {
            throw new Exception("Cannot book an appointment for past dates.");
        }

        $stmt = $conn->prepare("INSERT INTO appointments (client_id, appointment_date, status, message, service_type) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            throw new Exception("SQL prepare failed: " . $conn->error);
        }

        $stmt->bind_param("issss", $client_id, $appointment_date, $status, $message, $service_type);

        if (!$stmt->execute()) {
            throw new Exception("Error inserting appointment: " . $stmt->error);
        }
        $_SESSION['success']="successfully added appointment";
        header('Location: appointment.php');
        exit();
    } catch (Exception $e) {
        
        $_SESSION['error']=$e->getMessage();
        header('Location: appointment.php' );
        exit();
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
        $conn->close();
    }
} else {
    header('Location: appointment.php?');
    exit();
}
?>
