<?php
    // Turn off all error reporting for production
    error_reporting(0);
    ini_set('display_errors', 0);

    // Or for development, you can use this to see errors but log them instead of displaying
    // error_reporting(E_ALL);
    // ini_set('display_errors', 0);
    // ini_set('log_errors', 1);
    // ini_set('error_log', '../error_log.txt');
    include '../Session/Session.php';
    include '../connection.php';

    $projectId = $_GET['project_id'];
    $providerId = $_SESSION['provider_id'];

    $sql = "SELECT * FROM projects WHERE provider_id = '$providerId' AND project_id = '$projectId'";
    $clientSql = "SELECT client_id, full_name, phone FROM clients WHERE client_id = (SELECT client_id FROM projects WHERE project_id = '$projectId')";
    $log = "SELECT * FROM projectstatuslogs WHERE project_id = '$projectId' ORDER BY changed_at DESC;";
    $logfinal = "SELECT * FROM projectstatuslogs WHERE project_id = '$projectId' ORDER BY changed_at DESC LIMIT 1;";
    $doc ="SELECT * from projectdocuments where project_id = '$projectId';";

    $presult = $conn->query($sql);
    $resultClient = $conn->query($clientSql);
    $logResult = $conn->query($log);
    $logfinalResult = $conn->query($logfinal);
    $docResult = $conn->query($doc);
    

    if ($resultClient === false) {
        die("Error: " . $conn->error);
    }
    if ($presult === false) {
        die("Error: " . $conn->error);
    }
    if ($logResult === false) {
        die("Error: " . $conn->error);
    }
    if ($docResult === false) {
        die("Error: " . $conn->error);
    }

    if (isset($_POST['projectStatusSelect'])) {
        $updateStatus = $_POST['projectStatusSelect'];
        $QupdateStatus = "UPDATE projects SET project_status = '$updateStatus' WHERE project_id = $projectId";
        mysqli_query($conn, $QupdateStatus);
        $logUpdateStatus = "INSERT INTO projectstatuslogs (project_id, message, changed_at) VALUES ('$projectId', 'Project status updated to $updateStatus', NOW());";
        mysqli_query($conn, $logUpdateStatus);
        $_SESSION['status'] = "Project status updated successfully.";
        header("Location: EditProject.php?project_id=$projectId");
    }

    if (isset($_POST['projectPhaseSelect'])) {
        $updatePhase = $_POST['projectPhaseSelect'];
        $QupdatePhase = "UPDATE projects SET project_phase = '$updatePhase' WHERE project_id = $projectId";
        mysqli_query($conn, $QupdatePhase);
        $logUpdatePhase = "INSERT INTO projectstatuslogs (project_id, message, changed_at) VALUES ('$projectId', 'Project phase updated to $updatePhase', NOW());";
        mysqli_query($conn, $logUpdatePhase);
        $_SESSION['phase'] = "Project phase updated successfully.";
        header("Location: EditProject.php?project_id=$projectId");
        exit();
    }
    
    $prow = $presult->fetch_assoc();
    $project_id = $prow['project_id'];


    if (isset($_POST["submit_document"]) && isset($_FILES["upload_documents"])) {

        // Validate file upload
        if ($_FILES['upload_documents']['error'] === UPLOAD_ERR_OK) {
            // Get and sanitize file information
            $document_name = isset($_POST['fileName']) ? trim($_POST['fileName']) : '';
            $file_name = basename($_FILES['upload_documents']['name']);
            $file_tmp = $_FILES['upload_documents']['tmp_name'];
            $file_size = $_FILES['upload_documents']['size'];
            $file_type = $_FILES['upload_documents']['type'];

            // Create upload directory if it doesn't exist
            $upload_dir = '../../uploads/' . $project_id . '/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            // Corrected to use $file_name
            $upload_path = $upload_dir . $file_name; 

            // Move the uploaded file
            if (move_uploaded_file($_FILES['upload_documents']['tmp_name'], $upload_path)) {

            $query_file_upload = "INSERT INTO `projectdocuments` (project_id, file_name, file_path) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query_file_upload);

            mysqli_stmt_bind_param($stmt, "iss", $project_id, $document_name, $upload_path);
            $result_file_upload = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            // Log the document upload
            $log_message = "Document uploaded: " . $document_name;
            $query_log = "INSERT INTO projectstatuslogs (project_id, message, changed_at) VALUES (?, ?, NOW())";
            $log_stmt = mysqli_prepare($conn, $query_log);

            mysqli_stmt_bind_param($log_stmt, "is", $project_id, $log_message);
            $result_log = mysqli_stmt_execute($log_stmt);
            mysqli_stmt_close($log_stmt);

            header("Location: EditProject.php?project_id=$projectId");
            exit();
            }
        }
    }

    $client_row = $resultClient->fetch_assoc();
    $logfinal_row = $logfinalResult->fetch_assoc();
       
    $project_name = $prow['project_name'];
    $project_description = $prow['project_description'];
    $project_phase = $prow['project_phase'];
    $project_status = $prow['project_status'];
    $created_date = $prow['created_date'];
    $client_name = isset($client_row['full_name']) ? $client_row['full_name'] : 'N/A';
    $client_phone = isset($client_row['phone']) ? $client_row['phone'] : 'N/A';
    $client_id = isset($client_row['client_id']) ? $client_row['client_id'] : 'N/A';
    $start_date = $prow['created_date'];
    $updated_date = isset($logfinal_row['changed_at']) ? $logfinal_row['changed_at'] : $start_date;   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka Consultancy</title>
    <?php include '../Common template/SP_common.php'; ?>
    <link rel="stylesheet" href="../Common template/SP_common.css">
    <link rel="stylesheet" href="Project.css">
