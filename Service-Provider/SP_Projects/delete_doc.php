<?php
    include '../Session/Session.php';
    include '../connection.php';

    $projectId = $_GET['project_id'];
    $doc_id = $_GET['doc_id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($doc_id)) {
    $document_id = $_POST['document_id'];


    $stmt = $conn->prepare("DELETE FROM projectdocuments WHERE document_id = ?");
    $log = $conn->prepare("INSERT INTO projectstatuslogs (project_id, message , changed_at) VALUES ('$projectId', 'Deleted document id " . $doc_id . "', NOW());");
    $stmt->bind_param("i", $doc_id);

    $log->execute();
    $log->close();
    
    $stmt->execute();
    $stmt->close();
    $conn->close();


    header("Location: EditProject.php?project_id=" . $_GET['project_id']);
    
}
