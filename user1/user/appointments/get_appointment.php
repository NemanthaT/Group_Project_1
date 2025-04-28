<?php
include '../../connect/connect.php';

// Get filter and search inputs
$search = $_POST['searchInput'] ?? '';
$service_type = $_GET['service_type'] ?? '';
$status = $_GET['status'] ?? '';
$date_from = $_GET['date_from'] ?? '';
$date_to = $_GET['date_to'] ?? '';

// Build WHERE clause and params
$where = ["a.client_id = ?", "a.status != 'Deleted'"];
$params = [$_SESSION['client_id']];
$types = "i";

// If searching by appointment_id, override all filters
if ($search !== '') {
    $where[] = "a.appointment_id = ?";
    $params[] = $search;
    $types .= "i";
}

// Filters
if ($service_type !== '') {
    $where[] = "a.service_type = ?";
    $params[] = $service_type;
    $types .= "s";
}
if ($status !== '') {
    $where[] = "a.status = ?";
    $params[] = $status;
    $types .= "s";
}
if ($date_from !== '') {
    $where[] = "DATE(a.appointment_date) >= ?";
    $params[] = $date_from;
    $types .= "s";
}
if ($date_to !== '') {
    $where[] = "DATE(a.appointment_date) <= ?";
    $params[] = $date_to;
    $types .= "s";
}

$where_sql = $where ? 'WHERE ' . implode(' AND ', $where) : '';
$sql = "SELECT a.appointment_id, a.provider_id, a.client_id,
        DATE(a.appointment_date) AS appointment_date, a.status,
        DATE(a.created_at) AS created_at, a.service_type, a.message, p.full_name 
        FROM appointments a 
        LEFT JOIN serviceproviders p ON a.provider_id = p.provider_id 
        $where_sql
        ORDER BY a.appointment_date DESC";
$stmt = $conn->prepare($sql);

if ($params) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
$users = $result->fetch_all(MYSQLI_ASSOC);

// Dashboard stats (always for all, not filtered)
$statusCounts = [];
$query = "SELECT status, COUNT(*) as count FROM appointments WHERE client_id = ? AND status != 'Deleted' GROUP BY status";
$stmt2 = $conn->prepare($query);
$stmt2->bind_param("i", $_SESSION['client_id']);
$stmt2->execute();
$result2 = $stmt2->get_result();
while ($row = $result2->fetch_assoc()) {
    $statusCounts[$row['status']] = $row['count'];
}

$totalQuery = "SELECT COUNT(*) as total FROM appointments WHERE client_id = ? AND status != 'Deleted'";
$stmt3 = $conn->prepare($totalQuery);
$stmt3->bind_param("i", $_SESSION['client_id']);
$stmt3->execute();
$totalResult = $stmt3->get_result();
$totalAppointments = $totalResult->fetch_assoc()['total'];
?>
