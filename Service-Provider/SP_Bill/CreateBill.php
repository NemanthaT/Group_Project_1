<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka Consultancy - Add Bill</title>
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

        <!-- Main Content Wrapper -->
        <div class="main-wrapper">
            <!-- Navbar -->
            <header>
                <nav class="navbar">       
                    <a href="../Home/Homepage/HP.html">Home</a>
                    <a href="#"><img src="../images/notification.png" alt="Notifications"></a>
                    <div class="profile">
                        <a href="../SP_Profile/Profile.html"><img src="../images/user.png" alt="Profile"></a>
                    </div>
                    <a href="../../Login/Logout.php" class="logout">Logout</a>
                </nav>
            </header>

            <!-- Main Content -->
            <div class="main-content">
                <div class="space"></div>
                
                <!-- Add Bill Section -->
                <div class="controls card1">
                    <h1>Create New Bill</h1>
                </div>

                <div class="center">
                    <div class="bill-form-container">
                        <form action="process_bill.php" method="POST" class="bill-form">
                            <div class="form-group">
                                <label for="project">Select Project</label>
                                <select id="project" name="project" required>
                                    <option value="">Choose a Project</option>
                                    <option value="001">Financial Consultancy for Board of Directors</option>
                                    <option value="002">Strategic Planning Consultation</option>
                                    <option value="003">Market Research Analysis</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="amount">Bill Amount (Rs)</label>
                                <input type="number" id="amount" name="amount" min="1" step="0.01" placeholder="Enter bill amount" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Bill Description</label>
                                <textarea id="description" name="description" rows="4" placeholder="Provide detailed description of the bill" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="bill-date">Bill Date</label>
                                <input type="date" id="bill-date" name="bill-date" required>
                            </div>

                            <div class="form-group">
                                <label for="payment-status">Payment Status</label>
                                <select id="payment-status" name="payment-status" required>
                                    <option value="unpaid">Unpaid</option>
                                    <option value="paid">Paid</option>
                                </select>
                            </div>

                            <button type="submit" class="pay-button">Create Bill</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>