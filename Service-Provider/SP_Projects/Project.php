<?php
include '../Session/Session.php';
include '../connection.php';
include '../Common template/SP_common.php';

$providerId = $_SESSION['provider_id']; 
$sql = "SELECT p.project_id, p.client_id, p.provider_id, p.project_name, p.project_description, p.project_phase, p.project_status, p.created_date, c.full_name 
        FROM projects p 
        LEFT JOIN clients c ON p.client_id = c.client_id 
        WHERE p.provider_id = '$providerId' 
        ORDER BY p.created_date DESC";
$result = $conn->query($sql);
if ($result === false) {
    die("Error: " . $conn->error);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka Consultancy</title>
    <link rel="stylesheet" href="../Common template/SP_common.css">
    <link rel="stylesheet" href="Project.css">
</head>
<body> 
    <div class="main-content">
        <div class="project-section">
            <center><h2>Project</h2></center>
            <div class="filter-group search-group">
                <select id="status-filter">
                    <option value="all">All Projects</option>
                    <option value="ongoing">Ongoing</option>
                    <option value="completed">Completed</option>
                    <option value="on-hold">On Hold</option>
                    <option value="cancelled">Cancelled</option>
                </select>
                <input type="text" placeholder="Search client name or service..." id="search">
                <!-- <button class="search-button" id="search-btn">Search</button> -->
                <button class="clear-button" id="clear-filters">Clear</button>
                <!-- Commented out Add Project button to prevent creating projects from this page -->
                <!-- <div class="add-project-button">
                    <a href="AddProject.php"><button class="search-button">+ Add Project</button></a>
                </div> -->
            </div>
            <div class="projects-grid">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="project-card">
                            <div class="project-header">
                                <span class="project-id">PROJECT</span>
                                <span class="status <?php echo strtolower($row['project_status']); ?>">
                                    <?php echo ucfirst($row['project_status']); ?>
                                </span>
                            </div>
                            <div class="project-content">
                                <div class="project-info">
                                    <p><strong>Service:</strong> <?php echo htmlspecialchars($row['project_name']); ?></p>
                                    <p><strong>Description:</strong> <?php echo htmlspecialchars($row['project_description']); ?></p>
                                    <p><strong>Date:</strong> <?php echo htmlspecialchars($row['created_date']); ?></p>
                                    <p><strong>Client Name:</strong> <?php echo htmlspecialchars($row['full_name'] ?? 'Unknown'); ?></p>
                                </div>
                                <a href="EditProject.php?project_id=<?php echo $row['project_id']; ?>">
                                    <button class="view-button">View</button>
                                </a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No projects found.</p>
                <?php endif; ?>
            </div>
        </div>   
    </div>    
<script src="Project.js"></script>
<script src="../Common template/Calendar.js"></script>
</body>
</html>