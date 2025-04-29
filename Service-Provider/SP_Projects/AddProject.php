<?php
include '../Session/Session.php';
include '../connection.php';
include '../Common template/SP_common.php';

$client_id = $_GET['client_id'] ?? null;
$appointment_id = $_GET['appointment_id'] ?? null;

if (isset($_POST['submit'])) { 
    $client_id = filter_var($_POST['client_id'], FILTER_VALIDATE_INT);
    $appointment_id = filter_var($_POST['appointment_id'], FILTER_VALIDATE_INT);
    $project_name = mysqli_real_escape_string($conn, $_POST['project_name']);
    $project_description = mysqli_real_escape_string($conn, $_POST['project_description']);
    $project_phase = mysqli_real_escape_string($conn, $_POST['project_phase']);
    $project_status = 'Ongoing';
    $provider_id = $_SESSION['provider_id'];

    if ($client_id === false) {
        $c_errorMsg = "Invalid client ID.";
    } elseif ($appointment_id === false) {
        $errorMsg = "Invalid appointment ID.";
    } else {
        $query_getclientname = "SELECT full_name FROM `clients` WHERE client_id = ?";
        $stmt_client = $conn->prepare($query_getclientname);
        $stmt_client->bind_param("i", $client_id);
        $stmt_client->execute();
        $result_clientname = $stmt_client->get_result();

        if ($result_clientname->num_rows > 0) {
            $client_data = $result_clientname->fetch_assoc();
            $client_name = $client_data['full_name'];

            $query_submit = "INSERT INTO `projects` (client_id, provider_id, project_name, project_description, project_phase, project_status) 
                             VALUES (?, ?, ?, ?, ?, ?)";
            $stmt_project = $conn->prepare($query_submit);
            $stmt_project->bind_param("iissss", $client_id, $provider_id, $project_name, $project_description, $project_phase, $project_status);
            $result = $stmt_project->execute();

            if ($result) {
                $project_id = $conn->insert_id;

                $query_update_appointment = "UPDATE appointments 
                                             SET status = ? 
                                             WHERE appointment_id = ?";
                $stmt_appointment = $conn->prepare($query_update_appointment);
                $new_status = "Completed";
                $stmt_appointment->bind_param("si", $new_status, $appointment_id);
                $result_update_appointment = $stmt_appointment->execute();

                if (!$result_update_appointment && $conn->affected_rows === 0) {
                    $errorMsg = "No appointment found with the provided ID.";
                } elseif (!$result_update_appointment) {
                    $errorMsg = "Error updating appointment status: " . $conn->error;
                }

                if (isset($_FILES['upload_documents']) && $_FILES['upload_documents']['name'] != '') {
                    $upload_dir = '../../Uploads/' . $project_id . '/';
                    $document_name = mysqli_real_escape_string($conn, $_POST['document_name']);
                    $file_name = $_FILES['upload_documents']['name'];
                    $file_tmp = $_FILES['upload_documents']['tmp_name'];

                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0777, true);
                    }
                    
                    if (move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
                        $query_file_upload = "INSERT INTO `projectdocuments` (project_id, file_name, file_path) 
                                             VALUES (?, ?, ?)";
                        $stmt_file = $conn->prepare($query_file_upload);
                        $file_path = $upload_dir . $file_name;
                        $stmt_file->bind_param("iss", $project_id, $document_name, $file_path);
                        $result_file_upload = $stmt_file->execute();

                        $query_log = "INSERT INTO projectstatuslogs (project_id, message, changed_at) 
                                      VALUES (?, ?, NOW())";
                        $stmt_log = $conn->prepare($query_log);
                        $log_message = "creating the project";
                        $stmt_log->bind_param("is", $project_id, $log_message);
                        $result_log = $stmt_log->execute();

                        if ($result_file_upload && $result_log) {
                            $successMsg = "$client_name's Project added successfully!";
                        } else {
                            $errorMsg = "Error: " . $conn->error;
                        }

                        $stmt_file->close();
                        $stmt_log->close();
                    } else {
                        $errorMsg = "File upload failed.";
                    }
                } else {
                    $query_log = "INSERT INTO projectstatuslogs (project_id, message, changed_at) 
                                  VALUES (?, ?, NOW())";
                    $stmt_log = $conn->prepare($query_log);
                    $log_message = "creating the project";
                    $stmt_log->bind_param("is", $project_id, $log_message);
                    $result_log = $stmt_log->execute();
                    
                    if ($result_log) {
                        $successMsg = "$client_name's Project added successfully!";
                    } else {
                        $errorMsg = "Error logging project status: " . $conn->error;
                    }

                    $stmt_log->close();
                }
            } else {
                $errorMsg = "Error inserting project: " . $conn->error;
            }

            $stmt_project->close();
            if (isset($stmt_appointment)) {
                $stmt_appointment->close();
            }
        } else {
            $c_errorMsg = "Client ID not found.";
        }

        $stmt_client->close();
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
        <div
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
                    
                    <?php if ($appointment_id): ?>
                        <input type="hidden" name="appointment_id" value="<?php echo htmlspecialchars($appointment_id); ?>">
                    <?php else: ?>
                        <div class="form-field">
                            <label for="appointment_id">Appointment ID</label>
                            <input type="text" id="appointment_id" name="appointment_id" placeholder="Enter appointment ID" required>
                            <?php if (!empty($errorMsg)): ?>
                                <div class="field-error">
                                    <?= $errorMsg ?>
                                    <?php unset($errorMsg); ?>
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