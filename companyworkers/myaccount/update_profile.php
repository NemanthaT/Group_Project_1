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
$passwordChanged = false;

$checkSql = "SELECT * FROM companyworkers WHERE email = '$email'";
$result = mysqli_query($con, $checkSql);

if (!$result || mysqli_num_rows($result) == 0) {
    echo json_encode(['success' => false, 'message' => 'User not found']);
    exit;
}

$user = mysqli_fetch_assoc($result);

if (isset($_POST['currentPassword']) && !empty($_POST['currentPassword'])) {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    
    if ($currentPassword === $user['password']) {
        $passwordSql = ", password = '$newPassword'";
        $passwordChanged = true;
    } else {
        echo json_encode(['success' => false, 'message' => 'Current password is incorrect']);
        exit;
    }
} else {
    $passwordSql = "";
}

$sql = "UPDATE companyworkers SET 
        full_name = '$fullName', 
        address = '$address', 
        phoneNo = '$phone' 
        $passwordSql
        WHERE email = '$email'";

if (mysqli_query($con, $sql)) {
    echo json_encode(['success' => true, 'passwordChanged' => $passwordChanged]);
} else {
    echo json_encode(['success' => false, 'message' => mysqli_error($con)]);
}
?>
