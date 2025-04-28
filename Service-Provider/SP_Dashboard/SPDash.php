<?php
include '../Session/Session.php';
include '../connection.php';
include '../Common template/SP_common.php';

$sp_email = $_SESSION['email'];
$sql = "SELECT PROVIDER_ID FROM serviceproviders WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $sp_email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$providerId = $row['PROVIDER_ID'];
$_SESSION['provider_id'] = $providerId;
$stmt->close();

// Fetch project stats
$project_stats = ['Assigned' => 0, 'Completed' => 0, 'Ongoing' => 0, 'Cancelled' => 0];

// Total projects
$sql = "SELECT COUNT(*) as total FROM projects WHERE provider_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $providerId);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    $project_stats['Assigned'] = $row['total'];
}
$stmt->close();

// Project status counts
$sql = "SELECT LOWER(project_status) as project_status, COUNT(*) as count 
        FROM projects 
        WHERE provider_id = ? 
        GROUP BY LOWER(project_status)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $providerId);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $status = $row['project_status'];
    if (in_array($status, ['completed', 'ongoing', 'cancelled'])) {
        $project_stats[ucfirst($status)] = $row['count'];
    }
}
$stmt->close();

// Fetch appointment stats
$appointment_stats = ['Total' => 0, 'Scheduled' => 0, 'Rejected' => 0, 'Cancelled' => 0];

// Total appointments
$sql = "SELECT COUNT(*) as total FROM appointments WHERE provider_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $providerId);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    $appointment_stats['Total'] = $row['total'];
}
$stmt->close();

// Appointment status counts
$sql = "SELECT LOWER(status) as status, COUNT(*) as count 
        FROM appointments 
        WHERE provider_id = ? 
        GROUP BY LOWER(status)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $providerId);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $status = $row['status'];
    if (in_array($status, ['scheduled', 'rejected', 'cancelled'])) {
        $appointment_stats[ucfirst($status)] = $row['count'];
    }
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka Consultancy</title>
    <link rel="stylesheet" href="../Common template/SP_common.css">
    <link rel="stylesheet" href="SPDash.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body> 
    <div class="main-content">
        <div class="dashboard-section">
            <!-- Left Section (Wider) -->
            <div class="left-section">
                <!-- First Row: Appointments, Forums, Payments -->
                <div class="cards-row">
                    <div class="card">
                        <h3>Appointments</h3>
                        <p>No. of Appointments: <?php echo $appointment_stats['Total']; ?></p>
                        <p>Scheduled: <?php echo $appointment_stats['Scheduled']; ?></p>
                        <p>Rejected: <?php echo $appointment_stats['Rejected']; ?></p>
                        <p>Cancelled: <?php echo $appointment_stats['Cancelled']; ?></p>
                    </div>

                    <div class="card">
                        <h3>Forums</h3>
                        <p>Created: 23</p>
                        <p>Views: 4</p>
                        <p>Likes: 19</p>
                    </div>

                    <div class="card">
                        <h3>Payments</h3>
                        <p>Recent Payments: 6</p>
                        <p>Upcoming: 2</p>
                        <p>Overdue: 1</p>
                    </div>
                </div>

                <!-- Second Row: Projects with Counts and Pie Chart -->
                <div class="cards-row">
                    <div class="card project-card">
                        <h3>Projects Overview</h3>
                        <div class="project-content">
                            <div class="project-stats">
                                <p>Total Assigned: <?php echo $project_stats['Assigned']; ?></p>
                                <div class="stat-item">
                                    <span class="stat-label completed">Completed:</span>
                                    <span class="stat-count"><?php echo $project_stats['Completed']; ?></span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-label ongoing">Ongoing:</span>
                                    <span class="stat-count"><?php echo $project_stats['Ongoing']; ?></span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-label cancelled">Cancelled:</span>
                                    <span class="stat-count"><?php echo $project_stats['Cancelled']; ?></span>
                                </div>
                            </div>
                            <div class="project-chart">
                                <canvas id="projectsPieChart" width="250" height="250"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Section (Narrower) -->
            <div class="right-section">
                <!-- Notifications -->
                <div class="notifications">
                    <h3>Notifications</h3>
                    <div class="no-notifications">
                        <span class="alert-icon">⚠️</span>
                        <p>No new notifications.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="SPDash.js"></script>
    <script src="../Common template/Calendar.js"></script>
    <script>
        // Pie Chart for Projects
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('projectsPieChart').getContext('2d');
            const completed = <?php echo $project_stats['Completed']; ?>;
            const ongoing = <?php echo $project_stats['Ongoing']; ?>;
            const cancelled = <?php echo $project_stats['Cancelled']; ?>;

            // Use counts for the chart
            const data = [completed, ongoing, cancelled];

            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Completed', 'Ongoing', 'Canceled'],
                    datasets: [{
                        data: data,
                        backgroundColor: ['#4F75FF', '#40C4B7', '#FF6B6B'], // Blue, Teal-Green, Coral-Red
                        borderColor: ['#ffffff', '#ffffff', '#ffffff'],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: {
                                    size: 14,
                                    family: "'Inter', sans-serif"
                                },
                                color: '#1A202C'
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.label}: ${context.parsed}`;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>