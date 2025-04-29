<?php
require_once('../../../../config/config.php');
header('Content-Type: application/json'); 


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $stmt = $conn->prepare("DELETE FROM serviceproviders WHERE provider_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo json_encode($row);
    } else {
        echo json_encode(["error" => "No Provider found with this ID."]);
    }

    $stmt->close();
}
$conn->close();
?>