<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main-container">
        <header>
            <h1>Appointment Management</h1>
        </header>

        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Search by Appointment ID or Service...">
            <button id="addAppointmentBtn" class="btn">Add Appointment</button>
        </div>

        <table class="appointment-table">
            <thead>
                <tr>
                    <th>Appointment ID</th>
                    <th>Service</th>
                    <th>Appointment Date</th>
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="appointmentList">
                <!--<tr>
                    <td>1</td>
                    <td>Dental Checkup</td>
                    <td>2023-10-10</td>
                    <td>Confirmed</td>
                    <td>2023-09-01</td>
                    <td>
                        <button class="btn edit-btn">Edit</button>
                        <button class="btn cancel-btn">Cancel</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Medical Consultation</td>
                    <td>2023-10-12</td>
                    <td>Pending</td>
                    <td>2023-09-05</td>
                    <td>
                        <button class="btn edit-btn">Edit</button>
                        <button class="btn cancel-btn">Cancel</button>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Massage Therapy</td>
                    <td>2023-10-15</td>
                    <td>Confirmed</td>
                    <td>2023-09-10</td>
                    <td>
                        <button class="btn edit-btn">Edit</button>
                        <button class="btn cancel-btn">Cancel</button>
                    </td>
                </tr>-->
                <?php
                    include '../connect/connect.php';
                    $sql = "SELECT * FROM appointments";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['appointment_id'] . "</td>";
                            echo "<td>" . $row['service_type'] . "</td>";
                            echo "<td>" . $row['appointment_date'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            echo "<td>" . $row['created_at'] . "</td>";
                            echo "<td>";
                            echo "<button class='btn edit-btn'>Edit</button>";
                            echo "<button class='btn cancel-btn'>Cancel</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
                ?>
            </tbody>
        </table>

        <!-- Add Appointment Overlay -->
        <div id="addAppointmentOverlay" class="overlay">
            <div class="overlay-content">
                <span class="close-btn">&times;</span>
                <h2>Add New Appointment</h2>
                <form id="appointmentForm">
                    <div class="form-group">
                        <label for="serviceSelect">Select a Service</label>
                        <select id="serviceSelect" name="serviceSelect" required>
                            <option value="">Choose a Service</option>
                            <option value="training">training</option>
                           
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
                    <button type="submit" class="btn">Book Appointment</button>
                </form>
            </div>
        </div>

    </div>

    <script>
        // JavaScript to handle overlay visibility
        document.getElementById('addAppointmentBtn').onclick = function() {
            document.getElementById('addAppointmentOverlay').style.display = 'block';
        }

        document.querySelector('.close-btn').onclick = function() {
            document.getElementById('addAppointmentOverlay').style.display = 'none';
        }

        // Close the overlay if the user clicks outside of the overlay content
        window.onclick = function(event) {
            const overlay = document.getElementById('addAppointmentOverlay');
            if (event.target === overlay) {
                overlay.style.display = 'none';
            }
        }

        // Add functionality for searching appointments
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#appointmentList tr');

            rows.forEach(row => {
                const appointmentId = row.cells[0].textContent.toLowerCase();
                const service = row.cells[1].textContent.toLowerCase();
                if (appointmentId.includes(filter) || service.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Handle form submission for adding appointments
        document.getElementById('appointmentForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const service = document.getElementById('serviceSelect').value;
            const date = document.getElementById('appointmentDate').value;
            const message = document.getElementById('additionalMessage').value;

            // Create a new row in the appointment table
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${document.querySelectorAll('#appointmentList tr').length + 1}</td>
                <td>${service}</td>
                <td>${date}</td>
                <td>Pending</td>
                <td>${new Date().toISOString().split('T')[0]}</td>
                <td>
                    <button class="btn edit-btn">Edit</button>
                    <button class="btn cancel-btn">Cancel</button>
                </td>
            `;
            document.getElementById('appointmentList').appendChild(newRow);
            document.getElementById('addAppointmentOverlay').style.display = 'none';
            this.reset(); // Reset the form
        });
    </script>
</body>
</html>