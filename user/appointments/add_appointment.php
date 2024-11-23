<?php
// Database connection
include '../session/session.php';


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $client_id = $_SESSION['client_id'];
    $appointment_date = $_POST['appointmentDate'];
    $message = $_POST['additionalMessage'];
    $status = "pending";
    $service_type = $_POST['serviceSelect'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO appointments (client_id, appointment_date,status, message,service_type) VALUES (?, ?, ?, ?,?)");
    $stmt->bind_param("issss", $user_id, $appointment_date, $status, $message, $service_type);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New appointment booked successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

