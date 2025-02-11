<?php
include '../../connect/connect.php';

// Get search input
$search = $_POST['searchInput'] ?? '';

// Prepare the SQL query
if ($search === '') {
    // Query to fetch all appointments for the client
    $sql = "SELECT a.*, p.full_name 
            FROM appointments a 
            LEFT JOIN serviceproviders p ON a.provider_id = p.provider_id 
            WHERE a.client_id = ? And a.status != 'Deleted'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_SESSION['client_id']);
} else {
    // Query to fetch appointments based on search input (appointment_id)
    $sql = "SELECT a.*, p.full_name 
            FROM appointments a 
            LEFT JOIN serviceproviders p ON a.provider_id = p.provider_id 
            WHERE a.client_id = ? AND a.appointment_id = ? And a.status != 'Deleted'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $_SESSION['client_id'], $search);
}

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();
$users = $result->fetch_all(MYSQLI_ASSOC); // Fetch all results as associative array
?>
