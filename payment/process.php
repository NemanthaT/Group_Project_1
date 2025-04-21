<?php
    include "../config/config.php"; //connect to database
    session_start();
    if (!isset($_SESSION['email'])) {
        header("Location: ../Login/login.php"); // Redirect to login page if not logged in
        exit();
    }

    $input = json_decode(file_get_contents("php://input"), true);

    $project_id = $input['bill_id'];

    $query = "UPDATE bills SET status = 'Paid' WHERE bill_id = '$project_id'";
    $result = $conn->query($query);

    if ($result) {
        header("Location: http://localhost/Group_Project_1/payment/sample.php");
        echo json_encode(array("status" => "success", "message" => "Payment status updated successfully."));
        exit();
    } else {
        echo json_encode(array("status" => "error", "message" => "Failed to update payment status."));
    }
    $conn->close();

?>