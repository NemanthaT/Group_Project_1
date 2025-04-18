<?php
include '../Session/Session.php';
include '../connection.php';

// Initialize variables
$bill_id = '';
$project_id = '';
$description = '';
$bill_date = '';
$amount = '';
$status = '';
$errors = [];
$success = '';

// Check if bill_id is provided
if (isset($_GET['bill_id'])) {
    $bill_id = $_GET['bill_id'];
    
    // Fetch the bill data
    $query = "SELECT b.*, p.provider_id 
              FROM bills b
              JOIN projects p ON b.project_id = p.project_id
              WHERE b.bill_id = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $bill_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        header("Location: Bill.php?error=bill_not_found");
        exit;
    }
    
    $bill = $result->fetch_assoc();
    
    // Check if the bill belongs to the logged-in provider
    if ($bill['provider_id'] != $_SESSION['provider_id']) {
        header("Location: Bill.php?error=unauthorized");
        exit;
    }
    
    // Populate variables with bill data
    $project_id = $bill['project_id'];
    $description = $bill['Description'];
    $bill_date = $bill['Bill_Date'];
    $amount = $bill['Amount'];
    $status = $bill['status'];
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $bill_id = $_POST['bill_id'];
    $project_id = trim($_POST['project_id']);
    $description = trim($_POST['description']);
    $bill_date = $_POST['bill_date'];
    $amount = $_POST['amount'];
    $status = $_POST['status'];
    
    // Validate inputs
    if (empty($project_id)) $errors[] = "Project ID is required.";
    if (!is_numeric($amount) || $amount <= 0) $errors[] = "Amount must be a positive number.";
    if (empty($description)) $errors[] = "Description is required.";
    if (empty($bill_date)) $errors[] = "Bill date is required.";
    if (!in_array($status, ['paid', 'unpaid'])) $errors[] = "Invalid payment status.";
    
    // If no errors, update the bill
    if (empty($errors)) {
        $update_query = "UPDATE bills SET 
                        project_id = ?, 
                        Description = ?, 
                        Bill_Date = ?, 
                        Amount = ?, 
                        status = ? 
                        WHERE bill_id = ?";
        
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("issssi", $project_id, $description, $bill_date, $amount, $status, $bill_id);
        
        if ($update_stmt->execute()) {
            $success = "Bill updated successfully!";
        } else {
            $errors[] = "Error updating bill: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka Consultancy</title>
    <link rel="stylesheet" href="Bill.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <img src="../images/logo.png" alt="EDSA Lanka Consultancy Logo">
            </div>
            <ul class="menu">
                <li><a href="../SP_Dashboard/SPDash.php"><button><img src="../images/dashboard.png">Dashboard</button></a></li>
                <li><a href="../SP_Appointment/App.php"><button><img src="../images/appointment.png">Appointment</button></a></li>
                <li><a href="../SP_Message/Message.php"><button><img src="../images/message.png">Message</button></a></li>
                <li><a href="../SP_Projects/Project.php"><button><img src="../images/project.png">Project</button></a></li>
                <li><a href="../SP_Bill/Bill.php"><button><img src="../images/bill.png">Bill</button></a></li>
                <li><a href="../SP_Forum/Forum.php"><button><img src="../images/forum.png">Forum</button></a></li>
                <li><a href="../SP_KnowledgeBase/KB.php"><button><img src="../images/knowledgebase.png">KnowledgeBase</button></a></li>
            </ul>
        </div>

        <!-- Navbar -->
        <header>
            <nav class="navbar">
                <div class="calendar-icon">
                    <a href="#" id="calendarToggle"><img src="../images/calendar.png" alt="Calendar"></a>
                    <!-- Calendar Dropdown -->
                    <div id="calendarDropdown" class="calendar-dropdown">
                        <h3>Calendar</h3>
                        <div class="calendar-header">
                            <button id="prevMonth">&lt;</button>
                            <span id="currentMonth">March 2025</span>
                            <button id="nextMonth">&gt;</button>
                        </div>
                        <div class="calendar-grid">
                            <div class="weekdays">
                                <div>Mon</div>
                                <div>Tue</div>
                                <div>Wed</div>
                                <div>Thu</div>
                                <div>Fri</div>
                                <div>Sat</div>
                                <div>Sun</div>
                            </div>
                            <div id="daysGrid" class="days"></div>
                        </div>
                    </div>
                </div>
                <div class="notification">
                    <a href="#"><img src="../images/notification.png" alt="Notifications"></a>
                </div>
                <div class="profile">
                    <a href="../SP_Profile/Profile.php"><img src="../images/user.png" alt="Profile"></a>
                </div>
                <a href="../../Login/Logout.php" class="logout">Logout</a>                
            </nav>
        </header>

        <!-- Main Content -->
        <div class="main-content">
        <div class="view-bill-section">

            <div class="edit-bill-section">
                <div class="back-link">
                    <a href="Bill.php">← Back to Bills</a>
                </div>
                
                <h2>Edit Bill</h2>
                
                <?php if (!empty($errors)): ?>
                <div class="error-messages">
                    <?php foreach($errors as $error): ?>
                    <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                
                <?php if ($success): ?>
                <div class="success-message">
                    <p style="color:green;"><?php echo htmlspecialchars($success); ?></p>
                </div>
                <?php endif; ?>
                <form action="editbill.php" method="POST" class="simple-form">
                    <input type="hidden" name="bill_id" value="<?php echo htmlspecialchars($bill_id); ?>">
                    
                    <div class="form-field">
                        <label for="project_id">Project ID</label>
                        <input type="text" id="project_id" name="project_id" value="<?php echo htmlspecialchars($project_id); ?>" required>
                    </div>
                    
                    <div class="form-field">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" rows="4" required><?php echo htmlspecialchars($description); ?></textarea>
                    </div>
                    
                    <div class="form-field">
                        <label for="amount">Amount (Rs)</label>
                        <input type="number" id="amount" name="amount" value="<?php echo htmlspecialchars($amount); ?>" min="1" step="0.01" required>
                    </div>
                    
                    <div class="form-field">
                        <label for="bill_date">Bill Date</label>
                        <input type="date" id="bill_date" name="bill_date" value="<?php echo htmlspecialchars($bill_date); ?>" required>
                    </div>
                    
                    <div class="form-field">
                        <label for="status">Payment Status</label>
                        <select id="status" name="status" required>
                            <option value="unpaid" <?php if($status == 'unpaid') echo 'selected'; ?>>Unpaid</option>
                            <option value="paid" <?php if($status == 'paid') echo 'selected'; ?>>Paid</option>
                        </select>
                    </div>
                    
                    <div class="form-actions">
                        <button type="button" class="cancel-button" onclick="window.location.href='Viewbill.php?bill_id=<?php echo $bill_id; ?>'">Cancel</button>
                        <button type="submit" class="submit-button">Update Bill</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
</body>
</html>

