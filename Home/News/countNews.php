<?php
    require_once '../../config/config.php';
    header('Content-Type: application/json');

    $sql = 'SELECT COUNT(*) AS total FROM news';   
    $result = $conn->query($sql);
    
    if ($result) {
        $row = $result->fetch_assoc();
        echo json_encode((int)$row['total']);
    } else {
        echo json_encode(0); // Return 0 if there's an error
    }
?>