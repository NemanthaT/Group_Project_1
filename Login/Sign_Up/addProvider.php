<?php
session_start();
require_once('../../config/config.php');
header('Content-Type: application/json');

$popup_type = '';
$popup_title = '';
$popup_message = '';
$redirect_url = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form data
    $email = mysqli_real_escape_string($conn, $_POST['email-signup']);
    $first_name = mysqli_real_escape_string($conn, $_POST['first-name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last-name']);
    $full_name = $first_name . ' ' . $last_name;
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $speciality = mysqli_real_escape_string($conn, $_POST['speciality']);
    $specialized_fields = isset($_POST['specialized-fields']) ? implode(', ', $_POST['specialized-fields']) : '';
    $created_at = date('Y-m-d H:i:s');

    // Check for duplicate email
    $stmt = $conn->prepare("SELECT email, 'client' AS user_type FROM clients WHERE email = ? 
                            UNION 
                            SELECT email, 'serviceprovider' AS user_type FROM serviceproviders WHERE email = ?
                            UNION 
                            SELECT email, 'companyworker' AS user_type FROM companyworkers WHERE email = ?");
    $stmt->bind_param("sss", $email, $email, $email);
    $stmt->execute();
    $check_result1 = $stmt->get_result();

    //Check for pending requests
    $stmt = $conn->prepare("SELECT email, 'pending_client' AS user_type FROM pending_clients WHERE email = ?
                            UNION
                            SELECT email, 'providerrequest' AS user_type FROM providerrequests WHERE email = ?");
    $stmt->bind_param("ss", $email, $email);
    $stmt->execute();
    $check_result2 = $stmt->get_result();

    if (mysqli_num_rows($check_result1) > 0) {
        $popup_type = 'error';
        $popup_title = 'Oops!';
        $popup_message = 'This email is already registered.';
        $data = ['popup_type' => $popup_type, 'popup_title' => $popup_title, 'popup_message' => $popup_message];
        echo json_encode($data);
        exit();
    } else {
        // Check for duplicate email in pending_clients table
        if (mysqli_num_rows($check_result2) > 0) {
            $popup_type = 'error';
            $popup_title = 'Oops!';
            $popup_message = 'You have already submitted a request.';
            $data = ['popup_type' => $popup_type, 'popup_title' => $popup_title, 'popup_message' => $popup_message];
            echo json_encode($data);
            exit();
        } else {
            // Email is unique, proceed with registration
            // Insert data into pending_clients table
            $sql =  "INSERT INTO providerrequests (full_name, email, phone, address, field, specialty)
                VALUES ('$full_name', '$email', '$phone', '$address', '$specialized_fields', '$speciality')";

            if (mysqli_query($conn, $sql)) {
                $popup_type = 'success';
                $popup_title = 'Success!';
                $popup_message = 'Registration successful!';
                $data = ['popup_type' => $popup_type, 'popup_title' => $popup_title, 'popup_message' => $popup_message];
                echo json_encode($data);
                exit();
                $redirect_url = '../../Home/Homepage/HP.php';
            } else {
                $popup_type = 'error';
                $popup_title = 'Error!';
                $popup_message = 'An error occurred during registration. Please try again.';
                $data = ['popup_type' => $popup_type, 'popup_title' => $popup_title, 'popup_message' => $popup_message];
                echo json_encode($data);
                exit();
            }
        }
    }

    mysqli_close($conn);
}
