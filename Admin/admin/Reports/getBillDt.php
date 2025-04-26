<?php

require_once('../../config/config.php');
header('Content-Type: application/json');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dayB = $_POST['dayB'];
    $dayE = $_POST['dayE'];

    if ($dayB > $dayE) {
        $_SESSION['error'] = "Enter a Valid Date Range";
        exit;
        //echo "<script>alert('Error: Invalid Date Range!');</script>";
    } else {
        // Prepare and execute the SQL query
        $stmt = $conn->prepare("SELECT Description, Bill_Date, Amount, DATE(paid_on) AS paid_on FROM bills WHERE paid_on BETWEEN ? AND ? ORDER BY paid_on DESC");
        $stmt->bind_param("ss", $dayB, $dayE);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        // Close the statement
        $stmt->close();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            echo json_encode($data);
        } else {
            echo json_encode('nodata');
        }
    }
}
?>