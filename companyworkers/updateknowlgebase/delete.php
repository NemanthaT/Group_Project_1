<?php
session_start();
require_once '../../config/config.php';

if (!isset($_SESSION['username'])) {
    http_response_code(403);
    exit('error');
}

if (isset($_POST['delete_id'])) {
    $id = intval($_POST['delete_id']);
    $sql = "DELETE FROM knowledgebase WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'error';
}
