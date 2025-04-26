
<?php
include '../session/session.php';

if (!isset($_GET['bill_id']) || empty($_GET['bill_id'])) {
    echo "No bill selected.";
    exit;
}
$bill_id = $_GET['bill_id'];

// Fetch bill, project, and client info
$sql = "SELECT 
            b.*, 
            p.project_name, 
            c.full_name, 
            c.phone, 
            c.address 
        FROM bills b
        JOIN projects p ON b.project_id = p.project_id
        JOIN clients c ON p.client_id = c.client_id
        WHERE b.bill_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $bill_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Bill not found.";
    exit;
}
$bill = $result->fetch_assoc();

// Date formatting
$bill_date = date("F d, Y", strtotime($bill['Bill_Date']));
$due_date = date("F d, Y", strtotime($bill['Bill_Date'] . " +14 days"));
$invoice_number = 'SD-' . date('Y', strtotime($bill['Bill_Date'])) . '-' . str_pad($bill['bill_id'], 4, '0', STR_PAD_LEFT);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka - Appointment Management</title>
    <link rel="stylesheet" href="style.css">
    <script src="../../../payment/pay.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
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
                    <!-- <img src="../images/notification.png" alt="Notifications"> -->
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
       <div class="boxcontent"> 
        <div  id="invoice-section">
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
                </div>
            </div>

            <div class="bill-to">
                <h3>Bill To:</h3>
                <p>
                    <?php echo htmlspecialchars($bill['full_name']); ?><br>
                    <?php echo htmlspecialchars($bill['address']); ?><br>
                    Contact: <?php echo htmlspecialchars($bill['phone']); ?>
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
                        <td><?php echo number_format($bill['Amount'], 2); ?></td>
                    </tr>
                </tbody>
            </table>

            <div class="total-section">
                <strong>Total Due: <?php echo number_format($bill['Amount'], 2); ?> LKR</strong>
            </div>

        </div>
        <div>
                <?php if ($bill['status'] === 'unpaid'): ?>
                    <button onclick="paymentGateway(<?php echo $bill['bill_id'] ?>)" class="pay-button">Pay Now</button>
                <?php else: ?>
                    <span class="paid-label">Paid</span>
                <?php endif; ?>
                <button onclick="printInvoice()" class="pay-button">Print Invoice</button>

            </div>
            </div>
        </div>

    <script>
function printInvoice() {
    var printContents = document.getElementById('invoice-section').innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
   document.body.innerHTML = originalContents;
    location.reload();
}
</script>
</body>
</html>