<?php
include '../Session/Session.php';
include '../connection.php';
include '../Common template/SP_common.php';

$client_id = $_GET['client_id'] ?? null;

if (isset($_POST['submit'])) { 
    $client_id = $_POST['client_id'];
    $project_name = $_POST['project_name'];
    $project_description = $_POST['project_description'];
    $project_phase = $_POST['project_phase'];
    $project_status = $_POST['project_status'];
    $provider_id = $_SESSION['provider_id'];

    // Fetch client name
    $query_getclientname = "SELECT * FROM `clients` WHERE client_id = '$client_id'";
    $result_clientname = mysqli_query($conn, $query_getclientname);

    if (mysqli_num_rows($result_clientname) > 0) {
        $client_data = mysqli_fetch_assoc($result_clientname);
        $client_name = $client_data['full_name'];

        if ($client_name) {
            // Insert project details
            $query_submit = "INSERT INTO `projects` (client_id, provider_id, project_name, project_description, project_phase, project_status) 
                             VALUES ('$client_id', '$provider_id', '$project_name', '$project_description', '$project_phase', '$project_status')";

            $result = mysqli_query($conn, $query_submit);

            if ($result) {
                $project_id = mysqli_insert_id($conn);

                // Handle file upload
                if (isset($_FILES['upload_documents']) && $_FILES['upload_documents']['name'] != '') {
                    $upload_dir = '../../uploads/' . $project_id . '/';
                    $document_name = $_POST['document_name'];
                    $file_name = $_FILES['upload_documents']['name'];
                    $file_tmp = $_FILES['upload_documents']['tmp_name'];

                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0777, true);
                    }
                    
                    if (move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
                        $query_file_upload = "INSERT INTO `projectdocuments` (project_id, file_name, file_path) VALUES ('$project_id', '$document_name', '$upload_dir$file_name')";
                        $result_file_upload = mysqli_query($conn, $query_file_upload);

                        $query_log = "INSERT INTO projectstatuslogs (project_id, message, changed_at) VALUES ('$project_id', 'creating the project', NOW());";
                        $result_log = mysqli_query($conn, $query_log);

                        if ($result_file_upload) {
                            if ($result_log) {
                                $successMsg = "$client_name's Project added successfully!";
                            } else {
                                $errorMsg = "Error logging project status: " . mysqli_error($conn);
                            }
                        } else {
                            $errorMsg = "Error: " . mysqli_error($conn);
                        }
                    } else {
                        $errorMsg = "File upload failed.";
                    }
                } else {
                    $query_log = "INSERT INTO projectstatuslogs (project_id, message, changed_at) VALUES ('$project_id', 'creating the project', NOW());";
                    $result_log = mysqli_query($conn, $query_log);
                    
                    if ($result_log) {
                        $successMsg = "$client_name's Project added successfully!";
                    } else {
                        $errorMsg = "Error logging project status: " . mysqli_error($conn);
                    }
                }
            } else {
                $errorMsg = "Error: " . mysqli_error($conn);
            }
        }
    } else {
        $c_errorMsg = "Client ID not found.";
    }
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
            <?php if (!empty($successMsg)): ?>
                <div class="success-message">
                    <?= $successMsg ?>
                    <?php unset($successMsg); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($errorMsg)): ?>
                <div class="error-message">
                    <?= $errorMsg ?>
                    <?php unset($errorMsg); ?>
                </div>
            <?php endif; ?>

            <div class="project-section">
                <a href="Project.php" class="back-button">← Back to Projects</a>
                <h2>Add Project</h2>
                
                <form class="project-form" action="AddProject.php" method="post" enctype="multipart/form-data">
                    <?php if ($client_id): ?>
                        <input type="hidden" name="client_id" value="<?php echo htmlspecialchars($client_id); ?>">
                    <?php else: ?>
                        <div class="form-field">
                            <label for="client_id">Client ID</label>
                            <input type="text" id="client_id" name="client_id" placeholder="Enter client ID" required>
                            <?php if (!empty($c_errorMsg)): ?>
                                <div class="field-error">
                                    <?= $c_errorMsg ?>
                                    <?php unset($c_errorMsg); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
               
                    <div class="form-field">
                        <label for="project_name">Project Name</label>
                        <input type="text" id="project_name" name="project_name" placeholder="Enter project name" required>
                    </div>
                    
                    <div class="form-field">
                        <label for="project_description">Project Description</label>
                        <textarea id="project_description" name="project_description" placeholder="Describe the project" required></textarea>
                    </div>
                    
                    <div class="form-field">
                        <label for="project_phase">Select Project Phase</label>
                        <select id="project_phase" name="project_phase" required>
                            <option value="">Select a phase</option>
                            <option value="Planning">Planning</option>
                            <option value="Execution">Execution</option>
                            <option value="Closure">Closure</option>
                        </select>
                    </div>
                    
                    <div class="form-field">
                        <label for="project_status">Project Status Update</label>
                        <input type="text" id="project_status" name="project_status" placeholder="Enter project status" required>
                    </div>
                    
                    
                    <div class="form-field">
                        <label for="upload_documents">Upload Documents</label>
                        <div class="upload-container">
                            <input type="text" id="document_name" name="document_name" placeholder="Upload name">
                            <div class="file-input-wrapper">
                                <input type="file" id="upload_documents" name="upload_documents" class="file-input">
                                <label for="upload_documents" class="file-label">Choose File</label>
                                <span id="file-name-display">No file chosen</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <a href="Project.php" class="cancel-button">Cancel</a>
                        <button type="submit" name="submit" class="submit-button">Add Project</button>
                    </div>
                </form>
            </div>  
        </div>

    <script>
        // Display selected filename
        document.getElementById('upload_documents').addEventListener('change', function() {
            const fileName = this.files[0] ? this.files[0].name : 'No file chosen';
            document.getElementById('file-name-display').textContent = fileName;
        });
    </script>
</div>   <!--this is the </div> of container in the common file, don't remove it-->
<script src="Project.js"></script>
<script src="../Common template/Calendar.js"></script>
</body>
</html>