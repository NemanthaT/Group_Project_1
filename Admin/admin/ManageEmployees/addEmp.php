<?php
    require_once('../../../config/config.php');
    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $fullname = $_POST['fullname'];
        $role = $_POST['role'];
        $address = $_POST['address'];
        $phoneNo = $_POST['phoneNo'];
        $email = $_POST['email'];
        $password = rand(100000, 999999);
        //$password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO companyworkers (username, full_name, role, address, phoneNo, email, password) VALUES ('$username', '$fullname', '$role', '$address', '$phoneNo', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            $noticeType = "success";
            $error_message = "New Employee Added Successfully!";
            $data = ['noticeType' => $noticeType, 'error_message' => $error_message];
            echo json_encode($data);
        } else {
            $noticeType = "error";
            $error_message = "Error: Connection Error occured!";
            $data = ['noticeType' => $noticeType, 'error_message' => $error_message];
            echo json_encode($data);
        }
    }
?>