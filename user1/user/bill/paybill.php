
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
                <a href="#">Home</a>
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
       <div class="boxcontent"> 
    <div class="invoice-header">
        <div class="company-info">
            <h1>EDSA Lanka Consultancy</h1>
            <p>No. 45, Lotus Road<br>Colombo 01, Sri Lanka</p>
            <p>Tel: +94 11 234 5678</p>
        </div>
        <div class="invoice-details">
            <h2>INVOICE</h2>
            <p>Invoice Number: SD-2024-1127</p>
            <p>Date: November 27, 2024</p>
            <p>Due Date: December 15, 2024</p>
        </div>
    </div>

    <div class="bill-to">
        <h3>Bill To:</h3>
        <p>Priyantha Gunawardena<br>
        456 Galle Road<br>
        Ratmalana, Western Province 10380</p>
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
                <td>Advance</td>

                <td>4,500,000</td>
            </tr>

        </tbody>
    </table>

    <div class="total-section">
        <p>Subtotal: 19,000 LKR</p>
        <p>VAT (15%): 2,850 LKR</p>
        <strong>Total Due: 21,850 LKR</strong>
    </div>
    <div>
        <button class="pay-button">Pay Now</button>
    </div>
    </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>