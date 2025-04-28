<?php
require_once('../../../config/config.php');
header('Content-Type: application/json'); // Set JSON response


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $stmt = $conn->prepare("SELECT * FROM forums WHERE forum_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if($row['client_id']==NULL){
            $stmt = $conn->prepare("SELECT full_name FROM serviceproviders WHERE provider_id = ?");
            $stmt->bind_param("i", $row['provider_id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $row2 = $result->fetch_assoc();
            $row['full_name'] = $row2['full_name'];
            echo json_encode($row);
        }
        else{
            $stmt = $conn->prepare("SELECT full_name FROM clients WHERE client_id = ?");
            $stmt->bind_param("i", $row['client_id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $row2 = $result->fetch_assoc();
            $row['full_name'] = $row2['full_name'];
            echo json_encode($row);
        }
    } else {
        echo json_encode(["error" => "No forum found with this ID."]);
    }

    $stmt->close();
}
$conn->close();
?>