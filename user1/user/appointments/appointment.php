<?php 
include '../session/session.php';
include 'get_appointment.php';

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
<script src="script.js"></script>

    <div class="container">
        <!-- Sidebar -->
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
                        <button class="active">
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
                        <button>
                            <img src="../images/bill.png" alt="Bill">
                            Bill
                        </button>
                    </a>
                </li>
                <li>
                    <button>
                        <img src="../images/forum.png" alt="Forum">
                        Forum
                    </button>
                </li>
                <li>
                    <button>
                        <img src="../images/knowledgebase.png" alt="Knowledge Base">
                        Knowledge Base
                    </button>
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
                <a href="../../Login/Logout.php" class="logout">Logout</a>
            </div>

            <!-- Appointment Content -->
            <div class="main-container">
                <header>
                    <h1>Appointment Management</h1>
                </header>

                <div class="search-container">
                    <div >
                        <form action="appointment.php" method="POST">
                        <input type="text" id="searchInput" name="searchInput" class="searchInput" placeholder="Appointment ID" value="<?= htmlspecialchars($_POST['searchInput'] ?? '') ?>">
                        <button id="Search" class="btn">Search</button>
                        </form>
                    </div>
                    <div>
                        <button id="addAppointmentBtn" class="btn" onclick="openPopup('addAppointmentOverlay')">Add Appointment</button>
                    </div>
                </div>

                <table class="appointment-table">
    <thead>
        <tr>
            <th>Appointment ID</th>
            <th>Service</th>
            <th>Appointment Date</th>
            <th>Message</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="appointmentList">
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['appointment_id']) ?></td>
            <td><?= htmlspecialchars($user['service_type']) ?></td>
            <td><?= htmlspecialchars($user['appointment_date']) ?></td>
            <td><?= htmlspecialchars($user['message']) ?></td>
            <td><?= htmlspecialchars($user['status']) ?></td>
            <td>
                <?php if ($user['provider_id'] === null): ?>
                    <button class='btn edit-btn' 
                            data-id='<?= htmlspecialchars($user['appointment_id']) ?>' 
                            onclick="openUpdatePopup('<?= addslashes($user['service_type']) ?>', '<?= addslashes($user['appointment_date']) ?>', '<?= addslashes($user['message']) ?>')">
                        Edit
                    </button>
                <?php endif; ?>
                
                <?php if ($user['provider_id'] !== null && $user['status'] !== 'cancelled'): ?>
                    <button class='btn cancel-btn' data-id='<?= htmlspecialchars($user['appointment_id']) ?>'>Cancel</button>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>



            </div>
            
                <!-- Add/Edit Appointment Overlay -->
                <div id="addAppointmentOverlay" class="overlay">
                    <div class="overlay-content">
                        <span class="close-btn" onclick="closePopup('addAppointmentOverlay')">&times;</span>
                        <h2  >Add New Appointment</h2>
                        <form id="appointmentForm" action="add_appointment.php" method="POST">
                            <div class="form-group">
                                <label for="serviceSelect">Select a Service</label>
                                <select id="serviceSelect" name="serviceSelect" required>
                                    <option value="">Choose a Service</option>
                                    <option value="Consulting">Consulting</option>
                                    <option value="Training">Training</option>
                                    <option value="Researching">Researching</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="appointmentDate">Select a Date</label>
                                <input type="date" id="appointmentDate" name="appointmentDate" required>
                            </div>
                            <div class="form-group">
                                <label for="additionalMessage" >Additional Message</label>
                                <textarea id="additionalMessage" name="additionalMessage" rows="4" required > </textarea>
                            </div>
                            <button type="submit" id="Bookappointmentbtn" class="btn" >Book Appointment</button>
                        </form>
                    </div>
                </div>


                <!-- View Appointment Overlay -->
                <div id="EditAppointmentOverlay" class="overlay">
                    <div class="overlay-content">
                        <span class="close-btn">&times;</span>
                        <h2  >View Appointment</h2>
                        <form id="appointmentForm">
                            <div class="form-group">
                                <label for="appointmentid">Appointment ID</label>
                                <input type="text" id="appointmentid" name="appointmentid" required>
                            </div>
                            <div class="form-group">
                                <label for="serviceSelect">Select a Service</label>
                                <select id="serviceSelect" name="serviceSelect" required>
                                    <option value="">Choose a Service</option>
                                    <option value="Consulting">Consulting</option>
                                    <option value="Training">Training</option>
                                    <option value="Researching">Researching</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="appointmentDate">Select a Date</label>
                                <input type="date" id="appointmentDate" name="appointmentDate" required>
                            </div>
                            <div class="form-group">
                                <label for="additionalMessage">Additional Message</label>
                                <textarea id="additionalMessage" name="additionalMessage" rows="4"></textarea>
                            </div>
                            <button type="submit" id="Saveappointmentbtn" class="btn">Save</button>
                        </form>
                    </div>
                </div>
        </div>
    </div>
        <?php if (isset($_SESSION['error'])): ?>
    <div id="popupModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <div class="modal-header">
                <h2>
                    <?php 
                        echo $_SESSION['error'] === 'booked' 
                            ? '<span class="Success">Success</span>' 
                            : '<span class="Error">Error</span>'; 
                    ?>
                </h2>
                <hr>
            </div>
            <div class="modal-body">
                <p><?= $_SESSION['error'] === 'booked' ? 'Your appointment has been booked successfully!' : htmlspecialchars($_SESSION['error']) ?></p>
            </div>
        
            </div>
        </div>
    </div>
    <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

</body>


</html>