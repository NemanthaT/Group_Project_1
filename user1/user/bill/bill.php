
<?php
include '../session/session.php';
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
                <!-- <li>
                    <button>
                        <img src="../images/knowledgebase.png" alt="Knowledge Base">
                        Knowledge Base
                    </button>
                </li> -->
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
                <a href="#">Home</a>
                <a href="#">
                    <img src="../images/notification.png" alt="Notifications">
                </a>
                <div class="profile">
                <a href="../profile/profile.php">
                <img src="../images/user.png" alt="Profile">
                    </a>
                </div>
                <a href="../../Login/Logout.php" class="logout">Logout</a>
            </div>

        <div class="space">

        </div>
        
        <!-- Filter and Search Section -->
         <div class="center">

        <div class="controls ">
            <div class="filter-group">
                <select id="status-filter">
                    <option value="all">All Bills</option>
                    <option value="paid">Paid</option>
                    <option value="unpaid">Unpaid</option>
                </select>
            </div>
            <div class="search-group">
                <input type="text" placeholder="Search client ID or service..." id="search">
                <button class="search-button">search </button>
            </div>
        </div>
        </div>
        <!-- Bills Grid -->
        <div class="bills-grid">
        <!-- Bill Card 1 -->
            <div class="bill-card">
                <div class="bill-header">
                    <span class="payment-id">PAY002</span>
                    <span class="status unpaid">Unpaid</span>
                </div>
                <div class="bill-content">
                    <div class="bill-info">
                        <p><strong>Service:</strong> Financial consultancy for board of directers</p>
                        <p><strong>Amount:</strong> Rs 4,500,000</p>
                        <p><strong>Date:</strong> 2024-11-21</p>
                        <p><strong>Project ID:</strong> 001</p>
                    </div><a href="paybill.php">
                    <button class="pay-button">Pay Bill</button></a>
                </div>
            </div>
        
            <!-- Bill Card 2 -->
            <div class="bill-card">
                <div class="bill-header">
                    <span class="payment-id">PAY001</span>
                    <span class="status paid">Paid</span>
                </div>
                <div class="bill-content">
                    <div class="bill-info">
                        <p><strong>Service:</strong> Financial consultancy for board of directers (advance)</p>
                        <p><strong>Amount:</strong> Rs 4,500,000</p>
                        <p><strong>Date:</strong> 2024-11-21</p>
                        <p><strong>Project ID:</strong> 001</p>
                    </div>
                    <a href="paidbill.php">
                    <button class="pay-button green" >View</button>
                    </a>
                </div>
            </div>
        </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>