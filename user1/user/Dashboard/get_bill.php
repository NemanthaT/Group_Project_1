<?php 
include '../../connect/connect.php';

$client_id = $_SESSION['client_id'];

    $sql = "SELECT b.bill_id, b.Description, b.Bill_Date, b.Amount, b.status, b.project_id, p.project_name
        FROM bills b
        JOIN projects p ON b.project_id = p.project_id
        WHERE p.client_id = ?" . " ORDER BY b.Bill_Date DESC LIMIT 4";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $client_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $bill_id = $row['bill_id'];
            $description = htmlspecialchars($row['Description']);
            $bill_date = date("F d, Y", strtotime($row['Bill_Date']));
            $amount = number_format($row['Amount'], 2);
            $status = htmlspecialchars($row['status']);
            $project_name = htmlspecialchars($row['project_name']);

            echo '<div class="list-item">
                    <span>' . $description . '</span>
                    <span>' . $amount . '</span>
                    <span class="status-badge status-' . strtolower($status) . '">' . ucfirst(strtolower($status)) . '</span>
                </div>';
        }
    } else {
        echo '<div class="list-item">No bills found</div>';
    }
    $stmt->close();    

        ?>