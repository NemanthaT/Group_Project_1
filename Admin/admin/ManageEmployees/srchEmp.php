<?php
    require_once('../../config/config.php');
    $afDiv = "mainContent";
    header('Content-Type: application/json');
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $name = $_POST['name'];

        // Prepare and execute the SQL query
        $stmt = $conn->prepare("SELECT full_name, email, role  FROM companyworkers WHERE full_name LIKE ? AND status = 'set'");
        $searchTerm = "%" . $name . "%";
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();

        // Close the statement
        $stmt->close();
        if($result->num_rows > 0){
            $data = [];

            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            // Convert the data to JSON format
            $jsonData = json_encode($data);
    
            echo $jsonData;
        }
        else{
            $data ='error';
            // Convert the data to JSON format
            $jsonData = json_encode($data);

            echo $jsonData;
        }

    }
?>