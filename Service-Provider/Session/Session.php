<?php
session_start();

if (!isset($_SESSION['email'])) {
    // Redirect to login page if session does not have user_id
    header("Location: ../Login/login.php");
    exit();
}
else 
{
    include '../connection.php';

    $email = $_SESSION['email'];
    $query = "SELECT provider_id FROM serviceproviders WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['provider_id'] = $row['provider_id'];
    } else {
        // Handle case where user is not found
        header("Location: ../Login/login.php");
        exit();
    }
    $stmt->close();
    $conn->close();
}
?>