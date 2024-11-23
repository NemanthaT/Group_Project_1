<?php
// Database connection
include '../../connect/connect.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $appointment_date = $_POST['appointmentDate'];
    $additionalMessage = $_POST['additionalMessage'];
    $description = $_POST['description'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO appointments (user_id, appointment_date, appointment_time, description) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $user_id, $appointment_date, $appointment_time, $description);

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

