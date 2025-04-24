<?php
    include "../config/config.php"; //connect to database
    header('Content-Type: application/json');

    session_start();
    if (!isset($_SESSION['email'])) {
        header("Location: ../Login/login.php"); // Redirect to login page if not logged in
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
        $id = intval($_POST['id']);

        $query = "UPDATE bills SET status = 'paid' WHERE bill_id = '$id'";
        $query2 = "UPDATE bills SET paid_on = NOW() WHERE bill_id = '$id'";
        
        $result = $conn->query($query);
        $result2 = $conn->query($query2);

        if ($result && $result2) {
            echo json_encode("Success");
            exit();
        } else {
            echo json_encode("Error");
        }
        $conn->close();
    }
    echo json_encode("Invalid Request");
    exit();
?>