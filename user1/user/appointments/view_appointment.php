<?php
function getProviderDetails($provider_id, $conn) {
    $stmt = $conn->prepare("SELECT full_name, phone FROM provider WHERE provider_id = ?");
    $stmt->bind_param("i", $provider_id);
    $stmt->execute();
    $stmt->bind_result($full_name, $phone);
    if ($stmt->fetch()) {
        return [
            'full_name' => $full_name,
            'phone' => $phone
        ];
    } else {
        return null;
    }
    $stmt->close();
}
?>
