
<?php
include '../session/session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka - Appointment Management</title>
    <link rel="stylesheet" href="styles.css">
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
                    <a href="../bill/bill.php">
                        <button class="active">
                        <img src="../images/bill.png" alt="Bill">
                        Bill
                        </button>
                    </a>
                </li>
                <li>
                    <a href="">
                    <button>
                        <img src="../images/forum.png" alt="Forum">
                        Forum
                    </button>
                    </a>
                </li>
                <li>
                    <a href="">
                    <button>
                        <img src="../images/knowledgebase.png" alt="Knowledge Base">
                        Knowledge Base
                    </button>
                    </a>
                </li>
                <li>
                    <a href="../reports/reports.php">
                        <button>
                            <img src="../images/reports.png" alt="Reports">
                            Reports
                        </button>
                    </a>
                </li>
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
                    <a href="../SP_Profile/Profile.html">
                        <img src="../images/user.png" alt="Profile">
                    </a>
                </div>
                <a href="../../Login/Logout.php" class="logout">Logout</a>
            </div>

                
        <!-- Filter and Search Section -->
        <div class="controls">
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

        <!-- Bills Grid -->
        <div class="bills-grid">
            <!-- Bill Card 1 -->
            <div class="bill-card">
                <div class="bill-header">
                    <span class="payment-id">PAY001</span>
                    <span class="status unpaid">Unpaid</span>
                </div>
                <div class="bill-content">
                    <div class="bill-info">
                        <p><strong>Client ID:</strong> CLT100</p>
                        <p><strong>Service:</strong> Plumbing</p>
                        <p><strong>Amount:</strong> $250.00</p>
                        <p><strong>Date:</strong> 2024-11-20</p>
                        <p><strong>Service ID:</strong> SRV501</p>
                    </div>
                    <button class="pay-button">Pay Bill</button>
                </div>
            </div><!-- Bill Card 1 -->
            <div class="bill-card">
                <div class="bill-header">
                    <span class="payment-id">PAY001</span>
                    <span class="status unpaid">Unpaid</span>
                </div>
                <div class="bill-content">
                    <div class="bill-info">
                        <p><strong>Client ID:</strong> CLT100</p>
                        <p><strong>Service:</strong> Plumbing</p>
                        <p><strong>Amount:</strong> $250.00</p>
                        <p><strong>Date:</strong> 2024-11-20</p>
                        <p><strong>Service ID:</strong> SRV501</p>
                    </div>
                    <button class="pay-button">Pay Bill</button>
                </div>
            </div>

            <!-- Bill Card 2 -->
            <div class="bill-card">
                <div class="bill-header">
                    <span class="payment-id">PAY002</span>
                    <span class="status paid">Paid</span>
                </div>
                <div class="bill-content">
                    <div class="bill-info">
                        <p><strong>Client ID:</strong> CLT101</p>
                        <p><strong>Service:</strong> Electrical</p>
                        <p><strong>Amount:</strong> $180.50</p>
                        <p><strong>Date:</strong> 2024-11-21</p>
                        <p><strong>Service ID:</strong> SRV502</p>
                    </div>
                    <button class="pay-button" disabled>Paid</button>
                </div>
            </div>

            <!-- Bill Card 3 -->
            <div class="bill-card">
                <div class="bill-header">
                    <span class="payment-id">PAY003</span>
                    <span class="status unpaid">Unpaid</span>
                </div>
                <div class="bill-content">
                    <div class="bill-info">
                        <p><strong>Client ID:</strong> CLT102</p>
                        <p><strong>Service:</strong> Cleaning</p>
                        <p><strong>Amount:</strong> $320.75</p>
                        <p><strong>Date:</strong> 2024-11-22</p>
                        <p><strong>Service ID:</strong> SRV503</p>
                    </div>
                    <button class="pay-button">Pay Bill</button>
                </div>
            </div>

            <!-- Bill Card 4 -->
            <div class="bill-card">
                <div class="bill-header">
                    <span class="payment-id">PAY004</span>
                    <span class="status unpaid">Unpaid</span>
                </div>
                <div class="bill-content">
                    <div class="bill-info">
                        <p><strong>Client ID:</strong> CLT103</p>
                        <p><strong>Service:</strong> Gardening</p>
                        <p><strong>Amount:</strong> $150.00</p>
                        <p><strong>Date:</strong> 2024-11-23</p>
                        <p><strong>Service ID:</strong> SRV504</p>
                    </div>
                    <button class="pay-button">Pay Bill</button>
                </div>
            </div>

            <!-- Bill Card 5 -->
            <div class="bill-card">
                <div class="bill-header">
                    <span class="payment-id">PAY005</span>
                    <span class="status paid">Paid</span>
                </div>
                <div class="bill-content">
                    <div class="bill-info">
                        <p><strong>Client ID:</strong> CLT104</p>
                        <p><strong>Service:</strong> Painting</p>
                        <p><strong>Amount:</strong> $420.25</p>
                        <p><strong>Date:</strong> 2024-11-24</p>
                        <p><strong>Service ID:</strong> SRV505</p>
                    </div>
                    <button class="pay-button" disabled>Paid</button>
                </div>
            </div>

            <!-- Bill Card 6 -->
            <div class="bill-card">
                <div class="bill-header">
                    <span class="payment-id">PAY006</span>
                    <span class="status unpaid">Unpaid</span>
                </div>
                <div class="bill-content">
                    <div class="bill-info">
                        <p><strong>Client ID:</strong> CLT105</p>
                        <p><strong>Service:</strong> Carpentry</p>
                        <p><strong>Amount:</strong> $280.00</p>
                        <p><strong>Date:</strong> 2024-11-25</p>
                        <p><strong>Service ID:</strong> SRV506</p>
                    </div>
                    <button class="pay-button">Pay Bill</button>
                </div>
            </div>
        </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>