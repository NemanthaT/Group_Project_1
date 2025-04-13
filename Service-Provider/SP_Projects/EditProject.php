<?php
include '../Session/Session.php';
include '../connection.php';

$projectId = $_GET['project_id'];
$providerId = $_SESSION['provider_id'];
if (!isset($projectId)) {
    die("Project ID not specified.");
    header("Location: Project.php");
}

$sql = "SELECT project_id, project_name, project_description, project_phase, project_status, created_date FROM projects WHERE provider_id = '$providerId' AND project_id = '$projectId'";
$result = $conn->query($sql);
if ($result === false) {
    die("Error: " . $conn->error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Prepare and execute the SQL statement to delete the project
    $deleteSql = "DELETE FROM projects WHERE project_id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("i", $projectId);

    if ($stmt->execute()) {
        echo "<script>alert('Project deleted successfully!');</script>";
        header("Location: Project.php");
        exit();
    } else {
        echo "<script>alert('Error deleting project: " . $conn->error . "');</script>";
    }

    $stmt->close();
} else {
            
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka Consultancy</title>
    <link rel="stylesheet" href="Project.css">
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
                        <!-- <a href="#">Home</a> -->
                    <div class="notification">   
                        <a href="#"><img src="../images/notification.png" alt="Notifications"></a>
                    </div> 
                    <div class="profile">
                        <a href="../SP_Profile/Profile.php"><img src="../images/user.png" alt="Profile"></a>
                    </div>
                    <a href="../../Login/Logout.php" class="logout">Logout</a>
                </nav>
            </header>

            <!-- Main Content -->
            <div class="main-content">

            <div class="container1">
        <!-- Project Header -->
        <div class="project-header">
            <div>
                <h1>Financial Consultancy Project Document</h1>
                <p>Comprehensive project management and documentation system</p>
            </div>
            <div>
                <span class="status-badge status-ongoing">Current Status: Ongoing</span>
            </div>
        </div>

        <!-- Project Details -->
        <div class="document-details">
            <div class="detail-card">
                <h2>Project Overview</h2>
                <div class="detail-item">
                    <label>Project Name:</label>
                    <p>Financial Consultancy for Board of Directors</p>
                </div>
                <div class="detail-item">
                    <label>Project ID:</label>
                    <p>EDSA-001</p>
                </div>
                <div class="detail-item">
                    <label>Client Company:</label>
                    <p>Eagle Digital Finance Solutions </p>
                </div>
                <div class="detail-item">
                    <label>Client Name:</label>
                    <p>Amarabandu Rupasinha</p>
                </div>
                <div class="detail-item">
                    <label>Client Phone Number:</label>
                    <p>071 234 5161</p>
                </div>
            </div>

            <div class="detail-card">
                <h2>Project Status</h2>
                <div class="detail-item">
                    <label>Current Status:</label>
                    <span class="status-badge status-ongoing">Ongoing</span>
                </div>
                <div class="detail-item">
                    <label>Project Phase:</label>
                    <p>Requirement Gathering</p>
                </div>
                <div class="detail-item">
                    <label>Start Date:</label>
                    <p>2023-09-01</p>
                </div>
                <div class="detail-item">
                    <label>Updated Date:</label>
                    <p>2025-02-29</p>
                </div>
            </div>
        </div>

        <!-- Status Update Section -->
        <div class="status-update-section">
            <div class="status-grid">
                <!-- Project Phase Update -->
                <div class="status-card">
                    <h3>Project Phase Update</h3>
                    <select class="status-select" id="projectPhaseSelect">
                        <option value="">Select Project Phase</option>
                        <option value="requirement-gathering">Requirement Gathering</option>
                        <option value="design">Design Phase</option>
                        <option value="development">Development</option>
                        <option value="testing">Testing</option>
                        <option value="deployment">Deployment</option>
                        <option value="maintenance">Maintenance</option>
                    </select>
                    <button class="btn btn-primary">Update Phase</button>
                </div>

                <!-- Project Status Update -->
                <div class="status-card">
                    <h3>Project Status Update</h3>
                    <select class="status-select" id="projectStatusSelect">
                        <option value="">Select Project Status</option>
                        <option value="ongoing">Ongoing</option>
                        <option value="completed">Completed</option>
                        <option value="on-hold">On Hold</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    <button class="btn btn-success">Update Status</button>
                </div>
            </div>
        </div>

        <!-- Status Log Section -->
        <div class="status-log">
            <h2>Status Log</h2>
            <div class="status-log-item">
                <p>Phase updated to Requirement Gathering on 2023-09-01</p>
                <span>By: Project Manager</span>
            </div>
            <div class="status-log-item">
                <p>Status updated to Ongoing on 2023-09-15</p>
                <span>By: Project Coordinator</span>
            </div>
        </div>

        <!-- Document Upload Section -->
        <div class="document-upload">
            <h2>Upload Documents</h2>
            <input type="file" class="uploard" id="documentUpload"  />
            <button class="btn btn-primary">Upload Document</button>
            <label for="fileName"> File name </label>
            <input type="text" class="file-name" id="fileName" placeholder="Enter file name" />
        </div>

        <!-- Document List Section -->
        <div class="document-list">
            <h2>Uploaded Documents</h2>
            <div class="document-list-item">
                <span>Project Proposal.pdf</span>
                <button class="btn btn-danger">Delete</button>
            </div>
            <div class="document-list-item">
                <span>Initial Meeting Notes.docx</span>
                <button class="btn btn-danger">Delete</button>
            </div>
            <div class="document-list-item">
                <span>Financial Analysis Report.xlsx</span>
                <button class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>

    <!-- Optional: Add JavaScript for interactivity -->
    <script>
        // You can add client-side functionality here
        document.addEventListener('DOMContentLoaded', (event) => {
            // Example: Add event listeners for buttons
            const phaseUpdateBtn = document.querySelector('.btn-primary');
            const statusUpdateBtn = document.querySelector('.btn-success');

            phaseUpdateBtn.addEventListener('click', () => {
                alert('Project Phase Update functionality to be implemented');
            });

            statusUpdateBtn.addEventListener('click', () => {
                alert('Project Status Update functionality to be implemented');
            });
        });
    </script>

            </div>
            </div>
            </div>
    <script src="#"></script>
</body>
</html>
