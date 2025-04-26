<?php
    require_once '../../config/config.php';
    header('Content-Type: application/json');
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $offset = isset($_POST['offset']) ? (int)$_POST['offset'] : 0;
        $limit = 8; // Items per page
        
        $sql = "SELECT * FROM news ORDER BY news_id DESC LIMIT ? OFFSET ?";   
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $data[] = [
                    'id' => $row['news_id'],
                    'title' => $row['title'],
                    'description' => $row['content'],
                    'date' => $row['created_at'],
                ];
            }
        }
        
        echo json_encode($data ? $data : "error");
    }
?>