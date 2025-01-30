<?php
session_start();

if (!isset($_SESSION['email'])) {
    // Redirect to login page if session does not have user_id
    header("Location: ../../../login/login.php");
    exit();
}
else 
{
    include '../../connect/connect.php';

    $email = $_SESSION['email'];
    $query = "SELECT client_id FROM clients WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['client_id'] = $row['client_id'];
    } else {
        // Handle case where user is not found
        header("Location: ../../../login/login.php");
        exit();
    }

    $stmt->close();
    $conn->close();

}

?>