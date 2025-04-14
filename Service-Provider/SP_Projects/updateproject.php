<?php
include '../Session/Session.php';
include '../connection.php';

$projectId = $_GET['project_id'];
$providerId = $_SESSION['provider_id'];
if (!isset($projectId)) {
    die("Project ID not specified.");
    header("Location: Project.php");
}

                    $updatePhase = $_POST['projectPhaseSelect'];
                    $QupdatePhase = "UPDATE projects SET project_phase = '$updatePhase' WHERE provider_id = $providerId";
                    mysqli_query($conn, $QupdatePhase);
                    

                    $logUpdatePhase = "INSERT INTO projectstatuslogs (project_id, message, changed_at) VALUES ('$projectId', 'Project phase updated to $updatePhase', NOW());";
                    mysqli_query($conn, $logUpdatePhase);
                ?>