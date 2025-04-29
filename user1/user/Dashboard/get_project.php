`<?php
include '../../connect/connect.php';

$client_id = $_SESSION['client_id'];

$sql = "SELECT * FROM `projects` where client_id= '$client_id' ORDER BY project_id desc LIMIT 4";

$result = $conn->query($sql);

if ($result === false) {
    echo "Error: " . $conn->error;
} else {
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
                  
            echo '  <div class="list-item">
                    <span>'.htmlspecialchars($row["project_description"]).'</span>
                    <span class="status-badge status-' . strtolower($row["project_status"]) . '">' . 
                        ucfirst(strtolower($row["project_status"])) . '</span>
                </div>';
        }
    } else {
        echo '<div class="list-item">No appointments found</div>';
    }
}

$conn->close();
?>