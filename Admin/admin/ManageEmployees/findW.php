<?php
require_once('../../../config/config.php');
header('Content-Type: application/json'); 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);

    $stmt = $conn->prepare("SELECT * FROM companyworkers WHERE worker_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo json_encode($row);
    } else {
        echo json_encode(["error" => "No Workers found with this ID."]);
    }

    $stmt->close();
}
$conn->close();
?>