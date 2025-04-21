<?php
    include "../config/config.php"; //connect to database
    session_start();
    if (!isset($_SESSION['email'])) {
        header("Location: ../Login/login.php"); // Redirect to login page if not logged in
        exit();
    }

    $id = $_POST['id'];

    $query = "UPDATE bills SET status = 'paid' WHERE bill_id = '$id'";
    $result = $conn->query($query);

    if ($result) {
        echo json_encode(array("status" => "success", "message" => "Payment status updated successfully."));
        header("Location: http://localhost/Group_Project_1/user1/user/bill/bill.php");
        exit();
    } else {
        echo json_encode(array("status" => "error", "message" => "Failed to update payment status."));
    }
    $conn->close();

?>