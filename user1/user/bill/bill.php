
<?php
include '../session/session.php';

// Get the logged-in client ID from session
$client_id = $_SESSION['client_id'];

// Get filter parameters
$status_filter = isset($_GET['status']) ? $_GET['status'] : 'all';
$search_term = isset($_GET['search']) ? $_GET['search'] : '';

// Base SQL query
$sql = "SELECT b.bill_id, b.Description, b.Bill_Date, b.Amount, b.status, b.project_id, p.project_name
        FROM bills b
        JOIN projects p ON b.project_id = p.project_id
        WHERE p.client_id = ?";

// Add status filter
if ($status_filter != 'all') {
    $sql .= " AND b.status = ?";
}

// Add search filter
if (!empty($search_term)) {
    $sql .= " AND (b.Description LIKE ? OR p.project_name LIKE ?)";
}

$sql .= " ORDER BY b.Bill_Date DESC";

// Prepare statement
$stmt = $conn->prepare($sql);

// Binding based on conditions
if ($status_filter != 'all' && !empty($search_term)) {
    // Both status filter and search term
    $search_param = "%{$search_term}%";
    $stmt->bind_param("isss", $client_id, $status_filter, $search_param, $search_param);
} elseif ($status_filter != 'all') {
    // Only status filter
    $stmt->bind_param("is", $client_id, $status_filter);
} elseif (!empty($search_term)) {
    // Only search term
    $search_param = "%{$search_term}%";
    $stmt->bind_param("iss", $client_id, $search_param, $search_param);
} else {
    // No filters
    $stmt->bind_param("i", $client_id);
}

$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka - Appointment Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
        <div class="sidebar">
            <div class="logo">
                <img src="../images/logo.png" alt="EDSA Lanka Consultancy Logo">
            </div>
            
            <ul class="menu">
                <li>
                    <a href="../Dashboard/Dashboard.php">
                        <button>
                            <img src="../images/dashboard.png" alt="Dashboard">
                            Dashboard
                        </button>
                    </a>
                </li>
                <li>
                    <a href="../appointments/appointment.php">
                        <button >
                            <img src="../images/appointment.png" alt="Appointment">
                            Appointment
                        </button>
                    </a>
                </li>
                <li>
                    <a href="../Project/project.php">
                        <button >
                            <img src="../images/project.png" alt="project">
                            Projects
                        </button>
                    </a>
                </li>
                <li>
                    <a href="../bill/bill.php">
                        <button class="active">
                        <img src="../images/bill.png" alt="Bill">
                        Bill
                        </button>
                    </a>
                </li>
                <li>
                    <a href="../forum/forum.php">
                    <button>
                        <img src="../images/forum.png" alt="Forum">
                        Forum
                    </button>
                    </a>
                </li>
                <li><a href="../Message/Message.php">
                    <button>
                        <img src="../images/Message.png" alt="Message">
                        Message
                    </button></a>
                </li>
                <!-- <li>
                    <a href="../reports/reports.php">
                        <button>
                            <img src="../images/reports.png" alt="Reports">
                            Reports
                        </button>
                    </a>
                </li> -->
            </ul>
        </div>

        <!-- Main Content Area -->
        <div class="main-wrapper">
            <!-- Navbar -->
            <div class="navbar">
                <a href="#">
                    <img src="../images/notification.png" alt="Notifications">
                </a>
                <div class="profile">
                <a href="../profile/profile.php">
                <img src="../images/user.png" alt="Profile">
                    </a>
                </div>
                <a href="../../../Login/Logout.php" class="logout">Logout</a>
            </div>

        <div class="space">

        </div>
        <div class="controls card1 ">
        <h1>Bill</h1>
        </div>
        <!-- Filter and Search Section -->
<!-- Filter and Search Section -->
<div class="center">
    <form method="get" class="controls">
        <div class="filter-group">
            <?php 
            // Get current filter status from URL
            $status_filter = isset($_GET['status']) ? $_GET['status'] : 'all';
            $search_term = isset($_GET['search']) ? $_GET['search'] : '';
            ?>
            <select id="status-filter" name="status" onchange="this.form.submit()">
                <option value="all" <?php echo $status_filter == 'all' ? 'selected' : ''; ?>>All Bills</option>
                <option value="paid" <?php echo $status_filter == 'paid' ? 'selected' : ''; ?>>Paid</option>
                <option value="unpaid" <?php echo $status_filter == 'unpaid' ? 'selected' : ''; ?>>Unpaid</option>
            </select>
        </div>
        <div class="search-group">
            <input type="text" placeholder="Search service or project..." id="search" name="search" value="<?php echo htmlspecialchars($search_term); ?>">
            <button type="submit" class="search-button">Search</button>
        </div>
    </form>
</div>

        <!-- Bills Grid -->

        <?php if ($result->num_rows > 0): ?>
    <div class="bills-grid">
    <?php while ($bill = $result->fetch_assoc()): 
        $status_class = $bill['status'] == 'paid' ? 'paid' : 'unpaid';
        $button_text = $bill['status'] == 'unpaid' ? 'Pay Bill' : 'View';
        $button_link = $bill['status'] == 'unpaid' ? 'paybill.php?bill_id=' . $bill['bill_id'] : 'viewbill.php?bill_id=' . $bill['bill_id'];
    ?>
        <div class="bill-card">
            <div class="bill-header">
                <span class="payment-id">PAY<?php echo str_pad($bill['bill_id'], 3, '0', STR_PAD_LEFT); ?></span>
                <span class="status <?php echo $status_class; ?>"><?php echo ucfirst($bill['status']); ?></span>
            </div>
            <div class="bill-content">
                <div class="bill-info">
                    <p><strong>Service:</strong> <?php echo htmlspecialchars($bill['Description']); ?></p>
                    <p><strong>Amount:</strong> Rs <?php echo number_format($bill['Amount'], 2); ?></p>
                    <p><strong>Date:</strong> <?php echo htmlspecialchars($bill['Bill_Date']); ?></p>
                    <p><strong>Project:</strong> <?php echo htmlspecialchars($bill['project_name']); ?> (ID: <?php echo $bill['project_id']; ?>)</p>
                </div>
                <a href="<?php echo $button_link; ?>">
                    <button class="pay-button <?php echo $status_class == 'paid' ? 'green' : ''; ?>">
                        <?php echo $button_text; ?>
                    </button>
                </a>
            </div>
        </div>
    <?php endwhile; ?>
    </div>
<?php else: ?>
    <p>No bills found for your projects.</p>
<?php endif; ?>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>