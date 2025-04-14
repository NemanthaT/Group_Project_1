<?php
include '../Session/Session.php';
include '../connection.php';

$projectId = $_GET['project_id'];
$providerId = $_SESSION['provider_id'];
if (!isset($projectId)) {
    die("Project ID not specified.");
    header("Location: Project.php");
}

$sql = "SELECT * FROM projects WHERE provider_id = '$providerId' AND project_id = '$projectId'";
$clientSql = "SELECT client_id, full_name, phone FROM clients WHERE client_id = (SELECT client_id FROM projects WHERE project_id = '$projectId')";
$log = "SELECT * FROM projectstatuslogs WHERE project_id = '$projectId'ORDER BY changed_at DESC ;";
$logfinal = "SELECT * FROM projectstatuslogs WHERE project_id = '$projectId' ORDER BY changed_at DESC LIMIT 1;";



$presult = $conn->query($sql);
$resultClient = $conn->query($clientSql);
$logResult = $conn->query($log);
$logfinalResult = $conn->query($logfinal);

if ($resultClient === false) {
    die("Error: " . $conn->error);
}
if ($presult === false) {
    die("Error: " . $conn->error);
}
if ($logResult === false) {
    die("Error: " . $conn->error);
}


    $client_row = $resultClient->fetch_assoc();
    $prow = $presult->fetch_assoc();
    $logfinal_row = $logfinalResult->fetch_assoc();

    
    
    $project_name = $prow['project_name'];
    $project_description = $prow['project_description'];
    $project_phase = $prow['project_phase'];
    $project_status = $prow['project_status'];
    $created_date = $prow['created_date'];
    $project_id = $prow['project_id'];
    $client_name = $client_row['full_name'];
    $client_phone = $client_row['phone'];
    $client_id = $client_row['client_id'];
    $start_date = $prow['created_date'];
    $updated_date = $logfinal_row['changed_at'];
    

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
                <h1><?php echo $project_name; ?></h1>
                <p><?php echo $project_description; ?></p>
            </div>
            <div>
                <span class="status-badge status-ongoing">Current Status: <?php echo $project_status; ?></span>
            </div>
        </div>

        <!-- Project Details -->
        <div class="document-details">
            <div class="detail-card">
                <h2>Project Overview</h2>
                <div class="detail-item">
                    <label>Project Name:</label>
                    <p><?php echo $project_name; ?></p>
                </div>
                <div class="detail-item">
                    <label>Project ID:</label>
                    <p><?php echo $project_id; ?></p>
                </div>
                <div class="detail-item">
                    <label>Client Name:</label>
                    <p><?php echo $client_name; ?></p>
                </div>
                <div class="detail-item">
                    <label>Client Phone Number:</label>
                    <p><?php echo $client_phone; ?></p>
                </div>
            </div>

            <div class="detail-card">
                <h2>Project Status</h2>
                <div class="detail-item">
                    <label>Current Status:</label>
                    <span class="status-badge status-ongoing"><?php echo $project_status; ?></span>
                </div>
                <div class="detail-item">
                    <label>Project Phase:</label>
                    <p><?php echo $project_phase; ?></p>
                </div>
                <div class="detail-item">
                    <label>Start Date:</label>
                    <p><?php echo $start_date; ?></p>
                </div>
                <div class="detail-item">
                    <label>Updated Date:</label>
                    <p><?php echo $updated_date; ?></p>
                </div>
            </div>
        </div>

        <!-- Status Update Section -->
        <div class="status-update-section">
            <div class="status-grid">
                <!-- Project Phase Update -->
                <div class="status-card">
                    <h3>Project Phase Update</h3>
                    <form action="" method="post">
                    <select class="status-select" id="projectPhaseSelect" name="projectPhaseSelect">
                        <option value="">Select Project Phase</option>
                        <option value="requirement-gathering">Requirement Gathering</option>
                        <option value="design">Design Phase</option>
                        <option value="development">Development</option>
                        <option value="testing">Testing</option>
                        <option value="deployment">Deployment</option>
                        <option value="maintenance">Maintenance</option>
                    </select>
                    <?php if (isset($_SESSION['phase'])): ?>
                    <div class="alert alert-success"><?php echo $_SESSION['phase']; unset($_SESSION['phase']); ?></div>
                    <?php unset($_SESSION['phase']); ?>
                    <?php endif; ?>
                    <button class="btn btn-primary">Update Phase</button>
                    </form>
                </div>

                <!-- Project Status Update -->
                <div class="status-card">
                    <h3>Project Status Update</h3>
                    <form action="" method="post">
                    <select class="status-select" id="projectStatusSelect" name="projectStatusSelect">
                        <option value="">Select Project Status</option>
                        <option value="ongoing">Ongoing</option>
                        <option value="completed">Completed</option>
                        <option value="on-hold">On Hold</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    <?php if (isset($_SESSION['status'])): ?>
                    <div class="alert alert-success"><?php echo $_SESSION['status']; unset($_SESSION['status']); ?></div>
                    <?php endif; ?>
                    <button class="btn btn-success" >Update Status</button>
                    </form>
                    
                </div>
            </div>
        </div>



        <!-- Document Upload Section -->
        <div class="document-upload">
            <br>
            <h2>Upload Documents</h2>
            <input type="file" class="uploard" id="documentUpload"  />
            <label for="fileName"> File name </label>
            <input type="text" class="uploard" id="fileName" placeholder="Enter file name" />
            <button class="btn btn-primary">Upload Document</button>

            </div>
        

        <!-- Document List Section -->
        <div class="document-list">
            <h2>Uploaded Documents</h2>
            <br>
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
                <!-- Status Log Section -->
                <div class="status-log">
            <h2>Status Log</h2>
            <br>
            <?php if ($logResult->num_rows > 0): ?>
                <?php while ($log_row = $logResult->fetch_assoc()): ?>
                    <div class="status-log-item">
                    <p><?php echo htmlspecialchars($log_row['message']); ?></p>
                    <span><?php echo htmlspecialchars($log_row['changed_at']); ?></span>
                    </div>
                   
                   <?php  endwhile; ?>
                   <?php else: ?>
        <p>No projects found.</p>
    <?php endif; ?>
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
                
                <?php
                    
                    if (isset($_POST['projectPhaseSelect'])) {
                        $updatePhase = $_POST['projectPhaseSelect'];
                        $QupdatePhase = "UPDATE projects SET project_phase = '$updatePhase' WHERE project_id = $projectId ";
                        mysqli_query($conn, $QupdatePhase);
                        $logUpdatePhase = "INSERT INTO projectstatuslogs (project_id, message, changed_at) VALUES ('$projectId', 'Project phase updated to $updatePhase', NOW());";
                        mysqli_query($conn, $logUpdatePhase);
                        $_SESSION['phase'] = "Project phase updated successfully.";
                        header("Location: EditProject.php?project_id=$projectId");
                    }

                    exit();
                ?>
            });

            statusUpdateBtn.addEventListener('click', () => {

                
                <?php
                    if (isset($_POST['projectStatusSelect'])) {
                        $updateStatus = $_POST['projectStatusSelect'];
                        $QupdateStatus = "UPDATE projects SET project_status = '$updateStatus' WHERE project_id = $projectId ";
                        mysqli_query($conn, $QupdateStatus);
                        $logUpdateStatus = "INSERT INTO projectstatuslogs (project_id, message, changed_at) VALUES ('$projectId', 'Project status updated to $updateStatus', NOW());";
                        mysqli_query($conn, $logUpdateStatus);  
                        $_SESSION['status'] = "Project status updated successfully.";
                        header("Location: EditProject.php?project_id=$projectId");
            
                    }

                    exit();
                ?>
            });
        });
    </script>

            </div>
            </div>
            </div>
    <script src="#"></script>
</body>
</html>