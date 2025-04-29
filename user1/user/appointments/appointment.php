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
<style>
    .filter-form {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    align-items: flex-end;
    background: #f9f9f9;
    padding: 1rem 1.5rem;
    border-radius: 0.5rem;
    box-shadow: 0 1px 4px rgba(0,0,0,0.04);
    margin-bottom: 20px;
}

.filter-form label {
    display: flex;
    flex-direction: column;
    font-size: 1rem;
    color: #333;
    min-width: 180px;
}

.filter-form select,
.filter-form input[type="date"] {
    border: 2px solid #333;
    background-color: #fff;
    border-radius: 0.25rem;
    font: 1.1rem/1.5 sans-serif;
    padding: 0.5rem 0.75rem;
    margin-top: 0.3rem;
    width: 100%;
    box-sizing: border-box;
    transition: border-color 0.2s;
}

.filter-form select:focus,
.filter-form input[type="date"]:focus {
    border-color: #007bff;
    outline: none;
}

.filter-form button[type="submit"] {
    background: #007bff;
    color: #fff;
    border: none;
    border-radius: 0.25rem;
    padding: 0.6rem 1.2rem;
    font-size: 1rem;
    cursor: pointer;
    margin-top: 1.5rem;
    transition: background 0.2s;
}

.filter-form button[type="submit"]:hover {
    background: #0056b3;
}

@media (max-width: 700px) {
    .filter-form {
        flex-direction: column;
        gap: 0.5rem;
        padding: 0.8rem;
    }
    .filter-form label {
        min-width: 0;
    }
}

</style>

