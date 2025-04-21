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
                        <button>
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
                    <a href="../forum/forum.php">
                        <button>
                            <img src="../images/forum.png" alt="Forum">
                            Forum
                        </button>
                    </a>
                </li>
                <li>
                    <a href="../Message/Message.php">
                        <button>
                            <img src="../images/Message.png" alt="Message">
                            Message
                        </button>
                    </a>
                </li>
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

            <!-- Appointment Content -->
            <div class="space"></div>
            <div class="main-container controls card1">
                <h1>Appointment Management</h1>
            </div>
            <div class="main-container">
                <div class="search-container">
                    <div>
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
                                    <?php if ($user['status'] == 'Pending'): ?>
                                        <form style="display: inline;">
                                            <button type="button" class="btn edit-btn" data-id="<?= htmlspecialchars($user['appointment_id']) ?>" 
                                                onclick="openUpdatePopup(
                                                    '<?= addslashes($user['appointment_id']) ?>', 
                                                    '<?= addslashes($user['service_type']) ?>', 
                                                    '<?= addslashes($user['appointment_date']) ?>', 
                                                    '<?= addslashes($user['message']) ?>'
                                                )">
                                                Edit
                                            </button>
                                        </form>
                                    <?php endif; ?>

                                    <?php if ($user['provider_id'] !== null && ($user['status'] == 'Completed' || $user['status'] == 'Assigned' || $user['status'] == 'Scheduled')): ?>
                                        <form method="POST" action="" style="display: inline;">
                                            <input type="hidden" name="appointment_id" value="<?= htmlspecialchars($user['appointment_id']) ?>">
                                            <button type="submit" class="btn view-btn">View</button>
                                        </form>
                                    <?php endif; ?>

                                    <?php if ($user['status'] == 'Scheduled'): ?>
                                        <form method="POST" action="cancel_appointment.php" style="display: inline;">
                                            <input type="hidden" name="appointment_id" value="<?= htmlspecialchars($user['appointment_id']) ?>">
                                            <button type="submit" class="btn cancel-btn">Cancel</button>
                                        </form>
                                    <?php endif; ?>

                                    <?php if ($user['status'] == 'Cancelled'): ?>
                                        <form method="POST" action="delete_appointment.php" style="display: inline;">
                                            <input type="hidden" name="appointment_id" value="<?= htmlspecialchars($user['appointment_id']) ?>">
                                            <button type="submit" class="btn cancel-btn">Delete</button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Add Appointment Overlay -->
            <div id="addAppointmentOverlay" class="overlay">
                <div class="overlay-content">
                    <span class="close-btn" onclick="closePopup('addAppointmentOverlay')">&times;</span>
                    <h2>Add New Appointment</h2>
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
                            <label for="additionalMessage">Additional Message</label>
                            <textarea id="additionalMessage" name="additionalMessage" rows="4"></textarea>
                        </div>
                        <button type="submit" id="Bookappointmentbtn" class="btn">Book Appointment</button>
                    </form>
                </div>
            </div>

            <!-- Edit Appointment Overlay -->
            <div id="EditAppointmentOverlay" class="overlay">
                <div class="overlay-content">
                    <span class="close-btn" onclick="closePopup('EditAppointmentOverlay')">&times;</span>
                    <h2>Edit Appointment</h2>
                    <form id="appointmentForm" action="update_appointment.php" method="POST">
                        <div class="form-group">
                            <label for="editAppointmentid">Appointment ID</label>
                            <input type="text" id="editAppointmentid" name="editAppointmentid" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="editServiceSelect">Select a Service</label>
                            <select id="editServiceSelect" name="editServiceSelect" required>
                                <option value="">Choose a Service</option>
                                <option value="Consulting">Consulting</option>
                                <option value="Training">Training</option>
                                <option value="Researching">Researching</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editAppointmentDate">Select a Date</label>
                            <input type="date" id="editAppointmentDate" name="editAppointmentDate" required>
                        </div>
                        <div class="form-group">
                            <label for="editAdditionalMessage">Additional Message</label>
                            <textarea id="editAdditionalMessage" name="editAdditionalMessage" rows="4"></textarea>
                        </div>
                        <button type="submit" id="editSaveappointmentbtn" class="btn">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Message Popup -->
    <?php if (isset($_SESSION['error']) || isset($_SESSION['success'])): ?>
        <div id="popupModal" class="modal">
            <div class="modal-content">
                <span class="close-modal">&times;</span>
                <div class="modal-header">
                    <h2>
                        <?php 
                            if (isset($_SESSION['error'])) {
                                echo '<span class="Error">Error</span>';
                            } elseif (isset($_SESSION['success'])) {
                                echo '<span class="Success">Success</span>';
                            }
                        ?>
                    </h2>
                    <hr>
                </div>
                <div class="modal-body">
                    <p>
                        <?php 
                            echo isset($_SESSION['error']) ? htmlspecialchars($_SESSION['error']) : htmlspecialchars($_SESSION['success']);
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <?php 
            unset($_SESSION['error']);
            unset($_SESSION['success']);
        ?>
    <?php endif; ?>
</body>
</html>
