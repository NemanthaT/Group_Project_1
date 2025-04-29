<?php

require_once('../../config/config.php');
header('Content-Type: application/json');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = $_POST['status'];

    if ($status == 'paid') {
        $data = 'paid';
        echo json_encode($data);
        exit;
        
    } else {
        
        $stmt = $conn->prepare("SELECT * FROM bills WHERE status = ? ORDER BY BIll_Date DESC");
        $stmt->bind_param("s", $status);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        
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