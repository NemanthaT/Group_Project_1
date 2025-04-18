<?php
include '../Session/Session.php';
include '../connection.php';

// Check if bill_id is provided in the URL
if (!isset($_GET['bill_id']) || empty($_GET['bill_id'])) {
    header("Location: Bill.php");
    exit;
}

$bill_id = $_GET['bill_id'];

// Fetch bill details with project and client information
$query = "SELECT 
            b.*, 
            p.project_name, 
            c.full_name AS client_name, 
            c.phone AS client_phone
        FROM bills b
        JOIN projects p ON b.project_id = p.project_id
        JOIN clients c ON p.client_id = c.client_id
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

// Format the bill date
$bill_date = date("F j, Y", strtotime($bill['Bill_Date']));

// Calculate due date (14 days after bill date)
$due_date = date("F j, Y", strtotime($bill['Bill_Date'] . " +14 days"));

// Format the invoice number
$invoice_number = 'ED-' . date('Y', strtotime($bill['Bill_Date'])) . '-' . str_pad($bill_id, 4, '0', STR_PAD_LEFT);

// Set subtotal and total due (no VAT)
$subtotal = $bill['Amount'];
$total_due = $subtotal;
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
                <div class="back-link">
                    <a href="Bill.php">← Back to Bills</a>
                </div>
                <center><h2>View Bill</h2></center>
                <div class="boxcontent"> 
                    <div class="invoice-header">
                        <div class="company-info">
                            <h1>EDSA Lanka Consultancy</h1>
                            <p>No. 45, Lotus Road<br>Colombo 01, Sri Lanka</p>
                            <p>Tel: +94 11 234 5678</p>
                        </div>
                        <div class="invoice-details">
                            <h2>INVOICE</h2>
                            <p>Invoice Number: <?php echo $invoice_number; ?></p>
                            <p>Date: <?php echo $bill_date; ?></p>
                            <p>Due Date: <?php echo $due_date; ?></p>
                            <p>Status: <span class="<?php echo strtolower($bill['status']); ?>"><?php echo ucfirst($bill['status']); ?></span></p>
                        </div>
                    </div>

                    <div class="bill-to">
                        <h3>Bill To:</h3>
                        <p>
                            <?php echo htmlspecialchars($bill['client_name']); ?><br>
                            Contact: <?php echo htmlspecialchars($bill['client_phone']); ?><br>
                            Project: <?php echo htmlspecialchars($bill['project_name']); ?><br>
                            Project ID: <?php echo htmlspecialchars($bill['project_id']); ?>
                        </p>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th style="width:20%">Amount (LKR)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo htmlspecialchars($bill['Description']); ?></td>
                                <td><?php echo number_format($subtotal, 2); ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="total-section">
                        <strong>Total Due: <?php echo number_format($total_due, 2); ?> LKR</strong>
                    </div>
                    
                    <div class="action-buttons">
                        <a href="editbill.php?bill_id=<?php echo $bill_id; ?>"><button class="pay-button">Edit</button></a>
                        <?php if ($bill['status'] === 'unpaid'): ?>
                        <a href="process_payment.php?bill_id=<?php echo $bill_id; ?>"><button class="pay-button green">Mark as Paid</button></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="#"></script>
</body>
</html>
