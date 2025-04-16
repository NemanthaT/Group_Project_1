<?php
    require_once '../../config/config.php';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $sql = 'SELECT * FROM news';
        $result = $conn->query($sql);

        $data = [];

        if ($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $data[] = [
                    'id' => $row['news_id'],
                    'title' => $row['title'],
                    'description' => $row['content'],
                    'date' => $row['created_at'],
                ];
            }
            echo json_encode($data);
        }
        else{
            echo json_encode("error");
        }

    }
?>