<?php
session_start();
include '../../config/config.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../../Login/login.php");
    exit;
}

if(isset($_GET['delete_id'])) {
    $delete_id = mysqli_real_escape_string($conn, $_GET['delete_id']);
    
    $sql = "DELETE FROM news WHERE news_id = '$delete_id'";
    
    if(mysqli_query($conn, $sql)) {
        echo "success";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Error: No news item specified for deletion";
}

?>
