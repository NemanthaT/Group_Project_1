<?php
session_start();
require_once('../connect.php');

if (!isset($_SESSION['email'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$email = $_SESSION['email'];
$fullName = $_POST['fullName'];
$address = $_POST['address'];
$phone = $_POST['phone'];

$sql = "UPDATE companyworkers SET 
        full_name = '$fullName', 
        address = '$address', 
        phoneNo = '$phone' 
        WHERE email = '$email'";

if (mysqli_query($con, $sql)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => mysqli_error($con)]);
}
?>