</head>
<body> 
        <div class="main-content">
            <div class="project-section">
            <a href="Project.php" class="back-button">← Back to Projects</a>
                <!-- Project Header -->
                <div class="project-header-edit">
                    <div>
                        <h1><?php echo htmlspecialchars($project_name); ?></h1>
                        <p><?php echo htmlspecialchars($project_description); ?></p>
                    </div>
                    <div>
                        <span class="status-badge status-<?php echo strtolower($project_status); ?>">Current Status: <?php echo htmlspecialchars($project_status); ?></span>
                    </div>
                </div>

                <!-- Project Details -->
                <div class="document-details">
                    <div class="detail-card">
                        <h2>Project Overview</h2>
                        <div class="detail-item">
                            <label>Project Name:</label>
                            <p><?php echo htmlspecialchars($project_name); ?></p>
                        </div>
                        <div class="detail-item">
                            <label>Project ID:</label>
                            <p><?php echo htmlspecialchars($project_id); ?></p>
                        </div>
                        <div class="detail-item">
                            <label>Client Name:</label>
                            <p><?php echo htmlspecialchars($client_name); ?></p>
                        </div>
                        <div class="detail-item">
                            <label>Client Phone Number:</label>
                            <p><?php echo htmlspecialchars($client_phone); ?></p>
                        </div>
                    </div>

                    <div class="detail-card">
                        <h2>Project Status</h2>
                        <div class="detail-item">
                            <label>Current Status:</label>
                            <span class="status-badge status-<?php echo strtolower($project_status); ?>"><?php echo htmlspecialchars($project_status); ?></span>
                        </div>
                        <div class="detail-item">
                            <label>Project Phase:</label>
                            <p><?php echo htmlspecialchars($project_phase); ?></p>
                        </div>
                        <div class="detail-item">
                            <label>Start Date:</label>
                            <p><?php echo htmlspecialchars($start_date); ?></p>
                        </div>
                        <div class="detail-item">
                            <label>Updated Date:</label>
                            <p><?php echo htmlspecialchars($updated_date); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Status Update Section -->
                <div class="status-update-section">
                    <div class="status-grid">
                        <!-- Project Phase Update -->
                        <div class="status-card">
                            <h3>Project Phase Update</h3>
                            <form action="EditProject.php?project_id=<?php echo $projectId; ?>" method="post">
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
                                <?php endif; ?>
                                <button type="submit" class="btn btn-primary">Update Phase</button>
                            </form>
                        </div>

                        <!-- Project Status Update -->
                        <div class="status-card">
                            <h3>Project Status Update</h3>
                            <form action="EditProject.php?project_id=<?php echo $projectId; ?>" method="post">
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
                                <button type="submit" class="btn btn-success">Update Status</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Document Upload Section -->
                <form action="EditProject.php?project_id=<?php echo $projectId; ?>" method="post" enctype="multipart/form-data">
                    <div class="document-upload">
                        <h2>Upload Documents</h2>
                        <div>
                            <input type="file" class="upload" id="upload_documents" name="upload_documents" />
                            <label for="fileName">File name:</label>
                            <input type="text" class="upload" id="fileName" name="fileName" placeholder="Enter file name" />
                            <button type="submit" class="btn btn-primary" name="submit_document">Upload Document</button>
                        </div>
                    </div>
                </form>

                <!-- Document List Section -->
                <div class="document-list">
                    <h2>Uploaded Documents</h2>
                    <?php if ($docResult->num_rows > 0): ?>
                        <?php while ($doc_row = $docResult->fetch_assoc()): ?>
                            <div class="document-list-item">
                                <a href="<?php echo htmlspecialchars($doc_row['file_path']); ?>" target="_blank" style="text-decoration: none; color: #333;">
                                    <span><?php echo htmlspecialchars($doc_row['file_name']); ?></span>
                                </a>
                                <form action="delete_doc.php?project_id=<?php echo $projectId; ?>&doc_id=<?php echo $doc_row['document_id']; ?>" method="post" style="display:inline;">
                                    <input type="hidden" name="document_id" value="<?php echo $doc_row['document_id']; ?>">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No documents uploaded.</p>
                    <?php endif; ?>
                </div>

                <!-- Status Log Section -->
                <div class="status-log">
                    <h2>Status Log</h2>
                    <?php if ($logResult->num_rows > 0): ?>
                        <?php while ($log_row = $logResult->fetch_assoc()): ?>
                            <div class="status-log-item">
                                <p><?php echo htmlspecialchars($log_row['message']); ?></p>
                                <span><?php echo htmlspecialchars($log_row['changed_at']); ?></span>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No status logs found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>   <!--this is the </div> of container in the common file, don't remove it-->
<script src="Project.js"></script>
<script src="../Common template/Calendar.js"></script>
</body>
</html>