</head>
<body>
    <script src="script.js"></script>

    <div class="container">
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

        <div class="main-wrapper">
            <div class="navbar">
                <a href="#"></a>
                <div class="profile">
                    <a href="../profile/profile.php">
                        <img src="../images/user.png" alt="Profile">
                    </a>
                </div>
                <a href="../../../Login/Logout.php" class="logout">Logout</a>
            </div>

            <div class="space"></div>
            <div class="main-container controls card1">
                <h1>Appointment Management</h1>
            </div>
            <div class="dashboard-cards">
                <div class="card">
                    <h3>Total Appointments</h3>
                    <p><?= $totalAppointments ?></p>
                </div>
                <div class="card">
                    <h3>Completed</h3>
                    <p><?= $statusCounts['Completed'] ?? 0 ?></p>
                </div>
                <div class="card">
                    <h3>Pending</h3>
                    <p><?= $statusCounts['Pending'] ?? 0 ?></p>
                </div>
                <div class="card">
                    <h3>Rejected</h3>
                    <p><?= $statusCounts['Rejected'] ?? 0 ?></p>
                </div>
                <div class="card">
                    <h3>Assigned</h3>
                    <p><?= $statusCounts['Assigned'] ?? 0 ?></p>
                </div>
            </div>

            <div class="main-container">
                <div class="search-container">
                    <div>
                        <form method="GET" class="filter-form" style="margin-bottom: 20px;">
        <label>
            Service:
            <select name="service_type">
                <option value="">All</option>
                <option value="Consulting" <?= isset($_GET['service_type']) && $_GET['service_type'] == 'Consulting' ? 'selected' : '' ?>>Consulting</option>
                <option value="Training" <?= isset($_GET['service_type']) && $_GET['service_type'] == 'Training' ? 'selected' : '' ?>>Training</option>
                <option value="Researching" <?= isset($_GET['service_type']) && $_GET['service_type'] == 'Researching' ? 'selected' : '' ?>>Researching</option>
            </select>
        </label>
        <label>
            Status:
            <select name="status">
                <option value="">All</option>
                <option value="Pending" <?= isset($_GET['status']) && $_GET['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                <option value="Completed" <?= isset($_GET['status']) && $_GET['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
                <option value="Rejected" <?= isset($_GET['status']) && $_GET['status'] == 'Rejected' ? 'selected' : '' ?>>Rejected</option>
                <option value="Assigned" <?= isset($_GET['status']) && $_GET['status'] == 'Assigned' ? 'selected' : '' ?>>Assigned</option>
                <option value="Scheduled" <?= isset($_GET['status']) && $_GET['status'] == 'Scheduled' ? 'selected' : '' ?>>Scheduled</option>
                <option value="Cancelled" <?= isset($_GET['status']) && $_GET['status'] == 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
            </select>
        </label>
        <label>
            Date From:
            <input type="date" name="date_from" value="<?= isset($_GET['date_from']) ? htmlspecialchars($_GET['date_from']) : '' ?>">
        </label>
        <label>
            Date To:
            <input type="date" name="date_to" value="<?= isset($_GET['date_to']) ? htmlspecialchars($_GET['date_to']) : '' ?>">
        </label>
        <button type="submit">Filter</button>
    </form>
                    </div>
                    <div>
                        <button id="addAppointmentBtn" class="btn" onclick="openPopup('addAppointmentOverlay')">Add Appointment</button>
                    </div>
                </div>

                <table class="appointment-table">
                    <thead>
                        <tr>
                            <th>Service</th>
                            <th>Appointment Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="appointmentList">
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= htmlspecialchars($user['service_type']) ?></td>
                                <td><?= htmlspecialchars($user['appointment_date']) ?></td>
                                <td><?= htmlspecialchars($user['status']) ?></td>
                                <td>
                                    <?php if ($user['status'] == 'Pending'): ?>
                                        <form style="display: inline;" action="update_appointment.php?appointment_id=<?= htmlspecialchars($user['appointment_id']) ?>" method="GET">
                                            <input type="hidden" name="appointment_id" value="<?= htmlspecialchars($user['appointment_id']) ?>">
                                            <button type="submit" class="btn edit-btn">Edit</button>
                                        </form>
                                    <?php endif; ?>

                                    <?php if ($user['provider_id'] !== null && in_array($user['status'], ['Completed', 'rejected', 'Assigned', 'Scheduled'])): ?>
                                        <form action='view_appointment.php?appointment_id=<?= htmlspecialchars($user['appointment_id']) ?>' style="display: inline;">
                                            <input type="hidden" name="appointment_id" value="<?= htmlspecialchars($user['appointment_id']) ?>">
                                            <button type="submit" class="btn view-btn">View</button>
                                        </form>
                                    <?php endif; ?>
                                    <?php if ($user['status'] == 'Rejected'): ?>
                                        <form action='view_appointment.php?appointment_id=<?= htmlspecialchars($user['appointment_id']) ?>' style="display: inline;">
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

            <div id="addAppointmentOverlay" class="overlay">
                <div class="overlay-content">
                    <span class="close-btn" onclick="closePopup('addAppointmentOverlay')">&times;</span>
                    <h2>Add New Appointment</h2>
                    <form id="appointmentForm" action="add_appointment.php" method="POST">
                        <div class="form-group">
                            <label for="serviceSelect">Select a Service</label>
                            <select id="serviceSelect" name="serviceSelect" required>
                                <option value="">Choose a Service</option>
                                <option value="Consultant">Consulting</option>
                                <option value="Trainer">Training</option>
                                <option value="Researcher">Researching</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fieldName">Field Name</label>
                            <select id="fieldName" name="fieldName" required>
                                <option value="">Choose a Service</option>
                                <option value="Development Finance">Development Finance</option>
                                <option value="Micro Finance">Micro Finance</option>
                                <option value="Gender Finance">Gender Finance</option>
                                <option value="SME Development">SME Development</option>
                                <option value="Strategic and Operations Planning">Strategic and Operations Planning</option>
                                <option value="Institutional Development">Institutional Development</option>
                                <option value="Community Development">Community Development</option>
                                <option value="Organizational Development">Organizational Development</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="appointmentDate">Select a Date</label>
                            <input type="date" id="appointmentDate" name="appointmentDate" required>
                        </div>
                        <div class="form-group">
                            <label for="additionalMessage">Additional Message</label>
                            <textarea id="additionalMessage" name="additionalMessage" rows="4" required></textarea>
                        </div>
                        <button type="submit" id="Bookappointmentbtn" class="btn">Book Appointment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
