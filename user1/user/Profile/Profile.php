
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
                        <button >
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
                </li>                <li>
                    <a href="../bill/bill.php">
                        <button >
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
                        <button >
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
                <a href="../profile/profile.php">
                <img src="../images/user.png" alt="Profile">
                    </a>
                </div>
                <a href="../../Login/Logout.php" class="logout">Logout</a>
            </div>

    <div class=".main-container">
        <div class="space"></div>

        <div class="profile-container">
        <h1>Business Profile Details</h1>
        
        <div class="profile-section">
            <h2>Business Details</h2>
            <div class="profile-field">
                <br>
                <label>Business Name</label>
                <div class="value" id="business_name_display">Green Solutions Pvt Ltd</div>
            </div>
            
            <div class="profile-field">
                <label>Business Type</label>
                <div class="value" id="business_type_display">Limited Company</div>
            </div>
            
            <div class="profile-field">
                <label>Business Registration Number</label>
                <div class="value" id="registration_number_display">BR/2024/5678</div>
            </div>
            
            <div class="profile-field">
                <label>Tax Identification Number (TIN)</label>
                <div class="value" id="tax_id_display">987-654-321</div>
            </div>
        </div>

        <div class="profile-section">
            <h2>Company Contact Information</h2>
            <div class="profile-field">
                <br>
                <label>Business Email</label>
                <div class="value" id="business_email_display">info@greensolutions.lk</div>
            </div>
            
            <div class="profile-field">
                <label>Business Phone Number</label>
                <div class="value" id="business_phone_display">+94 11 456 7890</div>
            </div>
            
            <div class="profile-field">
                <label>Business Address</label>
                <div class="value" id="business_address_display">123 Eco Street, Colombo 04, Sri Lanka</div>
            </div>
            
            <div class="profile-field">
                <label>Province</label>
                <div class="value" id="province_display">Western Province</div>
            </div>
        </div>

        <div class="profile-section">
            <h2>Business Owner/Proprietor Details</h2>
            <div class="profile-field">
                <br>
                <label>Full Name</label>
                <div class="value" id="owner_name_display">Saman Kumara</div>
            </div>
            
            <div class="profile-field">
                <label>National Identity Card (NIC) Number</label>
                <div class="value" id="owner_nic_display">199012345678</div>
            </div>
            
            <div class="profile-field">
                <label>Personal Phone Number</label>
                <div class="value" id="owner_phone_display">+94 77 987 6543</div>
            </div>
        </div>

        <div class="action-buttons">
            <button class="action-button edit-button" onclick="enableEditing()">Edit Profile</button>
        </div>
    </div>
        </div>

    </div>
    <script src="script.js"></script>
</body>
</html>