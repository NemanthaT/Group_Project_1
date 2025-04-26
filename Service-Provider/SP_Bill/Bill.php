<?php
include '../Session/Session.php';
include '../connection.php';
include '../Common template/SP_common.php';

$providerId = $_SESSION['provider_id'];
// Get filters from GET parameters
$status = isset($_GET['status']) ? $_GET['status'] : 'all';
$project_id = isset($_GET['project_id']) ? trim($_GET['project_id']) : '';

// Build the query dynamically
$query = "SELECT b.* FROM bills b JOIN projects p ON b.project_id = p.project_id WHERE p.provider_id = ?";
$params = [$providerId];
$types = "i";

// Filter by status if not 'all'
if ($status !== 'all' && ($status === 'paid' || $status === 'unpaid')) {
    $query .= " AND status = ?";
    $params[] = $status;
    $types .= "s";
}

// Filter by project_id if provided
if ($project_id !== '') {
    $query .= " AND project_id = ?";
    $params[] = $project_id;
    $types .= "i";
}

// Prepare and execute the statement
$stmt = $conn->prepare($query);
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka Consultancy</title>
    <link rel="stylesheet" href="../Common template/SP_common.css">
    <link rel="stylesheet" href="Bill.css">
</head>
<body>
        <div class="main-content">
            <?php
            if (isset($_SESSION['bill_errors'])) {
                echo "<div class='create-bill-section' style='background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 10px; border-radius: 5px; margin-bottom: 15px;'>";
                echo "<p style='margin: 0; font-size: 14px;'>" . (is_array($_SESSION['bill_errors']) ? implode(', ', $_SESSION['bill_errors']) : $_SESSION['bill_errors']) . "</p>";
                echo "</div>";
                unset($_SESSION['bill_errors']);
            }
            ?>
            <div class="bill-section">
                <center><h2>Bill</h2></center>
                <div class="filter-group search-group">
                    <select id="status-filter">
                        <option value="all">All Bills</option>
                        <option value="paid">Paid</option>
                        <option value="unpaid">Unpaid</option>
                    </select>
                    <input type="text" placeholder="Project ID" id="search">
                    <button class="search-button" id="search-btn">Search</button>
                    <button class="clear-button" id="clear-filters">Clear</button>
                        <div class="add-bill-button">
                            <a href="CreateBill.php"><button class="search-button">+ Add Bill</button></a>
                        </div>
                </div>
                <div class="bills-grid">
                 <?php   
                    // Display cards
                    if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                    $statusClass = strtolower($row['status']) === 'paid' ? 'paid' : 'unpaid';
                        echo '<div class="bill-card">';
                        echo    '<div class="bill-header">';
                        echo        '<span class="payment-id">PAY' . str_pad($row['bill_id'], 3, '0', STR_PAD_LEFT) . '</span>';
                        echo        '<span class="status ' . $statusClass . '">' . ucfirst($row['status']) . '</span>';
                        echo    '</div>';
                        echo    '<div class="bill-content">';
                        echo        '<div class="bill-info">';
                        echo            '<p><strong>Service:</strong> ' . htmlspecialchars($row['Description']) . '</p>';
                        echo            '<p><strong>Amount:</strong> Rs ' . htmlspecialchars($row['Amount']) . '</p>';
                        echo            '<p><strong>Date:</strong> ' . htmlspecialchars($row['Bill_Date']) . '</p>';
                        echo            '<p><strong>Project ID:</strong> ' . htmlspecialchars($row['project_id']) . '</p>';
                        echo        '</div>';
                        echo        '<a href="Viewbill.php?bill_id=' . $row['bill_id'] . '">';
                        echo            '<button class="pay-button">View</button>';
                        echo        '</a>';
                        echo    '</div>';
                        echo '</div>';
                    }
                    }else{
                        echo "<p>No bills found.</p>";
                    }
                ?>
                </div>
            </div>
        </div>
    </div>   <!--this is the </div> of container in the common file, don't remove it-->
<script src="Bill.js"></script>
<script src="../Common template/Calendar.js"></script>
</body>
</html>