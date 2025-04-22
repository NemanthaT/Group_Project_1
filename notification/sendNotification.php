<?php

    require_once '../config/config.php';
    require_once 'notification.php';

    // Check if the form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form data
        $sender_id = $_POST['sender_id'];
        $sender_type = $_POST['sender_type'];
        $receiver_id = $_POST['receiver_id'];
        $receiver_type = $_POST['receiver_type'];
        $description = $_POST['description'];
        $status = $_POST['status'];

        // Validate the input data
        if(empty($sender_id) || empty($sender_type) || empty($receiver_id) || empty($receiver_type) || empty($description) || empty($status)) {
            die("All fields are required.");
        }
    } else {
        die("Invalid request method.");
    }
    $notification = new Notification($sender_id, $sender_type, $receiver_id, $receiver_type, $description, $status);
    $sql = "INSERT INTO notification (sender_id, sender_type, reciever_id, reciever_type, description, status) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $notification->sender_id, $notification->sender_type, $notification->receiver_id, $notification->receiver_type, $notification->description, $notification->status);
    if ($stmt->execute()) {
        echo "Notification sent successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
?>