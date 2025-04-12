<?php
require_once('../../../config/config.php');
header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['utype'])) {
        $uType = $_POST['utype'];

        $stmt = $conn->prepare("SELECT provider_id, username, email, speciality FROM serviceproviders WHERE speciality = ?");
        $stmt->bind_param("s", $uType);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        if (!empty($data)) {
            echo json_encode($data);
        } else {
            echo json_encode(["error" => "No Providers found."]);
        }

        $stmt->close();
    } else {
        echo json_encode(["error" => "Invalid request."]);
    }
} catch (Exception $e) {
    echo json_encode(["error" => "An error occurred: " . $e->getMessage()]);
}

$conn->close();
?>
